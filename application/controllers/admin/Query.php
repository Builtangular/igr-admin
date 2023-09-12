<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');

include_once(APPPATH."third_party/PhpWord/Autoloader.php");
class Query extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Query_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));				
	}
/* Query management */
public function marketing_query_list(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$data['qmenu_active'] = "active menu-open";
		$data['qlist'] = "active";
		$data['query_details'] = $this->Query_model->get_team_query_list();
		// var_dump($data['query_details']);die;
		$this->load->view('admin/query/marketing_query_list',$data);			
	}else{			
		$this->load->view('admin/login');
	}
}
	public function list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";
			if($data['User_Type'] == "Admin"){
				$data['query_details'] = $this->Query_model->get_query_list1();
			}else if($data['User_Type'] == "Team Lead" && $data['department'] == "Marketing") {
				$data['query_details'] = $this->Query_model->get_team_query_list();
			}else if($data['department'] == "Marketing") {
			  	$data['query_details'] = $this->Query_model->get_single_details_marketer($data['Login_user_name']);	
				//   var_dump($data['query_details']);die;		
			}else{ 
				$data['query_details'] = $this->Query_model->get_details_assign_user($data['Login_user_name']);
				$data['todays_followup'] = $this->Query_model->get_todays_followup_queries($data['Login_user_name']);
				// echo "<pre>"; print_r(count($data['todays_followup'])); die;
		   	}		
		    $this->load->view('admin/query/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function close_query_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			// $User_Type = $session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			// $department = $session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qclist'] = "active";
			$data['query_details'] = $this->Query_model->get_query_data1();
			$data['close_details'] = $this->Query_model->get_query_close_data();
			// var_dump($data['query_details']);die;
		    $this->load->view('admin/query/close_list',$data);			
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
			$data['userid']=$session_data['userid'];
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
            $data['userid']=$session_data['userid'];
			$source = $this->input->post('source');
			$reseller_name = $this->input->post('reseller_name');
			/* $reseller_details = $this->Query_model->get_single_reseller_details($reseller_name);
			$serviceno = $reseller_details->service_no; */
			$query_details = $this->Query_model->get_single_query_details();
			$last_row_id= $query_details->id;
			

			/* Whatsapp Chat */
			$type              		 	= $this->input->post('type');
			$title                		= $this->input->post('scope_name').' '.ltrim(rtrim($this->input->post('report_name')));
			$client_name                = ltrim(rtrim($this->input->post('client_name')));
			$designation                = ltrim(rtrim($this->input->post('designation')));
			$company                    = ltrim(rtrim($this->input->post('company_name')));
			$client_email               = ltrim(rtrim($this->input->post('client_email')));
			$phone                      = ltrim(rtrim($this->input->post('phone_no')));
			$client_message             = $this->input->post('client_message');
			$lead_date                  = $this->input->post('lead_date');

			/* $ultramsg_token="gkkdi03d36x0dt1j"; // Ultramsg.com token
			$instance_id="instance52890"; // Ultramsg.com instance id */
			$ultramsg_token="1xiu00n179xa8f6x"; // Ultramsg.com token
			$instance_id="instance53125"; // Ultramsg.com instance id
			$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

			$to="9511986084"; 
			// $to="7758060189"; 
			$body="Dear Priyanka,

			We are having ".$type." for ".$title.".
			
			Please find details below:

			Client Name: ".$client_name." 
			Email: ".$client_email." 
			Phone: ".$phone." 
			Designation: ".$designation." 
			Company: ".$company." 
			Message: ".$client_message."
			Lead Date: ".$lead_date; 
			$api=$client->sendChatMessage($to,$body);
			// print_r($api); die;
			/* ./ Whatsapp Chat */

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
					'linkedin_profile'             => $this->input->post('linkedin_profile'),
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
					'linkedin_profile'             => $this->input->post('linkedin_profile'),
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
			$data['userid']=$session_data['userid'];
			$data['close']= $this->input->post('close_query_list');	
			// var_dump($data['close']);die;
			$assign_analysis = $this->input->post('assign_analysis');
			// $data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['user_details'] = $this->Query_model->get_sales_user_details();
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
			$data['userid']=$session_data['userid'];
			$id = $this->input->post('id');
			$close= $this->input->post('close_query_list');	
			// var_dump($close);die;		
			$reseller_name = $this->input->post('reseller_name');
			if($reseller_name == ""){
				$resellername = NULL;
			}else{
				$resellername =  $this->input->post('reseller_name');
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
                'linkedin_profile'             => $this->input->post('linkedin_profile'),
                // 'assign_to_team'             => $assigntoteam,
                // 'assign_analyst'            => $this->input->post('assign_analyst'), 
				'lead_date'                  => $this->input->post('lead_date'), 
                // 'created_user'               => $data['Login_user_name'],
                'updated_on'                 => date('Y-m-d'),
            );
			// var_dump($update_query);die;
			$update_query = $this->Query_model->update_query_details($id,$update_query);
			if($update_query){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data has not updated successfully....!!!');
			}
			if($close){
				redirect('admin/query/close_query_list');
			}
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
			$data['userid']=$session_data['userid'];
			$Query_delete = $this->Query_model->draft_delete($id);
			$Assing_query_delete = $this->Query_model->delete_assign_query($id);
			$close_delete= $this->input->post('delete_query_list');	
			// var_dump($close_delete);die;
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			if($close_delete){
				redirect('admin/query/close_query_list');
			}
			else if($data['department'] == "Sales" || $data['department'] == "Marketing"){
				redirect('admin/query/list');
			
			}
		//	redirect('admin/query/assign_list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function close_delete($id){
		// var_dump($id);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$delete = $this->Query_model->delete_query_data($id);
			$delete = $this->Query_model->close_delete($id);
			// $Assing_query_delete = $this->Query_model->delete_assign_query($id);
			$close_delete= $this->input->post('delete_query_list');	
			// var_dump($delete);die;
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			if($close_delete){
				redirect('admin/query/close_query_list');
			}
			else if($data['department'] == "Sales" || $data['department'] == "Marketing"){
				redirect('admin/query/list');
			}
			//redirect('admin/query/assign_list');
		}else{
			$this->load->view("admin/login");			
		}
	}

