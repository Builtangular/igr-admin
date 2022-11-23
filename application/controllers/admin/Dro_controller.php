<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Dro_controller extends CI_Controller 
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
	function index($id)
	{	
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
            
            $data['massage'] = $this->session->userdata('msg');
            $data['report_id']=$id;	
            $data['dro_data'] = $this->Data_model->get_rd_dro_data($id);
            // var_dump($data['dro_data']); die;
            $this->load->view("admin/dro/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add()
	{
		if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['report_id']=$id;	
		    $this->load->view("admin/dro/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    public function insert_scope()
	{
		//var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
	 	{
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
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
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	

			$data['get_scope_data'] = $this->Data_model->get_scope_master();
			$data['single_scope_data'] = $this->Data_model->get_single_scope_data($id);
			$this->load->view("admin/dro/edit",$data);
		}else
		{
			$this->load->view("admin/login");			
		}
    }
	public function update_scope()
	{
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
            $data['Login_user_name']=$session_data['Login_user_name'];	

            $id = $this->input->post('id');
            $this->Data_model->update_scope($id);
            $data['parent'] = $this->Data_model->get_single_parent($id);
            $this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
            redirect('admin/scope');
        }else
        {
            $this->load->view("admin/login");            
        }		
	}
	function scope_delete($id)
	{
        $session_data = $this->session->userdata('logged_in');
        $data['success_code'] = $this->session->userdata('success_code');
        $data['Login_user_name']=$session_data['Login_user_name'];	

		$data['delete'] = $this->Data_model->scope_delete($id);
		$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
		redirect('admin/scope');
	}
}  
    
?>