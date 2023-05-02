<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genrate_Invoice_Model extends CI_Model { 
    public function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
    public function get_query_details(){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        return $query->result();
    }
    public function get_invoice_details(){
        $this->db->select('*');
        $this->db->from('tbl_order_invoice_data');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_invoice_details($data){
        $result = $this->db->insert('tbl_order_invoice_data', $data);
        return $result;
    }
    public function get_query_records($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_rd_query_data');
        return $result->row();
    }
    public function get_query_record($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_rd_query_data');
        return $result->row();
    }
    public function get_single_invoice_details(){
        $this->db->select('*');
        $this->db->from('tbl_order_invoice_data');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_invoice_records($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_order_invoice_data');
        //echo $this->db->last_query(); die;
        return $result->row();
    }
    public function get_single_invoice_records($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_order_invoice_data');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function update($id){
       $update = array(
        'invoice_title'                     => $this->input->post('invoice_title'),
        'order_date'                        => $this->input->post('order_date'),
        'currency'                          => $this->input->post('currency'),
        'state'                             => $this->input->post('state'),
        'customer_gst_no'                   => $this->input->post('customer_gst_no'),
        'order_no'                          => $this->input->post('order_no'),
        'main_invoice_no'                   => $this->input->post('main_invoice_no'),
        'billing_customer_name'             => $this->input->post('billing_customer_name'),
        'billing_company_name'              => $this->input->post('billing_company_name'),
        'billing_phone_no'                  => $this->input->post('billing_phone_no'),
        'billing_email_id'                  => $this->input->post('billing_email_id'),
        'billing_zipcode'                   => $this->input->post('billing_zipcode'),
        'billing_address1'                  => $this->input->post('billing_address1'),
        'billing_address2'                  => $this->input->post('billing_address2'),
        'billing_city'                      => $this->input->post('billing_city'),
        'billing_state'                     => $this->input->post('billing_state'),
        's_address_billing'                 => $this->input->post('s_address_billing'),
        'shipping_customer_name'            => $this->input->post('billing_customer_name'),
        'shipping_email_id'                 => $this->input->post('billing_email_id'),
        'unit_price'                        => $this->input->post('unit_price'),
        'unit_no'                           => $this->input->post('unit_no'),
        'discount'                          => $this->input->post('percentage'),
        'total_amount'                      => $this->input->post('total_amount'),
        'created_at'                        => date('Y-m-d'),
        'updated_at'                        => date('Y-m-d'),
       );
    //    var_dump($update);die;
       $this->db->where('id', $id);
       return $this->db->update('tbl_order_invoice_data', $update);
    }
    public function delete($id) {
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_order_invoice_data');
        return $result;
    }
  
}