/* Self Queries */
public function insert_comment(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$userid =$session_data['userid'];
		$id = $this->input->post('id');		
		$insert_query_comment = array(
				'query_id'                  => $id,
				'user_id'                   => $userid,
				'user_name'                 => $data['Login_user_name'],
				'comment'                   => $this->input->post('comment'),
				'created_at'                => date('Y-m-d'),
				// 'updated_at'                => date('Y-m-d')
			);
			// var_dump($insert_query_comment);die;
			$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
		$this->load->view("admin/query/query_edit",$data);
	}else{
		$this->load->view("admin/login");			
	}
}

public function query_edit($id){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];

		$data['id'] = $id;
		// $data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
		$data['user_details'] = $this->Query_model->get_sales_user_details();
		$data['single_user_details'] = $this->Query_model->get_single_user_details();
		$data['query_comment'] = $this->Query_model->get_query_comment_data($id,$data['Login_user_name']);	
		// var_dump($data['query_comment']);die;	
		$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
		$data['source'] = $data['single_query_data']->source;
		$data['type'] = $data['single_query_data']->type;
		$data['source_mail_id'] = $data['single_query_data']->source_mail_id;
		$data['scope_name'] = $data['single_query_data']->scope_name;
		$data['report_name'] = $data['single_query_data']->report_name;
		$data['client_name'] = $data['single_query_data']->client_name;
		$data['client_email'] = $data['single_query_data']->client_email;
		$data['phone_no'] = $data['single_query_data']->phone_no;
		$data['client_message'] = $data['single_query_data']->client_message;
		$data['designation'] = $data['single_query_data']->designation;
		$data['lead_date'] = $data['single_query_data']->lead_date;
		$data['company_name'] = $data['single_query_data']->company_name;		
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
		$data['userid']=$session_data['userid'];
		$userid =$session_data['userid'];
		$id = $this->input->post('id');
		// var_dump($commentfor);die; 
		$reseller_name = $this->input->post('reseller_name');
		$fullname = $this->input->post('fullname');
		// var_dump($fullname);die;
		if($reseller_name == ""){
			$resellername = NULL;
		}else{
			$resellername =  $this->input->post('reseller_name');
		}
		$assign_to_team = $this->input->post('assign_to_team');
		// var_dump($assign_to_team);die;
		if($assign_to_team == "0"){
		  $assigntoteam = 0;
		}else{
			$assigntoteam = 1;
		} 
		/* assign to analyst */
		$update_query = array(  
			'priority'	=> $this->input->post('priority'),
			'assign_analyst'	=> $this->input->post('assign_analyst'),
		);
		// var_dump($update_query);die;
		$update_query = $this->Query_model->update_query_details($id,$update_query);
		/* ./ assign to analyst */

		/* to change query assign status */
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
		/* ./ to change query assign status */

		/* add new comment */
		$file ='';
		$config = array(
			'upload_path' 	=> "assets/admin/attach-file",
			'allowed_types' => "*",
			'encrypt_name'	=> false,
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('attachment')){
			$file_data = $this->upload->data();				
			$file = $file_data['file_name'];
				
		}else{
			$error = array('error' => $this->upload->display_errors());	
			$this->upload->display_errors();
			$file = Null;
		}
		if($this->input->post('comment')!=""){
			$insert_query_comment = array(
				'query_id'                  => $id,
				'user_id'                   => $userid,
				'user_name'                 => $data['Login_user_name'],
				'comment'                   => $this->input->post('comment'),
				'comment_for'               => $fullname,
				'attachment'                => $file,
				'created_at'                => date('Y-m-d'),
				// 'updated_at'                => date('Y-m-d')
			);
			// var_dump($insert_query_comment);die;
			$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
		}	
		/* ./ add new comment */	
		if($result){
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
		} else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
		}			
		if($data['Login_user_name'] == $assign_to_team){
			redirect('admin/query/query_edit/'.$id);
		}else{
			redirect('admin/query/assign_list');
		}
	}else{
		$this->load->view("admin/login");			
	}
}
public function daily_analyst_query(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$data['qmenu_active'] = "active menu-open";
		$data['qlist'] = "active";
		$date= date("Y-m-d");
		$data['query_details'] = $this->Query_model->get_todays_analyst_queries($data['Login_user_name'],$date);
		// var_dump($data['query_details']);die;
		$this->load->view('admin/query/daily_analyst_list',$data);			
	}else{			
		$this->load->view('admin/login');
	}
}
public function daily_queries(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$data['qmenu_active'] = "active menu-open";
		$data['qlist'] = "active";
		$data['qlist'] = "active";
		$date= date("Y-m-d");
		$data['assign_details'] = $this->Query_model->get_query_assign_details();
		$data['query_list'] = $this->Query_model->get_todays_queries($data['Login_user_name'],$date);
		$this->load->view('admin/query/daily_queries_list',$data);			
	}else{			
		$this->load->view('admin/login');
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
			$data['qdraft'] = "active";
			$data['draft_data'] = $this->Query_model->get_draft_details($data['Login_user_name']);
			// var_dump($data['draft_data']);die;
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
			$data['userid']=$session_data['userid'];
			$assign_analysis = $this->input->post('assign_analysis');
			// $data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['user_details'] = $this->Query_model->get_sales_user_details();
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
			$data['userid']=$session_data['userid'];
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
                'linkedin_profile'           => $this->input->post('linkedin_profile'),
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qlist'] = "active";
			if($data['User_Type'] == "Manager" && $data['department'] == "Research"){
				$data['query_data'] = $this->Query_model->get_not_assigned_query_details();
				// var_dump($data['query_data']);die;
			}else{
				$data['query_data'] = $this->Query_model->get_not_assigned_query_data();
				//var_dump($data['query_data']);die;
			}
		    $this->load->view('admin/query/upcoming_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function upcoming_query_edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			// $data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['user_details'] = $this->Query_model->get_sales_user_details();
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
			$data['userid']=$session_data['userid'];
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
				'lead_date'                  => $this->input->post('lead_date'), 
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
			/* if($assign_analyst){
				redirect('admin/query/upcoming_query_list');
			}
				redirect('admin/query/assign_list'); */
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
			$data['userid']=$session_data['userid'];
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
/* Research Upcoming Queries */
public function upcoming_research_query_list(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$data['qmenu_active'] = "active menu-open";
		$data['qlist'] = "active";
		$data['query_data'] = $this->Query_model->get_not_assigned_query_details();
		$this->load->view('admin/query/upcoming_research_list',$data);			
	}else{			
		$this->load->view('admin/login');
	}
}
public function upcoming_research_query_edit($id){
	// var_dump($id);die;
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		
		$data['query_comment'] = $this->Query_model->get_query_comment_data($id,$data['Login_user_name']);	
		$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
		$data['type'] = $data['single_query_data']->type;
		$data['report_name'] = $data['single_query_data']->report_name;
		$data['scope_name'] = $data['single_query_data']->scope_name;
		$data['designation'] = $data['single_query_data']->designation;
		$data['client_name'] = $data['single_query_data']->client_name;
		$data['client_message'] = $data['single_query_data']->client_message;
		$data['company_name'] = $data['single_query_data']->company_name;
		$data['lead_date'] = $data['single_query_data']->lead_date;
		$data['user_details'] = $this->Query_model->get_user_records();
		$this->load->view("admin/query/upcoming_research_query_edit",$data);
	}else{
		$this->load->view("admin/login");			
	}
}
public function upcoming_research_query_update(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['User_Type']=$session_data['User_Type'];
		$data['Role_id']=$session_data['Role_id'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$userid = $session_data['userid'];

		$id = $this->input->post('id');	
		$assign_to_team = $this->input->post('assign_to_team');	
		// var_dump($id);die;
			if($assign_analyst != "0"){
				$insert_research_assignment = array(
					'role_id'                   => $data['Role_id'],
					'query_id'                  => $id,
					'assigned_name'             => $this->input->post('assign_to_team'),
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_research_assignment($insert_research_assignment);
				
				if($assign_analyst != "0"){
					$update_research_assignment = array(
						'assign_to_team_analyst'	=> 1,
					);
					$result = $this->Query_model->update_research_assignment($id,$update_research_assignment);
				}
			}
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$file_data = $this->upload->data();				
				$file = $file_data['file_name'];
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
				$file = NULL;
			}
		
			if($this->input->post('comment')!=""){
				$insert_query_comment = array(
					'query_id'                  => $id,
					'user_id'                   => $userid,
					'user_name'                 => $data['Login_user_name'],
					'comment_for'               => $assign_to_team,
					'comment'                   => $this->input->post('comment'),
					'attachment'                => $file,
					'created_at'                => date('Y-m-d'),
					// 'updated_at'                => date('Y-m-d')
				);
				// var_dump($insert_query_comment);die;
				$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
			}	
		// $assign_query_records = $this->Query_model->get_assign_query_records($data['Login_user_name']);
		// var_dump($assign_query_records);die;
		if($result){
			$this->session->set_flashdata('msg', 'Data has been updated successfully...!!!');
		}else{
			$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
		}
		redirect('admin/query/research_assign_list');
		
	}else{
		$this->load->view("admin/login");			
	}
}
public function research_assign_query_list(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');

		$data['page_title'] = "Closed";
		$data['query_list'] = $this->Query_model->get_research_assign_query_list($data['Login_user_name']);
		$this->load->view('admin/query/research_assign_query_list',$data);				
	}else{			
		$this->load->view('admin/login');
	}
}
public function research_daily_assigned_query_list(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');

		$data['page_title'] = "Open";
		$data['query_list'] = $this->Query_model->get_research_daily_assigned_query_list($data['Login_user_name']);
		$this->load->view('admin/query/research_assign_query_list',$data);			
	}else{			
		$this->load->view('admin/login');
	}
}
public function view_research_assign_query($id){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$Login_user_name=$session_data['Login_user_name'];
		$data['id'] = $id;
		$query_details= $this->Query_model->get_view_query_details($data['Login_user_name'],$id);
		$data['query_comment'] = $this->Query_model->get_query_comment_data($id,$data['Login_user_name']);
		$query = $this->Query_model->get_single_query_records($Login_user_name);
		$data['user_name'] = $query->user_name;
		// var_dump($data['query_comment']);die;
		$data['type'] = $query_details->type;
		$data['report_name'] = $query_details->report_name;		
		$data['query_id'] = $query_details->query_id;
		$data['scope_name'] = $query_details->scope_name;
		$data['designation'] = $query_details->designation;
		$data['client_message'] = $query_details->client_message;
		$data['client_name'] = $query_details->client_name;
		$data['company_name'] = $query_details->company_name;
		$data['lead_date'] = $query_details->lead_date;
		// $data['assigned_date'] = $query_details->updated_at;
		$this->load->view('admin/query/view_research_assign_query',$data);		
	}else{			
		$this->load->view('admin/login');
	}
}
public function research_assign_list(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid']=$session_data['userid'];
		$data['massage'] = $this->session->userdata('msg');
		$data['qmenu_active'] = "active menu-open";
		$data['qlist'] = "active";
		$data['assign_details'] = $this->Query_model->get_query_assign_details();
		$data['query_list'] = $this->Query_model->get_query_assigned_research_list($data['Login_user_name']);
		$this->load->view('admin/query/research_assign_list',$data);			
	}else{			
		$this->load->view('admin/login');
	}
}	
public function research_assign_edit($id){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
		$data['userid'] =$session_data['userid'];
		
		$data['query_comment'] = $this->Query_model->get_single_query_comment($id);
		$data['user_name'] = $data['query_comment']->user_name;
		$data['query_id'] = $id;
		$data['user_details'] = $this->Query_model->get_research_assign_user_details($data['User_Type']);
		$data['assign_query'] = $this->Query_model->get_query_research_assign($id);
		$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
		$data['type'] = $data['single_query_data']->type;
		$data['report_name'] = $data['single_query_data']->report_name;
		$data['scope_name'] = $data['single_query_data']->scope_name;
		$data['designation'] = $data['single_query_data']->designation;
		$data['client_name'] = $data['single_query_data']->client_name;
		$data['client_message'] = $data['single_query_data']->client_message;
		$data['company_name'] = $data['single_query_data']->company_name;
		$data['lead_date'] = $data['single_query_data']->lead_date;
		$this->load->view("admin/query/research_assign_edit",$data);
	}else{
		$this->load->view("admin/login");			
	}
}
public function research_assign_update(){
	if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];
		$data['Role_id']=$session_data['Role_id'];
		$data['User_Type']=$session_data['User_Type'];
		$department =$session_data['department'];
		$data['userid']=$session_data['userid'];
		$userid =$session_data['userid'];
		
		$id = $this->input->post('id');		
		$assign_to_team = $this->input->post('assign_to_team');		
		$get_query_assigned_data = $this->Query_model->get_query_research_assigned_data($id,$assign_to_team);
		if($get_query_assigned_data == NULL){
			/* Update assignment record */
			$update_assignment = array(
				'status'      	=> 0,
				'updated_at'	=> date('Y-m-d')
			);
			$update_result = $this->Query_model->update_research_assignment_data($id,$update_assignment);
			/* ./ Update assignment record */
			/* Insert assignment record */
			$insert_research_assignment = array(
				'role_id'                   => $data['Role_id'],
				'query_id'                  => $id,
				'assigned_name'             => $this->input->post('assign_to_team'),
				'created_at'                => date('Y-m-d'),
				'updated_at'                => date('Y-m-d')
			);
			$result = $this->Query_model->insert_research_assignment($insert_research_assignment);
			/* ./ Insert assignment record */
		}
		/* Upload attachment in directory */
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$file_data = $this->upload->data();				
				$file = $file_data['file_name'];
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
				$file = NULL;
			}
		/* ./ Upload attachment in directory */
		if($this->input->post('comment')!=""){
			$insert_query_comment = array(
				'query_id'                  => $id,
				'user_id'                   => $userid,
				'user_name'                 => $data['Login_user_name'],
				'comment_for'               => $assign_to_team,
				'comment'                   => $this->input->post('comment'),
				'attachment'                => $file,
				'created_at'                => date('Y-m-d')
			);
			$result = $this->Query_model->insert_research_query_comment_details($insert_query_comment);
		}
		if($result){
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
		} else {
			$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
		}
		redirect('admin/query/research_assign_list');					
	}else{
		$this->load->view("admin/login");			
	}
}  
/* ./ Research Upcoming Queries */
/* Assigned Queries */
	public function assign_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['qmenu_active'] = "active menu-open";
			$data['qalist'] = "active";
			$data['assign_details'] = $this->Query_model->get_query_assign_details();
			if($data['User_Type'] == "Manager" && $data['department'] == "Research")
			{
			  $data['query_list'] = $this->Query_model->get_query_assigned_research_list($data['Login_user_name']);
			//   var_dump($data['query_list']);die;
			}else {			
			  $data['query_list'] = $this->Query_model->get_query_list($data['Login_user_name']);
			}
			// var_dump($data['query_list'] ); die;
		    $this->load->view('admin/query/assign_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}	
	public function assign_edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$assign_to_team = $this->input->post('assign_to_team');
			$assign_analysis = $this->input->post('assign_analysis');
			$data['scopelist'] = $this->Query_model->get_scope_master();
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			$data['reseller_list'] = $this->Query_model->get_reseller_list();
			$data['single_user_details'] = $this->Query_model->get_single_user_details();
			$data['user_details'] = $this->Query_model->get_sales_user_details();
			$data['assign_query'] = $this->Query_model->get_query_assign1($id);
			$data['query_comment'] = $this->Query_model->get_query_comment_data($id,$data['Login_user_name']);
			$data['single_query_data'] = $this->Query_model->get_single_query_data($id);
			$data['source'] = $data['single_query_data']->source;
			$data['type'] = $data['single_query_data']->type;
			$data['source_mail_id'] = $data['single_query_data']->source_mail_id;
			$data['scope_name'] = $data['single_query_data']->scope_name;
			$data['report_name'] = $data['single_query_data']->report_name;
			$data['client_name'] = $data['single_query_data']->client_name;
			$data['client_email'] = $data['single_query_data']->client_email;
			$data['phone_no'] = $data['single_query_data']->phone_no;
			$data['client_message'] = $data['single_query_data']->client_message;
			$data['designation'] = $data['single_query_data']->designation;
			$data['lead_date'] = $data['single_query_data']->lead_date;
			$data['user_name'] = $data['single_query_data']->user_name;
			$data['company_name'] = $data['single_query_data']->company_name;
			$data['assign_to_team_analyst'] = $data['assign_to_team_analyst']->user_name;
			$this->load->view("admin/query/assign_edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function assign_update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$department =$session_data['department'];
			$data['userid']=$session_data['userid'];
			$userid =$session_data['userid'];
			$Login_user_name=$session_data['Login_user_name'];	
			$excomment = $this->input->post('excomment');
			// $data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['user_details'] = $this->Query_model->get_sales_user_details();
			$id = $this->input->post('id');
			$fullname = $this->input->post('fullname');
			// var_dump($fullname);die;
			$assign_to_team = $this->input->post('assign_to_team');
			/* assign to analyst */
			if($assign_to_team == "0"){
				$assigntoteam = 0;
			}else{
				$assigntoteam = 1;
			}
			$update_query = array(  
                'assign_analyst'             => $this->input->post('assign_analyst'), 
            );
			$update_query = $this->Query_model->update_query_details($id, $update_query);
			/* ./ assign to analyst */

			/* to change query assign status */
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
			/* ./ to change query assign status */

			/* add new comment */
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
			$this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$file_data = $this->upload->data();				
				$file = $file_data['file_name'];
					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
				$file = Null;
			}
		    if($this->input->post('comment')!=""){
				$insert_query_comment = array(
					'query_id'                  => $id,
					'user_id'                   => $userid,
					'user_name'                 => $data['Login_user_name'],
					'comment'                   => $this->input->post('comment'),
					'comment_for'               => $fullname,
					'attachment'                => $file,
					'created_at'                => date('Y-m-d'),
					'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
			}
			/* ./ add new comment */
			if($result){
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
			$data['userid']=$session_data['userid'];
			$result = $this->Query_model->delete_assign_query($id);
			$result = $this->Query_model->delete_query_data($id);
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

	/* query comment  */
	public function get_comment_data(){
		$id = $this->input->get('id');
		// var_dump($id);die;
		$get_record = $this->Query_model->get_comment_details($id);
		// var_dump($get_record);die;
		echo json_encode($get_record); 
		exit();
	}
	public function get_subcomment_data(){
		$id = $this->input->get('qid');
		// var_dump($qid);die;
		$get_record = $this->Query_model->get_subcomment_details($id);
		// var_dump($get_record);die;
		echo json_encode($get_record); 
		exit();
	}
	public function comment_query_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
		
			$url =$_SERVER['QUERY_STRING'];
			// echo $url; die;
			// $query_id = $this->input->post('query_id');
			$data['delete'] = $this->Query_model->comment_query_delete($id);
			// var_dump($data['delete']);die;
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			
			redirect('admin/query/'.$url);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function query_comment_update(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name'] = $session_data['Login_user_name'];	
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type'] = $session_data['User_Type'];
			$data['department'] = $session_data['department'];
			$data['userid'] = $session_data['userid'];
			$userid = $session_data['userid'];

			$excomment = $this->input->post('excomment');
			$exattachment = $this->input->post('exattachment');
			// $query = $this->input->post('query');
			$id = $this->input->post('id');
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);			
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('newattachment')){
				$data = $this->upload->data();				
				$file = $data['file_name'];					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
			// var_dump($file); die;
			if($file) {
				$file_name = $file;
			} else if($exattachment) {
				$file_name = $exattachment;
			} else {
				$file_name = NULL;
			}
			/* Update comment and file */
			$comment_id = $this->input->post('comment_id');
			$update_query_comment = array(
				'comment'                   => $this->input->post('excomment'),
				'attachment'                => $file_name
			);
			$update_query_comment = $this->Query_model->update_query_comment($comment_id,$update_query_comment);
			/* ./ Update comment and file */
			if($update_query_comment){
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Sorry!, Data not updated...!!!');
			}
			redirect('admin/query/query_edit/'.$id);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function upcoming_research_query_comment_update(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['userid'] =$session_data['userid'];
			$data['department'] =$session_data['department'];
			$userid =$session_data['userid'];

			// $excomment = $this->input->post('excomment');			
			$exattachment = $this->input->post('exattachment');		
			$id = $this->input->post('id');
			// $view_comment = $this->input->post('view_comment');
			// $username1 = $this->input->post('username1');
			/* File Insert */
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$data = $this->upload->data();				
				$file = $data['file_name'];					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();		
			}
			if($file){
				$file_name = $file;				
			}else if($exattachment){
				$file_name = $exattachment;	
			}else{
				$file_name = NULL;
			}
			/* ./ File Insert */
			$comment_id = $this->input->post('comment_id');
			$update_query_comment = array(
				'comment' => $this->input->post('excomment'),
				'attachment' => $file_name
			);
			$result = $this->Query_model->update_query_comment($comment_id,$update_query_comment);
		   						
			redirect('admin/query/upcoming_research_query_edit/'.$id);
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function research_query_comment_update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$department = $session_data['department'];
			$data['userid']=$session_data['userid'];
			$userid = $session_data['userid'];
			$exattachment = $this->input->post('exattachment');
			// $id = $this->input->post('id');
			$query_id = $this->input->post('query_id');
			/* File Insertion */
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
			// var_dump($config);die;
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$data = $this->upload->data();				
				$file = $data['file_name'];					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();		
			}
			/* ./ File Insertion */
			if($file) {
				$file_name = $file;
			} else if($exattachment) {
				$file_name = $exattachment;
			} else {
				$file_name = NULL;
			}
			/* Update Record */
			$comment_id = $this->input->post('comment_id');
			$update_query_comment = array(
				'comment'                   => $this->input->post('excomment'),
				'attachment'                => $file_name
			);
			$result = $this->Query_model->update_query_comment($comment_id,$update_query_comment);
		    /* ./ Update Record */
			
			redirect('admin/query/research_assign_edit/'.$query_id);
					
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function insert_research_query_comment(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$department =$session_data['department'];
			$data['userid']=$session_data['userid'];
			$userid =$session_data['userid'];
			$data['Login_user_name']=$session_data['Login_user_name'];
			// var_dump($data['Login_user_name']);die;
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['query_comment'] = $this->Query_model->get_single_query_comment1($Login_user_name);
			$id = $this->input->post('id');
			$id = $this->input->post('id');
			$query_id = $this->input->post('query_id');
			$excommentid = $this->input->post('ex_comment_id');
			$username = $this->input->post('rusername');
			$view_comment = $this->input->post('view_comment');
			// var_dump($excommentid);die;
			// $data['single_query_comment'] = $this->Query_model->get_comment_details($query_id);
			$commentfor = $this->input->post('comment_for');
			// var_dump($commentfor);die;
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$file_data = $this->upload->data();				
				$file = $file_data['file_name'];
					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
				$file = Null;
			}
			if($username){
				$insert_query_comment = array(
					'query_id'                  => $query_id,
					'user_id'                   => $userid,
					'user_name'                 => $data['Login_user_name'],
					'comment'                   => $this->input->post('replycomment'),
					'attachment'                => $file,
					'parent'                    => $excommentid,
					'comment_for'               => $username,
					'created_at'                => date('Y-m-d'),
					//'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
			} else {
				$insert_query_comment = array(
					'query_id'                  => $query_id,
					'user_id'                   => $userid,
					'user_name'                 => $data['Login_user_name'],
					'comment'                   => $this->input->post('replycomment'),
					'attachment'                => $file,
					'parent'                    => $excommentid,
					'comment_for'               => $commentfor,
					'created_at'                => date('Y-m-d'),
					//'updated_at'                => date('Y-m-d')
				);
				$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
			}
			if($result){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data has been not inserted...!!!');
			}
			if($view_comment){
				redirect('admin/query/view_research_assign_query/'.$query_id);
			}
				redirect('admin/query/research_assign_list');
					
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function insert_sales_query_comment(){
		// var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$department =$session_data['department'];
			$userid =$session_data['userid'];
			$data['Login_user_name']=$session_data['Login_user_name'];
			$data['userid']=$session_data['userid'];
			// var_dump($data['Login_user_name']);die;
			$data['user_details'] = $this->Query_model->get_user_details($data['Role_id']);
			$data['query_comment'] = $this->Query_model->get_single_query_comment1($Login_user_name);
			$query_id = $this->input->post('query_id');
			$excommentid = $this->input->post('ex_comment_id');
			$username = $this->input->post('username');
			$view_comment = $this->input->post('view_comment');
			// var_dump($view_comment);die;
			$commentfor = $this->input->post('commentfor');
			// var_dump($commentfor);die;
			$file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/attach-file",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('attachment')){
				$file_data = $this->upload->data();				
				$file = $file_data['file_name'];
					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
				$file = Null;
			}
				$insert_query_comment = array(
					'query_id'                  => $query_id,
					'user_id'                   => $userid,
					'user_name'                 => $data['Login_user_name'],
					'comment'                   => $this->input->post('replycomment'),
					'attachment'                => $file,
					'parent'                    => $excommentid,
					'comment_for'               => $username,
					'created_at'                => date('Y-m-d'),
					// 'updated_at'                => date('Y-m-d')
				);
				// var_dump($insert_query_comment);die;
				$result = $this->Query_model->insert_query_comment_details($insert_query_comment);
			
			if($result){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			} else {
				$this->session->set_flashdata('msg', 'Sorry!, Data has been not inserted...!!!');
			}
			if($view_comment){
				redirect('admin/query/upcoming_research_query_edit/'.$query_id);
			}
				redirect('admin/query/list');
					
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function research_comment_query_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$url =$_SERVER['QUERY_STRING'];
			// echo $url; die;
			// $query_id = $this->input->post('query_id');
			$data['delete'] = $this->Query_model->comment_query_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			
			redirect('admin/query/'.$url);
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* ./ query comment  */


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
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['id'] = $id;

			$next_followup = $this->input->post('next_followup');
			if($next_followup == ''){
				$Timestamp = strtotime(date('Y-m-d'));
				$TotalTimeStamp = strtotime('+ 2 days', $Timestamp);
				// echo date('Y-m-d', $TotalTimeStamp); die;
				$next_followup = date('Y-m-d', $TotalTimeStamp);
			}
			$status = $this->input->post('status');
			if($status == 'Sale'){				
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'currency'                   => $this->input->post('currency'),
					'price'                      => $this->input->post('price'),
					'discount'                   => $this->input->post('discount'),
					'absolute_price'             => $this->input->post('absolute_price'),
					'selling_price'              => $this->input->post('selling_price'),
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);
			}else if($status == 'Reject'){
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'reason'                     => $this->input->post('reason'),
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);
			}else if($status == 'Spam' || $status == 'Student'){
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);
			}else{
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'followup_date'              => $next_followup,
					'created_on'                 => date('Y-m-d'),
					'updated_on'                 => date('Y-m-d')
				);
			}
			$result = $this->Query_model->insert_status_details($data);
			if($result == 1){
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}else{
				$this->session->set_flashdata('msg', 'Data not inserted successfully....!!!');
			}
			redirect('admin/query/list');
	 	}else{
			$this->load->view("admin/login");
		}
	}
	public function view_status($id){
		// echo "hii"; die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
			$data['status_details'] = $this->Query_model->get_status_details($id);
			// var_dump($data['status_details']);die;
		    $this->load->view('admin/query/status/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_status(){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$id = $this->input->post('id');
			// $status_details = $this->Query_model->status_details($id);
			$next_followup = $this->input->post('next_followup');
			if($next_followup == ''){
				$Timestamp = strtotime(date('Y-m-d'));
				$TotalTimeStamp = strtotime('+ 2 days', $Timestamp);
				// echo date('Y-m-d', $TotalTimeStamp); die;
				$next_followup = date('Y-m-d', $TotalTimeStamp);
			}
			$status = $this->input->post('status');
			if($status == 'Sale'){				
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'currency'                   => $this->input->post('currency'),
					'price'                      => $this->input->post('price'),
					'discount'                   => $this->input->post('discount'),
					'absolute_price'             => $this->input->post('absolute_price'),
					'selling_price'              => $this->input->post('selling_price'),
					'reason'              		 => NULL,
					'followup_date'              => NULL,
					'updated_on'                 => date('Y-m-d')
				);
			}else if($status == 'Reject'){
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'reason'                     => $this->input->post('reason'),
					'currency'                   => NULL,
					'price'                      => NULL,
					'discount'                   => NULL,
					'absolute_price'             => NULL,
					'selling_price'              => NULL,
					'followup_date'              => NULL,
					'updated_on'                 => date('Y-m-d')
				);
			}else if($status == 'Spam' || $status == 'Student'){
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'reason'                     => NULL,
					'currency'                   => NULL,
					'price'                      => NULL,
					'discount'                   => NULL,
					'absolute_price'             => NULL,
					'selling_price'              => NULL,
					'followup_date'              => NULL,
					'updated_on'                 => date('Y-m-d')
				);
			}else{
				$data = array(
					'query_id'                   => $id,
					'status'                     => $this->input->post('status'),
					'followup_date'              => $next_followup,
					'reason'                     => NULL,
					'currency'                   => NULL,
					'price'                      => NULL,
					'discount'                   => NULL,
					'absolute_price'             => NULL,
					'selling_price'              => NULL,
					'updated_on'                 => date('Y-m-d')
				);
			}
			// var_dump($status);die;
			$records = $this->Query_model->update_status($id, $data);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/query/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
	public function status($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $data['userid']=$session_data['userid'];
			// var_dump($id);die;
			if($id == 1){
				$data['status'] = 'Acknowledgement Sent';
			}else if($id == 2){
				$data['status'] = 'Sample Sent';
			}else if($id == 3){
				$data['status'] = 'Need to Discuss';
			}else if($id == 4){
				$data['status'] = 'Budget Issues';
			}else if($id == 5){
				$data['status'] = 'Need More Time';
			}
			$data['query_details'] = $this->Query_model->get_statuswise_records($data['status']);
			$data['todays_followup'] = $this->Query_model->get_todays_followup_queries($data['Login_user_name']);
			// echo "<pre>"; print_r($data['todays_followup']); die;
			// var_dump($status_details);die;
			/* $records = $this->Query_model->delete_status($id);
			$this->session->set_flashdata('msg', 'Data has been deleted successfully....!!!');
			redirect('admin/query/list'); */
			$this->load->view('admin/query/list',$data);	
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* / .status management */

	/* followup management */
	public function add_followup($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
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
		   $data['userid']=$session_data['userid'];
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
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;	
			$data['followup_details'] = $this->Query_model->get_followup_details($id);
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
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['userid']=$session_data['userid'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
			$data['followup_record'] = $this->Query_model->get_followup_record($id);
		    $this->load->view('admin/query/followup/add_record',$data);		
		}	else{			
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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
			$data['userid']=$session_data['userid'];
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