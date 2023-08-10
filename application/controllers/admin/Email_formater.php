<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', '0');
require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Email_formater extends CI_Controller {
    public function __construct(){
    parent::__construct();
    $this->load->model('admin/Email_formater_model');
    $this->load->library('form_validation');		
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->helper('download');
    $this->load->library('upload'); 
    $this->load->helper(array('form', 'url'));
    ini_set('memory_limit', '-1');
    }
    public function index(){	
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

            $data['efmenu_active'] = "active menu-open";
			$data['efadd'] = "active";
            $data['company_mail_data'] = $this->Email_formater_model->company_mail_format();
            $data['company_mail_count'] = $this->Email_formater_model->company_mail_format_count();
            $this->load->view('admin/email_formater/list', $data);
        } else {			
            $this->load->view('admin/login');
        }
	}
    public function add(){
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];

            $data['efmenu_active'] = "active menu-open";
			$data['efadd'] = "active";
            $data['company_mail_count'] = $this->Email_formater_model->company_mail_format_count();
            $this->load->view('admin/email_formater/add', $data);
        } else {			
            $this->load->view('admin/login');
        }
    }
}
?>