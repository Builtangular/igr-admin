<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class PR2_reports extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/pr2_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
	}
	function index($report_id)
	{	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "Category Master";
			$data['report_id'] = $report_id;
			$data['list_data'] = $this->pr2_model->get_rd_pr2_data($report_id);
			$this->load->view("admin/pr2_reports/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	
	function add($report_id)
	{
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['report_id'] = $report_id;
			$this->load->view("admin/pr2_reports/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    function insert($report_id)
    {
        if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$result = $this->pr2_model->insert_rd_pr2_records($report_id);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			else{
				$this->session->set_flashdata('msg', 'Sorry! Data has not inserted....!!!');	
			}
			redirect('admin/pr2-reports/'.$report_id);
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

			$data['single_pr2'] = $this->pr2_model->get_rd_single_pr2($id);
			$this->load->view("admin/pr2_reports/edit",$data);
		}else{
			$this->load->view("admin/login");
		}
    }
	public function update($report_id)
    {
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$id = $this->input->post('id');
			$this->pr2_model->update_rd_single_pr2($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/pr2-reports/'.$report_id);
		}else{
			$this->load->view("admin/login");
		}
    }
	function delete($id)
	{
<<<<<<< Updated upstream
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->pr2_model->delete_rd_pr2($id);
			$this->session->set_flashdata('msg','Data has been delete successfully....!!!');
			redirect('admin/pr2-reports/'.$id);
		}else{
			$this->load->view("admin/login");
		}
=======
		$data['delete'] = $this->pr2_model->delete_rd_pr2($id);
		$this->session->set_flashdata('msg','Data has been delete successfully....!!!');
		redirect('admin/pr2-reports/'.$report_id);
>>>>>>> Stashed changes
	}
}    
?>