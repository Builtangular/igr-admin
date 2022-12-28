<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Report extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
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
			/* automated url */
			$report_title=strtolower($this->input->post('name'));
			$report_title_new=str_replace( array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $report_title);
			$encoded_report_title= urldecode($report_title_new);	
			$encoded_report_url = str_replace(' ','-', $encoded_report_title);
			$new_report_url = str_replace('--','-', strtolower($encoded_report_url));
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
					'singleuser_price'=>$this->input->post('single_user'),
					'enterprise_price'=>$this->input->post('enterprise_user'),
					'datasheet_price'=>$this->input->post('datasheet'),
					'cagr_market_value'=>$this->input->post('market_value'),
					/* 'report_definition'=>$this->input->post('Report_definition'), */
					/* 'report_description'=>$this->input->post('Report_description'),
					'executive_summary_DRO'=>$this->input->post('Executive_summary_DRO'),
					'executive_summary_regional_description'=>$this->input->post('Executive_summary_regional_description'), */
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
				redirect('admin/report');
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not inserted");				
				redirect('admin/report');
			}		
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
			$data['singleuser_price']= $rd_data->singleuser_price;
			$data['enterprise_price']= $rd_data->enterprise_price;
			$data['datasheet_price']= $rd_data->datasheet_price;
			$data['cagr_market_value']= $rd_data->cagr_market_value;
			/* $data['report_definition']= $rd_data->report_definition; */
			/* $data['report_description']= $rd_data->report_description;
			$data['executive_summary_DRO']= $rd_data->executive_summary_DRO;
			$data['executive_summary_regional_description']= $rd_data->executive_summary_regional_description; */
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
				'singleuser_price'=>$this->input->post('single_user'),
				'enterprise_price'=>$this->input->post('enterprise_user'),
				'datasheet_price'=>$this->input->post('datasheet'),
				'cagr_market_value'=>$this->input->post('market_value'),
				'report_definition'=>$this->input->post('Report_definition'),
				'report_description'=>$this->input->post('Report_description'),
				'executive_summary_DRO'=>$this->input->post('Executive_summary_DRO'),
				'executive_summary_regional_description'=>$this->input->post('Executive_summary_regional_description'),
				'largest_region'=>$this->input->post('Largest_region'),
				'created_user'=>$session_data['Login_user_name'],
				'country_status'=>$this->input->post('country_status'),
				'status'=>$this->input->post('status'),
				'updated_at'=> date('Y-m-d')
			);	
			$result = $this->Data_model->update_rd_data($report_id,$updatedata);
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
				$this->session->set_flashdata("success_code", "Report has been deleted successfully..!!!");				
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");		
			}		
			redirect('admin/report/');
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
			$data['singleuser_price']= $rd_data->singleuser_price;
			$data['enterprise_price']= $rd_data->enterprise_price;
			$data['datasheet_price']= $rd_data->datasheet_price;
			$data['cagr_market_value']= $rd_data->cagr_market_value;
			/* $data['report_definition']= $rd_data->report_definition; */
			/* $data['report_description']= $rd_data->report_description;
			$data['executive_summary_DRO']= $rd_data->executive_summary_DRO;
			$data['executive_summary_regional_description']= $rd_data->executive_summary_regional_description; */
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
			}else if ($request == 'Verified'){
				$status = 2;
			}
			else if ($request == 'Process'){
				$status = 1;
			}
			else{
				$status = $this->input->post('status');
			}
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
				'singleuser_price'=> $this->input->post('single_user'),
				'enterprise_price'=> $this->input->post('enterprise_user'),
				'datasheet_price'=> $this->input->post('datasheet'),
				'cagr_market_value'=> $this->input->post('market_value'),
				/* 'report_definition'=> $this->input->post('Report_definition'),
				'report_description'=> $this->input->post('Report_description'),
				'executive_summary_DRO'=> $this->input->post('Executive_summary_DRO'),
				'executive_summary_regional_description'=> $this->input->post('Executive_summary_regional_description'), */
				'largest_region'=> $this->input->post('Largest_region'),
				'created_user'=> $session_data['Login_user_name'],
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
			// die; 
			if($request == 'Publish'){
				$this->session->set_flashdata("success_code","Report: ".$title." has been published successfully..!!!");
				redirect('admin/report');
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
}
?>