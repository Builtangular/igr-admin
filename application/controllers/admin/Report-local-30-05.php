<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Report extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
		$this->load->model('admin/RdData_model');
		$this->load->model('admin/Login_model');
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
			$data['title'] = "Published";

			$data['Global_Rds']= $this->Data_model->get_global_rds();
			$this->load->view('admin/report/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function title_exist(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$result = $this->Data_model->title_exists($this->input->get('name'));
			if($result == true){
				$data['message']="<p class=\"text-red\">Title already exists</p>";
			}else{
				$data['message']="";
			}
			$this->load->view('admin/report/title_exists_output', $data);
		}else{			
			$this->load->view('admin/login');
		}
    }
	public function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['scopes_data']= $this->Data_model->get_scope_master();
			$data['category_data']= $this->Data_model->get_category_master();
			$data['Global_Rds']= $this->Data_model->get_global_rds();
			$this->load->view('admin/report/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			/* automated sku */
			$report_sku = $this->Data_model->get_report_count();			
			$sku_code = explode('R', $report_sku->sku);
			$sku = 'IGR'.'0'.($sku_code[1] + 1);

			/* Scope Data */
			$scope_id = $this->input->post('scope');
			$ScopeList = $this->Data_model->get_scope_master();				
            foreach($ScopeList as $scope){
                if($scope->id == $scope_id){
                    $scope_name = $scope->name;
                }
            }
			
			/* automated url */
			$report_title = $scope_name.' '.strtolower($this->input->post('name'));
			$report_title_new = str_replace(array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $report_title);
			$encoded_report_title = urldecode($report_title_new);	
			$encoded_report_url = str_replace("’",'', $encoded_report_title);
			$encoded_report_url1 = str_replace(' ','-', $encoded_report_url);
			$new_report_url = str_replace('--','-', strtolower($encoded_report_url1));
			// echo"----------new_report_url<-------->".$new_report_url."<--------><br><br>"; die;
			$postdata=array(
					'title'=>$this->input->post('title'),
					'name'=>$this->input->post('name'),
					'sku'=>$sku,
					'category_id'=>$this->input->post('category'),
					'scope_id'=>$this->input->post('scope'),
					'url'=>$new_report_url,
					'pages'=> 80,
					'forecast_from'=>$this->input->post('forecast_from'),
					'forecast_to'=>$this->input->post('forecast_to'),
					'analysis_from'=>$this->input->post('analysis_form'),
					'analysis_to'=>$this->input->post('analysis_to'),
					'value_cagr'=>$this->input->post('cagr'),
					'value_unit'=>$this->input->post('value_based_unit'),
					'is_volume_based'=>$this->input->post('volume'),
					'volume_based_unit'=>$this->input->post('volume_based_unit'),
					'volume_based_cagr'=>$this->input->post('volume_cagr'),
					'revenue_start_year'=>$this->input->post('start_year_revenue'),
					'revenue_end_year'=>$this->input->post('end_year_revenue'),
					'singleuser_price'=>$this->input->post('single_user'),
					'enterprise_price'=>$this->input->post('enterprise_user'),
					'datasheet_price'=>$this->input->post('datasheet'),
					'cagr_market_value'=>$this->input->post('market_value'),
					'largest_region'=>$this->input->post('Largest_region'),
					'created_user'=>$session_data['Login_user_name'],
					'status'=>$this->input->post('status'),
					'created_at'=> date('Y-m-d'),
					'updated_at'=> date('Y-m-d')
				);			
			// var_dump($postdata); die;				
			$Last_Inserted_id = $this->Data_model->insert_rd_data($postdata);
			if($Last_Inserted_id){
				$this->session->set_flashdata("success_code","Data has been inserted successfully..!!");
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not inserted");		
			}		
			redirect('admin/report/drafts');
		}		
		else
		{
			$this->load->view('admin/login');
		}		
	}
	/* Edit Rd Data */
	public function edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['scopes_data']= $this->Data_model->get_scope_master();
			$data['category_data']= $this->Data_model->get_category_master();
			$rd_data= $this->Data_model->get_rd_data($id);
			// var_dump($rd_data->enterprise_price); die;
			$data['report_id']= $rd_data->id;
			$data['name']= $rd_data->name;
			$data['title']= $rd_data->title;
			$data['sku']= $rd_data->sku;
			$data['category_id']= $rd_data->category_id;
			$data['scope_id']= $rd_data->scope_id;
			$data['url']= $rd_data->url;
			$data['forecast_from']= $rd_data->forecast_from;
			$data['forecast_to']= $rd_data->forecast_to;
			$data['analysis_from']= $rd_data->analysis_from;
			$data['analysis_to']= $rd_data->analysis_to;
			$data['value_cagr']= $rd_data->value_cagr;
			$data['value_unit']= $rd_data->value_unit;
			$data['is_volume_based']= $rd_data->is_volume_based;
			$data['volume_based_unit']= $rd_data->volume_based_unit;
			$data['volume_based_cagr']= $rd_data->volume_based_cagr;
			$data['start_year_revenue']= $rd_data->revenue_start_year;
			$data['end_year_revenue']= $rd_data->revenue_end_year;
			$data['singleuser_price']= $rd_data->singleuser_price;
			$data['enterprise_price']= $rd_data->enterprise_price;
			$data['datasheet_price']= $rd_data->datasheet_price;
			$data['cagr_market_value']= $rd_data->cagr_market_value;
			$data['largest_region']= $rd_data->largest_region;
			$data['country_status']= $rd_data->country_status;
			$data['status']= $rd_data->status;
			$data['created_user']= $rd_data->created_user;
			$data['updated_at']= $rd_data->updated_at;

			// var_dump($data['parent_id']); die;
			$this->load->view('admin/report/edit',$data);
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* Update Rd Data */
	public function update(){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$report_id = $this->input->post('report_id');
			$country_status = $this->input->post('country_status');
			if($country_status == 0){
				$data['delete'] = $this->Data_model->delete_contry_rds($report_id);
			}
			$rd_status = $this->input->post('status');
			if($rd_status == 0){
				$data['rd_delete'] = $this->Data_model->delete_rd_title($report_id);
			}

			$title = $this->input->post('title');
			$updatedata=array(
				'title'=>$this->input->post('title'),
				'name'=>$this->input->post('name'),
				'sku'=>$this->input->post('sku'),
				'category_id'=>$this->input->post('category'),
				'scope_id'=>$this->input->post('scope'),
				'url'=>$this->input->post('url'),
				'forecast_from'=>$this->input->post('forecast_from'),
				'forecast_to'=>$this->input->post('forecast_to'),
				'analysis_from'=>$this->input->post('analysis_form'),
				'analysis_to'=>$this->input->post('analysis_to'),
				'value_cagr'=>$this->input->post('cagr'),
				'value_unit'=>$this->input->post('value_based_unit'),
				'is_volume_based'=>$this->input->post('volume'),
				'volume_based_unit'=>$this->input->post('volume_based_unit'),
				'volume_based_cagr'=>$this->input->post('volume_cagr'),
				'revenue_start_year'=>$this->input->post('start_year_revenue'),
				'revenue_end_year'=>$this->input->post('end_year_revenue'),
				'singleuser_price'=>$this->input->post('single_user'),
				'enterprise_price'=>$this->input->post('enterprise_user'),
				'datasheet_price'=>$this->input->post('datasheet'),
				'cagr_market_value'=>$this->input->post('market_value'),
				/* 'report_definition'=>$this->input->post('report_definition'),
				'report_description'=>$this->input->post('Report_description'),
				'executive_summary_DRO'=>$this->input->post('Executive_summary_DRO'),
				'executive_summary_regional_description'=>$this->input->post('Executive_summary_regional_description'), */
				'largest_region'=>$this->input->post('Largest_region'),
				// 'created_user'=>$session_data['Login_user_name'],
				'country_status'=>$this->input->post('country_status'),
				'status'=>$this->input->post('status'),
				'updated_at'=> date('Y-m-d')
			);	
			$result = $this->Data_model->update_rd_data($report_id,$updatedata);

			/* Update RD Title */
			if($result == 1){

				$scope_id= $this->input->post('scope');
				$report_title = $this->input->post('title');
				$forecast_to = $this->input->post('forecast_to');
				/* Get Scope of title */
				$ScopeList = $this->Data_model->get_scope_master();
				
				foreach($ScopeList as $scope){
					if($scope->id == $scope_id){
						$scope_name = $scope->name;
					}
				}
				$MainSegments= $this->Data_model->get_main_segments($report_id);
				foreach($MainSegments as $segments)
				{
					$mainseg[] = $segments['name'];		
					$segment_details.= ltrim(rtrim($segments['name']))." - ";	
					$SubSegments=$this->Data_model->get_sub_segments($report_id, $segments['id']);
					foreach($SubSegments as $sub_seg)
					{
						$sub_seg1[] = $sub_seg['name'];					
					}
					$j= count($sub_seg1);
					for($i = 0; $i< $j ; $i++)
					{
						if($i == $j-2)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i])).", and ";
						}
						if($i == $j-1)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i]))."; ";
						}
						if($i < $j-2)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i])).", ";
						}						
					}	
					unset($sub_seg1);
				}
				unset($mainseg);
				
				$Report_title = htmlspecialchars($report_title)." (".$segment_details."): ";
				$Report_title_1 = array_shift(explode('; )', $Report_title));
				$Report_title_2 = str_replace('And','and',ltrim(rtrim($Report_title_1)));
				if($scope_name == 'Global'){
					$report_full_title = $Report_title_2."): ".$scope_name." Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
				} else {
					$report_full_title = $scope_name.' '.$Report_title_2."): Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
				}
				$update_rd_title = array(
					'report_id' => $report_id,
					'rd_title' => $report_full_title,
					'updated_at' => date('Y-m-d')
				);
				$result = $this->Data_model->update_published_rd_title($report_id, $update_rd_title);
			/* ./ Update RD Title */
			}
				if($result){
					$this->session->set_flashdata("success_code","Report: ".$title." has been updated successfully..!!!");
				}else{
					$this->session->set_flashdata("success_code","Sorry! Data has not updated");
				}
			redirect('admin/report');
			// var_dump($updatedata); die;
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function delete($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$result = $this->Data_model->delete_rd_data($id);			
			if($result){
				$result_rd_segment = $this->Data_model->delete_rd_segments_data($id);
				$result_rd_companies = $this->Data_model->delete_rd_companies_data($id);
				$result_rd_market_insight = $this->Data_model->delete_rd_market_insight_data($id);
				$result_rd_dro = $this->Data_model->delete_rd_dro_data($id);
				$result_rd_segment_overview = $this->Data_model->delete_rd_segment_overview_data($id);
				$result_rd_PR2 = $this->Data_model->delete_rd_PR2_data($id);
			}
			if($result){
				$this->session->set_flashdata("success_code", "Report has been deleted successfully..!!!");				
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");		
			}		
			redirect('admin/report/drafts');
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function drafts(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['Global_Rds']= $this->Data_model->get_drafted_global_rds($data['Login_user_name']);
			$this->load->view('admin/draft/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function view($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['scopes_data']= $this->Data_model->get_scope_master();
			$data['category_data']= $this->Data_model->get_category_master();
			$rd_data= $this->Data_model->get_rd_data($id);
			$data['report_id']= $rd_data->id;
			$data['name']= $rd_data->name;
			$data['title']= $rd_data->title;
			$data['sku']= $rd_data->sku;
			$data['category_id']= $rd_data->category_id;
			$data['scope_id']= $rd_data->scope_id;
			$data['url']= $rd_data->url;
			$data['forecast_from']= $rd_data->forecast_from;
			$data['forecast_to']= $rd_data->forecast_to;
			$data['analysis_from']= $rd_data->analysis_from;
			$data['analysis_to']= $rd_data->analysis_to;
			$data['value_cagr']= $rd_data->value_cagr;
			$data['value_unit']= $rd_data->value_unit;
			$data['is_volume_based']= $rd_data->is_volume_based;
			$data['volume_based_unit']= $rd_data->volume_based_unit;
			$data['volume_based_cagr']= $rd_data->volume_based_cagr;
			$data['start_year_revenue']= $rd_data->revenue_start_year;
			$data['end_year_revenue']= $rd_data->revenue_end_year;
			$data['singleuser_price']= $rd_data->singleuser_price;
			$data['enterprise_price']= $rd_data->enterprise_price;
			$data['datasheet_price']= $rd_data->datasheet_price;
			$data['cagr_market_value']= $rd_data->cagr_market_value;
			$data['largest_region']= $rd_data->largest_region;
			$data['country_status']= $rd_data->country_status;
			$data['status']= $rd_data->status;
			$data['created_user']= $rd_data->created_user;
			$data['updated_at']= $rd_data->updated_at;
			/* Market Insight */
			$data['market_insight'] = $this->Data_model->get_rd_market_insight_only($id);	
			/* Segments */
			$data['segments']= $this->Data_model->get_rd_segments($id);
			/* Companies */
			$data['companies']= $this->Data_model->get_rd_companies($id);
			/* DRO */
			$data['dro_data'] = $this->Data_model->get_rd_dro_data($id);
			$this->load->view('admin/draft/edit',$data);
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* To Update complete content of report from executive */
	public function rd_update(){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			// var_dump($data['Login_user_name']);die;
			$report_id = $this->input->post('report_id');
			$request = $this->input->post('request');			
			// var_dump($request);die;
			if($request == 'Publish'){
				$status = 3;
			}else if ($request == 'Verify'){
				$status = 2;
			}else if ($request == 'Process'){
				$status = 1;
			}else{
				$status = $this->input->post('status');
			}
			// var_dump($status); die;
			/* $country_status = $this->input->post('country_status');
			if($country_status == 0){
				$data['delete'] = $this->Data_model->delete_contry_rds($report_id);
			} */
			$title = $this->input->post('title');
			$updatedata=array(
				'title'=> $this->input->post('title'),
				'name'=> $this->input->post('name'),
				'sku'=> $this->input->post('sku'),
				'category_id'=> $this->input->post('category'),
				'scope_id'=> $this->input->post('scope'),
				'url'=> $this->input->post('url'),
				'forecast_from'=> $this->input->post('forecast_from'),
				'forecast_to'=> $this->input->post('forecast_to'),
				'analysis_from'=> $this->input->post('analysis_form'),
				'analysis_to'=> $this->input->post('analysis_to'),
				'value_cagr'=> $this->input->post('cagr'),
				'value_unit'=> $this->input->post('value_based_unit'),
				'is_volume_based'=> $this->input->post('volume'),
				'volume_based_unit'=> $this->input->post('volume_based_unit'),
				'volume_based_cagr'=> $this->input->post('volume_cagr'),
				'revenue_start_year'=> $this->input->post('start_year_revenue'),
				'revenue_end_year'=> $this->input->post('end_year_revenue'),
				'singleuser_price'=> $this->input->post('single_user'),
				'enterprise_price'=> $this->input->post('enterprise_user'),
				'datasheet_price'=> $this->input->post('datasheet'),
				'cagr_market_value'=> $this->input->post('market_value'),
				'largest_region'=> $this->input->post('Largest_region'),
				// 'created_user'=> $this->this->post('username'),
				'country_status'=> $this->input->post('country_status'),
				'status'=> $status,
				'updated_at'=> date('Y-m-d')
			);	
			$result = $this->Data_model->update_rd_data($report_id, $updatedata);
			/* Market Insight */
			$insight_description=$this->input->post('insight_description');
			$insight_type=$this->input->post('insight_type');
			$num = 0;
			if($insight_description){
				foreach($insight_description as $insight)
				{
					$type = $insight_type[$num];
					if($insight != "" || $insight != null)
					{
						$update_insight_description = array(
							'report_id'=>$report_id,
							'description'=>$insight_description[$num],
							'updated_at'=>date('Y-m-d')
						);
						$result = $this->Data_model->update_insight_description($type, $report_id, $update_insight_description);
					}
					$num++;
				}
			}
			/* Segments */
			$segment_name=$this->input->post('segment_name');
			$segment_id=$this->input->post('segment_id');
			$num = 0;
			if($segment_name){
				foreach($segment_name as $segment)
				{					
					if($segment != "" || $segment != null)
					{
						$update_segments_name = array(
							'report_id'=>$report_id,
							'name'=>$segment_name[$num],
							'updated_at'=>date('Y-m-d')
						);
						$id = $segment_id[$num];
						$result = $this->Data_model->update_segments_name($id, $report_id, $update_segments_name);
					}
					$num++;
				}
			}
			/* Companies */
			$company_name=$this->input->post('company_name');
			$company_id=$this->input->post('company_id');
			$num = 0;
			if($company_name){
				foreach($company_name as $company)
				{					
					if($company != "" || $company != null)
					{
						$update_company_name = array(
							'report_id'=>$report_id,
							'name'=>$company_name[$num],
							'updated_at'=>date('Y-m-d')
						);
						$id = $company_id[$num];
						$result = $this->Data_model->update_company_name($id, $report_id, $update_company_name);
					}
					$num++;
				}
			}
			/* DROs */
			$dro_description=$this->input->post('dro_description');
			$dro_id=$this->input->post('dro_id');
			$num = 0;
			if($dro_description){
				foreach($dro_description as $dro)
				{				
					if($dro != "" || $dro != null)
					{
						$update_dro_description = array(
							'report_id'=>$report_id,
							'description'=>$dro_description[$num],
							'updated_at'=>date('Y-m-d')
						);
						$id = $dro_id[$num];
						$result = $this->Data_model->update_dro_description($id, $report_id, $update_dro_description);
					}
					$num++;
				}
			}
			/* To add complete Report title */
			if($status == 3){

				$scope_id= $this->input->post('scope');
				$report_title = $this->input->post('title');
				$forecast_to = $this->input->post('forecast_to');
				/* Get Scope of title */
				$ScopeList = $this->Data_model->get_scope_master();
				
				foreach($ScopeList as $scope){
					if($scope->id == $scope_id){
						$scope_name = $scope->name;
						// var_dump($scope_name);
					}
				}
				$MainSegments= $this->Data_model->get_main_segments($report_id);
				// var_dump($MainSegments); die;
				foreach($MainSegments as $segments)
				{
					$mainseg[] = $segments['name'];					
					// var_dump($mainseg); 
					$segment_details.= ltrim(rtrim($segments['name']))." - ";	
					$SubSegments=$this->Data_model->get_sub_segments($report_id, $segments['id']);
					// var_dump($SubSegments); die;
					foreach($SubSegments as $sub_seg)
					{
						$sub_seg1[] = $sub_seg['name'];					
					}
					$j= count($sub_seg1);
					// var_dump($sub_seg1);
					for($i = 0; $i< $j ; $i++)
					{
						if($i == $j-2)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i])).", and ";
						}
						if($i == $j-1)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i]))."; ";
						}
						if($i < $j-2)
						{
							$segment_details.= ltrim(rtrim($sub_seg1[$i])).", ";
						}						
					}	
					unset($sub_seg1);
				}
				unset($mainseg);
				
				$Report_title = htmlspecialchars($report_title)." (".$segment_details."): ";
				$Report_title_1 = array_shift(explode('; )', $Report_title));
				$Report_title_2 = str_replace('And','and',ltrim(rtrim($Report_title_1)));
				if($scope_name == 'Global'){
					$report_full_title = $Report_title_2."): ".$scope_name." Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
				} else {
					$report_full_title = $scope_name.' '.$Report_title_2."): Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
				}
				$result = $this->Data_model->insert_published_rd_title($report_id, $report_full_title);
			}
			// die; 
			if($status == 3){
				$this->session->set_flashdata("success_code","Report: ".$title." has been published successfully..!!!");
				redirect('admin/report');
			}else if($result && $status == 1){
				$this->session->set_flashdata("success_code","Report: ".$title." has been processed successfully..!!!");
				redirect('analyst/report/processed');
			}else if($result && $status == 2){
				$this->session->set_flashdata("success_code","Report: ".$title." has been verified successfully..!!!");
				redirect('manager/report/processed');
			}else if($result){
				$this->session->set_flashdata("success_code","Report: ".$title." has been updated successfully..!!!");
				redirect('admin/report/drafts');
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");				
				redirect('admin/report/drafts');
			}			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function verified_rd(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['title'] = "Verified";
			$status = 2;
			$data['Global_Rds']= $this->Data_model->get_global_published_rds($status);
			$this->load->view('admin/report/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function assign_rd(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['title'] = "Verified";
			// $status = 3;
			$data['Global_Rds'] = $this->RdData_model->get_global_rd_titles();
			// var_dump($data['Global_Rds']); die;
			$this->load->view('admin/report/assign_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function assign_user($report_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];
			$data['title'] = "Assign User";
			// $status = 3;
			// $data['Global_Rds'] = $this->RdData_model->get_global_rd_titles();
			$data['single_rd_data'] = $this->RdData_model->get_single_rd_data($report_id);
			/* get scope data */
			$ScopeList = $this->Data_model->get_scope_master();	
			// var_dump($data['single_rd_data']); die;
			foreach($ScopeList as $scope){
				if($scope->id == $data['single_rd_data']->scope_id){
					$data['scope_name'] = $scope->name;
				}
			}
			$data['user_details'] = $this->RdData_model->get_user_data();
		   /* ./ get scope data */
			// var_dump($data['user_details']); die;
			$this->load->view('admin/report/assign_user',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_assigned_user($report_id){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['title'] = "Update Assigned User";

			$report_id = $report_id;
			$updatedata = array(
				'created_user'=>$this->input->post('user_name')
			);
			$result = $this->RdData_model->update_rd_user($updatedata, $report_id);
			// echo $result;
			redirect('admin/report/assign_rd');
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>