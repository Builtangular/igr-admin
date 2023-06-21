<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);ini_set('display_errors', 0);  ini_set('display_errors', 0);  

class Register_user extends CI_Controller {    
	public function __construct(){
		
		parent::__construct();	
		$this->load->model('admin/User_Model');	
		$this->load->library('form_validation');		
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->library('send_mail'); 
		$this->load->helper(array('form', 'url'));
		
	}
    public function index(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['rmenu_active'] = "active menu-open";
			$data['rulist'] = "active";
			$data['massage'] = $this->session->userdata('msg');
			$data['user_details'] = $this->User_Model->get_user_details();
			$this->load->view("admin/user/list", $data);
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
            $data['user_record'] = $this->User_Model->get_user_role_record();
            $data['user_details'] = $this->User_Model->get_user_details();
            $data['role_type'] = $this->input->post('role_type');
            $this->load->view('admin/user/add',$data);	
        }else{
            $this->load->view("admin/login");
        }
    }
    public function insert(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
            $role_id = $this->input->post('user_type');
            // var_dump( $role_id);die;
            $user_record = $this->User_Model->get_single_user_role_record($role_id);
            $role_type = $user_record->role_type;
            $role_id = $user_record->id;
            // var_dump($role_id);die;
            $insert_user_records = array(
                'role_id'               => $role_id,
                'user_type'             => $role_type,
                'head_name'             => $this->input->post('head_name'),
                'full_name'             => $this->input->post('full_name'),
                'mobile_no'             => $this->input->post('mobile_no'),
                'email_id'              => $this->input->post('email_id'),
                'designation'           => $this->input->post('designation'),
                'department'            => $this->input->post('department'),
                'password'              => $this->input->post('password'),
                'created_on'            => date('Y-m-d'),
                'updated_on'            => date('Y-m-d'),
            );
            $insert_user_records = $this->User_Model->insert_user_register_details($insert_user_records);
            $insert_user_details = array(
                'user_id'                   => $insert_user_records,
                'User_email_id'             => $this->input->post('email_id'),
                'Login_user_name'           => $this->input->post('full_name'),
                'Login_password'            => $this->input->post('password'),
                'Creation_date'             => date('Y-m-d'),
                
            );
            // var_dump($insert_user_details);die;
            $insert_user_details = $this->User_Model->insert_user_login_details($insert_user_details);
            $this->session->set_flashdata('msg','Data has been inserted successfully....!!!');
            redirect('admin/register_user');
        }else{
            $this->load->view("admin/login");
        }
    }
    public function edit($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
            $data['role_id'] = $id;
            $data['user_role'] = $this->User_Model->get_user_role_details();
            $data['user_details'] = $this->User_Model->get_user_details();
            $data['single_user_data'] = $this->User_Model->get_single_user_data($id);
            $this->load->view('admin/user/edit',$data);	
        }else{
            $this->load->view("admin/login");
        } 
    }
    public function update($id){
        // var_dump($id);die;
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['massage'] = $this->session->userdata('msg');
            $role_id = $this->input->post('user_type');
            // $role_id = $id;
            $user_record = $this->User_Model->get_single_user_role_record($role_id);
            $role_type = $user_record->role_type;
            $role_id = $user_record->id;
            // var_dump($user_record);die;
            $update = array(
                'role_id'               => $role_id,
                'user_type'             => $role_type,
                'head_name'             => $this->input->post('head_name'),
                'full_name'             => $this->input->post('full_name'),
                'mobile_no'             => $this->input->post('mobile_no'),
                'email_id'              => $this->input->post('email_id'),
                'designation'           => $this->input->post('designation'),
                'department'            => $this->input->post('department'),
                'password'              => $this->input->post('password'),
                'updated_on'            => date('Y-m-d'),
                );
            // var_dump($user_record);die;
			$update = $this->User_Model->update_user_data($update,$id);

            $update_user_details = array(
                'user_id'                   => $update,
                'User_email_id'             => $this->input->post('email_id'),
                'Login_user_name'           => $this->input->post('full_name'),
                'Login_password'            => $this->input->post('password'),
                'Creation_date'             => date('Y-m-d'),
                
            );
            // var_dump($update_user_details);die;
            $update_user = $this->User_Model->update_user_details($update_user_details,$id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			
			redirect('admin/register_user');
		}else {
			$this->load->view("admin/login");
		}
    }
    public function delete($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['delete'] = $this->User_Model->delete_user_data($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/register_user');
		}else {
			$this->load->view("admin/login");
		}
	}
    public function email($id){
        // var_dump($id);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
            $data['role_id'] = $id;
            $single_user_data = $this->User_Model->get_single_user_data($id);
            $full_name = $single_user_data->full_name;
            $email_id = $single_user_data->email_id;
            $password = $single_user_data->password;
            $created_on = $single_user_data->created_on;
            $Email_content = array(									
                'full_name'     => $full_name,
                'email_id'     => $email_id,
                'password'      => $password,
                'created_on'    => $created_on,
                'Template_type' => 'Login_employee_mail'
            );
            //var_dump($Email_content);die;
            $this->send_mail->send_email_notification($Email_content);
            redirect('admin/register_user');
        // }else{
        //     $this->load->view("admin/login");
        // } 
        }
    }
    
}
?>