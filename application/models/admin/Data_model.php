<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {   
    
	 public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
	/* Monika's Work */	
	public function get_global_rds(){
		$this->db->select("*");
		$this->db->from("tbl_rd_data");
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		if($sql->num_rows() > 0)
		{			
			return $sql->result();
		}
		else
		{
			return $sql->row();
		}
	}
	public function insert_rd_data($postdata){
		$this->db->trans_start();
		$this->db->insert('tbl_rd_data', $postdata);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
	}
	public function get_category_master(){
		$this->db->select("*");
		$this->db->from("tbl_categories");
		$sql = $this->db->get();
		if($sql->num_rows() > 0)
		{			
			return $sql->result();
		}
		else
		{
			return $sql->row();
		}
	}
	/* last sku */
	public function get_report_count()
	{
		$this->db->select("sku");
		$this->db->from("tbl_rd_data");
		$this->db->limit(1);
		$this->db->order_by('id',"DESC");
		$query = $this->db->get();
		// echo $this->db->last_query(); die; 
		$result = $query->row();		
		return $result;		
	}
	/* companies */
	public function get_rd_companies($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_companies");
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return $sql->row();
		}
	}
	/******** pooja work ***************/
	function count_global_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_global_reports');
		$result = $result->num_rows();
		return $result;
	}
	function count_country_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_country_reports');
		$result = $result->num_rows();
		return $result;
	}
	function count_region_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_regional_reports');
		$result = $result->num_rows();
		return $result;
	}
	function count_infographics_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_infographics_data');
		$result = $result->num_rows();
		return $result;
	}
	public function get_scope_master()
	{
	     $this->db->where("active", '1');
		 $result = $this->db->get('tbl_scope');
		 $res = $result->result();
		 return $res;
	}
	
}
?>