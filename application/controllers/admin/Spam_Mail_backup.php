<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Spam_Mail extends CI_Controller {
    public function __construct(){
    parent::__construct();
    $this->load->model('admin/Spam_Model');
    $this->load->library('form_validation');		
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->helper('download');
    $this->load->library('upload'); 
    $this->load->helper('file');
    $this->load->library('csvimport');
    $this->load->helper(array('form', 'url'));
    }
    public function index(){	
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $this->load->view('admin/spam_mail/add',$data);	
        }
        else
        {			
            $this->load->view('admin/login');
        }
	}
    public function insert(){
        if($this->session->userdata('logged_in'))
        {
           $session_data = $this->session->userdata('logged_in');
           $data['Login_user_name']=$session_data['Login_user_name'];	
           $data['Role_id']=$session_data['Role_id'];
           $data['massage'] = $this->session->userdata('msg');
           $data['spam']= $this->input->post('type');
           $result = $this->Spam_Model->insert_spam_mail();
           if($result == 1)
           {
               $this->session->set_flashdata('msg', 'Email Id has been inserted successfully....!!!');
           }
           redirect('admin/spam_mail');
        }else
        {
            $this->load->view("admin/login");
        }
    }
    public function import_file()
    {
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['email_record'] = $this->Spam_Model->Email_list();
            // var_dump($data['email_record']);die;
            $this->load->view('admin/spam_mail/xl_upload',$data);
        }
        else
        {			
            $this->load->view('admin/login');
        }
    }
    public function export_data(){
        $data['email_record'] = $this->Spam_Model->Email_list();
        $config['upload_path'] = 'assets/admin/xl';
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '1000';

        // $config = array(
		// 	'upload_path' 	=> "assets/admin/xl",
		// 	'allowed_types' => "xlsx|xls|csv",
		// 	'encrypt_name'	=> false,
		// );
        $this->upload->initialize($config);
		if($this->upload->do_upload('email_address')){
			$data = $this->upload->data();				
			$file = $data['file_name'];
            // var_dump($file);die;
            if ($this->csvimport->get_array($file)) {
                $csv_array = $this->csvimport->get_array($file);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'email_address'=>$row['email_address'],
                        
                    );
                    $this->Spam_Model->insert_mail_data($insert_data);
                    // $this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'csv');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csvindex', $data);
            }
          
		// }else{
		// 	$error = array('error' => $this->upload->display_errors());	
		// 	$this->upload->display_errors();	
		// }



        // $file ='';
        // $path = "assets/admin/xl";
        // // var_dump($path);die;
		// $config = array(
		// 	'upload_path' 	=> "assets/admin/xl",
		// 	'allowed_types' => "xlsx|xls|csv",
		// 	'encrypt_name'	=> false,
		// );
        // //var_dump($config);die;
		// $this->upload->initialize($config);
		// if($this->upload->do_upload('email_address')){
		// 	$data = $this->upload->data();				
		// 	$file = $data['file_name'];
        //     // var_dump($file);die;
          
		// }else{
		// 	$error = array('error' => $this->upload->display_errors());	
		// 	$this->upload->display_errors();	
		// }
       
        // $filename = $file; 
        // // var_dump($filename);die;
        // $email_record = $this->Spam_Model->Email_list();
        // // $data['email_record'] = $this->Spam_Model->Email_list();
        // // var_dump($email_record);die;
        // $data['email_address'] = $email_record->email_address;
        // // var_dump($data['email_address']);die;
        // $filename= $email_record->email_address;
        // $upload_file = fopen($path . $filename, 'wb');
        // // var_dump($upload_file);die;
        // // var_dump(fopen($filename,"r"));die;
        // // var_dump($filename);die;
        // // var_dump($data['email_address']);die;
        // // $MyFile = file_get_contents(base_url()."assets/admin/xl/".$email_record->email_address);
        // // $MyFile = read_file("assets/admin/xl/".$email_record->email_address);
        
        // // var_dump($handle);die;
        // // while($data = fgetcsv($upload_file))
        // // {
        // //     foreach ($email_record as $list) {
        // //         $sheet->SetCellValue('A' . $rowCount, htmlspecialchar($list->email_address));
        // //         $result = $this->Spam_Model->insert_mail_data($upload_file);
        // //         var_dump();die;
        // //     }
        // // }//handling csv file 
        // // var_dump($email_record);die;
        // // $data['email_address'] = $email_record->email_address;
        // // var_dump($data['xl_file']);die;
        // // $result = $this->Spam_Model->insert_mail_data($file);
        // // $record_xl = $this->Spam_Model->compare_inserted_record($file,$data['email_address']);
        // //  var_dump($record_xl);die;
        // $result = $this->Spam_Model->insert_mail_data($file);
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Email');
        // $rowCount = 1;
        // foreach ($email_record as $list) {
        //     $sheet->SetCellValue('A' . $rowCount, $list->email_address);
        // }
        // // $sheet = $spreadsheet->getActiveSheet();
        // // // $sheet = $spreadsheet->getActiveSheet();
        // // $sheet->setCellValue('A1', 'Email');
        // // $rowCount = 3;
        // // foreach ($list_data as $list) {
        // //        $sheet->SetCellValue('A' . $rowCount, $list->email_id);
        // // }
        // $writer = new Xlsx($spreadsheet); 
        // // $writer->save($fileName);
        // // $filename = time().".xlsx";
        // // var_dump($filename);die;
        // header('Content-Description: File Transfer');
        // header('Content-Type: application/csv');
        // header('Content-Type: application/vnd.ms-excel');
        // // header('Content-Disposition: attachment; fileName='.$fileName .'xlsx'');
        // // header('Content-Disposition: attachment;fileName="'. $fileName .'.xlsx"');
        // header('Content-Disposition: attachment; filename='.$filename);
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate');
        // // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize($filename));
        // ob_clean();
        // // header('Content-Type: application/vnd.ms-excel');
        // // header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        // // header('Cache-Control: max-age=0');
        // // $writer->save("upload/".$fileName);
        // // readfile($fileName);
        // $writer->save('php://output'); // download file
		// // $result = $this->Spam_Model->insert_record($file);
		// redirect('admin/spam_mail/import_file');
    }

}

?>