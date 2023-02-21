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
		$this->load->library('Send_mail'); 
		$this->load->helper(array('form', 'url'));		
	}
	/* Employee Personal Details Management */
	public function index(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['employee_details'] = $this->Employee_Model->get_employee_details();
			// var_dump($data['employee_details']); die;
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

		    $this->load->view('admin/employee/add',$data);			
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
			// var_dump($insert_id);die;
			if($insert_id)	{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee');
	 	} else {
			$this->load->view("admin/login");
		}
	}
	/* personal edit delete */
	public function edit($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['employee_data'] = $this->Employee_Model->get_single_employee_data($id);
			// var_dump($data['employee_data']);die;
			$this->load->view("admin/employee/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function update($id){		
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$this->Employee_Model->update_emp_personal_data($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/employee');
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_employee($id){
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
	/* /. Employee Personal Details Management */
	/* employment record add,edit,delete */
	public function employment_list($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['emp_id']=$id;
			// var_dump($data['emp_id']);die;			
			$data['employment_details'] = $this->Employee_Model->get_employment_record($id);
			// var_dump($data['first_name']);die;
			$this->load->view("admin/employee/employment/list", $data);
        }else{
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
			$this->load->view('admin/employee/employment/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_employment($id){
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['emp_id'] = $id;	
			$employee_details= $this->Employee_Model->get_emp_personal_details($id);
			$job_type = $employee_details->job_type;
			// var_dump($job_type);die;
			$button = $this->input->post('button');
			$insert_id = $this->Employee_Model->insert_employment_details($id);
				if($insert_id)	{
					$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
				}else {
					$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
				}
			redirect('admin/employee/employment_list/' .$id);
			}else{
				$this->load->view("admin/login");
			}
	}
	public function edit_employment($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];
			$data['emp_id'] = $id;
			$data['single_empolyment_data'] = $this->Employee_Model->get_single_empolyment_data($id);
			// var_dump($data['single_empolyment_data']);die;
			$this->load->view("admin/employee/employment/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function update_employment($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$emp_id = $this->input->post('emp_id');
			$result = $this->Employee_Model->update_employment_data($id);
			if($result){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry! Data has not been updated....!!!');
			}
			redirect('admin/employee/employment_list/' .$emp_id);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_employment($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$single_empolyment_data = $this->Employee_Model->get_single_empolyment_data($id);
			$emp_id = $single_empolyment_data->emp_id;	
			$data['delete_employment'] = $this->Employee_Model->delete_employment_data($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/employee/employment_list/' .$emp_id);
		}else {
			$this->load->view("admin/login");
		}
	}
	/* ./ Employment Management */
	/* Salary Management */
	public function salary_list($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['emp_id'] = $id;
			$single_psalary_list = $this->Employee_Model->get_psalary_list($id);
			$single_tsalary_list = $this->Employee_Model->get_tsalary_list($id);
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($id);
			// var_dump($single_empolyment_data);die;
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$data['p_salary_details'] = $this->Employee_Model->get_p_salary_details($id);	
			}else{
				$data['t_salary_details'] = $this->Employee_Model->get_t_salary_details($id);
			}
			$this->load->view("admin/employee/salary/list", $data);
        }else{
            $this->load->view("admin/login");
        }
    }
	public function add_salary($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id'] = $id;			
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($id);
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$this->load->view('admin/employee/salary/permanent_salary_form',$data);	
			}else{
				$this->load->view('admin/employee/salary/temporary_salary_form',$data);
			}					
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_salary($id){		
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');

			$data['Emp_id'] = $id;
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($id);
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$result = $this->Employee_Model->insert_permanent_salary_breakup($id);	
			}else{
				$result = $this->Employee_Model->insert_temporarily_salary_breakup($id);
			}					
			if($result)	{
			   $this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
		   	} else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/salary_list/' .$id);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function edit_salary($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$emp_id = $this->input->post('emp_id');
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($emp_id);
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$data['single_psalary_data'] = $this->Employee_Model->get_single_psalary_data($id);
				// var_dump($data['single_psalary_data']); die;
				$this->load->view("admin/employee/salary/edit_psalary",$data);
			}else{
				$data['single_tsalary_data'] = $this->Employee_Model->get_single_tsalary_data($id);
				$this->load->view("admin/employee/salary/edit_tsalary",$data);
			}
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_salary($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$emp_id = $this->input->post('emp_id');
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($emp_id);
			// var_dump($single_empolyment_data); die;
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$result = $this->Employee_Model->update_p_salary_breakup($id);
				// var_dump($result);die;
			}else{
				$result = $this->Employee_Model->update_t_salary_breakup($id);
			}
			if($result){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/salary_list/' .$emp_id);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	
	public function delete_salary($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
			$emp_id = $this->input->post('emp_id');
			$single_empolyment_data = $this->Employee_Model->get_emp_personal_details($emp_id);
			$job_type = $single_empolyment_data->job_type;
			if($job_type == "Full Time"){
				$result = $this->Employee_Model->delete_psalary($id);
			}else{
				$result = $this->Employee_Model->delete_tsalary($id);
			}
			if($result){
				$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not delete');
			}
			redirect('admin/employee/salary_list/' .$emp_id);
			
		}else{			
			$this->load->view('admin/login');
		}
	}	
	/* ./ Salary Management */

	/* Bank Details Management */	
	public function bank_list($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id']=$id;
			$data['bank_details'] = $this->Employee_Model->get_employee_bank_details($id);
			// var_dump($data['bank_details']); die;
			$this->load->view("admin/employee/bank/list", $data);
        }else{
            $this->load->view("admin/login");
        }		
    }
	public function add_bank($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id'] = $id;
			// var_dump($data['Emp_id']);die;
			$data['massage'] = $this->session->userdata('msg');
			$this->load->view('admin/employee/bank/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_bank($id){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			//var_dump($data['Emp_id']);die;
			$s_type = $this->input->post('s_type');
			$p_type = $this->input->post('p_type');
			$s_ac_no = $this->input->post('s_account_no');
			$p_ac_no = $this->input->post('p_account_no');
			// var_dump($ac_no);die;
		   	$button = $this->input->post('button');
		   	if($p_type == "Personal" && $p_ac_no){
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
				$bank_id = $this->Employee_Model->insert_bank_details($data);				
			}
			/* ac. no. to avoid blank entry of salary account */
			if($s_type == "Salary" && $s_ac_no){
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
				$bank_id = $this->Employee_Model->insert_bank_details($salary_data);				
			}
			if($bank_id){
				$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
			}else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
			}
			redirect('admin/employee/bank_list/'.$id);
		} else {
			$this->load->view("admin/login");
		}		
	}
	public function edit_bank($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['single_bank_data'] = $this->Employee_Model->get_single_bank_data($id);
			$data['Emp_id'] = $this->input->post('emp_id');
			// var_dump($data['Emp_id']);die;
			$this->load->view("admin/employee/bank/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function update_bank($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$emp_id = $this->input->post('emp_id');
			$result = $this->Employee_Model->update_bank_details($id);
			if($result){
				$this->session->set_flashdata('msg','Data has been updated successfully....!!!');
			}else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated');
			}
			redirect('admin/employee/bank_list/' .$emp_id);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_bank($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$single_bank = $this->Employee_Model->get_single_bank($id);
			$emp_id = $single_bank->emp_id;
			$result = $this->Employee_Model->delete_bank_details($id);
			if($result){
				$this->session->set_flashdata('msg','Data has been delete successfully....!!!');
			}else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not delete');
			}
			redirect('admin/employee/bank_list/' .$emp_id);			
		}else{			
			$this->load->view('admin/login');
		}
	}
