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
				'email_id'    => $this->input->post('email_id'),
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
        $this->db->select("*");
        $this->db->from('tbl_spam_mail');
        $query = $this->db->get();
        return $query->result();
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
}
?>