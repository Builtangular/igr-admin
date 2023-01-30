<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Scope extends CI_Controller 
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
	function index()
	{	
        if($this->session->userdata('logged_in')){
			$data = $this->session->userdata('logged_in');
			$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "Scope Master";
			$data['list_data'] = $this->Data_model->get_scope_master_data();
			$this->load->view("admin/scope/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add()
	{
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['get_scope_data'] = $this->Data_model->get_scope_master();
			$this->load->view("admin/scope/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    public function insert_scope()
	{
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$result = $this->Data_model->insert_scope_record();
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/scope');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}

   
    public function edit($id)
    {
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['get_scope_data'] = $this->Data_model->get_scope_master();
			$data['single_scope_data'] = $this->Data_model->get_single_scope_data($id);
			$this->load->view("admin/scope/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
	public function update_scope()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$id = $this->input->post('id');
			$this->Data_model->update_scope($id);
			$data['parent'] = $this->Data_model->get_single_parent($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/scope');
		}else{
			$this->load->view("admin/login");			
		}
	}
	function scope_delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['delete'] = $this->Data_model->scope_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/scope');
		}else{
			$this->load->view("admin/login");			
		}
	}
}  
    
?>