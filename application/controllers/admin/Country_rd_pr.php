<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country_rd_pr extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Country_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
	}
	function view($report_id)
	{	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['massage'] = $this->session->userdata('msg');
			$data['title'] = "Category Master";
			$data['report_id'] = $report_id;
			$data['list_data'] = $this->Country_model->get_rd_pr_data($report_id);
			// var_dump($data['list_data']); die;
			$this->load->view("admin/country_rd/pr/list", $data);
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
			$this->load->view("admin/country_rd/pr/add",$data);
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

			$pr_description = $this->input->post('description');
			// var_dump($pr_description); die;
			$num4 = 0;
			foreach($pr_description as $description)
			{
				if($description != "" || $description != null )
                 {
					$Insert_pr_data=array(	
                        'report_id'=>$report_id,	
                        'description'=>$pr_description[$num4],
                        'active'=>1,                        
                        'created_at'=>date('Y-m-d'),
                        'updated_at'=>date('Y-m-d')
                     );
					 //  var_dump($Insert_summary_regional_description);die;
                     $result = $this->Country_model->insert_pr_data($Insert_pr_data);
				 }
				 $num4++;
			}

			// $result = $this->pr2_model->insert_rd_pr2_records($report_id);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else{
				$this->session->set_flashdata('msg', 'Sorry! Data has not inserted....!!!');	
			}
			redirect('admin/country_rd/drafts');
	 	}else{
			$this->load->view("admin/login");
		}
    }
   	public function edit($id)
    {
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];

			// $data['list_data'] = $this->Country_model->get_rd_pr_data($report_id);
			$data['single_pr_data'] = $this->Country_model->get_rd_single_pr_data($id);
			// var_dump($data['single_pr_data']); die;
			$this->load->view("admin/country_rd/pr/edit", $data);
		}else{
			$this->load->view("admin/login");
		}
    }
	public function update($id)
    {
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];

			$report_id = $this->input->post('report_id');
			$updatedata=array(
				'description'=> $this->input->post('description'),
				// 'name'=> $this->input->post('name'),
			);
			$result = $this->Country_model->update_rd_single_pr_data($id, $updatedata);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/country_rd_pr/view/'.$report_id);
		}else{
			$this->load->view("admin/login");
		}
    }
	function delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->Country_model->delete_rd_pr($id);
			$this->session->set_flashdata('msg','Data has been delete successfully....!!!');
			redirect('admin/country_rd_pr/view/'.$id);
		}else{
			$this->load->view("admin/login");
		}
	}
}    
?>