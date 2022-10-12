<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Report extends CI_Controller 
{    
	// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	public function __construct()
	{
		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Login_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));		
		
	}
}
?>