<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Query extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Query_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	/* query management */
	public function list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['query_details'] = $this->Query_model->get_query_details();
		    $this->load->view('admin/query/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function add(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['user_details'] = $this->Query_model->get_user_details();
		    $this->load->view('admin/query/add',$data);		
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
			
			$result = $this->Query_model->insert_query_details($data['Login_user_name']);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/query/list');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
	public function edit($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['user_details'] = $this->Query_model->get_user_details();
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			// var_dump($data['single_query_data']);die;
			$this->load->view("admin/query/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function update(){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$this->Query_model->update($id,$data['Login_user_name']);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/query/list');
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
			$data['delete'] = $this->Query_model->delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/query/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* / .query management */

	/* status management */
	public function add_status($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			// var_dump($data['id']);die;
		    $this->load->view('admin/query/status/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_status($id){
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['id'] = $id;
			$result = $this->Query_model->insert_status_details($id);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/query/list');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
	public function view($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			// var_dump($data['id']);die;
			$data['status_details'] = $this->Query_model->get_status_details($id);
			// var_dump($data['status_details']);die;
		    $this->load->view('admin/query/status/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_status(){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$status_details = $this->Query_model->status_details($id);
			$status = $this->input->post('status');
			// var_dump($status);die;
			// $id = $this->input->post('id');
			$records = $this->Query_model->update_status($id,$status);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/query/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* / .status management */
	/* followup management */
	public function add_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
		    $this->load->view('admin/query/followup/add',$data);		
		}	else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_followup($id){
		if($this->session->userdata('logged_in'))
		{
		   $session_data = $this->session->userdata('logged_in');
		   $data['Login_user_name']=$session_data['Login_user_name'];	
		   $data['Role_id']=$session_data['Role_id'];
		   $data['id'] = $id;
		   $result = $this->Query_model->insert_followup_details($id);
		   if($result == 1)
		   {
			   $this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
		   }
		   redirect('admin/query/view_followup/' .$id);
		}else
	   	{
		   $this->load->view("admin/login");
	   	}
	}
	public function view_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			// var_dump($data['id']);die;
			$data['followup_details'] = $this->Query_model->get_followup_details($id);
			// var_dump($data['followup_details']);die;
		    $this->load->view('admin/query/followup/list',$data);
		}
		else{			
			$this->load->view('admin/login');
		}
	
	}
	public function add_record($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
			$data['followup_record'] = $this->Query_model->get_followup_record($id);
			// $subject = $followup_record->subject; 
			// var_dump($subject);die;
		    $this->load->view('admin/query/followup/edit',$data);		
		}	else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_record($id){
	
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['id'] = $id;
			// var_dump($id);die;
			$result = $this->Query_model->insert_record($id);
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/query/view_followup/' .$id);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function delete_followup($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->Query_model->delete_followup($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/query/view_followup/' .$id);
		} else {
			$this->load->view("admin/login");
		}
	}
	public function view_followup_details($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			// $data['followup_details'] = $this->Query_model->get_view_followup_details($id);
			$followup_details = $this->Query_model->get_view_followup_details($id);
			$query_details= $this->Query_model->get_query_record($id);
			$data['subject'] = $followup_details->subject;
			$data['followup_date'] = $followup_details->followup_date;
			$data['client_comment'] = $followup_details->client_comment;
			$data['user_comment'] = $followup_details->user_comment;
			$data['scope_name'] = $query_details->scope_name;
			// var_dump($data['scope_name']);die;
		    $this->load->view('admin/query/followup/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>