<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');

class PhpspreadsheetController extends CI_Controller 
    {
        public function __construct(){
        parent::__construct();
        $this->load->model('admin/Export_model');
        $this->load->model('admin/Data_model');
        $this->load->model('admin/RdData_model');
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
            $data['Role_id']=$session_data['Role_id'];

            $data['from_date'] = $this->input->post('from_date');
            $data['to_date'] = $this->input->post('to_date');
            $data['list_data'] = $this->Export_model->getfilterdata($data['from_date'] ,$data['to_date']);
            // var_dump($data['list_data']);die;
            // $data['list_data'] = $this->Export_model->getlist();
            $this->load->view('admin/spreadsheet',$data);			
        } else {			
            $this->load->view('admin/login');
        }        
    }
    public function filter(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];

            $data['list_data'] = $this->Export_model->getlist();
            $this->load->view('admin/filter', $data);	
        } else {			
            $this->load->view('admin/login');
        }        
    }
    public function export(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];
            $data['list_data'] = $this->Export_model->getlist();
            
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $list_data = $this->Export_model->getfilterdata($from_date ,$to_date);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
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
            $sheet->setCellValue('K1', 'Value CAGR');
            $sheet->setCellValue('L1', 'Value Unit');
            $sheet->setCellValue('M1', 'Is Volume Based');
            $sheet->setCellValue('N1', 'Volume Based Unit');
            $sheet->setCellValue('O1', 'Volume Based CAGR');
            $sheet->setCellValue('P1', 'Singleuser Price');
            $sheet->setCellValue('Q1', 'Enterprise Price');
            $sheet->setCellValue('R1', 'Datasheet Price');
            $sheet->setCellValue('S1', 'CAGR Market Value');
            /*$sheet->setCellValue('T1', 'Report Definition');
            $sheet->setCellValue('U1', 'Report Description');
            $sheet->setCellValue('V1', 'Executive Summary DRO');
            $sheet->setCellValue('W1', 'Executive Summary Regional Description');*/
            $sheet->setCellValue('T1', 'Largest Region');
            $sheet->setCellValue('U1', 'Country Status');
            $sheet->setCellValue('V1', 'Status');
            $sheet->setCellValue('W1', 'Created User');
            $sheet->setCellValue('X1', 'Created At');
            $sheet->setCellValue('Y1', 'Updated At');
            $sheet->setCellValue('Z1', 'Market Insight');

            $rowCount = 3;
            foreach ($list_data as $list) {
                // echo $list->id;
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
                // $sheet->SetCellValue('S' . $rowCount, $list->cagr_market_value);

                /* $sheet->SetCellValue('T' . $rowCount, $list->report_definition);
                $sheet->SetCellValue('U' . $rowCount, $list->report_description);
                $sheet->SetCellValue('V' . $rowCount, $list->executive_summary_DRO);
                $sheet->SetCellValue('W' . $rowCount, $list->executive_summary_regional_description); */
                $sheet->SetCellValue('T' . $rowCount, $list->largest_region);
                $sheet->SetCellValue('U' . $rowCount, $list->country_status);
                $sheet->SetCellValue('V' . $rowCount, $list->status);
                $sheet->SetCellValue('W' . $rowCount, $list->created_user);
                $sheet->SetCellValue('X' . $rowCount, $list->created_at);
                $sheet->SetCellValue('Y' . $rowCount, $list->updated_at);
                $market_insight = $this->Export_model->get_rd_market_insight($list->id);
                if($market_insight){
                    foreach($market_insight as $insight){
                        if($insight->type == 'Report Description'){
                            $newinsight.=$insight->description;
                        } else if($insight->type == 'Summary DRO'){
                            $newinsight.=$insight->description;
                        }else if($insight->type == 'Summary Regional Description'){
                            $newinsight.=$insight->description;
                        }
                        // var_dump($insight->description); die;
                    }
                }
                // var_dump($newinsight); die;
                $sheet->SetCellValue('Z' . $rowCount, htmlspecialchars_decode($newinsight));
                $rowCount++;
                unset($newinsight);
            }
            // $spreadsheet->setIncludeCharts(true);
            // die;
            $writer = new Xlsx($spreadsheet);
            $fileName = 'RD Data-'.$from_date.' to '.$to_date.'.xlsx';     
            header('Content-Description: File Transfer');
            // sleep(2);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename='.$fileName);
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            // header('Pragma: public');
            header("Pragma: no-cache");

            // header('Content-Length: ' . filesize($fileName));
            ob_clean();
            $writer->save('php://output'); // download file
            exit();
        } else {			
            $this->load->view('admin/login');
        }
    }
    public function metadata(){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];

            $data['from_date'] = $this->input->post('from_date');
            $data['to_date'] = $this->input->post('to_date');
            $data['list_data'] = $this->Export_model->get_filter_metadata($data['from_date'] ,$data['to_date']);
            $data['ScopeList'] = $this->Data_model->get_scope_master();	
            $data['category_data']= $this->Data_model->get_category_master();	
            // var_dump($data['category_data']);die;
            // $data['list_data'] = $this->Export_model->getlist();
            $this->load->view('admin/metadatasheet',$data);			
        } else {			
            $this->load->view('admin/login');
        }        
    }
    public function export_metadata(){
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name'] = $session_data['Login_user_name'];	
            $data['Role_id'] = $session_data['Role_id'];
            
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $list_data = $this->Export_model->get_filter_metadata($from_date ,$to_date);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $styleArray = array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => array('argb' => 'FFFF00'),
                ),
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            
            );
        
            $sheet ->getStyle('A1:N1')->applyFromArray($styleArray);
            $sheet->setCellValue('A1', 'Report Title');
            $sheet->setCellValue('B1', 'Report Code');
            $sheet->setCellValue('C1', 'Short Description (Excecutive)');
            $sheet->setCellValue('D1', 'Description');
            $sheet->setCellValue('E1', 'TOC');
            $sheet->setCellValue('F1', 'HTML Description');
            $sheet->setCellValue('G1', 'HTML TOC');
            $sheet->setCellValue('H1', 'Companies');
            $sheet->setCellValue('I1', 'Category');
            $sheet->setCellValue('J1', 'Publish Date');
            $sheet->setCellValue('K1', 'Rewamp titles');
            $sheet->setCellValue('L1', 'Country');
            $sheet->setCellValue('M1', 'Single User');
            $sheet->setCellValue('N1', 'Enterprise User');

            /* Adding Dynamic Data in row and column */
            $rowCount = 3;
            foreach ($list_data as $list) {
                // echo $list->id;
                $data['ScopeList'] = $this->Data_model->get_scope_master();
                foreach($data['ScopeList'] as $scope){
                    if($scope->id == $list->scope_id){
                        $scope_name = $scope->name;
                    }
                }
                if($scope_name == "Global"){
                    $small_scope_name = "global";
                }else{
                    $small_scope_name = $scope_name;
                }
                 // Short Description -----------
                $rd2_para2 = $this->RdData_model->get_rd2_codedecode_para(4);
                $RD2_para2 = $rd2_para2->description;
                $report_name_scope = $small_scope_name.' '.$list->name;           
                $New_RD2_para_7=str_replace("Report_name_scope",$report_name_scope,$RD2_para2);
                $New_RD2_para_8=str_replace("Report_name",$list->name,$New_RD2_para_7);
                $Final_RD2_para_2=str_replace("Period_value",$list->forecast_to,$New_RD2_para_8);
                // var_dump($Final_RD2_para_2); die;
                
                $report_title = $list->title.': '.$scope_name." Industry Analysis, Trends, Market Size, and Forecasts up to ".$list->forecast_to;
                $sheet->SetCellValue('A' . $rowCount, $report_title);
                $sheet->SetCellValue('B' . $rowCount, $list->sku);           
                $sheet->SetCellValue('C' . $rowCount, $Final_RD2_para_2);
                $sheet->SetCellValue('D' . $rowCount, 'NA');
                $sheet->SetCellValue('E' . $rowCount, 'NA');
                $sheet->SetCellValue('F' . $rowCount, 'NA');
                $sheet->SetCellValue('G' . $rowCount, 'NA');
                $sheet->SetCellValue('H' . $rowCount, 'NA');

                /* $data['companies']= $this->Data_model->get_rd_companies($list->id);
                foreach($data['companies'] as $companies){
                   $company_name.= $companies->name;
                }
                $sheet->SetCellValue('H' . $rowCount, $company_name);
                unset($company_name); */

                $data['category_data']= $this->Data_model->get_category_master();
                foreach($data['category_data'] as $category){
                    if($category->id == $list->category_id){
                        $category_name = $category->name;
                    }
                }
                $sheet->SetCellValue('I' . $rowCount, $category_name);
                $sheet->SetCellValue('J' . $rowCount, date('d-m-Y', strtotime($list->updated_at)));
                $sheet->SetCellValue('K' . $rowCount, 'NA');                
                $sheet->SetCellValue('L' . $rowCount, $scope_name);
                $sheet->SetCellValue('M' . $rowCount, $list->singleuser_price);
                $sheet->SetCellValue('N' . $rowCount, $list->enterprise_price);
                /* $market_insight = $this->Export_model->get_rd_market_insight($list->id);
                if($market_insight){
                    foreach($market_insight as $insight){
                        if($insight->type == 'Report Description'){
                            $newinsight.=$insight->description;
                        } else if($insight->type == 'Summary DRO'){
                            $newinsight.=$insight->description;
                        }else if($insight->type == 'Summary Regional Description'){
                            $newinsight.=$insight->description;
                        }
                        // var_dump($insight->description); die;
                    }
                }
                // var_dump($newinsight); die;
                // $sheet->SetCellValue('Z' . $rowCount, htmlspecialchars_decode($newinsight)); */
                $rowCount++;
                // unset($newinsight);
            }
            $writer = new Xlsx($spreadsheet);
            $fileName = 'MetaData-'.$from_date.' to '.$to_date.'.xlsx';     
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename='.$fileName);
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            // header('Pragma: public');
            header("Pragma: no-cache");

            // header('Content-Length: ' . filesize($fileName));
            ob_clean();
            $writer->save('php://output'); // download file
            exit();
        } else {			
            $this->load->view('admin/login');
        }
    }
}
?>