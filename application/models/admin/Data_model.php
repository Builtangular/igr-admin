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
			return $sql->result_array();
		}
		else
		{
			return $sql->row();
		}
	}
	/* pooja work */
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
	public function insert_scope_record()
	{
		$data = array(
			          'name'    =>$this->input->post('name'),
			          'parent'	=>$this->input->post('parent'),
			          'active'  =>$this->input->post('status'),
			        );

		
			$this->db->insert('tbl_scope', $data);
			return 1;

    }
	function scope_delete($id)
	{
		//var_dump('hii');die;
		$this->db->where("id", $id);
    	$this->db->delete("tbl_scope");
    	return true;
	}
	public function get_single_scope_data($id)
	{

		$this->db->where('id',$id);
		$this->db->where('active','1');
		$result = $this->db->get('tbl_scope');
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
        return $this->db->update('tbl_scope', $update);
    }
	public function get_single_parent($id)
	{

		$this->db->where('id',$id);
		$this->db->where('active','1');
		$result = $this->db->get('tbl_scope');
		//echo $this->db->last_query();die;
		return $result->row();
	}

// function delete_data()
// {
// 	$id = $this->uri->segment(3);
// 	$data = array(
// 			        'is_deleted' => '1'
// 		         ); 

// 	$this->db->where("id", $id);
// 	$this->db->update("tbl_scope", $data);
// 	}
}
?>