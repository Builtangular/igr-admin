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
                $data['Role_id']=$session_data['Role_id'];
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
            $data['Role_id']=$session_data['Role_id'];

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
        $data['Role_id']=$session_data['Role_id'];
        $data['list_data'] = $this->Export_model->getlist();
        
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $list_data = $this->Export_model->getfilterdata($from_date ,$to_date);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Name');
        $sheet->getStyle('A1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFA0A0A0',
                    ]
                )
            )
        );
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
       /*  $sheet->setCellValue('T1', 'Report Definition');
        $sheet->setCellValue('U1', 'Report Description');
        $sheet->setCellValue('V1', 'Executive Summary DRO');
        $sheet->setCellValue('W1', 'Executive Summary Regional Description'); */
        $sheet->setCellValue('T1', 'Largest Region');
        $sheet->setCellValue('U1', 'Country Status');
        $sheet->setCellValue('V1', 'Status');
        $sheet->setCellValue('W1', 'Created User');
       /*  $sheet->setCellValue('AC1', 'Field');
        $sheet->setCellValue('AD1', 'Field1');
        $sheet->setCellValue('AE1', 'Field2');
        $sheet->setCellValue('AF1', 'Field3'); */
        $sheet->setCellValue('X1', 'Created AT');
        $sheet->setCellValue('Y1', 'Updated AT');
        // var_dump($list_data); die;
        $rowCount = 3;
        foreach ($list_data as $list) {
            $sheet->SetCellValue('A' . $rowCount, htmlspecialchar($list->name));
            if($list->status == 1){
                $sheet->SetCellValue('B' . $rowCount, htmlspecialchar($list->title));
                $sheet->getStyle('B' . $rowCount)->applyFromArray(
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
                $sheet->SetCellValue('B' . $rowCount, htmlspecialchar($list->title));
                $sheet->getStyle('B' . $rowCount)->applyFromArray(
                    array(
                        'fill' => array(
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => [
                                'argb' => 'FF0000',
                            ]
                        )
                    )
                );
            } else{
                $sheet->SetCellValue('B' . $rowCount, htmlspecialchar($list->title));
            }
            // $sheet->SetCellValue('B' . $rowCount, $list->title);
            $sheet->SetCellValue('C' . $rowCount, htmlspecialchar($list->sku));
            $sheet->SetCellValue('D' . $rowCount, htmlspecialchar($list->category_id));
            $sheet->SetCellValue('E' . $rowCount, htmlspecialchar($list->scope_id));
            $sheet->SetCellValue('F' . $rowCount, htmlspecialchar($list->url));
            $sheet->SetCellValue('G' . $rowCount, htmlspecialchar($list->forecast_from));
            $sheet->SetCellValue('H' . $rowCount, htmlspecialchar($list->forecast_to));
            $sheet->SetCellValue('I' . $rowCount, htmlspecialchar($list->analysis_from));
            $sheet->SetCellValue('J' . $rowCount, htmlspecialchar($list->analysis_to));
            $sheet->SetCellValue('K' . $rowCount, htmlspecialchar($list->value_cagr));
            $sheet->SetCellValue('L' . $rowCount, htmlspecialchar($list->value_unit));
            $sheet->SetCellValue('M' . $rowCount, htmlspecialchar($list->is_volume_based));
            $sheet->SetCellValue('N' . $rowCount, htmlspecialchar($list->volume_based_unit));
            $sheet->SetCellValue('O' . $rowCount, htmlspecialchar($list->volume_based_cagr));
            $sheet->SetCellValue('P' . $rowCount, htmlspecialchar($list->singleuser_price));
            $sheet->SetCellValue('Q' . $rowCount, htmlspecialchar($list->enterprise_price));
            $sheet->SetCellValue('R' . $rowCount, htmlspecialchar($list->datasheet_price));
            $sheet->SetCellValue('S' . $rowCount, htmlspecialchar($list->cagr_market_value));
            $sheet->SetCellValue('T' . $rowCount, htmlspecialchar($list->report_definition));
            $sheet->SetCellValue('U' . $rowCount, htmlspecialchar($list->report_description));
            $sheet->SetCellValue('V' . $rowCount, htmlspecialchar($list->executive_summary_DRO));
            $sheet->SetCellValue('W' . $rowCount, htmlspecialchar($list->executive_summary_regional_description));
            $sheet->SetCellValue('X' . $rowCount, htmlspecialchar($list->largest_region));
            $sheet->SetCellValue('y' . $rowCount, htmlspecialchar($list->country_status));
            $sheet->SetCellValue('Z' . $rowCount, htmlspecialchar($list->status));
            $sheet->SetCellValue('AB' . $rowCount, htmlspecialchar($list->created_user));
            $sheet->SetCellValue('AC' . $rowCount, htmlspecialchar($list->field));
            $sheet->SetCellValue('AD' . $rowCount, htmlspecialchar($list->field1));
            $sheet->SetCellValue('AE' . $rowCount, htmlspecialchar($list->field2));
            $sheet->SetCellValue('AF' . $rowCount, htmlspecialchar($list->field3));
            $sheet->SetCellValue('AG' . $rowCount, htmlspecialchar($list->created_at));
            $sheet->SetCellValue('AH' . $rowCount, htmlspecialchar($list->updated_at));
            $rowCount++;
        }
        $writer = new Xlsx($spreadsheet);
        // $filename = 'RD Data.xlsx';
        // $fileName = 'RD Data-'.date('d-m-Y').'.xlsx';     
        $fileName = 'RD Data-'.$from_date.' to '.$to_date.'.xlsx';     
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        // header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file
        }else{			
            $this->load->view('admin/login');
        }
        }    
}
?>
     