<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhpspreadsheetController extends CI_Controller {
public function __construct(){
parent::__construct();
$this->load->model('admin/Export_model');
$this->load->library('form_validation');		
$this->load->library('session');
$this->load->library('pagination');
$this->load->helper(array('form', 'url'));	
}
public function index(){
    // var_dump($_POST);die;

    if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];
            $data['from_date'] = $this->input->post('from_date');
            $data['to_date'] = $this->input->post('to_date');
            $data['list_data'] = $this->Export_model->getfilterdata($data['from_date'] ,$data['to_date']);
            // var_dump($data['list_data']);die;
            // $data['list_data'] = $this->Export_model->getlist();
			$this->load->view('admin/spreadsheet',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
    
}
public function filter(){
    if($this->session->userdata('logged_in'))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['Login_user_name']=$session_data['Login_user_name'];
        $data['list_data'] = $this->Export_model->getlist();
        $this->load->view('admin/filter',$data);	
    }		
    else
    {			
        $this->load->view('admin/login');
    }
    
}
public function export(){
    if($this->session->userdata('logged_in'))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['Login_user_name']=$session_data['Login_user_name'];
        $data['list_data'] = $this->Export_model->getlist();
        $this->load->view('admin/filter',$data);	
    }	
// var_dump($_POST);die;
$from_date = $this->input->post('from_date');
//  var_dump($from_date);die;
$to_date = $this->input->post('to_date');
$list_data = $this->Export_model->getfilterdata($from_date ,$to_date);
// var_dump($list_data);die;
$spreadsheet = new Spreadsheet();
// var_dump($spreadsheet);die;
$sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue('A1', 'Hello World !');
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'Title');
$sheet->setCellValue('C1', 'SKU');
$sheet->setCellValue('D1', 'Category ID');
$sheet->setCellValue('E1', 'Scope ID');
$sheet->setCellValue('F1', 'URL');
$sheet->setCellValue('G1', 'Forecast From');
$sheet->setCellValue('H1', 'Forecast To');
$sheet->setCellValue('I1', 'Analysis From');
$sheet->setCellValue('J1', 'Analysis To');
$sheet->setCellValue('K1', 'Value Cagr');
$sheet->setCellValue('L1', 'Value Unit');
$sheet->setCellValue('M1', 'Is Volume Based');
$sheet->setCellValue('N1', 'Volume Based Unit');
$sheet->setCellValue('O1', 'Volume Based Cagr');
$sheet->setCellValue('P1', 'Singleuser Price');
$sheet->setCellValue('Q1', 'Enterprise Price');
$sheet->setCellValue('R1', 'Datasheet Price');
$sheet->setCellValue('S1', 'Cagr Market Value');
$sheet->setCellValue('T1', 'Report Definition');
$sheet->setCellValue('U1', 'Report Description');
$sheet->setCellValue('V1', 'Executive Summary DRO');
$sheet->setCellValue('W1', 'Executive Summary Regional Description');
$sheet->setCellValue('X1', 'Largest Region');
$sheet->setCellValue('Y1', 'Country Status');
$sheet->setCellValue('Z1', 'Status');
$sheet->setCellValue('AB1', 'Created User');
$sheet->setCellValue('AC1', 'Field');
$sheet->setCellValue('AD1', 'Field1');
$sheet->setCellValue('AE1', 'Field2');
$sheet->setCellValue('AF1', 'Field3');
$sheet->setCellValue('AG1', 'Created AT');
$sheet->setCellValue('AH1', 'Updated AT');

$rowCount = 3;
foreach ($list_data as $list) {
    $sheet->SetCellValue('A' . $rowCount, $list->name);
    $sheet->SetCellValue('B' . $rowCount, $list->title);
    $sheet->SetCellValue('C' . $rowCount, $list->sku);
    $sheet->SetCellValue('D' . $rowCount, $list->category_id);
    $sheet->SetCellValue('E' . $rowCount, $list->scope_id);
    $sheet->SetCellValue('F' . $rowCount, $list->url);
    $sheet->SetCellValue('G' . $rowCount, $list->forecast_from);
    $sheet->SetCellValue('H' . $rowCount, $list->forecast_to);
    $sheet->SetCellValue('I' . $rowCount, $list->analysis_from);
    $sheet->SetCellValue('J' . $rowCount, $list->analysis_to);
    $sheet->SetCellValue('K' . $rowCount, $list->value_cagr);
    $sheet->SetCellValue('L' . $rowCount, $list->value_unit);
    $sheet->SetCellValue('M' . $rowCount, $list->is_volume_based);
    $sheet->SetCellValue('N' . $rowCount, $list->volume_based_unit);
    $sheet->SetCellValue('O' . $rowCount, $list->volume_based_cagr);
    $sheet->SetCellValue('P' . $rowCount, $list->singleuser_price);
    $sheet->SetCellValue('Q' . $rowCount, $list->enterprise_price);
    $sheet->SetCellValue('R' . $rowCount, $list->datasheet_price);
    $sheet->SetCellValue('S' . $rowCount, $list->cagr_market_value);
    $sheet->SetCellValue('T' . $rowCount, $list->report_definition);
    $sheet->SetCellValue('U' . $rowCount, $list->report_description);
    $sheet->SetCellValue('V' . $rowCount, $list->executive_summary_DRO);
    $sheet->SetCellValue('W' . $rowCount, $list->executive_summary_regional_description);
    $sheet->SetCellValue('X' . $rowCount, $list->largest_region);
    $sheet->SetCellValue('y' . $rowCount, $list->country_status);
    $sheet->SetCellValue('Z' . $rowCount, $list->status);
    $sheet->SetCellValue('AB' . $rowCount, $list->created_user);
    $sheet->SetCellValue('AC' . $rowCount, $list->field);
    $sheet->SetCellValue('AD' . $rowCount, $list->field1);
    $sheet->SetCellValue('AE' . $rowCount, $list->field2);
    $sheet->SetCellValue('AF' . $rowCount, $list->field3);
    $sheet->SetCellValue('AG' . $rowCount, $list->created_at);
    $sheet->SetCellValue('AH' . $rowCount, $list->updated_at);
    $rowCount++;
}
$writer = new Xlsx($spreadsheet);
$filename = 'RD Data';
$fileName = 'tbl_dro_type-'.time().'.xlsx';     
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output'); // download file
}
// public function import(){
// $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
// $arr_file = explode('.', $_FILES['upload_file']['name']);
// $extension = end($arr_file);
// if('csv' == $extension){
// $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
// } else {
// $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
// }
// $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
// $sheetData = $spreadsheet->getActiveSheet()->toArray();
// echo "<pre>";
// print_r($sheetData);
// }
// }

}
