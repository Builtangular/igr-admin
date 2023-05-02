<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);ini_set('display_errors', 0);  ini_set('display_errors', 0);  

class Employee_Details extends CI_Controller {    
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
			$data = $this->session->userdata('logged_in');
			$data['massage'] = $this->session->userdata('msg'); 
			$employee_list= $this->Employee_Model->get_emp_personal_details();
			$id = $employee_list->id;
			// var_dump($id);die;
		    $this->load->view('admin/employee/emp_personal_details_form',$data);			
			//$this->load->view('admin/employee/employee_details_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	function add_emp_personal_details(){
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
        $this->load->view("admin/employee/emp_personal_details_form", $data);
        }else{
            $this->load->view("admin/login");
        }

    }
	public function insert_emp_personal_details(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id'); 
			// var_dump($id);die;
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/uploads",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
			// var_dump($config);die;
            $this->upload->initialize($config);
			if($this->upload->do_upload('upload_image')){
				$data = $this->upload->data();	
				$file = $data['file_name'];
				// var_dump($file);die;
					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
			$result = $this->Employee_Model->insert_emp_personal_details($file);
			// var_dump($result);die;
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/Employee_Details/employee_details');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
	public function employee_details(){
		if($this->session->userdata('logged_in')){
			$data = $this->session->userdata('logged_in');
			$data['massage'] = $this->session->userdata('msg');
			$employee_list= $this->Employee_Model->get_emp_personal_details();
			$id = $employee_list->id;
			// var_dump($id);die;
			$this->load->view('admin/employee/employee_details_form',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_employee_details(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$employee_list= $this->Employee_Model->get_emp_personal_details();
			$id = $employee_list->id;
			$emp_details= $this->Employee_Model->get_emp_details();
			// var_dump($emp_details);die;
			
			$company_name=$this->input->post('company_name');
			$company_address=$this->input->post('company_address');
			$date_of_joining=$this->input->post('date_of_joining');
			$date_of_releaving=$this->input->post('date_of_releaving');
			$designation=$this->input->post('designation');
			$last_drown_salary=$this->input->post('last_drown_salary');
			$job_type=$this->input->post('job_type');
			$reason_for_leaving=$this->input->post('reason_for_leaving');
			$reference_contact_no=$this->input->post('reference_contact_no');

			$num = 0;
            foreach($emp_details as $emp)
            {
                if($emp != "" || $emp != null )
                {
                    $Insert_emp_details=array(
                        'emp_id'                      => $id,
						'company_name'                => $this->input->post('company_name'),
						'company_address'             => $this->input->post('company_address'),
						'date_of_joining'             => $this->input->post('date_of_joining'),
						'date_of_releaving'           => $this->input->post('date_of_releaving'),
						'designation'                 => $this->input->post('designation'),
						'last_drown_salary'           => $this->input->post('last_drown_salary'),
						'job_type'                    => $this->input->post('job_type'),
						'reason_for_leaving'          => $this->input->post('reason_for_leaving'),
						'reference_contact_no'        => $this->input->post('reference_contact_no'),
						'created_at'                  => date('Y-m-d'),
						'updated_at'                  => date('Y-m-d'),
                    );
                    $Insert_emp_details=$this->Employee_Model->insert_employee_details($Insert_emp_details);
					// var_dump($Insert_emp_details);die;
                }
                $num++;
            }
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/Employee_Details');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
	
}
?>