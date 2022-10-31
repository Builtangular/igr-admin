<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {   
    
	 public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
      public function get_category_master()
      {
            $result = $this->db->get('tbl_categories_master');
            $res = $result->result();
            return $res;
      }
      public function insert_category_record()
      {
           $data = array(
                          'name'    =>$this->input->post('name'),
                          'parent'	=>$this->input->post('parent'),
                          'active'  =>$this->input->post('status'),
                        );
 
           
                $this->db->insert('tbl_categories_master', $data);
                return 1;
 
     }
    
     public function get_single_category_data($id)
     {
 
          $this->db->where('id',$id);
          $result = $this->db->get('tbl_categories_master');
          //echo $this->db->last_query();die;
          return $result->row();
     }
     public function update_category($id)
     {
         $update = array(
                'name'=>$this->input->post('name'),
                'parent'=>$this->input->post('parent'),
                'active'=>$this->input->post('status')
             );
         $this->db->where('id',$id);
         return $this->db->update('tbl_categories_master', $update);
     }
     public function get_single_parent($id)
     {
 
          $this->db->where('id',$id);
          $result = $this->db->get('tbl_categories_master');
          //echo $this->db->last_query();die;
          return $result->row();
     }
     function category_delete($id)
     {
          //var_dump('hii');die;
          $this->db->where("id", $id);
          $this->db->delete("tbl_categories_master");
          return true;
     }
}
?>