<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Image extends CI_Controller 
{    
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Image_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));		
		
	}
    function index()
	{	
        if($this->session->userdata('logged_in')){
        $data = $this->session->userdata('logged_in');
        $data['massage'] = $this->session->userdata('msg');
        $report_id = 1;
        $data['image'] = $this->Image_model->get_image_data($report_id); 
        // var_dump($data['image'] );die;

		$this->load->view("admin/image_upload", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    function image_upload()
    {
        // var_dump($_POST); die;
        if($this->session->userdata('logged_in'))
        {
            $file ='';
			$config = array(
				'upload_path' 	=> "assets/admin/img-rd",
				'allowed_types' => "*",
				'encrypt_name'	=> false,
			);
            $this->upload->initialize($config);
			if($this->upload->do_upload('image_file')){
				$data = $this->upload->data();				
				$file = $data['file_name'];
					
			}else{
				$error = array('error' => $this->upload->display_errors());	
				$this->upload->display_errors();
			}
            // var_dump($this->input->post('image_file')); die;
            $image_id = $this->input->post('id');
            //var_dump($image_id);die;
            if($image_id){
                $upload_result = $this->Image_model->update_image($image_id);
            }else{ 
                $result = $this->Image_model->upload_image($file);	
            }
            if($result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}else if($upload_result == 1)
			{
				$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			}else
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/image');
        }
        else
        {
            $this->load->view("admin/login");
        }
    }
}