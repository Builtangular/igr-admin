<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Dashboard extends CI_Controller 
{    
	// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
    public function index()
	{	
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	
			// var_dump($data['Role_id']); die;
            $data['global_count'] = $this->Data_model->count_global_report();
			$data['country_count'] = $this->Data_model->count_country_report();
            $data['region_count'] = $this->Data_model->count_region_report();
            $data['info_count'] = $this->Data_model->count_infographics_report();
		    $this->load->view("admin/dashboard",$data);
        }else{
            $this->load->view("admin/login");
        }
		
	}
	function scope()
	{	
        if($this->session->userdata('logged_in')){
        $session_data = $this->session->userdata('logged_in');
		$data['title'] = "Scope Master";
		$data['list_data'] = $this->Data_model->get_scope_master();
		//print_r($data);exit();
		$this->load->view("admin/scope/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function scope_register()
	{	
		$this->load->view("admin/scope/register", $data);
        
	}
}
?>