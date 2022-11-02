<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country_model extends CI_Model {   
    
	public function __construct() 
	{
		  parent::__construct(); 
		  $this->load->database();
	}
	public function get_country_master()
	{
		$this->db->select("*");
		$this->db->from("tbl_country_master");
		$sql = $this->db->get();		
		$res = $sql->result();
		return $res;
	}
	public function insert_country_record()
	{
		 $data = array(
			'name'    =>$this->input->post('name'),
			'parent'	=>$this->input->post('parent'),
			'active'  =>$this->input->post('status'),
			);
		 
		$sql = $this->db->insert('tbl_country_master', $data);
		return $sql;

   }
   public function get_single_country_data($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_country_master');
		//echo $this->db->last_query();die;
		return $result->row();
   }
   public function update_country($id)
   {
	   $update = array(
			  'name'=>$this->input->post('name'),
			  'parent'=>$this->input->post('parent'),
			  'active'=>$this->input->post('status')
		   );
	   $this->db->where('id',$id);
	   return $this->db->update('tbl_country_master', $update);
   }
   public function get_single_parent($id)
   {
		$this->db->select("*");
		$this->db->from("tbl_country_master");
		$this->db->where('id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();die;
		return $result->row();
   }
   function country_delete($id)
   {
		$this->db->where("id", $id);
		$result = $this->db->delete("tbl_country_master");
		return $result;
   }

   /* Genrate country rd  */  
   /* Country Automation */
	public function get_country_rds(){
		$this->db->select("*");
		$this->db->from("tbl_country_rd");
		$this->db->order_by('created_at',"DESC");
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function get_global_rd_data($id){
		$this->db->select("*");
		$this->db->from("tbl_rd_data");
		$this->db->where('id',$id);
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		if($sql->num_rows() > 1)
		{			
			return $sql->result();
		}
		else
		{
			return $sql->row();
		}
	}
	public function get_countries()
	{
		$this->db->select("*");
		$this->db->from("tbl_country_master");
		$sql = $this->db->get();
		// echo $this->db->last_query();	die;
		if($sql->num_rows() > 1)
		{			
			return $sql->result();
		}
		else
		{
			return array();
		}
	}
	
	public function insert_country_rd_details($post_countrydata)
	{
		$this->db->trans_start();		
		$this->db->insert('tbl_country_rd', $post_countrydata);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}
	public function update_country_status($id)
	{
		$update = array(
				'country_status'=>1,
			);
		$this->db->where('id', $id);
		return $this->db->update('tbl_rd_data', $update);
	}
	public function get_country_rd_record()
	{
		 $result = $this->db->get('tbl_country_master');
		 $res = $result->result();
		 return $res;
	
	}
	public function get_single_country_rd_data($id)
	{

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_country_rd');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	public function update_country_rd($id)
    {
        $update = array(
            'title'=>$this->input->post('title'),
			'sku'=>$this->input->post('sku'),			
			'singleuser_price'=>$this->input->post('singleuser_price'),
			'enterprise_price'=>$this->input->post('enterprise_price'),
			'url'=>$this->input->post('url'),
			'country'=>$this->input->post('country'),
			'pages'=>$this->input->post('pages'),
			'status'=>$this->input->post('status')
            );
		// var_dump($update);die;
        $this->db->where('id',$id);
        return $this->db->update('tbl_country_rd', $update);
    }
	function contry_rd_delete($id)
	{
		//var_dump('hii');die;
		$this->db->where("id", $id);
    	$this->db->delete("tbl_country_rd");
    	return true;
	}
	public function get_single_rd_parent($id)
	{
		$this->db->where('id',$id);
		$result = $this->db->get('tbl_country_rd');
		//echo $this->db->last_query();die;
		return $result->row();
	}
	
	public function get_brazil_report_count()
	{	
	$this->db->select("sku");
	$this->db->from("tbl_country_rd");
	$this->db->where('country','brazil');
	$this->db->limit(1);
	$this->db->order_by('id',"DESC");
	$query = $this->db->get();
	$result = $query->row();	
	return $result;	
	}
}
?>