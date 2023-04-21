<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query_model extends CI_Model {   
    
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
    /* query management */
    public function get_user_details(){
        $this->db->select('*');
        $this->db->from('tbl_registered_user_details');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_query_details(){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_query_details($data){
        $result = $this->db->insert('tbl_rd_query_data', $data);
        return $result;
       
    }
    public function get_single_query_data($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_rd_query_data');
        return $result->row();
    }
    public function update($id,$Login_user_name){
            $update = array(        
                'source'                     => $this->input->post('source'),
                'source_mail_id'             => $this->input->post('source_mail_id'),
                'scope_name'                 => $this->input->post('scope_name'),
                'report_name'                => $this->input->post('report_name'),
                'client_name'                => $this->input->post('client_name'),
                'designation'                => $this->input->post('designation'),
                'company_name'               => $this->input->post('company_name'),
                'client_email'               => $this->input->post('client_email'),
                'client_message'             => $this->input->post('client_message'),
                'assigned_to'                => $this->input->post('assigned_to'),
                'created_user'               => $Login_user_name,
                'updated_on'                 => date('Y-m-d'),
            );
            $this->db->where('id', $id);
            return $this->db->update('tbl_rd_query_data', $update);
    }
    public function delete($id) {
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_rd_query_data');
        return $result;
    }
/* / .query management */

/* status management */
public function insert_status_details($id){
    $data = array(
        'query_id'                   => $id,
        'status'                     => $this->input->post('status'),
        'licence_price'              => $this->input->post('licence_price'),
        'price'                      => $this->input->post('price'),
        'discount'                   => $this->input->post('discount'),
        'absolute_price'             => $this->input->post('absolute_price'),
        'selling_price'              => $this->input->post('selling_price'),
        'reason'                     => $this->input->post('reason'),
        'created_on'                 => date('Y-m-d'),
        'updated_on'                 => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_sale_status', $data);
    return $result;
}
public function get_status_details($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_sale_status');
    //echo $this->db->last_query(); die;
    return $result->row();
}
public function update_status($id,$status){
    if ($status == "Sale"){
        $update = array(
            'status'                     => $status,
            'licence_price'              => $this->input->post('licence_price'),
            'price'                      => $this->input->post('price'),
            'discount'                   => $this->input->post('discount'),
            'absolute_price'             => $this->input->post('absolute_price'),
            'selling_price'              => $this->input->post('selling_price'),
            'reason'                     => 0,
            'updated_on'                 => date('Y-m-d'),
        );
    }
    if ($status == "Reject"){
        $update = array(
            'status'                     => $status,
            'licence_price'              => Null,
            'price'                      => Null,
            'discount'                   => Null,
            'absolute_price'             => Null,
            'selling_price'              => Null,
            'reason'                     => $this->input->post('reason'),
        );
    }
    $this->db->where('id', $id);
    return $this->db->update('tbl_rd_query_sale_status', $update);
}
public function status_details($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_sale_status');
    return $result->row();
}
/* /.status management */

/* follow up  management */  
public function insert_followup_details($id){
    $data = array(
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'created_on'                  => date('Y-m-d'),
        'updated_on'                  => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_followup', $data);
    return $result;
}
public function get_followup_details($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->result();
}
public function get_single_followup($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}
public function get_view_followup_details($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}
public function delete_followup($id){
    $this->db->where("id", $id);
    $res = $this->db->delete("tbl_rd_query_followup");
    return $res;
} 
public function get_followup_record($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}

/* ./follow up  management */  

/* add single record */
public function insert_record($id){
    $data = array(
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'created_on'                  => date('Y-m-d'),
        'updated_on'                  => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_followup', $data);
    return $result;
}
public function get_query_record($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_data');
    return $result->row();
}
/* ./add single record */

/* get scope record */
public function get_scope_master(){
    // $this->db->where('parent', 0);
    $result = $this->db->get('tbl_master_scope');
    $res = $result->result();
    return $res;
}
/* /.get scope record */

/* Reseller management */
public function insert_reseller_details(){
    $data = array(
        'reseller_name'              => $this->input->post('reseller_name'),
        'reseller_email'             => $this->input->post('reseller_email'),
        'service_no'                 => $this->input->post('service_no'),
        'created_on'                 => date('Y-m-d'),
        'updated_on'                 => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_reseller_data', $data);
    return $result;
   
}
public function get_reseller_details(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_reseller_record($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_reseller_data');
    return $result->row();
}
public function reseller_update($id){
        $update = array(        
            'reseller_name'              => $this->input->post('reseller_name'),
            'reseller_email'             => $this->input->post('reseller_email'),
            'service_no'                 => $this->input->post('service_no'),
            'updated_on'                 => date('Y-m-d'),
        );
        $this->db->where('id', $id);
        return $this->db->update('tbl_rd_query_reseller_data', $update);
}
public function reseller_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_rd_query_reseller_data');
    return $result;
}
public function get_reseller_list(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_reseller_details($reseller_name){
    $this->db->select('*');
    $this->db->where('reseller_name',$reseller_name);
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->row();
}
public function get_single_query_details(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_data');
    $this->db->order_by('id','DESC');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
}
public function update_followup($id)
{
    $update = array(        
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'updated_on'                  => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_rd_query_followup', $update);
}
}
?>