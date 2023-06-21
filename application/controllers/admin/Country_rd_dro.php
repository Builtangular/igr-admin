<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country_rd_dro extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');
        $this->load->model('admin/Country_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	function index($report_id){	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

        	$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "Category Master";
			$data['report_id'] = $report_id;
			$data['list_data'] = $this->Country_model->get_rd_dro_data($report_id);
			$this->load->view("admin/country_rd/dro/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add($report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['get_dro_type'] = $this->Country_model->get_dro_type();
			$data['report_id'] = $report_id;
			$this->load->view("admin/country_rd/dro/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    function insert($report_id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];

			$result = $this->Country_model->insert_rd_dro_records($report_id);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/country_rd_dro/'.$report_id);
	 	}
		else
		{
			$this->load->view("admin/login");
		}
    }
   	public function edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['get_dro_type'] = $this->Country_model->get_dro_type();
			$data['single_dro'] = $this->Country_model->get_rd_single_dro($id);
			$this->load->view("admin/country_rd/dro/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
	public function update($report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$id = $this->input->post('id');
			$this->Country_model->update_rd_single_dro($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/country_rd_dro/'.$report_id);
		}else{
			$this->load->view("admin/login");			
		}
    }
	function delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$report_id = $this->input->post('report_id');
			$data['delete'] = $this->Country_model->delete_rd_dro_data($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/country_rd_dro/'.$report_id);
		}else{
			$this->load->view("admin/login");			
		}
	}

}  
    
?>