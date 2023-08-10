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
		$this->db->from("tbl_master_country");
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
		 
		$sql = $this->db->insert('tbl_master_country', $data);
		return $sql;

   }
   public function get_single_country_data($id)
   {

		$this->db->where('id',$id);
		$result = $this->db->get('tbl_master_country');
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
	   return $this->db->update('tbl_master_country', $update);
   }
   public function get_single_parent($id)
   {
		$this->db->select("*");
		$this->db->from("tbl_master_country");
		$this->db->where('id',$id);
		$result = $this->db->get();
		//echo $this->db->last_query();die;
		return $result->row();
   }
   function country_delete($id)
   {
		$this->db->where("id", $id);
		$result = $this->db->delete("tbl_master_country");
		return $result;
   }
   /* Genrate country rd  */  

   /* country automation */
	public function get_country_rds(){
		$this->db->select("*");
		$this->db->from("tbl_country_rd");
		$this->db->order_by('updated_at',"DESC");
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
		}else{
			return $sql->row();
		}
	}
	
	public function get_countries()
	{
		$this->db->select("*");
		$this->db->from("tbl_master_country");
		$sql = $this->db->get();
		// echo $this->db->last_query();	die;
		if($sql->num_rows() > 1)
		{			
			return $sql->result();
		}else{
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
		 $result = $this->db->get('tbl_master_country');
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
		// $this->db->where('country','brazil');
		$this->db->limit(1);
		$this->db->order_by('id',"DESC");
		$query = $this->db->get();
		$result = $query->row();	
		return $result;	
	}

	/********************* for country rd creation & generation ********************/
	public function get_country_master_data()
	{
		$this->db->select("*");
		$this->db->from("tbl_master_country");
		$this->db->where('active',1);
		$sql = $this->db->get();
		// echo $this->db->last_query();	die;
		if($sql->num_rows() > 1)
		{			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function get_country_report_count()
	{	
		$this->db->select("sku");
		$this->db->from("tbl_country_rd_data");
		// $this->db->where('country','brazil');
		$this->db->limit(1);
		$this->db->order_by('id',"DESC");
		$query = $this->db->get();
		$result = $query->row();	
		// echo $this->db->last_query();	die;
		return $result;	
	}
	public function insert_country_rd_data($postdata){
		$result = $this->db->insert('tbl_country_rd_data', $postdata);
		return $result;
	}
	public function get_drafted_country_rds($Login_user_name){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_data");
		$this->db->where(array('created_user' => $Login_user_name, 'status'=> 0));
		$this->db->order_by('id',"desc");
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function get_country_rd_data($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_data");
		$this->db->where(array('id' => $id, 'status'=> 0));
		// $this->db->order_by('id',"desc");
		$sql = $this->db->get();
		/* echo $this->otherdb->last_query();
		die; */
		return $sql->row();
	}
	public function get_country_rd_details(){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_data");
		// $this->db->where(array('id' => $id));
		$this->db->order_by('id',"desc");
		$sql = $this->db->get();
		/* echo $this->db->last_query();
		die; */
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function update_country_rd_data($id, $updatedata){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_country_rd_data', $updatedata);
		// echo $this->db->last_query();	die;
		return $result;
	}
	public function delete_country_rd_data($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_country_rd_data');
		return $result;
	}
	/* ** Segments ** */
	public function get_rd_segments($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_segments");
		$this->db->where('report_id',$id);
		$sql = $this->db->get();
		// echo $this->db->last_query(); die; 
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function get_rd_main_segments($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_segments");
		$this->db->where(array('report_id' => $id, 'parent_id' => 0));
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		}else{
			return array();
		}
	}
	public function insert_rd_segment($postseg){
		$this->db->trans_start();
		$this->db->insert('tbl_country_rd_segments', $postseg);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query(); die; */
		return $insert_id;
	}
	public function get_rd_segment($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_segments");
		$this->db->where('id',$id);
		$query = $this->db->get();
		// echo $this->db->last_query(); die; 
		$result = $query->row();		
		return $result;	
	}	
	public function update_rd_segment($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_country_rd_segments', $data);
		// echo $this->db->last_query();	die;
		return $result;
	}
	// Function to Delete selected record from table name students.
	public function delete_rd_segment($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_country_rd_segments');
		return $result;
	}	
	/* Segments Overview */
	public function insert_rd_seg_overview($postoverview){
	
		$this->db->trans_start();
		$this->db->insert('tbl_country_rd_segment_overview', $postoverview);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
    }
	public function get_rd_segment_overview($report_id){
		$this->db->where('report_id',$report_id);
		$result = $this->db->get('tbl_country_rd_segment_overview');
		//echo $this->db->last_query();die;
		return $result->result();
	}
	public function update_rd_single_segment_overview($overview_id, $seg_id,$data){
		$this->db->where(array('id'=>$overview_id, 'segment_id'=>$seg_id));
		// $this->db->where('report_id',$report_id);
		$result =  $this->db->update('tbl_country_rd_segment_overview', $data);
		// echo $this->db->last_query();	
		return $result;
    }
	function delete_rd_single_segment_overview($overview_id){
		// $this->db->where("id", $id);
		$this->db->where(array('id'=>$overview_id));
    	$res= $this->db->delete("tbl_country_rd_segment_overview");
		// echo $this->db->last_query();
		return $res;
	}
	/* ./ Segments overview */
	/* ./ Segments */

	/* Companies */
	public function get_rd_companies($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_companies");
		$this->db->where('report_id',$id);
		$sql = $this->db->get();
		if($sql->num_rows() > 0){			
			return $sql->result();
		} else {
			return array();
		}
	}
	public function get_rd_company($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_companies");
		$this->db->where('id',$id);
		$query = $this->db->get();
		// echo $this->db->last_query(); die; 
		$result = $query->row();		
		return $result;	
	}	
	public function insert_rd_company_data($postcomp){
		$this->db->trans_start();
		$this->db->insert('tbl_country_rd_companies', $postcomp);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		/* echo $this->db->last_query();		
		die; */
		return $insert_id;
	}
	// Update Query For Selected Student
	public function update_rd_company($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_country_rd_companies', $data);
		// echo $this->db->last_query();	die;
		return $result;
		// return $this->db->affected_rows();
	}
	// Function to Delete selected record from table name students.
	public function delete_rd_company($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_country_rd_companies');
		return $result;
	}
	/* ./ Companies */
	/* **********  Market Insight ********** */
	public function insert_market_insight($postdata){
		$this->db->trans_start();
		$this->db->insert('tbl_country_rd_market_insight', $postdata);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
			// echo $this->db->last_query();		
			// die; 
		return $insert_id;
	}
	public function get_rd_market_insight_data($report_id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_market_insight");
		$this->db->where(array('report_id' => $report_id, 'status' => 1));
		$sql = $this->db->get();		
		if($sql->num_rows() > 0)
		{			
			return $sql->result_array();
		}else{
			return array();
		}
	}
	public function get_rd_market_insight_only($report_id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_market_insight");
		// $this->db->where(array('report_id' => $report_id, 'type !='=> 'Report Definition', 'status' => 1));
		$this->db->where(array('report_id' => $report_id, 'status' => 1));
		$sql = $this->db->get();		
		if($sql->num_rows() > 0)
		{			
			return $sql->result_array();
		}else{
			return array();
		}
	}
	public function get_rd_single_market_insight($id){
		$this->db->select("*");
		$this->db->from("tbl_country_rd_market_insight");
		$this->db->where(array('id' => $id, 'status' => 1));
		$sql = $this->db->get();
		if($sql->num_rows() == 1)
		{
			return $sql->row();
		}else{
			return $sql->result_array();
		}
	}
	// Function to Delete selected record from table name.
	public function delete_rd_insight_para($id){
		$this->db->where('id', $id);
		$result = $this->db->delete('tbl_country_rd_market_insight');
		return $result;
	}
	// Update Query For RD market insight Data
	public function update_rd_market_insight($id,$data){
		$this->db->where('id', $id);
		$result =  $this->db->update('tbl_country_rd_market_insight', $data);		
		return $result;
	}
/* *******  ./ Market Insight ********** */
/* *******  Country RD DROs ********** */
/* RD DRO Records Operations */
public function get_dro_type(){
	$result = $this->db->get('tbl_master_drotype');
	$res = $result->result();
	return $res;
}
public function get_rd_dro_data($report_id){
	$this->db->select('tbl_country_rd_dro.* ,tbl_master_drotype.name');
	$this->db->join('tbl_master_drotype','tbl_master_drotype.name = tbl_country_rd_dro.type');
	$this->db->where('report_id',$report_id);
	//$this->db->order_by('id',"desc");
	$result = $this->db->get('tbl_country_rd_dro');
	$res = $result->result();
	return $res;
}
public function insert_rd_dro_records($report_id){
	$data = array(
		'report_id'     =>$report_id,
		'type'      	=>$this->input->post('type'),				
		'description'	=>$this->input->post('description'),
		'status'        =>$this->input->post('status'),
		'created_at'    => date('Y-m-d'),
		'updated_at'    => date('Y-m-d'),
	);
	$res = $this->db->insert('tbl_country_rd_dro', $data);
	return $res;
}
public function get_rd_single_dro($id){
	$this->db->where('id',$id);
	$result = $this->db->get('tbl_country_rd_dro');
	//echo $this->db->last_query(); die;
	return $result->row();
}
public function update_rd_single_dro($id){
	$update = array(
		'type'          =>$this->input->post('type'),
		'description'	=>$this->input->post('description'),
		'status'        =>$this->input->post('status'),
		'updated_at'    => date('Y-m-d'),
		);
	$this->db->where('id',$id);
	return $this->db->update('tbl_country_rd_dro', $update);
}
public function delete_rd_dro_data($id){
	$this->db->where("id", $id);
	$res = $this->db->delete("tbl_country_rd_dro");
	return $res;
}
/* *******  ./ Country RD DROs ********** */
/****** country rd PR ************/
public function insert_pr_data($pr_data){
	$sql = $this->db->insert('tbl_country_rd_pr2_data', $pr_data);
	return $sql;
}
public function get_rd_pr_data($id){
	$this->db->select('*');
	$this->db->from('tbl_country_rd_pr2_data');
	$this->db->where('report_id', $id);
	$sql = $this->db->get();
	if($sql->num_rows() > 0)
	{
		return $sql->result_array();
	}else{
		return array();
	}
}
public function get_rd_single_pr_data($id){
	$this->db->select('*');
	$this->db->from('tbl_country_rd_pr2_data');
	$this->db->where('id', $id);
	$sql = $this->db->get();
	if($sql->num_rows() == 1)
	{
		return $sql->row();
	}else{
		return array();
	}
}
public function update_rd_single_pr_data($id, $data){
	$this->db->where('id', $id);
	$result = $this->db->update('tbl_country_rd_pr2_data', $data);
	return $result;
}
public function delete_rd_pr($id){
	$this->db->where('id', $id);
	$result = $this->db->delete('tbl_country_rd_pr2_data');
	return $result;
}
/********* ./ country rd PR ************/	
/************** ./ for country rd creation & generation ************/

/*************************** Country Sample Pages Generation by Monika ********************************/
public function get_single_country_rd_details($id){
	$this->db->select("*");
	$this->db->from("tbl_country_rd_data");
	$this->db->where(array('id' => $id));
	// $this->db->order_by('id',"desc");
	$sql = $this->db->get();
	/* echo $this->otherdb->last_query();
	die; */
	return $sql->row();
} 
public function get_country_rd_segments($report_id, $parent){
	$this->db->select("*");
	$this->db->from("tbl_country_rd_segments");
	$this->db->where(array('report_id' => $report_id, 'parent_id' => $parent));
	// $this->db->order_by('id',"desc");
	$sql = $this->db->get();
	/* echo $this->otherdb->last_query();
	die; */
	if($sql->num_rows() > 0)
	{
		return $sql->result();
	}else{
		return array();
	}
}
/* Get RD Market Insight */
public function get_rd_market_insight($report_id, $type)
{
	$this->db->select("*");
	$this->db->from('tbl_country_rd_market_insight');
	$this->db->where(array('report_id'=>$report_id, 'type'=>$type, 'status'=> 1));
	$sql = $this->db->get();
	// echo $this->db->last_query();		
	if($sql->num_rows() > 0){			
		return $sql->result();
	}else{
		return array();
	}
}
public function get_rd2_codedecode_para($type_id)
{
	$this->db->select("*");
	$this->db->from('tbl_codedecode_type_description');
	$this->db->where(array('type_id'=>$type_id));
	$sql = $this->db->get();
	// echo $this->db->last_query();		
	if($sql->num_rows() > 0){			
		return $sql->row();
	}else{
		return false;
	}
}
/* ./ Get RD Market Insight */
/* Get RD DRO Data */
public function get_rd_dro($report_id, $type)
{
	$this->db->select("*");
	$this->db->from('tbl_country_rd_dro');
	$this->db->where(array('report_id'=>$report_id, 'type'=> $type, 'status'=> 1));
	$query = $this->db->get();
	// echo $this->db->last_query();		
	if($query->num_rows() > 0){			
		return $query->result();
	}else{
		return array();
	}
}
/* ./ Get RD DRO Data */
/* Get RD Companies */
public function get_country_rd_companies($report_id)
{
	$this->db->select("*");
	$this->db->from('tbl_country_rd_companies');
	$this->db->where(array('report_id'=>$report_id, 'status'=> 1));
	$cquery = $this->db->get();
	// echo $this->db->last_query();		
	if($cquery->num_rows() > 0){			
		return $cquery->result();
	}else{
		return array();
	}
}
/* ./ Get RD Companies */
/* Get RD Segment Overview */
public function get_country_rd_segment_overview($report_id, $segment_id){
	$this->db->where(array('segment_id' => $segment_id,'report_id'=>$report_id));
	$result = $this->db->get('tbl_country_rd_segment_overview');
	//echo $this->db->last_query();die;
	return $result->result();
}
/* ./ Get RD Segment Overview */
/* Segment Count */
public function get_count_rd_childsegments($report_id, $parent)
{	
	$this->db->select('*');
	$this->db->from('tbl_country_rd_segments');
	$this->db->where(array('report_id'=>$report_id, 'parent_id'=> $parent));
	$rowscount = $this->db->count_all_results();
	return $rowscount;
}
/* ./ Segment Count */

/*************************** ./ Country Sample Pages Generation by Monika ********************************/
}
?>