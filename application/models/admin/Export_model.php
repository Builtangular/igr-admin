<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     public function getlist(){
        $result = $this->db->get('tbl_rd_data');
        $res = $result->result();
        return $res;
   }
   public function getfilterdata($from_date,$to_date){
      $this->db->select('*');
      $this->db->from("tbl_rd_data");
    //   $this->db->where(array('created_at'=>$created_at));
    //   $this->db->where(array('created_at'=> $from_date, $to_date."'));
      $this->db->where('updated_at BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
      $result = $this->db->get();
       //  echo $this->db->last_query();die;
        return $result->result();
 }
 
}	
	 
?>