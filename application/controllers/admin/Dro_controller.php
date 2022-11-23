<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Dro_controller extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
	}
	function index($id)
	{	
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
            
            $data['massage'] = $this->session->userdata('msg');
            $data['report_id']=$id;	
            $data['dro_data'] = $this->Data_model->get_rd_dro_data($id);
            // var_dump($data['dro_data']); die;
            $this->load->view("admin/dro/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add()
	{
		if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['report_id']=$id;	
		    $this->load->view("admin/dro/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
    public function insert($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	

            /* Market Insight Overview */
            /* <!-- Report Definition --> */
            $Report_definition=$this->input->post('Report_definition');
            $Definition=$this->input->post('definition');
          
            $num = 0;
            foreach($Report_definition as $definition)
            {
                if($definition != "" || $definition != null )
                {
                    $Insert_report_definition=array(
                        'report_id'=>$id,			
                        'type'=>$Definition,
                        'description'=>$Report_definition[$num],
                        'status'=>1,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    $insert_report_definition=$this->Data_model->insert_market_insight($Insert_report_definition);
                }
                $num++;
            }
           
            /* <!-- Report Description --> */
            $Report_description=$this->input->post('Report_description');
            $Description=$this->input->post('description');
            $num1 = 0;
            foreach($Report_description as $description)
            {
                if($description != "" || $description != null )
                {
                    $Insert_report_description=array(
                        'report_id'=>$id,			
                        'type'=>$Description,
                        'description'=>$Report_description[$num1],
                        'status'=>1,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    $insert_report_description=$this->Data_model->insert_market_insight($Insert_report_description);
                }
                $num1++;
            }
            /* <!-- Report Executive Summary DRO --> */
            $Executive_summary_DRO=$this->input->post('Executive_summary_DRO');
            $summary_DRO=$this->input->post('summary_DRO');
            $num2 = 0;
            foreach($Report_description as $description)
            {
                if($description != "" || $description != null )
                {
                    $Insert_summary_DRO=array(
                        'report_id'=>$id,			
                        'type'=>$summary_DRO,
                        'description'=>$Executive_summary_DRO[$num2],
                        'status'=>1,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    $insert_summary_DRO=$this->Data_model->insert_market_insight($Insert_summary_DRO);
                }
                $num2++;
            }
             /* <!-- Report Executive Summary DRO --> */
             $Executive_summary_regional_description=$this->input->post('Executive_summary_regional_description');
             $summary_regional_description=$this->input->post('summary_regional_description');
             $num3 = 0;
             foreach($Executive_summary_regional_description as $regional_description)
             {
                 if($regional_description != "" || $regional_description != null )
                 {
                     $Insert_summary_regional_description=array(	
                        'report_id'=>$id,		
                         'type'=>$summary_regional_description,
                         'description'=>$Executive_summary_regional_description[$num3],
                         'status'=>1,                        
                         'updated_at'=>date('Y-m-d H:i:s')
                     );
                     $insert_summary_regional_description=$this->Data_model->insert_market_insight($Insert_summary_regional_description);
                 }
                 $num3++;
             }
			if($insert_report_description || $insert_report_description || $insert_summary_DRO || $insert_summary_regional_description){
				$this->session->set_flashdata("success_code","Market Insight has been inserted successfully..!!!");				
				redirect('admin/market-insight/view/'.$id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Market Insight has not inserted");				
				redirect('admin/market-insight/view/'.$id);
			}
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}   
    public function edit($id)
    {
		if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
			$data['success_code'] = $this->session->userdata('success_code');
			$data['Login_user_name']=$session_data['Login_user_name'];	

			$data['get_scope_data'] = $this->Data_model->get_scope_master();
			$data['single_scope_data'] = $this->Data_model->get_single_scope_data($id);
			$this->load->view("admin/dro/edit",$data);
		}else
		{
			$this->load->view("admin/login");			
		}
    }
	public function update_scope()
	{
        if($this->session->userdata('logged_in'))
		{
            $session_data = $this->session->userdata('logged_in');
            $data['success_code'] = $this->session->userdata('success_code');
            $data['Login_user_name']=$session_data['Login_user_name'];	

            $id = $this->input->post('id');
            $this->Data_model->update_scope($id);
            $data['parent'] = $this->Data_model->get_single_parent($id);
            $this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
            redirect('admin/scope');
        }else
        {
            $this->load->view("admin/login");            
        }		
	}
	function scope_delete($id)
	{
        $session_data = $this->session->userdata('logged_in');
        $data['success_code'] = $this->session->userdata('success_code');
        $data['Login_user_name']=$session_data['Login_user_name'];	

		$data['delete'] = $this->Data_model->scope_delete($id);
		$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
		redirect('admin/scope');
	}
}  
    
?>