/* /. Bank details */

/* Documents Management */
	public function document_list($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['Emp_id']=$id;
			$data['document_list'] = $this->Employee_Model->get_document_list($id);
			// var_dump($data['document_list']);die;
			$this->load->view("admin/employee/documents/list", $data);
		}else{
			$this->load->view("admin/login");
		}		
	}
	public function add_document($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			$data['employee_doc'] = $this->Employee_Model->get_employee_doc($id);
			$data['doc_type'] = $doc_type;
			$data['massage'] = $this->session->userdata('msg');
			$this->load->view('admin/employee/documents/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}

	}
	public function upload_documents($id){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['Emp_id'] = $id;
			$employee_details = $this->Employee_Model->get_employee_record($id);
			
			/* Adhaar Upload */
			$doc_type = $this->input->post('type');
			$button = $this->input->post('button');
			$first_name = $employee_details->first_name;
			// var_dump($new_name);die;
			$image = $first_name.'_'.$doc_type;
			if($button == 'Submit'){
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
				$insert_record = $this->Employee_Model->insert_employee_documents($id,$file);
				if($insert_record)
				{
					$this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
				} else {
					$this->session->set_flashdata('msg', 'Sorry!, Data not inserted');
				}				
				redirect('admin/employee/add_document/' .$id);
			} else {
				/* personal details fetch */		
				$job_type = $employee_details->job_type;
				$prefix = $employee_details->prefix;
				$first_name = $employee_details->first_name;
				$middle_name = $employee_details->middle_name;
				$last_name = $employee_details->last_name;
				$joining_date = $employee_details->joining_date;				
				$gender = $employee_details->gender;
				$marital_status = $employee_details->marital_status;
				$aadhaar_no = $employee_details->aadhaar_no;
				$pan_no = $employee_details->pan_no;
				$personal_email_id = $employee_details->personal_email_id;
				$mobile_number = $employee_details->mobile_number;
				$alternate_mobile_no = $employee_details->alternate_mobile_no;
				$personal_email_id = $employee_details->personal_email_id;
				$permant_address = $employee_details->permant_address;
				if($marital_status == 'single'){
					$father_name = $employee_details->middle_name;
				}else{
					$father_name = $employee_details->father_name;
				}				
				$full_name = $first_name . ' ' . $middle_name . ' ' . $last_name;
				// var_dump($father_name); die;
				/* bank details fetch */
				$employee_bank_details = $this->Employee_Model->get_employee_personal_bank_details($id);
				// var_dump($employee_bank_details);die;
				$bank_name = $employee_bank_details->bank_name;
				$account_no = $employee_bank_details->ac_no;
				$ifsc_code = $employee_bank_details->ifsc_code;
				/* permant & temparay bank details fetch */
				
				if($job_type == "Full Time"){
					$emp_permant_bank_details = $this->Employee_Model->get_emp_permant_salary_details($id);
					$gross_salary = $emp_permant_bank_details->gross_salary;
				}else{
					$emp_temporary_bank_details = $this->Employee_Model->get_emp_temporary_salary_details($id);
					$gross_salary = $emp_temporary_bank_details->gross_salary;
				}
				/* mail send to greythr  */					
				$Email_content = array(									
					'joining_date' => $joining_date,
					'prefix' => $prefix,
					'full_name' => $full_name,
					'father_name' => $father_name,
					'gender' => $gender,
					'marital_status' => $marital_status,
					'aadhaar_no' => $aadhaar_no,
					'pan_no' => $pan_no,
					'personal_email_id' => $personal_email_id,
					'mobile_number' => $mobile_number,
					'alternate_mobile_no' => $alternate_mobile_no,
					'bank_name' => $bank_name,
					'ac_number' => $account_no,
					'ifsc_code' => $ifsc_code,
					'permant_address' => $permant_address,
					'gross_salary' => $gross_salary,
					'Template_type' => 'greythr_employee_mail'
				);
				$this->send_mail->send_email_notification($Email_content);
				/* ./ mail send to greythr  */
				redirect('admin/employee/document_list/' .$id);
			}
		}
	 	else {
			$this->load->view("admin/login");
		}
	}
	public function edit_document($record_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['record_id'] = $record_id;
			// $employee_details = $this->Employee_Model->get_employee_record($id);
			$data['single_document'] = $this->Employee_Model->get_single_document($record_id);
			// var_dump($data['single_document']);die;
			$this->load->view("admin/employee/documents/edit",$data);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function update_document($id){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['record_id'] = $id;
			$emp_id = $this->input->post('emp_id');
			// var_dump($emp_id);die;
			$employee_details = $this->Employee_Model->get_employee_record($emp_id);
			// var_dump($employee_details);die;
			$doc_type = $this->input->post('type');
			$button = $this->input->post('button');
			
			$new_name = $employee_details->first_name;
			// var_dump($new_name);die;
			$image = $new_name.'_'.$doc_type;
			// var_dump($image);die;
			$file ='';
			$config = array(
				'upload_path' 	 => "assets/admin/emp_data/document",
				'allowed_types'  => "*",
				'encrypt_name'	 => false,
				'remove_spaces'  => TRUE,
				'file_name'      => $image
			);
			// var_dump($config);die;
            $this->upload->initialize($config);			
			if($this->upload->do_upload('upload_file')){
				$data = $this->upload->data();	
				$file = $data['file_name'];	
				// var_dump($file);die;
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
			$update_doc = $this->Employee_Model->update_documents($id,$file);
			// var_dump($update_doc);die;
			if($update_doc){
				$this->session->set_flashdata('msg','Data has been updated successfully....!!!');
			}else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated');
			}
			
			redirect('admin/employee/document_list/' .$emp_id);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_document($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$single_document = $this->Employee_Model->get_single_document($id);
			$emp_id = $single_document->emp_id;
			// $data['Emp_id'] = $id;
			$data['delete_document'] = $this->Employee_Model->delete_document($id);
			// var_dump($data['delete_document']);die;
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/employee/document_list/' .$emp_id);
		}else {
			$this->load->view("admin/login");
		}
	}
	/* / .documents */

	/* Employment Letters */
	public function letters(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['employee_details'] = $this->Employee_Model->get_permenent_employee_details();
			// var_dump($data['employee_details']); die;
			$this->load->view("admin/employee/letters", $data);
        }else{
            $this->load->view("admin/login");
        }
		
    }
	public function offer_letter(){
		// var_dump($_REQUEST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$employee_data = $this->Employee_Model->get_single_employee_data($_GET["emp_id"]);
			// var_dump($employee_data); die;
            /* RD base data extract */
            $emp_id = $employee_data->id;
            $job_type = $employee_data->job_type;
            $emp_code = $employee_data->emp_code;   // title case rd-title
            $joining_date = $employee_data->joining_date;   // small case rd-title
            $appraisal_date = $employee_data->appraisal_date;
            $prefix = $employee_data->prefix;
			$first_name = $employee_data->first_name;
            $middle_name = $employee_data->middle_name;
            $last_name = $employee_data->last_name;
            $date_of_birth = $employee_data->date_of_birth;
            $gender = $employee_data->gender;
            $mobile_number = $employee_data->mobile_number;
            $personal_email_id = $employee_data->personal_email_id;
           	$job_profile = $employee_data->job_profile;
           	$department = $employee_data->department;

			$todays_date = date('d F, Y');
			$joiningdate = date('d F, Y', strtotime($joining_date));
			// Template processor instance creation
			if($department == "Marketing"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/marketing_offer_letter.docx');
			} else if($department == "IT"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/developer_offer_letter.docx');
			} else if($department == "Research"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/research_offer_letter.docx');
			} else if($department == "Back Office"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/back_office_offer_letter.docx');
			} else if($department == "Sales"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/sales_offer_letter.docx');
			} else if($department == "Graphics"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/graphics_offer_letter.docx');
			}

			// Variables on different parts of document
			$templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));            // On section/content
			$templateProcessor->setValue('FirstName', htmlspecialchars($first_name));            // On section/content
			$templateProcessor->setValue('Designation', htmlspecialchars($job_profile));            // On section/content
			$templateProcessor->setValue('JoningDate', htmlspecialchars($joiningdate));  
			/* Salary */
			if($job_type == "Full Time"){
				$p_salary_details = $this->Employee_Model->get_single_psalary_data($emp_id);
				$gross_salary = $p_salary_details->gross_salary;
				$basic_pay = $p_salary_details->gross_basic_salary;
				$basic_hra = $p_salary_details->gross_hra;
				$basic_other = $p_salary_details->gross_other;
				$emp_prof_tax = $p_salary_details->emp_pt;
				$emp_provident_fund = $p_salary_details->emp_pf;
				$emp_esic = $p_salary_details->emp_esic;
				$net_salary = $p_salary_details->net_salary;
				$employer_pf = $p_salary_details->employer_pf;
				$employer_esic = $p_salary_details->employer_esic;
				$employer_other = $p_salary_details->employer_other;
				$ctc = $p_salary_details->ctc;
			}

			$templateProcessor->setValue('GrossSalary', htmlspecialchars(number_format($gross_salary)));
			$templateProcessor->setValue('AnnualGross', htmlspecialchars(number_format($gross_salary*12)));
			$templateProcessor->setValue('BasicPay', htmlspecialchars(number_format($basic_pay)));
			$templateProcessor->setValue('AnnualBasicPay', htmlspecialchars(number_format($basic_pay*12)));
			$templateProcessor->setValue('BasicHRA', htmlspecialchars(number_format($basic_hra)));
			$templateProcessor->setValue('AnnualHRA', htmlspecialchars(number_format($basic_hra*12)));
			$templateProcessor->setValue('BasicOther', htmlspecialchars(number_format($basic_other)));
			$templateProcessor->setValue('AnnualOther', htmlspecialchars(number_format($basic_other*12)));
			$templateProcessor->setValue('EmpProfTax', htmlspecialchars(number_format($emp_prof_tax)));
			$templateProcessor->setValue('EmpAnnualProfTax', htmlspecialchars(number_format($emp_prof_tax*12)));
			$templateProcessor->setValue('ProvidentFund', htmlspecialchars(number_format($emp_provident_fund)));
			$templateProcessor->setValue('AnnualPFund', htmlspecialchars(number_format($emp_provident_fund*12)));
			$templateProcessor->setValue('EmpESIC', htmlspecialchars(number_format($emp_esic)));
			$templateProcessor->setValue('AnnualEmpESIC', htmlspecialchars(number_format($emp_esic*12)));
			$templateProcessor->setValue('NetSalary', htmlspecialchars(number_format($net_salary)));
			$templateProcessor->setValue('AnnualNetSalary', htmlspecialchars(number_format($net_salary*12)));
			$templateProcessor->setValue('EmplyPF', htmlspecialchars(number_format($employer_pf)));
			$templateProcessor->setValue('AnnualEmplyPF', htmlspecialchars(number_format($employer_pf*12)));
			$templateProcessor->setValue('EmplyESIC', htmlspecialchars(number_format($employer_esic)));
			$templateProcessor->setValue('AnnualEmplyESIC', htmlspecialchars(number_format($employer_esic*12)));
			$templateProcessor->setValue('EmplyOther', htmlspecialchars(number_format($employer_other)));
			$templateProcessor->setValue('AnnualEmplyOther', htmlspecialchars(number_format($employer_other*12)));
			$templateProcessor->setValue('MonthCTC', htmlspecialchars(number_format($ctc)));
			$templateProcessor->setValue('AnnualCTC', htmlspecialchars(number_format($ctc*12)));

			$templateProcessor->setValue('EmpFirstLastName', htmlspecialchars($first_name.' '.$last_name));
			// $templateProcessor->setImageValue('SignatureStamp', 'resources/kishor_sign.png');
			$templateProcessor->setImageValue('SignatureStamp', array('path' => 'resources/kishor_sign.png', 'width' => 200, 'height' => 200, 'align'=>'left', 'ratio' => false));

			// $templateProcessor->saveAs('results/Sample_07_TemplateCloneRow.docx');
			$new_file_name = str_replace(" ","-", strtolower($first_name));
			$new_file_name1 = str_replace("/","-", $new_file_name);
			$new_file_name2 = str_replace("&amp;","and", $new_file_name1);
			$filename = htmlspecialchars($new_file_name2)."-offer-letter.docx";
			header('Content-Disposition: attachment; filename='.$filename);
			ob_clean();
			$templateProcessor->saveAs('php://output');			
		}else{			
			$this->load->view('admin/login');
		}
	}

	/* Offer Letter Printable */
	public function printable_offer_letter(){
		// var_dump($_REQUEST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$employee_data = $this->Employee_Model->get_single_employee_data($_GET["emp_id"]);
			// var_dump($employee_data); die;
            /* RD base data extract */
            $emp_id = $employee_data->id;
            $job_type = $employee_data->job_type;
            $emp_code = $employee_data->emp_code;   // title case rd-title
            $joining_date = $employee_data->joining_date;   // small case rd-title
            $appraisal_date = $employee_data->appraisal_date;
            $prefix = $employee_data->prefix;
			$first_name = $employee_data->first_name;
            $middle_name = $employee_data->middle_name;
            $last_name = $employee_data->last_name;
            $date_of_birth = $employee_data->date_of_birth;
            $gender = $employee_data->gender;
            $mobile_number = $employee_data->mobile_number;
            $personal_email_id = $employee_data->personal_email_id;
           	$job_profile = $employee_data->job_profile;
           	$department = $employee_data->department;

			$todays_date = date('d F, Y');
			$joiningdate = date('d F, Y', strtotime($joining_date));
			// Template processor instance creation
			if($department == "Marketing"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/marketing_offer_letter.docx');
			} else if($department == "IT"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/developer_offer_letter.docx');
			} else if($department == "Research"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/research_offer_letter.docx');
			} else if($department == "Back Office"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/back_office_offer_letter.docx');
			} else if($department == "Sales"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/sales_offer_letter.docx');
			} else if($department == "Graphics"){
				$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/graphics_offer_letter.docx');
			}

			// Variables on different parts of document
			$templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));            // On section/content
			$templateProcessor->setValue('FirstName', htmlspecialchars($first_name));            // On section/content
			$templateProcessor->setValue('Designation', htmlspecialchars($job_profile));            // On section/content
			$templateProcessor->setValue('JoningDate', htmlspecialchars($joiningdate));  
			/* Salary */
			if($job_type == "Full Time"){
				$p_salary_details = $this->Employee_Model->get_single_psalary_data($emp_id);
				$gross_salary = $p_salary_details->gross_salary;
				$basic_pay = $p_salary_details->gross_basic_salary;
				$basic_hra = $p_salary_details->gross_hra;
				$basic_other = $p_salary_details->gross_other;
				$emp_prof_tax = $p_salary_details->emp_pt;
				$emp_provident_fund = $p_salary_details->emp_pf;
				$emp_esic = $p_salary_details->emp_esic;
				$net_salary = $p_salary_details->net_salary;
				$employer_pf = $p_salary_details->employer_pf;
				$employer_esic = $p_salary_details->employer_esic;
				$employer_other = $p_salary_details->employer_other;
				$ctc = $p_salary_details->ctc;
			}

			$templateProcessor->setValue('GrossSalary', htmlspecialchars(number_format($gross_salary)));
			$templateProcessor->setValue('AnnualGross', htmlspecialchars(number_format($gross_salary*12)));
			$templateProcessor->setValue('BasicPay', htmlspecialchars(number_format($basic_pay)));
			$templateProcessor->setValue('AnnualBasicPay', htmlspecialchars(number_format($basic_pay*12)));
			$templateProcessor->setValue('BasicHRA', htmlspecialchars(number_format($basic_hra)));
			$templateProcessor->setValue('AnnualHRA', htmlspecialchars(number_format($basic_hra*12)));
			$templateProcessor->setValue('BasicOther', htmlspecialchars(number_format($basic_other)));
			$templateProcessor->setValue('AnnualOther', htmlspecialchars(number_format($basic_other*12)));
			$templateProcessor->setValue('EmpProfTax', htmlspecialchars(number_format($emp_prof_tax)));
			$templateProcessor->setValue('EmpAnnualProfTax', htmlspecialchars(number_format($emp_prof_tax*12)));
			$templateProcessor->setValue('ProvidentFund', htmlspecialchars(number_format($emp_provident_fund)));
			$templateProcessor->setValue('AnnualPFund', htmlspecialchars(number_format($emp_provident_fund*12)));
			$templateProcessor->setValue('EmpESIC', htmlspecialchars(number_format($emp_esic)));
			$templateProcessor->setValue('AnnualEmpESIC', htmlspecialchars(number_format($emp_esic*12)));
			$templateProcessor->setValue('NetSalary', htmlspecialchars(number_format($net_salary)));
			$templateProcessor->setValue('AnnualNetSalary', htmlspecialchars(number_format($net_salary*12)));
			$templateProcessor->setValue('EmplyPF', htmlspecialchars(number_format($employer_pf)));
			$templateProcessor->setValue('AnnualEmplyPF', htmlspecialchars(number_format($employer_pf*12)));
			$templateProcessor->setValue('EmplyESIC', htmlspecialchars(number_format($employer_esic)));
			$templateProcessor->setValue('AnnualEmplyESIC', htmlspecialchars(number_format($employer_esic*12)));
			$templateProcessor->setValue('EmplyOther', htmlspecialchars(number_format($employer_other)));
			$templateProcessor->setValue('AnnualEmplyOther', htmlspecialchars(number_format($employer_other*12)));
			$templateProcessor->setValue('MonthCTC', htmlspecialchars(number_format($ctc)));
			$templateProcessor->setValue('AnnualCTC', htmlspecialchars(number_format($ctc*12)));

			$templateProcessor->setValue('EmpFirstLastName', htmlspecialchars($first_name.' '.$last_name));
			$templateProcessor->setValue('SignatureStamp', '');

			// $templateProcessor->saveAs('results/Sample_07_TemplateCloneRow.docx');
			$new_file_name = str_replace(" ","-", strtolower($first_name));
			$new_file_name1 = str_replace("/","-", $new_file_name);
			$new_file_name2 = str_replace("&amp;","and", $new_file_name1);
			$filename = htmlspecialchars($new_file_name2)."-offer-letter.docx";
			header('Content-Disposition: attachment; filename='.$filename);
			ob_clean();
			$templateProcessor->saveAs('php://output');			
		}else{			
			$this->load->view('admin/login');
		}
	}

	/* Experience/Releaving Letter */
	public function releaving_letter(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$employee_data = $this->Employee_Model->get_single_employee_data($_GET["emp_id"]);
			// var_dump($employee_data); die;
            /* RD base data extract */
            $emp_id = $employee_data->id;
            $job_type = $employee_data->job_type;
            $emp_code = $employee_data->emp_code;   // title case rd-title
            $joining_date = $employee_data->joining_date;   // small case rd-title
            $appraisal_date = $employee_data->appraisal_date;
            $prefix = $employee_data->prefix;
			$first_name = $employee_data->first_name;
            $middle_name = $employee_data->middle_name;
            $last_name = $employee_data->last_name;
            $date_of_birth = $employee_data->date_of_birth;
            $gender = $employee_data->gender;
            $mobile_number = $employee_data->mobile_number;
            $personal_email_id = $employee_data->personal_email_id;
           	$job_profile = $employee_data->job_profile;
           	$department = $employee_data->department;
           	$resignation_date = $employee_data->resignation_date;

			$todays_date = date('d F, Y');
			$joiningdate = date('d F Y', strtotime($joining_date));
			$resignationdate = date('d F Y', strtotime($resignation_date));
			$full_name = $first_name.' '.$middle_name.' '.$last_name;
			// $time_duration = 
			$from = new DateTime($joining_date);
			$to   = new DateTime($resignation_date);
			$year = $from->diff($to)->y;
			$month = $from->diff($to)->m;
			$time_duration = $year." years & ".$month." months"; 

			if($gender == "Female"){
				$denotion = "She";
				$determiner = "her";
			}else{
				$denotion = "He";
				$determiner = "his";
			}
			// echo $time_duration; die;
	
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/Sample_Experience_Releaving_Letter.docx');
			$templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));            // On section/content
			$templateProcessor->setValue('Prefix', htmlspecialchars($prefix));            // On section/content
			$templateProcessor->setValue('FullName', htmlspecialchars($full_name));            // On section/content
			$templateProcessor->setValue('Designation', htmlspecialchars($job_profile));            // On section/content
			$templateProcessor->setValue('JoiningDate', htmlspecialchars($joiningdate));
			$templateProcessor->setValue('TimeDuration', htmlspecialchars($time_duration));
			$templateProcessor->setValue('ResignationDate', htmlspecialchars($resignationdate));
			$templateProcessor->setValue('Denotion', htmlspecialchars($denotion));
			$templateProcessor->setValue('Determiner', htmlspecialchars($determiner));

			$templateProcessor->setImageValue('SignatureStamp', array('path' => 'resources/kishor_sign.png', 'width' => 150, 'height' => 150, 'align'=>'left', 'ratio' => false));

			// $templateProcessor->saveAs('results/Sample_07_TemplateCloneRow.docx');
			$new_file_name = str_replace(" ","-", strtolower($first_name));
			$new_file_name1 = str_replace("/","-", $new_file_name);
			$new_file_name2 = str_replace("&amp;","and", $new_file_name1);
			$filename = htmlspecialchars($new_file_name2)."-experience-releaving-letter.docx";
			header('Content-Disposition: attachment; filename='.$filename);
			ob_clean();
			$templateProcessor->saveAs('php://output');			
		}else{			
			$this->load->view('admin/login');
		}
	}

	/* Experience/Releaving Letter */
	public function printable_releaving_letter(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$employee_data = $this->Employee_Model->get_single_employee_data($_GET["emp_id"]);
			// var_dump($employee_data); die;
            /* RD base data extract */
            $emp_id = $employee_data->id;
            $job_type = $employee_data->job_type;
            $emp_code = $employee_data->emp_code;   // title case rd-title
            $joining_date = $employee_data->joining_date;   // small case rd-title
            $appraisal_date = $employee_data->appraisal_date;
            $prefix = $employee_data->prefix;
			$first_name = $employee_data->first_name;
            $middle_name = $employee_data->middle_name;
            $last_name = $employee_data->last_name;
            $date_of_birth = $employee_data->date_of_birth;
            $gender = $employee_data->gender;
            $mobile_number = $employee_data->mobile_number;
            $personal_email_id = $employee_data->personal_email_id;
           	$job_profile = $employee_data->job_profile;
           	$department = $employee_data->department;
           	$resignation_date = $employee_data->resignation_date;

			$todays_date = date('d F, Y');
			$joiningdate = date('d F Y', strtotime($joining_date));
			$resignationdate = date('d F Y', strtotime($resignation_date));
			$full_name = $first_name.' '.$middle_name.' '.$last_name;
			// $time_duration = 
			$from = new DateTime($joining_date);
			$to   = new DateTime($resignation_date);
			$year = $from->diff($to)->y;
			$month = $from->diff($to)->m;
			$time_duration = $year." years & ".$month." months"; 

			if($gender == "Female"){
				$denotion = "She";
				$determiner = "her";
			}else{
				$denotion = "He";
				$determiner = "his";
			}
			// echo $time_duration; die;
	
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/Sample_Experience_Releaving_Letter.docx');
			$templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));            // On section/content
			$templateProcessor->setValue('Prefix', htmlspecialchars($prefix));            // On section/content
			$templateProcessor->setValue('FullName', htmlspecialchars($full_name));            // On section/content
			$templateProcessor->setValue('Designation', htmlspecialchars($job_profile));            // On section/content
			$templateProcessor->setValue('JoiningDate', htmlspecialchars($joiningdate));
			$templateProcessor->setValue('TimeDuration', htmlspecialchars($time_duration));
			$templateProcessor->setValue('ResignationDate', htmlspecialchars($resignationdate));
			$templateProcessor->setValue('Denotion', htmlspecialchars($denotion));
			$templateProcessor->setValue('Determiner', htmlspecialchars($determiner));

			$templateProcessor->setValue('SignatureStamp', '');

			// $templateProcessor->saveAs('results/Sample_07_TemplateCloneRow.docx');
			$new_file_name = str_replace(" ","-", strtolower($first_name));
			$new_file_name1 = str_replace("/","-", $new_file_name);
			$new_file_name2 = str_replace("&amp;","and", $new_file_name1);
			$filename = htmlspecialchars($new_file_name2)."-experience-releaving-letter.docx";
			header('Content-Disposition: attachment; filename='.$filename);
			ob_clean();
			$templateProcessor->saveAs('php://output');			
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* /. Employment Letters */
		
}

?>