<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {   
    
     public function __construct() 
     {
           parent::__construct(); 
           $this->load->database();
		   // $this->admindb=$this->load->database('admindb', TRUE);
     }
	function login($username,$password)
    {	
		$this->db->select('*');
		$this->db->from('tbl_user_login_details as ULD');
		$this->db->join('tbl_registered_user_details as RUD', 'RUD.id = ULD.user_id');
		$this->db->where(array('ULD.Active_flag' => '1','ULD.User_email_id' => $username, 'ULD.Login_password' => $password));		
		$login_sql = $this->db->get();		
		// echo"----".$this->db->last_query();	
		// die;
		// $login_sql = $this->db->query($login_query);		
		if($login_sql -> num_rows() == 1)
		{
			//return $login_sql->result_array();
			$login_result = $login_sql->result_array();	
			// var_dump($login_result);
			// die;			
			foreach($login_result as $login_row)
			{
				$enroll = $login_row['log_id'];
				$userId = $login_row['user_id'];
				$Role_id = $login_row['role_id'];
				$login_user_name = $login_row['Login_user_name'];
			}
			// echo"---enroll----".$enroll;
			// die;			
			$flag=$Role_id;
			$update_data=array('description' => '0');
			$this->db->where('userName', $username);
			$this->db->update("tbl_session_tbl", $update_data);
			
			// date_default_timezone_set($timezone_entry);
			$starttime = date('Y-m-d H:i:s', time());
			$ip = $this->get_ip_address();		
			$desc = '1';	
			
			$insert_data=array('userName' => $username, 'enrollId' => $enroll, 'userId' => $userId, 'startTime' => $starttime, 
								'clientIp' => $ip, 'description' => $desc, 'notes' => $flag);
			$this->db->insert('tbl_session_tbl', $insert_data);
			//var_dump($insert_data);die;
			return  $login_result; //$login_sql->result_array();
		}
		else
		{
			return false;
		}		    
    }
	function get_ip_address() 
	{
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) 
		{
			if (array_key_exists($key, $_SERVER) === true) 
			{
				foreach (explode(',', $_SERVER[$key]) as $ip) 
				{
					if (filter_var($ip, FILTER_VALIDATE_IP) !== false) 
					{
						return $ip;
					}
				}
			}
		}
	}
	
}
?>
