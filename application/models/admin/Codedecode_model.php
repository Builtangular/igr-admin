<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codedecode_model extends CI_Model {   
    
	 public function __construct() 
	 {
		   parent::__construct(); 
		   $this->load->database();
		   $this->admindb = $this->load->database('admindb', TRUE);
	 }
	public function get_codedecode_type()
	{
		 $result = $this->db->get('tbl_codedecode_type');
		 $res = $result->result();
		 return $res;
	}
	public function insert_codedecode_type_record()
	{
		$data = array(
			          'name'    =>$this->input->post('name'),
			          'active'  =>$this->input->post('status'),
			        );

		
			$this->db->insert('tbl_codedecode_type', $data);
			return 1;

    }
	function codedecode_type_delete($id)
	{
		//var_dump('hii');die;
		$this->db->where("id", $id);
    	$this->db->delete("tbl_codedecode_type");
    	return true;
	}
	public function get_single_codedecode_type($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_codedecode_type');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	public function update_codedecode_type($id)
    {
        $update = array(
            'name'=>$this->input->post('name'),
			'active'=>$this->input->post('status')
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_codedecode_type', $update);
    }
	/* Get Codedecode Description */
	public function get_codedecode_description()
	{
		 $result = $this->db->get('tbl_codedecode_type_description');
		 $res = $result->result();
		 return $res;
	}
    public function get_codedecode_type_data()
	{
		 $result = $this->db->get('tbl_codedecode_type');
		 $res = $result->result();
		 return $res;
	}
	public function insert_codedecode_description()
	{
		$data = array(
			          'type_id'    =>$this->input->post('codetype'),
			          'description'    =>$this->input->post('description'),
			          'active'  =>$this->input->post('status'),
			        );

		
			$this->db->insert('tbl_codedecode_type_description', $data);
			return 1;

    }
	function codedecode_description_delete($id)
	{
		//var_dump('hii');die;
		$this->db->where("id", $id);
    	$this->db->delete("tbl_codedecode_type_description");
    	return true;
	}
	public function get_single_codedecode_description($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_codedecode_type_description');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	public function update_codedecode_description($id)
    {
        $update = array(
			'type_id'    =>$this->input->post('codetype'),
            'description'=>$this->input->post('description'),
			'active'=>$this->input->post('status')
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_codedecode_type_description', $update);
    }
	public function get_single_codedecode_decs($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_codedecode_type');
		//echo $this->db->last_query();die;
		return $result->row();
	}
}
?>