<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spam_Model extends CI_Model {   
    
     public function __construct() 
     {
          parent::__construct(); 
          $this->load->database();
          $this->admindb = $this->load->database('admindb', TRUE);
     }
     public function insert_spam_mail(){
		$data = array(
                'type'        => $this->input->post('type'),
				'email_id'    => ltrim(rtrim($this->input->post('email_id'))),
                'created_at'  => date('Y-m-d'),
                'updated_at'  => date('Y-m-d'),
		);		
        $this->db->insert('tbl_spam_mail', $data);
        return 1;
    }
    public function insert_mail_data($data){
        
        /* $data= array (
            'email_address' => $email_address,
        ); */
        $result = $this->db->insert('tbl_temp_excel_mail',$data);
        return  $result;
    }
    public function Email_list(){
        //$this->db->where('email_id',$email_id);
		 $result = $this->db->get('tbl_temp_excel_mail');
		 $res = $result->result();
		 return $res;
    }
    public function get_temp_email_list() {
        $this->db->select("*");
        $this->db->from('tbl_temp_excel_mail');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_spam_mail_data() {
        $this->db->select("id, type, email_id");
        $this->db->from('tbl_spam_mail');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_single_spam_mail_data($id) {
        $this->db->select("*");
        $this->db->from('tbl_spam_mail');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update_spam_mail($id){
        $update = array(
            'type'        => $this->input->post('type'),
            'email_id'    => $this->input->post('email_id'),
            'updated_at'  => date('Y-m-d'),
        );		
        $this->db->where('id', $id);
        return $this->db->update('tbl_spam_mail', $update);
    }
    public function spam_mail_delete($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_spam_mail');
		return $result;
	}
    public function check_spam_mail($email_address){
        $this->db->select('*');
		$this->db->from('tbl_spam_mail');
        $this->db->where(array('email_id'=>$email_address));
        $query = $this->db->get();
        return $query->row();
    }
    public function check_spam_domain($domain){
        $this->db->select('*');
		$this->db->from('tbl_spam_mail');
        $this->db->where(array('email_id'=>$domain));
        $query = $this->db->get();
        return $query->row();
    }
    public function update_temp_mail($temp_mail_id, $status){
        $update = array(
            'status' =>$status
        );
        $this->db->where('id', $temp_mail_id);
        return $this->db->update('tbl_temp_excel_mail', $update);
    }
    public function get_temp_excel_mail(){
        $result = $this->db->get('tbl_temp_excel_mail');
        $res = $result->result();
        return $res;
    }
   
    public function truncate_temp_tbl(){
       $result =  $this->db->truncate('tbl_temp_excel_mail');
       return $result;
    }
    /* count mail */
    function spam_mail_count(){
		$this->db->where('type','spam');
		$result = $this->db->get('tbl_spam_mail');
		$result = $result->num_rows();
		return $result;
	}
    function unsubscribe_mail_count(){
		$this->db->where('type','unsubscribe');
		$result = $this->db->get('tbl_spam_mail');
		$result = $result->num_rows();
		return $result;
	}
    /* Email Format Work */
    public function insert_mail_format_data($data){
        $this->db->insert('tbl_email_format_data', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function insert_mail_format($data){
        $this->db->insert('tbl_email_format_email', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function mail_format_company_count(){
        $this->db->where('status',1);
		$result = $this->db->get('tbl_email_format_data');
		$final_result = $result->num_rows();
		return $final_result;
    }
    public function mail_format_email_count(){
        $this->db->where('status',1);
		$result = $this->db->get('tbl_email_format_email');
		$final_result = $result->num_rows();
		return $final_result;
    }
    public function get_mail_format_data(){
        $this->db->select('tbl_email_format_email.id, tbl_email_format_data.company_name, tbl_email_format_data.domain, tbl_email_format_email.email_address');
        $this->db->from('tbl_email_format_email');
        $this->db->join('tbl_email_format_data','tbl_email_format_data.id = tbl_email_format_email.comp_id');
        $this->db->order_by('tbl_email_format_email.id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();
    }
    public function get_single_mail_format_data($id){
        $this->db->select('tbl_email_format_email.id, tbl_email_format_email.comp_id, tbl_email_format_data.company_name, tbl_email_format_data.domain, tbl_email_format_email.email_address');
        $this->db->from('tbl_email_format_email');
        $this->db->where('tbl_email_format_email.id', $id);
        $this->db->join('tbl_email_format_data','tbl_email_format_data.id = tbl_email_format_email.comp_id');
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->row();
    }
    public function update_mail_format_data($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('tbl_email_format_data', $data);
    }
    public function update_mail_format_email($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('tbl_email_format_email', $data);
    }
    /* ./ Email Format Work */
}
?>