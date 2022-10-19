<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Report extends CI_Controller 
{    
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_Model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			// var_dump($data['success_code']); die;
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Global_Rds']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/report/list',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function title_exist()
    {
		
		$result = $this->Data_Model->title_exists($this->input->get('name'));
		if($result == true){
			$data['message']="<p class=\"text-red\">Title already exists</p>";
		}else{
			$data['message']="<p class=\"text-red\"></p>";
		}
		$this->load->view('admin/report/title_exists_output', $data);
    }
	public function add()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];				
			$data['scopes_data']= $this->Data_Model->get_scope_master();
			$data['category_data']= $this->Data_Model->get_category_master();
			$data['Global_Rds']= $this->Data_Model->get_global_rds();
			$this->load->view('admin/report/add',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function insert(){
		
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			/* automated sku */
			$report_sku = $this->Data_Model->get_report_count();			
			$sku_code = explode('R', $report_sku->sku);
			$sku = 'IGR'.'0'.($sku_code[1] + 1);
			/* automated url */
			$report_title=strtolower($this->input->post('name'));
			$report_title_new=str_replace( array( '\'', '"', ',' , ';', '<', '>', '-', '(',')' ), ' ', $report_title);
			$encoded_report_title= urldecode($report_title_new);	
			$encoded_report_url = str_replace(' ','-', $encoded_report_title);
			$new_report_url = str_replace('--','-', $encoded_report_url);
			// echo"----------new_report_url<-------->".$new_report_url."<--------><br><br>"; die;
			$postdata=array(
					'title'=>$this->input->post('title'),
					'name'=>$this->input->post('name'),
					'sku'=>$sku,
					'category_id'=>$this->input->post('category'),
					'scope_id'=>$this->input->post('scope'),
					'url'=>$new_report_url,
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
					'status'=>$this->input->post('status'),
					'created_at'=> date('Y-m-d h:i:sa')
				);			
			// var_dump($postdata); die;				
			$Last_Inserted_id = $this->Data_Model->insert_rd_data($postdata);
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
	
}
?>