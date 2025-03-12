<?php 



class A extends CI_Controller

{

		function __construct()

	{

		parent::__construct();

		$this->load->model('user');

		$this->load->model('admin');

		$this->load->model('ticket');

		$this->load->model('account');

		$this->load->model(['gogetssl' => 'ssl']);

		$this->load->model(['acme' => 'acme']);

		$this->load->model(['sitepro' => 'sp']);

		$this->load->model('mofh');

		$this->load->model('oauth');

		$this->load->library(['form_validation' => 'fv']);

		$this->load->model(['recaptcha' => 'grc']);

		if(!get_cookie('theme'))

		{

			set_cookie('theme', 'light', 30*86400);

		}

	}



	function index()

	{

		if(!$this->admin->admin_count() > 0)

		{

			redirect('admin/register');

		}

		else

		{

			$this->login();

		}

	}



	function register()

	{

		if(!$this->admin->admin_count() > 0)

		{

			if($this->input->post('register'))

			{

				$this->fv->set_rules('name', 'Name', ['trim', 'required', 'valid_name']);

				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);

				$this->fv->set_rules('password', 'Password', ['trim', 'required']);

				$this->fv->set_rules('password1', 'Confirm password', ['trim', 'required','matches[password]']);

				if($this->grc->is_active())

				{

					if($this->grc->get_type() == "google")

					{

						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "crypto")

					{

						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "human")

					{

						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "turnstile")

					{

						$this->fv->set_rules('cf-turnstile-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);

					}

					if($this->fv->run() === true)

					{

						$name = $this->input->post('name');

						$email = $this->input->post('email');

						$password = $this->input->post('password');

						if($this->grc->get_type() == "google")

						{

							$token = $this->input->post('g-recaptcha-response');

							$type = "google";

						}

						elseif($this->grc->get_type() == "crypto")

						{

							$token = $this->input->post('CRLT-captcha-token');

							$type = "crypto";

						}

						elseif($this->grc->get_type() == "turnstile")

						{

							$token = $this->input->post('cf-turnstile-response');

							$type = "turnstile";

						}

						else

						{

							$token = $this->input->post('h-captcha-response');

							$type = "human";

						}

						if($this->grc->is_valid($token, $type))

						{

							if(!$this->admin->is_register($email))

							{

								$res = $this->admin->register($name, $email, $password);

								if($res)

								{

									$this->session->set_flashdata('msg', json_encode([1, 'User has been registered successfully.']));

									redirect('admin/login');

								}

								else

								{

									$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

									redirect('admin/register');

								}

							}

							else

							{

								$this->session->set_flashdata('msg', json_encode([0, 'A user with this email address already exists.']));

								redirect('admin/register');

							}

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Invalid captcha response received.']));

							redirect('admin/register');

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect('admin/register');

					}

				}

				else

				{

					if($this->fv->run() === true)

					{

						$name = $this->input->post('name');

						$email = $this->input->post('email');

						$password = $this->input->post('password');

						if(!$this->admin->is_register($email))

						{

							$res = $this->admin->register($name, $email, $password);

							if($res)

							{

								$this->session->set_flashdata('msg', json_encode([1, 'User has been registered successfully.']));

									redirect('admin/login');

							}

							else

							{

								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

							}

							redirect('admin/register');

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'A user with this email address already exists.']));

							redirect('admin/register');

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect('admin/register');

					}

				}

			}

			else

			{

				$data['title'] = 'Register';

				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);

				$this->load->view($this->base->get_template().'/form/admin/register.php');

				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');

			}

		}

		else

		{

			redirect('admin');

		}

	}



	function login()

	{

		if(!$this->admin->is_logged())

		{

			if($this->input->post('login'))

			{

				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);

				$this->fv->set_rules('password', 'Password', ['trim', 'required']);

				if($this->grc->is_active())

				{

					if($this->grc->get_type() == "google")

					{

						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "crypto")

					{

						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "human")

					{

						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "turnstile")

					{

						$this->fv->set_rules('cf-turnstile-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);

					}

					if($this->fv->run() === true)

					{

						$email = $this->input->post('email');

						$password = $this->input->post('password');

						$checkbox = $this->input->post('checkbox');

						if(!$checkbox)

						{

							$days = 1;

						}

						else

						{

							$days = 30;

						}

						if($this->grc->get_type() == "google")

						{

							$token = $this->input->post('g-recaptcha-response');

							$type = "google";

						}

						elseif($this->grc->get_type() == "crypto")

						{

							$token = $this->input->post('CRLT-captcha-token');

							$type = "crypto";

						}

						elseif($this->grc->get_type() == "turnstile")

						{

							$token = $this->input->post('cf-turnstile-response');

							$type = "turnstile";

						}

						else

						{

							$token = $this->input->post('h-captcha-response');

							$type = "human";

						}

						if($this->grc->is_valid($token, $type))

						{

							$res = $this->admin->login($email, $password, $days);

							if($res)

							{

								$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));

								redirect('admin');

							}

							else

							{

								$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));

								redirect('admin/login');

							}

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Invalid recaptcha response received.']));

							redirect('admin/login');

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect('admin/login');

					}

				}

				else

				{

					if($this->fv->run() === true)

					{

						$email = $this->input->post('email');

						$password = $this->input->post('password');

						$checkbox = $this->input->post('checkbox');

						if(!$checkbox)

						{

							$days = 1;

						}

						else

						{

							$days = 30;

						}

						$res = $this->admin->login($email, $password, $days);

						if($res)

						{

							$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));

							redirect('admin');

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));

							redirect('admin/login');

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect('admin/login');

					}

				}

			}

			else

			{

				$data['title'] = 'Login';

				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);

				$this->load->view($this->base->get_template().'/form/admin/login.php');

				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');

			}

		}

		else

		{

			redirect('admin');

		}

	}



	function forget()

	{

		if(!$this->admin->is_logged())

		{

			if($this->input->post('forget'))

			{

				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);

				if($this->fv->run() === true)

				{

					$email = $this->input->post('email');

					$this->admin->reset_password($email);

					$this->session->set_flashdata('msg', json_encode([1, 'Please check your inbox for further instructions.']));

					redirect('admin/login');

				}

				else

				{

					if(validation_errors() !== '')

					{

						$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

					}

					redirect('admin/forget');

				}

			}

			else

			{

				$data['title'] = 'Login';

				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);

				$this->load->view($this->base->get_template().'/form/admin/forget.php');

				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');

			}

		}

		else

		{

			redirect('admin');

		}

	}







	function logout($status = 1, $msg = '')

	{

		if($this->admin->logout())

		{

			if($msg !== '')

			{

				$this->session->set_flashdata('msg', json_encode([$status, $msg]));

			}

			else

			{

				$this->session->set_flashdata('msg', json_encode([1, 'Logged out successfully.']));

			}

			redirect('admin/login');

		}

		else

		{

			$this->session->set_flashdata('msg', json_encode([0, 'Login to continue.']));

			redirect('admin/login');

		}

	}



	function settings()

	{

		if($this->admin->is_logged())

		{

			if($this->input->post('update_theme'))

			{

				set_cookie('theme', $this->input->post('theme'), 30*86400);

				$this->session->set_flashdata('msg', json_encode([1, 'Theme changed successfully.']));

				redirect('admin/settings');

			}

			elseif($this->input->post('update_name'))

			{

				$this->fv->set_rules('name', 'Name', ['trim', 'required', 'valid_name']);

				if($this->fv->run() === true)

				{

					$name = $this->input->post('name');

					$res = $this->admin->set_name($name);

					if($res !== false)

					{

						$this->session->set_flashdata('msg', json_encode([1, 'User name updated successfully.']));

						redirect('admin/settings');

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

						redirect('admin/settings');

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

					redirect('admin/settings');

				}

			}

			elseif($this->input->post('update_password'))

			{

				$this->fv->set_rules('password', 'New password', ['trim', 'required']);

				$this->fv->set_rules('password1', 'Confirm password', ['trim', 'required', 'matches[password]']);

				$this->fv->set_rules('old_password', 'Old password', ['trim', 'required']);

				if($this->fv->run() === true)

				{

					$password = $this->input->post('password');

					$old_password = $this->input->post('old_password');

					$res = $this->admin->set_password($old_password, $password);

					if($res !== false)

					{

						$this->logout(1, 'User password updated successfully.');

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

						redirect('admin/settings');

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

					redirect('admin/settings');

				}

			}

			else

			{

				$data['title'] = 'Settings';



				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

				$this->load->view($this->base->get_template().'/page/admin/settings');

				$this->load->view($this->base->get_template().'/page/includes/admin/footer');

			}



		}

		else

		{

			redirect('admin/login');

		}

	}



function site_settings() 

{

    if($this->admin->is_logged())

    {

        if($this->input->post('update_host'))

        {

            $this->fv->set_rules('hostname', 'Host Name', ['trim', 'required']);

			$this->fv->set_rules('slogo', 'Logo URL', ['trim', 'required', 'valid_url']);

			$this->fv->set_rules('favicon', 'Logo URL', ['trim', 'required', 'valid_url']);

            $this->fv->set_rules('email', 'Alert Email', ['trim', 'required', 'valid_email']);

            $this->fv->set_rules('fourm', 'Fourm URL', ['trim', 'required', 'valid_url']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);

            $this->fv->set_rules('template', 'Template Dir', ['trim', 'required']);

            $this->fv->set_rules('rpp', 'Records Per Page', ['trim', 'required']);

            if($this->fv->run() === true)

            {

                $name = $this->input->post('hostname');

				$slogo = $this->input->post('slogo');

				$favicon = $this->input->post('favicon');

                $email = $this->input->post('email');

                $status = $this->input->post('status');

                $fourm = $this->input->post('fourm');

                $template = $this->input->post('template');

                $rpp = $this->input->post('rpp');

                $res = $this->base->set_hostname($name);

				$res = $this->base->set_slogo($slogo);

				$res = $this->base->set_favicon($favicon);

                $res = $this->base->set_email($email);

                $res = $this->base->set_status($status);

                $res = $this->base->set_fourm($fourm);

                $res = $this->base->set_template($template);

                $res = $this->base->set_rpp($rpp);

                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'Site settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('admin/site');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('admin/site');

            }

        }

        else

        {

            $data['title'] = 'Site Settings';

            $data['active'] = 'settings';



            $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

            $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

            $this->load->view($this->base->get_template().'/page/admin/site_settings'); // Đổi tên view file

            $this->load->view($this->base->get_template().'/page/includes/admin/footer');

        }

    }

    else

    {

        redirect('admin/login');

    }

}

function api_settings()

{

    if($this->admin->is_logged())

    {

        // Handle form submissions

        if($this->input->post('update_mofh'))

        {

            $this->fv->set_rules('username', 'Username', ['trim', 'required']);

            $this->fv->set_rules('password', 'Password', ['trim', 'required']);

            $this->fv->set_rules('cpanel', 'cPanel URL', ['trim', 'required']);

            $this->fv->set_rules('ns_1', 'Nameserver 1', ['trim', 'required']);

            $this->fv->set_rules('ns_2', 'Nameserver 2', ['trim', 'required']);

            $this->fv->set_rules('package', 'Package', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $username = $this->input->post('username');

                $password = $this->input->post('password');

                $cpanel = $this->input->post('cpanel');

                $ns_1 = $this->input->post('ns_1');

                $ns_2 = $this->input->post('ns_2');

                $package = $this->input->post('package');

                

                $res = $this->mofh->set_username($username);

                $res = $this->mofh->set_password($password);

                $res = $this->mofh->set_cpanel($cpanel);

                $res = $this->mofh->set_ns_1($ns_1);

                $res = $this->mofh->set_ns_2($ns_2);

                $res = $this->mofh->set_package($package);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'MOFH settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/mofh');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/mofh');

            }

        }

        elseif($this->input->post('update_smtp'))

        {

            $this->fv->set_rules('hostname', 'Hostname', ['trim', 'required']);

            $this->fv->set_rules('username', 'Username', ['trim', 'required']);

            $this->fv->set_rules('password', 'Password', ['trim', 'required']);

            $this->fv->set_rules('from', 'From Email', ['trim', 'required', 'valid_email']);

            $this->fv->set_rules('name', 'From Name', ['trim', 'required']);

            $this->fv->set_rules('port', 'Port', ['trim', 'required']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']); 

            $this->fv->set_rules('encryption', 'Encryption', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $hostname = $this->input->post('hostname');

                $username = $this->input->post('username');

                $password = $this->input->post('password');

                $from = $this->input->post('from');

                $name = $this->input->post('name');

                $port = $this->input->post('port');

                $status = $this->input->post('status');

                $encryption = $this->input->post('encryption');



                $res = $this->smtp->set_hostname($hostname);

                $res = $this->smtp->set_username($username);

                $res = $this->smtp->set_password($password);

                $res = $this->smtp->set_from($from);

                $res = $this->smtp->set_name($name);

                $res = $this->smtp->set_port($port);

                $res = $this->smtp->set_status($status);

                $res = $this->smtp->set_encryption($encryption);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'SMTP settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/smtp');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/smtp');

            }

        }

        elseif($this->input->post('update_grc'))

        {

            $this->fv->set_rules('site_key', 'Site key', ['trim', 'required']);

            $this->fv->set_rules('secret_key', 'Secret key', ['trim', 'required']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);

            $this->fv->set_rules('type', 'Type', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $site_key = $this->input->post('site_key');

                $secret_key = $this->input->post('secret_key');

                $status = $this->input->post('status');

                $type = $this->input->post('type');



                $res = $this->grc->set_site_key($site_key);

                $res = $this->grc->set_secret_key($secret_key);

                $res = $this->grc->set_status($status);

                $res = $this->grc->set_type($type);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'Captcha settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/captcha');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/captcha');

            }

        }

        elseif($this->input->post('update_ssl'))

        {

            $this->fv->set_rules('username', 'Username', ['trim', 'required']);

            $this->fv->set_rules('password', 'Password', ['trim', 'required']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $username = $this->input->post('username');

                $password = $this->input->post('password');

                $status = $this->input->post('status');



                $res = $this->ssl->set_username($username);

                $res = $this->ssl->set_password($password);

                $res = $this->ssl->set_status($status);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'GoGetSSL settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/ssl');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/ssl'); 

            }

        }

        elseif($this->input->post('update_acme'))

        {

            $this->fv->set_rules('letsencrypt', "Directory URL", ['trim']);

            $this->fv->set_rules('zerossl_url', 'Directory URL', ['trim']);

            $this->fv->set_rules('zerossl_kid', 'EAB Key ID', ['trim']); 

            $this->fv->set_rules('zerossl_hmac', 'EAB HMAC Key', ['trim']);

            $this->fv->set_rules('googletrust_url', 'Directory URL', ['trim']);

            $this->fv->set_rules('googletrust_kid', 'EAB Key ID', ['trim']);

            $this->fv->set_rules('googletrust_hmac', 'EAB HMAC Key', ['trim']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);

            $this->fv->set_rules('dns_resolver', 'DNS Resolver', ['trim', 'required']);

            $this->fv->set_rules('dns_doh', 'DNS over HTTPS', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $letsencrypt = $this->input->post('letsencrypt');

                if ($letsencrypt == '') {

                    $letsencrypt = 'not-set';

                }

                

                $zerossl = [

                    'url' => $this->input->post('zerossl_url'),

                    'eab_kid' => $this->input->post('zerossl_kid'),

                    'eab_hmac_key' => $this->input->post('zerossl_hmac')

                ];

                if ($zerossl['url'] == '' && $zerossl['eab_kid'] == '' && $zerossl['eab_hmac_key'] == '') {

                    $zerossl = 'not-set';

                }



                $googletrust = [

                    'url' => $this->input->post('googletrust_url'),

                    'eab_kid' => $this->input->post('googletrust_kid'),

                    'eab_hmac_key' => $this->input->post('googletrust_hmac')

                ];

                if ($googletrust['url'] == '' && $googletrust['eab_kid'] == '' && $googletrust['eab_hmac_key'] == '') {

                    $googletrust = 'not-set'; 

                }



                $dnsSettings = [

                    'doh' => $this->input->post('dns_doh'),

                    'resolver' => $this->input->post('dns_resolver')

                ];



                $status = $this->input->post('status');

                

                $res = $this->acme->set_letsencrypt($letsencrypt);

                $res = $this->acme->set_zerossl($zerossl);

                $res = $this->acme->set_googletrust($googletrust);

                $res = $this->acme->set_dns($dnsSettings);

                $res = $this->acme->set_status($status);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'ACME SSL settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/ssl');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/ssl');

            }

        }

        elseif($this->input->post('update_sitepro'))

        {

            $this->fv->set_rules('hostname', 'Hostname', ['trim', 'required']);

            $this->fv->set_rules('username', 'Username', ['trim', 'required']);

            $this->fv->set_rules('password', 'Password', ['trim', 'required']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $hostname = $this->input->post('hostname');

                $username = $this->input->post('username');

                $password = $this->input->post('password');

                $status = $this->input->post('status');



                $res = $this->sp->set_hostname($hostname);

                $res = $this->sp->set_username($username);

                $res = $this->sp->set_password($password);

                $res = $this->sp->set_status($status);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'SitePro settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/sitepro');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/sitepro');

            }

        }

        elseif($this->input->post('update_github'))

        {

            $this->fv->set_rules('client', 'Client Key', ['trim', 'required']); 

            $this->fv->set_rules('secret', 'Secret Key', ['trim', 'required']);

            $this->fv->set_rules('endpoint', 'Endpoint URL', ['trim', 'required']);

            $this->fv->set_rules('status', 'Status', ['trim', 'required']);



            if($this->fv->run() === true)

            {

                $id = $this->input->post('service');

                $client = $this->input->post('client');

                $secret = $this->input->post('secret');

                $endpoint = $this->input->post('endpoint');

                $status = $this->input->post('status');



                $res = $this->oauth->set_client($id, $client);

                $res = $this->oauth->set_secret($id, $secret);

                $res = $this->oauth->set_endpoint($id, $endpoint);

                $res = $this->oauth->set_status($id, $status);



                if($res !== false)

                {

                    $this->session->set_flashdata('msg', json_encode([1, 'GitHub oauth settings updated successfully.']));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

                }

                redirect('api/settings/oauth');

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                redirect('api/settings/oauth');

            }

        }

        elseif($this->input->get('test_mail'))

        {

            $res = $this->mailer->test_mail();

            if($res)

            {

                $this->session->set_flashdata('msg', json_encode([1, 'Test email sent successfully.']));

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

            }

            redirect('api/settings/smtp');

        }

        elseif($this->input->get('test_mofh'))

        {

            $res = $this->mofh->test_mofh();

            if($res === true)

            {

                $this->session->set_flashdata('msg', json_encode([1, 'MOFH API working successfully.']));

            }

            elseif($res === false)

            {

               $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, $res]));

            }

            redirect('api/settings/mofh');

        }



        // Handle view routing based on URI segment

        $section = $this->uri->segment(3);

        $data['active'] = 'settings';



        // Route to appropriate view based on section

        switch($section) {

            case 'mofh':

                $data['title'] = 'MOFH Settings';

                $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

                $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

                $this->load->view($this->base->get_template().'/page/admin/settings/mofh');

                $this->load->view($this->base->get_template().'/page/includes/admin/footer');

                break;



            case 'smtp':

                $data['title'] = 'SMTP Settings';

                $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

                $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

                $this->load->view($this->base->get_template().'/page/admin/settings/smtp');

                $this->load->view($this->base->get_template().'/page/includes/admin/footer');

                break;



            case 'captcha':

                $data['title'] = 'Captcha Settings';

                $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

                $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

                $this->load->view($this->base->get_template().'/page/admin/settings/captcha');

                $this->load->view($this->base->get_template().'/page/includes/admin/footer');

                break;



            case 'ssl':

                $data['title'] = 'SSL Settings';

                $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

                $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

                $this->load->view($this->base->get_template().'/page/admin/settings/ssl');

                $this->load->view($this->base->get_template().'/page/includes/admin/footer');

                break;



            case 'sitepro':

                $data['title'] = 'SitePro Settings';

                $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

                $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

                $this->load->view($this->base->get_template().'/page/admin/settings/sitepro');

                $this->load->view($this->base->get_template().'/page/includes/admin/footer');

                break;



            case 'oauth':

    $data['title'] = 'OAuth Settings';

    

    // Xử lý form submit

    if($this->input->post('update_oauth')) 

    {

        $provider = $this->input->post('service'); // github, google hoặc facebook

        

        $this->fv->set_rules('client', 'Client ID', ['trim', 'required']);

        $this->fv->set_rules('secret', 'Secret Key', ['trim', 'required']); 

        $this->fv->set_rules('status', 'Status', ['trim', 'required']);



        if($this->fv->run() === true)

        {

            $client = $this->input->post('client');

            $secret = $this->input->post('secret');

            $status = $this->input->post('status');



            // Set endpoint theo provider

            $endpoints = [
            'github' => 'https://api.github.com/user',
            'google' => 'https://www.googleapis.com/oauth2/v2/userinfo',
            'facebook' => 'https://graph.facebook.com/me',
            'discord' => 'https://discord.com/api/users/@me',
            'microsoft' => 'https://graph.microsoft.com/v1.0/me'
        ];



            $res = $this->oauth->set_client($provider, $client);

            $res = $this->oauth->set_secret($provider, $secret);

            $res = $this->oauth->set_endpoint($provider, $endpoints[$provider]);

            $res = $this->oauth->set_status($provider, $status);



            if($res !== false)

            {

                $this->session->set_flashdata('msg', json_encode([1, ucfirst($provider).' OAuth settings updated successfully.']));

            }

            else

            {

                $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

            }

            redirect('api/settings/oauth');

        }

        else 

        {

            $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

            redirect('api/settings/oauth');

        }

    }



    // Load OAuth settings view

    $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

    $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

    $this->load->view($this->base->get_template().'/page/admin/settings/oauth'); 

    $this->load->view($this->base->get_template().'/page/includes/admin/footer');

    break;



            default:

                // Redirect to MOFH settings if no specific section is selected

                redirect('api/settings/mofh');

                break;

        }

    }

    else

    {

        redirect('admin/login');

    }

}



	function dashboard()

	{

		if($this->admin->is_logged())

		{

			$data['title'] = 'Dashboard';

			$data['active'] = 'home';

			$data['ci_clients'] = count($this->user->list_users());

			$data['ci_accounts'] = count($this->account->get_accounts());

			$data['ci_tickets'] = count($this->ticket->get_tickets());

			$data['ci_templates'] = count($this->mailer->get_user_templates());



			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

			$this->load->view($this->base->get_template().'/page/admin/dashboard');

			$this->load->view($this->base->get_template().'/page/includes/admin/footer');

		}

		else

		{

			redirect('admin/login');

		}

	}



