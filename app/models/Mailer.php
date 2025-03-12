<?php 

class Mailer extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('smtp');
		$this->load->library('email');
 	    $this->load->model('base');
        $crypto = $this->smtp->get_encryption();
        if ($crypto === 'none') {
            $crypto = '';
        } elseif ($crypto == 'tls') {
            $email['starttls'] = true;
        }

        $email = [
            'protocol' => 'smtp',
            'smtp_host' => $this->smtp->get_hostname(),
            'smtp_timeout' => 4,
            'charset' => 'utf-8',
            'smtp_user' => $this->smtp->get_username(),
            'smtp_pass' => $this->smtp->get_password(),
            'smtp_port' => $this->smtp->get_port(),
            'smtp_crypto' => $crypto,
            'mailtype' => 'html',
            'newline' => "\r\n"
        ];

		$this->email->initialize($email);
	}

	function is_active()
	{
		return $this->smtp->is_active();
	}

function get_template($id, $for) 
{
    $this->db->select('*');
    $this->db->from('is_email');
    $this->db->where('email_id', $id);
    $this->db->where('email_for', $for);
    $query = $this->db->get();
    
    return ($query->num_rows() > 0) ? $query->row_array() : false;
}


	function send($id, $email, $array, $for = 'user')
	{
		$res = $this->get_template($id, $for);
		if($res !== false)
		{
			$subject = $res['email_subject'].' - '.$this->base->get_hostname();
			$content = $res['email_content'];
			$content = str_replace("{site_name}", $this->base->get_hostname(), $content);
			$content = str_replace("{site_url}", base_url(), $content);
			foreach(array_keys($array) as $key)
			{
				$subject = str_replace("{".$key."}", $array[$key], $subject);
				$content = str_replace("{".$key."}", $array[$key], $content);
			}
			$this->email->from($this->smtp->get_from(), $this->smtp->get_name());
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($content);
			$res = $this->email->send();
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function test_mail()
	{
		$this->email->from($this->smtp->get_from(), $this->smtp->get_name());
		$this->email->to($this->base->get_email());
		$this->email->subject('Test Email');
		$this->email->message('If you have received this email thats mean smtp config is setup correctly.');
		$res = $this->email->send();
		if($res !== false)
		{
			return true;
		}
		return false;
	}
function get_user_templates()
{
    $this->db->where('email_for', 'user');
    $query = $this->db->get('is_email');
    
    if($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}

function get_admin_templates() 
{
    $this->db->where('email_for', 'admin');
    $query = $this->db->get('is_email'); 
    
    if($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}

function get_all_templates()
{
    $query = $this->db->get('is_email');
    if($query->num_rows() > 0) {
        return $query->result_array(); 
    }
    return false;
}
function set_template($data, $id, $for)
{
    $res = $this->db->where('email_id', $id)
                    ->where('email_for', $for)
                    ->update('is_email', [
                        'email_subject' => $data['subject'],
                        'email_content' => $data['content']
                    ]);
    
    if($res !== false)
    {
        return true;
    }
    return false;
}
	private function update($data, $where)
	{
		$res = $this->base->update(
			$data,
			$where,
			'is_email',
			'email_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch($where, $one = true)
	{
		$res = $this->base->fetch(
			'is_email',
			$where,
			'email_'
		);
		if($one !== true)
		{
			return $res;
		}
		else
		{
			if(count($res) > 0)
			{
				return $res[0];
			}
			return false;
		}
	}
	function fetch_template($id)
{
    $res = $this->base->fetch(
        'is_email', 
        ['email_id' => $id],
        ''
    );
    if(count($res) > 0)
    {
        return $res[0];
    }
    return false;
}
}

?>
