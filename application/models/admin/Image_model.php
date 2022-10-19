<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model {   
    
	 public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     function upload_image($file)
     {
        if($file == "")
		{
			$file = $this->input->post("image_file");
		}
        $data= array (
            'image_file' 		      => $file,
        );
        $result = $this->db->insert('tbl_image',$data);
        return  $result;
     }
     public function update_image($image_id)
     {
         $update = array(
                'image_file'=>$this->input->post('image_file'),
             );
         $this->db->where('id',$image_id);
         return $this->db->update('tbl_image', $update);
     }
     function get_image_data($report_id)
     {
        $this->db->where('report_id', $report_id);
        $result = $this->db->get('tbl_image');
        $res = $result->row();
        return $res;
     }
}
?>