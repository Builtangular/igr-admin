<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Analyst_Report extends CI_Controller 
{    
	public function __construct()
	{		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	/* Analyst work process */
	public function analyst_published_rd(){
        // var_dump($this->session->userdata('logged_in')); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
            // var_dump($session_data['Login_user_name']); die;
			$status = 3;
			$data['Global_Rds']= $this->Data_model->get_global_published_rds($status);
			// var_dump($data['Global_Rds']); die;
			$this->load->view('admin/report/published_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}	

	}
	public function analyst_processed_rd(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$status = 1;
			$data['Global_Rds']= $this->Data_model->get_global_analyst_rds($status);
			$this->load->view('admin/report/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}	
	}
}
?>