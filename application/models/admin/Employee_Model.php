<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_Model extends CI_Model {   
    
     public function __construct() 
     {
          parent::__construct(); 
          $this->load->database();
          $this->admindb = $this->load->database('admindb', TRUE);
     }
     public function insert_emp_personal_details($file){
          if($file == "")
		{
			$file = $this->input->post("upload_image");
		}
          $data = array(
                  'emp_code'                      => $this->input->post('emp_code'),
                  'joining_date'                  => $this->input->post('joining_date'),
               //    'first_name'                    => $this->input->post('first_name'),
               //    'middle_name'                   => $this->input->post('middle_name'),
               //    'last_name'                     => $this->input->post('last_name'),
               //    'date_of_birth'                 => $this->input->post('date_of_birth'),
               //    'gender'                        => $this->input->post('gender'),
               //    'mobile_number'                 => $this->input->post('mobile_number'),
               //    'alternate_mobile_no'           => $this->input->post('alternate_mobile_no'),
               //    'personal_email_id'             => $this->input->post('personal_email_id'),
               //    'official_email_id'             => $this->input->post('official_email_id'),
               //    'marital_status'                => $this->input->post('marital_status'),
               //    'spouse_name'                   => $this->input->post('spouse_name'),
               //    'father_name'                   => $this->input->post('father_name'),
               //    'permant_address'               => $this->input->post('permant_address'),
               //    'current_address'               => $this->input->post('current_address'),
               //    'relative_name'                 => $this->input->post('relative_name'),
               //    'relative_contact_no'           => $this->input->post('relative_contact_no'),
               //    'reference_name'                => $this->input->post('reference_name'),
               //    'reference_contact_no'          => $this->input->post('reference_contact_no'),
               //    'adhar_no'                      => $this->input->post('adhar_no'),
               //    'pan_no'                        => $this->input->post('pan_no'),
               //    'passport_no'                   => $this->input->post('passport_no'),
               //    'education_type'                => $this->input->post('education_type'),
               //    'degree'                        => $this->input->post('degree'),
               //    'termination_date'              => $this->input->post('termination_date'),
               //    'department'                    => $this->input->post('department'),
               //    'job_profile'                   => $this->input->post('job_profile'),
               //    'created_on'                    => date('Y-m-d'),
               //    'updated_on'                    => date('Y-m-d'),
               //    'upload_image'                  => $file,
          );
          $this->db->insert('tbl_emp_enrollement', $data);
          return 1;
      }
      public function get_emp_personal_details()
      {
          $this->db->select('*');
          $this->db->from('tbl_emp_enrollement');
          $query = $this->db->get();
          return $query->row();
      }
      public function insert_employee_details()
      {
          $data = array(
               // 'emp_id'         => $id,
               'company_name'                => $this->input->post('company_name'),
               'company_address'             => $this->input->post('company_address'),
               'date_of_joining'             => $this->input->post('date_of_joining'),
               'date_of_releaving'           => $this->input->post('date_of_releaving'),
               'designation'                 => $this->input->post('designation'),
               'last_drown_salary'           => $this->input->post('last_drown_salary'),
               'job_type'                    => $this->input->post('job_type'),
               'reason_for_leaving'          => $this->input->post('reason_for_leaving'),
               'reference_contact_no'        => $this->input->post('reference_contact_no'),
               'created_on'                  => date('Y-m-d'),
               'updated_on'                  => date('Y-m-d'),
          );
          $this->db->insert('tbl_emp_employment_details', $data);
          return 1;
      }
}