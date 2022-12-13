<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drotype_model extends CI_Model {   
	 public function __construct(){
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
	public function get_dro_type(){
		 $result = $this->db->get('tbl_master_drotype');
		 $res = $result->result();
		 return $res;
	}	
	public function insert_dro_type_record(){
		$data = array(
			'name'      =>$this->input->post('name'),
			'status'    =>$this->input->post('status'),
		);
		$res = $this->db->insert('tbl_master_drotype', $data);
		return $res;
    }
	public function get_single_dro_type($id){
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_master_drotype');
		//echo $this->db->last_query();die;
		return $result->row();
	}public function update_dro_type($id){
        $update = array(
            'name'=>$this->input->post('name'),
			'status'=>$this->input->post('status')
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_master_drotype', $update);
    }function dro_type_delete($id){
		$this->db->where("id", $id);
    	$res = $this->db->delete("tbl_master_drotype");
		return $res;
	}
	
	/* RD DRO Records Operations */
	public function get_rd_dro_data($report_id){
		$this->db->select('tbl_rd_dro_data.* ,tbl_master_drotype.name');
		$this->db->join('tbl_master_drotype','tbl_master_drotype.name = tbl_rd_dro_data.type');
		$this->db->where('report_id',$report_id);
		//$this->db->order_by('id',"desc");
	    $result = $this->db->get('tbl_rd_dro_data');
		$res = $result->result();
		return $res;
		//  $this->db->where('report_id',$report_id);
		//  $result = $this->db->get('tbl_rd_dro_data');
		//  $res = $result->result();
		//  return $res;
	}
	public function insert_rd_dro_records($report_id){
		$data = array(
				'type'      	=>$this->input->post('type'),
				'report_id'     =>$report_id,
				'description'	=>$this->input->post('description'),
				'status'        =>$this->input->post('status'),
			);
			$res= $this->db->insert('tbl_rd_dro_data', $data);
			return $res;
    }
	public function get_rd_single_dro($id){
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_rd_dro_data');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	public function update_rd_single_dro($id){
        $update = array(
            'type'          =>$this->input->post('type'),
			'description'	=>$this->input->post('description'),
			'status'        =>$this->input->post('status')
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_rd_dro_data', $update);
    }
	function delete_rd_dro_data($id){
		$this->db->where("id", $id);
    	$res= $this->db->delete("tbl_rd_dro_data");
		return $res;
	}

}
?>