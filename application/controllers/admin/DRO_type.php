<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Dro_type extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Drotype_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
	}
	function index(){	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "DRO Type Master";
			$data['list_data'] = $this->Drotype_model->get_dro_type();
			$this->load->view("admin/dro_type/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['get_dro_type'] = $this->Drotype_model->get_dro_type();
			$this->load->view("admin/dro_type/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    function insert_dro_type(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$result = $this->Drotype_model->insert_dro_type_record();
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/dro_type');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
	function edit($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['get_dro_type'] = $this->Drotype_model->get_dro_type();
			$data['single_dro_type'] = $this->Drotype_model->get_single_dro_type($id);
			$this->load->view("admin/dro_type/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
    }
    function update_dro_type(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$this->Drotype_model->update_dro_type($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/dro_type');
		}else {
			$this->load->view("admin/login");
		}
    }
    function dro_type_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['delete'] = $this->Drotype_model->dro_type_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/dro_type');
		}else {
			$this->load->view("admin/login");
		}
	}
 
}  
    
?>