<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');

include_once(APPPATH."third_party/PhpWord/Autoloader.php");

use PhpOffice\PhpWord\Autoloader as PHPWord_AutoLoader;
use PhpOffice\PhpWord\PhpWord as PhpWord;
use PhpOffice\PhpWord\IOFactory as PHPWord_IOFactory;

class Generate_rd extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
		$this->load->model('admin/RdData_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
    public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $data['Published_rds'] = $this->RdData_model->get_global_rds(3);
            $this->load->view('admin/rd_view/list',$data);
        }else{			
			$this->load->view('admin/login');
		}
    }

    public function rd_2()
	{
        // var_dump($_GET["report_id"]); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $single_rd_data = $this->RdData_model->get_single_rd_data($_GET["report_id"]);
            /* RD base data extract */
            $report_id = $single_rd_data->id;
            $scope_id = $single_rd_data->scope_id;
            $report_title = $single_rd_data->title;   // title case rd-title
            $report_name = $single_rd_data->name;   // small case rd-title
            $value_cagr = $single_rd_data->value_cagr;
            $value_unit = $single_rd_data->value_unit;
            $forecast_from = $single_rd_data->forecast_from;
            $forecast_to = $single_rd_data->forecast_to;
            $analysis_from = $single_rd_data->analysis_from;
            $analysis_to = $single_rd_data->analysis_to;
            $volume_based_cagr = $single_rd_data->volume_based_cagr;
            $volume_based_unit = $single_rd_data->volume_based_unit;
            $largest_region = $single_rd_data->largest_region;
            /* ./ RD base data extract */
            /* get scope data */
            $ScopeList = $this->Data_model->get_scope_master();				
            foreach($ScopeList as $scope){
                if($scope->id == $scope_id){
                    $scope_name = $scope->name;
                }
            }
            /* ./ get scope data */
            /* Concatenation */
            $forecast_period =$forecast_from.'-'.$forecast_to;
            $market_period =$analysis_from.'-'.$analysis_to;
            $Report_title_scope =$scope_name.' '.$report_title;
            $report_name_scope = strtolower($scope_name).' '.$report_name;

            /* Fetch RD2 Content  */
			/* Report Title */
			$Rd2_report_title = ucwords($report_name, " \t\r\n\f\v'").': '.$scope_name.' Industry Analysis, Trends, Market Size, and Forecasts up to '.$forecast_to;
			
            // Para 1 -----------
            $rd2_para1 = $this->RdData_model->get_rd2_codedecode_para(3);
            $RD2_para1 = $rd2_para1->description;

			$New_RD2_para1 = str_replace("Report_name_scope",$report_name_scope,$RD2_para1);			
			$New_RD2_para_2 = str_replace("Period_value",$market_period,$New_RD2_para1);			
			$New_RD2_para_3 = str_replace("CAGR_value",$value_cagr,$New_RD2_para_2);		
			$New_RD2_para_4 = str_replace("Forecast_period",$forecast_period,$New_RD2_para_3);			
			$New_RD2_para_5 = str_replace("Report_name",$report_name,$New_RD2_para_4);	

            $Scope_Region;
			$get_scope_regions= $this->RdData_model->get_scope_regions($scope_id);
            
            foreach($get_scope_regions as $scope_region)
			{
				$ScReg[] = $scope_region->name;				
			}
            $j= count($ScReg);
			for($i = 0; $i < $j ; $i++)
			{
				if($i == $j-2)
				{
					$Scope_Region .= ltrim(rtrim($ScReg[$i])).", and ";
				}
				if($i == $j-1)
				{
					$Scope_Region .= ltrim(rtrim($ScReg[$i]))." ";
				}
				if($i < $j-2)
				{
					$Scope_Region .= ltrim(rtrim($ScReg[$i])).", ";
				}						
			}
            $Scope_Region_array = $Scope_Region;					
			$Final_RD2_para_1 = str_replace("Region_array",$Scope_Region_array,$New_RD2_para_5);

            // Para 2 -----------
            $rd2_para2 = $this->RdData_model->get_rd2_codedecode_para(4);
			$RD2_para2 = $rd2_para2->description;
			$New_RD2_para_7=str_replace("Report_name_scope",$report_name_scope,$RD2_para2);
			$New_RD2_para_8=str_replace("Report_name",$report_name,$New_RD2_para_7);
			$Final_RD2_para_2=str_replace("Period_value",$market_period,$New_RD2_para_8);

            // Para 3 -----------
            $rd2_para3= $this->RdData_model->get_rd2_codedecode_para(5);
			$RD2_para3=$rd2_para3->description;
			$New_RD2_para_9=str_replace("Report_name_scope",$report_name_scope,$RD2_para3);
			$Final_RD2_para_3=str_replace("Period_value",$market_period,$New_RD2_para_9);
			
           	/* Word file writeup */
			$PHPWord = new PhpWord();
			$section = $PHPWord->addSection();
			$section->addText(htmlspecialchars($Rd2_report_title), array('align'=>'center','name'=>'Verdana','bold'=>true, 'size'=>12));
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$section->addText(htmlspecialchars($Final_RD2_para_1), null, 'pStyle');
			$section->addText(htmlspecialchars($Final_RD2_para_2), null, 'pStyle');
			$section->addText(htmlspecialchars($Final_RD2_para_3), null, 'pStyle');
			$section->addTextBreak();
			$section->addText('Report Findings', array('align'=>'center','bold'=>true,'name'=>'Verdana'));
			$section->addText('1)	Drivers', array('align'=>'center','bold'=>false,'name'=>'Arial'));
			/* Drivers */
			$type = 'Driver';
			$rd2_drivers = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd2_drivers as $deivers)
			{
				$new_driver=ucwords($deivers->description, " \t\r\n\f\v'");	
				$section->addListItem(htmlspecialchars($new_driver), 0);
			}
			$section->addText('2)	Restraints', array('align'=>'center','bold'=>false,'name'=>'Arial'));
			/* Restraints */
			$type = 'Restraint';
			$rd2_restraints = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd2_restraints as $restraints)
			{
				$new_restraints=ucwords($restraints->description, " \t\r\n\f\v'");	
				$section->addListItem(htmlspecialchars($new_restraints), 0);
			}
			$section->addText('3)	Opportunities', array('align'=>'center','bold'=>false,'name'=>'Arial'));
			/* Opportunities */
			$type = 'Opportunity';
			$rd2_opportunities = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd2_opportunities as $opportunities)
			{
				$new_opportunities=ucwords($opportunities->description, " \t\r\n\f\v'");	
				$section->addListItem(htmlspecialchars($new_opportunities), 0);
			}
			$section->addTextBreak(1);
			/* Research Methodology Para */
			$rd2_research_methodology_para= $this->RdData_model->get_rd2_codedecode_para(6);			
			$rd2_research_methodology_para1=$rd2_research_methodology_para->description;
			$rd2_research_methodology_para2 = explode('\n', $rd2_research_methodology_para1);

			$section->addText('Research Methodology', array('align'=>'center','bold'=>true,'name'=>'Verdana'));
			foreach($rd2_research_methodology_para2 as $research_methodology) 
			{
				$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
				$section->addText(htmlspecialchars($research_methodology), null, 'pStyle');
			}
			$section->addTextBreak(1);
			/* Segment Covered Para */
			$section->addText('Segment Covered', array('align'=>'center','bold'=>true,'name'=>'Verdana'));

			$Seg_covered;
			$parent = 0;
			$main_segments= $this->RdData_model->get_main_segments($report_id, $parent);			
			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;
			}				
			$j= count($mainseg);
			for($i=0; $i<$j ; $i++)
			{
				if($i==$j-2)
				{
					$Seg_covered .=ltrim(rtrim($mainseg[$i])).", and ";
				}
				if($i== $j-1)
				{
					$Seg_covered .= ltrim(rtrim($mainseg[$i])).". ";
				}
				if($i<$j-2)
				{
					$Seg_covered .= ltrim(rtrim($mainseg[$i])).", ";
				}
			}			
			$Main_seg_covered = $Seg_covered;			
			$Segment_covered="The ".$report_name_scope." is segmented on the basis of ".strtolower($Main_seg_covered);
			$section->addText(htmlspecialchars($Segment_covered), null, 'pStyle');
			$section->addTextBreak(1);

			$newtext1 = 'The '.$Report_title_scope." by";
			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;
				$main_segment = $newtext1.' '.$segments->name;
				$section->addText(htmlspecialchars($main_segment), array('align'=>'left','bold'=>true,'name'=>'Verdana'));

				$sub_segments= $this->RdData_model->get_main_segments($report_id, $segments->id);			
				foreach($sub_segments as $subsegments)
				{
					$subseg[] = $subsegments->name;
					$sub_segment = $subsegments->name;
					$section->addListItem(htmlspecialchars($sub_segment), 0, 'Header', $listStyle, 'P-Style');

					$child_segments= $this->RdData_model->get_main_segments($report_id, $subsegments->id);			
					if($child_segments)
					{
						foreach($child_segments as $childsegments)
						{
							$childseg[] = $childsegments->name;
							$child_segment = $childsegments->name;
							$section->addListItem(htmlspecialchars($child_segment), 1, 'Header', $listStyle, 'P-Style');

						}
					}
				}		
				$section->addTextBreak(1);
			}
			/* Company Profiles Para */
			$section->addText('Company Profiles', array('align'=>'center','bold'=>true,'name'=>'Verdana'));
			$section->addText('The companies covered in the report include', array('align'=>'center','bold'=>false,'name'=>'Verdana'));
			$Get_rd_companies = $this->RdData_model->get_rd_companies($report_id);
			foreach($Get_rd_companies as $cmp)
			{
				$company_name = $cmp->name;			
				$section->addListItem(htmlspecialchars($company_name), 0, 'Header', $listStyle, 'P-Style');				
			}
			$section->addTextBreak(1);
			/* Report Deliver Para */
			if($scope_name == "Global")
			{
			    $rd2_report_deliver_para = $this->RdData_model->get_rd2_codedecode_para(7);
				$rd2_report_deliver_para1 = $rd2_report_deliver_para->description;

				$section->addText('What does this report deliver?', array('align'=>'center','bold'=>true,'name'=>'Verdana'));
				$deliverylines = explode('\n', $rd2_report_deliver_para1);
				foreach($deliverylines as $DlinePara) 
				{
					$rd2_report_deliver_para2 = str_replace("Forecast_period_last_value",$forecast_to,$DlinePara);						
					$rd2_report_deliver_para3 = str_replace("Report_name_scope",$report_name_scope,$rd2_report_deliver_para2);						
					$rd2_report_deliver_para4 = str_replace("Report_name",$report_name,$rd2_report_deliver_para3);					
					$rd2_report_deliver_para5 = str_replace("Scope_name",strtolower($scope_name),$rd2_report_deliver_para4);					
					$section->addText(htmlspecialchars($rd2_report_deliver_para5), null, 'pStyle');		
				}				
			}
			
			/* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($Report_title_scope));			
			$new_file_name=str_replace("/","-", $new_file_name);
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
			$filename = "".htmlspecialchars($new_file_name)."-RD2.docx";
			$objWriter->save($filename);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$filename);
			// header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filename));
			ob_clean();
			flush();
			readfile($filename);
			unlink($filename);
			exit; // deletes the temporary file		
        }else{			
			$this->load->view('admin/login');
		}
    }
	/**
     * Create new function for TOC.
     **/
	public function toc()
	{		
        // var_dump($_GET["report_id"]); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $single_rd_data = $this->RdData_model->get_single_rd_data($_GET["report_id"]);
            /* RD base data extract */
            $report_id = $single_rd_data->id;
            $scope_id = $single_rd_data->scope_id;
            $report_title = $single_rd_data->title;   // title case rd-title
            $report_name = $single_rd_data->name;   // small case rd-title
            $value_cagr = $single_rd_data->value_cagr;
            $value_unit = $single_rd_data->value_unit;
            $forecast_from = $single_rd_data->forecast_from;
            $forecast_to = $single_rd_data->forecast_to;
            $analysis_from = $single_rd_data->analysis_from;
            $analysis_to = $single_rd_data->analysis_to;
            $volume_based_cagr = $single_rd_data->volume_based_cagr;
            $volume_based_unit = $single_rd_data->volume_based_unit;
            $largest_region = $single_rd_data->largest_region;
            /* ./ RD base data extract */
            /* get scope data */
            $ScopeList = $this->Data_model->get_scope_master();				
            foreach($ScopeList as $scope){
                if($scope->id == $scope_id){
                    $scope_name = $scope->name;
                }
            }
            /* ./ get scope data */
            /* concatination */
            $forecast_period =$forecast_from.'-'.$forecast_to;
            $market_period =$analysis_from.'-'.$analysis_to;
            $Report_title_scope =$scope_name.' '.$report_title;
            $report_name_scope = strtolower($scope_name).' '.$report_name;

			/* Word file writeup */
			$PHPWord = new PhpWord();
			$section = $PHPWord->addSection();			
			$PHPWord->addFontStyle('myOwnStyle', array('bold'=>true,'color'=>'FFF','spaceAfter'=>0));
			$PHPWord->addFontStyle('Header',  array('name'=>'Verdana','spaceAfter'=>0));
			$PHPWord->addParagraphStyle('P-Style', array('spaceAfter'=>110));
			$listStyle = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);

			$section->addText('Table of Content', array('align'=>'left','bold'=>true,'name'=>'Verdana'));
			$section->addTextBreak(1);
			$section->addListItem('Preface', 0, 'myOwnStyle', $listStyle, 'P-Style');			
			$section->addListItem('Report Description', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Research Methods', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Research Approaches', 1, 'Header', $listStyle, 'P-Style');
			$section->addTextBreak(1);
			$section->addListItem('Executive Summary', 0,  'myOwnStyle', $listStyle, 'P-Style');
			$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Highlights', 1,  'Header', $listStyle, 'P-Style');
			$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Projection', 1,  'Header', $listStyle, 'P-Style');

			if ($scope_name=="Global") {		    
				$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Regional Highlights', 1,  'Header', $listStyle, 'P-Style');
		    }else {
			    $section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Country Highlights', 1,  'Header', $listStyle, 'P-Style');
			}
			$section->addTextBreak(1);
			$section->addListItem(htmlspecialchars(ucwords($report_name_scope, " \t\r\n\f\v'")).' Overview', 0, 'myOwnStyle', $listStyle, 'P-Style');
			$section->addListItem('Introduction', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Market Dynamics', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Drivers', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Restraints', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Opportunities', 2, 'Header', $listStyle, 'P-Style');
			// $section->addListItem('Analysis of COVID-19 impact on the '.htmlspecialchars(ucwords($Report_name_1)), 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem("Porter's Five Forces Analysis", 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('IGR-Growth Matrix Analysis', 1, 'Header', $listStyle, 'P-Style');


			/* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($Report_title_scope));			
			$new_file_name=str_replace("/","-", $new_file_name);
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
			$filename = "".htmlspecialchars($new_file_name)."-RD2.docx";
			$objWriter->save($filename);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$filename);
			// header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filename));
			ob_clean();
			flush();
			readfile($filename);
			unlink($filename);
			exit; // deletes the temporary file		
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>