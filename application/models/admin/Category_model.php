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
          $result = $this->db->get('tbl_master_category');
          $res = $result->result();
          return $res;
     }
     public function insert_category_record()
     {
          $data = array(
               'name'    =>$this->input->post('name'),
               'parent'	=>$this->input->post('parent'),
               'active'  =>$this->input->post('status'),
               'created_at'=> date('Y-m-d'),
               'updated_at'=> date('Y-m-d')
          );
          $result = $this->db->insert('tbl_master_category', $data);
          return $result; 
     }    
     public function get_single_category_data($id)
     { 
          $this->db->where('id',$id);
          $result = $this->db->get('tbl_master_category');
          //echo $this->db->last_query();die;
          return $result->row();
     }
     public function update_category($id)
     {
         $update = array(
               'name'=>$this->input->post('name'),
               'parent'=>$this->input->post('parent'),
               'active'=>$this->input->post('status'),
               'updated_at'=> date('Y-m-d')
          );
         $this->db->where('id',$id);
         return $this->db->update('tbl_master_category', $update);
     }
     public function get_single_parent($id)
     { 
          $this->db->where('id',$id);
          $result = $this->db->get('tbl_master_category');
          //echo $this->db->last_query();die;
          return $result->row();
     }
     function category_delete($id)
     {
          $this->db->where("id", $id);
          $this->db->delete("tbl_master_category");
          return true;
     }
}
?>