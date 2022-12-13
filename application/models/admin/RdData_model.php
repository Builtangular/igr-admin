<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RdData_model extends CI_Model {  
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
	/* Monika's Work */	
    public function get_global_rds($status){
		$this->db->select("*");
		$this->db->from("tbl_rd_data");
		$this->db->where('status', $status);
		$sql = $this->db->get();
		// echo $this->db->last_query();	die; 
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
    public function get_single_rd_data($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_data");
		$this->db->where('id', $id);
		$sql = $this->db->get();
		if($sql->num_rows() > 1)
		{	
            return $sql->result_array();
		} else {
			return $sql->row();
		}
	}

    /* ----------- RD2 ----------- */
    public function get_rd2_codedecode_para($type_id)
	{
		$this->db->select("*");
		$this->db->from('tbl_codedecode_type_description');
		$this->db->where(array('type_id'=>$type_id));
		$sql = $this->db->get();
		// echo $this->db->last_query();		
		if($sql->num_rows() > 0){			
			return $sql->row();
		}else{
			return false;
		}
	}
    /* get regions from scope id */
    public function get_scope_regions($scope_id)
	{
		$this->db->select("*");
		$this->db->from('tbl_master_scope');
		$this->db->where(array('parent'=>$scope_id, 'active'=> 1));
		$sql = $this->db->get();
		// echo $this->db->last_query();		
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	/* get RD DRO data */
    public function get_rd_dro($report_id, $type)
	{
		$this->db->select("*");
		$this->db->from('tbl_rd_dro_data');
		$this->db->where(array('report_id'=>$report_id, 'type'=> $type, 'status'=> 1));
		$query = $this->db->get();
		// echo $this->db->last_query();		
		if($query->num_rows() > 0){			
			return $query->result();
		}else{
			return array();
		}
	}
	/* get RD Segments */
    public function get_main_segments($report_id, $parent)
	{
		$this->db->select("*");
		$this->db->from('tbl_rd_segments');
		$this->db->where(array('report_id'=>$report_id, 'parent_id'=> $parent));
		$query = $this->db->get();
		// echo $this->db->last_query();		
		if($query->num_rows() > 0){			
			return $query->result();
		}else{
			return array();
		}
	}
	/* Get RD Companies */
	public function get_rd_companies($report_id)
	{
		$this->db->select("*");
		$this->db->from('tbl_rd_companies');
		$this->db->where(array('report_id'=>$report_id, 'status'=> 1));
		$cquery = $this->db->get();
		// echo $this->db->last_query();		
		if($cquery->num_rows() > 0){			
			return $cquery->result();
		}else{
			return array();
		}
	}
}
?>