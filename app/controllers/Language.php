<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function change($lang) {
        $allowed_langs = array_column(get_languages(), 'code');
        
        if (in_array($lang, $allowed_langs)) {
            set_cookie('lang', $lang, 3600*24*30);
        }
        
        // Redirect back to previous page
        redirect($_SERVER['HTTP_REFERER']);
    }
}