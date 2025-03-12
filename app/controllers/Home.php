<?php
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('html_content');
    }
    
    public function index() {
        $content = $this->html_content->get_active();
        if($content) {
            echo $content->content;
        } else {
            show_404();
        }
    }
}