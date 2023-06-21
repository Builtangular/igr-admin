<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Country_rd extends CI_Controller {    
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
			// var_dump($data['Country_Rds']); die;
			$this->load->view('admin/country_rd/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function create($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

            $data['global_rds']= $this->Country_model->get_global_rd_data($id);	
            $rd_title = $data['global_rds']->title;
            $rd_name = $data['global_rds']->name;
            $forecast_to = $data['global_rds']->forecast_to;
            $data['countries'] = $this->Country_model->get_countries();     
			// var_dump($data['countries']);die;       
			$country_title_count = $this->Country_model->get_brazil_report_count();
			// var_dump($country_title_count);die;
			$sku_code = explode('C', $country_title_count->sku);
			// var_dump($sku_code); die;
			$skuno = 1;
			var_dump($skuno); die;
            foreach($data['countries'] as $country_data)
			{
                $Country_name=$country_data->name;	
				$Country_Report_title= $Country_name.' '.htmlspecialchars($rd_title);
                if($Country_name == 'Africa'){
					$sku = 'AF';
					$pages = 60;
					$single_user = 4395;
					$enterprise = 7995;
				}else if ($Country_name == 'Brazil'){
					$sku = 'BZ';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'China'){
					$sku = 'CH';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'France'){
					$sku = 'FR';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Germany'){
					$sku = 'GE';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'India'){
					$sku = 'IN';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Ireland'){
					$sku = 'IR';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Japan'){
					$cat_id = 23;
					$sku = 'JP';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
					$globallicense = 0;
				}else if ($Country_name == 'Russia'){
					$sku = 'RU';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Saudi Arabia'){
					$sku = 'SA';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'South Korea'){
					$sku = 'SK';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'United States'){
					$sku = 'US';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Vietnam'){
					$sku = 'VI';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'United Kingdom'){
					$sku = 'UK';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'United Arab Emirates'){
					$sku = 'UAE';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Poland'){
					$sku = 'PO';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else if ($Country_name == 'Argentina'){
					$sku = 'AR';
					$pages = 40;
					$single_user = 2595;
					$enterprise = 4095;
				}else {
					$sku = 'Gl';
					$pages = 40;
					$single_user = 4795;
					$enterprise = 7195;
				}
				// $sku = 'IGRCTRY';
				$sku = 'IGRC';
				// var_dump($sku);die;
				$Report_code = $sku.'0'.($sku_code[1] + $skuno);
				var_dump($Report_code);die;
				$report_title_new=str_replace( array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $Country_Report_title);
				$encoded_report_title= urldecode($report_title_new);	
				$encoded_report_url = str_replace(' ','-', $encoded_report_title);
				$url = str_replace('--','-', strtolower($encoded_report_url));
				var_dump($url);die;
				$final_country_rd_title = $Country_Report_title.": Prospects, Trends Analysis, Market Size and Forecasts up to ".$forecast_to;
				$post_countrydata = array(
					'report_id'=>$id,
					'title'=>$final_country_rd_title,
					'sku'=>$Report_code,
					'singleuser_price'=>$single_user,
					'enterprise_price'=>$enterprise,
					'url'=>$url,
					'country'=>$Country_name,
					'pages'=>$pages,
					'status' => 1,
				);
				
				$insert_country_rd_details = $this->Country_model->insert_country_rd_details($post_countrydata);
				// var_dump($insert_country_rd_details);die;
				if($insert_country_rd_details){
					$update_record = $this->Country_model->update_country_status($id);
				}
				$skuno++;
            }
           redirect('admin/country_rd');        		
		}else{			
			$this->load->view('admin/login');
		}
    }
	public function edit($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$data['country_rd_data']= $this->Country_model->get_country_rd_record();
			$data['single_country_data'] = $this->Country_model->get_single_country_rd_data($id);
			$this->load->view('admin/country_rd/edit',$data);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_country_rd(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');
			$id = $this->input->post('id');
			$result = $this->Country_model->update_country_rd($id);
			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");	
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");	
			}
			redirect('admin/country_rd');
		}else{			
			$this->load->view('admin/login');
		}
    }
	function contry_rd_delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');
			$data['delete'] = $this->Country_model->contry_rd_delete($id);
			$this->session->set_flashdata('success_code', 'Data has been delete successfully....!!!');
			redirect('admin/country_rd');
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* ********** country rd creation manually ***********/
	public function add(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			// $scope_id = 1;
			// $data['countries'] = $this->Country_model->get_country_master_data();
			$data['category_data']= $this->Data_model->get_category_master();
			// var_dump($data['countries']); die;
			$this->load->view('admin/country_rd/manual/add', $data);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert(){
	    // var_dump($_POST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            
			/* automated sku */
			$country_report_sku = $this->Country_model->get_country_report_count();				
			$sku_code = explode('Y', $country_report_sku->sku);
			$sku = 'IGRCTRY'.'0'.($sku_code[1] + 1);
			/* ./ automated sku */
			/* Country Name */
			$country_name = $this->input->post('country');
			/* $CountryList = $this->Country_model->get_country_master();				
            foreach($CountryList as $country){
                if($country->id == $country_id){
                    $country_name = $country->name;
                }
            } */
           // var_dump($sku); die;	
			/* automated url */
			$report_title = $country_name.' '.strtolower($this->input->post('name'));
			$report_title_new = str_replace(array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $report_title);
			$encoded_report_title = urldecode($report_title_new);	
			$encoded_report_url = str_replace(' ','-', $encoded_report_title);
			$new_report_url = str_replace('--','-', strtolower($encoded_report_url));
			// echo"----------new_report_url<-------->".$new_report_url."<--------><br><br>"; die;
			$postdata=array(
				'name'=>$this->input->post('name'),
				'title'=>$this->input->post('title'),
				'sku'=>$sku,
				'category_id'=>$this->input->post('category'),
				'country'=>$this->input->post('country'),
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
				'datasheet_price'=>0,				
				'status'=>$this->input->post('status'),
				'created_user'=>$session_data['Login_user_name'],
				'created_at'=> date('Y-m-d'),
				'updated_at'=> date('Y-m-d')
			);			
			// var_dump($postdata); die;	
			$Last_Inserted_id = $this->Country_model->insert_country_rd_data($postdata);
			if($Last_Inserted_id){
				$this->session->set_flashdata("success_code","Data has been inserted successfully..!!");
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not inserted");		
			}		
			redirect('admin/country_rd/drafts');

			// var_dump($data['countries']); die;
			$this->load->view('admin/country_rd/manual/add', $data);
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

			$data['Country_rds'] = $this->Country_model->get_drafted_country_rds($data['Login_user_name']);
			// var_dump($data['Country_rds']); die;
			$this->load->view('admin/country_rd/draft/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];

			$data['Country_rds'] = $this->Country_model->get_country_rd_details();
			// var_dump($data['Country_rds']); die;
			$this->load->view('admin/country_rd/draft/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function edit_rd($id){
		// echo $id;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name'] = $session_data['Login_user_name'];
			$data['Role_id'] = $session_data['Role_id'];

			$data['countries'] = $this->Country_model->get_country_master_data();
			$data['category_data'] = $this->Data_model->get_category_master();
			$data['country_rd_data'] = $this->Country_model->get_country_rd_data($id);
			// var_dump($country_rd_data); die;
			$this->load->view('admin/country_rd/manual/edit',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update_rd($id){
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$request = $this->input->post('request');			
			// var_dump($request);die;
			if($request == 'Publish'){
				$status = 3;
			}else{
				$status = $this->input->post('status');
			}
			$updatedata=array(
				'title'=> $this->input->post('title'),
				'name'=> $this->input->post('name'),
				// 'sku'=> $this->input->post('sku'),
				'category_id'=> $this->input->post('category'),
				'country'=> $this->input->post('country'),
				// 'url'=> $this->input->post('url'),
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
				'status'=> $status,
				'updated_at'=> date('Y-m-d')
			);	
			
			$result = $this->Country_model->update_country_rd_data($id, $updatedata);
			// var_dump($updatedata); die;
			$title = $this->input->post('title');
			if($status == 3){
				$this->session->set_flashdata("success_code","Report: ".$title." has been published successfully..!!!");
			}else if($result){
				$this->session->set_flashdata("success_code","Report: ".$title." has been updated successfully..!!!");
			}else{
				$this->session->set_flashdata("success_code","Report: ".$title." has not been updated successfully..!!!");				
			}
			redirect('admin/country_rd/drafts');
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function delete_rd($id){
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$result = $this->Country_model->delete_country_rd_data($id);
			if($result){
				$this->session->set_flashdata("success_code", "Report has been deleted successfully..!!!");				
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not been deleted");		
			}		
			redirect('admin/country_rd/drafts');
		}else{			
			$this->load->view('admin/login');
		}
	}
	/* ********** ./ country rd creation manually ***********/	
}
?>