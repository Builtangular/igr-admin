<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Segment extends CI_Controller 
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
	public function index($id)
	{		
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];			
			$data['success_code'] = $this->session->userdata('success_code');

			$data['report_id']=$id;	
			$data['segments']= $this->Data_model->get_rd_segments($id);
			$data['main_segments']= $this->Data_model->get_rd_main_segments($id);
			$this->load->view('admin/segment/list',$data);			
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
            $data['segments']= $this->Data_model->get_rd_segments($id);
			$this->load->view('admin/segment/add',$data);			
		}		
		else
		{			
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
			
			$postseg=array(				
				'name'=>$this->input->post('name'),
				'parent_id'=>$this->input->post('parent'),
				'report_id'=>$id,
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$inserted_id = $this->Data_model->insert_rd_segment($postseg);
			if($inserted_id){
				$this->session->set_flashdata("success_code","Data has been inserted successfully..!!!");	
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not inserted");		
			}
            redirect('admin/segment/'.$id);
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
			
			$segment = $this->Data_model->get_rd_segment($seg_id);
			$data['seg_id']= $segment->id;
			$data['seg_name']= $segment->name;
            $data['report_id']= $segment->report_id;
            $data['parent_id']= $segment->parent_id;
			$data['segments']= $this->Data_model->get_rd_segments($data['report_id']);
			// var_dump($data['segment']); die;
			$this->load->view('admin/segment/edit',$data);			
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
			$result = $this->Data_model->update_rd_segment($seg_id,$postcseg);

			/* Update RD Title */
			if($result == 1){
				
				$rd_data = $this->Data_model->get_rd_data($report_id);
				$scope_id = $rd_data->scope_id;
				$report_title = $rd_data->title;
				$forecast_to = $rd_data->forecast_to;
				/* Get Scope of title */
				$ScopeList = $this->Data_model->get_scope_master();				
				foreach($ScopeList as $scope){
					if($scope->id == $scope_id){
						$scope_name = $scope->name;
					}
				}
				$MainSegments = $this->Data_model->get_main_segments($report_id);
				// var_dump($MainSegments); die;
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
			}
			/* ./ Update RD Title */

			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");				
				redirect('admin/segment/'.$report_id);
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");				
				redirect('admin/segment/'.$report_id);
			}
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
			$result = $this->Data_model->delete_rd_segment($seg_id);
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
}
?>