<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Analyst_dashboard_model extends CI_Model  
{
	function __construct()
	{
		$this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
	}		
	
	function count_global_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_global_reports');
		$result = $result->num_rows();
		return $result;
	}
    function count_country_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_country_reports');
		$result = $result->num_rows();
		return $result;
	}
    function count_region_report()
	{
		$result = $this->admindb->get('igr_regional_reports');
		$result = $result->num_rows();
		return $result;
	}
    function count_infographics_report()
	{
		$this->admindb->where('status','1');
		$result = $this->admindb->get('igr_infographics_data');
		$result = $result->num_rows();
		return $result;
	}
    
	

	
}
?>