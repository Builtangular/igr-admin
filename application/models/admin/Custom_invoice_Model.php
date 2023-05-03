<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_invoice_Model extends CI_Model { 
    public function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
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
    public function insert_custom_invoice_details($data){
       
        $result = $this->db->insert('tbl_custome_invoice', $data);
        $last_id = $this->db->insert_id();
        // var_dump($last_id);die;
        return $last_id;
    }
    public function insert_invoice_details($data){
       
        $result = $this->db->insert('tbl_custom_invoice_data', $data);
        return $result;
    }
    public function get_single_custome_invoice_details($discount_type){
        $this->db->select('*');
        $this->db->where('discount_type',$discount_type);
        $this->db->from('tbl_custome_invoice');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_custom_details(){
        $this->db->select('*');
        $this->db->from('tbl_custome_invoice');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_single_custom_invoice_data($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_custome_invoice');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function update($id,$update){        
        $this->db->where('id', $id);
        return $this->db->update('tbl_custome_invoice', $update);
     }
     /* public function update_invoice($id,$discount_type,$shipping_customer_name,$shipping_email_id,$invoice_no){
        $update = array(
            'title'                             => $this->input->post('title'),
            'invoice_no'                        => $invoice_no,
            'order_no'                          => $this->input->post('order_no'),
            'order_date'                        => $this->input->post('order_date'),
            'currency'                          => $this->input->post('currency'),
            'reseller_name'                     => $this->input->post('reseller_name'),
            'shipping_customer_name'            => $shipping_customer_name,
            'shipping_email_id'                 => $shipping_email_id,
            'price'                             => $this->input->post('price'),
            'unit_no'                           => $this->input->post('unit_no'),
            'discount_type'                     => $this->input->post('discount_type'),
            'discount_value'                    => $this->input->post('absolute_price'),
            'total_amount'                      => $this->input->post('total_amount'),
            'created_at'                        => date('Y-m-d'),
            'updated_at'                        => date('Y-m-d'),	
        );
        // var_dump($update);die;
        $this->db->where('id', $id);
        return $this->db->update('tbl_custome_invoice', $update);
     } */
     public function get_custom_invoice_records($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_custome_invoice');
        //echo $this->db->last_query(); die;
        return $result->row();
    }
    public function get_custom_invoice_details($id){
        // $this->db->where('order_id',$order_id);
        // $this->db->where(array('order_id' => $id));
        // $result = $this->db->get('tbl_custom_invoice_data');
        // //echo $this->db->last_query(); die;
        // return $result->result_array();

        $this->db->select('*');
        $this->db->where('order_id',$id);
		$this->db->from('tbl_custome_invoice');
		$this->db->join('tbl_custom_invoice_data','tbl_custome_invoice.id=tbl_custom_invoice_data.order_id');
		// $this->db->order_by("tbl_custome_invoice.id", "desc");
		$this->db->limit(3);
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result_array();
    }
    public function get_custom_invoice_data($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_custome_invoice');
        //echo $this->db->last_query(); die;
        return $result->row();
    }
    
}
?>