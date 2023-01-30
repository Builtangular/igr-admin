<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model {  
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
}
	?>