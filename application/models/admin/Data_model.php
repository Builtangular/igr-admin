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
		$this->db->where('status',1);
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		if($sql->num_rows() > 0)
		{			
			return $sql->result();
		}
		else
		{
			return array();
		}
	}
	function title_exists($key)
	{
		$this->db->like('name',$key);
		$query = $this->db->get('tbl_rd_data');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
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
	// Update Query For RD Data
	public function update_rd_data($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_rd_data', $data);
		// echo $this->db->last_query();	die;
		return $result;
		// return $this->db->affected_rows();
	}
	// Function to Delete selected record from table name.
	public function delete_rd_data($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_rd_data');
		return $result;
	}
	/* Master Tables */
	public function get_category_master(){
		$this->db->select("*");
		$this->db->from("tbl_categories_master");
		$sql = $this->db->get();
		if($sql->num_rows() > 0)
		{			
			return $sql->result();
		}
		else
		{
			return array();
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
	public function get_rd_data($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_data");
		$this->db->where('id',$id);
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		if($sql->num_rows() > 1)
		{			
			return $sql->result_array();
		}
		else
		{
			return $sql->row();
		}
	}
	/* companies */
	public function get_rd_companies($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_companies");
		$this->db->where('report_id',$id);
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function get_rd_company($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_companies");
		$this->db->where('id',$id);
		$query = $this->db->get();
		// echo $this->db->last_query(); die; 
		$result = $query->row();		
		return $result;	
	}	
	public function insert_rd_company_data($postcomp){
		$this->db->trans_start();
		$this->db->insert('tbl_rd_companies', $postcomp);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
	}
	// Update Query For Selected Student
	public function update_rd_company($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_rd_companies', $data);
		// echo $this->db->last_query();	die;
		return $result;
		// return $this->db->affected_rows();
	}
	// Function to Delete selected record from table name students.
	public function delete_rd_company($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_rd_companies');
		return $result;
	}
	/* Segments */
	public function get_rd_segments($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_segments");
		$this->db->where('report_id',$id);
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function insert_rd_segment($postseg){
		$this->db->trans_start();
		$this->db->insert('tbl_rd_segments', $postseg);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
	}
	public function get_rd_segment($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_segments");
		$this->db->where('id',$id);
		$query = $this->db->get();
		// echo $this->db->last_query(); die; 
		$result = $query->row();		
		return $result;	
	}	
	// Update Query For Selected Segment
	public function update_rd_segment($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_rd_segments', $data);
		// echo $this->db->last_query();	die;
		return $result;
		// return $this->db->affected_rows();
	}
	// Function to Delete selected record from table name students.
	public function delete_rd_segment($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_rd_segments');
		return $result;
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
		 $result = $this->db->get('tbl_scope_master');
		 $res = $result->result();
		 return $res;
	}
	public function insert_scope_record()
	{
		$data = array(
			          'name'    =>$this->input->post('name'),
			          'parent'	=>$this->input->post('parent'),
			          'active'  =>$this->input->post('status'),
			        );

		
			$this->db->insert('tbl_scope_master', $data);
			return 1;

    }
	function scope_delete($id)
	{
		//var_dump('hii');die;
		$this->db->where("id", $id);
    	$this->db->delete("tbl_scope_master");
    	return true;
	}
	public function get_single_scope_data($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_scope_master');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	public function update_scope($id)
    {
        $update = array(
            'name'=>$this->input->post('name'),
			'parent'=>$this->input->post('parent'),
			'active'=>$this->input->post('status')
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_scope_master', $update);
    }
	public function get_single_parent($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_scope_master');
		//echo $this->db->last_query();die;
		return $result->row();
	}

}
?>