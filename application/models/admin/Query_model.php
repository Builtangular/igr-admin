<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query_model extends CI_Model { 
    public function __construct(){
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
    /* query management */
    public function get_user_details($role_id){
        $this->db->select('*');
        $this->db->where('role_id',$role_id);
        $this->db->from('tbl_registered_user_details');
        $query = $this->db->get();
        return $query->result();
    } 
    public function get_sales_user_details(){
        $this->db->select('*');
        $this->db->where('department','Sales');
        $this->db->from('tbl_registered_user_details');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_details_assign_user($Login_user_name){
        $this->db->select('*');
        $this->db->from('tbl_query_assignment');
        // $this->db->where(array('tbl_query_assignment.assigned_name'=>$Login_user_name,'tbl_query_assignment.status'=>1)); 
        $this->db->where(array('tbl_rd_query_data.assign_to_team'=>1,'tbl_query_assignment.assigned_name'=>$Login_user_name,'tbl_query_assignment.status'=>1)); 
        $this->db->join('tbl_rd_query_data','tbl_query_assignment.query_id = tbl_rd_query_data.id');
        $this->db->order_by('tbl_query_assignment.id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();  
    }
    public function get_todays_analyst_queries($Login_user_name,$date){
        $this->db->select('*');
        $this->db->from('tbl_query_assignment');
        // $this->db->where(array('tbl_query_assignment.assigned_name'=>$Login_user_name,'tbl_query_assignment.status'=>1)); 
        $this->db->where(array('tbl_rd_query_data.assign_to_team'=>1,'tbl_query_assignment.assigned_name'=>$Login_user_name,'tbl_query_assignment.status'=>1,'tbl_rd_query_data.updated_on'=>$date));//use date function
        // $this->db->where(array('tbl_rd_query_data.assign_to_team'=>1,'tbl_query_assignment.assigned_name'=>$Login_user_name,'tbl_query_assignment.status'=>1)); 
        $this->db->join('tbl_rd_query_data','tbl_query_assignment.query_id = tbl_rd_query_data.id');
        $this->db->order_by('tbl_query_assignment.id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result(); 
    }
   /*  public function get_research_details_assign_user($Login_user_name){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_sale_status');
    $this->db->where(array('tbl_rd_query_data.assign_to_team'=>1,'tbl_rd_query_sale_status.query_id'=>$Login_user_name)); 
    $this->db->join('tbl_rd_query_data','tbl_rd_query_sale_status.query_id = tbl_rd_query_data.id');
    // $this->db->order_by('tbl_rd_query_reseller_data.id',"DESC");
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result(); 


        $this->db->select('*');
        $this->db->from('tbl_rd_query_sale_status');
        $this->db->join('tbl_rd_query_data','tbl_rd_query_sale_status.query_id = tbl_rd_query_data.id');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result(); 
    
    } */
 
    public function get_single_details_marketer($Login_user_name){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $this->db->where('created_user',$Login_user_name);
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    public function get_query_list1(){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $this->db->where(array('assign_to_team'=>0)); 
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    public function get_team_query_list(){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $this->db->where(array('source'=> 'Email'));     
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    public function get_draft_details($Login_user_name){
        $this->db->select('*');
        // $this->db->where('created_user',$Login_user_name);
        $this->db->from('tbl_rd_query_data');
        $this->db->where(array('created_user'=>$Login_user_name, 'assign_to_team'=>0));        
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        
        return $query->result();
    }
    public function get_query_data($department){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        return $query->result();
    }
    public function get_not_assigned_query_data(){
        $this->db->select('*');
        $this->db->from('tbl_rd_query_data');
        // $this->db->where('assign_to_team',0);
        $this->db->where(array('assign_to_team'=>0,'assign_analyst'=>0));
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_query_details($data){
        $result = $this->db->insert('tbl_rd_query_data', $data);
        return $result;
    }
    public function get_query_assign_details1($id){
        $this->db->where(array('query_id'=>$id,'status'=>1));
        $result = $this->db->get('tbl_query_assignment');
        return $result->row();
    }
    public function get_query_assign1($id){
        $this->db->where(array('query_id'=>$id, 'status'=>1));  
        $result = $this->db->get('tbl_query_assignment');
        return $result->row();       
    }
    public function get_query_assigned_data($id, $assigned_name){
        $this->db->where(array('query_id'=>$id, 'assigned_name' => $assigned_name, 'status'=>1));  
        $result = $this->db->get('tbl_query_assignment');
        // echo $this->db->last_query(); die;
        return $result->row();       
    }
    public function get_query_research_assigned_data($id, $assigned_name){
        $this->db->where(array('query_id'=>$id, 'assigned_name' => $assigned_name, 'status'=>1));  
        $result = $this->db->get('tbl_query_assignment_research');
        // echo $this->db->last_query(); die;
        return $result->row();       
    }
    public function update_query_details($id,$update_assignment){
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_rd_query_data', $update_assignment);
        // $insert_id = $this->db->insert_id();
        return $result;
    }
    public function update_assignment_data($id,$update_query){
        $this->db->where('query_id', $id);
        $result = $this->db->update('tbl_query_assignment', $update_query);
        // $insert_id = $this->db->insert_id();
        return $result;
    } 
    public function update_assignment_data1($id,$update_assignment_query){
        $this->db->where('query_id', $id);
        $result = $this->db->update('tbl_query_assignment', $update_assignment_query);
        // $insert_id = $this->db->insert_id();
        return $result;
    } 
    public function update_upcoming_records($id,$update_upcoming_data){
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_rd_query_data', $update_upcoming_data);
        //$insert_id = $this->db->insert_id();
        return $result;
    }
    public function insert_assignment_details($data){
        $result = $this->db->insert('tbl_query_assignment', $data);
        return $result;
    }
  
    public function update_assignment_details($id,$update_assignment){
        $result =$this->db->update('tbl_query_assignment',$update_assignment);
        return $result;
    }
    public function get_query_assign_details(){
        $this->db->select('*');
        $this->db->from('tbl_query_assignment');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_query_list($Login_user_name){
        $this->db->select('*');
        $this->db->where(array('tbl_query_assignment.status' => 1,'tbl_query_assignment.assigned_name!=' => $Login_user_name));
        $this->db->from('tbl_rd_query_data');
        $this->db->join('tbl_query_assignment','tbl_rd_query_data.id = tbl_query_assignment.query_id');
        $this->db->order_by('query_id',"DESC");
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();
    }
    public function delete($id) {
        $this->db->where('query_id',$id);
        $result = $this->db->delete('tbl_query_assignment');
        return $result;
    } 
    public function draft_delete($id) {
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_rd_query_data');
        return $result;
    }  
    public function close_delete($id){
        $this->db->where('query_id',$id);
        $result = $this->db->delete('tbl_rd_query_current_status');
        return $result;
    } 
    public function delete_assign_query($id) {
        $this->db->where('query_id',$id);
        $result = $this->db->delete('tbl_query_assignment');
        return $result;
    }
    public function delete_query_data($id){
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_rd_query_data');
        return $result;
    }
    public function delete_upcoming_query($id){
        $this->db->where('id',$id);
        $result = $this->db->delete('tbl_rd_query_data');
        return $result;
    }
/* / .query management */

/* status management */
public function insert_status_details($data){
    $result = $this->db->insert('tbl_rd_query_current_status', $data);
    return $result;
}
public function get_status_details($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_current_status');
    //echo $this->db->last_query(); die;
    return $result->row();
}
public function update_status($id,$update){
    $this->db->where('id', $id);
    return $this->db->update('tbl_rd_query_current_status', $update);
}
public function status_details($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_current_status');
    return $result->row();
}
public function get_statuswise_records($status){
    $this->db->select('tbl_rd_query_data.id, tbl_rd_query_data.scope_name, tbl_rd_query_data.report_name, tbl_rd_query_data.assign_analyst, tbl_rd_query_data.query_code, tbl_rd_query_data.client_email, tbl_rd_query_data.company_name,  tbl_rd_query_data.lead_date, tbl_rd_query_data.created_user, tbl_rd_query_current_status.query_id');
    $this->db->from('tbl_rd_query_data');
    $this->db->join('tbl_rd_query_current_status','tbl_rd_query_data.id = tbl_rd_query_current_status.query_id', 'LEFT');
    $this->db->like('tbl_rd_query_current_status.status',$status);
    $query = $this->db->get();
    // echo $this->db->last_query(); die;
    return $query->result();
}
/* /.status management */

/* follow up  management */  
public function insert_followup_details($id){
    $data = array(
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'created_on'                  => date('Y-m-d'),
        'updated_on'                  => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_followup', $data);
    return $result;
}
public function get_followup_details($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->result();
}
public function get_single_followup($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}
public function get_view_followup_details($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}
public function delete_followup($id){
    $this->db->where("id", $id);
    $res = $this->db->delete("tbl_rd_query_followup");
    return $res;
} 
public function get_followup_record($id){
    $this->db->where('query_id',$id);
    $result = $this->db->get('tbl_rd_query_followup');
    return $result->row();
}

/* ./follow up  management */  

/* add single record */
public function insert_record($id){
    $data = array(
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'created_on'                  => date('Y-m-d'),
        'updated_on'                  => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_followup', $data);
    return $result;
}
public function get_query_record($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_data');
    return $result->row();
}
/* ./add single record */

/* get scope record */
public function get_scope_master(){
    $this->db->select('name');
    $this->db->distinct();
    $result = $this->db->get('tbl_master_scope');
    $res = $result->result();
    return $res;
}
/* /.get scope record */

/* Reseller management */
public function insert_reseller_details(){
    $data = array(
        'reseller_name'              => $this->input->post('reseller_name'),
        'reseller_email'             => $this->input->post('reseller_email'),
        'service_no'                 => $this->input->post('service_no'),
        'created_on'                 => date('Y-m-d'),
        'updated_on'                 => date('Y-m-d'),
    );
    $result = $this->db->insert('tbl_rd_query_reseller_data', $data);
    return $result;
   
}
public function get_reseller_details(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_reseller_record($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_reseller_data');
    return $result->row();
}
public function reseller_update($id){
        $update = array(        
            'reseller_name'              => $this->input->post('reseller_name'),
            'reseller_email'             => $this->input->post('reseller_email'),
            'service_no'                 => $this->input->post('service_no'),
            'updated_on'                 => date('Y-m-d'),
        );
        $this->db->where('id', $id);
        return $this->db->update('tbl_rd_query_reseller_data', $update);
}
public function reseller_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_rd_query_reseller_data');
    return $result;
}
public function get_reseller_list(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_reseller_details($reseller_name){
    $this->db->select('*');
    $this->db->where('reseller_name',$reseller_name);
    $this->db->from('tbl_rd_query_reseller_data');
    $query = $this->db->get();
    return $query->row();
}
public function get_single_query_details(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_data');
    $this->db->order_by('id','DESC');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row();
}
public function update_followup($id)
{
    $update = array(        
        'query_id'                    => $id,
        'subject'                     => $this->input->post('subject'),
        'client_comment'              => $this->input->post('client_comment'),
        'user_comment'                => $this->input->post('user_comment'),
        'followup_date'               => $this->input->post('followup_date'),
        'updated_on'                  => date('Y-m-d'),
    );
    $this->db->where('id', $id);
    return $this->db->update('tbl_rd_query_followup', $update);
}
public function get_single_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_data');
    return $result->row();
}
public function get_user_data(){
    $this->db->select('user_id, Role_id, Full_name, Active_flag');
    $this->db->from('tbl_user_details');
    $this->db->where(array('Role_id' => 5,'Active_flag' => '1'));		
    $login_sql = $this->db->get();	
    return $login_sql->result_array();	
}
public function update_query_user($data, $id){
    $this->db->where(array('id' => $id));
    $result =  $this->db->update('tbl_rd_query_data', $data);
    return $result;
}
public function get_query_close_data(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_reseller_data');
    // $this->db->where(array('status'));	
    $query = $this->db->get();
    return $query->result();
}
public function get_query_data1(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_current_status');
    // $this->db->where(array('tbl_rd_query_data.assigned_name'=>$Login_user_name,'tbl_rd_query_data.status'=>1)); 
    $this->db->join('tbl_rd_query_data','tbl_rd_query_current_status.query_id = tbl_rd_query_data.id');
    // $this->db->order_by('tbl_rd_query_reseller_data.id',"DESC");
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();  
}
/* / Research Upcoming Queries */
public function get_not_assigned_query_details(){
    $this->db->select('*');
    $this->db->from('tbl_rd_query_data');
    $this->db->where(array('assign_analyst'=>1,'assign_to_team_analyst'=>0));  
    $this->db->order_by('id',"DESC");
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_todays_queries($Login_user_name,$date){
  /*   $this->db->select('*');
    $this->db->from('tbl_rd_query_data');
    $this->db->where(array('assign_analyst'=>1,'updated_on'=>$date));  
    $this->db->order_by('id',"DESC");
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result(); */

    $this->db->select('*');
    // $this->db->where(array('tbl_query_assignment_research.assigned_name!=' => $Login_user_name,'tbl_query_assignment_research.status'=>1));
    $this->db->from('tbl_rd_query_data');
    $this->db->where(array('tbl_query_assignment_research.status'=>1,'tbl_rd_query_data.updated_on'=>$date));
    $this->db->join('tbl_query_assignment_research','tbl_rd_query_data.id = tbl_query_assignment_research.query_id');
    $this->db->order_by('query_id',"DESC");
    $query = $this->db->get();
    return $query->result();
}
public function get_query_research_assign($id){
    $this->db->where(array('query_id'=>$id,'status'=>1));  
    $result = $this->db->get('tbl_query_assignment_research');
    return $result->row();       
}
public function get_user_records(){
    $this->db->select('*');
    // $this->db->where(array('user_type'=>'Analyst'));  
    $this->db->where(array('department'=>'Research','status'=>1));  
    $this->db->from('tbl_registered_user_details');
    $query = $this->db->get();
    return $query->result();
}
public function get_single_query_data($id){
    $this->db->where('id',$id);
    $result = $this->db->get('tbl_rd_query_data');
    return $result->row();
}
public function insert_research_assignment($data){
    $result = $this->db->insert('tbl_query_assignment_research',$data);
    return $result;
}
public function update_research_assignment($id,$update_research_assignment){
    $this->db->where('id', $id);
    $result = $this->db->update('tbl_rd_query_data', $update_research_assignment);
    return $result;
} 
public function get_research_assign_query_list($Login_user_name){
    $this->db->select('*');
    $this->db->from('tbl_query_assignment_research');
    $this->db->where(array('tbl_rd_query_data.assign_to_team_analyst'=>1,'tbl_query_assignment_research.assigned_name'=>$Login_user_name,'tbl_query_assignment_research.status'=>1)); 
    $this->db->join('tbl_rd_query_data','tbl_query_assignment_research.query_id = tbl_rd_query_data.id');
    $this->db->order_by('tbl_query_assignment_research.id',"DESC");
    $query = $this->db->get();
    return $query->result();  
}
public function get_research_daily_assigned_query_list($Login_user_name){
    $this->db->select('*');
    $this->db->from('tbl_query_assignment_research');
    $this->db->where(array('tbl_rd_query_data.assign_to_team_analyst'=>1,'tbl_query_assignment_research.assigned_name'=>$Login_user_name,'tbl_query_assignment_research.status'=>1, 'tbl_query_assignment_research.created_at'=>date('Y-m-d')));
    $this->db->join('tbl_rd_query_data','tbl_query_assignment_research.query_id = tbl_rd_query_data.id');
    $this->db->order_by('tbl_query_assignment_research.id',"DESC");
    $query = $this->db->get();
    return $query->result();  
}
public function get_query_assigned_research_list($Login_user_name){
    $this->db->select('*');
    // $this->db->where(array('tbl_query_assignment_research.assigned_name!=' => $Login_user_name,'tbl_query_assignment_research.status'=>1));
    $this->db->where(array('tbl_query_assignment_research.status'=>1));
    $this->db->from('tbl_rd_query_data');
    $this->db->join('tbl_query_assignment_research','tbl_rd_query_data.id = tbl_query_assignment_research.query_id');
    $this->db->order_by('query_id',"DESC");
    $query = $this->db->get();
    return $query->result();
}
public function get_research_assign_user_details($User_Type){
    $this->db->select('*');
    // $this->db->where('user_type','Analyst');
    $this->db->where(array('user_type'=>'Analyst','status'=>1)); 
    $this->db->from('tbl_registered_user_details');
    $query = $this->db->get();
    return $query->result();
}
public function update_research_assignment_data($id,$update_query){
    $this->db->where('query_id', $id);
    $result = $this->db->update('tbl_query_assignment_research', $update_query);
    // $insert_id = $this->db->insert_id();
    return $result;
}
public function get_view_assign_query_details($Login_user_name){
    $this->db->select('*');
    $this->db->from('tbl_query_assignment_research');
    $this->db->where(array('tbl_rd_query_data.assign_to_team_analyst'=>1,'tbl_query_assignment_research.assigned_name'=>$Login_user_name,'tbl_query_assignment_research.status'=>1)); 
    $this->db->join('tbl_rd_query_data','tbl_query_assignment_research.query_id = tbl_rd_query_data.id');
    $this->db->order_by('tbl_query_assignment_research.id',"DESC");
    $query = $this->db->get();
    return $query->result();  
}
public function get_view_query_details($Login_user_name,$id){
    $this->db->select('*');
    $this->db->from('tbl_query_assignment_research');
    $this->db->where(array('tbl_query_assignment_research.query_id'=>$id,'tbl_query_assignment_research.status' => 1,'tbl_query_assignment_research.assigned_name'=>$Login_user_name));
    $this->db->join('tbl_rd_query_data','tbl_query_assignment_research.query_id = tbl_rd_query_data.id');
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->row();
}
public function insert_query_comment_details($data){
    $result = $this->db->insert('tbl_query_comment_analyst', $data);
    return $result;
}
public function get_query_comment_data($id,$Login_user_name){
    $where =  "query_id = '$id' AND (user_name = '$Login_user_name' OR comment_for = '$Login_user_name')";
    // $where =  "query_id = '$id' AND `parent` IS NULL AND (user_name = '$Login_user_name' OR comment_for = '$Login_user_name')";
    $this->db->where($where);
    // $this->db->where(array('query_id'=>$id, 'user_name'=>$Login_user_name,'comment_for'=>$Login_user_name));  
    $result = $this->db->get('tbl_query_comment_analyst');
    // echo $this->db->last_query();die;
    return $result->result();       
}

function tree_all($ne_id) {
    $result = $this->db->query("SELECT * FROM tbl_query_comment_analyst where query_id = $ne_id")->result_array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    return $data;
}
// to get child comments by entry id and parent id and news id
function tree_by_parent($ne_id,$in_parent) {
    $result = $this->db->query("SELECT * FROM tbl_query_comment_analyst where parent = $in_parent AND  query_id = $ne_id")->result_array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    return $data;
}

public function get_query_comment_data1(){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    // $this->db->where(array('id', 'status'=>1));  
    $result = $this->db->get();
    return $result->result();       
}
public function get_assign_query_records(){
    $this->db->select('*');
    $this->db->from('tbl_query_assignment_research');
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
/* /. Research Upcoming Queries */

public function get_todays_followup_queries($Login_user_name){
    $this->db->select('tbl_rd_query_followup.id, tbl_rd_query_current_status.id AS status_id, tbl_rd_query_data.id AS query_id, tbl_rd_query_data.query_code');
    $this->db->from('tbl_rd_query_data');
    $this->db->join('tbl_rd_query_followup', 'tbl_rd_query_followup.query_id = tbl_rd_query_data.id', 'left');
    $this->db->join('tbl_query_assignment', 'tbl_query_assignment.query_id = tbl_rd_query_data.id');
    $this->db->join('tbl_rd_query_current_status', 'tbl_rd_query_current_status.query_id = tbl_rd_query_data.id');
    $where = '(tbl_rd_query_followup.followup_date = "'.date('Y-m-d').'" OR tbl_rd_query_current_status.followup_date = "'.date('Y-m-d').'") AND tbl_query_assignment.assigned_name = "'.$Login_user_name.'" AND tbl_query_assignment.status = 1';
    // $this->db->where(array('tbl_rd_query_followup.followup_date' => date('Y-m-d'), 'tbl_query_assignment.assigned_name' => $Login_user_name, 'tbl_query_assignment.status' => 1));
    $this->db->where($where);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function update_query_comment($id,$update_query_comment){
    $this->db->where('id', $id);
    $result = $this->db->update('tbl_query_comment_analyst', $update_query_comment);
    // $insert_id = $this->db->insert_id();
    return $result;
}
public function get_comment_details($id){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    $this->db->where('id', $id);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->row();
}
public function comment_query_delete($id){
    $this->db->where('id',$id);
    $result = $this->db->delete('tbl_query_comment_analyst');
    return $result;
}
public function insert_research_query_comment_details($data){
    $result = $this->db->insert('tbl_query_comment_analyst', $data);
    return $result;
}
public function get_single_query_comment($id){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    // $this->db->where(array('parent' => NULL,'query_id'=>$id));
    $this->db->where(array('query_id'=>$id));
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_single_query_status($id){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    $this->db->where(array('parent' =>$id));
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_single_query_comment1($Login_user_name){
    // $this->db->select('*');
    // $this->db->from('tbl_query_comment_analyst');
    // // $this->db->where('Login_user_name', $Login_user_name);
    // // $this->db->where(array('Login_user_name'=>$Login_user_name)); 
    // $query = $this->db->get();
    // // echo $this->db->last_query();die;
    // return $query->result();
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    $where = "user_name = '$Login_user_name' OR comment_for = '$Login_user_name'";
    // $this->db->where(array('parent' => NULL));
    $this->db->where($where);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_single_query_records($Login_user_name){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    $where = "user_name = '$Login_user_name' OR comment_for = '$Login_user_name'";
    $this->db->where($where);
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->row();
}
public function get_single_parent_query_comment(){
    $this->db->select('*');
    $this->db->from('tbl_query_comment_analyst');
    $this->db->where(array('parent!=' => NULL)); 
    $query = $this->db->get();
    // echo $this->db->last_query();die;
    return $query->result();
}
public function get_single_user_details(){
    $this->db->select('*');
    $this->db->where(array('role_id'=> 4, 'full_name'=> 'Prathamesh Shikhare'));
    $this->db->from('tbl_registered_user_details');
    $query = $this->db->get();
    return $query->row();
}
/* /. Research Upcoming Queries */
}
?>