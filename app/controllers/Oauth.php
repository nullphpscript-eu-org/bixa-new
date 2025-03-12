<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oauth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    public function authorize() {
        // Xác thực user hiện tại
        if(!$this->user->is_logged()) {
            redirect('login');
            return;
        }

        $client_id = $this->input->get('client_id');
        $redirect_uri = $this->input->get('redirect_uri');
        $state = $this->input->get('state');

        // Tạo authorization code
        $code = bin2hex(random_bytes(16));
        
        // Lưu code vào session/cache
        $this->session->set_userdata('oauth_code', [
            'code' => $code,
            'client_id' => $client_id,
            'user_id' => $this->user->get_id()
        ]);

        // Redirect về Flarum
        redirect($redirect_uri . '?code=' . $code . '&state=' . $state);
    }

    public function token() {
        $code = $this->input->post('code');
        $client_id = $this->input->post('client_id');
        $client_secret = $this->input->post('client_secret');

        // Verify client credentials
        if($client_secret !== $this->config->item('oauth_client_secret')) {
            $this->output->set_status_header(401);
            return;
        }

        // Get code data from session/cache
        $code_data = $this->session->userdata('oauth_code');
        
        if(!$code_data || $code_data['code'] !== $code) {
            $this->output->set_status_header(400);
            return;
        }

        // Generate access token
        $token = bin2hex(random_bytes(32));
        
        // Save token
        $this->session->set_userdata('oauth_token', [
            'token' => $token,
            'user_id' => $code_data['user_id']
        ]);

        // Return token response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]));
    }

    public function userinfo() {
        // Get token from Authorization header
        $header = $this->input->get_request_header('Authorization');
        if(!$header || !preg_match('/Bearer\s+(.*)$/i', $header, $matches)) {
            $this->output->set_status_header(401);
            return;
        }

        $token = $matches[1];
        
        // Verify token
        $token_data = $this->session->userdata('oauth_token');
        if(!$token_data || $token_data['token'] !== $token) {
            $this->output->set_status_header(401);
            return;
        }

        // Get user info
        $user = $this->user->get_info_by_id($token_data['user_id']);

        // Return user data
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'sub' => $user['user_id'],
                'name' => $user['user_name'],
                'email' => $user['user_email']
            ]));
    }
}