<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country extends CI_Controller 
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
	function index()
	{	
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
		$data['title'] = "Category Master";
		$data['list_country'] = $this->Country_model->get_country_master();
		//print_r($data);exit();
		$this->load->view("admin/country/list", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function add()
    {
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['get_country_data'] = $this->Country_model->get_country_master();
        $this->load->view("admin/country/add",$data);
        }else{
             $this->load->view("admin/login");
        }
    }
    public function insert_country()
	{
		if($this->session->userdata('logged_in'))
	 	{
			$result = $this->Country_model->insert_country_record();
			//var_dump($result);die;
			if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}	
            redirect('admin/country');
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
			$data['get_country_data'] = $this->Country_model->get_country_master();
			$data['single_country_data'] = $this->Country_model->get_single_country_data($id);
			$this->load->view("admin/country/edit",$data);
		}else{
			$this->load->view("admin/login");
			
		}
    }
    public function update_country()
	{
		$id = $this->input->post('id');
		$this->Country_model->update_country($id);
		$data['parent'] = $this->Country_model->get_single_parent($id);
        $this->session->set_flashdata('msg','Data has been updated successfully');
		redirect('admin/country');
	
	}
    function country_delete($id)
	{
		//var_dump($id);die;
		$data['delete'] = $this->Country_model->country_delete($id);
        $this->session->set_flashdata('msg','Data has been deleted successfully');
		redirect('admin/country');
		

	}


}  
    
?>