<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Segment_model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
	 public function get_rd_segment_data($report_id)
	 {
		$this->db->where(array('report_id'=>$report_id,'parent_id'=>0));
		$result = $this->db->get('tbl_rd_segments');
		$res = $result->result();
		return $res;
	 } 
	 public function get_rd_segment()
	 {
		$this->db->select('tbl_rd_segment_overview.* ,tbl_rd_segments.name');
		// $this->db->where(array('report_id'=>$report_id));
		$this->db->join('tbl_rd_segments','tbl_rd_segments.id = tbl_rd_segment_overview.segment_id');
		$result = $this->db->get('tbl_rd_segment_overview');
		$res = $result->result();
		return $res;
	 }
	 public function insert_rd_seg_overview($postoverview){
	
		$this->db->trans_start();
		$this->db->insert('tbl_rd_segment_overview', $postoverview);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
    }
	public function get_rd_segment_overview($report_id){
		$this->db->where('report_id',$report_id);
		$result = $this->db->get('tbl_rd_segment_overview');
		//echo $this->db->last_query();die;
		return $result->result();
	}
	public function update_rd_single_segment($overview_id, $seg_id,$data){
		$this->db->where(array('id'=>$overview_id, 'segment_id'=>$seg_id));
		// $this->db->where('report_id',$report_id);
		$result =  $this->db->update('tbl_rd_segment_overview', $data);
		// echo $this->db->last_query();	
		return $result;
    }
	function delete_rd_dro_segment($overview_id){
		// $this->db->where("id", $id);
		$this->db->where(array('id'=>$overview_id));
    	$res= $this->db->delete("tbl_rd_segment_overview");
		// echo $this->db->last_query();
		return $res;
	}
	
}
?>