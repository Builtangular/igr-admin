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
        $data = $this->session->userdata('logged_in');
		$data['massage'] = $this->session->userdata('msg');
		$data['title'] = "Codedecode Description Master";
		$data['list_data'] = $this->Codedecode_model->get_codedecode_description();
		//print_r($data);exit();
		$this->load->view("admin/codedecode_description/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add(){
		if($this->session->userdata('logged_in')){
		$data = $this->session->userdata('logged_in');
		$data['get_codedecode_description'] = $this->Codedecode_model->get_codedecode_type_data();
		$this->load->view("admin/codedecode_description/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    public function insert(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
	 	{
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
			$data = $this->session->userdata('logged_in');
			// 
			// $data['single_codedecode_des'] = $this->Codedecode_model->get_single_codedecode_decs($id);
			$data['single_codedecode_description'] = $this->Codedecode_model->get_single_codedecode_description($id);
			$data['code_type'] = $this->Codedecode_model->get_codedecode_type_data();
			// var_dump($data['code_type']);die;
			$this->load->view("admin/codedecode_description/edit",$data);
		}else{
			$this->load->view("admin/login");
			
		}
    }
	public function update_codedecode_description(){
		$id = $this->input->post('id');
		$this->Codedecode_model->update_codedecode_description($id);
		$data['single_codedecode_des'] = $this->Codedecode_model->get_single_codedecode_decs($id);
		$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
		redirect('admin/codedecode_description');
		
	}
	function codedecode_description_delete($id){
		//var_dump($id);die;
		$data['delete'] = $this->Codedecode_model->codedecode_description_delete($id);
		$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
		redirect('admin/codedecode_description');
	}
  
        

}  
    
?>