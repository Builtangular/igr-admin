<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Image_text_write extends CI_Controller 
{    
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Image_write_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper(array('form', 'url'));		
	}
    function index()
	{	
        if($this->session->userdata('logged_in')){
		$session_data = $this->session->userdata('logged_in');
		$data['Login_user_name']=$session_data['Login_user_name'];	
		$data['Role_id']=$session_data['Role_id'];
		$this->load->view("admin/image_text_upload", $data);
        }else{
            $this->load->view("admin/login");
        }
	}
    public function image_write()
    {
		$file ='';
		$config = array(
			'upload_path' 	=> "assets/admin/img-text",
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
		$result = $this->Image_write_model->upload_image($file);
		$image_data = $this->Image_write_model->get_image_data(); 
		$text_data = $this->Image_write_model->get_text_data();
		$img = imagecreatefromjpeg("assets/admin/img-text/".$image_data->image_file);
		$color = imagecolorallocate($img, 255, 255, 0);  
		$color1 = imagecolorallocate($img, 118, 118, 118);  
		 
		$string_a = $text_data->name;
		$fontSize_a = 20;
		$posX_a = 10;
		$posY_a = 50;
		$angle_a = 0;

		$string_b = $text_data->sku;
		$fontSize_b = 20;
		$posX_b = 1400;
		$posY_b = 60;
		$angle_b = 0;

		$string_c = $text_data->value_cagr;
		$fontSize_c = 20;
		$posX_c = 800;
		$posY_c = 100;
		$angle_c = 0;

		$string_d = $text_data->report_description;
		$fontSize_d = 15;
		$posX_d = 500;
		$posY_d = 400;
		$angle_d = 0;

		$string_e = $text_data->largest_region;
		$fontSize_e = 20;
		$posX_e = 10;
		$posY_e = 800;
		$angle_e = 0;

		$fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!
		imagettftext($img, $fontSize_a, $angle_a, $posX_a, $posY_a, $color, $fontFile, $string_a);
		imagettftext($img, $fontSize_b, $angle_b, $posX_b, $posY_b, $color, $fontFile, $string_b);
		imagettftext($img, $fontSize_c, $angle_c, $posX_c, $posY_c, $color, $fontFile, $string_c);
		imagettftext($img, $fontSize_d, $angle_d, $posX_d, $posY_d, $color, $fontFile, $string_d);
		imagettftext($img, $fontSize_e, $angle_e, $posX_e, $posY_e, $color, $fontFile, $string_e);
		
		$saveToPath = site_url(). 'assets/admin/img-text';
		// var_dump($saveToPath);die;
		imagejpeg($img, $saveToPath );
		header('Content-Type: image/jpeg' );
		imagejpeg($img);
		
		/* readfile( $saveToPath ); */
		
    }
}