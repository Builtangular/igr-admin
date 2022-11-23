<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Dro_reports extends CI_Controller 
{    
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Drotype_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	function index($report_id)
	{	
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
		$data['title'] = "Category Master";
		$data['report_id'] = $report_id;
		$data['list_data'] = $this->Drotype_model->get_rd_dro_data($report_id);
		$this->load->view("admin/dro_report/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add($report_id)
	{
		if($this->session->userdata('logged_in')){
		$data = $this->session->userdata('logged_in');
		$data['get_dro_type'] = $this->Drotype_model->get_dro_type();
		$data['report_id'] = $report_id;
		$this->load->view("admin/dro_report/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    function insert_dro_records($report_id)
    {
        if($this->session->userdata('logged_in'))
	 	{
				$result = $this->Drotype_model->insert_rd_dro_records($report_id);
				if($result == 1)
				{
					$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
				}
				redirect('admin/dro-reports/'.$report_id);
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
   	public function edit($id)
    {
		if($this->session->userdata('logged_in'))
		{
			$data = $this->session->userdata('logged_in');
			$data['get_dro_type'] = $this->Drotype_model->get_dro_type();
			$data['single_dro'] = $this->Drotype_model->get_rd_single_dro($id);
			// var_dump($data['single_dro'] );die;
			$this->load->view("admin/dro_report/edit",$data);
		}else
		{
			$this->load->view("admin/login");			
		}
    }
	public function update($report_id)
    {
        $id = $this->input->post('id');
		$this->Drotype_model->update_rd_single_dro($id);
		$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
		redirect('admin/dro-reports/'.$report_id);
    }
	function delete($id)
	{
		$report_id = $this->input->post('report_id');
		$data['delete'] = $this->Drotype_model->delete_rd_dro_data($id);
		$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
		redirect('admin/dro-reports/'.$report_id);
	}

}  
    
?>