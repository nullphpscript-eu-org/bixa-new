<?php

class Ads extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    // Get all ads
    function get_all() {
        $query = $this->db->get('is_ads');
        return $query->result_array();
    }
    
    // Get specific ad
    function get($id) {
        $this->db->where('ad_id', $id);
        $query = $this->db->get('is_ads');
        return $query->row_array();
    }
    
    // Create new ad
    function create($data) {
        $insert = [
            'ad_name' => $data['name'],
            'ad_content' => $data['content'],
            'ad_placement' => $data['placement'],
            'ad_status' => isset($data['status']) ? 'active' : 'inactive',
            'ad_created' => time()
        ];
        
        return $this->db->insert('is_ads', $insert);
    }
    
    // Update ad
    function update($id, $data) {
        $update = [
            'ad_name' => $data['name'],
            'ad_content' => $data['content'], 
            'ad_placement' => $data['placement'],
            'ad_status' => isset($data['status']) ? 'active' : 'inactive'
        ];
        
        $this->db->where('ad_id', $id);
        return $this->db->update('is_ads', $update);
    }
    
    // Delete ad
    function delete($id) {
        $this->db->where('ad_id', $id);
        return $this->db->delete('is_ads');
    }
    
    // Get active ads by placement
    function get_by_placement($placement) {
        $this->db->where('ad_placement', $placement);
        $this->db->where('ad_status', 'active');
        $query = $this->db->get('is_ads');
        return $query->result_array();
    }
}