<?php
if (!function_exists('get_ad')) {
    function get_ad($placement) {
        $CI =& get_instance();
        $CI->load->model('ads');
        
        // Get ads for this placement
        $ads = $CI->ads->get_by_placement($placement);
        
        $output = '';
        foreach($ads as $ad) {
            if($ad['ad_status'] == 'active') {
                $output .= $ad['ad_content'] . "\n";
            }
        }
        
        return $output;
    }
}

if (!function_exists('display_ad')) {
    function display_ad($placement) {
        echo get_ad($placement);
    }
}