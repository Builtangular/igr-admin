<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('display_errors', '0');
class Country_company extends CI_Controller {    
	public function __construct(){		
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Data_model');
        $this->load->model('admin/Country_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));				
	}
	public function index($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$data['report_id']= $id;	
			$data['Companies']= $this->Country_model->get_rd_companies($id);
            // var_dump($data['Companies']); die;
			$this->load->view('admin/country_rd/company/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function add($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$data['report_id']=$id;	
			$this->load->view('admin/country_rd/company/add',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function insert($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

            $button_type = $this->input->post('button');
            if($button_type == "Submit"){
                $postcomp=array(				
                    'name'=>$this->input->post('name'),
                    'report_id'=>$id,
                    'updated_at'=> date('Y-m-d h:i:sa')
                );
                $inserted_id = $this->Country_model->insert_rd_company_data($postcomp);
                if($inserted_id){
                    $this->session->set_flashdata("success_code","Data has been inserted successfully..!!!");		
                }else{
                    $this->session->set_flashdata("success_code","Sorry! Data has not inserted");
                }
                redirect('admin/country_company/add/'.$id);
            }else{
                redirect('admin/country_company/'.$id);
            }
		}		
		else{			
			$this->load->view('admin/login');
		}
	}
	public function edit($cmp_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$company = $this->Country_model->get_rd_company($cmp_id);		
			$data['company_id']= $company->id;
			$data['company_name']= $company->name;
			$data['report_id']= $company->report_id;
			$this->load->view('admin/country_rd/company/edit',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function update($cmp_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$report_id = $this->input->post('report_id');
			$postcomp=array(				
				'name'=>$this->input->post('name'),
				'updated_at'=> date('Y-m-d h:i:sa')
			);
			$result = $this->Country_model->update_rd_company($cmp_id,$postcomp);
			if($result){
				$this->session->set_flashdata("success_code","Data has been updated successfully..!!!");
			}else{
				$this->session->set_flashdata("success_code","Sorry! Data has not updated");	
			}
			redirect('admin/country_company/'.$report_id);
		}else{			
			$this->load->view('admin/login');
		}
	}
	public function delete($cmp_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['success_code'] = $this->session->userdata('success_code');

			$report_id = $this->input->post('report_id');			
			$result = $this->Country_model->delete_rd_company($cmp_id);
			if($result){
				$this->session->set_flashdata("success_code","Record has been deleted successfully..!!!");	
			}else{
				$this->session->set_flashdata("success_code","Sorry! Record has not deleted");			
			}	
			redirect('admin/country_company/'.$report_id);
		}else{			
			$this->load->view('admin/login');
		}
	}
}
?>