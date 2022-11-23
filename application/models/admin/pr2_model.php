<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pr2_model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     public function get_rd_pr2_data($report_id){
		 $this->db->where('report_id',$report_id);
		 $result = $this->db->get('tbl_rd_pr2_data');
		 $res = $result->result();
		 return $res;
	}
    public function insert_rd_pr2_records($report_id)
    {
        $data = array(
            'report_id'        =>$report_id,
            'description'	   =>$this->input->post('description'),
        );
        $res= $this->db->insert('tbl_rd_pr2_data', $data);
        return $res;
    }
    public function get_rd_single_pr2($id){
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_rd_pr2_data');
		//echo $this->db->last_query();die;
		return $result->row();
	}
    public function update_rd_single_pr2($id){
        $update = array(
			'description'	=>$this->input->post('description'),
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_rd_pr2_data', $update);
    }
    public function delete_rd_pr2($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->delete('tbl_rd_pr2_data');
        return $res;
    }
}
