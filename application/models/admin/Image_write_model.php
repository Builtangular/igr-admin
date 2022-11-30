<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_write_model extends CI_Model {   
    
	 public function __construct() {
		   parent::__construct(); 
		   $this->load->database();
	 }
     function upload_image($file){
        if($file == ""){
			$file = $this->input->post("image_file");
		}
        $data= array (
            'image_file' 		      => $file,
        );
        $result = $this->db->insert('tbl_image_text_write',$data);
        return  $result;
     }
     function get_image_data(){
        $this->db->select('*');
        $this->db->from('tbl_image_text_write');
      //   $this->db->order_by("id", "DESC");
        $this->db->where('id', 1);
        $result = $this->db->get();
      //   echo $this->db->last_query();die;
        return $result->row();
     }
     function get_text_data(){
        $this->db->select('*');
        $this->db->from('tbl_rd_data');
        $this->db->where('id', 1);
        $result = $this->db->get();
        // echo $this->db->last_query();die;
        return $result->row();
     }
     
   
    
    
     
  
}
?>