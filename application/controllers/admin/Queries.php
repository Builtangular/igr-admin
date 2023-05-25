<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Queries extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Queries_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	/* Sample Queries */
    public function index(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $data['sample_data'] = $this->Queries_model->get_samplequery_data();
			$data['Report_id'] = $this->input->post('Report_id');
            $this->load->view('admin/sample_query/list', $data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function sample_details($Report_id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $sample_details = $this->Queries_model->get_sample_details($Report_id);
			$data['Report_name'] = $sample_details->Report_name;
			$str = array_shift(explode(' (', $data['Report_name']));
			$str1 = array_shift(explode(':', $str));
			$data['short_report_name'] = array_shift(explode(':', $str1));
			$data['Email_Address'] = $sample_details->Email_Address;
			$data['First_name'] = $sample_details->First_name;
			$data['Creation_date'] = $sample_details->Creation_date;
			$data['Contact_Number'] = $sample_details->Contact_Number;
			$data['Company_Name'] = $sample_details->Company_Name;
			$data['Job_Title'] = $sample_details->Job_Title;
			$data['Country_Name'] = $sample_details->Country_Name;
			$data['Comments_SMS'] = $sample_details->Comments_SMS;
			$data['Subject'] = $sample_details->Subject;
			$data['Last_name'] = $sample_details->Last_name;
            $this->load->view('admin/sample_query/details', $data);		
		}else{			
			$this->load->view('admin/login');
		}

    }
	/* Toc Queries */
	public function toc_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['toc_data'] = $this->Queries_model->get_tocquery_data();
			$data['Report_id'] = $this->input->post('Report_id');
			$this->load->view('admin/toc_query/list', $data);	
				
		}else{			
			$this->load->view('admin/login');
		}

	}
	public function toc_details($Report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $toc_details = $this->Queries_model->get_toc_details($Report_id);
			$data['Report_name'] = $toc_details->Report_name;
			$str = array_shift(explode(' (', $data['Report_name']));
			$str1 = array_shift(explode(':', $str));
			$data['short_report_name'] = array_shift(explode(':', $str1));
			$data['Email_Address'] = $toc_details->Email_Address;
			$data['First_name'] = $toc_details->First_name;
			$data['Creation_date'] = $toc_details->Creation_date;
			$data['Contact_Number'] = $toc_details->Contact_Number;
			$data['Company_Name'] = $toc_details->Company_Name;
			$data['Job_Title'] = $toc_details->Job_Title;
			$data['Country_Name'] = $toc_details->Country_Name;
			$data['Comments_SMS'] = $toc_details->Comments_SMS;
			$data['Subject'] = $toc_details->Subject;
			$data['Last_name'] = $toc_details->Last_name;
            $this->load->view('admin/toc_query/details', $data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* Customization Queries */
	public function customization_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['customization_data'] = $this->Queries_model->get_customization_data();
			$data['Report_id'] = $this->input->post('Report_id');
			$this->load->view('admin/customization_query/list', $data);	
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function Customization_details($Report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $Customization_details = $this->Queries_model->get_Customization_details($Report_id);
			$data['Report_name'] = $Customization_details->Report_name;
			$str = array_shift(explode(' (', $data['Report_name']));
			$str1 = array_shift(explode(':', $str));
			$data['short_report_name'] = array_shift(explode(':', $str1));
			$data['Email_Address'] = $Customization_details->Email_Address;
			$data['First_name'] = $Customization_details->First_name;
			$data['Creation_date'] = $Customization_details->Creation_date;
			$data['Contact_Number'] = $Customization_details->Contact_Number;
			$data['Company_Name'] = $Customization_details->Company_Name;
			$data['Job_Title'] = $Customization_details->Job_Title;
			$data['Country_Name'] = $Customization_details->Country_Name;
			$data['Comments_SMS'] = $Customization_details->Comments_SMS;
			$data['Subject'] = $Customization_details->Subject;
			$data['Last_name'] = $Customization_details->Last_name;
            $this->load->view('admin/customization_query/details', $data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* Enquiry  Queries */
	public function enquiry_list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['enquiry_data'] = $this->Queries_model->get_enquiry_data();
			$data['Report_id'] = $this->input->post('Report_id');
			$this->load->view('admin/enquiry_query/list', $data);	
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function enquiry_details($Report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$enquiry_details = $this->Queries_model->get_enquiry_details($Report_id);
			$data['Report_name'] = $enquiry_details->Report_name;
			$str = array_shift(explode(' (', $data['Report_name']));
			$str1 = array_shift(explode(':', $str));
			$data['short_report_name'] = array_shift(explode(':', $str1));
			$data['Email_Address'] = $enquiry_details->Email_Address;
			$data['First_name'] = $enquiry_details->First_name;
			$data['Creation_date'] = $enquiry_details->Creation_date;
			$data['Contact_Number'] = $enquiry_details->Contact_Number;
			$data['Company_Name'] = $enquiry_details->Company_Name;
			$data['Job_Title'] = $enquiry_details->Job_Title;
			$data['Country_Name'] = $enquiry_details->Country_Name;
			$data['Comments_SMS'] = $enquiry_details->Comments_SMS;
			$data['Subject'] = $enquiry_details->Subject;
			$data['Last_name'] = $enquiry_details->Last_name;
			$this->load->view('admin/enquiry_query/details', $data);	
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>