function email_templates()

{

    if($this->admin->is_logged())

    {

        // Lấy type từ URL, mặc định là 'user' nếu không có

        $type = $this->input->get('type');

        

        $data['title'] = 'Email Templates';

        $data['active'] = ($type == 'admin') ? 'admin' : 'user';

        

        // Lấy tất cả template 

        $data['list'] = $this->mailer->get_all_templates();

        

        // Load views

        $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

        $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

        $this->load->view($this->base->get_template().'/page/admin/email_templates');

        $this->load->view($this->base->get_template().'/page/includes/admin/footer');

    }

    else

    {

        redirect('admin/login');

    }

}



function edit_email($id)

{

   if($this->admin->is_logged())

   {

       $id = $this->security->xss_clean($id);

       

       // Get type from URL param, default to 'user' if not set

       $type = $this->input->get('type', true) ?: 'user';

       

       if($this->input->post('update'))

       {

           $this->fv->set_rules('subject', 'Subject', ['trim', 'required']);

           $this->fv->set_rules('content', 'Content', ['trim', 'required']);

           

           if($this->fv->run() === true)

           {

               $subject = $this->input->post('subject');

               $content = $this->input->post('content', false);

               

               // Get type from hidden field in form

               $for = $this->input->post('type');

               

               $res = $this->mailer->set_template(

                   [

                       'subject' => $subject,

                       'content' => $content

                   ],

                   $id,

                   $for // Pass type to set_template

               );



               if($res)

               {

                   $this->session->set_flashdata('msg', json_encode([1, 'Email template updated successfully.']));

               }

               else

               {

                   $this->session->set_flashdata('msg', json_encode([0, 'An error occurred. Try again later.']));

               }

               redirect("email/edit/$id?type=$for");

           }

           else

           {

               if(validation_errors() !== '')

               {

                   $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

               }

               else

               {

                   $this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

               }

               redirect("email/edit/$id?type=$type"); 

           }

       }

       else

       {

           // Load template based on ID and type

           $email_template = $this->mailer->get_template($id, $type);

           

           if($email_template === false)

           {

               $this->session->set_flashdata('msg', json_encode([0, 'Template not found']));

               redirect('email/templates?type=' . $type);

           }

           

           $data['title'] = 'Edit ' . ucfirst($type) . ' Email Template';

           $data['active'] = $type; // For highlighting correct tab

           $data['email'] = $email_template;

           

           $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

           $this->load->view($this->base->get_template().'/page/includes/admin/navbar');

           $this->load->view($this->base->get_template().'/page/admin/edit_email');

           $this->load->view($this->base->get_template().'/page/includes/admin/footer');

       }

   }

   else

   {

       redirect('admin/login');

   }

}



	function tickets()

	{

		if($this->admin->is_logged())

		{

			$data['title'] = 'Tickets';

			$data['active'] = 'ticket';

			$count = $this->input->get('page') ?? 0;

			$data['list'] = $this->ticket->get_tickets($count);



			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

			$this->load->view($this->base->get_template().'/page/admin/tickets');

			$this->load->view($this->base->get_template().'/page/includes/admin/footer');

		}

		else

		{

			redirect('admin/login');

		}

	}



	function view_ticket($id)

	{

		if($this->admin->is_logged()){

			$id = $this->security->xss_clean($id);

			if($this->input->get('close'))

			{

				$res = $this->ticket->change_ticket_status($id, 'closed');

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Ticket has been closed successfully.']));

					redirect("admin/ticket/view/$id");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/ticket/view/$id");

				}

			}

			elseif($this->input->get('open'))

			{

				$res = $this->ticket->change_ticket_status($id, 'open');

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Ticket has been opened successfully.']));

					redirect("admin/ticket/view/$id");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/ticket/view/$id");

				}

			}

			elseif($this->input->post('reply'))

			{

				$this->fv->set_rules('content', 'Content', ['trim', 'required']);

				if($this->grc->is_active())

				{

					if($this->grc->get_type() == "google")

					{

						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "crypto")

					{

						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "human")

					{

						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);

					}

					elseif($this->grc->get_type() == "turnstile")

					{

						$this->fv->set_rules('cf-turnstile-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);

					}

					if($this->fv->run() === true)

					{

						$content = $this->input->post('content');

						if($this->grc->get_type() == "google")

						{

							$token = $this->input->post('g-recaptcha-response');

							$type = "google";

						}

						elseif($this->grc->get_type() == "crypto")

						{

							$token = $this->input->post('CRLT-captcha-token');

							$type = "crypto";

						}

						elseif($this->grc->get_type() == "turnstile")

						{

							$token = $this->input->post('cf-turnstile-response');

							$type = "turnstile";

						}

						else

						{

							$token = $this->input->post('h-captcha-response');

							$type = "human";

						}

						if($this->grc->is_valid($token, $type))

						{

							$res = $this->ticket->add_reply($id, $content, $this->admin->get_key(), 'support');

							if($res)

							{

								$this->session->set_flashdata('msg', json_encode([1, 'Ticket reply added successfully.']));

								redirect("admin/ticket/view/$id");

							}

							else

							{

								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

								redirect("admin/ticket/view/$id");

							}

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Invalid captcha response received.']));

							redirect("admin/ticket/view/$id");

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect("admin/ticket/view/$id");

					}

				}

				else

				{

					if($this->fv->run() === true)

					{

						$content = $this->input->post('content');

						$res = $this->ticket->add_reply($id, $content, $this->admin->get_key(), 'support');

						if($res)

						{

							$this->session->set_flashdata('msg', json_encode([1, 'Ticket reply added successfully.']));

							redirect("admin/ticket/view/$id");

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

							redirect("admin/ticket/view/$id");

						}

					}

					else

					{

						if(validation_errors() !== '')

						{

								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

						}

						redirect("admin/ticket/view/$id");

					}

				}

			}

			else

			{

				$data['title'] = 'View Ticket '.$id;

		        $data['id'] = $id;

				$data['active'] = 'ticket';

				$data['ticket'] = $this->ticket->view_ticket($id);

				if($data['ticket'] !== false)

				{

					if ($this->input->get('page')) {

						$count = $this->input->get('page');

					} else {

						$count = 0;

					}

					$data['count'] = $count;

                    

					$data['replies'] = $this->ticket->get_ticket_reply($id, $count);



					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

					$this->load->view($this->base->get_template().'/page/admin/view_ticket');

					$this->load->view($this->base->get_template().'/page/includes/admin/footer');

				}

				else

				{

					redirect('404');

				}

			}

		}

		else

		{

			redirect('admin/login');

		}

	}



	function clients()

	{

		if($this->admin->is_logged())

		{

			$data['title'] = 'Clients';

			$data['active'] = 'client';

			$count = $this->input->get('page') ?? 0;

			$data['list'] = $this->user->list_users($count);



			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

			$this->load->view($this->base->get_template().'/page/admin/clients');

			$this->load->view($this->base->get_template().'/page/includes/admin/footer');

		}

		else

		{

			redirect('admin/login');

		}

	}



	function view_client($id)

	{

		if($this->admin->is_logged()){

			$id = $this->security->xss_clean($id);

			if($this->input->get('active'))

			{

				$res = $this->user->set_status(1, $id);

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Client has been activated successfully.']));

					redirect("client/view/$id");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("client/view/$id");

				}

			}

			elseif($this->input->get('login'))

			{

				$res = $this->user->login_me_as($id);

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));

					redirect("a/");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("client/view/$id");

				}

			}

			else

			{

				$data['title'] = 'View Client '.$id;

				$data['active'] = 'client';

				$data['info'] = $this->user->get_info($id);

				if($data['info'] !== false)

				{

					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

					$this->load->view($this->base->get_template().'/page/admin/view_client');

					$this->load->view($this->base->get_template().'/page/includes/admin/footer');

				}

				else

				{

					redirect('404');

				}

			}

		}

		else

		{

			redirect('admin/login');

		}

	}



	function domains()

	{

		if($this->admin->is_logged()){

			if($this->input->get('add_domain'))

			{

				$res = $this->mofh->add_ext($this->input->get('domain'));

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Domain extension added successfully.']));

					redirect("domain/list");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("domain/list");

				}

			}

			elseif($this->input->get('rm_domain'))

			{

				$res = $this->mofh->rm_ext($this->input->get('domain'));

				if($res)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'Domain extension removed successfully.']));

					redirect("domain/list");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("domain/list");

				}

			}

			else

			{

				$data['title'] = 'Domain Extensions';

				$data['active'] = 'settings';

				$data['list'] = $this->mofh->list_exts();



				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

				$this->load->view($this->base->get_template().'/page/admin/domains');

				$this->load->view($this->base->get_template().'/page/includes/admin/footer');

			}

		}

		else

		{

			redirect('admin/login');

		}

	}



	function accounts()

	{

		if($this->admin->is_logged())

		{

			$data['title'] = 'Accounts';

			$data['active'] = 'account';

			$count = $this->input->get('page') ?? 0;

			$data['list'] = $this->account->get_accounts($count);

			

			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

			$this->load->view($this->base->get_template().'/page/admin/accounts');

			$this->load->view($this->base->get_template().'/page/includes/admin/footer');

		}

		else

		{

			redirect('admin/login');

		}

	}



	function view_account($id)

	{

		if($this->admin->is_logged())

		{

			$id = $this->security->xss_clean($id);

			if($this->input->get('login'))

			{

				$res = $this->account->get_account($id);

				if($res !== false)

				{

					$data['username'] = $res['account_username'];

					$data['password'] = $res['account_password'];

					$this->load->view($this->base->get_template().'/page/admin/cpanel_login', $data);

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/view/$id");

				}

			}

			elseif($this->input->get('builder') AND $this->input->get('domain'))

			{

				$res = $this->account->get_user_account($id);

				if($res !== false)

				{

					$username = $res['account_username'];

					$password = $res['account_password'];

					$domain = $this->input->get('domain');

					if($domain !== $res['account_domain'])

					{

						$dir = '/htdocs/'.$domain;

					}

					else

					{

						$dir = '/htdocs/';

					}

					$link = $this->sp->load_builder_url($username, $password, $domain, $dir);

					if($link === false)

					{

						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

						redirect("admin/account/view/$id");

					}

					elseif($link['success'] == true)

					{

						 header('location: '.$link['url']); 

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, $link['msg']]));

						redirect("admin/account/view/$id");

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/view/$id");

				}

			}

			elseif($this->input->get('reactivate'))

			{

				$res = $this->account->get_account($id);

				if($res !== false)

				{

					if($res['account_status'] === 'suspended' OR $res['account_status'] === 'deactivated')

					{

						$res = $this->mofh->reactivate_account($res['account_key']);

						if(!is_bool($res))

						{

							$this->session->set_flashdata('msg', json_encode([0, $res]));

							redirect("admin/account/view/$id");

						}

						elseif($res !== false)

						{

							$this->session->set_flashdata('msg', json_encode([1, 'Account reactivated successfully.']));

							redirect("admin/account/view/$id");

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

							redirect("admin/account/view/$id");

						}

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'Unable to reactivate account.']));

						redirect("admin/account/view/$id");

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/view/$id");

				}

			}

			else

			{

				$data['title'] = 'View Account';

				$data['active'] = 'account';

				$data['id'] = $id;

				$data['data'] = $this->account->get_account($id);

				if($data['data'] !== false)

				{

					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

					$this->load->view($this->base->get_template().'/page/admin/view_account');

					$this->load->view($this->base->get_template().'/page/includes/admin/footer');

				}

				else

				{

					redirect('404');

				}

			}

		}

		else

		{

			redirect('admin/login');

		}

	}



	function account_settings($id)

	{

		if($this->admin->is_logged())

		{

			$id = $this->security->xss_clean($id);

			if($this->input->post('update_label'))

			{

				$res = $this->account->get_account($id);

				if($res !== false)

				{

					$res = $this->account->set_label($id, $this->input->post('label'));

					if($res !== false)

					{

						$this->session->set_flashdata('msg', json_encode([1, 'Account label updated successfully.']));

						redirect("admin/account/settings/$id");

					}

						else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

						redirect("admin/account/settings/$id");

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/settings/$id");

				}

			}

			elseif($this->input->post('update_password'))

			{

				$res = $this->account->get_account($id);

				if($res !== false)

				{

					if(strlen($this->input->post('password')) > 4 AND strlen($this->input->post('old_password')) > 4)

					{

						$res = $this->account->change_account_password($id, $this->input->post('password'), $this->input->post('old_password'));

						if(!is_bool($res))

						{

							$this->session->set_flashdata('msg', json_encode([0, $res]));

							redirect("a/view_settings/$id");

						}

						elseif($res !== false)

						{

							$this->session->set_flashdata('msg', json_encode([1, 'Account password updated successfully.']));

							redirect("admin/account/settings/$id");

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

							redirect("admin/account/settings/$id");

						}

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));

							redirect("admin/account/settings/$id");

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/settings/$id");

				}

			}

			elseif($this->input->post('deactivate'))

			{

				$res = $this->account->get_account($id);

				if($res !== false)

				{

					if($res['account_status'] === 'active')

					{

						$res = $this->mofh->deactivate_account($res['account_key'], $this->input->post('reason'));

						if(!is_bool($res))

						{

							$this->session->set_flashdata('msg', json_encode([0, $res]));

							redirect("admin/account/settings/$id");

						}

						elseif($res !== false)

						{

							$this->session->set_flashdata('msg', json_encode([1, 'Account deactivated successfully.']));

							redirect("a/accounts");

						}

						else

						{

							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

							redirect("admin/account/settings/$id");

						}

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));

							redirect("admin/account/settings/$id");

					}

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/account/settings/$id");

				}

			}

			else

			{

				$data['title'] = 'Account Settings';

				$data['active'] = 'account';

				$data['id'] = $id;

				$data['data'] = $this->account->get_account($id);

				if($data['data'] !== false)

				{

					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

					$this->load->view($this->base->get_template().'/page/admin/account_settings');

					$this->load->view($this->base->get_template().'/page/includes/admin/footer');

				}

				else

				{

					redirect('404');

				}

			}

		}

		else

		{

			redirect('admin/login');

		}

	}

	

	function ssl()

	{

		if($this->admin->is_logged())

		{

			$data['title'] = 'SSL Certificates';

			$data['active'] = 'ssl';

			$count = $this->input->get('page') ?? 0;

			$data['list'] = $this->acme->get_ssl_list_all($count);

			

			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

			$this->load->view($this->base->get_template().'/page/admin/ssl');

			$this->load->view($this->base->get_template().'/page/includes/admin/footer');

		}

		else

		{

			redirect('admin/login');

		}

	}



	function view_ssl($id)

	{

		if($this->admin->is_logged())

		{

			$id = $this->security->xss_clean($id);

			if($this->input->get('delete'))

			{

				if ($this->ssl->get_ssl_type($id) != 'gogetssl') {

				}

				$this->db->where(['ssl_key' => $id]);

				$res = $this->db->delete('is_ssl');

				if($res !== false)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'SSL certificate deleted successfully.']));

					redirect("admin/ssl/list");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/ssl/view/$id");

				}

			}

			elseif($this->input->get('cancel'))

			{

				$ssl_type = $this->ssl->get_ssl_type($id);

				if ($ssl_type == 'gogetssl') {

					$res = $this->ssl->cancel_ssl($id, 'Some Reason');

				} else {

					$res = $this->acme->initilize($ssl_type, $id);

					if(!is_bool($res))

					{

						$this->session->set_flashdata('msg', json_encode([0, $res]));

						redirect("ssl/view/$id");

					}

					elseif(is_bool($res) AND $res == true)

					{

						$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ssl_cancelled_msg', 'success')]));

						redirect("ssl/view/$id");

					}

					else

					{

						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));

						redirect("ssl/view/$id");

					}

					$res = $this->acme->cancel_ssl($id, 'Some Reason');

				}

				if(!is_bool($res))

				{

					$this->session->set_flashdata('msg', json_encode([0, $res]));

					redirect("admin/ssl/view/$id");

				}

				if(is_bool($res) AND $res == true)

				{

					$this->session->set_flashdata('msg', json_encode([1, 'SSL certificate cancelled successfully.']));

					redirect("admin/ssl/view/$id");

				}

				else

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/ssl/view/$id");

				}

			}

			else

			{

				$data['title'] = 'View SSL';

				$data['active'] = 'ssl';

				$data['id'] = $id;



				$ssl_type = $this->ssl->get_ssl_type($id);

				if ($ssl_type == 'gogetssl') {

					$data['data'] = $this->ssl->get_ssl_info($id);

				} else {

					$data['data'] = $this->acme->get_ssl_info($id);

				}

				if($data['data'] !== false)

				{

					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);

					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');

					$this->load->view($this->base->get_template().'/page/admin/view_ssl');

					$this->load->view($this->base->get_template().'/page/includes/admin/footer');

				}

				elseif ($data['data'] == False)

				{

					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

					redirect("admin/ssl/list");

				} else

				{

					$this->session->set_flashdata('msg', json_encode([0, $data['data']]));

					redirect("admin/ssl/list");

				}

			}

		}

		else

		{

			redirect('admin/login');

		}

	}

	function reset_password($token = '')

