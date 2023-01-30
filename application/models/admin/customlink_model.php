<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customlink_Model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
     public function get_customlink_data()
     {
        // $this->db->where('report_id',$report_id);
        $result = $this->db->get('tbl_rd_custom_link');
        $res = $result->result();
        return $res;
     }
     public function insert_customlink_data(){
		$data = array(
            'report_id'         =>$this->input->post('report_id'),
            'sku'               =>$this->input->post('sku'),
			'title'             =>$this->input->post('title'),
			'price'             =>$this->input->post('price'),
			'licens_type'       =>$this->input->post('licens_type'),
			'status'            =>$this->input->post('status'),
		);
		$res = $this->db->insert('tbl_rd_custom_link', $data);
		return $res;
    }
    public function get_single_custom_data($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_rd_custom_link');
        $res = $result->result();
        // echo $this->db->last_query();die;
        return $res;
    } 
    public function get_custom_data(){
        $result = $this->db->get('tbl_rd_custom_link');
        $res = $result->result();
        // echo $this->db->last_query();die;
        return $res;
    }
    public function update_custom_link($id){
        $update = array(
            'report_id'         =>$this->input->post('report_id'),
            'sku'               =>$this->input->post('sku'),
            'title'             =>$this->input->post('title'),
			'price'             =>$this->input->post('price'),
			'licens_type'       =>$this->input->post('licens_type'),
			'status'            =>$this->input->post('status'),
            );
            // var_dump($update);die;
        $this->db->where('id',$id);
        $result= $this->db->update('tbl_rd_custom_link', $update);
        // echo $this->db->last_query();die;
        return $result;
    }
    function custom_link_delete($id){
		$this->db->where("id", $id);
    	$res = $this->db->delete("tbl_rd_custom_link");
		return $res;
    }
}
?>