<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Country_rd extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Country_model');
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
            $scope_id = $data['global_rds']->scope_id;
            $data['countries'] = $this->Country_model->get_countries($scope_id); 
			// var_dump($data['countries']); die;           
			$country_title_count = $this->Country_model->get_brazil_report_count();
			$sku_code = explode('C', $country_title_count->sku);
			// var_dump($sku_code[1]); die;
			$skuno = 1;
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
				$sku = 'IGRC';
				$Report_code = $sku.'0'.($sku_code[1] + $skuno);
				$report_title_new=str_replace( array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $Country_Report_title);
				$encoded_report_title= urldecode($report_title_new);	
				$encoded_report_url = str_replace(' ','-', $encoded_report_title);
				$url = str_replace('--','-', strtolower($encoded_report_url));

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
}
?>