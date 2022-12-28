<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries_model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     public function get_samplequery_data(){
        $result = $this->admindb->get('igr_sample_request');
        $res = $result->result();
        return $res;
     }
    function get_sample_details($Report_id){
		$this->admindb->select('*');
		$this->admindb->from('igr_sample_request');
		$this->admindb->where(array('Report_id'=>$Report_id,));
		$query = $this->admindb->get();
		// echo $this->admindb->last_query(); die;
		return $query->row();
	}
	/* Toc Queries */
	public function get_tocquery_data(){
		$result = $this->admindb->get('igr_toc_request');
		$res = $result->result();
		return $res;
	}
	public function get_toc_details($Report_id){
		$this->admindb->select('*');
		$this->admindb->from('igr_toc_request');
		$this->admindb->where(array('Report_id'=>$Report_id,));
		$query = $this->admindb->get();
		return $query->row();
	}
	/* customization Queries */
	public function get_customization_data(){
		$result = $this->admindb->get('igr_report_customization_query');
		$res = $result->result();
		return $res;
	}
	public function get_Customization_details($Report_id){
		$this->admindb->select('*');
		$this->admindb->from('igr_report_customization_query');
		$this->admindb->where(array('Report_id'=>$Report_id,));
		$query = $this->admindb->get();
		return $query->row();
	}
	/* Enquiry Queries */
	public function get_enquiry_data(){
		$result = $this->admindb->get('igr_make_report_enquiry');
		$res = $result->result();
		return $res;
	}
	public function get_enquiry_details($Report_id){
		$this->admindb->select('*');
		$this->admindb->from('igr_make_report_enquiry');
		$this->admindb->where(array('Report_id'=>$Report_id,));
		$query = $this->admindb->get();
		return $query->row();
	}
}
?>