<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country_model extends CI_Model {   
    
	public function __construct() 
	{
		  parent::__construct(); 
		  $this->load->database();
		  $this->admindb = $this->load->database('admindb', TRUE);
	}
	public function get_country_master()
	{
		$result = $this->db->get('tbl_country');
		$res = $result->result();
		return $res;
	}
	public function insert_country_record()
	{
		 $data = array(
						'name'    =>$this->input->post('name'),
						'parent'	=>$this->input->post('parent'),
						'active'  =>$this->input->post('status'),
					  );

		 
		$this->db->insert('tbl_country', $data);
		return 1;

   }
   public function get_single_country_data($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_country');
		//echo $this->db->last_query();die;
		return $result->row();
   }
   public function update_country($id)
   {
	   $update = array(
			  'name'=>$this->input->post('name'),
			  'parent'=>$this->input->post('parent'),
			  'active'=>$this->input->post('status')
		   );
	   $this->db->where('id',$id);
	   return $this->db->update('tbl_country', $update);
   }
   public function get_single_parent($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_country');
		//echo $this->db->last_query();die;
		return $result->row();
   }
   function country_delete($id)
   {
		//var_dump('hii');die;
		$this->db->where("id", $id);
		$this->db->delete("tbl_country");
		return true;
   }
   
  
}