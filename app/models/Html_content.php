<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Html_content extends CI_Model {
    private $table = 'html_content';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create($data) {
        $insert = [
            'name' => $data['name'],
            'content' => $data['content'],
            'created_at' => date('Y-m-d H:i:s'),
            'is_active' => 0
        ];
        return $this->db->insert($this->table, $insert);
    }
    
    public function get_all() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get($id) {
        $query = $this->db->get_where($this->table, ['id' => $id]);
        return $query->row();
    }
    
    public function update($id, $data) {
        $update = [
            'name' => $data['name'], 
            'content' => $data['content'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        return $this->db->update($this->table, $update);
    }
    
    public function set_active($id) {
        // First deactivate all
        $this->db->update($this->table, ['is_active' => 0]);
        
        // Then activate selected one
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['is_active' => 1]);
    }

    public function set_inactive($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['is_active' => 0]);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get_active() {
        $query = $this->db->get_where($this->table, ['is_active' => 1]);
        return $query->row();
    }
    
    public function count_active() {
        return $this->db->where('is_active', 1)
                       ->count_all_results($this->table);
    }
}