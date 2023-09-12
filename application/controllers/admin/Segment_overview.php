<?php defined('BASEPATH') OR exit('No direct script access allowed');

// error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Segment_overview extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Segment_model');
		$this->load->model('admin/Data_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
	}
	function index($report_id)
	{	
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('success_code');
			$data['title'] = "Segment Master";
			$data['report_id'] = $report_id;
			$data['list_data'] = $this->Segment_model->get_rd_segment();
			// var_dump($data['report_id']);die;
			$this->load->view("admin/segment_overview/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
	function add($report_id)
	{
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
	
			$data['get_rd_segment'] = $this->Segment_model->get_rd_segment_data($report_id);
			$data['report_id'] = $report_id;
			$data['main_segments'] = $this->Data_model->get_rd_main_segments($report_id);
			$this->load->view("admin/segment_overview/add",$data);
		}else{
			 $this->load->view("admin/login");
		}
	}
	public function insert($report_id)
    {
		if($this->session->userdata('logged_in'))
	 	{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$description=$this->input->post('description');
            $seg_id=$this->input->post('seg_id');
          
            $num = 0;
            foreach($description as $seg_overview)
            {
                if($seg_overview != "" || $seg_overview != null)
                {
                    $Insert_seg_overview=array(
                        'report_id'=>$report_id,			
                        'segment_id'=>$seg_id[$num],
                        'description'=>$description[$num],
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    $result=$this->Segment_model->insert_rd_seg_overview($Insert_seg_overview);
                }
                $num++;
            }
			if($result == 1)
			{
				$this->session->set_flashdata('success_code', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/report');
	 	}
		else
		{
			$this->load->view("admin/login");
		}
    }
	public function edit($report_id)
    {
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['get_rd_segment'] = $this->Segment_model->get_rd_segment_data($report_id);
			$data['segment_overview'] = $this->Segment_model->get_rd_segment_overview($report_id);
			$data['report_id'] = $report_id;
			$data['main_segments'] = $this->Data_model->get_rd_main_segments($report_id);
			// var_dump($data['segment_overview'] );die;
			$this->load->view("admin/segment_overview/edit",$data);
		}else
		{
			$this->load->view("admin/login");
			
		}
    }
	/* public function view($report_id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	

			$data['get_rd_segment'] = $this->Segment_model->get_rd_segment_data($report_id);
			$data['segment_overview'] = $this->Segment_model->get_rd_segment_overview($report_id);
			$data['rd_id'] = $report_id;			
			// $data['list_data'] = $this->Segment_model->get_rd_segment($report_id);
			$this->load->view('admin/segment_overview/edit',$data);			
		}		
		else
		{			
			$this->load->view('admin/login');
		}
	} */
	public function update($report_id)
    {
		// var_dump($_POST);die;
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
						$result=$this->Segment_model->update_rd_single_segment($overview_id[$num1],$seg_id[$num1],$update_seg_overview);
						// var_dump($result);die;
					}
					else{
						$result=$this->Segment_model->delete_rd_dro_segment($overview_id[$num1]);
					}
					$num1++;
				}
	
			/* if($description == ''){
				// echo "hiii"; die;
			$num2  = 0;
			foreach($description as $seg_overview)
				{
					if($seg_overview != "" || $seg_overview != null)
					{						
						$result=$this->Segment_model->delete_rd_dro_segment($overview_id[$num2]);
						// var_dump($result);die;	
					}
					$num2++;
				}die;
			}	 */
			if($description_new){
				// echo "hiii"; die;
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
					$result=$this->Segment_model->insert_rd_seg_overview($Insert_seg_overview);
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
			redirect('admin/report');
			
		}else
		{
			$this->load->view("admin/login");
		}
    }

	function delete($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			
			$data['delete'] = $this->Segment_model->delete_rd_dro_segment($id);
			$this->session->set_flashdata('success_code', 'Data has been delete successfully....!!!');
			redirect('admin/report');
		}else{
			$this->load->view("admin/login");			
		}
	}
}  
    
?>