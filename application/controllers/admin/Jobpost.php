<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Jobpost extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Jobpost_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));	
	}
	function index()
	{	
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
		$data['massage'] = $this->session->userdata('msg');
		$data['title'] = "Job Post";
		$data['job_list'] = $this->Jobpost_model->get_job_data();
		$this->load->view("admin/job/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function add(){
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
        $data['title'] = "Job Post";
        $this->load->view("admin/job/add", $data);
        }else{
            $this->load->view("admin/login");
        }
    }
    public function insert()
	{
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$result = $this->Jobpost_model->insert_job_data();
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/jobpost');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
    function edit($id){
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['jobpost_data'] = $this->Jobpost_model->get_job_data();
            $data['single_jobpost_data'] = $this->Jobpost_model->get_single_jobpost_data($id);
			$this->load->view("admin/job/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    function update_job_data(){
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$this->Jobpost_model->update_jobdata($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/jobpost');
		}else{
			$this->load->view("admin/login");			
		}

    }
    function jobpost_delete($id){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];
            $data['Role_id']=$session_data['Role_id'];
            $data['delete'] = $this->Jobpost_model->jobpost_delete($id);
            $this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/jobpost');
		}else{
			$this->load->view("admin/login");			
		}
	}

}
    


    
?>