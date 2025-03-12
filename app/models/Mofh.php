<?php 
use \InfinityFree\MofhClient\Client;

class Mofh extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mailer');
		$this->m = new Client;
		$this->m->setApiUsername($this->get_username());
		$this->m->setApiPassword($this->get_password());
		$this->m->setPlan($this->get_package());
	}

	function get_username()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_username'];
		}
		return false;
	}

	function set_username($username)
	{
		$res = $this->update('username', $username);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_password()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_password'];
		}
		return false;
	}

	function set_password($password)
	{
		$res = $this->update('password', $password);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_cpanel()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_cpanel'];
		}
		return false;
	}

	function set_cpanel($cpanel)
	{
		$res = $this->update('cpanel', $cpanel);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_ns_1()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_ns_1'];
		}
		return false;
	}

	function set_ns_1($ns_1)
	{
		$res = $this->update('ns_1', $ns_1);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_ns_2()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_ns_2'];
		}
		return false;
	}

	function set_ns_2($ns_2)
	{
		$res = $this->update('ns_2', $ns_2);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_package()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_package'];
		}
		return false;
	}

	function set_package($package)
	{
		$res = $this->update('package', $package);
		if($res)
		{
			return true;
		}
		return false;
	}

	function check_availablity($domain)
	{
		try{
			$req = $this->m->availability(['domain' => $domain]);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND $res->getMessage() == 1)
			{
				return true;
			}
			elseif($res->isSuccessful() == 0 AND $res->getMessage() == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function create_account($label, $domain)
	{
		try{
			$email = $this->user->get_email();
			$username = char8($label.':'.$domain.':'.$email.':'.time());
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for($i = 0; $i < 15; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
			$req = $this->m->createAccount([
				'username' => $username,
				'password' => $password,
				'domain' => $domain,
				'email' => $email
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND strlen($res->getMessage()) > 1)
			{
				$data = [
					'account_label' => $label,
					'account_username' => $res->getVpUsername(),
					'account_password' => $password,
					'account_status' => 'pending',
					'account_key' => $username,
					'account_for' => $this->user->get_key(),
					'account_time' => time(),
					'account_domain' => $domain,
					'account_main' => str_replace('cpanel', $username, $this->get_cpanel())
				];
				$res = $this->db->insert('is_account', $data);
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function change_password($username, $password)
	{
		try{
			$req = $this->m->password([
				'username' => $username,
				'password' => $password,
				'enabledigest' => 1
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['passwd']['status'],
			        'message' => $data['passwd']['statusmsg']
			    ];
			if($param['status'] == 0 AND strlen($param['message']) > 1)
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND strlen($param['message']) > 1)
			{
				return true;
			}
			else
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function deactivate_account($username, $reason)
	{
		try{
			$req = $this->m->suspend([
				'username' => $username,
				'reason' => $reason
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['result']['status'],
			        'message' => $data['result']['statusmsg']
			    ];
			if($param['status'] == 0 AND !is_array($param['message']))
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND is_array($param['message']))
			{
				$data = ['status' => 'deactivating'];
				$where = ['key' => $username];
				$res = $this->base->update($data, $where, 'is_account', 'account_');
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($param['status'] == 0 AND $param['message'] == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function reactivate_account($username)
	{
		try{
			$req = $this->m->unsuspend([
				'username' => $username
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['result']['status'],
			        'message' => $data['result']['statusmsg']
			    ];
			if($param['status'] == 0 AND !is_array($param['message']))
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND is_array($param['message']))
			{
				$data = ['status' => 'reactivating'];
				$where = ['key' => $username];
				$res = $this->base->update($data, $where, 'is_account', 'account_');
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($param['status'] == 0 AND $param['message'] == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function get_domains($username)
	{
		try{
			$req = $this->m->GetUserDomains([
				'username' => $username
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0)
			{
				return false;
			}
			elseif($res->isSuccessful() == 1)
			{
				return $res->getDomains();
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function get_domain_user($domain)
	{
		try{
			$req = $this->m->getDomainUser([
				'domain' => $domain
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0)
			{
				return false;
			}
			elseif($res->isSuccessful() == 1)
			{
				return $res->getData();
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function list_exts(){
		$res = $this->fetch('is_domain', [], 'domain_');
		return $res;
	}

	function rm_ext($domain){
		$res = $this->db->delete('is_domain', ['domain_name' => $domain]);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function add_ext($domain){
		if($domain == '')
		{
			return false;
		}
		if(strpos($domain, '.') === false)
		{
			return false;
		}
		if(strpos($domain, '.') !== 0)
		{
			$domain = '.'.$domain;
		}
		$domain = strtolower($domain);
		$res = $this->db->insert('is_domain', array('domain_name' => $domain));
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function test_mofh()
	{
		try{
			$req = $this->m->availability(['domain' => 'google.com']);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND $res->getMessage() == 1)
			{
				return true;
			}
			elseif($res->isSuccessful() == 0 AND $res->getMessage() == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	private function update($field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => 'xera_mofh'],
			'is_mofh',
			'mofh_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function update_where($table, $data, $where, $prefix)
	{
		$res = $this->base->update(
			$data,
			$where,
			$table,
			$prefix
		);
		if(count($res) > 0)
		{
			return $res;
		}
		return false;
	}

	private function fetch($table, $where = [], $prefix)
	{
		$res = $this->base->fetch(
			$table,
			$where,
			$prefix
		);
		return $res;
	}

	private function fetch_base()
	{
		$res = $this->base->fetch(
			'is_mofh',
			['id' => 'xera_mofh'],
			'mofh_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
function create_fm_link($username, $password)
{
    try {
        // Tạo và trả về link file manager
        $fm_url = "https://filemanager.ai/new/?" . http_build_query([
            'host' => 'ftpupload.net',
            'port' => 21,
            'user' => $username,
            'password' => $password
        ]);
        return $fm_url;
    }
    catch(Exception $e) {
        return false; 
    }
}
function create_softaculous_link($username, $password) {
    try {
        // Khởi tạo Vistapanel API
        require_once APPPATH . 'vendor/vistapanel/api-client.php';
        $api = new VistapanelApi();
        $api->setCpanelUrl("https://cpanel.byethost.com");

        // Login và lấy link
        if($api->login($username, $password)) {
            $link = $api->getSoftaculousLink();
            $api->logout();
            return $link;
        }
        return false;
    }
    catch(Exception $e) {
        log_message('error', 'Vistapanel API Error: ' . $e->getMessage());
        return false;
    }
}
function get_account_all_stats($username, $password) {
    try {
        require_once APPPATH . 'vendor/vistapanel/api-client.php';
        $api = new VistapanelApi();
        $api->setCpanelUrl("https://cpanel.byethost.com");

        if($api->login($username, $password)) {
            // Lấy tất cả thông tin cần thiết
            $stats = $api->getDetailedStats();
            $softaculous_url = $api->getSoftaculousLink();
            
            // Format disk info
            $disk_info = [
                'used' => $stats['Disk Space Used']['value'] ?? 0,
                'total' => $stats['Disk Quota']['value'] ?? 10240,
                'unit' => $stats['Disk Space Used']['unit'] ?? 'MB',
                'free' => $stats['Disk Free']['value'] ?? 0
            ];

            // Format inodes info
            $inodes_info = isset($stats['Inodes Used']) ? [
                'used' => $stats['Inodes Used']['used'],
                'total' => $stats['Inodes Used']['total'],
                'percent' => $stats['Inodes Used']['percent']
            ] : [
                'used' => 0,
                'total' => 59400,
                'percent' => 0
            ];

            // Format bandwidth info
            $bandwidth_info = [
                'used' => $stats['Bandwidth used']['value'] ?? 0,
                'used_unit' => $stats['Bandwidth used']['unit'] ?? 'MB',
                'is_unlimited' => isset($stats['Bandwidth']) && $stats['Bandwidth'] === 'Unlimited',
                'total' => $stats['Bandwidth']['value'] ?? 'Unlimited',
                'percent' => isset($stats['Bandwidth used']['percent']) ? $stats['Bandwidth used']['percent'] : 0
            ];

            // Convert units if needed
            foreach(['disk_info', 'bandwidth_info'] as $info) {
                if(isset(${$info}['unit']) && strpos(${$info}['unit'], 'GB') !== false) {
                    ${$info}['used'] *= 1024;
                    if(${$info}['total'] !== 'Unlimited') {
                        ${$info}['total'] *= 1024;
                    }
                    ${$info}['unit'] = 'MB';
                }
            }

            // Calculate percentages
            $disk_info['percent'] = $disk_info['total'] > 0 ? 
                ($disk_info['used'] / $disk_info['total']) * 100 : 0;

            $api->logout();

            // Return all information
            return [
                'disk' => $disk_info,
                'inodes' => $inodes_info,
                'bandwidth' => $bandwidth_info,
                'domains' => [
                    'addon' => $stats['Add-on Domains']['used'] ?? 0,
                    'sub' => $stats['Sub-Domains']['used'] ?? 0,
                    'parked' => $stats['Parked Domains']['used'] ?? 0,
                ],
                'links' => [
                    'softaculous' => $softaculous_url
                ]
            ];
        }
        return false;
    }
    catch(Exception $e) {
        log_message('error', 'Vistapanel API Error: ' . $e->getMessage());
        return false;
    }
}
// Thêm vào Mofh.php model:

function get_cached_account_stats($username, $password, $force_refresh = false) {
    // Tạo unique cache key cho mỗi account
    $cache_key = 'account_stats_' . md5($username);
    
    // Nếu không force refresh và có cache, return cache
    if(!$force_refresh) {
        $cached = $this->cache->get($cache_key);
        if($cached !== false) {
            return $cached;
        }
    }

    // Lấy dữ liệu mới
    $stats = $this->get_account_all_stats($username, $password);
    if($stats !== false) {
        // Cache trong 5 phút
        $this->cache->save($cache_key, $stats, 300);
    }
    
    return $stats;
}

function get_softaculous_link($username, $password)
{
    try {
        require_once APPPATH . 'vendor/vistapanel/api-client.php';
        $api = new VistapanelApi();
        $api->setCpanelUrl("https://cpanel.byethost.com");

        if($api->login($username, $password)) {
            $link = $api->getSoftaculousLink();
            $api->logout();
            return $link;
        }
        return false;
    }
    catch(Exception $e) {
        log_message('error', 'Softaculous error: ' . $e->getMessage());
        return false;
    }
}

}

?>
