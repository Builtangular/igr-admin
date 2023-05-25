<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {   
    
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
    public function get_user_details(){
        $this->db->select('*');
        $this->db->from('tbl_registered_user_details');
        $query = $this->db->get();
        return $query->result(); 
    }    
    public function insert_user_register_details($data){
        $result = $this->db->insert('tbl_registered_user_details', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        
    }
    public function insert_user_login_details($data){
        $result = $this->db->insert('tbl_user_login_details', $data);
        return $result;
        
    }
    public function get_user_role_record(){
        $this->db->select('*');
        $this->db->from('tbl_user_role');
        $query = $this->db->get();
        return $query->result(); 
    }
    public function get_single_user_role_record($id){
        $this->db->select('*');
        $this->db->from('tbl_user_role');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }
    public function get_single_user($role_id){
        $this->db->select('*');
        $this->db->from('tbl_registered_user_details');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get();
        return $query->row(); 
    }
    public function get_user_role_details(){
        $this->db->select('*');
        $this->db->from('tbl_user_role');
        $query = $this->db->get();
        return $query->result(); 
    }
    public function get_single_user_data($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_registered_user_details');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function update_user_data($update,$id){
        $this->db->where('id',$id);
        return $this->db->update('tbl_registered_user_details', $update);
    }
    public function update_user_details($update_user_details,$id){
        $this->db->where('user_id',$id);
        return $this->db->update('tbl_user_login_details', $update_user_details);
    }
    public function delete_user_data($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_registered_user_details");
		return $res;
    }
}
?>