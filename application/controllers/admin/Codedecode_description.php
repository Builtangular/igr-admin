<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Codedecode_description extends CI_Controller {    
	public function __construct(){
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Codedecode_model');
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
			$data['title'] = "Codedecode Description Master";
			$data['list_data'] = $this->Codedecode_model->get_codedecode_description();
			$this->load->view("admin/codedecode_description/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['get_codedecode_description'] = $this->Codedecode_model->get_codedecode_type_data();
			$this->load->view("admin/codedecode_description/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    public function insert(){
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$codedecode_type= $this->Codedecode_model->get_codedecode_type_data();
			$data['type_id'] = $codedecode_type->type_id;
			$type_id= $this->input->post('type_id');
			$result = $this->Codedecode_model->insert_codedecode_description();
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/codedecode_description');
	 	}else{
			$this->load->view("admin/login");
		}
	}
   	public function edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
			$data['single_codedecode_description'] = $this->Codedecode_model->get_single_codedecode_description($id);
			$data['code_type'] = $this->Codedecode_model->get_codedecode_type_data();
			$this->load->view("admin/codedecode_description/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
	public function update_codedecode_description(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$id = $this->input->post('id');
			$this->Codedecode_model->update_codedecode_description($id);
			$data['single_codedecode_des'] = $this->Codedecode_model->get_single_codedecode_decs($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/codedecode_description');
		}else{
			$this->load->view("admin/login");
			
		}
	}
	function codedecode_description_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['delete'] = $this->Codedecode_model->codedecode_description_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/codedecode_description');
		}else{
			$this->load->view("admin/login");
			
		}
	}
  
        

}  
    
?>