<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Custom_invoice extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Custom_invoice_Model');
		$this->load->library('session');
		$this->load->library('pagination');
        $this->load->helper('download');
        $this->load->library('upload');
        $this->load->library('Send_mail'); 
		$this->load->helper(array('form', 'url'));			
		
	}
    public function list(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['cimenu_active'] = "active menu-open";
			$data['cilist'] = "active";
            $data['custom_details'] = $this->Custom_invoice_Model->get_custom_details();
            //var_dump($data['custom_details']);die;
		    $this->load->view('admin/custom_invoice/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function add(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['cimenu_active'] = "active menu-open";
			$data['ciadd'] = "active";
            $data['reseller_list'] = $this->Custom_invoice_Model->get_reseller_list();
		    $this->load->view('admin/custom_invoice/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert(){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['id'] =$this->input->post('id');
            // var_dump($data['id']);die;
            $reseller_name = $this->input->post('reseller_name');
            $invoiceno = $this->input->post('invoice_no');
            $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);
            $service_no = $data['reseller_service_details']->service_no;
            $service = explode("-", $service_no);
            $service_no1 = $service[1];
            $todays_date = date('m/Y');
            // $invoice_no = 'INVOICE' .'#'.($todays_date.'-'.$service_no1.'-'.$invoiceno);
            $invoice_no = 'INVOICE' .'#'.($invoiceno);
            $s_customer_name = $this->input->post('Shipping_Custome_Name');                 
            foreach($s_customer_name as $customer)
            {	
                $s_customer_name1[]= $customer;
            }
            if($s_customer_name1 != NULL){
                $j= count($s_customer_name1);      
                for($i=0; $i<$j ; $i++)
                {
                    if($i==$j-2)
                    {
                        $s_customer_name2 .=ltrim(rtrim($s_customer_name1[$i])).",";
                    }
                    if($i== $j-1)
                    {
                        $s_customer_name2 .= ltrim(rtrim($s_customer_name1[$i]))."";
                    }
                    if($i<$j-2)
                    {
                        $s_customer_name2 .= ltrim(rtrim($s_customer_name1[$i])).",";
                    }
                }	
            }	
            // var_dump($s_customer_name2); die;
            $s_email_id=$this->input->post('Shipping_Email_Id');
            foreach($s_email_id as $email)
            {
                $s_email_address[]= $email;
            }
            if($s_email_address != NULL){
                $k= count($s_email_address);      
                for($i=0; $i<$k ; $i++)
                {
                    if($i==$k-2)
                    {
                        $s_email_address2 .=ltrim(rtrim($s_email_address[$i])).",";
                    }
                    if($i== $k-1)
                    {
                        $s_email_address2 .= ltrim(rtrim($s_email_address[$i]))."";
                    }
                    if($i<$k-2)
                    {
                        $s_email_address2 .= ltrim(rtrim($s_email_address[$i])).",";
                    }
                }	
            }	
            $Insert_custom_invoice = array(
                'order_title'                       => $this->input->post('order_title'),
                'invoice_no'                        => $invoice_no,
                'order_no'                          => $this->input->post('order_no'),
                'order_date'                        => $this->input->post('order_date'),
                'reseller_name'                     => $this->input->post('reseller_name'),
                'currency'                          => $this->input->post('currency'),
                'shipping_customer_name'            => $s_customer_name2,
                'shipping_email_id'                 => $s_email_address2,               
                'discount_type'                     => $this->input->post('discount_type'),
                'discount_value'                    => $this->input->post('percentage'),
                'total_amount'                      => $this->input->post('total_amount'),
                'created_at'                        => date('Y-m-d'),
                'updated_at'                        => date('Y-m-d'),	
            );
            $Insert_custom_invoice=$this->Custom_invoice_Model->insert_custom_invoice_details($Insert_custom_invoice);

            /* insert multiple invoice title */
            $Title=$this->input->post('title');
            $Price=$this->input->post('price');
            $Unit_no=$this->input->post('unit_no');
            $num =0;
          

            foreach($Title as $row)
            {
                $custom_invoice = array(
                    'order_id'                          => $Insert_custom_invoice,
                    'title'                             => $Title[$num],
                    'price'                             => $Price[$num],
                    'unit_no'                           => $Unit_no[$num],
                    'created_at'                        => date('Y-m-d'),
                    'updated_at'                        => date('Y-m-d'),	
                );
                $custom_invoice=$this->Custom_invoice_Model->insert_invoice_details($custom_invoice);
                $num++;
 
            }
             /* /. insert multiple invoice title */
            if($result){
                $this->session->set_flashdata('msg', 'Data has been inserted successfully...!!!');
            }else {
                $this->session->set_flashdata('msg', 'Sorry, Data has Not updated...!!!');
            }
			redirect('admin/custom_invoice/list');
	 	}else
		{
			$this->load->view("admin/login");
		}
    }
    public function edit($id){
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];

            $data['custom_invoice_data'] = $this->Custom_invoice_Model->get_single_custom_invoice_data($id);
            $reseller_name = $data['custom_invoice_data']->reseller_name;
            $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);
            $data['reseller_list'] = $this->Custom_invoice_Model->get_reseller_list();
            $this->load->view("admin/custom_invoice/edit",$data);
        }else{
            $this->load->view("admin/login");			
        }
    }
    public function update($id){
        // var_dump($_POST);die;
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$reseller_name = $this->input->post('reseller_name');            
            $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);            
            $discount_type = $this->input->post('discount_type');
            $invoice_no =  $this->input->post('invoice_no');
            $invoice = explode("-", $invoice_no);
            $invoiceno = $invoice[0];
            $invoice_no1 = $invoice[1];
            // $invoice_no2 = $invoice[2];
            $invoice_no2 = $this->input->post('invoice_number');
           
            $service_no = $data['reseller_service_details']->service_no;
            $service = explode("-", $service_no);
            $service_no1 = $service[1];
            $invoice_no = $invoiceno.'-'.$service_no1.'-'.$invoice_no2;
            if($discount_type == "Percentage"){                             
                $discount_value = $this->input->post('percentage');
            }else {
                $discount_value = $this->input->post('absolute_price');
            }
            /* extract shipping email & user name */
            $s_customer_name = $this->input->post('Shipping_Custome_Name');   
              
            foreach($s_customer_name as $customer)
            {	
                $s_customer_name1[]= $customer;
            }
            if($s_customer_name1 != NULL){
                $j= count($s_customer_name1);      
                for($i=0; $i<$j ; $i++)
                {
                    if($i==$j-2)
                    {
                        $s_customer_name2 .=ltrim(rtrim($s_customer_name1[$i])).",";
                    }
                    if($i== $j-1)
                    {
                        $s_customer_name2 .= ltrim(rtrim($s_customer_name1[$i]))."";
                    }
                    if($i<$j-2)
                    {
                        $s_customer_name2 .= ltrim(rtrim($s_customer_name1[$i])).",";
                    }
                }	
            }	
            // var_dump($s_customer_name2); die;
            $s_email_id=$this->input->post('Shipping_Email_Id');
            foreach($s_email_id as $email)
            {
                $s_email_address[]= $email;
            }
            if($s_email_address != NULL){
                $k= count($s_email_address);      
                for($i=0; $i<$k ; $i++)
                {
                    if($i==$k-2)
                    {
                        $s_email_address2 .=ltrim(rtrim($s_email_address[$i])).",";
                    }
                    if($i== $k-1)
                    {
                        $s_email_address2 .= ltrim(rtrim($s_email_address[$i]))."";
                    }
                    if($i<$k-2)
                    {
                        $s_email_address2 .= ltrim(rtrim($s_email_address[$i])).",";
                    }
                }	
            }	
            $update = array(
                'title'                             => $this->input->post('title'),
                'invoice_no'                        => $invoice_no,
                'order_no'                          => $this->input->post('order_no'),
                'order_date'                        => $this->input->post('order_date'),
                'currency'                          => $this->input->post('currency'),
                'reseller_name'                     => $this->input->post('reseller_name'),
                'shipping_customer_name'            => $s_customer_name2,
                'shipping_email_id'                 => $s_email_address2,
                'price'                             => $this->input->post('price'),
                'unit_no'                           => $this->input->post('unit_no'),
                'discount_type'                     => $this->input->post('discount_type'),
                'discount_value'                    => $discount_value,
                'total_amount'                      => $this->input->post('total_amount'),
                'updated_at'                        => date('Y-m-d'),	
            );
            $result = $this->Custom_invoice_Model->update($id, $update);
            // var_dump($result); die;
            if($result){
                $this->session->set_flashdata('msg', 'Data has been updated successfully...!!!');
            }else {
                $this->session->set_flashdata('msg', 'Sorry, Data has Not updated...!!!');
            }
			redirect('admin/custom_invoice/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function view($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

			$data['id'] = $id;
            $custom_invoice = $this->Custom_invoice_Model->get_custom_invoice_records($id);
            $custom_invoice_details = $this->Custom_invoice_Model->get_custom_invoice_details($id);
            // var_dump($custom_invoice_details);die;
            $data['unit_no'] = $custom_invoice_details->unit_no;
            $data['title'] = $custom_invoice_details->title;
            // var_dump($data['title']);die;
            $data['order_date'] = $custom_invoice->order_date;
            $data['reseller_name'] = $custom_invoice->reseller_name;
            $data['shipping_customer_name'] = $custom_invoice->shipping_customer_name;
            $data['shipping_email_id'] = $custom_invoice->shipping_email_id;
            $data['invoice_no'] = $custom_invoice->invoice_no;
            $data['unit_no'] = $custom_invoice->unit_no;
            $data['order_no'] = $custom_invoice->order_no;
            $data['title'] = $custom_invoice->title;
            $data['price'] = $custom_invoice->price;
            $data['discount_value'] = $custom_invoice->discount_value;
            $data['discount_type'] = $custom_invoice->discount_type;
            $data['subtotal'] = $data['price'] * $data['unit_no'];
            $data['total_amount'] = $custom_invoice->total_amount;
            $percent = 50;
            $data['commission_dis'] = ($percent / 100) * $data['total_amount'];
            // var_dump($data['commission_dis']);die;
            $this->load->view('admin/custom_invoice/view',$data);	
        }
    }
    public function donwload($id){
        // var_dump($_POST);die;
        $custom_invoice_data = $this->Custom_invoice_Model->get_custom_invoice_data($id);
        $custom_invoice_details = $this->Custom_invoice_Model->get_custom_invoice_details($id);
        $last_row_id= $custom_invoice_data->id;
        // var_dump($custom_invoice_details);die;
        foreach($custom_invoice_details as $custom_data)
        {
            // $order_no[]= $custom_data['order_no'];
            $unit_no[]= $custom_data['unit_no'];
            $title[]= $custom_data['title'];
            $price[]= $custom_data['price'];
            $subtotal[]= $custom_data['price'];
        }
        // var_dump($subtotal);die;
        $todays_date = date('F d, Y');
        $order_date = $custom_invoice_data->order_date;
        $date = date('d F, Y', strtotime($order_date));
        // var_dump($custom_invoice_data);die;
        $reseller_name = $custom_invoice_data->reseller_name;
        $shipping_customer_name = $custom_invoice_data->shipping_customer_name;
        $shipping_email_id = $custom_invoice_data->shipping_email_id;
      $order_no = $custom_invoice_data->order_no;
         /*  $unit_no = $custom_invoice_data->unit_no;
        $title = $custom_invoice_data->title;
        $price = $custom_invoice_data->price; */
        $currency = $custom_invoice_data->currency;
        $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);
        $service_no = $data['reseller_service_details']->service_no;
        $service = explode("-", $service_no);
        $service_no1 = $service[1];
        $order_title = $custom_invoice_data->order_title;
        $invoice_no = $custom_invoice_data->invoice_no;
        $discount_type = $custom_invoice_data->discount_type;
        $discount_value = $custom_invoice_data->discount_value;
        $total_amount = $custom_invoice_data->total_amount;
        $invoice_id = $custom_invoice_data->id;
        // $subtotal = $price * $unit_no;
        $percent = 50;
        $commission_dis = ($percent / 100) * $total_amount;
        
        if($discount_type == "Percentage"){
            $discount_value = $discount_value.'%';
        }else{
            $discount_value = $discount_value;
        }

        // $discount_amt = ($discount_value / 100) * $subtotal;
        $discount_amt = 0.00;
        // var_dump($discount_amt);die;

        // $invoice_no = 'INVOICE' .'#'.($todays_date.'-'.$service_no1.'-'.$invoiceno.str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT));
        // $invoice_no = str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT);
        if($reseller_name == "Research and Markets"){
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_rnm.docx');
        } else if($reseller_name == "Global Information Inc."){
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_gii.docx');
        } else if($reseller_name == "Scott International"){
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_scott.docx');
        }else if($reseller_name == "Marketreasearch.com"){
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_mrdc.docx');
        }
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('OrderDate', htmlspecialchars($date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars($invoice_no));
        $templateProcessor->setValue('Name', htmlspecialchars($shipping_customer_name));
        $templateProcessor->setValue('EmailId', htmlspecialchars($shipping_email_id));
        $templateProcessor->setValue('OrderNo', htmlspecialchars($order_no));
        $templateProcessor->setValue('OrderNo2', htmlspecialchars($order_no));
        $templateProcessor->setValue('UnitNo', htmlspecialchars($unit_no[0]));
        $templateProcessor->setValue('UnitNo2', htmlspecialchars($unit_no[1]));
        $templateProcessor->setValue('Title', htmlspecialchars($title[0]));
        $templateProcessor->setValue('Title2', htmlspecialchars($title[1]));
        $templateProcessor->setValue('Price', htmlspecialchars($price[0]));
        $templateProcessor->setValue('Price2', htmlspecialchars($price[1]));
        $templateProcessor->setValue('Subtotal', htmlspecialchars($subtotal[0]));
        $templateProcessor->setValue('Subtotal2', htmlspecialchars($subtotal[1]));
        $templateProcessor->setValue('discount_value', htmlspecialchars($discount_value));
        $templateProcessor->setValue('discount_amt', htmlspecialchars($discount_amt));
        $templateProcessor->setValue('Commission', htmlspecialchars($commission_dis));
        $templateProcessor->setValue('Total', htmlspecialchars($commission_dis));
        $templateProcessor->setValue('Currency', htmlspecialchars($currency));
        //   $filename = $report_name."- Proforma Invoice.docx";
        $filename = "Invoice to".' '.htmlspecialchars($order_title). ' '. "Order". ' '.$order_no."- Invoice.docx";
       
        $new_file_name=str_replace(" ","-", htmlspecialchars($filename));			
			$new_file_name=str_replace("/","-", $new_file_name);
			$new_file_name=str_replace(",","-", $new_file_name);
			$new_file_name=str_replace("--","-", $new_file_name);
            // var_dump($new_file_name);die;
        //   var_dump($filename);die;
        header('Content-Disposition: attachment; filename='.$new_file_name);
        ob_clean();
        $templateProcessor->saveAs('php://output');	
    }   
}
    

