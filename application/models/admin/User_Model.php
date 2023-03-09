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
    public function insert_user_login_details($role_id,$role_type){
        $data = array(
            'role_id'               => $role_id,
            'user_type'             => $role_type,
            'head_name'             => $this->input->post('head_name'),
            'full_name'             => $this->input->post('full_name'),
            'mobile_no'             => $this->input->post('mobile_no'),
            'email_id'              => $this->input->post('email_id'),
            'designation'           => $this->input->post('designation'),
            'department'            => $this->input->post('department'),
            'password'              => $this->input->post('password'),
            'created_on'            => date('Y-m-d'),
            'updated_on'            => date('Y-m-d'),
        );
        $result = $this->db->insert('tbl_registered_user_details', $data);
        // $insert_id = $this->db->insert_id();
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
    public function delete_user_data($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_registered_user_details");
		return $res;
    }
}
?>