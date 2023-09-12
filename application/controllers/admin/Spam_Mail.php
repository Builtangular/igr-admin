<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', '0');
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
    $this->load->helper(array('form', 'url'));
    ini_set('memory_limit', '-1');
    }
    public function index(){	
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['smenu_active'] = "active menu-open";
			$data['sadd'] = "active";
            $data['spam_mail_count'] = $this->Spam_Model->spam_mail_count();
            $data['unsubscribe_mail_count'] = $this->Spam_Model->unsubscribe_mail_count();
             /* email formater */            
            $data['company_count'] = $this->Spam_Model->mail_format_company_count();
            $data['mail_count'] = $this->Spam_Model->mail_format_email_count();
            /* var_dump($data['company_count']); 
            var_dump($data['mail_count']); die; */
            /* ./ email formater */
            $this->load->view('admin/spam_mail/add',$data);	
        } else {			
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
           redirect('admin/spam-mail');
        }else{
            $this->load->view("admin/login");
        }
    }
    public function list(){	
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['smenu_active'] = "active menu-open";
			$data['slist'] = "active";
            $data['mail_data'] = $this->Spam_Model->get_spam_mail_data();
            // var_dump($data['mail_data']); die;
            $this->load->view('admin/spam_mail/list',$data);	
        } else {			
            $this->load->view('admin/login');
        }
	}
    public function edit($id){	
        // var_dump($_POST); die;
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['single_mail_data'] = $this->Spam_Model->get_single_spam_mail_data($id);
            $data['spam_mail_count'] = $this->Spam_Model->spam_mail_count();
            $data['unsubscribe_mail_count'] = $this->Spam_Model->unsubscribe_mail_count();
            // var_dump($data['single_mail_data']); die;
            $this->load->view('admin/spam_mail/edit',$data);	
        } else {			
            $this->load->view('admin/login');
        }
	}
    public function update($id){
        // var_dump($_POST); die;
        if($this->session->userdata('logged_in'))
        {
           $session_data = $this->session->userdata('logged_in');
           $data['Login_user_name']=$session_data['Login_user_name'];	
           $data['Role_id']=$session_data['Role_id'];

           $result = $this->Spam_Model->update_spam_mail($id);
           if($result)
           {
                $this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
           }else {
                $this->session->set_flashdata('msg', 'Sorry! Data not updated');
           }
           redirect('admin/spam-mail/list');
        }else{
            $this->load->view("admin/login");
        }
    }
    public function delete($id){
        // var_dump($id);die;
        if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->Spam_Model->spam_mail_delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/spam_mail/list');
		}else{
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
            $data['smenu_active'] = "active menu-open";
			$data['supload'] = "active";
            /* email formater */            
            $data['get_mail_data'] = $this->Spam_Model->get_mail_format_data();
            // var_dump($data['get_mail_data']); die;
            /* ./ email formater */
            $this->load->view('admin/spam_mail/xl_upload',$data);
        }else{			
            $this->load->view('admin/login');
        }
    }
    public function export_data(){
        //var_dump($_POST);die;
        $file ='';
		$config = array(
			'upload_path' 	=> "assets/admin/xl",
			'allowed_types' => "xlsx|xls|csv",
			'encrypt_name'	=> false,
		);
		//var_dump($config);die;
		$this->upload->initialize($config);
		if($this->upload->do_upload('xl_file')){
			$data = $this->upload->data();	
			$file = $data['file_name'];
		}else{
			$error = array('error' => $this->upload->display_errors());	
			$this->upload->display_errors();	
		}
        //var_dump($data); die;
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load('assets/admin/xl/'.$file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
        $sheet = $spreadsheet->getActiveSheet();
        $total_rows = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        for ($row = 2; $row <= $total_rows; ++ $row) {
            for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                $cell = $sheet->getCellByColumnAndRow($col,$row);
                $val = $cell->getCalculatedValue();
                $records[$row][$col] = $val;
            }
        }
        foreach($records as $row){
            // HTML content to render on webpage
            // var_dump(isset($row[6]) ? $row[6] : '');
            $data = array(
                'name' => isset($row[1]) ? $row[1] : '',
                'middle_name' => isset($row[2]) ? $row[2] : '',
                'surname' => isset($row[3]) ? $row[3] : '',
                'email_address' => isset($row[4]) ? $row[4] : '',
                'domain' => isset($row[5]) ? $row[5] : '',
                'company' => isset($row[6]) ? $row[6] : '',
                'extra' => isset($row[7]) ? $row[7] : '',
            );
             //var_dump($email_address); die;
            // Insert into database
            $result = $this->Spam_Model->insert_mail_data($data);
        }
        // die;
        //var_dump($email_address);die;
        $temp_email_list = $this->Spam_Model->get_temp_email_list(); 
        // var_dump($temp_email_list); die;
        $spam_mail_data = $this->Spam_Model->get_spam_mail_data();
        //var_dump($spam_mail_data);die;
        foreach($temp_email_list as $temp_mail){
            $email_address = $temp_mail['email_address'];
            $status = $temp_mail['status'];
            $domain = $temp_mail['domain'];
            $temp_mail_id = $temp_mail['id'];
            // Insert into database
            $check_spam_mail = $this->Spam_Model->check_spam_mail($email_address);
            $check_spam_domain = $this->Spam_Model->check_spam_domain($domain);
            if($check_spam_mail || $check_spam_domain){
            $email_type = $check_spam_mail->type;
            $domain_type = $check_spam_domain->type;
            // var_dump($domain_type);
                if($email_type =='spam')
                {
                   $status = 1;
                   $result = $this->Spam_Model->update_temp_mail($temp_mail_id, $status);
                //   var_dump($check_spam_mail->type);die;
                }else if($email_type =='unsubscribe'){
                    $status = 2;
                    $result = $this->Spam_Model->update_temp_mail($temp_mail_id, $status);
                }else if($domain_type =='domain'){
                    $status = 3;
                    $result = $this->Spam_Model->update_temp_mail($temp_mail_id, $status);
                } 
            }
        }
        // die;
    /* get temp mail data for excel writeup*/
        $spreadsheet = new Spreadsheet();
        $newsheet = $spreadsheet->getActiveSheet();
        $newsheet->setCellValue('A1', 'Name');
        $newsheet->setCellValue('B1', 'Surname');
        $newsheet->setCellValue('C1', '');
        $newsheet->setCellValue('D1', 'Email');
        $newsheet->setCellValue('E1', 'Domain');
        $newsheet->setCellValue('F1', 'Company');
        $newsheet->setCellValue('G1', '');
        $excel_mail = $this->Spam_Model->get_temp_excel_mail();
        // var_dump($excel_mail);die;
        $rowCount = 2;
        foreach ($excel_mail as $list) {
            $newsheet->SetCellValue('A' . $rowCount, $list->name);
            $newsheet->SetCellValue('B' . $rowCount, $list->middle_name);
            $newsheet->SetCellValue('C' . $rowCount, $list->surname);
             if($list->status == 1){                
                $newsheet->SetCellValue('D' . $rowCount, $list->email_address);
                $newsheet->getStyle('D' . $rowCount)->applyFromArray(
                    array(
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => [
                                'argb' => 'FF0000',
                            ]
                        )
                    )
                );
                
            } else if($list->status == 2){
                $newsheet->SetCellValue('D' . $rowCount, $list->email_address);
                $newsheet->getStyle('D' . $rowCount)->applyFromArray(
                    array(
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => [
                                'argb' => 'FFA500',
                            ]
                        )
                    )
                );
            }else if($list->status == 3){
                $newsheet->SetCellValue('D' . $rowCount, $list->email_address);
                $newsheet->SetCellValue('E' . $rowCount, $list->domain);
                $newsheet->getStyle('E' . $rowCount)->applyFromArray(
                    array(
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => [
                                'argb' => 'FFFF00',
                            ]
                        )
                    )
                );
            } else{
                $newsheet->SetCellValue('D' . $rowCount, $list->email_address);
                $newsheet->SetCellValue('E' . $rowCount, $list->domain);
            }
            // $newsheet->SetCellValue('E' . $rowCount, $list->domain);
            $newsheet->SetCellValue('F' . $rowCount, $list->company);
            $newsheet->SetCellValue('G' . $rowCount, $list->exra);
            $rowCount++;  
        }            
        
        $writer = new Xlsx($spreadsheet);
        $fileName = time().".xlsx";
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        // header('Content-Length: ' . filesize($fileName));
        ob_clean();
        $writer->save('php://output'); // download file
        /* delete temp excel tabel after export */
        $result_delete = $this->Spam_Model->truncate_temp_tbl();
        // var_dump("hii");die;
		redirect('admin/spam-mail/import_file');
    }
    /* Email Formater */    
    public function email_formater(){	
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['User_type']=$session_data['User_type'];
            $data['department']=$session_data['department'];
            $data['smenu_active'] = "active menu-open";
			$data['supload'] = "active";
            /* email formater */                   
            $data['company_count'] = $this->Spam_Model->mail_format_company_count();
            $data['mail_count'] = $this->Spam_Model->mail_format_email_count();
            $data['get_mail_data'] = $this->Spam_Model->get_mail_format_data();
            /* var_dump($data['mail_count']); die; */
            /* ./ email formater */
            $this->load->view('admin/spam_mail/email_format',$data);	
        } else {			
            $this->load->view('admin/login');
        }
	}
    public function format_insert(){
        if($this->session->userdata('logged_in'))
        {
           $session_data = $this->session->userdata('logged_in');
           $data['Login_user_name']=$session_data['Login_user_name'];	
           $data['Role_id']=$session_data['Role_id'];
           $data['User_type']=$session_data['User_type'];
           $data['department']=$session_data['department'];
           $data['massage'] = $this->session->userdata('msg');
        //    var_dump($_POST); die;
            $company_data = array(
                'company_name' => $this->input->post('company'),
                'domain' => $this->input->post('domain'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            );
           $insert_company = $this->Spam_Model->insert_mail_format_data($company_data);
           $email_address = $this->input->post('email_address');

           $num = 0;
           foreach($email_address as $email)
           {
               if($email != "" || $email != null )
               {
                   $Insert_email_address = array(
                       'comp_id' => $insert_company,
                       'email_address' => $email_address[$num],  
                       'created_at' => date('Y-m-d'),
                       'updated_at' => date('Y-m-d')
                   );
                   $insert_mail = $this->Spam_Model->insert_mail_format($Insert_email_address);
                   // var_dump($insert_report_definition);die;
               }
               $num++;
           }

           if($insert_mail)
           {
               $this->session->set_flashdata('msg', 'Email address has been inserted successfully....!!!');
           }
           redirect('admin/spam-mail/email-formater');
        }else{
            $this->load->view("admin/login");
        }
    }
    public function format_edit($id){
        if($this->session->userdata('logged_in'))
        {
           $session_data = $this->session->userdata('logged_in');
           $data['Login_user_name']=$session_data['Login_user_name'];	
           $data['Role_id']=$session_data['Role_id'];
           $data['User_type']=$session_data['User_type'];
           $data['department']=$session_data['department'];
           /* email formater */            
           $data['company_count'] = $this->Spam_Model->mail_format_company_count();
           $data['mail_count'] = $this->Spam_Model->mail_format_email_count();
           $data['get_single_mail_data'] = $this->Spam_Model->get_single_mail_format_data($id);
        //    var_dump($data['get_single_mail_data']); die;
           /* ./ email formater */
           $this->load->view('admin/spam_mail/email_format_edit', $data);
        }else{
            $this->load->view("admin/login");
        }

    }
    public function format_update($id){
        // var_dump($_POST); die;
        if($this->session->userdata('logged_in'))
        {
           $session_data = $this->session->userdata('logged_in');
           $data['Login_user_name']=$session_data['Login_user_name'];	
           $data['Role_id']=$session_data['Role_id'];
           $data['User_type']=$session_data['User_type'];
           $data['department']=$session_data['department'];
           /* email formater */            
        //    $email_id = $this->input->post('id');
           $comp_id = $this->input->post('comp_id');
           $company_data = array(
            'company_name' => $this->input->post('company'),
            'domain' => $this->input->post('domain'),
            'updated_at' => date('Y-m-d')
            );
            $update_data = $this->Spam_Model->update_mail_format_data($comp_id, $company_data);
            $email_address = $this->input->post('email_address');
            
            $email_address = array(
                'email_address' => $email_address,  
                'updated_at' => date('Y-m-d')
            );
            $insert_company = $this->Spam_Model->update_mail_format_email($id, $email_address);
            
           $data['company_count'] = $this->Spam_Model->mail_format_company_count();
           $data['mail_count'] = $this->Spam_Model->mail_format_email_count();
           $data['get_single_mail_data'] = $this->Spam_Model->get_single_mail_format_data($id);
        //    var_dump($data['get_single_mail_data']); die;
           /* ./ email formater */
           redirect('admin/spam-mail/email-formater');
        }else{
            $this->load->view("admin/login");
        }
    }
    /* ./ Email Formater */
}

?>