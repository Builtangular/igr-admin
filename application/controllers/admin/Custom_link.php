<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Custom_link extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/customlink_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
    public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['id'] = $this->input->post('id');
			$report_id = $this->input->post('report_id');
			$data['custom_list']= $this->customlink_model->get_customlink_data();
			// var_dump($data['custom_list']);die;
			$data['report_id'] = $this->input->post('report_id');
			// var_dump($data['report_id']); die;
			$this->load->view('admin/custom_link/list', $data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			// var_dump($data['custom_list']); die;
			$this->load->view('admin/custom_link/add', $data);			
		}else{			
			$this->load->view('admin/login');
		}
		
	}
    function insert_custom_link(){
        if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$result = $this->customlink_model->insert_customlink_data();
			if($result == 1)
			{
				$this->session->set_flashdata('success_code', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/custom_link');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
    function edit($id){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			// var_dump($data['get_custom_data']);die;
			$data['single_custom_data'] = $this->customlink_model->get_single_custom_data($id);
            // var_dump($data['single_custom_data']);die;
			$this->load->view("admin/custom_link/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
    }
	function update_custom_link(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$id = $this->input->post('id');
			// var_dump($id);die;
			$this->customlink_model->update_custom_link($id);
			$this->session->set_flashdata('success_code', 'Data has been updated successfully....!!!');
			redirect('admin/custom_link');
		}else {
			$this->load->view("admin/login");
		}
    }
	function delete($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['delete'] = $this->customlink_model->custom_link_delete($id);
			$this->session->set_flashdata('success_code', 'Data has been delete successfully....!!!');
			redirect('admin/custom_link');
		}else{
			$this->load->view("admin/login");
		}
	}
	
	
	
	
}
?>