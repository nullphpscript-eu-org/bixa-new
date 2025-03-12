<?php
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\Zones;

class Cloudflare extends CI_Model {
    private $adapter;
    private $initialized = false;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('encryption');
    }

    // Initialize API connection
 private function init_api() {
        if($this->adapter) return true;
        
        try {
            $api = $this->user->get_cloudflare_api();
            if(!$api) {
                log_message('error', 'No Cloudflare API credentials found');
                return false;
            }

            // Print API credentials for debug
            log_message('debug', 'Using API credentials: ' . json_encode([
                'email' => $api['email'],
                'key_length' => strlen($api['key'])
            ]));

            $key = new \Cloudflare\API\Auth\APIKey($api['email'], $api['key']);
            $this->adapter = new \Cloudflare\API\Adapter\Guzzle($key);
            return true;

        } catch(Exception $e) {
            log_message('error', 'Init API error: ' . $e->getMessage());
            return false;
        }
    }



    // Validate API credentials
     public function validate_api_key($email, $key) {
        try {
            $test_key = new \Cloudflare\API\Auth\APIKey($email, $key);
            $adapter = new \Cloudflare\API\Adapter\Guzzle($test_key);
            $zones = new \Cloudflare\API\Endpoints\Zones($adapter);
            
            // Try to list zones to validate key
            $zones->listZones();
            return true;
        } catch(Exception $e) {
            log_message('error', 'Invalid Cloudflare API key: ' . $e->getMessage());
            return false;
        }
    }

    // Get list of zones (domains)
    public function list_zones() {
        if(!$this->init_api()) {
            log_message('error', 'Failed to initialize Cloudflare API');
            return false;
        }

        try {
            $zones = new \Cloudflare\API\Endpoints\Zones($this->adapter);
            // Get first page of zones
            $response = $zones->listZones();
            
            // Log response for debugging
            log_message('debug', 'Cloudflare API Response: ' . json_encode($response));
            
            if(empty($response)) {
                log_message('info', 'No zones found for user');
                return [];
            }
            
            return $response;
            
        } catch(Exception $e) {
            log_message('error', 'Error fetching Cloudflare zones: ' . $e->getMessage());
            return false;
        }
    }


    public function get_zone_id($domain) {
    if(!$this->init_api()) {
        return false;
    }

    try {
        $zones = new \Cloudflare\API\Endpoints\Zones($this->adapter);
        // Get list of zones first
        $list = $zones->listZones()->result;
        
        // Find matching domain
        foreach($list as $zone) {
            if($zone->name === $domain) {
                return $zone->id;
            }
        }
        return false;
        
    } catch(Exception $e) {
        log_message('error', 'Error getting zone ID: ' . $e->getMessage());
        return false;
    }
}

    // List DNS records for a zone
 public function list_dns_records($zone_id) {
    if(!$this->init_api()) {
        log_message('error', 'Failed to initialize Cloudflare API');
        return false;
    }

    try {
        $dns = new \Cloudflare\API\Endpoints\DNS($this->adapter);
        // Use the proper method to get records
        $records = $dns->listRecords($zone_id)->result;
        
        log_message('debug', 'Raw DNS Records: ' . json_encode($records));

        if(!empty($records)) {
            return $records;
        }
        return [];
        
    } catch(Exception $e) {
        log_message('error', 'Error getting DNS records: ' . $e->getMessage());
        return false;
    }
}

    // Add new DNS record
public function add_dns_record($zone_id, $type, $name, $content, $ttl = 1, $proxied = false, $priority = null) {
    if(!$this->init_api()) {
        return false;
    }

    try {
        $dns = new \Cloudflare\API\Endpoints\DNS($this->adapter);

        // Set priority dựa trên input hoặc default cho MX
        $recordPriority = '';
        if($priority !== null) {
            $recordPriority = (string)$priority;  // Convert to string for API
        } elseif($type === 'MX') {
            $recordPriority = '10'; // Default cho MX nếu không set
        }

        $result = $dns->addRecord(
            $zone_id,
            $type,
            $name,
            $content,
            $ttl,
            $proxied,
            $recordPriority
        );

        return $result;

    } catch(Exception $e) {
        log_message('error', 'Error adding DNS record: ' . $e->getMessage());
        throw $e;
    }
}
public function delete_dns_record($zone_id, $record_id) {
    if(!$this->init_api()) {
        return false;
    }

    try {
        $dns = new \Cloudflare\API\Endpoints\DNS($this->adapter);

        log_message('debug', "Deleting DNS Record: zone_id=$zone_id, record_id=$record_id");

        $result = $dns->deleteRecord($zone_id, $record_id);

        log_message('debug', 'Delete Record Response: ' . json_encode($result));

        return $result;

    } catch(Exception $e) {
        log_message('error', 'Delete DNS Error: ' . $e->getMessage());
        return false;
    }
}

}