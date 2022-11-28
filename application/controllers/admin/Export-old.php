<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//ini_set('display_errors', '0');
class Export extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Export_model');
		$this->load->library('session');
		$this->load->library('pagination');
        // $this->load->library("PHPExcel");
        // $this->load->library("pxl");
		
	}  
    public function index() {
        $data['list_data'] = $this->Export_model->getlist();
        // var_dump( $data['list_data']);die;
		$this->load->view("admin/export/list", $data);
    }

    
    // create xlsx
    public function generateXls() {
        // create file name
        $fileName = 'tbl_dro_type-'.time().'.xlsx';  
        // var_dump($fileName);die;
        // load excel library
        // $this->load->library('excel');
        $list_data = $this->Export_model->getlist();
        // var_dump($list_data);die;
        // $this->load->library('PHPExcel');
        // $this->load->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Active');
            
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->active);
            $rowCount++;
        }
        $filename = "tutsmake". date("Y-m-d-H-i-s").".csv";
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        $objWriter->save('php://output'); 
 
    }
     
}
?>