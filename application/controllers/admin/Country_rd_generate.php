<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');

include_once(APPPATH."third_party/PhpWord/Autoloader.php");

use PhpOffice\PhpWord\Autoloader as PHPWord_AutoLoader;
use PhpOffice\PhpWord\PhpWord as PhpWord;
use PhpOffice\PhpWord\IOFactory as PHPWord_IOFactory;

class Country_rd_generate extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Country_model');
		$this->load->model('admin/Data_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	public function index(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$data['report_id']=$id;	
			$data['Country_Rds']= $this->Country_model->get_country_rds();
			$this->load->view('admin/country_rd/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function sample_pages($report_id){        
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $single_rd_data = $this->Country_model->get_single_country_rd_details($report_id);
             /* RD base data extract */
             $report_id = $single_rd_data->id;
             $country_name = $single_rd_data->country;
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
             $revenue_start_year = $single_rd_data->revenue_start_year;
             $revenue_end_year = $single_rd_data->revenue_end_year;
            /* ./ RD base data extract */
            /* get country name */
            // $countries = $this->Country_model->get_country_master_data();			
            // foreach($countries as $country){
            //     if($country->id == $country_id){
            //         $country_name = $country->name;
            //     }
            // }
            /* ./ get country name */
            $report_title_scope = $country_name.' '.$report_title;
            $report_name_scope = $country_name.' '.$report_name;
            
			/* get Rd segments */
			$parent = 0;
			$rd_main_segments= $this->Country_model->get_country_rd_segments($report_id, $parent);
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

            /* Concatenation */
            $forecast_period = $forecast_from.'-'.$forecast_to;
            $market_period = $analysis_from.'-'.$analysis_to;
            $Base_year = $forecast_from - 1;
            $From_historic = $analysis_from - 2;
            /* Concatenation */
            if($USD_value == 0 || $USD_value == ""){
				$USD_value='X.XX';
			}else{
				$USD_value = $USD_value;
			}
			/* revenue */
			if($revenue_start_year == NULL){
				$start_year_revenue = "USD X.X";
			} else {
				$start_year_revenue = $revenue_start_year;
			}
			
			if($revenue_end_year == NULL){
				$end_year_revenue = "USD X.X";
			} else {
				$end_year_revenue = $revenue_end_year;
			}
			/* ./ revenue */
            /* ----------------- get rd market insight data ------------------ */
			$type = "Report Definition";
			$definition = $this->Country_model->get_rd_market_insight($report_id, $type);
			foreach($definition as $rd_definition){
				$report_definition.= $rd_definition->description;
			}	
			$type = "Report Description";
			$report_description = $this->Country_model->get_rd_market_insight($report_id, $type);
            foreach($report_description as $rd_description){
				$report_description_para.= $rd_description->description;
			}
			$Sample_report_description_para1 = $this->Country_model->get_rd2_codedecode_para(8);			
			$Get_sample_page_description_para1 = $Sample_report_description_para1->description;
			$New_sample_description_para1 = str_replace("Report_name_scope",$report_name_scope,$Get_sample_page_description_para1);
			$New_sample_description_para1_1 = str_replace("USD_value",$USD_value,$New_sample_description_para1);
			$New_sample_description_para1_2 = str_replace("Value_unit",strtolower($Value_unit),$New_sample_description_para1_1);
			$New_sample_description_para1_3 = str_replace("base_year",$Base_year,$New_sample_description_para1_2);
			$New_sample_description_para1_4 = str_replace("CAGR_value",$value_cagr,$New_sample_description_para1_3);
			$New_sample_description_para1_5 = str_replace("Forecast_period",$forecast_period,$New_sample_description_para1_4);
			$New_sample_description_para1_6=str_replace("Report_description",$report_description_para,$New_sample_description_para1_5);

			/* Sample - Report Description Para 2 */
			$Sample_report_description_para2 = $this->Country_model->get_rd2_codedecode_para(9);
			$Get_sample_page_description_para2 = $Sample_report_description_para2->description;
			$New_sample_description_para2 = str_replace("Report_name_scope",$report_name_scope,$Get_sample_page_description_para2);
			$New_sample_description_para2_1 = str_replace("Report_title",$report_name_scope,$New_sample_description_para2);
			$New_sample_description_para2_2 = str_replace("From_period",$analysis_from,$New_sample_description_para2_1);
			$New_sample_description_para2_3 = str_replace("To_period",$analysis_to,$New_sample_description_para2_2);
			$New_sample_description_para2_4 = str_replace("base_year",$Base_year,$New_sample_description_para2_3);
			$New_sample_description_para2_5 = str_replace("From_forecast",$forecast_from,$New_sample_description_para2_4);
			$New_sample_description_para2_6 = str_replace("To_forecast",$forecast_to,$New_sample_description_para2_5);
			$New_sample_description_para2_7 = str_replace("Value_unit",$Value_unit,$New_sample_description_para2_6);
			$New_sample_description_para2_8 = str_replace("Segment_name",strtolower($rd_segments_name),$New_sample_description_para2_7);
			$New_sample_description_para2_9 = str_replace("Global_regional_line_only market of ","",$New_sample_description_para2_8);
			// $New_sample_description_para2_10 = str_replace("Scope_type","country",$New_sample_description_para2_9);
			$New_sample_description_para2_11 = str_replace("Region_name",$rd_region_name,$New_sample_description_para2_9);
			$New_sample_description_para2_12 = str_replace("Geographic_area",$geographic,$New_sample_description_para2_11);

			/* Sample - Report Description Para 3 */
			$Sample_report_description_para3 = $this->Country_model->get_rd2_codedecode_para(10);
			$Get_sample_page_description_para3 = $Sample_report_description_para3->description;
			$New_sample_description_para3 = str_replace("Report_title",$report_name_scope,$Get_sample_page_description_para3);
			$New_sample_description_para3_1 = str_replace("Report_name_scope",$report_name_scope,$New_sample_description_para3);
			$New_sample_description_para3_2 = str_replace("Forecast_period",$forecast_period,$New_sample_description_para3_1);
			$New_sample_description_para3_3 = str_replace("Porter’s five forces analysis","PEST analysis and Porter's diamond model analysis",$New_sample_description_para3_2);
			$New_sample_description_para3_4 = str_replace("world",$country_name,$New_sample_description_para3_3);
			// var_dump($New_sample_description_para3_4); die;
			// Report Methodology						
			$Research_methodology = $this->Country_model->get_rd2_codedecode_para(11);
			$Get_research_methodology = $Research_methodology->description;
			$research_methodology = str_replace("Report_name",$report_name_scope,$Get_research_methodology);
						
			/* Sample – Primary Research Para 1 */
			$Get_primary_research_para = $this->Country_model->get_rd2_codedecode_para(21);
			$primary_research_para = $Get_primary_research_para->description;

			/* Sample – Primary Research Sources Points */
			$Get_primary_research_source_points = $this->Country_model->get_rd2_codedecode_para(22);
			$primary_research_source_points = $Get_primary_research_source_points->description;
			$primary_research_source_points1 = str_replace("XYZ Market",$report_name,$primary_research_source_points);

			/* Sample – Primary Research Data Points */
			$Get_primary_research_data_points = $this->Country_model->get_rd2_codedecode_para(23);
			$primary_research_data_points = $Get_primary_research_data_points->description;
			$primary_research_data_points_1 = str_replace("Regional Scenario","",$primary_research_data_points);

			/* Sample – Secondary Research Para 1 */
			$Get_secondary_research_para = $this->Country_model->get_rd2_codedecode_para(24);
			$secondary_research_para = $Get_secondary_research_para->description;
			$secondary_research_para1 = str_replace("Report_name",$report_name_scope,$secondary_research_para);

			/* Sample - Research Approaches */
			$Research_approaches = $this->Country_model->get_rd2_codedecode_para(12);
			$Get_research_approaches_para1 = $Research_approaches->description;
			$Get_research_approaches_para1_1 = str_replace("Report_name_scope",$report_name_scope,$Get_research_approaches_para1);
			$Get_research_approaches_para1_2 = str_replace("From_forecast",$forecast_from,$Get_research_approaches_para1_1);
			$Get_research_approaches_para1_3 = str_replace("To_forecast",$forecast_to,$Get_research_approaches_para1_2);
			if($Volume_unit){
				$Get_research_approaches_para1_4 = str_replace("Value_unit",strtolower($Value_unit).' and in terms of volume in '.strtolower($Volume_unit),$Get_research_approaches_para1_3);
			}else{
				$Get_research_approaches_para1_4 = str_replace("Value_unit",strtolower($Value_unit),$Get_research_approaches_para1_3);
			}
			// $Get_research_approaches_para1_5 = str_replace("report_title",$report_name_scope,$Get_research_approaches_para1_4);
			// $Get_research_approaches_para1_6 = str_replace("Scope_name",$desc_scope_name,$Get_research_approaches_para1_5);
			$Get_research_approaches_para1_6 = str_replace("both bottom-up and top-down approaches","bottom-up approaches",$Get_research_approaches_para1_4);
			$Get_research_approaches_para1_7 = str_replace("country or regional","country's",$Get_research_approaches_para1_6);
			$Get_research_approaches_para1_8 = str_replace("The country market sizes are added to arrive at the regional market size.","The segment revenues of the key players are identified through product portfolio analysis and considering the macro indicator analysis.",$Get_research_approaches_para1_7);
			$Get_research_approaches_para1_9 = str_replace("Further, the market size of the regions is added to arrive at the Scope_name market size of the report_title.","The macro indicator considered here is population.",$Get_research_approaches_para1_8);

			$Research_approaches3 = $this->Country_model->get_rd2_codedecode_para(14);
			$Get_research_approaches_para3 = $Research_approaches3->description;
			$Get_research_approaches_para3_1 = str_replace("Report_name_scope",$report_name_scope,$Get_research_approaches_para3);
			$Get_research_approaches_para3_2 = str_replace("Report_name",$report_name_scope,$Get_research_approaches_para3_1);
			$Get_research_approaches_para3_3 = str_replace("Scope_name",$desc_scope_name,$Get_research_approaches_para3_2);
			$Get_research_approaches_para3_4 = str_replace(" in the world market.",".",$Get_research_approaches_para3_3);
			$Get_research_approaches_para3_4 = str_replace(" and in world market.",".",$Get_research_approaches_para3_4);
			$Get_research_approaches_para3_5 = str_replace(" studied, which then is added to arrive at regional market size and there by obtaining  market size. ",". ",$Get_research_approaches_para3_4);
			// var_dump($Get_research_approaches_para1_9); die;
			
			/* Sample - Executive Summary */
            $type = "Summary DRO";
			$Executive_summery = $this->Country_model->get_rd_market_insight($report_id, $type);
			foreach($Executive_summery as $rd_executive_summery){
				$rd_executive_summery_data.= $rd_executive_summery->description;
			}
			
			/* Sample - DRO Analysis */
			$Get_dro_analysis_para1 = $this->Country_model->get_rd2_codedecode_para(16);
			$dro_analysis1 = $Get_dro_analysis_para1->description;					
			$dro_analysis_para1 = str_replace("Report_name_scope",$report_name_scope,$dro_analysis1);
			$dro_analysis_para1_2 = str_replace("report_title",$report_name_scope,$dro_analysis_para1);

			$Get_dro_analysis_para2 = $this->Country_model->get_rd2_codedecode_para(17);
			$dro_analysis2 = $Get_dro_analysis_para2->description;	
			$dro_analysis_para2_1 = str_replace("Report_name",$report_name_scope,$dro_analysis2);
			$dro_analysis_para2_2 = str_replace("report_title",$report_name_scope,$dro_analysis_para2_1);

			/* IGR- Growth Matrix Analysis  */
			$growth_matrix_analysis = $this->Country_model->get_rd2_codedecode_para(19);
			$growth_matrix_analysis_para = $growth_matrix_analysis->description;
			$growth_matrix_analysis_para1 = str_replace("Segments_name",$segment1,$growth_matrix_analysis_para);
			$growth_matrix_analysis_para1 = str_replace("or region ","",$growth_matrix_analysis_para1);
			// var_dump($growth_matrix_analysis_para1); die;
			/* IGR- Growth Matrix Analysis Sub Point */
			$growth_matrix_analysis_sub_point = $this->Country_model->get_rd2_codedecode_para(20);
			$growth_matrix_analysis_sub_point_data = $growth_matrix_analysis_sub_point->description;

            $type = "Competitive Landscape";
			$compitative_landscape = $this->Country_model->get_rd_market_insight($report_id, $type);
			foreach($compitative_landscape as $rd_compitative_landscape){
				$report_compitative_landscape.= $rd_compitative_landscape->description;
			}
            /* ./ ----------------- get rd market insight data ------------------ */

            /*  Sample - Porter’s Five Forces Analysis */
			$porters_five_forces = $this->Country_model->get_rd2_codedecode_para(18);
			$porters_five_forces_para = $porters_five_forces->description;
            /* ./ Sample - Porter’s Five Forces Analysis */
            
            /* ******************Word File Writing******************* */
			$PHPWord = new PhpWord();
			// $section = $PHPWord->addSection();
			/* $section = $PHPWord->addSection(array('marginLeft'=>720, 'marginRight'=>720,'marginTop'=>1440,'marginBottom'=>1150, 'orientation' => 'landscape')); */
			 
			/* ---------------------- Header ---------------------- */	
			/* $PHPWord->addParagraphStyle('headerTitle', array('align'=>'left', 'spacing' => 72, 'spaceBefore' => 240, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('headerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 9, 'italic' =>true));
			$header = $section->addHeader();
			$table = $header->addTable();
			$table->addRow();
			$table->addCell(12700, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 360, 'after' => 280))))->addText(htmlspecialchars(ucwords($report_title_scope).": Prospects, Trends Analysis, Market Size and Forecasts up to ".$forecast_to),'headerTitleFont', 'headerTitle');
			$table->addCell(1300, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 360, 'after' => 280))))->addImage('images/logo.png', array('width'=>160, 'height'=>37, 'align'=>'right'));
			$header->addWatermark('images/sample.jpg', array('marginTop'   => 0.5, 'width'=>720, 'height'=>400));
			/* ./ ---------------------- Header ---------------------------- */
            
			/* ---------------------- Footer ---------------------------- */
			/* $PHPWord->addParagraphStyle('footerTitle', array('align'=>'right', 'spacing' => 72, 'spaceBefore' => 120, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('footerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 10.5));
			$footer = $section->addFooter();
			$table = $footer->addTable();
			$table->addRow();
			$table->addCell(14000);
			$table->addRow();
			$copyright = "© Infinium Global Research";
			$table->addCell(12700, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop' => 0.5,  'marginBottom' => 0.5))->addText(html_entity_decode($copyright), 'footerTitleFont', 'headerTitle');
			$table->addCell(1300, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom' => 0.5))->addPreserveText('Page {PAGE}', 'footerTitleFont', 'footerTitle');
			/* ./ ---------------------- Footer ------------------------ */
			
			/* Header & Footer */
			$PidPageSettings = array(
				'headerHeight'=> \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.2),
				'footerHeight'=> \PhpOffice\PhpWord\Shared\Converter::inchToTwip(.0),
				'marginLeft'  => 720,
				'marginRight' => 720,
				'marginTop'   => 0,
				'marginBottom'=> 0,
				'orientation' => 'landscape',
			);
			$section = $PHPWord->addSection($PidPageSettings);
			/*----------------------Header -------------------------------*/	
			$textAlign = new \PhpOffice\PhpWord\SimpleType\TextAlignment();
			$PHPWord->addParagraphStyle('headerTitle', array('align'=>'left', 'spacing' => 72, 'spaceBefore' => 240, 'spaceAfter' => 120));
			$PHPWord->addFontStyle('headerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 10.5, 'italic' =>true));
			$header = $section->addHeader();
			$table = $header->addTable();
			$table->addRow();
			$table->addCell(13700, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 160, 'after' => 80))))->addText(htmlspecialchars(ucwords($report_title_scope).": Prospects, Trends Analysis, Market Size and Forecasts up to ".$forecast_to),'headerTitleFont', 'headerTitle');
			$table->addCell(2300, array('borderBottomSize' => 15, 'borderBottomColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom'=> 0.5, array('space' => array('before' => 160, 'after' => 80))))->addImage('images/new_logo.png', array('width'=>110, 'height'=>32, 'positioning' => 'relative'));
			$header->addWatermark('images/sample.jpg', array('marginTop'   => 0.5, 'width'=>780, 'height'=>400));
			/*----------------------Header -------------------------------*/

			/*----------------------Footer -------------------------------*/
			$PHPWord->addParagraphStyle('footerTitle', array('align'=>'right', 'spacing' => 72, 'spaceBefore' => 120, 'spaceAfter' => 240));
			$PHPWord->addFontStyle('footerTitleFont', array('align'=>'left','name'=>'Franklin Gothic Medium', 'color'=>'#78777C', 'size' => 10.5));
			$footer = $section->addFooter();
			$table = $footer->addTable();
			/* $table->addRow();
			$table->addCell(14000); */
			$table->addRow();
			$copyright = "© Infinium Global Research LLP";
			$table->addCell(13700, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop' => 0.5,  'marginBottom' => 0.5))->addText(html_entity_decode($copyright), 'footerTitleFont', 'headerTitle');
			$table->addCell(2300, array('borderTopSize' => 15, 'borderTopColor' => '#E59C24', 'marginLeft'  => 0.5, 'marginRight' => 0.5, 'marginTop'   => 0.5,  'marginBottom' => 0.5))->addPreserveText('Page {PAGE}', 'footerTitleFont', 'footerTitle');
			/*----------------------Footer -------------------------------*/
			/* ./ Header & Footer */

			/* Cover page */
			$section->addText(htmlspecialchars(strtoupper($report_title_scope)), array('align'=>'left','name'=>'Roboto Condensed', 'color'=>'#78777C', 'size' => 28));
			$section->addText(' PROSPECTS, TRENDS ANALYSIS, MARKET SIZE AND FORECASTS UP TO '.strtoupper($forecast_to), array('align'=>'left','name'=>'Roboto Condensed', 'color'=>'#78777C', 'size' => 11));
			$section->addImage('images/home_page.jpg', array('width'=>720, 'height'=>420, 'wrapText' => 'square','wrappingStyle' => 'behind'));				
			$section->addPageBreak();
			$section->addImage('images/about_us.jpg', array('width'=>720, 'height'=>550, 'align'=>'center', 'wrappingStyle' => 'tight'));
            /* ./ Cover page */

            /************ Paragraph Styles */
			$PHPWord->addFontStyle('Style1', array('align'=>'left','name'=>'Roboto Condensed','size'=>20,'color'=>'#E59C24', 'bold' => true, 'pageBreakBefore' => true));
			$PHPWord->addFontStyle('myOwnStyle', array('bold'=>false,'spaceAfter'=>0, 'name'=>'Franklin Gothic Medium','size' => 13, 'color'=>'#E59C24', 'line-height'=> 1.5));
			$PHPWord->addFontStyle('ChapStyle', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>13,'color'=>'#E59C24', 'bold' => false));
			$PHPWord->addFontStyle('subpoint', array('bold'=>false, 'name'=>'Franklin Gothic Medium','size' => 10, 'color'=>'#78777C'));
			$PHPWord->addFontStyle('childpoint', array('bold'=>false, 'name'=>'Franklin Gothic Medium','size' => 9, 'color'=>'#626262'));
			$PHPWord->addParagraphStyle('P-Style', array('spacing' => 0, 'spaceAfter'=>100, 'name'=>'Franklin Gothic Medium', 'size' => 10.5,'color'=>'#78777C', 'indentation' => array('left' => 0.9, 'right' => 0.27, 'hanging' => 0.65)));
			$PHPWord->addParagraphStyle('PStyle', array('spacing' => 120, 'spaceBefore' => 120, 'spaceAfter'=>0, 'name'=>'Franklin Gothic Medium', 'size' => 10.5,'color'=>'#78777C', 'indentation' => array('left' => 0.9, 'right' => 0.27, 'hanging' => 0.65)));
			$listStyle = array('color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0, 'listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);
			/***********  ./ Paragraph Styles */

            /* ************* Report TOC Writing ******************* */
			$section->addText('Table of Contents', 'Style1');
			/* Chapter 1 */
			$section->addText('1.	Introduction', 'ChapStyle', 'PStyle');				
			$section->addText('	1.1	Report Description', 'subpoint', 'P-Style');
			$section->addText('		1.1.1	Segmentation and Research Scope', 'childpoint', 'P-Style');
			$section->addText('		1.2.1	Definition, Abbreviations, and Assumptions', 'childpoint', 'P-Style');
			$section->addText('	1.2	Research Methods', 'subpoint', 'P-Style');
			$section->addText('		1.2.1	Methodology','childpoint', 'P-Style');
			$section->addText('		1.2.2	Research Methodology: An Outline','childpoint', 'P-Style');
            $section->addText('			1.2.2.1.	Primary Research', 'childpoint', $listStyle, 'P-Style');
            $section->addText('			1.2.2.2.	Secondary Research', 'childpoint', $listStyle, 'P-Style');
			$section->addText('	1.3	Research Approaches', 'subpoint', 'P-Style');

            /* Chapter 2 */
			$section->addText('2.	Executive Summary', 'ChapStyle', 'PStyle');			
			$section->addText('	2.1	'.htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'")).' Projection', 'subpoint', 'P-Style');
			
            /* TOC Chapter 3 */
			$section->addText(htmlspecialchars('3.	Market Overview & Competitiveness'), 'ChapStyle', 'PStyle');
			$section->addText(htmlspecialchars('	3.1	DRO Analysis'), 'subpoint', 'P-Style');
			/* Drivers */
			$section->addText(htmlspecialchars('		3.1.1	Drivers'), 'childpoint', 'P-Style');
			
			$type = 'Driver';
			$rd2_drivers = $this->Country_model->get_rd_dro($report_id, $type);			
			foreach($rd2_drivers as $deivers)
			{
				$drivers[] = $deivers->description;
			}                        
			if($drivers != NULL){
			    $d = count($drivers);                
		    	$n = 1;
    			for($i = 0; $i < $d ; $i++)
    			{
    				$section->addText('			3.1.1.'.htmlspecialchars($n).'	'.htmlspecialchars($drivers[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}            
			/* Restraints */
			$section->addText('		3.1.2	Restraints', 'childpoint', 'P-Style');
			$type = 'Restraint';
			$rd2_restraints = $this->Country_model->get_rd_dro($report_id, $type);
			foreach($rd2_restraints as $restraints)
			{
				$restraint[] = $restraints->description;
			}
			if($restraint != NULL){
    			$r = count($restraint);
    			$n = 1;
    			for($i = 0; $i < $r ; $i++)
    			{
    				$section->addText('			3.1.2.'.htmlspecialchars($n).'	'.htmlspecialchars($restraint[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}			
			/* Opportunities */
			$section->addText('		3.1.3	Opportunities', 'childpoint', 'P-Style');
			$type = 'Opportunity';
			$rd2_opportunities = $this->Country_model->get_rd_dro($report_id, $type);
			foreach($rd2_opportunities as $opportunities)
			{
				$opportunity[] = $opportunities->description;
			}
			if($opportunity != NULL){
    			$o = count($opportunity);
    			$n = 1;
    			for($i = 0; $i < $o ; $i++)
    			{
    				$section->addText('			3.1.3.'.htmlspecialchars($n).'	'.htmlspecialchars($opportunity[$i]), 'childpoint', $listStyle, 'P-Style');
    				$n++;
    			}
			}
			$section->addText("	3.2	Porter's Diamond Model for ".htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'")), 'subpoint', 'P-Style');
			$section->addText('	3.3	PEST Analysis', 'subpoint', 'P-Style');
			$section->addText('	3.4	IGR-Growth Matrix Analysis', 'subpoint', 'P-Style');
			$section->addText('	3.5	Value Chain Analysis of '.htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'")), 'subpoint', 'P-Style');
			$section->addText('	3.6	Competitive Landscape in '.htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'")), 'subpoint', 'P-Style');

            /* get Rd segments */
			$parent = 0;
			$rd_main_segments= $this->Country_model->get_country_rd_segments($report_id, $parent);			
            /* ./ get Rd segments */

			/* TOC Chapter 4 Company Profiles */
			$cmpt = 4;
			// $section->addText($cmpt.'.	Company Profiles and Competitive Landscape', 'ChapStyle', 'PStyle');	
			$section->addText($cmpt.'.	Company Profiles', 'ChapStyle', 'PStyle');	
			// $section->addText('	'.$cmpt.'.1	Competitive Landscape', 'childpoint', 'P-Style');
			// $section->addText('	'.$cmpt.'.1	Companies Profiles', 'childpoint', 'P-Style');
			$cmpsub = 1;
			$cmpsubchild = 1;
			$Get_rd_companies = $this->Country_model->get_country_rd_companies($report_id);
			foreach($Get_rd_companies as $company)
			{				
				$cmpProfile = $company->name;					
				/* $section->addText('		'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'	'.htmlspecialchars($cmpProfile), 'subpoint', 'P-Style');
				$section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.1	Overview', 'childpoint', 'P-Style'); */	
				$section->addText('	'.$cmpt.'.'.$cmpsub.'	'.htmlspecialchars($cmpProfile), 'subpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.1	Overview', 'childpoint', 'P-Style');				
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.2	Company Snapshot', 'childpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.3	Financial Snapshot', 'childpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.4	Product Portfolio', 'childpoint', 'P-Style');	
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.5	Recent Developments', 'childpoint', 'P-Style');	
				$cmpsub++;
			}
			// $section->addPageBreak();
			/* ./ TOC Chapter 4 Company Profiles */

            /* TOC Chapter 4 Segment */
            $chap = 5;
            foreach($rd_main_segments as $segments)
			{
				$new_segment=$report_title_scope.' by '.htmlspecialchars(ucwords($segments->name, " \t\r\n\f\v'"));	
				if($Volume_unit){
					$section->addText($chap.'.	'.htmlspecialchars($new_segment).' (USD '.htmlspecialchars($Value_unit).', '.htmlspecialchars($Volume_unit).')', 'ChapStyle', 'PStyle');
				}else{
					$section->addText($chap.'.	'.htmlspecialchars($new_segment).' (USD '.htmlspecialchars($Value_unit).')', 'ChapStyle', 'PStyle');
				}
				$section->addText('	'.$chap.'.1	Overview', 'subpoint', 'P-Style');

				$subpt = 2;
				$sub_segments = $this->Country_model->get_country_rd_segments($report_id, $segments->id);	
				foreach($sub_segments as $subsegments)
				{
					$sub_segment = $subsegments->name;
					$section->addText('	'.$chap.'.'.$subpt.'	'.htmlspecialchars($sub_segment), 'subpoint', 'P-Style');
					
					$childpt = 1;
					$child_segments= $this->Country_model->get_country_rd_segments($report_id, $subsegments->id);			
					if($child_segments)
					{
						foreach($child_segments as $childsegments)
						{
							$child_segment = $childsegments->name;
							$child_segmentid = $childsegments->id;
							$section->addText('		'.$chap.'.'.$subpt.'.'.$childpt.'	'.htmlspecialchars($child_segment), 'childpoint', 'P-Style');

							$subchildpt = 1;
							$sub_child_segments = $this->Country_model->get_country_rd_segments($report_id, $childsegments->id);
							if($sub_child_segments)
							{
								foreach($sub_child_segments as $subchildsegments)
								{
									$sub_child_segment = $subchildsegments->name;
									$section->addText('			'.$chap.'.'.$subpt.'.'.$childpt.'.'.$subchildpt.'	'.htmlspecialchars($sub_child_segment), 'childpoint', 'P-Style');
								}
								$subchildpt++;
							}
							$childpt++;
						}
					}
					$subpt++;
				}
				$chap++;
				// $cmpt = $chap;                
            }
			/* ./ TOC Chapter 4 Segment */

			/* TOC Chapter 5 Company Profiles */
			// $section->addText($cmpt.'.	Company Profiles and Competitive Landscape', 'ChapStyle', 'PStyle');	
			/* $section->addText($cmpt.'.	Company Profiles', 'ChapStyle', 'PStyle');	
			// $section->addText('	'.$cmpt.'.1	Competitive Landscape', 'childpoint', 'P-Style');
			// $section->addText('	'.$cmpt.'.1	Companies Profiles', 'childpoint', 'P-Style');
			$cmpsub = 1;
			$cmpsubchild = 1;
			$Get_rd_companies = $this->Country_model->get_country_rd_companies($report_id);
			foreach($Get_rd_companies as $company)
			{				
				$cmpProfile = $company->name;					
				// $section->addText('		'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'	'.htmlspecialchars($cmpProfile), 'subpoint', 'P-Style');
				// $section->addText('			'.$cmpt.'.'.$cmpsub.'.'.$cmpsubchild.'.1	Overview', 'childpoint', 'P-Style'); 
				$section->addText('	'.$cmpt.'.'.$cmpsub.'	'.htmlspecialchars($cmpProfile), 'subpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.1	Overview', 'childpoint', 'P-Style');				
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.2	Company Snapshot', 'childpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.3	Financial Snapshot', 'childpoint', 'P-Style');
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.4	Product Portfolio', 'childpoint', 'P-Style');	
				$section->addText('		'.$cmpt.'.'.$cmpsub.'.5	Recent Developments', 'childpoint', 'P-Style');	
				$cmpsub++;
			} */
			$section->addPageBreak();
			/* ./ TOC Chapter 5 Company Profiles */
            
            /* ************* ./ Report TOC Writing ******************* */

			/* *************** List of Tables Only for Value ********************** */
			$PHPWord->addParagraphStyle('ParaStyle1', array('align'=>'left', 'spacing' => 0, 'spaceBefore' => 300, 'spaceAfter'=>0));
			$PHPWord->addFontStyle('Style1', array('align'=>'left','name'=>'Roboto Condensed','size'=>20,'color'=>'#E59C24', 'bold' => true, 'pageBreakBefore' => true));

			$section->addText('List of Tables', 'Style1', 'ParaStyle1');
			$section->addTextBreak(1);
			$section->addText('TABLE 1   '.htmlspecialchars(strtoupper($report_title_scope." HIGHLIGHTS".' (USD '.htmlspecialchars($Value_unit))).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
			/* Main segments */
			$parent = 0;			
			$num = 2;			
			$main_segments= $this->Country_model->get_country_rd_segments($report_id, $parent);
			foreach($main_segments as $segments)
			{
				$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$num++;

				if($Volume_unit)
				{
					$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$num++;
				}
				/* --- sub segments --- */
				$sub_segments= $this->Country_model->get_country_rd_segments($report_id, $segments->id);	
				foreach($sub_segments as $subsegments)
				{
					$child_segments = $this->Country_model->get_country_rd_segments($report_id, $subsegments->id);
					if($child_segments){
						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($subsegments->name))." BY ".strtoupper($segments->name).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$num++;

						if($Volume_unit)
						{
							$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($subsegments->name))." BY ".strtoupper($segments->name).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
							$num++;
						}
						/* --- child segment--- */
						foreach($child_segments as $childsegments)
						{
							$sub_child_segments = $this->Country_model->get_country_rd_segments($report_id, $childsegments->id);
							if($sub_child_segments){
								$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title))." BY ".htmlspecialchars(strtoupper($childsegments->name.' BY '.$subsegments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$num++;
								if($Volume_unit)
								{
									$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title))." BY ".htmlspecialchars(strtoupper($childsegments->name.' BY '.$subsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
									$num++;
								}
								/* --- sub child segment--- */							
								/* if($sub_child_segments){
									foreach($sub_child_segments as $subchildsegments)
									{
										$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title.' BY '.$subchildsegments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
										$num++;
										if($Volume_unit)
										{
											$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title.' BY '.$subchildsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
											$num++;
										}
									}
								} */
								/* ./ --- sub child segment--- */
							}/* else{
								$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title))." BY ".htmlspecialchars(strtoupper($childsegments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$num++;
								if($Volume_unit)
								{
									$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name." ".$report_title))." BY ".htmlspecialchars(strtoupper($childsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
									$num++;
								}
							}	 */						
						}
						/* ./ --- child segment--- */	
					}/* else{
						$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name))." ".htmlspecialchars(strtoupper($report_title))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$num++;

						if($Volume_unit)
						{
							$section->addText('TABLE '.$num.'   '.htmlspecialchars(strtoupper($country_name))." ".htmlspecialchars(strtoupper($report_title))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
							$num++;
						}
					} */
				}
				/* /. --- sub segment--- */
			}
			/* /. Main Segments */
			/* *************** ./ List of Tables Only for Value ********************** */

			/* *************** List of Figures ********************** */
			$section->addText('List of Figures', 'Style1', 'ParaStyle1');
			$section->addTextBreak(1);
			$figure2="FIGURE 1   RESEARCH APPROACHES - BOTTOM UP \n\n";
			$section->addText(htmlspecialchars($figure2), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure4="FIGURE 2   IGR - RESEARCH METHOD AND DATA TRIANGULATION  \n\n";
			$section->addText(htmlspecialchars($figure4), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			if($Volume_unit){
				$figure5="FIGURE 3   ".htmlspecialchars(strtoupper($report_title_scope)).", ".$market_period." (USD ".htmlspecialchars(strtoupper($Value_unit)).", ".htmlspecialchars(strtoupper($Volume_unit)).") \n";
			}else{
				$figure5="FIGURE 3   ".htmlspecialchars(strtoupper($report_title_scope)).", ".$market_period." (USD ".htmlspecialchars(strtoupper($Value_unit)).") \n";
			}
			$section->addText(htmlspecialchars($figure5), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure7="FIGURE 4   DRIVERS AND RESTRAINT OF ".htmlspecialchars(strtoupper($report_title_scope)).", IMPACT ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure7), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure8="FIGURE 5   PEST ANALYSIS";
			$section->addText(htmlspecialchars($figure8), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
			$figure9="FIGURE 6   PORTER"."'"."S DIAMOND MODEL ANALYSIS \n\n";
			$section->addText(htmlspecialchars($figure9), array('align'=>'center','name'=>'Franklin Gothic Medium','color'=>'#78777C', 'size'=>10));
			$number = 7;
			/* Segments */
			foreach($main_segments as $segments)
			{
				$section->addText(htmlspecialchars("FIGURE ".$number."   IGR- GROWTH MATRIX ANALYSIS FOR ".strtoupper($segments->name)), array('align'=>'center','name'=>'Franklin Gothic Medium','color' => '#78777C','size'=>10));
				$number++;
			}
			foreach($main_segments as $segments)
			{
				$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$Base_year." - ".$forecast_to." (REVENUE % SHARE)", array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
				$number++;					
				if($Volume_unit) {
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
				} else {
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
				}
				/* --- sub segment---- */
				$sub_segments= $this->Country_model->get_country_rd_segments($report_id, $segments->id);	
				foreach($sub_segments as $subsegments)
				{
					$child_segments = $this->Country_model->get_country_rd_segments($report_id, $subsegments->id);	
					if($child_segments){
					$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." FOR ".htmlspecialchars(strtoupper($subsegments->name))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$Base_year." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
					$number++;
					if($Volume_unit)
					{
						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." FOR ".htmlspecialchars(strtoupper($subsegments->name))." BY ".htmlspecialchars(strtoupper($segments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$number++;
					}
					/* --- child segment---- */					
						foreach($child_segments as $childsegments)
						{
							$sub_child_segments = $this->Country_model->get_country_rd_segments($report_id, $childsegments->id);	
							if($sub_child_segments){
								$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." FOR ".$childsegments->name))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$Base_year." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$number++;
								if($Volume_unit)
								{
									$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." FOR ".$childsegments->name))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
									$number++;
								}
								/* --- sub child segment---- */
								foreach($sub_child_segments as $subchildsegments)
								{
									$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." BY ".$subchildsegments->name)).", ".$Base_year." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
									$number++;
									if($Volume_unit)
									{
										$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." BY ".$subchildsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
										$number++;
									}
								} /* ./ --- sub child segment---- */
							} else {
								$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." BY ".$childsegments->name)).", ".$analysis_from." - ".$forecast_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
								$number++;
								if($Volume_unit)
								{
									$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope." BY ".$childsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
									$number++;
								}
							}
						}	/* --- /. child segment---- */
					} else {
						$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars(strtoupper($Value_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
						$number++;
						if($Volume_unit)
						{
							$section->addText('FIGURE '.$number.'   '.htmlspecialchars(strtoupper($report_title_scope))." BY ".htmlspecialchars(strtoupper($subsegments->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars(strtoupper($Volume_unit)).')', array('align'=>'left','name'=>'Franklin Gothic Medium','size'=>10,'color'=>'#78777C'));
							$number++;
						}
					}								
				} /* --- /. sub segment---- */
			} /* /. Segments */

			/* -------------note style------------- */
			$PHPWord->addParagraphStyle('noteStyle', array('align'=>'left', 'spacing'=>0, 'spaceBefore' => 120, 'spaceAfter' =>0));
			$PHPWord->addFontStyle('noteFont', array('align'=>'left', 'size'=>10.5,'name'=>'Franklin Gothic Medium', 'color'=>'red', 'underline' => 'single'));
			/* -------------note style------------- */
			$section->addText('Note: The list of figures in the sample is for reference only and limited, the full list of figures is given in the complete report.', 'noteFont', 'noteStyle');
			$section->addPageBreak();

			/* ********************** List of Figures ********************** */

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
			$section->addText(htmlspecialchars($New_sample_description_para2_12), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($New_sample_description_para3_4), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addListItem('Segmentation and Research Scope', 2, 'childPoint', $listStyle, 'Head 2');
			/* Segments List */
			$parent = 0;
			$main_segments2= $this->Country_model->get_country_rd_segments($report_id, $parent);			
			foreach($main_segments2 as $segments2)
			{
				$listStyleBullet = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_FILLED, 'name'=>'Franklin Gothic Medium', 'size' => 10.5, 'color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0);
				$listStyleBulletEmpty = array('listType'=>PhpOffice\PhpWord\Style\ListItem::TYPE_BULLET_EMPTY , 'name'=>'Franklin Gothic Medium', 'size' => 10.5, 'color'=>'#78777C', 'spaceAfter'=>0, 'spaceBefore'=> 0,  'spacing'=>0);

				$section->addText('Segmentation based on '.htmlspecialchars(ucwords($segments2->name)), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
				/* sub segments */
				$sub_segments2= $this->Country_model->get_country_rd_segments($report_id, $segments2->id);	
				foreach($sub_segments2 as $subsegments2)
				{
					$section->addListItem(htmlspecialchars($subsegments2->name), 0, array('align'=>'left', 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5), $listStyleBullet, 'P-Style');
					/* child segments */
					$child_segments2 = $this->Country_model->get_country_rd_segments($report_id, $subsegments2->id);			
					if($child_segments2)
					{
						foreach($child_segments2 as $childsegments2)
						{
							$section->addListItem(htmlspecialchars($childsegments2->name), 1, array('align'=>'left', 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5), $listStyleBulletEmpty, 'P-Style');

							/* sub child segments */
							$sub_child_segments2 = $this->Country_model->get_country_rd_segments($report_id, $childsegments->id);			
							if($sub_child_segments2)
							{
								foreach($sub_child_segments2 as $subchildsegments2)
								{
									$section->addListItem(htmlspecialchars($subchildsegments2->name), 2, array('align'=>'left', 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5), $listStyleBulletEmpty, 'P-Style');
								}
							} /* ./ sub child segments */
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
			$market_segments = "The report segments the ".htmlspecialchars($report_name_scope.' by '. $rd_segments_name);

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
					$table->addCell(3000, $styleCellColor)->addText(htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'"))." (Definition)", 'trStyle1', 'pStyle');
					$table->addCell(6500, $styleCellColor)->addText(htmlspecialchars($report_definition), 'trStyle', 'pStyle');
				}
				else if($i==2)
				{					
					$table->addRow();
					$table->addCell(3000)->addText("Defining Market Segments", 'trStyle1', 'Table1_Left');
					$table->addCell(6500)->addText($market_segments, 'trStyle', 'pStyle');
				}
			}
			
			$n = 0;
			// $sub_segments5 = $this->RdData_model->get_rd_segments($report_id, $segments5->id);	
			foreach($main_segments2 as $segments2)
			{
				$sub_segments211= $this->Country_model->get_country_rd_segments($report_id, $segments2->id);
				foreach($sub_segments211 as $rd_sub_segments)
				{
					$subseg[] = $rd_sub_segments->name;	
				}
				if($subseg != NULL){
					$j= count($subseg);
					for($i=0; $i<$j ; $i++)
					{
						if($i==$j-2)
						{
							$subsegment1 .=ltrim(rtrim($subseg[$i]))." and ";
						}
						if($i== $j-1)
						{
							$subsegment1 .= ltrim(rtrim($subseg[$i]))."";
						}
						if($i<$j-2)
						{
							$subsegment1 .= ltrim(rtrim($subseg[$i])).", ";
						}
					}					
				}
				$rd_sub_segments_name = $subsegment1;

				$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
				$styleCellColor = array('bgColor'=>$bg_color);
				$table->addRow();
				$table->addCell(3000, $styleCellColor)->addText(htmlspecialchars($segments2->name), 'trStyle1', 'Table1_Left');
				$table->addCell(6500, $styleCellColor)->addText($rd_sub_segments_name, 'trStyle', 'pStyle');
				$n++;
				unset($subseg);
				unset($subsegment1);
			}
			$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
			$styleLastCell = array('bgColor'=>$bg_color, 'borderBottomColor'=>'#78777C', 'borderBottomSize'=>2);
			$table->addRow();
			$table->addCell(3000, $styleLastCell)->addText("Revenue", 'trStyle1', 'Table1_Left');
			$table->addCell(6500, $styleLastCell)->addText("The revenues are provided in United States Dollar (USD) Million.", 'trStyle', 'pStyle');	
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
			/* Primary Research */
			$section->addListItem(htmlspecialchars('	Primary Research:'), 2, 'childPoint', $listStyle, 'Head 2');
			$section->addText(htmlspecialchars($primary_research_para), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars("Primary interviews not only help in data validation but also provide critical insights into the market, current business scenario, and future expectations and enhance the quality of our reports. In addition to analyzing the current and historical trends, our analysts predict where the market is headed, over the next five years."), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Primary Sources Considered During this Particular Study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));	
			$primary_research_source_points2 = explode('\n', $primary_research_source_points1);
			foreach($primary_research_source_points2 as $source_points) 
			{
				$section->addText(htmlspecialchars($source_points), 'r2Style', 'Bullet');
			}
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Data Points Received Through Primary Research During the Course of Study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));	
			$primary_research_data_points1 = explode('\n', $primary_research_data_points_1);
			foreach($primary_research_data_points1 as $data_points) 
			{
				$section->addText(htmlspecialchars($data_points), 'r2Style', 'Bullet');
			}
			$section->addText(htmlspecialchars('Breakdown of the Profiles of Primaries as Follows:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));				
			$section->addImage('images/primaries_breakdown_for_country_sample.png', array('width'=>410, 'height'=>230, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addText(htmlspecialchars('Primary interviews not only help in data validation but also provide critical insights into the market, current business scenario, and future expectations and enhance the quality of our reports. In addition to analyzing the current and historical trends, our analysts predict where the market is headed, over the next five years.'), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('Primary Sources Considered During this Particular Study:'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
			$section->addImage('images/primary_sources.png', array('width'=>460, 'height'=>280, 'align'=>'center'));
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
			$section->addText(htmlspecialchars("Company Reports and Publications"), 'r2Style', 'Bullet');
			$section->addText(htmlspecialchars("Government/Institutional Publications"), 'r2Style', 'Bullet');
			$section->addText(htmlspecialchars("Trade and Associations’ Journals"), 'r2Style', 'Bullet');
			$section->addText(htmlspecialchars("Others"), 'r2Style', 'Bullet');
			$section->addTextBreak(1);
			$section->addListItem('Research Approaches', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars('RESEARCH APPROACHES - BOTTOM UP'), 'figureNameStyle', 'Figure _ Title');							
			$section->addImage('images/research_approaches_bottom_up_country.png', array('width'=>620, 'height'=>320, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($Get_research_approaches_para1_9), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars('IGR - RESEARCH METHOD AND DATA TRIANGULATION'), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/research_method_and_data_triangulation.png', array('width'=>760, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($Get_research_approaches_para3_5), 'r2Style', 'paragraphStyle');
			$section->addPageBreak();
			/* /. Sample Pages Chapter 1 */

			/* Sample Pages Chapter 2 */
			$section->addListItem('Executive Summary', 0, 'chaptHeading', $listStyle, 'Main Heading');
			$section->addText(htmlspecialchars($rd_executive_summery_data), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$table2 = htmlspecialchars(strtoupper($report_title_scope))." HIGHLIGHTS";
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
    					$table->addCell(3500, $styleCellColor)->addText(htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'")), 'trStyle1', 'Table1_Left');
    					$table->addCell(3500, $styleCellColor)->addText("Value: ".htmlspecialchars($start_year_revenue.' '.strtolower($Value_unit)), 'trStyle1', 'pStyle');
    					$table->addCell(3500, $styleCellColor)->addText("Value: ".htmlspecialchars($end_year_revenue.' '.strtolower($Value_unit)), 'trStyle1', 'pStyle');
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
    						$main_segments3 = $this->Country_model->get_country_rd_segments($report_id, $parent);
							foreach($main_segments3 as $segments33)
    						{
    							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
    							$styleCellColor = array('bgColor'=>$bg_color);
    							$mainseg33 = $segments33->name;
    							$table->addRow();
    							$table->addCell(3500, $styleCellColor)->addText(htmlspecialchars(ucwords($report_title, " \t\r\n\f\v'"))." by ".htmlspecialchars($mainseg33)." Value (USD ".$Value_unit.")",'trStyle1', 'Table1_Left');
    							$table_cell = $table->addCell(3500, $styleCellColor);
    							$text="";
    							$x=1;
    							$sub_segments3 = $this->Country_model->get_country_rd_segments($report_id, $segments33->id);	
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
    							$sub_segments4 = $this->Country_model->get_country_rd_segments($report_id, $segments33->id);	
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
    			}
    		}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/************** Company Profile ****************************/
			$cmp_profile_para="The report provides profiles of the companies in the ".$country_name.' '.strtolower($report_name)." such as, ";
			$rd_companies = $this->Country_model->get_rd_companies($report_id);
			
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
			$section->addListItem(htmlspecialchars(ucwords($report_title_scope, " \t\r\n\f\v'"))." Projection", 1, 'subPoint', $listStyle, 'Head 1');
			$figure6 = htmlspecialchars(strtoupper($report_title_scope)).", ".htmlspecialchars($market_period)." (USD ".htmlspecialchars(strtoupper($Value_unit)).")";
			$section->addText(htmlspecialchars($figure6), 'figureNameStyle', 'Figure _ Title');
			$section->addTextBreak(1);
			if($Volume_unit){
				$section->addImage('images/market_projection_2021_2030_volume.png', array('width'=>760, 'height'=>240, 'align'=>'center'));					
			} else {
				$section->addImage('images/market_projection_2021_2030_value.png', array('width'=>760, 'height'=>240, 'align'=>'center'));
			}
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addPageBreak();
			/* /. Sample Pages Chapter 2 */

			/* Sample Pages Chapter 3 */
			$section->addListItem(htmlspecialchars('Market Overview & Competitiveness'), 0, 'chaptHeading', $listStyle, 'Main Heading');
			$section->addListItem('DRO Analysis', 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($dro_analysis_para1_2), 'r2Style', 'paragraphStyle');
			$section->addText(htmlspecialchars($dro_analysis_para2_2), 'r2Style', 'paragraphStyle');

			/* Drivers */
			$section->addListItem('Drivers', 2, 'childPoint', $listStyle, 'Head 2');
			$dro = 1;
			$type = 'Driver';
			$rd_drivers = $this->Country_model->get_rd_dro($report_id, $type);
			foreach($rd_drivers as $drivers)
			{
				$driver = $drivers->description;
				$section->addListItem(htmlspecialchars($driver), 3, 'childSubpoint', $listStyle, 'Head 3');					
				$section->addText(htmlspecialchars("Explanation of Factor ".$dro." that drives the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of factor ".$dro." and the analysis for ".$forecast_from." to ".$forecast_to." represents the future impact and trends of factor ".$dro." over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');					
				$dro++;
			}
			$figure8="DRIVERS AND RESTRAINT OF ".htmlspecialchars(strtoupper($report_name_scope)).", IMPACT ANALYSIS";
			$section->addText(htmlspecialchars($figure8), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/drivers_restraints_impact_analysis_country.png', array('width'=>580, 'height'=>280, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			/* Restraints */
			$section->addListItem('Restraints', 2, 'childPoint', $listStyle, 'Head 2');				
			$res = 1;
			$type = 'Restraint';
			$rd_restraints = $this->Country_model->get_rd_dro($report_id, $type);
			foreach($rd_restraints as $restraints)
			{
				$Restraint = $restraints->description;
				$section->addListItem(htmlspecialchars($Restraint), 3, 'childSubpoint', $listStyle, 'Head 3');					
				$section->addText(htmlspecialchars("Explanation about a restraining factor ".$res." that restraints the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of restraining factor ".$res." and the analysis for ".$forecast_from." to ".$forecast_to." represents the future impact and trends of restraining factor ".$res." over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');
				$res++;
			}
			$section->addTextBreak(1);
			/* Opportunities */
			$section->addListItem('Opportunities', 2, 'childPoint', $listStyle, 'Head 2');
			$opr = 1;
			$type = 'Opportunity';
			$rd_opportunity = $this->Country_model->get_rd_dro($report_id, $type);
			foreach($rd_opportunity as $opportunity)
			{
				$Opportunity=$opportunity->description;
				$section->addListItem(htmlspecialchars($Opportunity), 3, 'childSubpoint', $listStyle, 'Head 3');	
				$section->addText(htmlspecialchars("Explanation of opportunity factor ".$opr." that provides an opportunity in the market and its impact over the period of ".$analysis_from." to ".$analysis_to.". Here the analysis for ".$analysis_from." and ".$Base_year." presents the historic trends of opportunity and the analysis for ".$forecast_from." to ".$forecast_to." represents the future impact and trends of opportunity over this period. This is backed by supporting research or data."), 'r2Style', 'paragraphStyle');				
				$opr++;
			}
			$section->addTextBreak(1);
			$section->addListItem('	PEST-Analysis of the '.htmlspecialchars($report_title_scope), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars("PEST ANALYSIS"), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/pest_analysis_country.png', array('width'=>680, 'height'=>350, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addListItem('Porter'."'".'s Diamond Model for '.htmlspecialchars($report_title_scope), 1, 'subPoint', $listStyle, 'Head 1');
			$diamond_model_description = "Porter’s diamond model analysis provides insights into the competitiveness of the industry using four main factors, such as Demand Conditions, Factor Conditions, Related and Supporting Industries, and Firm Strategy, Structure, & Rivalry. These parameters determine how much competition subsists in a market and accordingly the profitability and attractiveness of this market for a company. An attractive industry will be the one where combined power of the competitive forces will increase profitability in the industry.";
			$section->addText(htmlspecialchars($diamond_model_description), 'r2Style', 'paragraphStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars("DIAMOND MODEL ANALYSIS"), 'figureNameStyle', 'Figure _ Title');
			$section->addImage('images/porters_diamond_model_country.png', array('width'=>680, 'height'=>350, 'align'=>'center'));
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

			/* -------------note style------------- */
			$PHPWord->addParagraphStyle('noteStyle', array('align'=>'left', 'spacing'=>0, 'spaceBefore' => 120, 'spaceAfter' =>0));
			$PHPWord->addFontStyle('noteFontFig', array('align'=>'left', 'size'=>8,'name'=>'Franklin Gothic Medium', 'color'=>'red'));
			$PHPWord->addFontStyle('noteFontSeg', array('align'=>'left', 'size'=>10.5,'name'=>'Franklin Gothic Medium', 'color'=>'red'));
			/* -------------note style------------- */

			$figure11="IGR-Growth Matrix Analysis";				
			$parent= 0;				
			$main_segments4 = $this->Country_model->get_country_rd_segments($report_id, $parent);
			foreach($main_segments4 as $segments4)
			{
				$mainseg44[] = $segments4->name;					
			} 			
			if($mainseg44[0]){
				$igr_growth_matrix_segment_title = htmlspecialchars($figure11). ' by ' .ucwords($mainseg44[0]);					
				$section->addListItem(htmlspecialchars(' '.$igr_growth_matrix_segment_title), 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/IGR_growth_matrix_sagment.png', array('width'=>520, 'height'=>320, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
			}
			$mgs = count($mainseg44);
			if($mainseg44[1]) {
				for($h=1; $h<$mgs; $h++)
				{
					$igr_growth_matrix_segment_title1 = htmlspecialchars($figure11). ' by ' .ucwords($mainseg44[$h]);					
					$section->addListItem(htmlspecialchars(' '.$igr_growth_matrix_segment_title1), 2, 'childPoint', $listStyle, 'Head 2');
					$section->addText('Same as the preceding point. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
					$section->addTextBreak(1); 
				}
			}
			$section->addListItem(htmlspecialchars('Value Chain Analysis of '.$report_title_scope), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addImage('images/value_chain_analysis.png', array('width' => 760, 'height' => 260, 'align' => 'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addListItem(htmlspecialchars('Competitive Landscape in '.$report_title_scope), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addText(htmlspecialchars($report_compitative_landscape), 'r2Style', 'paragraphStyle');
			$section->addPageBreak();	
			/* /. Sample Pages Chapter 3 */

			/* Sample Pages Chapter 4 - Company Profile */
			$section->addListItem('Company Profiles', 0, 'chaptHeading', $listStyle, 'Main Heading');	
			/* $section->addListItem(htmlspecialchars('Competitive Landscape in the '.$report_title), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($report_compitative_landscape), 'r2Style', 'paragraphStyle');
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle'); */
			// $section->addListItem(htmlspecialchars('Companies Profiles'), 1, 'subPoint', $listStyle, 'Head 1');	
			$rd_companies=$this->Country_model->get_rd_companies($report_id);	
			foreach($rd_companies as $companies)
			{
				$cmpProfile=$companies->name;	
				$cmpProfile= ltrim(rtrim(ucwords(strtolower($cmpProfile))))." ";				
				// $section->addListItem(htmlspecialchars($cmpProfile), 2, 'childPoint', $listStyle, 'Head 2');				
				$section->addListItem(htmlspecialchars($cmpProfile), 1, 'subPoint', $listStyle, 'Head 1');				
				// $section->addListItem('Overview', 3, 'childSubpoint', $listStyle, 'Head 3');
				$section->addListItem('Overview', 2, 'childPoint', $listStyle, 'Head 2');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);					
				$section->addListItem('Company Snapshot', 2, 'childPoint', $listStyle, 'Head 2');
				//$section->addImage('images/Company_snapshot.png', array('width'=>700, 'height'=>520, 'align'=>'center'));
				$section->addText('Add Company Snapshot Image of '.htmlspecialchars($cmpProfile), 'subPoint', 'sourceStyle');
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Financial Snapshot', 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Product Portfolio', 2, 'childPoint', $listStyle, 'Head 2');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);
				$section->addListItem('Recent Developments', 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/Recent_development_sample.png', array('width'=>760, 'height'=>220, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				break;
			}
			$section->addTextBreak(1);
			$rd['companies']=$this->Country_model->get_rd_companies($report_id);
			$c = 1;
			foreach($rd['companies'] as $cmpname){
				$company_names = $rd['companies'][$c];
				if($company_names){
					$section->addListItem(htmlspecialchars($company_names->name), 1, 'subPoint', $listStyle, 'Head 1');
				}
				$c++;							
			}
			$section->addText('(N.B.: Names of companies profiled in the report. Final report will contain the details of each company same as that of the above referenced)', 'noteFontSeg', 'noteStyle');	
			$section->addPageBreak();
			/* /. Sample Pages Chapter 4 - Company Profile */

			/* Sample Pages Chapter 5 */
			$parent = 0;
			$main_segments5 = $this->Country_model->get_country_rd_segments($report_id, $parent);
			foreach($main_segments5 as $segments5)
			{
				$new_segment5 = $report_title_scope.' by '.htmlspecialchars(ucwords($segments5->name, " \t\r\n\f\v'"));	
				$section->addListItem(htmlspecialchars($new_segment5), 0, 'chaptHeading', $listStyle, 'Main Heading');
				$section->addListItem('Overview', 1, 'subPoint', $listStyle, 'Head 1');
				/* Segment Overview */
				$segment_overview = $this->Country_model->get_country_rd_segment_overview($report_id, $segments5->id);
				if($segment_overview){
					foreach($segment_overview as $segoverview)
					{
						$section->addText(htmlspecialchars($segoverview->description), 'r2Style', 'paragraphStyle');
						break;
					}
				} else {
					$sub_segments6 = $this->Country_model->get_country_rd_segments($report_id, $segments5->id);			
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
			/* ./ Segment Overview */
			/* Pie chart figure */
				$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($segments5->name)).", ".$Base_year." - ".$forecast_to." (REVENUE % SHARE)", 'figureNameStyle', 'Figure _ Title');
				/* Figure */
				if($forecast_period == '2023-2030'){
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2023-2030-Pie.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
				}else{
					$section->addText('Add image of segment-revenue-share Pie Chart', array('size'=>12, 'color'=>'black'));
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
				if($forecast_period=='2023-2030')	{
					$section->addImage('images/sample/xyz-market-by-segment-revenue-share-2021-2030-bar.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
				}else {
					$section->addText('Add image of segment-revenue-share Bar Graph', array('size'=>12, 'color'=>'black'));
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
				// if($forecast_period =='2023-2030') {
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
				// }
				$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
				$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
				// Add more rows / cells for sub segment
				$n = 0;
				$sub_segments5 = $this->Country_model->get_country_rd_segments($report_id, $segments5->id);	
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
					// if($forecast_period =='2023-2030') {
						$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					// }
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
					// if($forecast_period =='2023-2030') {
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					// }
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
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
					$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
					// if($forecast_period =='2023-2030') {
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
					// }
					$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
					$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');			
					// Add more rows / cells for sub segment
					$n = 0;
					$sub_segments5_1 = $this->Country_model->get_country_rd_segments($report_id, $segments5->id);	
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
						// if($forecast_period =='2023-2030') {
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						// }
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
						// if($forecast_period =='2023-2030') {
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						// }
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');					
					$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
					$section->addTextBreak(1);
					$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
					$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
					$section->addTextBreak(1);
				} /* /. Volume Based table */
				/* /. Table Writeup - Main Segment */	
				
				// displaying sub segment data to word file
				$sub_segments5_2 = $this->Country_model->get_country_rd_segments($report_id, $segments5->id);	
				/* for checking child segment */
				foreach($sub_segments5_2 as $subsegmentsdata)
				{
					$is_child_segments += $this->Country_model->get_count_rd_childsegments($report_id, $subsegmentsdata->id);					
				}
				/* /. for checking child segment */
				/********* Adding Sub Segments *************/
				foreach($sub_segments5_2 as $subsegments5_2)
				{
					$sub_segment5_2 = $subsegments5_2->name;
					$section->addListItem(htmlspecialchars($sub_segment5_2), 1, 'subPoint', $listStyle, 'Head 1');
					$section->addText(htmlspecialchars('This Point Includes '.$sub_segment5_2.' Segment Analysis and Trends.'), array('align'=>'left', 'bold'=>true, 'name'=>'Franklin Gothic Medium', 'color'=>'#000', 'size' => 10.5));
					$section->addTextBreak(1);
					$child_segments3 = $this->Country_model->get_country_rd_segments($report_id, $subsegments5_2->id); 
					if($child_segments3){
						/* adding figure - sub segment */					
						$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($segments5->name).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
						$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						if($Volume_unit)
						{
							$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($segments5->name).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
							$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addTextBreak(1);
						}/* /. adding figure */	

						/* Table Writeup - Sub Segment */
						/* value based table */
						$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($segments5->name).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
						// Add table
						$table = $section->addTable('myOwnTableStyle');
						// Add row
						$table->addRow(70);
						// Add cells header
						$table->addCell(2500, $styleCell)->addText(htmlspecialchars($subsegments5_2->name), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
						$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
						// if($forecast_period =='2023-2030') {
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
						// }
						$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
						$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
						// Add more rows / cells region
						$n =0;					
						foreach($child_segments3 as $childsegments3)
						{
							$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
							$styleCellColor = array('bgColor'=>$bg_color);
							$table->addRow();
							$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($childsegments3->name)), 'trStyle', 'pStyle');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							// if($forecast_period =='2023-2030') {
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							// }
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
						// if($forecast_period =='2023-2030') {
							$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
						// }
						$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
					
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
						$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
						$section->addTextBreak(1);
						/* ./ value based table */	
						/* volume based table */
						if($Volume_unit)
						{
							$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name))." BY ".strtoupper($segments5->name).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
							// Add table
							$table = $section->addTable('myOwnTableStyle');
							// Add row
							$table->addRow(70);
							// Add cells header
							$table->addCell(2500, $styleCell)->addText($subsegments5_2->name, $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
							$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
							// if($forecast_period =='2023-2030') {
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
							// }
							$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
							$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
							// Add more rows / cells region
							$n =0;
							foreach($child_segments3 as $childsegments3)
							{
								$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
								$styleCellColor = array('bgColor'=>$bg_color);
								$table->addRow();
								$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($childsegments3->name)), 'trStyle', 'pStyle');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								// if($forecast_period =='2023-2030') {
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								// }
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
								// if($forecast_period =='2023-2030') {
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								// }
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
							
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addTextBreak(1);
							$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
							$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
							$section->addTextBreak(1);
						} /* ./ volume based table */
						/* ./ Table Writeup - Sub Segment */	
					}else{
						/* adding figure */					
						$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
						$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
						$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
						$section->addTextBreak(1);
						if($Volume_unit)
						{
							$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
							$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
							$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
							$section->addTextBreak(1);
						}/* ./ adding figure */							
					}
					/********* ./ Adding Sub Segments *************/
					/********* Adding Child Segments *************/
					$child_segments3 = $this->Country_model->get_country_rd_segments($report_id, $subsegments5_2->id);
					if($is_child_segments)
					{					    
						foreach($child_segments3 as $childsegments3)
						{
							$child_segment3 = $childsegments3->name;	
							$section->addListItem(htmlspecialchars($child_segment3), 2, 'childPoint', $listStyle, 'Head 2');
							$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
							$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
							$section->addTextBreak(1);	
							/* Child Segment - Table & Figure Writing started*/								
							/* Sub child segments */
							$sub_child_segments3 = $this->Country_model->get_country_rd_segments($report_id, $childsegments3->id);
							if($sub_child_segments3){	
								/* child segment figure title */
								$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($child_segment3 ))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
								$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
								$section->addTextBreak(1);
								if($Volume_unit)
								{
									$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($child_segment3))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
									$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
									$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
									$section->addTextBreak(1);
								}	
								/* value based table */															
								$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($child_segment3))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'tableNameStyle', 'Table_Title');
								// Add table
								$table = $section->addTable('myOwnTableStyle');
								// Add row
								$table->addRow(70);
								// Add cells
								$table->addCell(2500, $styleCell)->addText(htmlspecialchars($child_segment3), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
								$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
								// if($forecast_period =='2023-2030') {
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
								// }
								$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
								$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
								// Add more rows / cells
								$n =0;								
								foreach($sub_child_segments3 as $subchildsegments31)
								{
									$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
									$styleCellColor = array('bgColor'=>$bg_color);
									$table->addRow();
									$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subchildsegments31->name)), 'trStyle', 'pStyle');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									// if($forecast_period =='2023-2030') {
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									// }
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
								// if($forecast_period =='2023-2030') {
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								// }
								$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
								
								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
								$section->addTextBreak(1);
								$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
								$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
								$section->addTextBreak(1);
								/* /. value based table */
								/* volume based table */
								if($Volume_unit){								
									$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($child_segment3))." BY ".htmlspecialchars(strtoupper($subsegments5_2->name)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Volume_unit).')', 'tableNameStyle', 'Table_Title');
									// Define table style arrays
									$table = $section->addTable('myOwnTableStyle');
									// Add row
									$table->addRow(70);
									// Add cells
									$table->addCell(2500, $styleCell)->addText(htmlspecialchars($child_segment3), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from - 2), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from - 1), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText($forecast_from, $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 1), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 2), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 3), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 4), $fontStyle, 'thStyle');
									$table->addCell(1600, $styleCell)->addText(($forecast_from + 5), $fontStyle, 'thStyle');
									// if($forecast_period =='2023-2030') {
										$table->addCell(1600, $styleCell)->addText(($forecast_from + 6), $fontStyle, 'thStyle');
									// }
									$table->addCell(1600, $styleCell)->addText(($forecast_to), $fontStyle, 'thStyle');			
									$table->addCell(1600, $styleCell)->addText('CAGR %', $fontStyle,'thStyle');
									// Add more rows / cells
									$n = 0;
									// $get_scope_regions3 = $this->RdData_model->get_scope_regions($scope_id); 
									foreach($sub_child_segments3 as $subchildsegments31)
									{
										$bg_color = $n % 2 === 0 ? "D3D3D3" : "white";
										$styleCellColor = array('bgColor'=>$bg_color);
										$table->addRow();
										$table->addCell(2500, $styleCellColor)->addText(htmlspecialchars(ucwords($subchildsegments31->name)), 'trStyle', 'pStyle');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										// if($forecast_period =='2023-2030') {
											$table->addCell(1600, $styleCellColor)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
										// }
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
									// if($forecast_period =='2023-2030') {
										$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									// }
									$table->addCell(1600, $styleLastCell)->addText("XX.X", 'trStyle', 'Table 1_ Right Center');
									
									$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
									$section->addTextBreak(1);
									$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
									$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
									$section->addTextBreak(1);
								} /* /. volume based table */

								/* Sub Child Segments */
								foreach($sub_child_segments3 as $subchildsegments3)
								{
									$subchild_segment3 = $subchildsegments3->name;
									$section->addListItem(htmlspecialchars($subchild_segment3), 3, 'childPoint', $listStyle, 'Head 3');
									$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
									$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');
									$section->addTextBreak(1);		
									/* sample-figure */
									$section->addText(htmlspecialchars(strtoupper($scope_name.' '.$report_name))." BY ".htmlspecialchars(strtoupper($subchild_segment3)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
									$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
									$section->addTextBreak(1);									
									break;
								}
								
								$data['sub_child_segments'] = $this->Country_model->get_country_rd_segments($report_id, $childsegments3->id);	
								
								$m = 1;		
								// var_dump($data['sub_child_segments'][$m]); 
								foreach($data['sub_child_segments'] as $subchildsegments7)
								{											
									$subchildsegments7_3 = $data['sub_child_segments'][$m];
									if($subchildsegments7_3){
										$section->addListItem(htmlspecialchars($subchildsegments7_3->name), 3, 'childPoint', $listStyle, 'Head 3');
										$section->addText('Same as the preceding segment. Full details will be provided in the complete report.', 'noteFontSeg', 'noteStyle');
										$section->addTextBreak(1);
									}
									$m++;							
								} 
								/* ./ Sub Child Segments */
							} else {
								/* Child segment table & figure writing */
								$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($child_segment3)).", ".$analysis_from." - ".$analysis_to.' (USD '.htmlspecialchars($Value_unit).')', 'figureNameStyle', 'Figure _ Title');
								$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
								$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
								$section->addTextBreak(1);
								if($Volume_unit)
								{
									$section->addText(htmlspecialchars(strtoupper($report_name_scope))." BY ".htmlspecialchars(strtoupper($child_segment3)).", ".$analysis_from." - ".$analysis_to.' ('.htmlspecialchars($Volume_unit).')', 'figureNameStyle', 'Figure _ Title');
									$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
									$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
									$section->addTextBreak(1);
								}
							}		
						}
					} 
					/********* ./ End Child Segments *************/
				}
				/********* ./ End Sub Segments *************/
			}
			$section->addPageBreak(1);
			/* ./ Sample Pages Chapter 5 */

			/* Sample Pages Chapter 5 - Company Profile */
			// $section->addListItem('Company Profiles', 0, 'chaptHeading', $listStyle, 'Main Heading');	
			/* $section->addListItem(htmlspecialchars('Competitive Landscape in the '.$report_title), 1, 'subPoint', $listStyle, 'Head 1');
			$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
			$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
			$section->addTextBreak(1);
			$section->addText(htmlspecialchars($report_compitative_landscape), 'r2Style', 'paragraphStyle');
			$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
			$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle'); */
			// $section->addListItem(htmlspecialchars('Companies Profiles'), 1, 'subPoint', $listStyle, 'Head 1');	
			/* $rd_companies=$this->Country_model->get_rd_companies($report_id);	
			foreach($rd_companies as $companies)
			{
				$cmpProfile=$companies->name;	
				$cmpProfile= ltrim(rtrim(ucwords(strtolower($cmpProfile))))." ";				
				// $section->addListItem(htmlspecialchars($cmpProfile), 2, 'childPoint', $listStyle, 'Head 2');				
				$section->addListItem(htmlspecialchars($cmpProfile), 1, 'subPoint', $listStyle, 'Head 1');				
				// $section->addListItem('Overview', 3, 'childSubpoint', $listStyle, 'Head 3');
				$section->addListItem('Overview', 2, 'childPoint', $listStyle, 'Head 2');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);					
				$section->addListItem('Company Snapshot', 2, 'childPoint', $listStyle, 'Head 2');
				//$section->addImage('images/Company_snapshot.png', array('width'=>700, 'height'=>520, 'align'=>'center'));
				$section->addText('Add Company Snapshot Image of '.htmlspecialchars($cmpProfile), 'subPoint', 'sourceStyle');
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Financial Snapshot', 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/sample-figure.png', array('width'=>760, 'height'=>260, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				$section->addTextBreak(1);
				$section->addListItem('Product Portfolio', 2, 'childPoint', $listStyle, 'Head 2');
				$textbox = $section->addTextBox(array('align' => 'center', 'width' => 760, 'height' => 'auto', 'borderSize'  => 1, 'borderColor' => '#000',));
				$textbox->addText(htmlspecialchars('Content removed from the sample'), array('bold'=>false, 'align'=>'center','name'=>'Franklin Gothic Medium','color'=> 'red','size'=>10), 'thStyle');	
				$section->addTextBreak(1);
				$section->addListItem('Recent Developments', 2, 'childPoint', $listStyle, 'Head 2');
				$section->addImage('images/Recent_development_sample.png', array('width'=>760, 'height'=>220, 'align'=>'center'));
				$section->addText('Source: Infinium Global Research Analysis', 'Source Note', 'sourceStyle');
				break;
			}
			$section->addTextBreak(1);
			$rd['companies']=$this->Country_model->get_rd_companies($report_id);
			$c = 1;
			foreach($rd['companies'] as $cmpname){
				$company_names = $rd['companies'][$c];
				if($company_names){
					$section->addListItem(htmlspecialchars($company_names->name), 1, 'subPoint', $listStyle, 'Head 1');
				}
				$c++;							
			}
			$section->addText('(N.B.: Names of companies profiled in the report. Final report will contain the details of each company same as that of the above referenced)', 'noteFontSeg', 'noteStyle');	
			$section->addPageBreak(); */
			$section->addImage('images/our-expertise.jpg', array('width'=>520, 'height'=>600, 'align'=>'center'));
			$section->addPageBreak();				
			$section->addImage('images/infinium_disclaimer.jpg', array('width'=>520, 'height'=>600, 'align'=>'center'));
		/* /. Sample Pages Chapter 5 - Company Profile */
			
            /* ./ ****************** Word File Writing ******************* */

            /* Generate word file */
            $new_file_name=str_replace(" ","-", htmlspecialchars($report_title_scope));			
            $new_file_name=str_replace("/","-", $new_file_name);
            $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
            $filename = "Sample-".htmlspecialchars($new_file_name)."-Report.docx";
            $objWriter->save($filename);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Content-Transfer-Encoding: binary');
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