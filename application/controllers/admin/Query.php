<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Query extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Query_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
/* Query management */
	public function list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			// $User_Type = $session_data['User_Type'];
			$data['department']=$session_data['department'];
			// $department = $session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";

			if($data['User_Type'] == "Admin"){
				$data['query_details'] = $this->Query_model->get_query_list1();
			}else if($data['User_Type'] == "Team Lead" && $data['department'] == "Marketing") {
				$data['query_details'] = $this->Query_model->get_query_list1();
			}else if($data['department'] == "Marketing") {
			  	$data['query_details'] = $this->Query_model->get_single_details_marketer($data['Login_user_name']);			
			}else{ 
				$data['query_details'] = $this->Query_model->get_details_assign_user($data['Login_user_name']);
		   	}		
		    $this->load->view('admin/query/list', $data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function add(){
		// echo "hii"; die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['ScopeList'] = $this->Query_model->get_scope_master();
			$data['id'] = $id;
			$data['qmenu_active'] = "active menu-open";
			$data['qadd'] = "active";
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
		    $this->load->view('admin/query/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$Login_user_name=$session_data['Login_user_name'];				
			$Role_id=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$source = $this->input->post('source');
			$reseller_name = $this->input->post('reseller_name');
			/* $reseller_details = $this->Query_model->get_single_reseller_details($reseller_name);
			$serviceno = $reseller_details->service_no; */
			$query_details = $this->Query_model->get_single_query_details();
			$last_row_id= $query_details->id;			

			$service_no = $serviceno.'-'.($last_row_id + 1);
			$query_id = 'QRIGR' .str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT);

			if($source == "Reseller"){
				$data = array(
					'query_code'                 => $query_id,
					'source'                     => $this->input->post('source'),
					'type'              		 => $this->input->post('type'),
					'source_mail_id'             => ltrim(rtrim($this->input->post('source_mail_id'))),
					'reseller_name'              => $this->input->post('reseller_name'),
					'service_no'                 => $service_no,					
					'scope_name'                 => $this->input->post('scope_name'),
					'report_name'                => ltrim(rtrim($this->input->post('report_name'))),
					'client_name'                => ltrim(rtrim($this->input->post('client_name'))),
					'designation'                => ltrim(rtrim($this->input->post('designation'))),
					'company_name'               => ltrim(rtrim($this->input->post('company_name'))),
					'client_email'               => ltrim(rtrim($this->input->post('client_email'))),
					'phone_no'                   => ltrim(rtrim($this->input->post('phone_no'))),
					'client_message'             => $this->input->post('client_message'),
				    'lead_date'                  => $this->input->post('lead_date'),
				    // 'assign_to_team'             => 0,
					'created_user'               => $Login_user_name,
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);				
				$result = $this->Query_model->insert_query_details($data);								
			}else if($source == "Email" || "Website"){
				$source_data = array(
					'query_code'                 =>$query_id,
					'source'                     => $this->input->post('source'),
					'type'              		 => $this->input->post('type'),
					'source_mail_id'             => ltrim(rtrim($this->input->post('source_mail_id'))),
					'scope_name'                 => $this->input->post('scope_name'),
					'report_name'                => ltrim(rtrim($this->input->post('report_name'))),					
					'client_name'                => ltrim(rtrim($this->input->post('client_name'))),
					'designation'                => ltrim(rtrim($this->input->post('designation'))),
					'company_name'               => ltrim(rtrim($this->input->post('company_name'))),
					'client_email'               => ltrim(rtrim($this->input->post('client_email'))),
					'phone_no'                   => ltrim(rtrim($this->input->post('phone_no'))),
					'client_message'             => $this->input->post('client_message'),
					'lead_date'                  => $this->input->post('lead_date'),
					// 'assign_to_team'             => 0,
					'created_user'               => $Login_user_name,
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);	
				// var_dump($source_data);die;		
				$result = $this->Query_model->insert_query_details($source_data);				
			}
			if($result){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not inserted....!!!');
			}
			if($Role_id == 7 || $Role_id == 1){
				redirect('admin/query/list');
			}else{
				redirect('admin/query/drafts');
			}			
	 	}else{
			$this->load->view("admin/login");
		}
	}
	public function edit($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$assign_analysis = $this->input->post('assign_analysis');
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			$data['scopelist'] = $this->Query_model->get_scope_master();			
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
			$data['assign_details'] = $this->Query_model->get_query_assign_details1($id);
			$this->load->view("admin/query/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function update(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$id = $this->input->post('id');			
			$reseller_name = $this->input->post('reseller_name');
			if($reseller_name == ""){
				$resellername = NULL;
			}else{
				$resellername =  $this->input->post('reseller_name');
			}
			/* $assign_to_team = $this->input->post('assign_to_team');
			//var_dump($assign_to_team);die;
			if($assign_to_team == "0"){
				$assigntoteam = 0;
			}else{
				$assigntoteam = 1;
			} */
			$update_query = array(        
                'source'                     => $this->input->post('source'),
                'source_mail_id'             => $this->input->post('source_mail_id'),
                'scope_name'                 => $this->input->post('scope_name'),
                'reseller_name'              => $resellername,
                'report_name'                => $this->input->post('report_name'),
				'type'              		 => $this->input->post('type'),
                'client_name'                => $this->input->post('client_name'),
                'designation'                => $this->input->post('designation'),
                'company_name'               => $this->input->post('company_name'),
                'client_email'               => $this->input->post('client_email'),
                'client_message'             => $this->input->post('client_message'),
                // 'assign_to_team'             => $assigntoteam,
                // 'assign_analyst'            => $this->input->post('assign_analyst'), 
				'lead_date'                  => $this->input->post('lead_date'), 
                // 'created_user'               => $data['Login_user_name'],
                'updated_on'                 => date('Y-m-d'),
            );
			// var_dump($update_query);die;
			$update_query = $this->Query_model->update_query_details($id,$update_query);

			/* $update_assignment_query = array(
				'status'                    => 0,
				'updated_at'                => date('Y-m-d'),
			);
			// var_dump($update_assignment_query);die;
			$result = $this->Query_model->update_assignment_data1($id,$update_assignment_query); */
			
			/* if($assign_to_team != "0"){
				$insert_assignment = array(
					'role_id'                   => $data['Role_id'],
					'query_id'                  => $id,
					'assigned_name'             => $this->input->post('assign_to_team'),
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d'),
				);
				// var_dump($insert_assignment);die;
				$result = $this->Query_model->insert_assignment_details($insert_assignment);
			} */
			if($update_query){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data has not updated successfully....!!!');
			}
			
		  /*   if($data['Login_user_name'] == $assign_to_team || $data['department'] == "Marketing"){
				redirect('admin/query/assign_list');
			} */
			redirect('admin/query/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$Query_delete = $this->Query_model->draft_delete($id);
			$Assing_query_delete = $this->Query_model->delete_assign_query($id);
			// var_dump($Query_delete);die;
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			if($data['department'] == "Sales" || $data['department'] == "Marketing"){
				redirect('admin/query/list');
			}
		//	redirect('admin/query/assign_list');
		}else{
			$this->load->view("admin/login");			
		}
	}

/* Self Queries */
public function query_edit($id){
	// var_dump($id);die;
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$assign_analysis = $this->input->post('assign_analysis');
		$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
		$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
		$data['scopelist'] = $this->Query_model->get_scope_master();			
		$data['reseller_list'] = $this->Query_model->get_reseller_list();
		$data['assign_query'] = $this->Query_model->get_query_assign_details1($id);
		// var_dump($data['assign_details']); die;
		$this->load->view("admin/query/query_edit",$data);
	}else{
		$this->load->view("admin/login");			
	}
}
public function query_update(){
	// var_dump($_POST);die;
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$id = $this->input->post('id');			
		$reseller_name = $this->input->post('reseller_name');
		if($reseller_name == ""){
			$resellername = NULL;
		}else{
			$resellername =  $this->input->post('reseller_name');
		}
		$assign_to_team = $this->input->post('assign_to_team');
		//var_dump($assign_to_team);die;
		if($assign_to_team == "0"){
			$assigntoteam = 0;
		}else{
			$assigntoteam = 1;
		} 
		$update_query = array(        
			'source'                     => $this->input->post('source'),
			'source_mail_id'             => $this->input->post('source_mail_id'),
			'scope_name'                 => $this->input->post('scope_name'),
			'reseller_name'              => $resellername,
			'report_name'                => $this->input->post('report_name'),
			'type'              		 => $this->input->post('type'),
			'client_name'                => $this->input->post('client_name'),
			'designation'                => $this->input->post('designation'),
			'company_name'               => $this->input->post('company_name'),
			'client_email'               => $this->input->post('client_email'),
			'client_message'             => $this->input->post('client_message'),
			'assign_to_team'             => $assigntoteam,
			'assign_analyst'            => $this->input->post('assign_analyst'), 
			'lead_date'                  => $this->input->post('lead_date'), 
			// 'created_user'               => $data['Login_user_name'],
			'updated_on'                 => date('Y-m-d')
		);
		// var_dump($update_query);die;
		$update_query = $this->Query_model->update_query_details($id,$update_query);

		$get_query_assigned_data = $this->Query_model->get_query_assigned_data($id,$assign_to_team);
		if($get_query_assigned_data == NULL){
			$update_assignment = array(
				'status'                    => 0,
				'updated_at'                => date('Y-m-d')
			);
			$result = $this->Query_model->update_assignment_data($id,$update_assignment);

			if($assign_to_team != "0"){
				$insert_assignment = array(
					'role_id'                   => $data['Role_id'],
					'query_id'                  => $id,
					'assigned_name'             => $this->input->post('assign_to_team'),
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_assignment_details($insert_assignment);
			}
		}
		if($update_query){
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
		} else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
		}			
		if($data['Login_user_name'] == $assign_to_team){
			redirect('admin/query/list');
		}else{
			redirect('admin/query/assign_list');
		}
	}else{
		$this->load->view("admin/login");			
	}
}
/* ./ Self Queries */
/* Drafted Queries */
	public function drafts(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";

			$data['draft_data'] = $this->Query_model->get_draft_details($data['Login_user_name']);
		    $this->load->view('admin/query/draft_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function draft_edit($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$assign_analysis = $this->input->post('assign_analysis');
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['single_query'] = $this->Query_model->get_single_query_data($id);
			$data['scopelist'] = $this->Query_model->get_scope_master();
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
			$this->load->view("admin/query/draft_edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function draft_update(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$id = $this->input->post('id');
			$reseller_name = $this->input->post('reseller_name');
			if($reseller_name == ""){
				$resellername = NULL;
			}else{
				$resellername =  $this->input->post('reseller_name');
			}
			$assign_to_team = $this->input->post('assign_to_team');
			if($assign_to_team == "0"){
				$assigntoteam = 0;
			}else{
				$assigntoteam = 1;
			}
			$update_query = array(        
                'source'                     => $this->input->post('source'),
                'source_mail_id'             => $this->input->post('source_mail_id'),
                'scope_name'                 => $this->input->post('scope_name'),
                'reseller_name'              => $resellername,
                'report_name'                => $this->input->post('report_name'),
				'type'              		 => $this->input->post('type'),
                'client_name'                => $this->input->post('client_name'),
                'designation'                => $this->input->post('designation'),
                'company_name'               => $this->input->post('company_name'),
                'client_email'               => $this->input->post('client_email'),
                'client_message'             => $this->input->post('client_message'),
                'assign_to_team'             => $assigntoteam,
                'assign_analyst'             => $this->input->post('assign_analyst'), 
				'lead_date'                  => $this->input->post('lead_date'),
                'updated_on'                 => date('Y-m-d')
            );
			$update_query = $this->Query_model->update_query_details($id,$update_query);
			
			if($assign_to_team != "0"){
				$insert_assignment = array(
					'role_id'                   => $data['Role_id'],
					'query_id'                  => $id,
					'assigned_name'             => $this->input->post('assign_to_team'),
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d'),
				);
				$result = $this->Query_model->insert_assignment_details($insert_assignment);
				if($data['Login_user_name'] == $this->input->post('assign_to_team')){
					redirect('admin/query/list');
				}else{
					redirect('admin/query/assign_list');
				}				
			}
			if($update_query){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated....!!!');
			}			
			redirect('admin/query/drafts');
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function draft_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$result = $this->Query_model->draft_delete($id);
			if($result){
				$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not deleted....!!!');
			}			
			redirect('admin/query/drafts');
		}else{
			$this->load->view("admin/login");			
		}
	}	
/* ./ Drafted Queries */

/* Upcoming Queries */
	public function upcoming_query_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";
			
			$data['query_data'] = $this->Query_model->get_not_assigned_query_data();
			// var_dump($data['query_data']);die;
		    $this->load->view('admin/query/upcoming_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function upcoming_query_edit($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$assign_analysis = $this->input->post('assign_analysis');

			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
			$data['scopelist'] = $this->Query_model->get_scope_master();
			$this->load->view("admin/query/upcoming_edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function upcoming_query_update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['User_Type']=$session_data['User_Type'];
			$data['Role_id']=$session_data['Role_id'];
			$data['department']=$session_data['department'];

			$id = $this->input->post('id');			
			$resellername = $this->input->post('reseller_name');
			if($resellername == ""){
				$resellername = NULL;
			}else{
				$resellername = $this->input->post('reseller_name');
			}
			$assign_to_team = $this->input->post('assign_to_team');
			if($assign_to_team == "0"){
				$assigntoteam = 0;
			}else{
				$assigntoteam = 1;
			}
			$update_upcoming_data = array(        
                'source'                     => $this->input->post('source'),
                'source_mail_id'             => $this->input->post('source_mail_id'),
                'scope_name'                 => $this->input->post('scope_name'),
                'reseller_name'              => $resellername,
                'report_name'                => $this->input->post('report_name'),
				'type'              		 => $this->input->post('type'),
                'client_name'                => $this->input->post('client_name'),
                'designation'                => $this->input->post('designation'),
                'company_name'               => $this->input->post('company_name'),
                'client_email'               => $this->input->post('client_email'),
                'client_message'             => $this->input->post('client_message'),
                'assign_to_team'             => $assigntoteam,
                'assign_analyst'             => $this->input->post('assign_analyst'), 
				'lead_date'                  => $this->input->post('lead_date'), 
                // 'created_user'               => $data['Login_user_name'],
                'updated_on'                 => date('Y-m-d')
            );
			$update_upcoming_data = $this->Query_model->update_upcoming_records($id,$update_upcoming_data);

			if($assign_to_team != "0"){
				$insert_assignment = array(
					'role_id'                   => $data['Role_id'],
					'query_id'                  => $id,
					'assigned_name'             => $this->input->post('assign_to_team'),
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_assignment_details($insert_assignment);
			}
			if($update_upcoming_data){
				$this->session->set_flashdata('msg', 'Data has been updated successfully...!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
			}
			redirect('admin/query/upcoming_query_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function upcoming_query_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$result = $this->Query_model->delete_upcoming_query($id);
			if($result){
				$this->session->set_flashdata('msg', 'Record has been deleted successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Record not delete...!!!');
			}			
			redirect('admin/query/upcoming_query_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
/* ./ Upcoming Queries */

/* Assigned Queries */
	public function assign_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";
			$data['assign_details'] = $this->Query_model->get_query_assign_details();			
			$data['query_list'] = $this->Query_model->get_query_list($data['Login_user_name']);
			// var_dump($data['query_list'] ); die;
		    $this->load->view('admin/query/assign_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}	
	public function assign_edit($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$data['scopelist'] = $this->Query_model->get_scope_master();
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
			$data['assign_query'] = $this->Query_model->get_query_assign1($id);
			// var_dump($data['user_details']);die;
			$this->load->view("admin/query/assign_edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function assign_update(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$department =$session_data['department'];

			$id = $this->input->post('id');
			$resellername = $this->input->post('reseller_name');
			if($resellername == ""){
				$resellername = NULL;
			}else{
				$resellername = $this->input->post('reseller_name');
			}
			$assign_to_team = $this->input->post('assign_to_team');
			if($assign_to_team == "0"){
				$assigntoteam = 0;
			}else{
				$assigntoteam = 1;
			}
			$update_query = array(        
                'source'                     => $this->input->post('source'),
                'source_mail_id'             => $this->input->post('source_mail_id'),
                'scope_name'                 => $this->input->post('scope_name'),
                'reseller_name'              => $resellername,
                'report_name'                => $this->input->post('report_name'),
				'type'              		 => $this->input->post('type'),
                'client_name'                => $this->input->post('client_name'),
                'designation'                => $this->input->post('designation'),
                'company_name'               => $this->input->post('company_name'),
                'client_email'               => $this->input->post('client_email'),
                'client_message'             => $this->input->post('client_message'),
                'assign_to_team'             => $assigntoteam,
                'assign_analyst'            => $this->input->post('assign_analyst'), 
				'lead_date'                  => $this->input->post('lead_date'), 
                'updated_on'                 => date('Y-m-d')
            );
			$update_query = $this->Query_model->update_query_details($id, $update_query);
			
			$get_query_assigned_data = $this->Query_model->get_query_assigned_data($id,$assign_to_team);
			if($get_query_assigned_data == NULL){
				$update_assignment = array(
					'status'                    => 0,
					'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->update_assignment_data($id,$update_assignment);

				if($assign_to_team != "0"){
					$insert_assignment = array(
						'role_id'                   => $data['Role_id'],
						'query_id'                  => $id,
						'assigned_name'             => $this->input->post('assign_to_team'),
						'created_at'                => date('Y-m-d'),
						'updated_at'                => date('Y-m-d')
					);
					$result = $this->Query_model->insert_assignment_details($insert_assignment);
				}
			}
			if($update_query){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
			}			
			if($data['Login_user_name'] == $assign_to_team){
				redirect('admin/query/list');
			}else{
				redirect('admin/query/assign_list');
			}			
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function assign_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

			$result = $this->Query_model->delete_assign_query($id);
			if($result){
				$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not deleted....!!!');
			}			
			redirect('admin/query/assign_list');
		}else{
			$this->load->view("admin/login");			
		}
	}	
/* ./ Assigned Queries */

	/* public function assign_user($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['title'] = "Assign User";
			$data['single_data'] = $this->Query_model->get_single_data($id);
			$report_name = $data['single_data']->report_name;
			$data['user_details'] = $this->Query_model->get_user_data();
			$this->load->view('admin/query/assign_user',$data,$report_name);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	
	public function update_assigned_user($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['title'] = "Update Assigned User";
			$id = $id;
			$updatedata = array(
				'created_user'=>$this->input->post('user_name')
			);
			$result = $this->Query_model->update_query_user($updatedata, $id);
			redirect('admin/query/list');
		}else{			
			$this->load->view('admin/login');
		}
	} */    
	
	/* / .query management */

	/* status management */
	public function add_status($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
		    $this->load->view('admin/query/status/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_status($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
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
		// echo "hii"; die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			$data['status_details'] = $this->Query_model->get_status_details($id);
		    $this->load->view('admin/query/status/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_status(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$id = $this->input->post('id');
			$status_details = $this->Query_model->status_details($id);
			$status = $this->input->post('status');
			$records = $this->Query_model->update_status($id,$status);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/query/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* / .status management */

	/* FollowUp management */
	public function add_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');

			$data['id'] = $id;			
		    $this->load->view('admin/query/followup/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_followup($id){
		if($this->session->userdata('logged_in')){
		   	$session_data = $this->session->userdata('logged_in');
		   	$data['Login_user_name']=$session_data['Login_user_name'];	
		   	$data['Role_id']=$session_data['Role_id'];
		   	$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
		   	$data['id'] = $id;
		   	$result = $this->Query_model->insert_followup_details($id);
			if($result == 1){
					$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}else{
					$this->session->set_flashdata('msg', 'Sorry! Data not inserted....!!!');
			}
		   	redirect('admin/query/view_followup/' .$id);
		}else{
		   	$this->load->view("admin/login");
	   	}
	}
	public function view_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			
			$data['id'] = $id;	
			$data['followup_details'] = $this->Query_model->get_followup_details($id);
		    $this->load->view('admin/query/followup/list',$data);
		}else{			
			$this->load->view('admin/login');
		}	
	}
	public function add_record($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
			$data['followup_record'] = $this->Query_model->get_followup_record($id);
		    $this->load->view('admin/query/followup/add_record',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_record($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['id'] = $id;
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
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['designation']=$session_data['designation'];
			$data['delete'] = $this->Query_model->delete_followup($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/query/view_followup/' .$id);
		} else {
			$this->load->view("admin/login");
		}
	}
	public function edit_followup_details($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			$data['followup_details'] = $this->Query_model->get_view_followup_details($id);
		    $this->load->view('admin/query/followup/edit',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['id'] = $id;
			$result = $this->Query_model->update_followup($id);
			if($result){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry! Data has not been updated....!!!');
			}
			redirect('admin/query/view_followup/' .$id);
		}else {
			$this->load->view("admin/login");
		}
	}
	public function view_followup_details($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			$followup_details= $this->Query_model->get_view_followup_details($id);
			$data['query_id'] = $followup_details->query_id;
			$data['subject'] = $followup_details->subject;
			$data['followup_date'] = $followup_details->followup_date;
			$data['client_comment'] = $followup_details->client_comment;
			$data['user_comment'] = $followup_details->user_comment;
			$data['scope_name'] = $query_details->scope_name;
		    $this->load->view('admin/query/followup/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
/* /.followup management */

	/* Reseller management */
	
	public function add_reseller(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
		    $this->load->view('admin/query/reseller/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_reseller(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$result = $this->Query_model->insert_reseller_details();
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/query/reseller_list');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
	public function reseller_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['rmenu_active'] = "active menu-open";
			$data['rqlist'] = "active";
			$data['reseller_details'] = $this->Query_model->get_reseller_details();
		    $this->load->view('admin/query/reseller/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function reseller_edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['reseller_details'] = $this->Query_model->get_single_reseller_record($id);
			$this->load->view("admin/query/reseller/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function reseller_update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$id = $this->input->post('id');
			$this->Query_model->reseller_update($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/query/reseller_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function reseller_delete($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['delete'] = $this->Query_model->reseller_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/query/reseller_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* /.Reseller management */
}
?>