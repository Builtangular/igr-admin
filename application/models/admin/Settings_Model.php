<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Model extends CI_Model {   
    
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
/* Employee tpye management */
    public function insert_emp_type(){
        $data = array(
            'type'                       => $this->input->post('type'),
            'created_at'                 => date('Y-m-d'),
            'updated_at'                 => date('Y-m-d'),
        );
        $result = $this->db->insert('tbl_emp_type', $data);
        return $result;
    }
    public function get_emp_type_details(){
        $this->db->select('*');
        $this->db->from('tbl_emp_type');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_single_type_details($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_type');
        return $result->row();
    }
    public function emp_type_update($id){
        $update = array(        
            'type'                       => $this->input->post('type'),
            'updated_at'                 => date('Y-m-d'),
        );
        $this->db->where('id', $id);
        return $this->db->update('tbl_emp_type', $update);
    }
    public function emp_type_delete($id){
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_emp_type');
        return $result;
    }
/*/. Employee tpye management */

/* Employee Department management */
public function insert_department(){
    $data = array(
        'type'                       => $this->input->post('type'),
        'created_at'                 => date('Y-m-d'),
        'updated_at'                 => date('Y-m-d'),
    );
    // var_dump($data);die;
    $result = $this->db->insert('tbl_emp_department', $data);
    return $result;
}
public function get_emp_department_data(){
    $this->db->select('*');
    $this->db->from('tbl_emp_department');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_emp_department_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_emp_department');
    
    return $result->row();
}
public function emp_department_update($id){
    $update = array(        
        'type'                       => $this->input->post('type'),
        'updated_at'                 => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_emp_department', $update);
}
public function emp_department_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_emp_department');
    return $result;
}
/* /.Employee Department management */

/* Employee Designation management */
public function insert_designations($dept_id,$role_id){
    $data = array(
        'dept_id'                    => $dept_id,
        'role_id'                    => $role_id,
        'designation_type'           => $this->input->post('designation_type'),
        'created_at'                 => date('Y-m-d'),
        'updated_at'                 => date('Y-m-d'),
    );
    var_dump($data);die;
    $result = $this->db->insert('tbl_emp_designation', $data);
    return $result;
}
public function get_single_user_role_data($id){
    $this->db->select('*');
    $this->db->from('tbl_emp_designation');
    $this->db->where('dept_id', $id);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->row(); 
}
public function get_emp_designation_data(){
    // $this->db->select('*');
    // $this->db->from('tbl_emp_designation');
    // $query = $this->db->get();
    // return $query->result();

    $this->db->select('*');
    $this->db->from('tbl_emp_designation');
    // $this->db->where(array('tbl_emp_enrollement.department = tbl_registered_user_details.role_id')); 
    $this->db->join('tbl_emp_department','tbl_emp_designation.dept_id = tbl_emp_department.id');
    // $this->db->order_by('id',"DESC");
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_single_dept_details($dept_id){
    $this->db->where(array('id'=>$dept_id,'status'=>1));
    $result = $this->db->get('tbl_emp_department');
    return $result->row();
}
public function get_single_emp_designation_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_emp_designation');
    return $result->row();
}
public function emp_designations_update($id){
    $update = array(
        'dept_id'                    => $this->input->post('dept_id'),
        'designation_type'           => $this->input->post('designation_type'),
        'updated_at'                 => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_emp_designation', $update);
}
public function emp_designations_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_emp_designation');
    return $result;
}
/* /.Employee Designation management */

/* Employee levels management */
public function insert_emp_levels(){
    $data = array(
        'type'                       => $this->input->post('type'),
        'created_at'                 => date('Y-m-d'),
        'updated_at'                 => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_emp_levels', $data);
    return $result;
}
public function get_emp_levels_data(){
    $this->db->select('*');
    $this->db->from('tbl_emp_levels');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_emp_level_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_emp_levels');
    return $result->row();
}
public function emp_levels_update($id){
    $update = array(        
        'type'                       => $this->input->post('type'),
        'updated_at'                 => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_emp_levels', $update);
}
public function emp_levels_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_emp_levels');
    return $result;
}
/* /.Employee levels management */

/* Employee Leave Type management */
public function insert_leave_type(){
    $data = array(
        'type'                       => $this->input->post('type'),
        'created_at'                 => date('Y-m-d'),
        'updated_at'                 => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_emp_leave_type', $data);
    return $result;
}
public function get_emp_leave_type_data(){
    $this->db->select('*');
    $this->db->from('tbl_emp_leave_type');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_emp_leave_type_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_emp_leave_type');
    return $result->row();
}
public function emp_leave_update($id){
    $update = array(        
        'type'                       => $this->input->post('type'),
        'updated_at'                 => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_emp_leave_type', $update);
}
public function emp_leave_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_emp_leave_type');
    return $result;
}
public function get_single_user_role_record($id){
    $this->db->select('*');
    $this->db->from('tbl_user_role');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row(); 
}
public function get_emp_dept_details(){
    $this->db->select('*');
    $this->db->from('tbl_emp_department');
    $query = $this->db->get();
    return $query->result();
  
 }
/* /.Employee Leave Type management */
}

?>