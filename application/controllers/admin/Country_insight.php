<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Country_insight extends CI_Controller 
{    
	public function __construct()
	{		
		parent::__construct();		
		$this->load->library('form_validation');		
		// $this->load->model('admin/Data_model');
		$this->load->model('admin/Country_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	public function index($id)
	{		
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');
			
			$data['report_id']=$id;	
			$this->load->view('admin/country_rd/insight/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function add($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$data['report_id']=$id;	
			$this->load->view('admin/country_rd/insight/add_single',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');
            /* Market Insight Overview */
           
            /* <!-- Report Definition --> */
            $Report_definition=$this->input->post('Report_definition');
            // var_dump($_POST);die;
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
                    $insert_report_definition=$this->Country_model->insert_market_insight($Insert_report_definition);
					// var_dump($insert_report_definition);die;
                }
                $num++;
            }
           
            /* <!-- Report Description --> */
            $Report_description=$this->input->post('Report_description');
			// var_dump($Report_description);die;
            $Description=$this->input->post('description');
			// var_dump($Description);die;
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
					// var_dump($Insert_report_description);die;
                    $insert_report_description=$this->Country_model->insert_market_insight($Insert_report_description);
					// var_dump($insert_report_description);die;
                }
                $num1++;
            }
            /* <!-- Report Executive Summary DRO --> */
            $Executive_summary_DRO=$this->input->post('Executive_summary_DRO');
            $summary_DRO=$this->input->post('summary_DRO');
            $num2 = 0;
            foreach($Executive_summary_DRO as $Executive_summary)
            {
                if($Executive_summary != "" || $Executive_summary != null )
                {
                    $Insert_summary_DRO=array(
                        'report_id'=>$id,			
                        'type'=>$summary_DRO,
                        'description'=>$Executive_summary_DRO[$num2],
                        'status'=>1,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
					// var_dump($Insert_summary_DRO);die;
                    $insert_summary_DRO=$this->Country_model->insert_market_insight($Insert_summary_DRO);
					// var_dump($insert_summary_DRO);
                }
                $num2++;
            }
             /* <!-- Report Executive Summary Regional Description --> 
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
					//  var_dump($Insert_summary_regional_description);die;
                     $insert_summary_regional_description=$this->Country_model->insert_market_insight($Insert_summary_regional_description);
                 }
                 $num3++;
             } */
			/* <!-- Report Competitive Landscape --> */
			$Competitive_landscape_data=$this->input->post('competitive_landscape');
			$competitive_landscape_type=$this->input->post('competitive_landscape_type');
			$num4 = 0;
			foreach($Competitive_landscape_data as $Competitive_landscape)
			{
				if($Competitive_landscape != "" || $Competitive_landscape != null )
                 {
					$Insert_competitive_landscape_data=array(	
                        'report_id'=>$id,		
                        'type'=>$competitive_landscape_type,
                        'description'=>$Competitive_landscape_data[$num4],
                        'status'=>1,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                     );
					 //  var_dump($Insert_summary_regional_description);die;
                     $insert_competitive_landscape_data=$this->Country_model->insert_market_insight($Insert_competitive_landscape_data);
				 }
				 $num4++;
			}

			if($insert_report_description || $insert_report_description || $insert_summary_DRO || $insert_competitive_landscape_data){
				$this->session->set_flashdata("success_code","Market Insight has been inserted successfully..!!!");				
				redirect('admin/country_insight/view/'.$id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Market Insight has not inserted");				
				redirect('admin/country_insight/view/'.$id);
			}
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function view($report_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

            $data['market_insight'] = $this->Country_model->get_rd_market_insight_data($report_id);	
			$data['report_id']=$report_id;	
			$this->load->view('admin/country_rd/insight/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert_single($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            /* Add insight data */
            $Insert_report_insight=array(
                'report_id'=>$id,			
                'type'=> $this->input->post('type'),
                'description'=> $this->input->post('insight_description'),
                'status'=>1,                        
                'updated_at'=>date('Y-m-d H:i:s')
            );
            $insert_insight=$this->Country_model->insert_market_insight($Insert_report_insight);
            if($insert_insight){
				$this->session->set_flashdata("success_code","Market Insight has been inserted successfully..!!!");		
			}else{
				$this->session->set_flashdata("success_code","Sorry! Market Insight has not inserted");				
			}
			redirect('admin/country_insight/view/'.$id);
        }
    }
    public function edit($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$market_insight = $this->Country_model->get_rd_single_market_insight($id);	
            // var_dump($data['market_insight']); die;	
			$data['market_insight_id']= $market_insight->id;
            $data['report_id']= $market_insight->report_id;
			$data['market_insight_type']= $market_insight->type;
			$data['market_insight_description']= $market_insight->description;
            $type_name = explode(" ", $data['market_insight_type']);
            $area_name = str_replace(' ','_', $data['market_insight_type']);
        
			$this->load->view('admin/country_rd/insight/edit',$data);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update($id)
	{
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$report_id = $this->input->post('report_id');
			$postdata=array(				
				'description'=>$this->input->post('insight_description'),
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$result = $this->Country_model->update_rd_market_insight($id,$postdata);
			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");		
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");			
			}
			redirect('admin/country_insight/view/'.$report_id);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$report_id = $this->input->post('report_id');			
			$result = $this->Country_model->delete_rd_insight_para($id);
			if($result){
				$this->session->set_flashdata("success_code","Record has been deleted successfully..!!!");			
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");				
			}	
			redirect('admin/country_insight/view/'.$report_id);
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>