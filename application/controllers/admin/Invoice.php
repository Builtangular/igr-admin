<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Invoice extends CI_Controller {
    public function __construct(){
    parent::__construct();
    $this->load->model('admin/Invoice_model');
    $this->load->library('form_validation');		
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->helper('download'); 
    $this->load->helper(array('form', 'url'));	
    }

    public function index(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];

            // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');
          
            $sFileName = 'wordfile.docx'; 
            force_download($sFileName, NULL);
           			
        }		
        else
        {			
            $this->load->view('admin/login');
        }
    }
    public function add_invoice(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];	
			$this->load->view("admin/invoice/add",$data);
        }else{
             $this->load->view("admin/login");
        }
    }


}
?>