{

    if(!$this->admin->is_logged())

    {

        // Validate token và lấy email

        $email = $this->admin->validate_reset_token($token);

        

        if($email === false)

        {

            $this->session->set_flashdata('msg', json_encode([0, 'Password reset token expired.']));

            redirect('admin/login');

        }



        if($this->input->post('reset'))

        {

            $this->fv->set_rules('password', 'Password', ['trim', 'required']);

            $this->fv->set_rules('password1', 'Confirm Password', ['trim', 'required', 'matches[password]']);

            

            if($this->fv->run() === true)

            {

                $password = $this->input->post('password');

                $res = $this->admin->reset_admin_password($password, $email);

                

                if($res !== false)

                {

                    // Xóa session data sau khi reset thành công

                    $this->session->unset_userdata('admin_reset_data');

                    

                    $this->session->set_flashdata('msg', json_encode([1, 'Password reset successfully.']));

                    redirect('admin/login');

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));

                    redirect('admin/login');

                }

            }

            else

            {

                if(validation_errors() !== '')

                {

                    $this->session->set_flashdata('msg', json_encode([0, validation_errors()]));

                }

                else

                {

                    $this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));

                }

                redirect('admin/login');

            }

        }

        else

        {

            $data['title'] = 'Reset Password';

            $data['token'] = $token;

            

            $this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);

            $this->load->view($this->base->get_template().'/form/admin/reset_password.php');

            $this->load->view($this->base->get_template().'/form/includes/admin/footer.php');

        }

    }

    else

    {

        redirect('admin');

    }

}
  
