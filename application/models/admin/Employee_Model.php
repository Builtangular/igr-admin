<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_Model extends CI_Model {   
    
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
        $this->admindb = $this->load->database('admindb', TRUE);
    }
    public function insert_emp_personal_details($file){
        $data = array(
                'job_type'                      => $this->input->post('job_type'),
                'emp_code'                      => $this->input->post('emp_code'),
                'joining_date'                  => $this->input->post('joining_date'),
                'appraisal_date'                => $this->input->post('appraisal_date'),
                'prefix'                        => $this->input->post('prefix'),
                'first_name'                    => $this->input->post('first_name'),
                'middle_name'                   => $this->input->post('middle_name'),
                'last_name'                     => $this->input->post('last_name'),
                'date_of_birth'                 => $this->input->post('date_of_birth'),
                'gender'                        => $this->input->post('gender'),
                'mobile_number'                 => $this->input->post('mobile_number'),
                'alternate_mobile_no'           => $this->input->post('alternate_mobile_no'),
                'personal_email_id'             => $this->input->post('personal_email_id'),
                'official_email_id'             => $this->input->post('official_email_id'),
                'marital_status'                => $this->input->post('marital_status'),
                'spouse_name'                   => $this->input->post('spouse_name'),
                'father_name'                   => $this->input->post('father_name'),
                'permant_address'               => $this->input->post('permant_address'),
                'current_address'               => $this->input->post('current_address'),
                'relative_name'                 => $this->input->post('relative_name'),
                'relative_contact_no'           => $this->input->post('relative_contact_no'),
                'reference_name'                => $this->input->post('reference_name'),
                'reference_contact_no'          => $this->input->post('reference_contact_no'),
                'aadhaar_no'                    => $this->input->post('aadhaar_no'),
                'pan_no'                        => $this->input->post('pan_no'),
                'passport_no'                   => $this->input->post('passport_no'),
                'education_type'                => $this->input->post('education_type'),
                'degree'                        => $this->input->post('degree'),
                'resignation_date'              => $this->input->post('resignation_date'),
                'passing_year'                    => $this->input->post('passing_year'),
                'department'                    => $this->input->post('department'),
                'job_profile'                   => $this->input->post('job_profile'),  
                'emp_status'                    => $this->input->post('emp_status'),               
                'uan_no'                        => $this->input->post('uan_no'),
                'pf_no'                         => $this->input->post('pf_no'),
                'upload_image'                  => $file,
                'user_type'                     => $this->input->post('user_type'),
                'created_on'                    => date('Y-m-d'),
                'updated_on'                    => date('Y-m-d'),
                
        );
        $result = $this->db->insert('tbl_emp_enrollement', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function get_emp_personal_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_enrollement');
        $this->db->where(array('id' => $id));                  
        $query = $this->db->get();
    //   echo $this->db->last_query();
        return $query->row();        
    } 
    public function insert_permanent_salary_breakup($id){
        $data = array(
            'emp_id'                      => $id,
            'salary_year'                 => $this->input->post('salary_year'),
            'gross_basic_salary'          => $this->input->post('Gross_basic_salary'),
            'gross_hra'                   => $this->input->post('G_HRA'),
            'gross_other'                 => $this->input->post('G_other'),
            'gross_salary'                => $this->input->post('Gross_salary'),
            'emp_pf'                      => $this->input->post('Emp_PF'),
            'emp_esic'                    => $this->input->post('Emp_ESIC'),
            'emp_pt'                      => $this->input->post('Emp_PT'),
            'net_salary'                  => $this->input->post('Net_salary'),
            'employer_pf'                 => $this->input->post('Employer_PF'),
            'employer_esic'               => $this->input->post('Employer_ESIC'),
            'employer_other'              => $this->input->post('Employer_other'),
            'ctc'                         => $this->input->post('CTC'),
            'created_at'                  => date('Y-m-d'),
            'updated_at'                  => date('Y-m-d'),
        );
        $result = $this->db->insert('tbl_emp_salary_permanent',$data);
        return $result;
    }
    public function insert_temporarily_salary_breakup($id){
        $data = array(
            'emp_id'                      => $id,
            'salary_year'                 => $this->input->post('salary_year'),
            'salary'                      => $this->input->post('salary'),
            'tds'                         => $this->input->post('TDS'),
            'gross_salary'                => $this->input->post('gross_salary'),
            'created_at'                  => date('Y-m-d'),
            'updated_at'                  => date('Y-m-d'),
        );
        $result = $this->db->insert('tbl_emp_salary_temporary',$data);
        return $result;
    }

    public function insert_bank_details($data){     
        $result = $this->db->insert('tbl_emp_bank_details',$data);
        return $result;
    }
   public function insert_employee_documents($id,$file, $doc_type){
        $data = array(
            'emp_id'                        => $id,
            'doc_type'                      => $doc_type,
            'upload_file'                   => $file,
            'created_at'                    => date('Y-m-d'),
            'updated_at'                    => date('Y-m-d'),
        );
        $result = $this->db->insert('tbl_emp_document',$data);
        return $result;

    }
    public function get_employee_doc($id){
        $this->db->select('doc_type');
        $this->db->from('tbl_emp_document');
        $this->db->where(array('emp_id' => $id));          
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_details()
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_enrollement');
        $this->db->where(array('emp_status'=>'Active','status=' =>'1'));
        $this->db->order_by('appraisal_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_resigned_list(){
        $this->db->select('*');
        $this->db->from('tbl_emp_enrollement');
        // $this->db->where(array('emp_status!=' =>'Active', 'status'=> 0));
        $this->db->where(array('emp_status!=' =>'Active','status'=> 1));
        $this->db->order_by('resignation_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_permenent_employee_details()
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_enrollement');
        $this->db->where('job_type', 'Full Time');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employment_record($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_employment');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_record($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_enrollement');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }
    public function get_psalary_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_permanent');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    } 
    public function get_tsalary_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_temporary');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_employee_bank_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_bank_details');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    } 
    public function get_employee_personal_bank_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_bank_details');
        $this->db->where(array('emp_id' => $id, 'type' => 'Personal'));
        $query = $this->db->get();
        return $query->row();
    } 
    public function get_emp_permant_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_permanent');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->row();
    } 
    public function get_emp_temporary_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_temporary');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->row();
    }
    public function get_single_employee_data($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_enrollement');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function get_p_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_permanent');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    }
     public function get_t_salary_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_temporary');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    }
    public function update_emp_personal_data($id,$file){
        $update = array(
            'job_type'                      => $this->input->post('job_type'),
            'emp_code'                      => $this->input->post('emp_code'),
            'joining_date'                  => $this->input->post('joining_date'),
            'appraisal_date'                => $this->input->post('appraisal_date'),
            'prefix'                        => $this->input->post('prefix'),
            'first_name'                    => $this->input->post('first_name'),
            'middle_name'                   => $this->input->post('middle_name'),
            'last_name'                     => $this->input->post('last_name'),
            'date_of_birth'                 => $this->input->post('date_of_birth'),
            'gender'                        => $this->input->post('gender'),
            'mobile_number'                 => $this->input->post('mobile_number'),
            'alternate_mobile_no'           => $this->input->post('alternate_mobile_no'),
            'personal_email_id'             => $this->input->post('personal_email_id'),
            'official_email_id'             => $this->input->post('official_email_id'),
            'marital_status'                => $this->input->post('marital_status'),
            'spouse_name'                   => $this->input->post('spouse_name'),
            'father_name'                   => $this->input->post('father_name'),
            'permant_address'               => $this->input->post('permant_address'),
            'current_address'               => $this->input->post('current_address'),
            'relative_name'                 => $this->input->post('relative_name'),
            'relative_contact_no'           => $this->input->post('relative_contact_no'),
            'reference_name'                => $this->input->post('reference_name'),
            'reference_contact_no'          => $this->input->post('reference_contact_no'),
            'aadhaar_no'                    => $this->input->post('aadhaar_no'),
            'pan_no'                        => $this->input->post('pan_no'),
            'passport_no'                   => $this->input->post('passport_no'),
            'education_type'                => $this->input->post('education_type'),
            'degree'                        => $this->input->post('degree'),
            'passing_year'                  => $this->input->post('passing_year'),
            'resignation_date'              => $this->input->post('resignation_date'),
            'department'                    => $this->input->post('department'),
            'job_profile'                   => $this->input->post('job_profile'),
            'emp_status'                    => $this->input->post('emp_status'),             
            'uan_no'                        => $this->input->post('uan_no'),
            'pf_no'                         => $this->input->post('pf_no'),            
            'passing_year'                  => $this->input->post('passing_year'),            
            'upload_image'                  => $file,
            'user_type'                     => $this->input->post('user_type'),
            'updated_on'                    => date('Y-m-d'),
            );
        $this->db->where('id', $id);
        return $this->db->update('tbl_emp_enrollement', $update);
    }
    public function insert_employment_details($id)
      {
          $data = array(
               'emp_id'                      => $id,
               'company_name'                => $this->input->post('company_name'),
               'company_address'             => $this->input->post('company_address'),
               'date_of_joining'             => $this->input->post('date_of_joining'),
               'date_of_releaving'           => $this->input->post('date_of_releaving'),
               'designation'                 => $this->input->post('designation'),
               'last_drown_salary'           => $this->input->post('last_drown_salary'),
               'job_type'                    => $this->input->post('job_type'),
               'reason_for_leaving'          => $this->input->post('reason_for_leaving'),
               'reference_contact_no'        => $this->input->post('reference_contact_no'),
               'created_at'                  => date('Y-m-d'),
               'updated_at'                  => date('Y-m-d')
          );
          $result = $this->db->insert('tbl_emp_employment', $data);
          // $Emp_id=$this->db->insert_id();
          // var_dump($patient_id);die;
          return $result;
      }
    public function update_employment_data($id){
        $update = array(
            'company_name'                => $this->input->post('company_name'),
            'company_address'             => $this->input->post('company_address'),
            'date_of_joining'             => $this->input->post('date_of_joining'),
            'date_of_releaving'           => $this->input->post('date_of_releaving'),
            'designation'                 => $this->input->post('designation'),
            'last_drown_salary'           => $this->input->post('last_drown_salary'),
            'job_type'                    => $this->input->post('job_type'),
            'reason_for_leaving'          => $this->input->post('reason_for_leaving'),
            'reference_contact_no'        => $this->input->post('reference_contact_no'),
            'updated_at'                  => date('Y-m-d')
        );
        $this->db->where('id', $id);
        return $this->db->update('tbl_emp_employment', $update);
    }
    public function delete_employment_data($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_employment");
		return $res;
    }
    /* update employment data */
    public function get_single_empolyment_data($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_employment');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function update_bank_details($id){
        $update = array(
            'bank_name'                   => $this->input->post('bank_name'),
            'ac_name'                     => $this->input->post('account_name'),
            'ac_no'                       => $this->input->post('account_no'),
            'ifsc_code'                   => $this->input->post('ifsc_code'),
            'branch_name'                 => $this->input->post('branch_name'),
            'type'                        => $this->input->post('type'),
            'updated_at'                  => date('Y-m-d'),
            );
        $this->db->where('id',$id);
        return $this->db->update('tbl_emp_bank_details', $update);
    }
    public function delete_employee_data($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_enrollement");
		return $res;
    }
    /* update salary break up */
    public function get_single_psalary_data($id)
    {
        /* $this->db->where(array('emp_id', $id));
        $result = $this->db->get('tbl_emp_salary_permanent'); */
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_permanent');
        $this->db->where(array('id' => $id));
        // $this->db->order_by('salary_year', 'desc');
        $result = $this->db->get();
		// echo $this->db->last_query();die;
		return $result->row();
    }
    public function get_single_tsalary_data($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_salary_temporary');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function update_p_salary_breakup($id){
        $update = array(
            'salary_year'                 => $this->input->post('salary_year'),
            'gross_basic_salary'          => $this->input->post('Gross_basic_salary'),
            'gross_hra'                   => $this->input->post('G_HRA'),
            'gross_other'                 => $this->input->post('G_other'),
            'gross_salary'                => $this->input->post('Gross_salary'),
            'emp_pf'                      => $this->input->post('Emp_PF'),
            'emp_esic'                    => $this->input->post('Emp_ESIC'),
            'emp_pt'                      => $this->input->post('Emp_PT'),
            'net_salary'                  => $this->input->post('Net_salary'),
            'employer_pf'                 => $this->input->post('Employer_PF'),
            'employer_esic'               => $this->input->post('Employer_ESIC'),
            'employer_other'              => $this->input->post('Employer_other'),
            'ctc'                         => $this->input->post('CTC'),
            'updated_at'                  => date('Y-m-d'),
            );
        $this->db->where('id', $id);
        return $this->db->update('tbl_emp_salary_permanent', $update);
    } 
    public function update_t_salary_breakup($id){
        $update = array(
            'salary_year'                 => $this->input->post('salary_year'),
            'salary'                      => $this->input->post('salary'),
            'tds'                         => $this->input->post('TDS'),
            'gross_salary'                => $this->input->post('gross_salary'),
            'updated_at'                  => date('Y-m-d'),
            );
        $this->db->where('id', $id);
        return $this->db->update('tbl_emp_salary_temporary', $update);
    }
    public function delete_psalary($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_salary_permanent");
		return $res;
    } 
    public function delete_tsalary($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_salary_temporary");
		return $res;
    }
    public function get_single_psalary_data_for_letter($emp_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_salary_permanent');
        $this->db->where(array('emp_id' => $emp_id));
        $this->db->order_by('salary_year', 'desc');
        $result = $this->db->get();
		// echo $this->db->last_query();die;
		return $result->row();
    }
    /* bank details */
   /*  public function get_p_bank_details($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_bank_details');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    } */
    public function get_single_bank_data($id)
    {
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_bank_details');
		//echo $this->db->last_query();die;
		return $result->row();
    }
   /*  public function delete_p_salary($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_bank_details");
		return $res;
    }  */
    public function delete_bank_details($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_bank_details");
		return $res;
    } 
    /* /. bank details */

    /* documents */
    public function get_document_list($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_emp_document');
        $this->db->where(array('emp_id' => $id));
        $query = $this->db->get();
        return $query->result();
    }
    public function get_single_document($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_document');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function get_single_bank($id){
        $this->db->where('id',$id);
        $result = $this->db->get('tbl_emp_bank_details');
		//echo $this->db->last_query();die;
		return $result->row();
    }
    public function delete_document($id){
        $this->db->where("id", $id);
    	$res = $this->db->delete("tbl_emp_document");
		return $res;
    } 

    /* / .documents */
    public function update_documents($id, $file){
        // echo $image_id; die;
         $update = array(
                'doc_type'                  => $this->input->post('type'),
                'upload_file'               => $file,
             );
            //  var_dump($update);die;
         $this->db->where('id',$id);
         return $this->db->update('tbl_emp_document', $update);
     }
   
   

}