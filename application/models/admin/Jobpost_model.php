<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobpost_model extends CI_Model {  
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     public function get_job_data(){
        $result = $this->db->get('tbl_job_post');
        $res = $result->result();
        return $res;
   }
   public function insert_job_data(){
        $data = array(
                'post_name'      => $this->input->post('post_name'),
                'description'    => $this->input->post('description'),
                'positions'      => $this->input->post('positions'),
                'status'         => $this->input->post('status'),
        );
        $this->db->insert('tbl_job_post', $data);
        return 1;
    }
    public function get_single_jobpost_data($id){
        $this->db->where('id',$id);
		$result = $this->db->get('tbl_job_post');
		//echo $this->db->last_query();die;
		return $result->row();

    }
    public function update_jobdata($id) {
        $update = array(
            'post_name'         =>$this->input->post('post_name'),
			'description'       =>$this->input->post('description'),
			'positions'         =>$this->input->post('positions'),
            'status'            =>$this->input->post('status'),
        );
        $this->db->where('id',$id);
        return $this->db->update('tbl_job_post', $update);
    }
    public function jobpost_delete($id){
        $this->db->where("id", $id);
    	$this->db->delete("tbl_job_post");
    	return true;
    }
   
}
?>