public function html_content() {
        if(!$this->admin->is_logged()) {
            redirect('admin/login');
            return;
        }

        $data['title'] = 'Manage HTML Content';
        $data['active'] = 'html';
        
        // Load list of HTML contents
        $this->load->model('html_content');
        $data['contents'] = $this->html_content->get_all();
        
        // Load views
        $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
        $this->load->view($this->base->get_template().'/page/includes/admin/navbar');
        $this->load->view($this->base->get_template().'/page/admin/html_content');
        $this->load->view($this->base->get_template().'/page/includes/admin/footer');
    }

public function edit_html($id = null) {
    if(!$this->admin->is_logged()) {
        redirect('admin/login');
    }
    
    $this->load->model('html_content');
    
    // Nếu là form submit
    if($this->input->post('submit')) {
        $data = [
            'name' => $this->input->post('name'),
            'content' => $this->input->post('content', false) // false để không HTML escape
        ];
        
        // Xử lý save/update
        if($id) {
            $res = $this->html_content->update($id, $data);
        } else {
            $res = $this->html_content->create($data);
        }
        
        if($res) {
            $this->session->set_flashdata('msg', json_encode([1, 'Content saved successfully']));
            redirect('admin/html');
        } else {
            $this->session->set_flashdata('msg', json_encode([0, 'Failed to save content']));
            redirect('admin/html/edit/' . ($id ? $id : ''));
        }
        return;
    }

    // Load view
    $data['title'] = $id ? 'Edit HTML Content' : 'Add HTML Content';
    $data['active'] = 'html';
    $data['content'] = $id ? $this->html_content->get($id) : null;
    
    $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
    $this->load->view($this->base->get_template().'/page/includes/admin/navbar');
    $this->load->view($this->base->get_template().'/page/admin/edit_html');
    $this->load->view($this->base->get_template().'/page/includes/admin/footer');
}

    public function set_active_html($id) {
        if(!$this->admin->is_logged()) {
            redirect('admin/login');
            return;
        }

        $this->load->model('html_content');
        $res = $this->html_content->set_active($id);
        
        if($res) {
            $this->session->set_flashdata('msg', json_encode([1, 'HTML content set as active successfully']));
        } else {
            $this->session->set_flashdata('msg', json_encode([0, 'Failed to update active status']));
        }
        
        redirect('admin/html');
    }

    public function delete_html($id) {
        if(!$this->admin->is_logged()) {
            redirect('admin/login');
            return;
        }

        $this->load->model('html_content');
        // Check if content is active
        $content = $this->html_content->get($id);
        if($content && $content->is_active) {
            $this->session->set_flashdata('msg', json_encode([0, 'Cannot delete active content. Please set another content as active first.']));
            redirect('admin/html');
            return;
        }

        $res = $this->html_content->delete($id);
        
        if($res) {
            $this->session->set_flashdata('msg', json_encode([1, 'HTML content deleted successfully']));
        } else {
            $this->session->set_flashdata('msg', json_encode([0, 'Failed to delete content']));
        }
        
        redirect('admin/html');
    }

  public function set_inactive_html($id) {
    if(!$this->admin->is_logged()) {
        redirect('admin/login');
        return;
    }

    $this->load->model('html_content');
    
    // Check if there's another active content
    $active_contents = $this->html_content->count_active();
    if($active_contents <= 1) {
        $this->session->set_flashdata('msg', json_encode([0, 'Cannot deactivate. At least one content must be active. Please set another content active first.']));
        redirect('admin/html');
        return;
    }

    // Set content to inactive
    $res = $this->html_content->set_inactive($id);
    
    if($res) {
        $this->session->set_flashdata('msg', json_encode([1, 'HTML content set as inactive successfully']));
    } else {
        $this->session->set_flashdata('msg', json_encode([0, 'Failed to update status']));
    }
    
    redirect('admin/html');
}
  
  // Add these functions to Admin controller

