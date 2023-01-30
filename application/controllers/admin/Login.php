<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Login extends CI_Controller 
{    
	// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Login_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	public function index()
	{	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $this->form_validation->set_rules('username', 'username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
		if($this->form_validation->run() == FALSE)
        {
            $data['msg'] = "Welcome";
            $this->load->view('admin/login', $data);
        }
		else
        {			
			$sess_array = array();
			$result = $this->Login_model->login($this->input->post('username'),$this->input->post('password'));
			/* var_dump($result);
			die; */
			if($result > 0)
			{	
				foreach($result as $row)
				{
					$sess_array = array(
					'log_id' => $row['log_id'],
					'userid' => $row['user_id'],
					'Role_id' => $row['Role_id'],
					'User_email_id' => $row['User_email_id'],
					'Login_user_name'=> $row['Login_user_name'],
					'Active_flag'=> $row['Active_flag'],
					'Full_name'=> $row['Full_name'],
					'logged_in' => TRUE
					);	
					// var_dump($sess_array);die;			
					$this->session->set_userdata('logged_in', $sess_array);
				}
				$session_data = $this->session->userdata('logged_in');
				if($session_data['Role_id']==1)
				{
					redirect('admin/dashboard');			
				}
				else if($session_data['Role_id']==2)
				{
					redirect('admin/dashboard');			
				}else if($session_data['Role_id']==3)
				{
					redirect('admin/dashboard');			
				}else if($session_data['Role_id']==4)
				{
					// var_dump($_POST);die;
					redirect('admin/dashboard');			
				}
				else if($session_data['Role_id']==5){
					redirect('admin/dashboard');
				}else if($session_data['Role_id']==6){
					redirect('admin/dashboard');
				}else if($session_data['Role_id']==7){
					redirect('admin/dashboard');
				}								
			}
			else
			{							
				/////////// If Auth. is fail //////
				// $data['message'] = "<font class='error'>Invalid username or password..!!</font>";
				// $this->session->set_flashdata("error_code","Invalid username or password..!!");	
				$data['msg'] = "<code>Invalid username or password.</code>";
				$this->load->view('admin/login', $data);			
				// $this->load->view('admin/login',$data);				
			}
        }	
	}
	
	public function logout()
	{
		$this->session->unset_userdata('logged_in');   
		redirect('admin/login', 'refresh');
	}	

}

?>