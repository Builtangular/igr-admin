<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Report extends CI_Controller 
{    
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_Model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Global_Rds']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/report/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Global_Rds']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/report/add',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	
}
?>