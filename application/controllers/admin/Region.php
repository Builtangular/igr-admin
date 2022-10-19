<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Region extends CI_Controller 
{    
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Region_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
	function index()
	{	
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
		$data['title'] = "Region Master";
		$data['list_region'] = $this->Region_model->get_region_master();
		//print_r($data);exit();
		$this->load->view("admin/region/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function add()
    {
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['get_region_data'] = $this->Region_model->get_region_master();
        $this->load->view("admin/region/add",$data);
        }else{
             $this->load->view("admin/login");
        }
    }
    public function insert_region()
	{
		if($this->session->userdata('logged_in'))
	 	{
			$result = $this->Region_model->insert_region_record();
			//var_dump($result);die;
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}	
            redirect('admin/region');
		}else
        {
			$this->load->view("admin/login");
		}
	}
    public function edit($id)
    {
		if($this->session->userdata('logged_in'))
		{
			$data = $this->session->userdata('logged_in');
			$data['get_region_data'] = $this->Region_model->get_region_master();
			$data['single_region_data'] = $this->Region_model->get_single_region_data($id);
			$this->load->view("admin/region/edit",$data);
		}else{
			$this->load->view("admin/login");
			
		}
    }
    public function update_region()
	{
		$id = $this->input->post('id');
		$this->Region_model->update_region($id);
		$data['parent'] = $this->Region_model->get_single_parent($id);
        $this->session->set_flashdata('msg','Data has been updated successfully');
		redirect('admin/region');
	
	}
    function region_delete($id)
	{
		//var_dump($id);die;
		$data['delete'] = $this->Region_model->region_delete($id);
        $this->session->set_flashdata('msg','Data has been deleted successfully');
		redirect('admin/region');
		

	}


}  
    
?>