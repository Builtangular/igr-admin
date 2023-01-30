<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');

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

            $data['Published_rds'] = $this->RdData_model->get_global_rd_titles();
            $this->load->view('admin/rd_view/list',$data);
        }else{			
			$this->load->view('admin/login');
		}
    }

	public function rd_1()
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
			$cagr_market_value = $single_rd_data->cagr_market_value;
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
            $Report_title_scope =$scope_name.' '.htmlspecialchars($report_title);
            // $report_name_scope = strtolower($scope_name).' '.$report_name;

			/* description scope name */
			if($scope_name == 'Global'){
				$desc_scope_name = strtolower($scope_name);
			} else {
				$desc_scope_name = $scope_name;
			}
			$report_name_scope = $desc_scope_name.' '.$report_name;
			/* Para 1st */
			$rd1_para1 = $this->RdData_model->get_rd2_codedecode_para(1);
            $RD1_para1 = $rd1_para1->description;
			$New_RD1_para_1 = str_replace("report_name", $report_name, $RD1_para1);			
			$New_RD1_para_2 = str_replace("scope_name", $desc_scope_name, $New_RD1_para_1);	

			/* para last */
			$rd1_para4 = $this->RdData_model->get_rd2_codedecode_para(2);
            $RD1_para4 = $rd1_para4->description;
			$New_RD1_para_4 = str_replace("report_name", $report_name, $RD1_para4);			
			$New_RD1_para_5 = str_replace("forecast_period", strtolower($forecast_period), $New_RD1_para_4);

			$parent = 0;
			$main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;					
					
				$segment_name.= ltrim(rtrim($segments->name))." (";	
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);
				foreach($sub_segments as $subsegments)
				{
					$subseg[] = $subsegments->name;					
				}
				$j= count($subseg);
				for($i = 0; $i< $j ; $i++)
				{
					if($i == $j-2)
					{
						$segment_name.= ltrim(rtrim($subseg[$i])).", and ";
					}
					if($i == $j-1)
					{
						$segment_name.= ltrim(rtrim($subseg[$i]))."), ";
					}
					if($i < $j-2)
					{
						$segment_name.= ltrim(rtrim($subseg[$i])).", ";
					}						
				}
				unset($subseg);					
			}

			$Meta_title = htmlspecialchars($report_title)." Size, Share, Trends, Analysis, Industry Report ".$forecast_to." | IGR";
			$Meta_description = htmlspecialchars(strtolower($report_name_scope." covers segments, by ".$segment_name)."size, trends, CAGR, forecast up to ".$forecast_to);
			$Meta_description=str_replace("amp;","",htmlspecialchars($Meta_description));
			$Meta_keyword = htmlspecialchars(ucwords($report_name.", ".$report_name_scope.", Trends, Analysis, Share, Forecast, Drivers, Restraints, Market Research Report"));
			
			/* Word file writeup */
			$PHPWord = new PhpWord();
			$section = $PHPWord->addSection();
			// Meta Title
			$section->addText(htmlspecialchars("Meta Title:"), array('name'=>'Calibri (Body)','align'=>'center','bold'=>True, 'color'=>'#000','size'=>12));
			$section->addText(htmlspecialchars($Meta_title), array('name'=>'Calibri (Body)','align'=>'center','bold'=>false, 'color'=>'#000','size'=>12));
			$section->addTextBreak(1);
			// Meta Description
			$section->addText(htmlspecialchars("Meta Description:"), array('name'=>'Calibri (Body)','align'=>'center','bold'=>True, 'color'=>'#000','size'=>12));
			$section->addText(htmlspecialchars($Meta_description), array('name'=>'Calibri (Body)','align'=>'center','bold'=>false, 'color'=>'#000','size'=>12));
			$section->addTextBreak(1);
			// Meta Keyword
			$section->addText(htmlspecialchars("Meta Keyword:"), array('name'=>'Calibri (Body)','align'=>'center','bold'=>True, 'color'=>'#000','size'=>12));
			$section->addText(htmlspecialchars($Meta_keyword), array('name'=>'Calibri (Body)','align'=>'center','bold'=>false, 'color'=>'#000','size'=>12));
			$section->addTextBreak(1);
			// URL Path
			$section->addText(htmlspecialchars("Report URL:"), array('name'=>'Calibri (Body)','align'=>'center','bold'=>True, 'color'=>'#000','size'=>12));
			$new_report_name=str_replace(" ","-",htmlspecialchars($report_name_scope));
			$new_report_name=str_replace(",","-", strtolower($new_report_name));
			$new_report_name=str_replace("--","-", $new_report_name);
			$new_report_name=str_replace("/","-", strtolower($new_report_name));
			$new_report_name=str_replace("&","and", strtolower($new_report_name));
			$section->addText(htmlspecialchars($new_report_name), array('name'=>'Calibri (Body)','align'=>'center','bold'=>false, 'color'=>'#000','size'=>12));
			$section->addTextBreak(3);

			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;					
					
				$segment_details.= ltrim(rtrim(strtolower($segments->name)))." - ";	
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);
				foreach($sub_segments as $subsegments)
				{
					$subseg[]=$subsegments->name;			
				}
				$j= count($subseg);
				for($i = 0; $i< $j ; $i++)
				{
					if($i == $j-2)
					{
						$segment_details.= ltrim(rtrim($subseg[$i])).", and ";
					}
					if($i == $j-1)
					{
						$segment_details.= ltrim(rtrim($subseg[$i]))."; ";
					}
					if($i < $j-2)
					{
						$segment_details.= ltrim(rtrim($subseg[$i])).", ";
					}						
				}
				unset($subseg);					
			}
			if($scope_name == 'Global')
			{
				$Report_new_title = htmlspecialchars($report_title)." (".ucwords($segment_details, " \t\r\n\f\v'")."): ".ucwords($scope_name)." Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
			} else {
				$Report_new_title = htmlspecialchars($scope_name.' '.$report_title)." (".ucwords($segment_details, " \t\r\n\f\v'")."): Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
			}
			$Report_new_title=str_replace(" And "," and ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace(" Of "," of ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace(" To "," to ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace(" In "," in ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace(" On "," on ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace(" At "," at ",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace("; )",")",htmlspecialchars($Report_new_title));
			$Report_new_title=str_replace("amp;","",htmlspecialchars($Report_new_title));
			
			// var_dump($Report_new_title); die;
			$section->addText(htmlspecialchars($Report_new_title), array('name'=>'Verdana','align'=>'center','bold'=>true, 'color'=>'006699','size'=>12));
			$section->addTextBreak(1);

			/* CAGR Automation Lines */
			if($cagr_market_value){
				$cagr_value = $cagr_market_value;
			}else if(!is_numeric($value_cagr)){
				$cagr_value = 'According to the report, the '.$desc_scope_name.' '.$report_name.' is projected to grow at a '.$value_cagr.' CAGR over the forecast period of '.$forecast_period.'.';
			}else{
				$cagr_value = 'According to the report, the '.$desc_scope_name.' '.$report_name.' is projected to grow at a CAGR of about '.$value_cagr.'% over the forecast period of '.$forecast_period.'.';
			}
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$section->addText(htmlspecialchars($New_RD1_para_2.$cagr_value), null, 'pStyle');
			$section->addTextBreak(1);
			$section->addText('Market Insight', array('align'=>'Left','bold'=>true,'name'=>'Verdana'));
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$type = "Report Description";
			$market_insight_description = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($market_insight_description as $rd_description){
				// $report_description.= $rd_description->description;
				$section->addText(htmlspecialchars($rd_description->description), null, 'pStyle');
				$section->addTextBreak(1);
			}
			$type = "Summary DRO";
			$market_insight_summary_dro = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($market_insight_summary_dro as $rd_summary_dro){
				// $report_summary_dro.= $rd_summary_dro->description;
				$section->addText(htmlspecialchars($rd_summary_dro->description), null, 'pStyle');
				$section->addTextBreak(1);
			}	
			$type = "Summary Regional Description";
			$market_insight_summary_regional = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($market_insight_summary_regional as $rd_summary_regional){
				// $report_summary_dro.= $rd_summary_dro->description;
				$section->addText(htmlspecialchars($rd_summary_regional->description), null, 'pStyle');
				$section->addTextBreak(1);
			}	
			/* /. Get Global Rd Para 2 - Market Insight */
			/* Get Global Rd Para 3 - Segments Covered */
			$new_text="";
			$segment_covered="";
			$new_text1='The report on '.$report_name_scope.' covers segments such as ';
			/* Getting main and sub segments */	
			$parent = 0;
			$main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($main_segments as $segments)
			{
				$mainseg1[] = strtolower($segments->name);			
				
				$new_text.="On the basis of ".ltrim(rtrim(strtolower($segments->name))).", the sub-markets include ";	
				$SubSegments=$this->RdData_model->get_rd_segments($report_id, $segments->id);
				foreach($SubSegments as $sub_seg)
				{
					$sub_seg1[]=strtolower($sub_seg->name);					
				}
				$j= count($sub_seg1);
				for($i = 0; $i< $j ; $i++)
				{
					if($i == $j-2)
					{
						$new_text.= ltrim(rtrim($sub_seg1[$i])).", and ";
					}
					if($i == $j-1)
					{
						$new_text.= ltrim(rtrim($sub_seg1[$i])).". ";
					}
					if($i < $j-2)
					{
						$new_text.= ltrim(rtrim($sub_seg1[$i])).", ";
					}						
				}
				unset($sub_seg1);					
			}
			$j= count($mainseg1);
			for($i=0; $i<$j ; $i++)
			{
				if($i==$j-2)
				{
					$new_text1 .=ltrim(rtrim($mainseg1[$i])).", and ";
				}
				if($i== $j-1)
				{
					$new_text1 .= ltrim(rtrim($mainseg1[$i])).".";
				}
				if($i<$j-2)
				{
					$new_text1 .= ltrim(rtrim($mainseg1[$i])).", ";
				}
			}
			unset($mainseg1);
			$segment_covered = $new_text1.' '.$new_text;

			$section->addText('Segment Covered', array('align'=>'Left','bold'=>true,'name'=>'Verdana'));
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$section->addText(htmlspecialchars($segment_covered), null, 'pStyle');
			$section->addTextBreak(1);	

			/**************Company Profile****************************/
			/* Fetch companies from database */
			$cmp_profile="The report provides profiles of the companies in the market such as ";
			$Rd_companies=$this->RdData_model->get_rd_companies($report_id);
			foreach($Rd_companies as $cmp)
			{
				$companies[]= $cmp->name;					
			}
			$j= count($companies);				
			for($i = 0; $i< $j ; $i++)
			{
				if($i == $j-2)
				{
					$cmp_profile .= ltrim(rtrim($companies[$i])).", and ";
				}
				if($i == $j-1)
				{
					$cmp_profile .= ltrim(rtrim($companies[$i])).". ";
				}
				if($i < $j-2)
				{
					$cmp_profile .= ltrim(rtrim($companies[$i])).", ";
				}					
			}
			// unset($cmp_profile);
			$company_profile = $cmp_profile;
			$section->addText('Companies Profiled:', array('align'=>'Left','bold'=>true,'name'=>'Verdana'));
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$section->addText(htmlspecialchars($company_profile), null, 'pStyle');
			$section->addTextBreak(1);

			/* Get Global Rd Para 4 - Report Highlights */

			$section->addText('Report Highlights:', array('align'=>'Left','bold'=>true,'name'=>'Verdana'));
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'both', 'spaceAfter'=>100));
			$section->addText(htmlspecialchars($New_RD1_para_5), null, 'pStyle');
			$section->addTextBreak(1);
			// var_dump($company_profile ); die;


			/* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($Report_title_scope));			
			$new_file_name=str_replace("/","-", $new_file_name);
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
			$filename = "".htmlspecialchars($new_file_name)."-RD1.docx";
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
            $Report_title_scope =$scope_name.' '.htmlspecialchars($report_title);
			/* description scope name */
			if($scope_name == 'Global'){
				$desc_scope_name = strtolower($scope_name);
			} else {
				$desc_scope_name = $scope_name;
			}
            $report_name_scope = $desc_scope_name.' '.$report_name;

            /* Fetch RD2 Content  */
			/* Report Title */
			if($scope_name == 'Global'){
				$Rd2_report_title = ucwords($report_name, " \t\r\n\f\v'").': '.$scope_name.' Industry Analysis, Trends, Market Size, and Forecasts up to '.$forecast_to;	
			} else {
				$Rd2_report_title = $scope_name.' '.ucwords($report_name, " \t\r\n\f\v'").': Industry Analysis, Trends, Market Size, and Forecasts up to '.$forecast_to;
			}
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
			if($ScReg != NULL){
                $j= count($ScReg);
    			for($i = 0; $i < $j ; $i++)
    			{
    				if($i == $j-2)
    				{
    					$Scope_Region .= ltrim(rtrim($ScReg[$i])).", and ";
    				}
    				if($i == $j-1)
    				{
    					$Scope_Region .= ltrim(rtrim($ScReg[$i]))."";
    				}
    				if($i < $j-2)
    				{
    					$Scope_Region .= ltrim(rtrim($ScReg[$i])).", ";
    				}						
    			}
    			unset($ScReg);
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
			$main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);			
			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;
			}
			if($mainseg != NULL){
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

				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);			
				foreach($sub_segments as $subsegments)
				{
					$subseg[] = $subsegments->name;
					$sub_segment = $subsegments->name;
					$section->addListItem(htmlspecialchars($sub_segment), 0, 'Header', $listStyle, 'P-Style');
					
					$child_segments= $this->RdData_model->get_rd_segments($report_id, $subsegments->id);			
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
			$rd2_report_deliver_para = $this->RdData_model->get_rd2_codedecode_para(7);
			$rd2_report_deliver_para1 = $rd2_report_deliver_para->description;

			$section->addText('What does this report deliver?', array('align'=>'center','bold'=>true,'name'=>'Verdana'));
			if($scope_name == 'Global'){
				$scope_wise_line = $scope_name.' as well as regional markets';
			}else{
				$scope_wise_line = $scope_name.' countries';
			}
			$deliverylines = explode('\n', $rd2_report_deliver_para1);
			foreach($deliverylines as $DlinePara) 
			{
				$rd2_report_deliver_para2 = str_replace("Forecast_period_last_value",$forecast_to,$DlinePara);						
				$rd2_report_deliver_para3 = str_replace("Report_name_scope",$report_name_scope,$rd2_report_deliver_para2);						
				$rd2_report_deliver_para4 = str_replace("Report_name",$report_name,$rd2_report_deliver_para3);					
				$rd2_report_deliver_para5 = str_replace("Scope_name",$desc_scope_name,$rd2_report_deliver_para4);					
				$rd2_report_deliver_para6 = str_replace("Scope_wise_line",$scope_wise_line,$rd2_report_deliver_para5);					
				$section->addText(htmlspecialchars($rd2_report_deliver_para6), null, 'pStyle');		
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
			/* Chapter 1 */
			$section->addListItem('Preface', 0, 'myOwnStyle', $listStyle, 'P-Style');			
			$section->addListItem('Report Description', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Research Methods', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Research Approaches', 1, 'Header', $listStyle, 'P-Style');
			$section->addTextBreak(1);

			/* Chapter 2 */
			$section->addListItem('Executive Summary', 0,  'myOwnStyle', $listStyle, 'P-Style');
			$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Highlights', 1,  'Header', $listStyle, 'P-Style');
			$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Projection', 1,  'Header', $listStyle, 'P-Style');
			if ($scope_name=="Global") {		    
				$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Regional Highlights', 1,  'Header', $listStyle, 'P-Style');
		    }/* else {
			    $section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Country Highlights', 1,  'Header', $listStyle, 'P-Style');
			} */
			$section->addTextBreak(1);

			/* Chapter 3 */
			$section->addListItem(htmlspecialchars($Report_title_scope).' Overview', 0, 'myOwnStyle', $listStyle, 'P-Style');
			$section->addListItem('Introduction', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Market Dynamics', 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Drivers', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Restraints', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('Opportunities', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem("Porter's Five Forces Analysis", 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('IGR-Growth Matrix Analysis', 1, 'Header', $listStyle, 'P-Style');
			$parent = 0;
			$main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($main_segments as $segment)
			{
				$section->addListItem('IGR-Growth Matrix Analysis by '.htmlspecialchars(ucwords($segment->name, " \t\r\n\f\v'")), 2, 'Header', $listStyle, 'P-Style');
			}
			if($scope_name == "Global") {
				$section->addListItem('IGR-Growth Matrix Analysis by Region', 2, 'Header', $listStyle, 'P-Style');
			}else {
			    $section->addListItem('IGR-Growth Matrix Analysis by Country', 2, 'Header', $listStyle, 'P-Style');
			}
			$section->addListItem('Value Chain Analysis of '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('TAM SAM SOM Analysis for '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 1, 'Header', $listStyle, 'P-Style');
			$section->addListItem('TAM SAM SOM Forecast Analysis (USD '.$value_unit.') '.$forecast_period, 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('TAM', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('SAM', 2, 'Header', $listStyle, 'P-Style');
			$section->addListItem('SOM', 2, 'Header', $listStyle, 'P-Style');
			$section->addTextBreak(1);

			/* Chapter 4 */
			if($scope_name == "Global")
			{
				$section->addListItem(htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' Macro Indicator Analysis', 0, 'myOwnStyle', $listStyle, 'P-Style');
				$section->addTextBreak(1);
			}			

			/* Chapter 5 i.e. Segment Chapters */
			foreach($main_segments as $segments)
			{
				$mainseg[] = $segments->name;				
				$new_segment=$Report_title_scope.' by '.htmlspecialchars(ucwords($segments->name, " \t\r\n\f\v'"));			
				$section->addListItem(htmlspecialchars($new_segment), 0, 'myOwnStyle', $listStyle, 'P-Style');	
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);			
				foreach($sub_segments as $subsegments)
				{
					$subseg[] = $subsegments->name;
					$sub_segment = $subsegments->name;
					$section->addListItem(htmlspecialchars($sub_segment), 1, 'Header', $listStyle, 'P-Style');

					$child_segments= $this->RdData_model->get_rd_segments($report_id, $subsegments->id);			
					if($child_segments)
					{
						foreach($child_segments as $childsegments)
						{
							$childseg[] = $childsegments->name;
							$child_segment = $childsegments->name;
							$section->addListItem(htmlspecialchars(' '.$child_segment), 2, 'Header', $listStyle, 'P-Style');
						}
					}
				}
				$section->addTextBreak(1);
			}

			/* Chapter 6 Region */
			if($scope_name == "Global") {
				$section->addListItem(htmlspecialchars($Report_title_scope).' by Region '.$forecast_period, 0, 'myOwnStyle', $listStyle, 'P-Style');
		    }else{		        
		        $section->addListItem(htmlspecialchars($Report_title_scope).' by Country '.$forecast_period, 0, 'myOwnStyle', $listStyle, 'P-Style');
		    }
			/* Fetch Region Data */
			$Scope_Region;
			$get_scope_regions= $this->RdData_model->get_scope_regions($scope_id);            
            foreach($get_scope_regions as $scope_region)
			{
				$ScReg[] = $scope_region->name;				
			}
			if($ScReg != NULL){
                $j= count($ScReg);
    			for($i = 0; $i < $j ; $i++)
    			{
    				$section->addListItem(htmlspecialchars($ScReg[$i]), 1, 'Header', $listStyle, 'P-Style');
    				foreach($main_segments as $segments)
    				{
    					$mainseg = $segments->name;
    					$region_fix = ltrim(rtrim($ScReg[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'"));
    					$region_report_title = ltrim(rtrim($ScReg[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
    					$section->addListItem(htmlspecialchars($region_report_title), 2, 'Header', $listStyle, 'P-Style');
    				}
					if($scope_name == 'Global'){
						if($ScReg[$i] == "RoW"){
							$section->addListItem(htmlspecialchars($region_fix).' by Sub-region', 2, 'Header', $listStyle, 'P-Style');					
						}else{
							$section->addListItem(htmlspecialchars($region_fix).' by Country', 2, 'Header', $listStyle, 'P-Style');
						}
					}
    			}
    			unset($ScReg);
			}
			$section->addTextBreak(1);

			/* Chapter 7 - Company Profile */
			$section->addListItem('Company Profiles and Competitive Landscape', 0, 'myOwnStyle', $listStyle, 'P-Style');			
			$section->addListItem('Competitive Landscape in the '.ucfirst($scope_name).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 1, 'Header', $listStyle, 'P-Style');			
			$section->addListItem('Companies Profiles', 1, 'Header', $listStyle, 'P-Style');	
			$Get_rd_companies = $this->RdData_model->get_rd_companies($report_id);
			foreach($Get_rd_companies as $company)
			{
				$cmpProfile=$company->name;				
				$section->addListItem(htmlspecialchars($cmpProfile), 2, 'Header', $listStyle, 'P-Style');				
				/* $section->addListItem('Overview', 3, 'Header', $listStyle, 'P-Style');				
				$section->addListItem('Company Snapshot', 3, 'Header', $listStyle, 'P-Style');				
				$section->addListItem('Financial Snapshot', 3, 'Header', $listStyle, 'P-Style');				
				//$section->addListItem('DuPont Analysis', 3, 'Header', $listStyle, 'P-Style');				
				$section->addListItem('Product Portfolio', 3, 'Header', $listStyle, 'P-Style');				
				$section->addListItem('Recent Developments', 3, 'Header', $listStyle, 'P-Style'); */				
			}

			/* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($Report_title_scope));			
			$new_file_name=str_replace("/","-", $new_file_name);
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
			$filename = "".htmlspecialchars($new_file_name)."-TOC.docx";
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
	public function sample_pages(){
		// var_dump($_GET["report_id"]); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $single_rd_data = $this->RdData_model->get_single_rd_data($_GET["report_id"]);
            /* RD base data extract */
            $report_id = $single_rd_data->id;
            $scope_id = $single_rd_data->scope_id;
            $report_title = $single_rd_data->title;   // Title case rd-title
            $report_name = $single_rd_data->name;   // small case rd-title
            $value_cagr = $single_rd_data->value_cagr;
            $Value_unit = $single_rd_data->value_unit;
            $forecast_from = $single_rd_data->forecast_from;
            $forecast_to = $single_rd_data->forecast_to;
            $analysis_from = $single_rd_data->analysis_from;
            $analysis_to = $single_rd_data->analysis_to;
            $volume_based_cagr = $single_rd_data->volume_based_cagr;
            $Volume_unit = $single_rd_data->volume_based_unit;
            $largest_region = $single_rd_data->largest_region;
            /* ./ RD base data extract */
            /* get scope data */
            $ScopeList = $this->Data_model->get_scope_master();				
            foreach($ScopeList as $scope){
                if($scope->id == $scope_id){
                    $scope_name = $scope->name;
                }
            }
			if($scope_name == 'Global'){
				$desc_scope_name = strtolower($scope_name);
				$scope_type = 'Region';
				$geographic = 'geographic regions';
			} else {
				$desc_scope_name = $scope_name;
				$scope_type = 'Country';
				$geographic = 'countries';
			}
            $report_name_scope = $desc_scope_name.' '.$report_name;
			
            /* ./ get scope data */
            /* get Rd segments */
			$parent = 0;
			$rd_main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($rd_main_segments as $rd_segments)
			{
				$mainseg[] = $rd_segments->name;	
			}
			if($mainseg != NULL){
    			$j= count($mainseg);
    			for($i=0; $i<$j ; $i++)
    			{
    				if($i==$j-2)
    				{
    					$segment1 .=ltrim(rtrim($mainseg[$i]))." and ";
    				}
    				if($i== $j-1)
    				{
    					$segment1 .= ltrim(rtrim($mainseg[$i]))."";
    				}
    				if($i<$j-2)
    				{
    					$segment1 .= ltrim(rtrim($mainseg[$i])).", ";
    				}
    			}
			}
			$rd_segments_name = $segment1;
            /* ./ get Rd segments */
			/* get Rd Scope Region Data */
			$Scope_Region;
			$get_scope_regions= $this->RdData_model->get_scope_regions($scope_id);            
            foreach($get_scope_regions as $scope_region)
			{
				$ScReg[] = $scope_region->name;				
			}
			if($ScReg != NULL){
    			$s= count($ScReg);
    			for($i=0; $i<$s; $i++)
    			{
    				if($i==$s-2)
    				{
    					$region_name .=ltrim(rtrim($ScReg[$i]))." and ";
    				}
    				if($i== $s-1)
    				{
    					$region_name .= ltrim(rtrim($ScReg[$i]))."";
    				}
    				if($i<$s-2)
    				{
    					$region_name .= ltrim(rtrim($ScReg[$i])).", ";
    				}
    			}
    			unset($ScReg);
			}
			$rd_region_name = $region_name;
			/* /. get Rd Scope Region Data */
            /* Concatenation */
            $forecast_period =$forecast_from.'-'.$forecast_to;
            $market_period =$analysis_from.'-'.$analysis_to;
			$Base_year = $forecast_from - 1;
			$From_historic = $analysis_from - 2;
            $Report_title_scope =$scope_name.' '.$report_title;
            // $report_name_scope = strtolower($scope_name).' '.$report_name;
			$report_name_scope = $desc_scope_name.' '.$report_name;

			if($USD_value == 0 || $USD_value == ""){
				$USD_value='X.XX';
			}else{
				$USD_value = $USD_value;
			}
			/* get rd market insight data */
			$type = "Report Definition";
			$definition = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($definition as $rd_definition){
				$report_definition.= $rd_definition->description;
			}	
			$type = "Report Description";
			$report_description = $this->RdData_model->get_rd_market_insight($report_id, $type);	
			/* Sample - Report Description Para 1 */
			$Sample_report_description_para1 = $this->RdData_model->get_rd2_codedecode_para(8);			
			$Get_sample_page_description_para1=$Sample_report_description_para1->description;
			$New_sample_description_para1=str_replace("Report_name_scope",$report_name_scope,$Get_sample_page_description_para1);
			$New_sample_description_para1_1=str_replace("USD_value",$USD_value,$New_sample_description_para1);
			$New_sample_description_para1_2=str_replace("Value_unit",strtolower($Value_unit),$New_sample_description_para1_1);
			$New_sample_description_para1_3=str_replace("base_year",$Base_year,$New_sample_description_para1_2);
			$New_sample_description_para1_4=str_replace("CAGR_value",$value_cagr,$New_sample_description_para1_3);
			$New_sample_description_para1_5=str_replace("Forecast_period",$forecast_period,$New_sample_description_para1_4);
			foreach($report_description as $rd_description){
				$report_description_para.= $rd_description->description;
			}
			$New_sample_description_para1_6=str_replace("Report_description",$report_description_para,$New_sample_description_para1_5);
			/* Sample - Report Description Para 2 */
			$Sample_report_description_para2 = $this->RdData_model->get_rd2_codedecode_para(9);
			$Get_sample_page_description_para2 = $Sample_report_description_para2->description;
			$New_sample_description_para2 = str_replace("Report_name_scope",$report_name_scope,$Get_sample_page_description_para2);
			$New_sample_description_para2_1 = str_replace("Report_title",$report_name,$New_sample_description_para2);
			$New_sample_description_para2_2 = str_replace("From_period",$analysis_from,$New_sample_description_para2_1);
			$New_sample_description_para2_3 = str_replace("To_period",$analysis_to,$New_sample_description_para2_2);
			$New_sample_description_para2_4 = str_replace("base_year",$Base_year,$New_sample_description_para2_3);
			$New_sample_description_para2_5 = str_replace("From_forecast",$forecast_from,$New_sample_description_para2_4);
			$New_sample_description_para2_6 = str_replace("To_forecast",$forecast_to,$New_sample_description_para2_5);
			$New_sample_description_para2_7 = str_replace("Value_unit",$Value_unit,$New_sample_description_para2_6);
			$New_sample_description_para2_8 = str_replace("Segment_name",strtolower($rd_segments_name),$New_sample_description_para2_7);
			$New_sample_description_para2_9 = str_replace("Scope_name",$desc_scope_name,$New_sample_description_para2_8);
			$New_sample_description_para2_10 = str_replace("Scope_type",strtolower($scope_type),$New_sample_description_para2_9);
			$New_sample_description_para2_11 = str_replace("Region_name",$rd_region_name,$New_sample_description_para2_10);
			$New_sample_description_para2_12 = str_replace("Geographic_area",$geographic,$New_sample_description_para2_11);
			if($scope_name == 'Global'){
				$New_sample_description_para2_13 = $New_sample_description_para2_12." The market size and forecasts are also given for these regions. Countries with major market revenues are covered for each of the region.";
			} else {
				$New_sample_description_para2_13 = $New_sample_description_para2_12." The market size and forecasts are also given for these countries with major market revenues are covered for each of the country.";
			}
			// var_dump($New_sample_description_para2_13); die;
            
			/* Sample - Report Description Para 3 */
			$Sample_report_description_para3 = $this->RdData_model->get_rd2_codedecode_para(10);
			$Get_sample_page_description_para3 = $Sample_report_description_para3->description;
			$New_sample_description_para3 = str_replace("Report_title",$report_name,$Get_sample_page_description_para3);
			$New_sample_description_para3_1 = str_replace("Report_name_scope",$report_name_scope,$New_sample_description_para3);
			$New_sample_description_para3_2 = str_replace("Forecast_period",$forecast_period,$New_sample_description_para3_1);
             
			// Report Methodology						
			$Research_methodology = $this->RdData_model->get_rd2_codedecode_para(11);
			$Get_research_methodology = $Research_methodology->description;
			$research_methodology = str_replace("Report_name",$report_name,$Get_research_methodology);
           
			/* Sample - Research Approaches */
			$Research_approaches = $this->RdData_model->get_rd2_codedecode_para(12);
			$Get_research_approaches_para1 = $Research_approaches->description;
			$Get_research_approaches_para1_1 = str_replace("Report_name_scope",$report_name_scope,$Get_research_approaches_para1);
			$Get_research_approaches_para1_2 = str_replace("From_forecast",$forecast_from,$Get_research_approaches_para1_1);
			$Get_research_approaches_para1_3 = str_replace("To_forecast",$forecast_to,$Get_research_approaches_para1_2);
			if($Volume_unit){
				$Get_research_approaches_para1_4 = str_replace("Value_unit",strtolower($Value_unit).' and in terms of volume in '.strtolower($Volume_unit),$Get_research_approaches_para1_3);
			}else{
				$Get_research_approaches_para1_4 = str_replace("Value_unit",strtolower($Value_unit),$Get_research_approaches_para1_3);
			}
			$Get_research_approaches_para1_5 = str_replace("report_title",$report_name,$Get_research_approaches_para1_4);
			$Get_research_approaches_para1_6 = str_replace("Scope_name",$desc_scope_name,$Get_research_approaches_para1_5);

			$Research_approaches2 = $this->RdData_model->get_rd2_codedecode_para(13);
			$Get_research_approaches_para2 = $Research_approaches2->description;
			$Get_research_approaches_para2_1 = str_replace("Segment_name",strtolower($rd_segments_name),$Get_research_approaches_para2);
			$Get_research_approaches_para2_2 = str_replace("Region_name",$rd_region_name,$Get_research_approaches_para2_1);
			$Get_research_approaches_para2_3 = str_replace("Scope_name",$desc_scope_name,$Get_research_approaches_para2_2);

			$Research_approaches3 = $this->RdData_model->get_rd2_codedecode_para(14);
			$Get_research_approaches_para3 = $Research_approaches3->description;
			$Get_research_approaches_para3_1 = str_replace("Report_name_scope",$report_name_scope,$Get_research_approaches_para3);
			$Get_research_approaches_para3_2 = str_replace("Report_name",strtolower($report_name),$Get_research_approaches_para3_1);
			$Get_research_approaches_para3_3 = str_replace("Scope_name",$desc_scope_name,$Get_research_approaches_para3_2);

			/* Sample - Executive Summary */
			$executive_summary = $this->RdData_model->get_rd2_codedecode_para(15);
			$Get_executive_summary_para1 = $executive_summary->description;
			$Get_executive_summary_para1_1 = str_replace("Report_name_scope",$report_name_scope,$Get_executive_summary_para1);
			$Get_executive_summary_para1_2 = str_replace("CAGR_value",$value_cagr,$Get_executive_summary_para1_1);
			$Get_executive_summary_para1_3 = str_replace("From_forecast",$forecast_from,$Get_executive_summary_para1_2);
			$Get_executive_summary_para1_4 = str_replace("To_forecast",$forecast_to, $Get_executive_summary_para1_3);
			$type = "Summary DRO";
			$Executive_summery = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($Executive_summery as $rd_executive_summery){
				$rd_executive_summery_data.= $rd_executive_summery->description;
			}	
			$Get_executive_summary_para1_5 = str_replace("Sample_executive_summary",$rd_executive_summery_data, $Get_executive_summary_para1_4);

			/* Sample - DRO Analysis */
			$Get_dro_analysis_para1 = $this->RdData_model->get_rd2_codedecode_para(16);
			$dro_analysis1 = $Get_dro_analysis_para1->description;					
			$dro_analysis_para1 = str_replace("Report_name_scope",$report_name_scope,$dro_analysis1);
			$dro_analysis_para1_2 = str_replace("report_title",$report_name,$dro_analysis_para1);

			$Get_dro_analysis_para2 = $this->RdData_model->get_rd2_codedecode_para(17);
			$dro_analysis2 = $Get_dro_analysis_para2->description;	
			$dro_analysis_para2_1 = str_replace("Report_name",$report_name,$dro_analysis2);
			$dro_analysis_para2_2 = str_replace("report_title",$report_name,$dro_analysis_para2_1);

			$type = "Summary Regional Description";
			$regional_description = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($regional_description as $rd_regional_description){
				$report_regional_description.= $rd_regional_description->description;
			}
			
			$type = "Compitative Landscape";
			$compitative_landscape = $this->RdData_model->get_rd_market_insight($report_id, $type);
			foreach($compitative_landscape as $rd_compitative_landscape){
				$report_compitative_landscape.= $rd_compitative_landscape->description;
			}	
            
			/*  Sample - Porter’s Five Forces Analysis */
			$porters_five_forces = $this->RdData_model->get_rd2_codedecode_para(18);
			$porters_five_forces_para = $porters_five_forces->description;

			/* IGR- Growth Matrix Analysis  */
			$growth_matrix_analysis = $this->RdData_model->get_rd2_codedecode_para(19);
			$growth_matrix_analysis_para = $growth_matrix_analysis->description;
			$growth_matrix_analysis_para1 = str_replace("Segments_name",$segment1,$growth_matrix_analysis_para);
			
			/* IGR- Growth Matrix Analysis Sub Point */
			$growth_matrix_analysis_sub_point = $this->RdData_model->get_rd2_codedecode_para(20);
			$growth_matrix_analysis_sub_point_data = $growth_matrix_analysis_sub_point->description;

			/* Sample – Primary Research Para 1 */
			$Get_primary_research_para = $this->RdData_model->get_rd2_codedecode_para(21);
			$primary_research_para = $Get_primary_research_para->description;

			/* Sample – Primary Research Sources Points */
			$Get_primary_research_source_points = $this->RdData_model->get_rd2_codedecode_para(22);
			$primary_research_source_points = $Get_primary_research_source_points->description;
			$primary_research_source_points1 = str_replace("XYZ Market",$report_name,$primary_research_source_points);

			/* Sample – Primary Research Data Points */
			$Get_primary_research_data_points = $this->RdData_model->get_rd2_codedecode_para(23);
			$primary_research_data_points = $Get_primary_research_data_points->description;

			/* Sample – Secondary Research Para 1 */
			$Get_secondary_research_para = $this->RdData_model->get_rd2_codedecode_para(24);
			$secondary_research_para = $Get_secondary_research_para->description;
			$secondary_research_para1 = str_replace("Report_name",$report_name,$secondary_research_para);

			/* Sample – Secondary Research Sources Points */
			$Get_secondary_research_source_points = $this->RdData_model->get_rd2_codedecode_para(25);
			$secondary_research_source_points = $Get_secondary_research_source_points->description;
			
			// var_dump($secondary_research_source_points); die;
			/* /. Sample - Report Description Para1	 */

			/* ******************Word File Writing******************* */
			$PHPWord = new PhpWord();
			// $section = $PHPWord->addSection();
			$section = $PHPWord->addSection(array('marginLeft'=>720, 'marginRight'=>720,'marginTop'=>1440,'marginBottom'=>1150, 'orientation' => 'landscape'));
			 
			/*----------------------Header -------------------------------*/	
			$PHPWord->addParagraphStyle('headerTitle', array('align'=>'left', 'spacing' => 72, 'spaceBefore' => 240, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('headerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 9, 'italic' =>true));
			$header = $section->addHeader();
			$table = $header->addTable();
			$table->addRow();
			$table->addCell(12700, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 360, 'after' => 280))))->addText(htmlspecialchars(ucwords($report_title).": ".htmlspecialchars($scope_name)." Industry Analysis, Trends, Market Size and Forecasts up to ".$forecast_to),'headerTitleFont', 'headerTitle');
			$table->addCell(1300, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 360, 'after' => 280))))->addImage('images/logo.png', array('width'=>160, 'height'=>37, 'align'=>'right'));
			$header->addWatermark('images/sample.jpg', array('marginTop'   => 0.5, 'width'=>720, 'height'=>400));
			/*----------------------Header -------------------------------*/

			/*----------------------Footer -------------------------------*/
			$PHPWord->addParagraphStyle('footerTitle', array('align'=>'right', 'spacing' => 72, 'spaceBefore' => 120, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('footerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 10.5));
			$footer = $section->addFooter();
			$table = $footer->addTable();
			$table->addRow();
			$table->addCell(14000);
			$table->addRow();
			$copyright = "© Infinium Global Research";
			$table->addCell(12700, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop' => 0.5,  'marginBottom' => 0.5))->addText(html_entity_decode($copyright), 'footerTitleFont', 'headerTitle');
			$table->addCell(1300, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom' => 0.5))->addPreserveText('Page {PAGE}', 'footerTitleFont', 'footerTitle');
			/*----------------------Footer -------------------------------*/

			/* Cover page */
			$section->addText(htmlspecialchars(strtoupper($report_title)), array('align'=>'left','name'=>'Roboto Condensed', 'color'=>'#78777C', 'size' => 28));
			$section->addText(strtoupper($scope_name).' INDUSTRY ANALYSIS, TRENDS, MARKET SIZE AND FORECASTS UP TO '.strtoupper($forecast_to), array('align'=>'left','name'=>'Roboto Condensed', 'color'=>'#78777C', 'size' => 11));
			$section->addImage('images/home_page.jpg', array('width'=>720, 'height'=>420, 'wrapText' => 'square','wrappingStyle' => 'behind'));				
			$section->addPageBreak();
			$section->addImage('images/about_us.jpg', array('width'=>720, 'height'=>550, 'align'=>'center', 'wrappingStyle' => 'tight'));

			/* Paragraph Styles */
			$PHPWord->addFontStyle('Style1', array('align'=>'left','name'=>'Roboto Condensed','size'=>20,'color'=>'#E59C24', 'bold' => true, 'pageBreakBefore' => true));
			$PHPWord->addFontStyle('myOwnStyle', array('bold'=>false,'spaceAfter'=>0, 'name'=>'Franklin Gothic Medium','size' => 13, 'color'=>'#E59C24', 'line-height'=> 1.5));
			$PHPWord->addFontStyle('ChapStyle', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>13,'color'=>'#E59C24', 'bold' => false));
			$PHPWord->addFontStyle('subpoint', array('bold'=>false, 'name'=>'Franklin Gothic Medium','size' => 10, 'color'=>'#78777C'));
			$PHPWord->addFontStyle('childpoint', array('bold'=>false, 'name'=>'Franklin Gothic Medium','size' => 9, 'color'=>'#626262'));
			$PHPWord->addParagraphStyle('P-Style', array('spacing' => 0, 'spaceAfter'=>100, 'name'=>'Franklin Gothic Medium', 'size' => 10.5,'color'=>'#78777C', 'indentation' => array('left' => 0.9, 'right' => 0.27, 'hanging' => 0.65)));
			$PHPWord->addParagraphStyle('PStyle', array('spacing' => 120, 'spaceBefore' => 120, 'spaceAfter'=>0, 'name'=>'Franklin Gothic Medium', 'size' => 10.5,'color'=>'#78777C', 'indentation' => array('left' => 0.9, 'right' => 0.27, 'hanging' => 0.65)));
			$listStyle = array('color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0, 'listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);
			/***********  /. Paragraph Styles */
            
			/* ************* Report TOC Writing ******************* */
			$section->addText('Table of Contents', 'Style1');
			$section->addTextBreak(1);
			/* Chapter 1 */
			$section->addText('1.	Introduction', 'ChapStyle', 'PStyle');				
			$section->addText('	1.1	Report Description', 'subpoint', 'P-Style');
			$section->addText('		1.1.1	Segmentation and Research Scope', 'childpoint', 'P-Style');
			$section->addText('		1.2.1	Definition, Abbreviations, and Assumptions', 'childpoint', 'P-Style');
			$section->addText('	1.2	Research Methods', 'subpoint', 'P-Style');
			$section->addText('		1.2.1	Methodology','childpoint', 'P-Style');
			$section->addText('		1.2.2	Research Methodology: An Outline','childpoint', 'P-Style');
			$section->addText('	1.3	Research Approaches', 'subpoint', 'P-Style');
			/* Chapter 2 */
			$section->addText('2.	Executive Summary', 'ChapStyle', 'PStyle');
			if($Volume_unit){
				$section->addText('	2.1	'.htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'")).' Highlights, (USD '.htmlspecialchars($Value_unit).', '.htmlspecialchars($Volume_unit).')', 'subpoint', 'P-Style');
			}else{
				$section->addText('	2.1	'.htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'")).' Highlights, (USD '.htmlspecialchars($Value_unit).')', 'subpoint', 'P-Style');
			}
			$section->addText('	2.2	'.htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'")).' Projection', 'subpoint', 'P-Style');
			if($scope_name == 'Global'){
				$section->addText('	2.3	'.htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'")).' CAGR, (USD '.htmlspecialchars($Value_unit).') Growth, By Regions', 'subpoint', 'P-Style');
				$section->addText('	2.4	Most Lucrative Country Markets, '.htmlspecialchars($forecast_from), 'subpoint', 'P-Style');
			} 
			/* TOC Chapter 3 */
			$section->addText(htmlspecialchars('3.	Market Overview & Competitiveness'), 'ChapStyle', 'PStyle');
			$section->addText(htmlspecialchars('	3.1	Introduction'), 'subpoint', 'P-Style');
			$section->addText(htmlspecialchars('	3.2	DRO Analysis'), 'subpoint', 'P-Style');
			/* Drivers */
			$section->addText(htmlspecialchars('		3.2.1	Drivers'), 'childpoint', 'P-Style');
			
			$type = 'Driver';
			$rd2_drivers = $this->RdData_model->get_rd_dro($report_id, $type);
			
			foreach($rd2_drivers as $deivers)
			{
				$drivers[] = $deivers->description;
			}
			if($drivers != NULL){
			    $d = count($drivers);
		    	$n = 1;
    			for($i = 0; $i < $d ; $i++)
    			{
    				$section->addText('			3.2.1.'.htmlspecialchars($n).'	'.htmlspecialchars($drivers[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}
			/* Restraints */
			$section->addText('		3.2.2	Restraints', 'childpoint', 'P-Style');
			$type = 'Restraint';
			$rd2_restraints = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd2_restraints as $restraints)
			{
				$restraint[] = $restraints->description;
			}
			if($restraint != NULL){
    			$r = count($restraint);
    			$n = 1;
    			for($i = 0; $i < $r ; $i++)
    			{
    				$section->addText('			3.2.2.'.htmlspecialchars($n).'	'.htmlspecialchars($restraint[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}
			
			/* Opportunities */
			$section->addText('		3.2.3	Opportunities', 'childpoint', 'P-Style');
			$type = 'Opportunity';
			$rd2_opportunities = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd2_opportunities as $opportunities)
			{
				$opportunity[] = $opportunities->description;
			}
			if($opportunity != NULL){
    			$o = count($opportunity);
    			$n = 1;
    			for($i = 0; $i < $o ; $i++)
    			{
    				$section->addText('			3.2.3.'.htmlspecialchars($n).'	'.htmlspecialchars($opportunity[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}
			$section->addText("	3.3	Porter's Five Forces Analysis", 'subpoint', 'P-Style');
			$section->addText('	3.4	IGR-Growth Matrix Analysis', 'subpoint', 'P-Style');
			$parent = 0;
			$main_segments = $this->RdData_model->get_rd_segments($report_id, $parent);	
			$sm = 1;
			foreach($main_segments as $segment)
			{
				$section->addText('		3.4.'.htmlspecialchars($sm).'	IGR-Growth Matrix Analysis by '.ucwords(htmlspecialchars($segment->name)), 'childpoint', 'P-Style');
				$sm++;
			}
			$section->addText('		3.4.'.htmlspecialchars($sm).'	IGR-Growth Matrix Analysis by '.$scope_type, 'childpoint', 'P-Style');
			$section->addText('	3.5	Value Chain Analysis of '.htmlspecialchars($report_title), 'subpoint', 'P-Style');
			$section->addText('	3.6	TAM SAM SOM Analysis for '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 'subpoint', 'P-Style');
			$section->addText('		3.6.1.	TAM SAM SOM Forecast Analysis (USD '.$Value_unit.') '.$forecast_period, 'childpoint', 'P-Style');
			$section->addText('		3.6.2.	TAM', 'childpoint', 'P-Style');
			$section->addText('		3.6.3.	SAM', 'childpoint', 'P-Style');
			$section->addText('		3.6.4.	SOM', 'childpoint', 'P-Style');
            
			/* TOC Chapter 4 */
			if($scope_name == "Global"){
				$section->addText('4.	'.htmlspecialchars($report_title.' Macro Indicator Analysis'), 'ChapStyle', 'PStyle');
				$chap = 5;
			} else {
				$desc_scope_name = $scope_name;
				$chap = 4;
			}
            
			/* TOC Chapter 5 Segment */
			foreach($main_segments as $segments)
			{
				$new_segment=$Report_title_scope.' by '.htmlspecialchars(ucwords($segments->name, " \t\r\n\f\v'"));	
				if($Volume_unit){
					$section->addText($chap.'.	'.htmlspecialchars($new_segment).' (USD '.htmlspecialchars($Value_unit).', '.htmlspecialchars($Volume_unit).')', 'ChapStyle', 'PStyle');
				}else{
					$section->addText($chap.'.	'.htmlspecialchars($new_segment).' (USD '.htmlspecialchars($Value_unit).')', 'ChapStyle', 'PStyle');
				}
				$section->addText('	'.$chap.'.1	Overview', 'subpoint', 'P-Style');
				$subpt = 2;
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);		
				foreach($sub_segments as $subsegments)
				{
					$sub_segment = $subsegments->name;
					$section->addText('	'.$chap.'.'.$subpt.'	'.htmlspecialchars($sub_segment), 'subpoint', 'P-Style');
					
					$childpt = 1;
					$child_segments= $this->RdData_model->get_rd_segments($report_id, $subsegments->id);			
					if($child_segments)
					{
						foreach($child_segments as $childsegments)
						{
							$child_segment = $childsegments->name;
							$section->addText('		'.$chap.'.'.$subpt.'.'.$childpt.'	'.htmlspecialchars($child_segment), 'childpoint', 'P-Style');
							$childpt++;
						}
					}
					$subpt++;
				}
				$chap++;
				$regchapt = $chap;
			}
			
			/* TOC Chapter 6 Region */
			if($Volume_unit){
				$section->addText($regchapt.'.	'.htmlspecialchars($Report_title_scope).', by '.$scope_type.' (USD '.htmlspecialchars($Value_unit).', '.htmlspecialchars($Volume_unit).")", 'ChapStyle', 'PStyle');
			} else {
				$section->addText($regchapt.'.	'.htmlspecialchars($Report_title_scope).', by '.$scope_type.' (USD '.htmlspecialchars($Value_unit).")", 'ChapStyle', 'PStyle');
			}
			$section->addText('	'.$regchapt.'.1	Overview', 'subpoint', 'P-Style');
			/* Fetch Region Data */
			$Scope_Region;
			$get_scope_regions= $this->RdData_model->get_scope_regions($scope_id);            
            foreach($get_scope_regions as $scope_region)
			{
				$ScReg[] = $scope_region->name;				
				$ScRegId[] = $scope_region->id;				
			}
			if($ScReg != NULL){
    			$regsubpt = 2;
                $j= count($ScReg);
    			for($i = 0; $i < $j ; $i++)
    			{
    				$section->addText('	'.$regchapt.'.'.$regsubpt.'	'.htmlspecialchars($ScReg[$i]).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 'subpoint', 'P-Style');
    
    				$regchildpt = 1;
    				foreach($main_segments as $segments)
    				{
    					$mainseg = $segments->name;
    					$region_fix = ltrim(rtrim($ScReg[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'"));
    					$region_report_title = ltrim(rtrim($ScReg[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.htmlspecialchars(ucwords($mainseg, " \t\r\n\f\v'"));
    					$section->addText('		'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'	'.htmlspecialchars($region_report_title), 'childpoint', 'P-Style');
    					$regchildpt++;
    				}
				if($scope_name == 'Global'){
    				if($ScReg[$i] == "RoW"){	
    					$section->addText('		'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'	'.htmlspecialchars($region_fix).' by Sub-region', 'childpoint', 'P-Style');
    					/* adding country points */
    					$get_scope_country = $this->RdData_model->get_scope_regions($ScRegId[$i]); 
    					foreach($get_scope_country as $Reg_c)
    					{
    						$Regcntry[] = $Reg_c->name;				
    						$Regcntryid[] = $Reg_c->id;	
    					}
    					if($Regcntry != NULL){
        					$x= count($Regcntry);
        					$c_num = 1;
        					for($r = 0; $r < $x ; $r++)
        					{
        						$Region_country= ltrim(rtrim($Regcntry[$r]))." ";				
        						$section->addText('			'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'.'.$c_num.'	'.htmlspecialchars($Region_country), 'childpoint', 'P-Style');
        						$sub_seg = 1;
        						foreach($main_segments as $segments)
        						{
        							$region_country_title = ltrim(rtrim($Region_country)).' '.ltrim(rtrim(ucwords($report_name, " \t\r\n\f\v'"))).', by '.ltrim(rtrim(ucwords($segments->name)));							
        							$section->addText('				'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'.'.$c_num.'.'.$sub_seg.' '.htmlspecialchars($region_country_title), 'childpoint', 'P-Style');
        							$sub_seg++;
        						}
        						$c_num++;
        					}
        					unset($Regcntry);
    					}
    				}else{
    					$section->addText('		'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'	'.htmlspecialchars($region_fix).' by Country', 'childpoint', 'P-Style');
    					/* adding country points */
    					$get_scope_country = $this->RdData_model->get_scope_regions($ScRegId[$i]); 
    					foreach($get_scope_country as $Reg_c)
    					{
    						$Regcntry[] = $Reg_c->name;				
    						$Regcntryid[] = $Reg_c->id;	
    					}
    					if($Regcntry != NULL){
        					$x= count($Regcntry);
        					$c_num = 1;
        					for($r = 0; $r < $x ; $r++)
        					{
        						$Region_country= ltrim(rtrim($Regcntry[$r]))." ";				
        						$section->addText('			'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'.'.$c_num.'	'.htmlspecialchars($Region_country), 'childpoint', 'P-Style');
        						$sub_seg = 1;
        						foreach($main_segments as $segments)
        						{
        							$region_country_title = ltrim(rtrim($Region_country)).' '.ltrim(rtrim(ucwords($report_name, " \t\r\n\f\v'"))).', by '.ltrim(rtrim(ucwords($segments->name)));							
        							$section->addText('				'.$regchapt.'.'.$regsubpt.'.'.$regchildpt.'.'.$c_num.'.'.$sub_seg.' '.htmlspecialchars($region_country_title), 'childpoint', 'P-Style');
        							$sub_seg++;
        						}
        						$c_num++;
        					}
        					unset($Regcntry);
    					}
    				}
				}
    				$regsubpt++;
    				$cmpt = $regchapt + 1;
    			}
    			unset($ScReg);
			}
			
			/* Company Profiles */
			$section->addText($cmpt.'.	Company Profiles and Competitive Landscape', 'ChapStyle', 'PStyle');	
			$section->addText('	'.$cmpt.'.1	Competitive Landscape in the '.htmlspecialchars(ucwords($report_title, " \t\r\n\f\v'")), 'childpoint', 'P-Style');
			$section->addText('	'.$cmpt.'.2	Companies Profiles', 'childpoint', 'P-Style');
			$cmpsub = 2;
			$cmpsubchild = 1;
			$Get_rd_companies = $this->RdData_model->get_rd_companies($report_id);
			foreach($Get_rd_companies as $company)
			{				
				$cmpProfile = $company->name;					
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'	'.htmlspecialchars($cmpProfile), 'subpoint', 'P-Style');
				$section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.1	Overview', 'childpoint', 'P-Style');				
				$section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.2	Company Snapshot', 'childpoint', 'P-Style');
				$section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.3	Product Portfolio', 'childpoint', 'P-Style');	
				$section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.4	Recent Developments', 'childpoint', 'P-Style');	
				$cmpsubchild++;
			}
			$section->addPageBreak();
			/* ************* /. Report TOC Writing ******************* */

			/* *************** List of Tables Only for value ********************** */
			$PHPWord->addParagraphStyle('ParaStyle1', array('align'=>'left', 'spacing' => 0, 'spaceBefore' => 300, 'spaceAfter'=>0));
			$PHPWord->addFontStyle('Style1', array('align'=>'left','name'=>'Roboto Condensed','size'=>20,'color'=>'#E59C24', 'bold' => true, 'pageBreakBefore' => true));

			$section->addText('List of Tables', 'Style1', 'ParaStyle1');
			$section->addTextBreak(1);
			$section->addText('TABLE 1   '.htmlspecialchars(strtoupper($Report_title_scope))." HIGHLIGHTS", array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			$parent = 0;
			$main_segments= $this->RdData_model->get_rd_segments($report_id, $parent);
			$num = 2;
			/* Main segments */
			foreach($main_segments as $segments)
			{
				$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$num++;

				if($Volume_unit)
				{
					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$num++;
				}
				/* --- sub segments --- */
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);	
				foreach($sub_segments as $subsegments)
				{
					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments->name))." MARKET BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$num++;

					if($Volume_unit)
					{
						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments->name))." MARKET BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$num++;
					}
					/* --- child segment--- */
					$child_segments = $this->RdData_model->get_rd_segments($report_id, $subsegments->id);
					if($child_segments){
						foreach($child_segments as $childsegments)
						{
							$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($scope_name." ".$childsegments->name))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
							$num++;
							if($Volume_unit)
							{
								$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($scope_name." ".$childsegments->name))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$num++;
							}
						}
					}
					/* /. --- child segment--- */
				}
				/* /. --- sub segment--- */
			}
			/* /. Main Segments */
			/* Region */
			$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			$num++;

			if($Volume_unit)
			{
				$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$num++;
			}

			/* Country */
			$get_scope_regions = $this->RdData_model->get_scope_regions($scope_id); 
			foreach($get_scope_regions as $scope_region)
			{
				$ScRegion[] = $scope_region->name;				
				$ScRegionId[] = $scope_region->id;				
			}
			if($ScRegion != NULL) {
                $j= count($ScRegion);
    			for($i = 0; $i < $j ; $i++)
    			{
    				foreach($main_segments as $segments)
    				{
    					$mainseg = $segments->name;
    					$region_fix = ltrim(rtrim($ScRegion[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'"));
    					$region_report_title = ltrim(rtrim($ScRegion[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
    					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_report_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$num++;
    
    					if($Volume_unit)
    					{
    						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_report_title))." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$num++;
    					}
    				}
    				/* for sub region & country */
				/* Scope Global Only */
				if($scope_name == 'Global'){
    				if($ScRegion[$i] == "RoW")
    				{
    					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_fix)).', BY SUB-REGION'." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$num++;
    					if($Volume_unit)
    					{
    						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_fix)).', BY SUB-REGION'." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$num++;
    					}
    					/* Sub regions */
    					$get_scope_country1 = $this->RdData_model->get_scope_regions($ScRegionId[$i]); 
    					foreach($get_scope_country1 as $Reg_c1)
    					{
    						$Regcntry1[] = $Reg_c1->name;				
    						$Regcntryid1[] = $Reg_c1->id;	
    					}
    					if($Regcntry1 != NULL){
        					$ctry1 = count($Regcntry1);
        					for($r = 0; $r < $ctry1; $r++)
        					{
        						$parent = 0;
        						$main_segments_data = $this->RdData_model->get_rd_segments($report_id, $parent);
        						foreach($main_segments_data as $segments)
        						{
        							$mainseg = $segments->name;
        							$country_report_title = ltrim(rtrim($Regcntry1[$r])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
        							
        							$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_report_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
        							$num++;
        						}
        					}			
        					unset($Regcntry1);
    					}
    				} else {
    					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_fix)).', BY COUNTRY'." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$num++;
    					if($Volume_unit)
    					{
    						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($region_fix)).', BY COUNTRY'." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$num++;
    					}
    					/* Sub regions */
    					$get_scope_country1 = $this->RdData_model->get_scope_regions($ScRegionId[$i]); 
    					foreach($get_scope_country1 as $Reg_c1)
    					{
    						$Regcntry1[] = $Reg_c1->name;				
    						$Regcntryid1[] = $Reg_c1->id;	
    					}
    					if($Regcntry1 != NULL){
        					$ctry1 = count($Regcntry1);
        					for($r = 0; $r < $ctry1; $r++)
        					{
        						$parent = 0;
        						$main_segments_data = $this->RdData_model->get_rd_segments($report_id, $parent);
        						foreach($main_segments_data as $segments)
        						{
        							$mainseg = $segments->name;
        							$country_report_title = ltrim(rtrim($Regcntry1[$r])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
        							
        							$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_report_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
        							$num++;
        						}
        					}			
        					unset($Regcntry1);	
    					}
    				}
				}/* /. Scope Global Only */
    			}
    		}
			$section->addPageBreak();
			/* *************** /. List of Tables Only for value ********************** */

			/* *************** List of Figures ********************** */
			$section->addText('List of Figures', 'Style1', 'ParaStyle1');
			$section->addTextBreak(1);
			$figure1="FIGURE 1   ".htmlspecialchars(strtoupper($report_name))." SEGMENTATION";
			$section->addText(htmlspecialchars($figure1), array('align'=>'center','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			$figure2="FIGURE 2   RESEARCH APPROACHES - BOTTOM UP \n\n";
			$section->addText(htmlspecialchars($figure2), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure3="FIGURE 3   RESEARCH APPROACHES - TOP-DOWN  \n\n";
			$section->addText(htmlspecialchars($figure3), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure4="FIGURE 4   IGR - RESEARCH METHOD AND DATA TRIANGULATION  \n\n";
			$section->addText(htmlspecialchars($figure4), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			if($Volume_unit){
				$figure5="FIGURE 5   ".htmlspecialchars(strtoupper($Report_title_scope)).", ".$market_period." (USD ".htmlspecialchars(strtoupper($Value_unit)).", ".htmlspecialchars(strtoupper($Volume_unit)).") \n";
			}else{
				$figure5="FIGURE 5   ".htmlspecialchars(strtoupper($Report_title_scope)).", ".$market_period." (USD ".htmlspecialchars(strtoupper($Value_unit)).") \n";
			}
			$section->addText(htmlspecialchars($figure5), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure6="FIGURE 6   ".htmlspecialchars(strtoupper($Report_title_scope)).", CAGR (USD ".htmlspecialchars(strtoupper($Value_unit)).") GROWTH BY ".strtoupper($scope_type)." (".$forecast_from." - ".$forecast_to.")";
			$section->addText(htmlspecialchars($figure6), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure7="FIGURE 7   DRIVERS OF ".htmlspecialchars(strtoupper($Report_title_scope)).", IMPACT ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure7), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure8="FIGURE 8   RESTRAINTS OF ".htmlspecialchars(strtoupper($Report_title_scope)).", IMPACT ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure8), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure9="FIGURE 9   PORTER"."'"."S FIVE FORCES ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure9), array('align'=>'center','name'=>'Franklin Gothic Medium','color'=>'#78777C', 'size'=>10));
			$figure10="FIGURE 10   IGR- GROWTH MATRIX ANALYSIS";
			$section->addText(htmlspecialchars($figure10), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$number = 11;
			/* Segments */
			foreach($main_segments as $segments)
			{
				$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$Base_year." - ".$forecast_to." (REVENUE % SHARE)", array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$number++;					
				if($Volume_unit) {
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
				} else {
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
				}
				/* --- sub segment---- */
				$sub_segments= $this->RdData_model->get_rd_segments($report_id, $segments->id);	
				foreach($sub_segments as $subsegments)
				{
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments->name))." MARKET BY ".strtoupper($scope_type).", ".$Base_year." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
					if($Volume_unit)
					{
						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments->name))." MARKET BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$number++;
					}
					/* --- child segment---- */
					$child_segments = $this->RdData_model->get_rd_segments($report_id, $subsegments->id);	
					if($child_segments){
						foreach($child_segments as $childsegments)
						{
							$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($scope_name." ".$childsegments->name))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments->name))." BY ".strtoupper($scope_type).", ".$Base_year." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
							$number++;
							if($Volume_unit)
							{
								$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($scope_name." ".$subsegments->name))." MARKET FOR ".htmlspecialchars(strtoupper($childsegments->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$number++;
							}
						}	
					}	
					/* --- /. child segment---- */			
				}
				/* --- /. sub segment---- */
			}
			/* /. Segments */
			/* Regions */
			$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".strtoupper($scope_type).", ".$Base_year." - ".$forecast_to." (REVENUE % SHARE)", array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));			
			$number++;
			if($Volume_unit){
				$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$number++;
			}else{
				$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($Report_title_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$number++;
			}
			$Scope_Region;
			$get_scope_regions= $this->RdData_model->get_scope_regions($scope_id);            
            foreach($get_scope_regions as $scope_region)
			{
				$ScReg1[] = $scope_region->name;				
				$ScRegId1[] = $scope_region->id;				
			}
			if($ScReg1 != NULL){
                $j= count($ScReg1);
    			for($i = 0; $i < $j ; $i++)
    			{
    				$Scope_Region .= ltrim(rtrim($ScReg1[$i]))." ";
    				foreach($main_segments as $segments)
    				{
    					$mainseg = $segments->name;
    					$region_fix = ltrim(rtrim($ScReg1[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'"));
    					$region_report_title = ltrim(rtrim($ScReg1[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
    					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_report_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$number++;
    					if($Volume_unit)
    					{
    						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_report_title))." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$number++;
    					}
    				}
				/* Scope Global Only */
				if($scope_name == 'Global'){
    				if($ScReg1[$i] == "RoW")
    				{
    					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_fix)).', BY SUB-REGION '.$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$number++;
    					if($Volume_unit)
    					{
    						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_fix)).', BY SUB-REGION '.$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$number++;
    					}
    					/* Sub regions */
    					$get_scope_country2 = $this->RdData_model->get_scope_regions($ScRegId1[$i]); 
    					foreach($get_scope_country2 as $Reg_c2)
    					{
    						$Regcntry2[] = $Reg_c2->name;				
    						$Regcntryid2[] = $Reg_c2->id;	
    					}
    					if($Regcntry2 != NULL){
        					$ctry = count($Regcntry2);
        					for($r = 0; $r < $ctry; $r++)
        					{
        						$parent = 0;
        						$main_segments_Data = $this->RdData_model->get_rd_segments($report_id, $parent);
        						foreach($main_segments_Data as $segments)
        						{
        							$mainseg = $segments->name;
        							$country_report_title = ltrim(rtrim($Regcntry2[$r])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
        							
        							$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($country_report_title)).' '.$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
        							$number++;
        						}
        					}			
        					unset($Regcntry2);
    					}
    				} else {
    					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_fix)).', BY COUNTRY '.$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    					$number++;
    					if($Volume_unit)
    					{
    						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($region_fix)).', BY COUNTRY '.$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
    						$number++;
    					}
    					/* Sub regions */
    					$get_scope_country2 = $this->RdData_model->get_scope_regions($ScRegId1[$i]); 
    					foreach($get_scope_country2 as $Reg_c2)
    					{
    						$Regcntry2[] = $Reg_c2->name;				
    						$Regcntryid2[] = $Reg_c2->id;	
    					}
    					if($Regcntry2 != NULL){
        					$ctry = count($Regcntry2);
        					for($r = 0; $r < $ctry; $r++)
        					{
        						$parent = 0;
        						$main_segments_Data = $this->RdData_model->get_rd_segments($report_id, $parent);
        						foreach($main_segments_Data as $segments)
        						{
        							$mainseg = $segments->name;
        							$country_report_title = ltrim(rtrim($Regcntry2[$r])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg)));
        							
        							$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($country_report_title)).' '.$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
        							$number++;
        						}
        					}			
        					unset($Regcntry2);
    					}
    				}
				}/* /. Scope Global Only */											
    			}
			}
			/* /. Regions */
			/* -------------note style------------- */
			$PHPWord->addParagraphStyle('noteStyle', array('align'=>'left', 'spacing'=>0, 'spaceBefore' => 120, 'spaceAfter' =>0));
			$PHPWord->addFontStyle('noteFont', array('align'=>'left', 'size'=>10.5,'name'=>'Franklin Gothic Medium', 'color'=>'red', 'underline' => 'single'));
			/* -------------note style------------- */
			$section->addText('Note: The list of figures in the sample is for reference only and limited, the full list of figures is given in the complete report.', 'noteFont', 'noteStyle');
			$section->addPageBreak();
			/* *************** /. List of Figures ********************** */

			/* ************************ Report Description Writing *********************** */
			/* ------------------- Chapter Heading Style ----------------------------- */
			$PHPWord->addParagraphStyle('Main Heading', array('align'=>'left', 'spacing' => 25, 'spaceBefore' => 240, 'spaceAfter'=>240, 'indentation' => array('left' => 60, 'right' => 60, 'hanging' => 544), 'name'=>'Franklin Gothic Medium','color'=>'#E59C24','size'=>16));
			$PHPWord->addFontStyle('chaptHeading', array('align'=>'Left','bold'=>false,'name'=>'Franklin Gothic Medium','color'=>'#E59C24','size'=>16));
			/* ------------------- Chapter Heading Style ----------------------------- */
			
			/* ------------------- Subpoint Heading Style ----------------------------- */
			$PHPWord->addParagraphStyle('Head 1', array('align'=>'left', 'spacing' => 48, 'spaceBefore' => 160, 'spaceAfter'=>160, 'indentation' => array('left' => 0, 'right' => 60, 'hanging' => 544)));
			$PHPWord->addFontStyle('subPoint', array('align'=>'Left','color'=>'#78777C','bold'=>false,'name'=>'Franklin Gothic Medium','size'=>13));
			/* ------------------- Subpoint Heading Style ----------------------------- */
			
			/* ------------------- Childpoint Heading Style ----------------------------- */
			$PHPWord->addParagraphStyle('Head 2', array('align'=>'left', 'spacing' => 0, 'spaceBefore' => 200, 'spaceAfter'=>160, 'indentation' => array('left' => 0, 'right' => 60, 'hanging' => 544)));
			$PHPWord->addFontStyle('childPoint', array('align'=>'Left','name'=>'Franklin Gothic Medium','size'=>11,'color'=>'#78777C'));
			/* ------------------- Childpoint Heading Style ----------------------------- */
			
			/* ------------------- childSubpoint Heading Style ----------------------------- */
			$PHPWord->addParagraphStyle('Head 3', array('align'=>'left', 'spacing' => 48, 'spaceBefore' => 20, 'spaceAfter'=>160, 'indentation' => array('left' => 60, 'right' => 60, 'hanging' => 360)));
			$PHPWord->addFontStyle('childSubpoint', array('align'=>'Left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			/* ------------------- childSubpoint Heading Style ----------------------------- */
			
			/* ------------------- Description Style ----------------------------- */
			$PHPWord->addParagraphStyle('paragraphStyle', array('spacing' => 120, 'lineHeight' => 1.5, 'align'=>'both', 'spaceBefore' => 120, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('r2Style', array('bold'=>false, 'italic'=>false, 'align' => 'both', 'size'=>10.5, 'name'=>'Franklin Gothic Medium'));
			/* ------------------- Description Style ----------------------------- */
			
			/* ------------------- Figure Name Style ----------------------------- */
			$PHPWord->addParagraphStyle('Figure _ Title', array('align'=>'left', 'spacing' => 48, 'spaceBefore' =>0, 'spaceAfter'=>120));
			$PHPWord->addFontStyle('figureNameStyle', array('align'=>'Left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			/* ------------------- Figure Name Style ----------------------------- */
			
			/* ------------------- Table Name Style ----------------------------- */
			$PHPWord->addParagraphStyle('Table_Title', array('align'=>'left', 'spacing' => 48, 'spaceBefore' =>0, 'spaceAfter'=>240));
			$PHPWord->addFontStyle('tableNameStyle', array('align'=>'Left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			/* ------------------- Table Name Style ----------------------------- */
			
			$listStyle = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);

			/* Sample Pages Chapter 1 */
			$section->addListItem('Introduction', 0, 'chaptHeading', $listStyle, 'Main Heading');								
			$section->addListItem('Report Description', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($New_sample_description_para1_6), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($New_sample_description_para2_13), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($New_sample_description_para3_2), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1); 			

			$section->addListItem('Segmentation and Research Scope', 2, 'childPoint', $listStyle, 'Head 2');
			/* Segments List */
			$parent = 0;
			$main_segments2= $this->RdData_model->get_rd_segments($report_id, $parent);			
			foreach($main_segments2 as $segments2)
			{
				$listStyleBullet = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED, 'name'=>'Franklin Gothic Medium', 'size' => 10.5, 'color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0);
				$listStyleBulletEmpty = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_EMPTY , 'name'=>'Franklin Gothic Medium', 'size' => 10.5, 'color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0);

				$section->addText('Segmentation based on '.ucwords($segments2->name), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
				/* sub segments */
				$sub_segments2= $this->RdData_model->get_rd_segments($report_id, $segments2->id);	
				foreach($sub_segments2 as $subsegments2)
				{
					$section->addListItem(htmlspecialchars($subsegments2->name), 0, array('align'=>'left', 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5), $listStyleBullet, 'P-Style');
					/* child segments */
					$child_segments2 = $this->RdData_model->get_rd_segments($report_id, $subsegments2->id);			
					if($child_segments2)
					{
						foreach($child_segments2 as $childsegments2)
						{
							$section->addListItem(htmlspecialchars($childsegments2->name), 1, array('align'=>'left', 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5), $listStyleBulletEmpty, 'P-Style');
						}
					}
				}
			}
			$section->addTextBreak(1);
			/* -------------------------- Source style ------------------------------ */
			$PHPWord->addParagraphStyle('sourceStyle', array('align'=>'left', 'spacing' => 0, 'spaceBefore' => 120,'spaceAfter' => 0));
			$PHPWord->addFontStyle('Source Note', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>8,'color'=>'#78777C'));
			/* -------------------------- Source style ------------------------------ */
			/* -------------------------- Description style ------------------------------ */
			/* Adding Table in Word File */
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'left', 'spacing'=>80, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addParagraphStyle('Table1_Left', array('align'=>'left', 'spacing'=>80, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addParagraphStyle('Table Bullet', array('align'=>'left', 'spacing'=>80, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addParagraphStyle('thStyle', array('align'=>'center', 'spacing'=>0, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addFontStyle('trStyle1', array('align'=>'left', 'bold'=>false, 'italic'=>false, 'size'=>9,'name'=>'Franklin Gothic Medium'));
			$PHPWord->addFontStyle('trStyle', array('align'=>'both', 'bold'=>false, 'italic'=>false, 'size'=>9,'name'=>'Franklin Gothic Medium', 'spaceBefore'=>3,'spaceAfter'=>0));
			/* -------------------------- /. Description style ------------------------------ */
			$section->addListItem('Definition, Abbreviations, and Assumptions', 2, 'childPoint', $listStyle, 'Head 2');
    
			// Define cell style arrays
			$styleCell = array('valign'=>'center', 'color' => '#E59C24', 'borderBottomSize'=>2, 'borderTopSize'=>2, 'borderBottomColor'=>'#78777C', 'borderTopColor'=>'#78777C');
			$styleCellColor = array('bgColor'=>'D3D3D3');
			$styleLastCell = array('bgColor'=>'D3D3D3', 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
			$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
			$styleCellFILLED = array('valign'=>'center', 'textBullet'=>PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED);
			// Define font style for first row
			$fontStyle = array('bold'=>false, 'align'=>'both','size'=>9,'name'=>'Franklin Gothic Medium','color'=>'#E59C24');
			// Define table style arrays
			$styleTable = array('borderColor'=>'#78777C', 'cellMargin'=>80);
			$styleFirstRow = array('borderBottomSize'=>6, 'borderBottomColor'=>'#78777C', 'bgColor'=>'ffffff');
			// Add table style
			$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
			// Add table
			$table = $section->addTable('myOwnTableStyle');
			// Add row
			$table->addRow(70);
			// Add cells
			$table->addCell(5500, $styleCell)->addText('Particulars and Abbreviations', $fontStyle, 'thStyle');
			$table->addCell(11000, $styleCell)->addText('Definitions', $fontStyle, 'thStyle');
			// Add more rows / cells
			for($i = 1; $i <= 9; $i++) {
				if($i==1)
				{
					$table->addRow();
					$table->addCell(3000, $styleCellColor)->addText(htmlspecialchars(ucwords($report_title, " \t\r\n\f\v'"))." (Definition)", 'trStyle1', 'pStyle');
					$table->addCell(6500, $styleCellColor)->addText(htmlspecialchars($report_definition), 'trStyle', 'pStyle');
				}
				else if($i==2)
				{
					$table->addRow();
					$table->addCell(3000)->addText("USD", 'trStyle1', 'Table1_Left');
					$table->addCell(6500)->addText("United States Dollar ($)", 'trStyle', 'pStyle');
				}
				else if($i==3)
				{
					$table->addRow();
					$table->addCell(3000, $styleCellColor)->addText("The U.S.", 'trStyle1', 'Table1_Left');
					$table->addCell(6500, $styleCellColor)->addText("United States", 'trStyle', 'pStyle');
				}
				else if($i==4)
				{
					$table->addRow();
					$table->addCell(3000)->addText("APAC", 'trStyle1', 'Table1_Left');
					$table->addCell(6500)->addText("Asia-Pacific", 'trStyle', 'pStyle');
				}
				else if($i==5)
				{
					$table->addRow();
					$table->addCell(3000, $styleCellColor)->addText("RoW", 'trStyle1', 'Table1_Left');
					$table->addCell(6500, $styleCellColor)->addText("Rest of the world", 'trStyle', 'pStyle');
				}
				else if($i==6)
				{
					$table->addRow();
					$table->addCell(3000)->addText("CAGR", 'trStyle1', 'Table1_Left');
					$table->addCell(6500)->addText("Compounded annual growth rate", 'trStyle', 'pStyle');
				}
				else if($i==7)
				{
					$table->addRow();
					$table->addCell(3000, $styleCellColor)->addText("Historic data, base year and forecast period", 'trStyle1', 'Table1_Left');
					$table->addCell(6500, $styleCellColor)->addText("Historic year is considered as ".$analysis_from.", base year ".$Base_year." and the forecast period is considered from ".$forecast_period, 'trStyle', 'pStyle');
				}
				else if($i==8)
				{
					
					$table->addRow();
					$table->addCell(3000)->addText("Assumptions", 'trStyle1', 'Table1_Left');
					$table_cell = $table->addCell(6500);
					$table_cell->addText("The market size of ".htmlspecialchars(strtolower($report_name))." is arrived at considering the regional average prices and pricing trends",'trStyle1', 'Table Bullet');//0 is the list level
					$table_cell->addText("The market sizing is based on the historic data for ".$From_historic." to ".$analysis_from.", the report however presents ".$Base_year." as a base year, and forecast provided is for ".$forecast_from." to ".$forecast_to,'trStyle1', 'Table Bullet');
					$table_cell->addText("Market size represents the demand for ".htmlspecialchars(strtolower($report_name))." in particular year and a particular region/geography",'trStyle1', 'Table Bullet'); 						
				}
				else if($i==9)
				{
					$table->addRow();
					$table->addCell(3000, $styleLastCell)->addText("Geographic coverage by countries", 'trStyle1', 'Table1_Left');
					$table_cell = $table->addCell(6500, $styleLastCell);
					if($scope_name == 'Global'){
					$table_cell->addText("North America: The United States (U.S.), Canada and Mexico",'trStyle1', 'Table Bullet');//0 is the list level
					$table_cell->addText("Europe: Germany, United Kingdom, France and Rest of Europe(covers Italy, Spain, Netherlands and Denmark)",'trStyle1', 'Table Bullet');
					$table_cell->addText("Asia-Pacific: China, India, Japan, Australia and Rest of APAC covers Singapore, Thailand, Indonesia and South Korea",'trStyle1', 'Table Bullet');
					$table_cell->addText("RoW: Latin America, Middle East and Africa, Africa covers South Africa",'trStyle1', 'Table Bullet');						
					} else {
						$get_scope_countries = $this->RdData_model->get_scope_regions($scope_id); 
						// var_dump($get_scope_countries); die;
    					foreach($get_scope_countries as $scope_countries)
    					{    						
							$table_cell->addText($scope_countries->name, 'trStyle1', 'Table Bullet');
    					}
					}
				}
				else
				{
					$table->addRow();
					$table->addCell(3000)->addText("Cell $i", 'trStyle1', 'pStyle');
					$table->addCell(6500)->addText("Cell $i", 'trStyle', 'pStyle');
				}
			}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addListItem('Research Methodology', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addListItem('Methodology', 2, 'childPoint', $listStyle, 'Head 2');
			$section->addText(htmlspecialchars($research_methodology), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$figure2 ="	Research Methodology: An Outline";
			$section->addListItem(htmlspecialchars($figure2), 2, 'childPoint', $listStyle, 'Head 2');
			$section->addImage('images/research_methodology_outline.png', array('width'=>520, 'height'=>320, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/* Updated format points */
			$section->addListItem(htmlspecialchars('	Primary Research:'), 3, 'childSubpoint', $listStyle, 'Head 3');
			$primary_research_para1 = explode('\n', $primary_research_para);
			foreach($primary_research_para1 as $primary_research_para1_1) 
			{
				$section->addText(htmlspecialchars($primary_research_para1_1), 'r2Style', 'paragraphStyle');
			}
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Primary Sources considered during this particular study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));	
			$primary_research_source_points2 = explode('\n', $primary_research_source_points1);
			foreach($primary_research_source_points2 as $source_points) 
			{
				$section->addText(htmlspecialchars($source_points), 'r2Style', 'Bullet');
			}
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Data Points received through primary research during the course of study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));	
			$primary_research_data_points1 = explode('\n', $primary_research_data_points);
			foreach($primary_research_data_points1 as $data_points) 
			{
				$section->addText(htmlspecialchars($data_points), 'r2Style', 'Bullet');
			}
			$section->addText(htmlspecialchars('Breakdown of the profiles of primaries as follows:'), array('align'=>'left', 'bold'=>false, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$section->addImage('images/primaries_breakdown.png', array('width'=>770, 'height'=>230, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addText(htmlspecialchars('Primary interviews not only help in data validation but also provide critical insights into the market, current business scenario, and future expectations and enhance the quality of our reports. In addition to analyzing the current and historical trends, our analysts predict where the market is headed, over the next five years.'), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Primary Sources considered during this particular study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$section->addImage('images/primary_sources.png', array('width'=>640, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addListItem(htmlspecialchars('	Secondary Research:'), 3, 'childSubpoint', $listStyle, 'Head 3');
			$secondary_research_para2 = explode('\n', $secondary_research_para1);
			foreach($secondary_research_para2 as $secondary_research_para2_1) 
			{
				$section->addText(htmlspecialchars($secondary_research_para2_1), 'r2Style', 'paragraphStyle');
			}
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('The secondary sources of the data typically include'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$secondary_research_source_points1 = explode('\n', $secondary_research_source_points);
			foreach($secondary_research_source_points1 as $source_points2) 
			{
				$section->addText(htmlspecialchars($source_points2), 'r2Style', 'Bullet');
			}
			$section->addTextBreak(1);
			/* /. Updated format points */
			$section->addListItem('Research Approaches', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars('RESEARCH APPROACHES - BOTTOM UP'), 'figureNameStyle', 'Figure _ Title');							
			$section->addImage('images/research_approaches_bottom_up.png', array('width'=>520, 'height'=>320, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('RESEARCH APPROACHES - TOP-DOWN'), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/research_approaches_top_down.png', array('width'=>520, 'height'=>320, 'align'=>'center')); 
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($Get_research_approaches_para1_6), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($Get_research_approaches_para2_3), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('IGR - RESEARCH METHOD AND DATA TRIANGULATION'), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/research_method_and_data_triangulation.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($Get_research_approaches_para3_3), 'r2Style', 'paragraphStyle');
			$section->addPageBreak();
			/* /. Sample Pages Chapter 1 */

			/* Sample Pages Chapter 2 */
			$section->addListItem('Executive Summary', 0, 'chaptHeading', $listStyle, 'Main Heading');
			$section->addListItem(htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'"))." Highlights, (USD ".htmlspecialchars($Value_unit).")",1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($Get_executive_summary_para1_5), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$table2 = htmlspecialchars(strtoupper($Report_title_scope))." HIGHLIGHTS";
			$section->addText(htmlspecialchars($table2), 'tableNameStyle', 'Table_Title');

			/* Adding Table in Word File */				
			$PHPWord->addParagraphStyle('pStyle', array('align'=>'Left', 'spacing'=>72, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addParagraphStyle('Table1_Left', array('align'=>'Left', 'spacing'=>72, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addParagraphStyle('Table Bullet', array('align'=>'Left', 'spacing'=>72, 'spaceBefore' => 60, 'spaceAfter' =>60));
			$PHPWord->addFontStyle('trStyle1', array('align'=>'left', 'bold'=>false, 'italic'=>false, 'size'=>9,'name'=>'Franklin Gothic Medium'));
			$PHPWord->addParagraphStyle('thStyle', array('align'=>'center', 'spacing'=>0, 'spaceBefore' => 60, 'spaceAfter' =>60));
			// Define table style arrays
			// Add table
			$table = $section->addTable('myOwnTableStyle');
			// Add row
			$table->addRow(70);
			// Add cells
			$table->addCell(5500, $styleCell)->addText('Parameter', $fontStyle, 'thStyle');
			$table->addCell(5500, $styleCell)->addText($Base_year, $fontStyle, 'thStyle');
			$table->addCell(5500, $styleCell)->addText($forecast_to, $fontStyle, 'thStyle');
			
			$a1=array("1", "2", "5");
			$a2=array($conunt);
			$stack=array_merge($a1,$a2);
			// print_r($stack);
			if($stack != NULL){
    			$flag=0;
    			$n = 0;
    			for($i = 1; $i <= count($stack); $i++) {
    				$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    				$styleCellColor = array('bgColor'=>$bg_color);
    				if($i==1)
    				{
    					$table->addRow();
    					$table->addCell(3500, $styleCellColor)->addText(htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'")), 'trStyle1', 'Table1_Left');
    					$table->addCell(3500, $styleCellColor)->addText("Value: USD X.X ".htmlspecialchars(strtolower($Value_unit)), 'trStyle1', 'pStyle');
    					$table->addCell(3500, $styleCellColor)->addText("Value: USD X.X ".htmlspecialchars(strtolower($Value_unit)), 'trStyle1', 'pStyle');
    					$n++;
    					continue;					
    				} 
    				else if($i==2) 
    				{
    					$table->addRow();
    					$table->addCell(3500, $styleCellColor)->addText("CAGR (".$forecast_period.")",'trStyle1', 'Table1_Left');
    					if($Volume_unit){
    						$table_cell = $table->addCell(3500);
    						$table_cell->addText("Value: ".$value_cagr, 'trStyle1', 'pStyle');
    						$table_cell->addText("Volume:".$volume_based_cagr, 'trStyle1', 'pStyle');
    					}else{
    						$table->addCell(3500, $styleCellColor)->addText("Value: ".$value_cagr, 'trStyle1', 'pStyle');
    					}
    					$table->addCell(3500, $styleCellColor)->addText("", 'trStyle1', 'pStyle');
    					$n++;
    					continue;
    				}
    				else if( $i != count($stack) )  //beore last and next of 2 nad 3rd 
    				{						
    					if($flag==0)
    					{	
    						$n = 0;
    						$parent = 0;
    						$main_segments3 = $this->RdData_model->get_rd_segments($report_id, $parent);
    						foreach($main_segments3 as $segments3)
    						{
    							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    							$styleCellColor = array('bgColor'=>$bg_color);
    							$mainseg3 = $segments3->name;
    							$table->addRow();
    							$table->addCell(3500, $styleCellColor)->addText(htmlspecialchars(ucwords($report_title, " \t\r\n\f\v'"))." by ".htmlspecialchars($mainseg3)." Value (USD ".$Value_unit.")",'trStyle1', 'Table1_Left');
    							$table_cell = $table->addCell(3500, $styleCellColor);
    							$text="";
    							$x=1;
    							$sub_segments3 = $this->RdData_model->get_rd_segments($report_id, $segments3->id);	
    							foreach($sub_segments3 as $subsegments3)
    							{
    								$sub_segment3 = htmlspecialchars($subsegments3->name);
    								$text= $sub_segment3.": xx ";									
    								$table_cell->addText($text, 'trStyle1', 'Table Bullet');
    								$x++;
    							}	
    							$table_cell = $table->addCell(3500, $styleCellColor);	
    							$text="";
    							$x=1;
    							$sub_segments4 = $this->RdData_model->get_rd_segments($report_id, $segments3->id);	
    							foreach($sub_segments4 as $subsegments4)
    							{
    								$sub_segment4 = htmlspecialchars($subsegments4->name);
    								$text= $sub_segment4.": xx ";									
    								$table_cell->addText($text, 'trStyle1', 'Table Bullet');
    								$x++;
    							}
    							$n++;
    						}
    					}
    					continue;
    				}
    				else if( $i == count($stack ) ) // Last Element
    				{
    					$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    					$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
    					$table->addRow();
    					$table_cell = $table->addCell(3500, $styleLastCell);
						$table_cell->addText(htmlspecialchars(ucwords($Report_title_scope))." by ".$scope_type." (USD ".htmlspecialchars($Value_unit).")", 'trStyle1', 'pStyle');
    					$table_cell = $table->addCell(3500, $styleLastCell);
						$get_scope_countries = $this->RdData_model->get_scope_regions($scope_id); 
						// var_dump($get_scope_countries); die;
    					foreach($get_scope_countries as $scope_countries)
    					{    						
							$table_cell->addText($scope_countries->name.": xx", 'trStyle1', 'Table Bullet');
    					}
    					/* $table_cell->addText("North America: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("Europe: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("Asia-Pacific: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("RoW: xx", 'trStyle1', 'Table Bullet'); */
    					$table_cell = $table->addCell(3500, $styleLastCell);
						foreach($get_scope_countries as $scope_countries)
    					{    						
							$table_cell->addText($scope_countries->name.": xx", 'trStyle1', 'Table Bullet');
    					}
    					/* $table_cell->addText("North America: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("Europe: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("Asia-Pacific: xx", 'trStyle1', 'Table Bullet');
    					$table_cell->addText("RoW: xx", 'trStyle1', 'Table Bullet'); */					
    					$n++;
    					continue;
    				}				
    			}
    		}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/************** Company Profile ****************************/
			$cmp_profile_para="The report provides profiles of the companies in the ".$scope_name.' '.strtolower($report_name)." such as, ";
			$rd_companies = $this->RdData_model->get_rd_companies($report_id);
			
			foreach($rd_companies as $company)
			{
				$cmpProfile2[]=$company->name;		
			}
			if($cmpProfile2 != NULL){
    			$j= count($cmpProfile2);				
    			for($i = 0; $i< $j ; $i++)
    			{
    				if($i == $j-2)
    				{
    					$cmp_profile_para .= ltrim(rtrim($cmpProfile2[$i]))." and ";
    				}
    				if($i == $j-1)
    				{
    					$cmp_profile_para .= ltrim(rtrim($cmpProfile2[$i])).". ";
    				}
    				if($i < $j-2)
    				{
    					$cmp_profile_para .= ltrim(rtrim($cmpProfile2[$i])).", ";
    				}					
    			}
			}
			// unset($cmp_profile);
			$company_profile_para = $cmp_profile_para;
			/************** Company Profile ****************************/
			$section->addText(htmlspecialchars($company_profile_para), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addListItem(htmlspecialchars(ucwords($Report_title_scope, " \t\r\n\f\v'"))." Projection", 1, 'subPoint', $listStyle, 'Head 1');
			$figure6 = htmlspecialchars(strtoupper($Report_title_scope)).", ".htmlspecialchars($market_period)." (USD ".htmlspecialchars(strtoupper($Value_unit)).")";
			$section->addText(htmlspecialchars($figure6), 'figureNameStyle', 'Figure _ Title');
			$section->addTextBreak(1);
			if($forecast_period == '2021-2027')
			{
				if($Volume_unit){
					$section->addImage('images/market_projection_2019_2027_volume.png', array('width'=>760, 'height'=>240, 'align'=>'center'));					
				} else {
					$section->addImage('images/market_projection_2019_2027_value.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			} 
			else if($forecast_period == '2022-2028')
			{
				if($Volume_unit){
					$section->addImage('images/market_projection_2020_2028_volume.png', array('width'=>760, 'height'=>240, 'align'=>'center'));					
				} else {
					$section->addImage('images/market_projection_2020_2028_value.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			} 
			else if($forecast_period == '2023-2029')
			{
				if($Volume_unit){
					$section->addImage('images/market_projection_2021_2029_volume.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				} else {
					$section->addImage('images/market_projection_2021_2029_value.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			}
			else
			{
				if($Volume_unit){
					$section->addImage('images/market_projection_2020_2028_volume.png', array('width'=>760, 'height'=>240, 'align'=>'center'));					
				} else {
					$section->addImage('images/market_projection_2020_2028_value.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			}
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 700, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
			$section->addTextBreak(1);
		if($scope_name == 'Global'){
			$section->addListItem(htmlspecialchars(ucwords($Report_title_scope))." CAGR (USD ".htmlspecialchars(ucwords($Value_unit)).") Growth, By Regions", 1, 'subPoint', $listStyle, 'Head 1');
			$figure7=htmlspecialchars(strtoupper($Report_title_scope)).", CAGR (USD ".htmlspecialchars(strtoupper($Value_unit)).") GROWTH BY REGIONS (".htmlspecialchars($forecast_from)." - ".htmlspecialchars($forecast_to).") \n\n";
			$section->addText(htmlspecialchars($figure7), 'figureNameStyle', 'Figure _ Title');
			$section->addTextBreak(1);
			if($forecast_period == '2021-2027')
			{
				$section->addImage('images/market_growth_by_region_2021_2027.png', array('width'=>520, 'height'=>220, 'align'=>'center'));				
			} 
			else if($forecast_period == '2022-2028')
			{
				$section->addImage('images/market_growth_by_region_2022_2028.png', array('width'=>520, 'height'=>220, 'align'=>'center'));				
			} 
			else if($forecast_period == '2023-2029')
			{
				$section->addImage('images/market_growth_by_region_2023_2029.png', array('width'=>520, 'height'=>220, 'align'=>'center'));
			}
			else
			{
				$section->addText('ADD REGION GROWTH IMAGE', array('font'=>'Franklin Gothic Medium', 'size'=>18, 'align'=>'both'));
			}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 700, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');			
			$section->addTextBreak(1);
			$section->addListItem("Most Lucrative Country Markets, ".$forecast_from, 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars('This data point includes information on most lucrative country markets in '.$forecast_from), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$section->addImage('images/top_10_countries.png', array('width'=>520, 'height'=>320, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addPageBreak();
		}
			/* /. Sample Pages Chapter 2 */

			/* Sample Pages Chapter 3 */
			$section->addListItem(htmlspecialchars('Market Overview & Competitiveness'), 0, 'chaptHeading', $listStyle, 'Main Heading');
			$section->addListItem('Introduction', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars('The introduction includes the overview of the Drivers, Restraint, and opportunities factors included in the report.'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$section->addTextBreak(1);
			$section->addListItem('DRO Analysis', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($dro_analysis_para1_2), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($dro_analysis_para2_2), 'r2Style', 'paragraphStyle');

			/* Drivers */
			$section->addListItem('Drivers', 2, 'childPoint', $listStyle, 'Head 2');
			$dro = 1;
			$type = 'Driver';
			$rd_drivers = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd_drivers as $drivers)
			{
				$driver = $drivers->description;
				$section->addListItem(htmlspecialchars($driver), 3, 'childSubpoint', $listStyle, 'Head 3');					
				$section->addText(htmlspecialchars("Explanation about Factor ".$dro." that drives the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of factor ".$dro." and the analysis for ".$forecast_from." to ".$forecast_to." represent the future impact and trends of factor ".$dro." over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');					
				$dro++;
			}
			$figure8="DRIVERS OF ".htmlspecialchars(strtoupper($report_name_scope)).", IMPACT ANALYSIS";
			$section->addText(htmlspecialchars($figure8), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/drivers_impact_analysis.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/* Restraints */
			$section->addListItem('Restraints', 2, 'childPoint', $listStyle, 'Head 2');				
			$res = 1;
			$type = 'Restraint';
			$rd_restraints = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd_restraints as $restraints)
			{
				$Restraint = $restraints->description;
				$section->addListItem(htmlspecialchars($Restraint), 3, 'childSubpoint', $listStyle, 'Head 3');					
				$section->addText(htmlspecialchars("Explanation about restraining factor ".$res." that restraints the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of restraining factor ".$res." and the analysis for ".$forecast_from." to ".$forecast_to." represent the future impact and trends of restraining factor ".$res." over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');
				$res++;
			}
			$figure9="RESTRAINTS OF ".htmlspecialchars(strtoupper($report_name_scope)).", IMPACT ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure9), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/restraints_impact_analysis.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/* Opportunities */
			$section->addListItem('Opportunities', 2, 'childPoint', $listStyle, 'Head 2');
			$opr = 1;
			$type = 'Opportunity';
			$rd_opportunity = $this->RdData_model->get_rd_dro($report_id, $type);
			foreach($rd_opportunity as $opportunity)
			{
				$Opportunity=$opportunity->description;
				$section->addListItem(htmlspecialchars($Opportunity), 3, 'childSubpoint', $listStyle, 'Head 3');	
				$section->addText(htmlspecialchars("Explanation of opportunity factor ".$opr." that provides an opportunity in the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of restraining factor ".$opr." and the analysis for ".$forecast_from." to ".$forecast_to." represent the future impact and trends of opportunity factor ".$opr." over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');				
				$opr++;
			}
			$section->addTextBreak(1);
			$section->addListItem('Porter'."'".'s Five Forces Analysis', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($porters_five_forces_para), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$figure10="PORTER"."'"."S FIVE FORCES ANALYSIS";
			$section->addText(htmlspecialchars($figure10), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/porters_five_forces.png', array('width'=>520, 'height'=>350, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/* style */
			$PHPWord->addParagraphStyle('Bullet', array('spacing' => 120, 'lineHeight' => 1.5, 'align'=>'both', 'spaceBefore' => 120, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('r2Style', array('bold'=>false, 'italic'=>false, 'align' => 'both', 'size'=>10.5, 'name'=>'Franklin Gothic Medium'));
			/* /. style */				
			$section->addListItem('IGR- Growth Matrix Analysis', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($growth_matrix_analysis_para1), 'r2Style', 'paragraphStyle');
			$textlines = explode('\n', $growth_matrix_analysis_sub_point_data);
			foreach($textlines as $line) 
			{
				$section->addText(htmlspecialchars($line), 'r2Style', 'Bullet');
			}
			$section->addTextBreak(1);
						
			$figure11="IGR-Growth Matrix Analysis";				
			$parent= 0;				
			$indexno= 0;				
			$no = 0;				
			$main_segments4 = $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($main_segments4 as $segments4)
			{
				$mainseg44[] = $segments4->name;	
				/* var_dump($mainseg44[0]); 			
				$mainseg4 = $segments4->name;				
				$igr_growth_matrix_segment_title = htmlspecialchars($figure11). ' by ' .ucwords($mainseg4);					
				$section->addListItem(htmlspecialchars(' '.$igr_growth_matrix_segment_title), 2, 'childPoint', $listStyle, 'Head 2');
				$section->addText('Same as the preceding point. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
				$section->addTextBreak(1); 
				$no++; */
			} 
			$mgs = count($mainseg44);
			if($mainseg44[0]){
				$igr_growth_matrix_segment_title = htmlspecialchars($figure11). ' by ' .ucwords($mainseg44[0]);					
				$section->addListItem(htmlspecialchars(' '.$igr_growth_matrix_segment_title), 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/IGR_growth_matrix_sagment.png', array('width'=>520, 'height'=>320, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			}
			if($mainseg44[1]) {
				for($h=1; $h<$mgs; $h++)
				{
					$igr_growth_matrix_segment_title1 = htmlspecialchars($figure11). ' by ' .ucwords($mainseg44[$h]);					
					$section->addListItem(htmlspecialchars(' '.$igr_growth_matrix_segment_title1), 2, 'childPoint', $listStyle, 'Head 2');
					$section->addText('Same as the preceding point. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
					$section->addTextBreak(1); 
				}
			}
			if($scope_name == "Global") {
				$section->addListItem('IGR-Growth Matrix Analysis by Region', 2, 'childPoint', $listStyle, 'Head 2');
			}else {
			    $section->addListItem('IGR-Growth Matrix Analysis by Country', 2, 'childPoint', $listStyle, 'Head 2');
			}
			$section->addText('Same as the preceding point. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
			$section->addTextBreak(1);
			$section->addListItem(htmlspecialchars('Value Chain Analysis of '.$report_title), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars(strtoupper('VALUE CHAIN ANALYSIS')), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/value_chain_analysis.png', array('width' => 760, 'height' => 260, 'align' => 'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addPageBreak();	
			/* /. Sample Pages Chapter 3 */

			/* Sample Pages Chapter 4 */
			if($scope_name == "Global"){
				$section->addListItem(htmlspecialchars($report_title." Macro Indicator Analysis"), 0, 'chaptHeading', $listStyle, 'Main Heading');
				$section->addText(htmlspecialchars('Macroeconomic indicators are numbers or data readings that depict the state of the economy in a specific nation, area, or industry. Any trader should be aware of macroeconomic indicators because they might have a big impact on market changes. This is why macroeconomic indicators will be used in the majority of fundamental analyses.'), 'r2Style', 'paragraphStyle');
				$section->addPageBreak(1);
			} 			
			/* /. Sample Pages Chapter 4 */

			/* Sample Pages Chapter 5 */		
			/* -------------note style------------- */
			$PHPWord->addParagraphStyle('noteStyle', array('align'=>'left', 'spacing'=>0, 'spaceBefore' => 120, 'spaceAfter' =>0));
			$PHPWord->addFontStyle('noteFontFig', array('align'=>'left', 'size'=>8,'name'=>'Franklin Gothic Medium', 'color'=>'red'));
			$PHPWord->addFontStyle('noteFontSeg', array('align'=>'left', 'size'=>10.5,'name'=>'Franklin Gothic Medium', 'color'=>'red'));
			/* -------------note style------------- */
			$parent = 0;
			$main_segments5 = $this->RdData_model->get_rd_segments($report_id, $parent);
			foreach($main_segments5 as $segments5)
			{
				$new_segment5 = $Report_title_scope.' by '.htmlspecialchars(ucwords($segments5->name, " \t\r\n\f\v'"));	
				$section->addListItem(htmlspecialchars($new_segment5), 0, 'chaptHeading', $listStyle, 'Main Heading');
				$section->addListItem('Overview', 1, 'subPoint', $listStyle, 'Head 1');
			/* Segment Overview */
				$segment_overview = $this->RdData_model->get_rd_segment_overview($report_id, $segments5->id);
				if($segment_overview){
					foreach($segment_overview as $segoverview)
					{
						$section->addText(htmlspecialchars($segoverview->description), 'r2Style', 'paragraphStyle');
						break;
					}
				} else {
					$sub_segments6 = $this->RdData_model->get_rd_segments($report_id, $segments5->id);			
					foreach($sub_segments6 as $sub_segments6_1)
					{
						$sub_seg_name[] = $sub_segments6_1->name;
					}
					if($sub_seg_name != NULL){
    					$sg = count($sub_seg_name);
    					for($i=0; $i<$sg; $i++)
    					{
    						if($i==$sg-2)
    						{
    							$subseglist .=ltrim(rtrim($sub_seg_name[$i])).", and ";
    						}
    						if($i== $sg-1)
    						{
    							$subseglist .= ltrim(rtrim($sub_seg_name[$i])).". ";
    						}
    						if($i<$sg-2)
    						{
    							$subseglist .= ltrim(rtrim($sub_seg_name[$i])).", ";
    						}
    					}
					}
					$subsegmentslist = $subseglist;		
					$section->addText(htmlspecialchars($Report_title_scope.' segmented based on '.$segments5->name.' as '.$subsegmentslist.' Segment 1 lead the '.$segments5->name.' segment and anticipated to dominate in forecast period.'), 'r2Style', 'paragraphStyle');
				}
				$section->addTextBreak(1);
			/* /. Segment Overview */
			/* Pie chart figure */
				$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$Base_year." - ".$forecast_to." (REVENUE % SHARE)", 'figureNameStyle', 'Figure _ Title');
				/* Figure */
				if($forecast_period == '2021-2027'){
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2027-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
				}else if($forecast_period == '2022-2028'){
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2022-2028-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
				}else if($forecast_period == '2023-2029'){
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2023-2029-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
				}else{
					$section->addText('Add image of segment-revenue-share Pie chart', array('size'=>12, 'color'=>'black'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');				
				$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
				$section->addTextBreak(1);
			/* /. Pie chart figure */
			/* Bar chart figure */
				if($Volume_unit) {
					$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
				}else{
					$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
				}
				/* Figure */
				if($forecast_period=='2021-2027') {
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2019-2027-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}else if($forecast_period=='2022-2028') {
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2020-2028-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}else if($forecast_period=='2023-2029')	{
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2027-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
				}else {
					$section->addText('Add image of segment-revenue-share bar chart', array('size'=>12, 'color'=>'black'));
				}
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
				$section->addTextBreak(1);
			/* /. Bar chart figure */
			/* Table Writeup -  Main Segment */
				/* value based table */
				$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
				// Define table style arrays 				
				// Add table
				$table = $section->addTable('myOwnTableStyle');
				// Add row
				$table->addRow(70);
				// Add cells header
				$table->addCell(2500, $styleCell)->addText(htmlspecialchars($segments5->name), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
				$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
				$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
				// Add more rows / cells for sub segment
				$n = 0;
				$sub_segments5 = $this->RdData_model->get_rd_segments($report_id, $segments5->id);	
				foreach($sub_segments5 as $subsegments5)
				{
					$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
					$styleCellColor = array('bgColor'=>$bg_color);
					$table->addRow();
					$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subsegments5->name)), 'trStyle', 'pStyle');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$n++;
				}
					$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
					$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
					$table->addRow();
					$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
				$section->addTextBreak(1);
				/* /. value based table */
				/* Volume Based table */
				if($Volume_unit)
				{
					$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
					// Add table
					$table = $section->addTable('myOwnTableStyle');
					// Add row
					$table->addRow(70);
					$table->addCell(3500, $styleCell)->addText(htmlspecialchars(ucwords($segments5->name)), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
					$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');					
					// Add more rows / cells for sub segment
					$n = 0;
					$sub_segments5_1 = $this->RdData_model->get_rd_segments($report_id, $segments5->id);	
					foreach($sub_segments5_1 as $subsegments5_1)
					{
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleCellColor = array('bgColor'=>$bg_color);
						$table->addRow();
						$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subsegments5_1->name)), 'trStyle', 'pStyle');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');					
						$n++;
					}
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
						$table->addRow();
						$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');					
					$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
					$section->addTextBreak(1);
					$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
					$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
					$section->addTextBreak(1);
				} /* /. Volume Based table */
				/* /. Table Writeup - Main Segment */

				// displaying sub segment data to word file
				$sub_segments5_2 = $this->RdData_model->get_rd_segments($report_id, $segments5->id);	
				/* for checking child segment */
				foreach($sub_segments5_2 as $subsegmentsdata)
				{
					$is_child_segments += $this->RdData_model->get_count_rd_childsegments($report_id, $subsegmentsdata->id);					
				}
				/* /. for checking child segment */

				foreach($sub_segments5_2 as $subsegments5_2)
				{
					$sub_segment5_2 = $subsegments5_2->name;
					$section->addListItem(htmlspecialchars($sub_segment5_2), 1, 'subPoint', $listStyle, 'Head 1');
					$section->addText(htmlspecialchars('This Point Includes '.$sub_segment5_2.' Segment Analysis and Trends.'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
					$section->addTextBreak(1);
					/* adding figure */					
					$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
					$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
					$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
					$section->addTextBreak(1);
					if($Volume_unit)
					{
						$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
						$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
					}/* /. adding figure */	

					/* Table Writeup - Sub Segment */
					/* value based table */
					$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
					// Add table
					$table = $section->addTable('myOwnTableStyle');
					// Add row
					$table->addRow(70);
					// Add cells header
					$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
					$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
					// Add more rows / cells region
					$n =0;
					$get_scope_regions1 = $this->RdData_model->get_scope_regions($scope_id); 
					foreach($get_scope_regions1 as $scope_region1)
					{
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleCellColor = array('bgColor'=>$bg_color);
						$table->addRow();
						$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_region1->name)), 'trStyle', 'pStyle');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$n++;
					}
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
						$table->addRow();
						$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					
					$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
					$section->addTextBreak(1);
					$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
					$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
					$section->addTextBreak(1);
					/* /. value based table */	
					/* volume based table */
					if($Volume_unit)
					{
						$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
						// Add table
						$table = $section->addTable('myOwnTableStyle');
						// Add row
						$table->addRow(70);
						// Add cells header
						$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
						$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
						// Add more rows / cells region
						$n =0;
						$get_scope_regions1 = $this->RdData_model->get_scope_regions($scope_id); 
						foreach($get_scope_regions1 as $scope_region1)
						{
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleCellColor = array('bgColor'=>$bg_color);
							$table->addRow();
							$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_region1->name)), 'trStyle', 'pStyle');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$n++;
						}
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
							$table->addRow();
							$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
						$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
						$section->addTextBreak(1);
					}
					/* /. volume based table */
					/* /. Table Writeup - Sub Segment */
					
					/********* adding child segment *************/
					$child_segments3 = $this->RdData_model->get_rd_segments($report_id, $subsegments5_2->id);
					if($is_child_segments)
					{					    
						foreach($child_segments3 as $childsegments3)
						{
							$child_segment3 = $childsegments3->name;	
							$section->addListItem(htmlspecialchars($child_segment3), 2, 'childPoint', $listStyle, 'Head 2');
							$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
							$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
							$section->addTextBreak(1);
							$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($child_segment3 ))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
							$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addTextBreak(1);
							if($Volume_unit)
							{
								$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($child_segment3))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
								$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
								$section->addTextBreak(1);
							}							
							/* Child Segment - Table Writing started*/	
							/* value based table */							
							$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($child_segment3))." MARKET FOR ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
							// Add table
							$table = $section->addTable('myOwnTableStyle');
							// Add row
							$table->addRow(70);
							// Add cells
							$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
							$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
							// Add more rows / cells
							$n =0;
							$get_scope_regions2 = $this->RdData_model->get_scope_regions($scope_id); 
							foreach($get_scope_regions2 as $scope_regions2)
							{
								$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
								$styleCellColor = array('bgColor'=>$bg_color);
								$table->addRow();
								$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_regions2->name)), 'trStyle', 'pStyle');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$n++;
							}
								$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
								$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
								$table->addRow();
								$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addTextBreak(1);
							$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
							$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
							$section->addTextBreak(1);
							/* /. value based table */
							/* volume based table */
							if($Volume_unit){								
								$section->addText(htmlspecialchars(strtoupper($scope_name))." ".htmlspecialchars(strtoupper($subsegments5_2->name))." FOR ".htmlspecialchars(strtoupper($child_segment3))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
								// Define table style arrays
								$table = $section->addTable('myOwnTableStyle');
								// Add row
								$table->addRow(70);
								// Add cells
								$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
								$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
								// Add more rows / cells
								$n =0;
								$get_scope_regions3 = $this->RdData_model->get_scope_regions($scope_id); 
								foreach($get_scope_regions3 as $scope_regions3)
								{
									$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
									$styleCellColor = array('bgColor'=>$bg_color);
									$table->addRow();
									$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_regions3->name)), 'trStyle', 'pStyle');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$n++;
								}
									$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
									$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
									$table->addRow();
									$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								
								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
								$section->addTextBreak(1);
								$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
								$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
								$section->addTextBreak(1);
							} /* /. volume based table */
							/* /. Child Segment - Table Writing started*/	
						}
					}else{
						break;
					}
					/********* /. adding child segment *************/
				}
				/* main segment sample line */
				if($is_child_segments == NULL){
					$data['sub_segments'] = $this->RdData_model->get_rd_segments($report_id, $segments5->id);	
					$m = 1;		
					foreach($data['sub_segments'] as $sub_segments7)
					{											
						$sub_segment7_3 = $data['sub_segments'][$m];
						if($sub_segment7_3){
							$section->addListItem(htmlspecialchars($sub_segment7_3->name), 1, 'subPoint', $listStyle, 'Head 1');
							$section->addText('Same as the preceding segment. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
							$section->addTextBreak(1);
						}
						$m++;							
					} 
				}
				/* /. main segment sample line */
			}
			$section->addPageBreak(1);
			/* /. Sample Pages Chapter 5 */

		/* Sample Pages Chapter 6 - Region */
			if($scope_name == 'Global'){
				$scope_type = 'Region';
			} else {
				$scope_type = 'Country';
			}
			$section->addListItem(htmlspecialchars(ucwords($report_name_scope, " \t\r\n\f\v'")).', by '.$scope_type, 0, 'chaptHeading', $listStyle, 'Main Heading');
			$section->addListItem("	Overview", 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($report_regional_description), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);			
			$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".strtoupper($scope_type).", ".$Base_year." - ".$forecast_to."(REVENUE % SHARE)", 'figureNameStyle', 'Figure _ Title');
			if($forecast_period == '2021-2027')	{
				$section->addImage('images/sample/xyz-market-by-region-2020-2027-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else if($forecast_period == '2022-2028') {
				$section->addImage('images/sample/xyz-market-by-region-2021-2028-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else if($forecast_period == '2023-2029') {
				$section->addImage('images/sample/xyz-market-by-region-2022-2029-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else {
				$section->addText('add image of xyz-market-by-region-Pie', array('size'=>12, 'color'=>'black'));
			}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
			$section->addTextBreak(1);
			if($Volume_unit)
			{
				$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
			} else {
				$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', 'figureNameStyle', 'Figure _ Title');
			}
			if($forecast_period == '2021-2027')	{
				$section->addImage('images/sample/xyz-market-by-region-2019-2027-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else if($forecast_period == '2022-2028') {
				$section->addImage('images/sample/xyz-market-by-region-2020-2028-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else if($forecast_period == '2023-2029') {
				$section->addImage('images/sample/xyz-market-by-region-2021-2029-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			} else {
				$section->addText('add image of xyz-market-by-region-Pie', array('size'=>12, 'color'=>'black'));
			}
			/* value based table */
			$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
			// Define table style arrays
			$table = $section->addTable('myOwnTableStyle');
			// Add row
			$table->addRow(70);
			// Add cells
			$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
			$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
			$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
			// Add more rows / cells
			$n =0;
			$get_scope_regions4= $this->RdData_model->get_scope_regions($scope_id);            
            foreach($get_scope_regions4 as $scope_region4)
			{
				$scoperegion4[] = $scope_region4->name;	
				$scoperegion4id[] = $scope_region4->id;	

				$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
				$styleCellColor = array('bgColor'=>$bg_color);
				$table->addRow();
				$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_region4->name)), 'trStyle', 'pStyle');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$n++;
			}
				$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
				$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
				$table->addRow();
				$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
				
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
			$section->addTextBreak(1);
			/* /. value based table */
			/* volume based table */
				if($Volume_unit){
					$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".strtoupper($scope_type).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
					// Define table style arrays
					$table = $section->addTable('myOwnTableStyle');
					// Add row
					$table->addRow(70);
					// Add cells
					$table->addCell(2500, $styleCell)->addText($scope_type, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
					$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
					// Add more rows / cells
					$n =0;
					$get_scope_regions5 = $this->RdData_model->get_scope_regions($scope_id); 
					foreach($get_scope_regions5 as $scope_region5)
					{
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleCellColor = array('bgColor'=>$bg_color);
						$table->addRow();
						$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_region5->name)), 'trStyle', 'pStyle');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$n++;
					}
						$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
						$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
						$table->addRow();
						$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						
					$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
					$section->addTextBreak(1);
					$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
					$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
					$section->addTextBreak(1);
				}
			/* /. volume based table */
			/* Scope Region Points */
			if($scoperegion4 != NULL){
				$reg = count($scoperegion4);
				// var_dump($reg); die;
				for($i = 0; $i < $reg ; $i++)
				{					
					$region_name5 .= ltrim(rtrim($scoperegion4[$i]))." ";				
					$section->addListItem(htmlspecialchars($scoperegion4[$i])." ".htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 1, 'subPoint', $listStyle, 'Head 1');
					$parent = 0;
					$main_segments6 = $this->RdData_model->get_rd_segments($report_id, $parent);
					foreach($main_segments6 as $segments6)
					{
						$mainseg6 = $segments6->name;
						$region_report_title1 = ltrim(rtrim($scoperegion4[$i])).' '.htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")).' by '.ltrim(rtrim(ucwords($mainseg6)));
						$section->addListItem(htmlspecialchars($region_report_title1), 2, 'childPoint', $listStyle, 'Head 2');						
						if($Volume_unit){
							$section->addText(htmlspecialchars(strtoupper($region_report_title1))." ".$Base_year." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');

							if($forecast_period =='2021-2027') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2027-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));							
							} else if($forecast_period =='2022-2028') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2022-2028-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));							
							} else if($forecast_period == '2023-2029') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2023-2029-Pie.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
							} else {
								$section->addText('add image of xyz-market-by-segment-revenue-share-Pie', array('size'=>12, 'color'=>'black'));
							}

							$section->addText(htmlspecialchars(strtoupper($region_report_title1))." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');	

							if($forecast_period =='2021-2027') {
								$section->addImage('images/sample/xyz-market-by-region-2019-2027-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));							
							} else if($forecast_period =='2022-2028') {
								$section->addImage('images/sample/xyz-market-by-region-2020-2028-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));							
							} else if($forecast_period == '2023-2029') {
								$section->addImage('images/sample/xyz-market-by-region-2021-2029-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
							} else {
								$section->addText('add image of xyz-market-by-region-2020-2028-Bar', array('size'=>12, 'color'=>'black'));
							}
						
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
							$section->addTextBreak(1);
						} else {
							$section->addText(htmlspecialchars(strtoupper($region_report_title1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');

							if($forecast_period =='2021-2027') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2019-2027-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
							} else if($forecast_period =='2022-2028') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2020-2028-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
							} else if($forecast_period == '2023-2029') {
								$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2029-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
							} else {
								$section->addText('add image of xyz-market-by-segment-revenue-share-Bar', array('size'=>12, 'color'=>'black'));
							}
						
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
							$section->addTextBreak(1);
						}
						$section->addText(htmlspecialchars(strtoupper($region_report_title1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(ucwords($Value_unit)).')', 'tableNameStyle', 'Table_Title');
						// Define table style arrays
						$table = $section->addTable('myOwnTableStyle');
						// Add row
						$table->addRow(70);
						// Add cells
						$table->addCell(2500, $styleCell)->addText(htmlspecialchars(ucwords($segments6->name)), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
						$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
						// Add more rows / cells
						$n =0;
						$sub_segments8 = $this->RdData_model->get_rd_segments($report_id, $segments6->id);			
						foreach($sub_segments8 as $subsegments8)
						{
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleCellColor = array('bgColor'=>$bg_color);
							$table->addRow();
							$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subsegments8->name)), 'trStyle', 'pStyle');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$n++;
						}
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
							$table->addRow();
							$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');						
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
						$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
						$section->addTextBreak(1);
					}
					
					// Country Figure AND Tables Writing for Regional chapter
				if($scope_name == 'Global'){
					if($scoperegion4[$i] == "RoW")
					{
						$region_name1 = ltrim(rtrim($scoperegion4[$i])).' '.ltrim(rtrim(ucwords($report_name))).', by Sub-region';
						$section->addListItem(htmlspecialchars($region_name1), 2, 'childPoint', $listStyle, 'Head 2');						
						$section->addText(htmlspecialchars(strtoupper($region_name1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');

						if($forecast_period =='2021-2027') {
							$section->addImage('images/sample/xyz-market-by-region-2019-2027-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center')); 
						} else if($forecast_period =='2022-2028') {
							$section->addImage('images/sample/xyz-market-by-region-2020-2028-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
						} else if($forecast_period == '2023-2029') {
							$section->addImage('images/sample/xyz-market-by-region-2021-2029-Bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
						} else {
							$section->addText('Add xyz-market-by-region Bar chart image', array('size'=>12, 'color'=>'black'));
						}
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						$section->addText(htmlspecialchars(strtoupper($region_name1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(ucwords($Value_unit)).')', 'tableNameStyle', 'Table_Title');
						// Define table style arrays
						$table = $section->addTable('myOwnTableStyle');
						// Add row
						$table->addRow(70);
						// Add cells
						$table->addCell(2500, $styleCell)->addText('Sub-region', $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
						$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
						// Add more rows / cells
						$n = 0;
						$get_scope_country4 = $this->RdData_model->get_scope_regions($scoperegion4id[$i]); 
						foreach($get_scope_country4 as $scope_country4)
						{
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleCellColor = array('bgColor'=>$bg_color);
							$table->addRow();
							$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_country4->name)), 'trStyle', 'pStyle');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$n++;
						}
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
							$table->addRow();
							$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle'); 
						$section->addTextBreak(1);
						$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
						$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
						$section->addTextBreak(1);
						if($Volume_unit)
						{
							$section->addText(htmlspecialchars(strtoupper($region_name1))." ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(ucwords($Volume_unit)).')', 'tableNameStyle', 'Table_Title');
						}
					} else { 
						// Start of Country figure and table writing
						$region_name1 = ltrim(rtrim($scoperegion4[$i])).' '.ltrim(rtrim(ucwords($report_name))).', by Country';
						$section->addListItem(htmlspecialchars($region_name1), 2, 'childPoint', $listStyle, 'Head 2');
						$section->addText(htmlspecialchars(strtoupper($region_name1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');

						if($forecast_period =='2021-2027') {
							$section->addImage('images/sample/countries-2019-2027-bar.png', array('width'=>760, 'height'=>280, 'align'=>'center')); 
						} else if($forecast_period =='2022-2028') {
							$section->addImage('images/sample/countries-2020-2028-bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
						} else if($forecast_period == '2023-2029') {
							$section->addImage('images/sample/countries-2021-2029-bar.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
						} else {
							$section->addText('Add xyz-market-by-countries Bar chart image', array('size'=>12, 'color'=>'black'));
						}
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						$section->addText(htmlspecialchars(strtoupper($region_name1))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(ucwords($Value_unit)).')', 'tableNameStyle', 'Table_Title');
						// Define table style arrays
						$table = $section->addTable('myOwnTableStyle');
						// Add row
						$table->addRow(70);
						// Add cells
						$table->addCell(2500, $styleCell)->addText('Country', $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
						$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
						// Add more rows / cells
						$n = 0;
						$get_scope_country4 = $this->RdData_model->get_scope_regions($scoperegion4id[$i]); 
						// var_dump($get_scope_country4);
						foreach($get_scope_country4 as $scope_country4)
						{
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleCellColor = array('bgColor'=>$bg_color);
							$table->addRow();
							$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($scope_country4->name)), 'trStyle', 'pStyle');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$n++;
						}
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
							$table->addRow();
							$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle'); 
						$section->addTextBreak(1);
						$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
						$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
						$section->addTextBreak(1);
						/* Country chapters added here */
						$get_scope_country5 = $this->RdData_model->get_scope_regions($scoperegion4id[$i]);
						foreach($get_scope_country5 as $scope_country5)
						{
							$scopecountryname5[] = $scope_country5->name;				
							$scopecountryid5[] = $scope_country5->id;	
						}
						if($scopecountryname5 != NULL){
    						$x = count($scopecountryname5);
    						for($r = 0; $r < $x ; $r++)
    						{
    							$RegionCountry = ltrim(rtrim($scopecountryname5[$r]))." ";
    							$section->addListItem(htmlspecialchars($scopecountryname5[$r]), 3, 'childPoint', $listStyle, 'Head 2');
    							$parent = 0;
    							$main_segments7 = $this->RdData_model->get_rd_segments($report_id, $parent);
    							foreach($main_segments7 as $segments7)
    							{
    								$country_title=ltrim(rtrim($RegionCountry)).' '.ltrim(rtrim(ucwords($report_name, " \t\r\n\f\v'"))).', by '.ltrim(rtrim(ucwords(strtolower($segments7->name))));
    								$section->addListItem(htmlspecialchars($country_title), 4, 'childPoint', $listStyle, 'Head 3');
    								/* Adding Figures as per value and volume unit */
    								if($Volume_unit)
    								{
    									$section->addText(htmlspecialchars(strtoupper($country_title))." ".$Base_year." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
    									if($forecast_period =='2021-2027')
    									{
    										$section->addImage('images/sample/xyz-market-by-region-2019-2027-Bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									}else if($forecast_period =='2022-2028') {
    										$section->addImage('images/sample/xyz-market-by-region-2020-2028-Bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									}else if($forecast_period =='2023-2029') {
    										$section->addImage('images/sample/xyz-market-by-region-2021-2029-Bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									}
    										$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
    										$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
    										$section->addTextBreak(1);    									
    								}else{
    									$section->addText(htmlspecialchars(strtoupper($country_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
    									if($forecast_period =='2021-2027')
    									{
    										$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2019-2027-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									} else if($forecast_period =='2022-2028') {
    										$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2020-2028-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									} else if($forecast_period =='2023-2029') {
    										$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2029-bar.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
    									}
    										$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
    										$section->addText('*Note: The above image is only for sample representation. The actual image differs from the above sample image.', 'noteFontFig', 'noteStyle');
    										$section->addTextBreak(1);									
    								}
    								/* Adding Table for country points */
    								$section->addText(htmlspecialchars(strtoupper($country_title))." ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(ucwords($Value_unit)).')', 'tableNameStyle', 'Table_Title');
    								// Define table style arrays
    								$table = $section->addTable('myOwnTableStyle');
    								// Add row
    								$table->addRow(70);
    								// Add cells
    								$table->addCell(2500, $styleCell)->addText(htmlspecialchars(ucwords($segments7->name)), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
    								$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
    								$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
    								$n = 0;
    							$sub_segments9 = $this->RdData_model->get_rd_segments($report_id, $segments7->id);
    							foreach($sub_segments9 as $subsegments9)
    							{
    								$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    								$styleCellColor = array('bgColor'=>$bg_color);
    								$table->addRow();
    								$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subsegments9->name)), 'trStyle', 'pStyle');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$n++;
    							}
    								$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    								$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
    								$table->addRow();
    								$table->addCell(2500, $styleLastCell)->addText('Total', 'trStyle', 'pStyle');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
    							
    								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
    								$section->addTextBreak(1);
    								$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
    								$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
    								$section->addTextBreak(1);
    							}
    							break;
    						}
						}
						if($scopecountryname5 != NULL){
    						$x = count($scopecountryname5);
    						for($r = 1; $r < $x ; $r++)
    						{
    							$Country_name= ltrim(rtrim($scopecountryname5[$r]))." ";				
    							$section->addListItem(htmlspecialchars($Country_name), 3, 'childPoint', $listStyle, 'Head 2');
    							$section->addText('		Same as that of the preceding country. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
    							$section->addTextBreak(1);	
    						}
    						unset($scopecountryname5);
						}
					}
				}
					break;
					// unset($Segmetn_Region);
				}
			}
			//	$reg = count($scoperegion4);
			// var_dump($reg); die;
				/* Only region headings */
				for($i = 1; $i < $reg; $i++)
				{
					$Scope_Region = ltrim(rtrim($scoperegion4[$i]))." ";
					$section->addListItem(htmlspecialchars($Scope_Region)."".htmlspecialchars(ucwords($report_name, " \t\r\n\f\v'")), 1, 'subPoint', $listStyle, 'Head 1');
					$section->addText('	Same as that of the preceding region. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
					$section->addTextBreak(1);
				}
				$section->addPageBreak();
			/* /. Scope Region Points */
		/* /. Sample Pages Chapter 6 - Region */

		/* Sample Pages Chapter 7 - Company Profile */
			$section->addListItem('Company Profiles and Competitive Landscape', 0, 'chaptHeading', $listStyle, 'Main Heading');	
			$section->addListItem(htmlspecialchars('Competitive Landscape in the '.$report_title), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($report_compitative_landscape), 'r2Style', 'paragraphStyle');
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
			$section->addListItem(htmlspecialchars('Companies Profiles'), 1, 'subPoint', $listStyle, 'Head 1');	
			$rd_companies=$this->RdData_model->get_rd_companies($report_id);	
			foreach($rd_companies as $companies)
			{
				$cmpProfile=$companies->name;	
				$cmpProfile= ltrim(rtrim(ucwords(strtolower($cmpProfile))))." ";				
				$section->addListItem(htmlspecialchars($cmpProfile), 2, 'childPoint', $listStyle, 'Head 2');				
				$section->addListItem('Overview', 3, 'childSubpoint', $listStyle, 'Head 3');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);					
				$section->addListItem('Company Snapshot', 3, 'childSubpoint', $listStyle, 'Head 3');
				//$section->addImage('images/Company_snapshot.png', array('width'=>700, 'height'=>520, 'align'=>'center'));
				$section->addText('Add Company Snapshot Image of '.htmlspecialchars($cmpProfile), 'subPoint', 'sourceStyle');
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Financial Snapshot', 3, 'childSubpoint', $listStyle, 'Head 3');
				$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Product Portfolio', 3, 'childSubpoint', $listStyle, 'Head 3');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);
				$section->addListItem('Recent Developments', 3, 'childSubpoint', $listStyle, 'Head 3');
				$section->addImage('images/Recent_development_sample.png', array('width'=>760, 'height'=>220, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				break;
			}
			$section->addTextBreak(1);
			$rd['companies']=$this->RdData_model->get_rd_companies($report_id);
			$c = 1;
			foreach($rd['companies'] as $cmpname){
				$company_names = $rd['companies'][$c];
				if($company_names){
					$section->addListItem(htmlspecialchars($company_names->name), 2, 'childPoint', $listStyle, 'Head 2');
				}
				$c++;							
			}
			$section->addText('(N.B.: Names of companies profiled in the report. Final report will contain the details of each company same as that of the above referenced)', 'noteFontSeg', 'noteStyle');	
			$section->addPageBreak();
			$section->addImage('images/our-expertise.jpg', array('width'=>520, 'height'=>600, 'align'=>'center'));
			$section->addPageBreak();				
			$section->addImage('images/infinium_disclaimer.jpg', array('width'=>520, 'height'=>600, 'align'=>'center'));
		/* /. Sample Pages Chapter 6 - Company Profile */
			
		/* ************************ /. Report Description Writing *********************** */

			/* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($Report_title_scope));		
			$new_file_name1=str_replace("/","-", $new_file_name);
			$new_file_name2=str_replace("&amp;","and", $new_file_name1);
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
			$filename = "Sample-".htmlspecialchars($new_file_name2)."-Report.docx";
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