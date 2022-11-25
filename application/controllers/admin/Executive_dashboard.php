<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);ini_set('display_errors', 0);  ini_set('display_errors', 0);  

class Executive_dashboard extends CI_Controller 
{    
	// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
		$this->load->model('admin/Executive_dashboard_model');
	}
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $data['global_count'] = $this->Executive_dashboard_model->count_global_report();
            $data['country_count'] = $this->Executive_dashboard_model->count_country_report();
            $data['region_count'] = $this->Executive_dashboard_model->count_region_report();
            $data['info_count'] = $this->Executive_dashboard_model->count_infographics_report();      
			$this->load->view('admin/executive_dashboard',$data);			
		}
		else
		{			
			$this->load->view('admin/login');
		}
	}
   
	
	 
	
}
?>