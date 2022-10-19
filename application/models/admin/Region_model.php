<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Region_model extends CI_Model {   
    
	 public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     function get_region_master()
     {
        $result = $this->db->get('tbl_region');
        $res = $result->result();
        return $res;
     }
     public function insert_region_record()
	{
		 $data = array(
						'name'    =>$this->input->post('name'),
						'parent'	=>$this->input->post('parent'),
						'active'  =>$this->input->post('status'),
					  );
		$this->db->insert('tbl_region', $data);
		return 1;

   }
   public function get_single_region_data($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_region');
		//echo $this->db->last_query();die;
		return $result->row();
   }
   public function update_region($id)
   {
	   $update = array(
			  'name'=>$this->input->post('name'),
			  'parent'=>$this->input->post('parent'),
			  'active'=>$this->input->post('status')
		   );
	   $this->db->where('id',$id);
	   return $this->db->update('tbl_region', $update);
   }
   public function get_single_parent($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_region');
		//echo $this->db->last_query();die;
		return $result->row();
   }
   function region_delete($id)
   {
		$this->db->where("id", $id);
		$this->db->delete("tbl_region");
		return true;
   }
   
}
?>