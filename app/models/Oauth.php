<?php 



class Oauth extends CI_Model

{

    // Define providers array at the top

    private $providers = [

        'github' => [

            'auth_url' => 'https://github.com/login/oauth/authorize',

            'token_url' => 'https://github.com/login/oauth/access_token', 

            'api_url' => 'https://api.github.com/user',

            'scope' => 'user,email'

        ],

        'google' => [

            'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',

            'token_url' => 'https://oauth2.googleapis.com/token',

            'api_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',

            'scope' => 'email profile'  

        ],

        'facebook' => [

            'auth_url' => 'https://www.facebook.com/v12.0/dialog/oauth',

            'token_url' => 'https://graph.facebook.com/v12.0/oauth/access_token',

            'api_url' => 'https://graph.facebook.com/me',

            'scope' => 'email,public_profile'

        ],
      
      'discord' => [
    'auth_url' => 'https://discord.com/api/oauth2/authorize',
    'token_url' => 'https://discord.com/api/oauth2/token', 
    'api_url' => 'https://discord.com/api/users/@me',
    'scope' => 'identify email'
],
      
'microsoft' => [
    'auth_url' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
    'token_url' => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
    'api_url' => 'https://graph.microsoft.com/v1.0/me',
    'scope' => 'User.Read email offline_access'
]

    ];



    // Get/Set functions

    function get_client($id)

    {

        $res = $this->fetch($id);

        return ($res !== false) ? $res['oauth_client'] : false;

    }



    function set_client($id, $client)

    {

        return $this->update($id, 'client', $client);

    }



    function get_secret($id)

    {

        $res = $this->fetch($id);

        return ($res !== false) ? $res['oauth_secret'] : false;

    }



    function set_secret($id, $secret)

    {

        return $this->update($id, 'secret', $secret);

    }



    function get_endpoint($id)

    {

        $res = $this->fetch($id);

        return ($res !== false) ? $res['oauth_endpoint'] : false; 

    }



    function set_endpoint($id, $endpoint)

    {

        return $this->update($id, 'endpoint', $endpoint);

    }



    function is_active($id)

    {

        $res = $this->fetch($id);

        return ($res !== false && $res['oauth_status'] === 'active');

    }



    function get_status($id)

    {

        $res = $this->fetch($id);

        return ($res !== false) ? $res['oauth_status'] : false;

    }



    function set_status($id, bool $status)

    {

        $status = ($status === true) ? 'active' : 'inactive';

        return $this->update($id, 'status', $status);

    }



    // OAuth flow functions

    function get_auth_url($provider) 

    {

        if (!isset($this->providers[$provider])) {

            return false;

        }



        $config = $this->providers[$provider];

        $params = [

            'client_id' => $this->get_client($provider),

            'redirect_uri' => base_url("c/{$provider}_oauth"),

            'scope' => $config['scope'],

            'response_type' => 'code',

            'state' => $this->create_state_token()

        ];



        return $config['auth_url'] . '?' . http_build_query($params);

    }



    function handle_oauth_callback($provider, $code)  

    {

        if (!isset($this->providers[$provider])) {

            return false;

        }



        $token = $this->get_oauth_token($provider, $code);

        if (!$token) {

            return false;

        }



        return $this->get_user_info($provider, $token);

    }



    // Private helper functions

    private function get_oauth_token($provider, $code)

    {

        $config = $this->providers[$provider];

        

        $params = [

            'client_id' => $this->get_client($provider),

            'client_secret' => $this->get_secret($provider),

            'code' => $code,

            'redirect_uri' => base_url("c/{$provider}_oauth")

        ];



        if ($provider === 'google') {

            $params['grant_type'] = 'authorization_code';

        }



        $ch = curl_init($config['token_url']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        

        if ($provider === 'github') {

            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

        }



        $response = curl_exec($ch);

        curl_close($ch);



        $data = json_decode($response, true);

        return $data['access_token'] ?? false;

    }



    private function get_user_info($provider, $token)

    {

        $config = $this->providers[$provider];

        

        $ch = curl_init($config['api_url'] . ($provider === 'facebook' ? '?fields=name,email' : ''));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [

            'Authorization: Bearer ' . $token,

            'User-Agent: CI-OAuth'

        ]);



        $response = curl_exec($ch);

        curl_close($ch);



        return json_decode($response, true);

    }



    private function create_state_token()

    {

        $state = bin2hex(random_bytes(16));

        $this->session->set_userdata('oauth_state', $state);

        return $state;

    }



    private function verify_state_token($state)

    {

        $saved_state = $this->session->userdata('oauth_state');

        $this->session->unset_userdata('oauth_state');

        return $saved_state && hash_equals($saved_state, $state);

    }



    private function update($id, $field, $value)

    {

        return $this->base->update(

            [$field => $value],

            ['id' => $id], 

            'is_oauth',

            'oauth_'

        );

    }



    private function fetch($id = 'github')

    {

        $res = $this->base->fetch(

            'is_oauth',

            ['id' => $id],

            'oauth_'

        );

        return count($res) > 0 ? $res[0] : false;

    }

}