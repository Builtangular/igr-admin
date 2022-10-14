<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Company extends CI_Controller 
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
	public function index($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['report_id']=$id;	
			$data['Companies']= $this->Data_Model->get_rd_companies($id);
			$this->load->view('admin/company/list',$data);			
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
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Companies']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/company/add',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function insert()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Companies']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/company/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function edit()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Companies']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/company/edit',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function update()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Companies']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/company/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function delete()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Companies']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/company/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
}
?>