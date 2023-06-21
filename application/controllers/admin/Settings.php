<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);ini_set('display_errors', 0);  ini_set('display_errors', 0);  

class Settings extends CI_Controller {    
	public function __construct(){
		
		parent::__construct();	
		$this->load->model('admin/Settings_Model');	
		$this->load->library('form_validation');		
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->library('Send_mail'); 
		$this->load->helper(array('form', 'url'));		
	}
/* Employee tpye management */
    public function list(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['emenu_active'] = "active menu-open";
			$data['eqlist'] = "active";
			$data['type_details'] = $this->Settings_Model->get_emp_type_details();
            // var_dump($data['type_details']);die;
		    $this->load->view('admin/settings/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function add(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
		    $this->load->view('admin/settings/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert(){
        // var_dump('hii');die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$result = $this->Settings_Model->insert_emp_type();
            // var_dump($data['Login_user_name']);die;
			if($result == 1){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/settings/list');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
    public function edit($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['type_details'] = $this->Settings_Model->get_single_type_details($id);
            // var_dump($data['type_details']);die;
			$this->load->view("admin/settings/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    public function update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$id = $this->input->post('id');
			$this->Settings_Model->emp_type_update($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/settings/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete($id){
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['delete'] = $this->Settings_Model->emp_type_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/settings/list');
		}else{
			$this->load->view("admin/login");			
		}
    }
/*/. Employee tpye management */

/* Employee Department management */
    public function department_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['massage'] = $this->session->userdata('msg');
            $data['emenu_active'] = "active menu-open";
            $data['edqlist'] = "active";
            $data['dept_data'] = $this->Settings_Model->get_emp_department_data();
            // var_dump($data['dept_data']);die;
            $this->load->view('admin/settings/department/list',$data);			
        }else{			
            $this->load->view('admin/login');
        }
    }
    public function add_department(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
		    $this->load->view('admin/settings/department/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert_department(){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $type = $this->input->post('type');
            // var_dump($type);die;
			$result = $this->Settings_Model->insert_department();
            // var_dump($data['Login_user_name']);die;
			if($result == 1){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/settings/department_list');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
    public function edit_department($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['dept_data'] = $this->Settings_Model->get_single_emp_department_data($id);
            // var_dump($data['dept_data']);die;
			$this->load->view("admin/settings/department/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    public function update_department(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$id = $this->input->post('id');
			$this->Settings_Model->emp_department_update($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/settings/department_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete_department($id){
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['delete'] = $this->Settings_Model->emp_department_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/settings/department_list');
		}else{
			$this->load->view("admin/login");			
		}
    }
/* /.Employee Department management */

/* Employee Designation management */
    public function designations_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['massage'] = $this->session->userdata('msg');
            $data['emenu_active'] = "active menu-open";
            $data['dqlist'] = "active";
            $data['designation_data'] = $this->Settings_Model->get_emp_designation_data();
            // var_dump($data['type_details']);die;
            $this->load->view('admin/settings/designation/list',$data);			
        }else{			
            $this->load->view('admin/login');
        }
    }
    public function add_designations(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['department_details'] = $this->Settings_Model->get_emp_dept_details();
		    $this->load->view('admin/settings/designation/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert_designations(){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$dept_id = $this->input->post('dept_type');
			// $id = $this->input->post('id');
			$id = $_POST['id'];
			// var_dump($dept_id);die;
			$roleid = $this->input->post('designation');
			// $user_record = $this->Employee_Model->get_single_user_role_record($roleid);
            // $designation_type = $user_record->designation_type;
            // $role_id = $user_record->role_id;
			
			$result = $this->Settings_Model->insert_designations($dept_id,$roleid);
			if($result == 1){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/settings/designations_list');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
    public function edit_designations($id){
		// var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['department_details'] = $this->Settings_Model->get_emp_dept_details();
			$data['single_dept'] = $this->Settings_Model->get_single_dept_details($id);
			$data['designation_data'] = $this->Settings_Model->get_single_emp_designation_data($id);
            // var_dump($data['department_details']);die;
			$this->load->view("admin/settings/designation/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    public function update_designations(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['department_details'] = $this->Settings_Model->get_emp_dept_details();
			
			$id = $this->input->post('id');
			$data['single_dept'] = $this->Settings_Model->get_single_dept_details($id);
			$this->Settings_Model->emp_designations_update($id);
			
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/settings/designations_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete_designations($id){
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['delete'] = $this->Settings_Model->emp_designations_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/settings/designations_list');
		}else{
			$this->load->view("admin/login");			
		}
    }

/* /.Employee Designation management */

/* Employee Levels Type management */
    public function leave_type_list(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['massage'] = $this->session->userdata('msg');
            $data['emenu_active'] = "active menu-open";
            $data['elqlist'] = "active";
            $data['leave_data'] = $this->Settings_Model->get_emp_leave_type_data();
            // var_dump($data['type_details']);die;
            $this->load->view('admin/settings/leave/list',$data);			
        }else{			
            $this->load->view('admin/login');
        }
    }
    public function add_leave_type(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['massage'] = $this->session->userdata('msg');
            $this->load->view('admin/settings/leave/add',$data);		
        }else{			
            $this->load->view('admin/login');
        }
    }
    public function insert_leave_type(){
        // var_dump('hii');die;
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $result = $this->Settings_Model->insert_leave_type();
            // var_dump($data['Login_user_name']);die;
            if($result == 1){
                $this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
            }
            redirect('admin/settings/leave_type_list');
        }else
        {
            $this->load->view("admin/login");
        }
    }
    public function edit_leave_type($id){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['leave_data'] = $this->Settings_Model->get_single_emp_leave_type_data($id);
            // var_dump($data['dept_data']);die;
            $this->load->view("admin/settings/leave/edit",$data);
        }else{
            $this->load->view("admin/login");			
        }
    }
    public function update_leave_type(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $id = $this->input->post('id');
            $this->Settings_Model->emp_leave_update($id);
            $this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
            redirect('admin/settings/leave_type_list');
        }else{
            $this->load->view("admin/login");			
        }
    }
    public function delete_leave($id){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
            $data['department']=$session_data['department'];
            $data['delete'] = $this->Settings_Model->emp_leave_delete($id);
            $this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
            redirect('admin/settings/leave_type_list');
        }else{
            $this->load->view("admin/login");			
        }
    }
/* /.Employee Levels Type management */
}

?>