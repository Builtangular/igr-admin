<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Country_segment extends CI_Controller 
{    
	public function __construct()
	{		
		parent::__construct();		
		$this->load->library('form_validation');		
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
			$data['segments']= $this->Country_model->get_rd_segments($id);
			$data['main_segments']= $this->Country_model->get_rd_main_segments($id);
			$this->load->view('admin/country_rd/segment/list',$data);			
		}
		else
		{			
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

			$data['report_id']=$id;	
            $data['segments']= $this->Country_model->get_rd_segments($id);
			$this->load->view('admin/country_rd/segment/add',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function insert($id)
	{
        // var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
			$button_type = $this->input->post('button');
            if($button_type == 'Finish'){                
                redirect('admin/country_segment/'.$id);
            }else{
                $postseg=array(				
                    'name'=>$this->input->post('name'),
                    'parent_id'=>$this->input->post('parent'),
                    'report_id'=>$id,
                    'created_at'=> date('Y-m-d'),
                    'updated_at'=> date('Y-m-d')
                );
                $inserted_id = $this->Country_model->insert_rd_segment($postseg);
                if($inserted_id){
                    $this->session->set_flashdata("success_code","Data has been inserted successfully..!!!");	
                }else{
                    $this->session->set_flashdata("success_code","Sorry! Data has not inserted");		
                }
                redirect('admin/country_segment/add/'.$id);
            }
		}
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function edit($seg_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
			$segment = $this->Country_model->get_rd_segment($seg_id);            
			$data['seg_id']= $segment->id;
			$data['seg_name']= $segment->name;
            $data['report_id']= $segment->report_id;
            $data['parent_id']= $segment->parent_id;
			$data['segments']= $this->Country_model->get_rd_segments($data['report_id']);
			// var_dump($data['segments']); die;
			$this->load->view('admin/country_rd/segment/edit',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function update($seg_id)
	{
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
            $report_id = $this->input->post('report_id');
			$postcseg=array(				
				'name'=>$this->input->post('name'),
				'parent_id'=>$this->input->post('parent'),
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$result = $this->Country_model->update_rd_segment($seg_id,$postcseg);

			/* Update RD Title */
			// if($result == 1){
				
			// 	$rd_data = $this->Country_model->get_rd_data($report_id);
			// 	$scope_id = $rd_data->scope_id;
			// 	$report_title = $rd_data->title;
			// 	$forecast_to = $rd_data->forecast_to;
			// 	/* Get Scope of title */
			// 	$ScopeList = $this->Country_model->get_scope_master();				
			// 	foreach($ScopeList as $scope){
			// 		if($scope->id == $scope_id){
			// 			$scope_name = $scope->name;
			// 		}
			// 	}
			// 	$MainSegments = $this->Country_model->get_main_segments($report_id);
			// 	// var_dump($MainSegments); die;
			// 	foreach($MainSegments as $segments)
			// 	{
			// 		$mainseg[] = $segments['name'];		
			// 		$segment_details.= ltrim(rtrim($segments['name']))." - ";	
			// 		$SubSegments=$this->Country_model->get_sub_segments($report_id, $segments['id']);
			// 		foreach($SubSegments as $sub_seg)
			// 		{
			// 			$sub_seg1[] = $sub_seg['name'];					
			// 		}
			// 		$j= count($sub_seg1);
			// 		for($i = 0; $i< $j ; $i++)
			// 		{
			// 			if($i == $j-2)
			// 			{
			// 				$segment_details.= ltrim(rtrim($sub_seg1[$i])).", and ";
			// 			}
			// 			if($i == $j-1)
			// 			{
			// 				$segment_details.= ltrim(rtrim($sub_seg1[$i]))."; ";
			// 			}
			// 			if($i < $j-2)
			// 			{
			// 				$segment_details.= ltrim(rtrim($sub_seg1[$i])).", ";
			// 			}						
			// 		}	
			// 		unset($sub_seg1);
			// 	}
			// 	unset($mainseg);
				
			// 	$Report_title = htmlspecialchars($report_title)." (".$segment_details."): ";
			// 	$Report_title_1 = array_shift(explode('; )', $Report_title));
			// 	$Report_title_2 = str_replace('And','and',ltrim(rtrim($Report_title_1)));
			// 	if($scope_name == 'Global'){
			// 		$report_full_title = $Report_title_2."): ".$scope_name." Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
			// 	} else {
			// 		$report_full_title = $scope_name.' '.$Report_title_2."): Industry Analysis, Trends, Size, Share and Forecasts to ".$forecast_to;
			// 	}
			// 	$update_rd_title = array(
			// 		'report_id' => $report_id,
			// 		'rd_title' => $report_full_title,
			// 		'updated_at' => date('Y-m-d')
			// 	);
			// 	$result = $this->Country_model->update_published_rd_title($report_id, $update_rd_title);			
			// }
			/* ./ Update RD Title */
			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");
			}
            redirect('admin/country_segment/'.$report_id);
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	public function delete($seg_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
            $report_id = $this->input->post('report_id');			
			$result = $this->Country_model->delete_rd_segment($seg_id);
			if($result){
				$this->session->set_flashdata("success_code","Record has been deleted successfully..!!!");				
				redirect('admin/segment/'.$report_id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");				
				redirect('admin/segment/'.$report_id);
			}	
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	}
	/* Segment Overview Start */
	public function overview($report_id){
		// var_dump($_SESSION); die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('success_code');

			$data['title'] = "Segment Overview";
			$data['report_id'] = $report_id;
			$data['get_rd_segment'] = $this->Country_model->get_rd_main_segments($report_id);
			// var_dump($data['list_data']); die;
			$this->load->view("admin/country_rd/segment/overview/add", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	/* function overview_add($report_id)
	{
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['get_rd_segment'] = $this->Segment_model->get_rd_segment_data($report_id);
			$data['report_id'] = $report_id;
			$this->load->view("admin/segment_overview/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	} */
	public function overview_insert($report_id)
    {
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$description = $this->input->post('description');
            $seg_id = $this->input->post('seg_id');
          
            $num = 0;
            foreach($description as $seg_overview)
            {
                if($seg_overview != "" || $seg_overview != null)
                {
                    $Insert_seg_overview=array(
                        'report_id'=>$report_id,			
                        'segment_id'=>$seg_id[$num],
                        'description'=>$description[$num],
                        'created_at'=>date('Y-m-d'),
                        'updated_at'=>date('Y-m-d')
                    );
                    $result=$this->Country_model->insert_rd_seg_overview($Insert_seg_overview);
                }
                $num++;
            }
			if($result == 1)
			{
				$this->session->set_flashdata('success_code', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/country_rd/drafts');
	 	}
		else
		{
			$this->load->view("admin/login");
		}
    }
	public function overview_edit($report_id)
    {
		// echo $report_id; die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['get_rd_segment'] = $this->Country_model->get_rd_main_segments($report_id);			
			$data['segment_overview'] = $this->Country_model->get_rd_segment_overview($report_id);
			// var_dump($data['segment_overview']); die;
			$data['report_id'] = $report_id;
			$this->load->view("admin/country_rd/segment/overview/edit", $data);
		}
		else
		{
			$this->load->view("admin/login");			
		}
    }
	public function overview_update($report_id)
    {
		// var_dump($_POST); die;
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$description_new=$this->input->post('description_new');
			$seg_id_new=$this->input->post('seg_id_new');
			$overview_id=$this->input->post('overview_id');
			$description=$this->input->post('description');
			$seg_id=$this->input->post('seg_id');		
			// var_dump($description_new); die;
			$num1 = 0;
			foreach($description as $seg_overview)
			{
				if($seg_overview != "" || $seg_overview != null)
				{
					$update_seg_overview=array(						
						'description'=>$description[$num1],
						'updated_at'=>date('Y-m-d H:i:s')
					);
					$result=$this->Country_model->update_rd_single_segment_overview($overview_id[$num1],$seg_id[$num1],$update_seg_overview);
					// var_dump($result);die;
				}
				else{
					$result=$this->Country_model->delete_rd_single_segment_overview($overview_id[$num1]);
				}
				$num1++;
			}
			if($description_new){
				$num = 0;
				foreach($description_new as $seg_overview)
				{
					if($seg_overview != "" || $seg_overview != null)
					{
						$Insert_seg_overview=array(
							'report_id'=>$report_id,			
							'segment_id'=>$seg_id_new[$num],
							'description'=>$description_new[$num],
							'updated_at'=>date('Y-m-d H:i:s')
						);
						$result=$this->Country_model->insert_rd_seg_overview($Insert_seg_overview);
					}
					$num++;
				}
			} 		
			if($result == 1)
			{
				$this->session->set_flashdata('success_code', 'Data has been updated successfully....!!!');				
			}else{
				$this->session->set_flashdata('success_code', 'Sorry! Data has not updated....!!!');	
			}
			redirect('admin/country_rd/drafts');			
		}
		else
		{
			$this->load->view("admin/login");
		}
    }

	function overview_delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->Country_model->delete_rd_single_segment_overview($id);
			$this->session->set_flashdata('success_code', 'Data has been delete successfully....!!!');
			redirect('admin/country_rd/drafts');
		}else{
			$this->load->view("admin/login");			
		}
	}
	/* ./ Segment Overview Start */
}
?>