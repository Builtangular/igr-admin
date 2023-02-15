<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);ini_set('display_errors', 0);  ini_set('display_errors', 0);  

class Employee extends CI_Controller {    
	public function __construct(){
		
		parent::__construct();	
		$this->load->model('admin/Employee_Model');	
		$this->load->library('form_validation');		
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		
	}
	public function index(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['employee_details'] = $this->Employee_Model->get_employee_details();
			$data['first_name'] = $first_name;
			// var_dump($data['first_name']);die;
			$this->load->view("admin/employee/list", $data);
        }else{
            $this->load->view("admin/login");
        }
    }
	public function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg'); 

		    $this->load->view('admin/employee/data_form',$data);			
			//$this->load->view('admin/employee/employment_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}	
	public function insert()
	{
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			/* Image Upload */
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/emp_data/profile",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('upload_image')){
				$data = $this->upload->data();	
				$file = $data['file_name'];			
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
			/* /. Image Upload */
			$insert_id = $this->Employee_Model->insert_emp_personal_details($file);
			if($insert_id)	{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/add_employment/' .$insert_id);
	 	} else {
			$this->load->view("admin/login");
		}
	}
	public function add_employment($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['emp_id'] = $id;			
			$this->load->view('admin/employee/employment_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_employment($id){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id'] = $id;	
			$employee_details= $this->Employee_Model->get_emp_personal_details($id);
			$job_type = $employee_details->job_type;
			// var_dump($job_type);die;
			$button = $this->input->post('button');
			if($button == "Next"){
				$insert_id = $this->Employee_Model->insert_employment_details($id);
				if($insert_id)	{
					$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
				}else {
					$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
				}
			}
			if($job_type == "Full Time"){
				redirect('admin/employee/permanent_salary_breakup/' .$id);
			}else{
				redirect('admin/employee/temporary_salary_breakup/' .$id);
			}			
	 	}else{
			$this->load->view("admin/login");
		}
	}
	public function permanent_salary_breakup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id'] = $id;
			// var_dump($data['Emp_id']);die;
			$this->load->view('admin/employee/permanent_salary_breakup_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_permanent_salary_breakup($id){
		if($this->session->userdata('logged_in'))
		{
		   $session_data = $this->session->userdata('logged_in');
		   $data['Login_user_name']=$session_data['Login_user_name'];	
		   $data['Role_id']=$session_data['Role_id'];
		   $data['massage'] = $this->session->userdata('msg');
		   $data['Emp_id'] = $id;
		   
		//    var_dump($id);die;
		   $result = $this->Employee_Model->insert_permanent_salary_breakup($id);
		    // var_dump($employment);die;
		   if($result)
		   {
			   $this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
		   }
		   else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
		   	redirect('admin/employee/bank_details/' .$id);
			}else
			{
			$this->load->view("admin/login");
			}
	}
	public function temporary_salary_breakup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			// var_dump($data['Emp_id']);die;
			$data['massage'] = $this->session->userdata('msg');
			$this->load->view('admin/employee/temporary_salary_breakup_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_temporary_salary_breakup($id){
		if($this->session->userdata('logged_in'))
		{
		   $session_data = $this->session->userdata('logged_in');
		   $data['Login_user_name']=$session_data['Login_user_name'];	
		   $data['Role_id']=$session_data['Role_id'];
		   $data['Emp_id'] = $id;
			//var_dump($data['Emp_id']);die;
		   $result = $this->Employee_Model->insert_temporarily_salary_breakup($id);
		   	//$result = $this->Employee_Model->insert_temporarily_salary_breakup($id);
		    // var_dump($result);die;
		   if($result)
		   {
			   $this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
		   }
		   else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/bank_details/' .$id);
			} else {
			$this->load->view("admin/login");
		}
		
	}
	public function bank_details($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			// var_dump($data['Emp_id']);die;
			$data['massage'] = $this->session->userdata('msg');
			$this->load->view('admin/employee/bank_details_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_bank_details($id){
		if($this->session->userdata('logged_in'))
		{
		   $session_data = $this->session->userdata('logged_in');
		   $data['Login_user_name']=$session_data['Login_user_name'];	
		   $data['Role_id']=$session_data['Role_id'];
		   $data['Emp_id'] = $id;
			//var_dump($data['Emp_id']);die;
		   $s_type = $this->input->post('s_type');
		   $p_type = $this->input->post('p_type');
		   $ac_no = $this->input->post('ac_no');

		   $button = $this->input->post('button');
		   	if($p_type == "personal"){
				$data = array(
					'emp_id'                      => $id,
					'bank_name'                   => $this->input->post('p_bank_name'),
					'ac_name'                     => $this->input->post('p_account_name'),
					'ac_no'                       => $this->input->post('p_account_no'),
					'ifsc_code'                   => $this->input->post('p_ifsc_code'),
					'branch_name'                 => $this->input->post('p_branch_name'),
					'type'                        => $this->input->post('p_type'),
					'created_at'                  => date('Y-m-d'),
					'updated_at'                  => date('Y-m-d'),
				);
				if($button == "Next"){
					$bank_id = $this->Employee_Model->insert_bank_details($data);
				}
			}
			if($s_type == "salary" && $ac_no == "ac_no"){
				$salary_data = array(
					'emp_id'                      => $id,
					'bank_name'                   => $this->input->post('s_bank_name'),
					'ac_name'                     => $this->input->post('s_account_name'),
					'ac_no'                       => $this->input->post('s_account_no'),
					'ifsc_code'                   => $this->input->post('s_ifsc_code'),
					'branch_name'                 => $this->input->post('s_branch_name'),
					'type'                        => $this->input->post('s_type'),
					'created_at'                  => date('Y-m-d'),
					'updated_at'                  => date('Y-m-d')
				);
				if($button == "Next"){
					$bank_id = $this->Employee_Model->insert_bank_details($salary_data);
				}
			}
			if($bank_id){
				$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
			}else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/employee_document/'.$id);
		} else {
			$this->load->view("admin/login");
		}
		
	}
	public function employee_document($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			$data['employee_doc'] = $this->Employee_Model->get_employee_doc($id);
			$data['doc_type'] = $doc_type;
			// var_dump($data['employee_doc']);die;
			$data['massage'] = $this->session->userdata('msg');
			$this->load->view('admin/employee/employee_document_upload',$data);			
		}else{			
			$this->load->view('admin/login');
		}

	}
	public function upload_employee_documents($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			$employee_details = $this->Employee_Model->get_employee_record($id);
			$first_name = $employee_details->first_name;
			/* Adhaar Upload */
			$doc_type = $this->input->post('type');
			$button = $this->input->post('button');
			$new_name = $first_name;
			$image = $first_name.'_'.$doc_type;
			$file ='';
			$config = array(
				'upload_path' 	 => "assets/admin/emp_data/document",
				'allowed_types'  => "*",
				'encrypt_name'	 => false,
				'remove_spaces'  => TRUE,
				'file_name'      => $image
			);
            $this->upload->initialize($config);			
			if($this->upload->do_upload('upload_file')){
				$data = $this->upload->data();	
				$file = $data['file_name'];	
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
				$employee_doc = $this->Employee_Model->get_employee_doc($id);
				$doc_type = $doc_type;
				if($button == "Next"){
					$result = $this->Employee_Model->insert_employee_documents($id,$file);
					if($result)	{
						$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
					}else {
						$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
					}
					redirect('admin/employee/employee_document/' .$id);
				} else{
					redirect('admin/employee');
				}

				
	 	} else {
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
			$data['single_employee_data'] = $this->Employee_Model->get_single_employee_data($id);
			// var_dump($data['single_employee_data']);die;
			$this->load->view("admin/employee/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function update_employment_data(){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$this->Employee_Model->update_employment_data($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/employee');
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_employment_data($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete_employment_data'] = $this->Employee_Model->delete_employment_data($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/employee');
		}else {
			$this->load->view("admin/login");
		}
	}

	
	
}

?>