function ads() {
    if(!$this->admin->is_logged()) {
        redirect('admin/login');
        return;
    }
    
    $data['title'] = 'Manage Ads';
    $data['active'] = 'ads';
    
    // Load ads model
    $this->load->model('ads');
    $data['ads'] = $this->ads->get_all();
    
    // Load views
    $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
    $this->load->view($this->base->get_template().'/page/includes/admin/navbar');
    $this->load->view($this->base->get_template().'/page/admin/ads');
    $this->load->view($this->base->get_template().'/page/includes/admin/footer');
}

function edit_ad($id = null) {
    if(!$this->admin->is_logged()) {
        redirect('admin/login');
        return;
    }
    
    $this->load->model('ads');
    
    // Handle form submission
    if($this->input->post('submit')) {
        $data = [
            'name' => $this->input->post('name'),
            'content' => $this->input->post('content'), 
            'placement' => $this->input->post('placement'),
            'status' => $this->input->post('status')
        ];
        
        if($id) {
            $res = $this->ads->update($id, $data);
            $msg = 'Ad updated successfully';
        } else {
            $res = $this->ads->create($data);
            $msg = 'Ad created successfully';
        }
        
        if($res) {
            $this->session->set_flashdata('msg', json_encode([1, $msg]));
            redirect('admin/ads');
        } else {
            $this->session->set_flashdata('msg', json_encode([0, 'Failed to save ad']));
            redirect('admin/edit_ad/'.($id ? $id : ''));
        }
        return;
    }
    
    // Load view
    $data['title'] = $id ? 'Edit Ad' : 'Add New Ad';
    $data['active'] = 'ads';
    $data['ad'] = $id ? $this->ads->get($id) : null;
    
    $this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
    $this->load->view($this->base->get_template().'/page/includes/admin/navbar');
    $this->load->view($this->base->get_template().'/page/admin/edit_ad');
    $this->load->view($this->base->get_template().'/page/includes/admin/footer');
}

function delete_ad($id) {
    if(!$this->admin->is_logged()) {
        redirect('admin/login');
        return;
    }

    $this->load->model('ads');
    $res = $this->ads->delete($id);
    
    if($res) {
        $this->session->set_flashdata('msg', json_encode([1, 'Ad deleted successfully']));
    } else {
        $this->session->set_flashdata('msg', json_encode([0, 'Failed to delete ad']));
    }
    
    redirect('admin/ads');
}
  
}



?>

