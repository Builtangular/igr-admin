<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Category extends CI_Controller {    
	public function __construct(){
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Category_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	public function index(){	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "Category Master";
			$data['list_category'] = $this->Category_model->get_category_master();
			//print_r($data);exit();
			$this->load->view("admin/category/list", $data);
		}else{
            $this->load->view("admin/login");
        }
	}
    public function add() {
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$data['get_category_data'] = $this->Category_model->get_category_master();
			$this->load->view("admin/category/add",$data);
        }else{
             $this->load->view("admin/login");
        }
    }
    public function insert_category(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$result = $this->Category_model->insert_category_record();
			//var_dump($result);die;
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully...!!!');
			}	
            redirect('admin/category');
		}else{
			$this->load->view("admin/login");
		}
	}
    public function edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$data['get_category_data'] = $this->Category_model->get_category_master();
			$data['single_category_data'] = $this->Category_model->get_single_category_data($id);
			$this->load->view("admin/category/edit",$data);
		}else{
			$this->load->view("admin/login");
		}
    }
    public function update_category(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$id = $this->input->post('id');
			$this->Category_model->update_category($id);
			$data['parent'] = $this->Category_model->get_single_parent($id);
			$this->session->set_flashdata('msg','Data has been updated successfully');
			redirect('admin/category');
		}else{
			$this->load->view("admin/login");
		}
	}
    function category_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	

			$data['delete'] = $this->Category_model->category_delete($id);
			$this->session->set_flashdata('msg','Data has been deleted successfully');
			redirect('admin/category');
		}else{
			$this->load->view("admin/login");
		}
	}


}  
    
?>