<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Segment extends CI_Controller 
{    
	public function __construct()
	{		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_Model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	public function index($id)
	{		
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['report_id']=$id;	
			$data['segments']= $this->Data_Model->get_rd_segments($id);
            // var_dump($data['segments']); die;
			$this->load->view('admin/segment/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function add($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['report_id']=$id;	
            $data['segments']= $this->Data_Model->get_rd_segments($id);
            // var_dump($data['segments']); die;
			$this->load->view('admin/segment/add',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function insert($id)
	{
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	

			$postseg=array(				
				'name'=>$this->input->post('name'),
				'parent_id'=>$this->input->post('parent'),
				'report_id'=>$id,
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$inserted_id = $this->Data_Model->insert_rd_segment($postseg);
			if($inserted_id){
				$this->session->set_flashdata("success_code","Data has been inserted successfully..!!!");	
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not inserted");		
			}
            redirect('admin/segment/'.$id);
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$company= $this->Data_Model->get_rd_company($id);
			$data['company_id']= $company->id;
			$data['company_name']= $company->name;
			// var_dump($data['company']); die;
			$this->load->view('admin/company/edit',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function update($id)
	{
		// var_dump($id); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$postcomp=array(				
				'name'=>$this->input->post('name'),
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$result = $this->Data_Model->update_rd_company($id,$postcomp);
			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");				
				redirect('admin/company/'.$id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");				
				redirect('admin/company/'.$id);
			}
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];				
			$result = $this->Data_Model->delete_rd_company($id);
			if($result){
				$this->session->set_flashdata("success_code","Record has been deleted successfully..!!!");				
				redirect('admin/company/'.$id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");				
				redirect('admin/company/'.$id);
			}	
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
}
?>