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
            $invoiceno = $this->input->post('invoice_no');           
            $invoice_no = 'INVOICE#'.$invoiceno;
            /* Discount amount as per type */
            $discount_type = $this->input->post('discount_type');
            if($discount_type == "Absolute"){
                $discount_amount = $this->input->post('absolute_price');
            }else{
                $discount_amount = $this->input->post('percentage');
            }

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
                'discount_value'                    => $discount_amount,
                'total_amount'                      => $this->input->post('total_amount'),
                'created_at'                        => date('Y-m-d'),
                'updated_at'                        => date('Y-m-d'),	
            );
            $Insert_custom_invoice = $this->Custom_invoice_Model->insert_custom_invoice_details($Insert_custom_invoice);

            /* insert multiple invoice title */
            $Title = $this->input->post('title');
            $Price = $this->input->post('price');
            $Unit_no = $this->input->post('unit_no');
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
             /* ./ insert multiple invoice title */
            if($result){
                $this->session->set_flashdata('msg', 'Data has been inserted successfully...!!!');
            }else {
                $this->session->set_flashdata('msg', 'Sorry, Data has Not updated...!!!');
            }
			redirect('admin/custom_invoice/list');
	 	}
        else
		{
			$this->load->view("admin/login");
		}
    }
    public function edit($id){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data['Login_user_name']=$session_data['Login_user_name'];	
            $data['Role_id']=$session_data['Role_id'];

            $data['custom_invoice_data'] = $this->Custom_invoice_Model->get_single_custom_invoice_data($id);
            $data['custom_invoice_details'] = $this->Custom_invoice_Model->get_custom_invoice_details($id);
            $reseller_name = $data['custom_invoice_data']->reseller_name;
            $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);
            $data['reseller_list'] = $this->Custom_invoice_Model->get_reseller_list();
            $this->load->view("admin/custom_invoice/edit",$data);
        }else{
            $this->load->view("admin/login");			
        }
    }
    public function update($order_id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];

            $invoice_no =  $this->input->post('invoice_no');
            $invoice_no = 'INVOICE#'.$invoice_no;

            $discount_type = $this->input->post('discount_type');
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

            $update_custom_invoice = array(
                'order_title'                       => $this->input->post('order_title'),
                'invoice_no'                        => $invoice_no,
                'order_no'                          => $this->input->post('order_no'),
                'order_date'                        => $this->input->post('order_date'),
                'reseller_name'                     => $this->input->post('reseller_name'),
                'currency'                          => $this->input->post('currency'),
                'shipping_customer_name'            => $s_customer_name2,
                'shipping_email_id'                 => $s_email_address2,               
                'discount_type'                     => $this->input->post('discount_type'),
                'discount_value'                    => $discount_value,
                'total_amount'                      => $this->input->post('total_amount'),
                'updated_at'                        => date('Y-m-d'),	
            );
            $update_custom_invoice1 = $this->Custom_invoice_Model->update($order_id, $update_custom_invoice);
            /* Updating invoice data */
            $invoice_id = $this->input->post('invoice_id');
            $Title = $this->input->post('title');
            $Price = $this->input->post('price');
            $Unit_no = $this->input->post('unit_no');
            $total = count($Title);
            for($n= 0; $n < $total;  $n++)
            {
                $invoice_id1 = $invoice_id[$n];
                if($invoice_id1 == ""){
                    $custom_invoice = array(
                        'order_id'                          => $order_id,
                        'title'                             => $Title[$n],
                        'price'                             => $Price[$n],
                        'unit_no'                           => $Unit_no[$n],
                        'created_at'                        => date('Y-m-d'),
                        'updated_at'                        => date('Y-m-d'),	
                    );
                    $custom_invoice = $this->Custom_invoice_Model->insert_invoice_details($custom_invoice);
                }else{
                    $update_invoice = array(
                        'title'                             => $Title[$n],
                        'price'                             => $Price[$n],
                        'unit_no'                           => $Unit_no[$n],
                        'updated_at'                        => date('Y-m-d'),	
                    );
                    $update_invoice = $this->Custom_invoice_Model->update_invoice($invoice_id1,$update_invoice);
                }
            }
           /* ./ Updating invoice data */
            if($update_invoice){
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
        // var_dump($_POST);die;
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['custom_invoice_details'] = $this->Custom_invoice_Model->get_custom_invoice_details($id);
            $custom_invoice = $this->Custom_invoice_Model->get_custom_invoice_records($id);
            $data['id'] = $custom_invoice->id;
            $data['order_date'] = $custom_invoice->order_date;
            $data['reseller_name'] = $custom_invoice->reseller_name;
            $data['shipping_customer_name'] = $custom_invoice->shipping_customer_name;
            $data['shipping_email_id'] = $custom_invoice->shipping_email_id;
            $data['invoice_no'] = $custom_invoice->invoice_no;
            $data['created_at'] = $custom_invoice->created_at;
            $data['discount_value'] = $custom_invoice->discount_value;
            $data['discount_type'] = $custom_invoice->discount_type;
            $data['subtotal'] = $data['price'] * $data['unit_no'];
            $data['total_amount'] = $custom_invoice->total_amount;
           
            if($data['discount_type']=="Percentage"){
                $percent = 50;
                $data['commission_dis'] = $data['total_amount']/2;
                 
            }else{
                $data['commission_dis'] = ($data['total_amount'])/2;
                //var_dump($data['commission_dis']);die;
            }           
            $this->load->view('admin/custom_invoice/view',$data);	
        }
    }
    public function download($id){

        $custom_invoice_data = $this->Custom_invoice_Model->get_custom_invoice_data($id);
        $custom_invoice_details= $this->Custom_invoice_Model->get_custom_invoice_details($id);
        foreach($custom_invoice_details as $data)
        {
            $title[]= $data['title'];
            $price[]= $data['price'];
            $unit_no[]= $data['unit_no'];
            $order_no[]= $data['order_no'];
            $subtotal[]= $data['price'] * $data['unit_no'];
        }
        $title_no = count($title);
        $order_title= $custom_invoice_data->order_title;
        $last_row_id= $custom_invoice_data->id;
        $todays_date = date('F d, Y');
        $order_date = $custom_invoice_data->order_date;
        $date = date('d F, Y', strtotime($order_date));
        $reseller_name = $custom_invoice_data->reseller_name;
        $shipping_customer_name = $custom_invoice_data->shipping_customer_name;
        $shipping_email_id = $custom_invoice_data->shipping_email_id;
        $currency = $custom_invoice_data->currency;
        $data['reseller_service_details'] = $this->Custom_invoice_Model->get_single_reseller_details($reseller_name);
        $service_no = $data['reseller_service_details']->service_no;
        $service = explode("-", $service_no);
        $service_no1 = $service[1];
        $invoice_no = $custom_invoice_data->invoice_no;
        $discount_type = $custom_invoice_data->discount_type;e;
        $total_amount = $custom_invoice_data->total_amount;
        $invoice_id = $custom_invoice_data->id;
        if($reseller_name == "Research and Markets"){
            // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_rnm.docx');
            $short_name = "RnM";
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_rnm.docx');
        } else if($reseller_name == "Global Information Inc."){
            $short_name = "GII";
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_gii.docx');
        } else if($reseller_name == "Scott International"){
            $short_name = "SCOTT";
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_scott.docx');
        }else if($reseller_name == "Marketreasearch.com"){
            $short_name = "MRDC";
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice_mrdc.docx');
        }
       if($title_no>1){
        $templateProcessor->cloneRow('title', $title_no);
        $n =1;
        for($i=0; $i<$title_no; $i++){
            //var_dump($title[$i]);
            $templateProcessor->setValue('title#'.$n, htmlspecialchars($title[$i]));
            $templateProcessor->setValue('Price#'.$n, htmlspecialchars($price[$i]));
            $templateProcessor->setValue('UnitNo#'.$n, htmlspecialchars($i+1));
            $templateProcessor->setValue('OrderNo#'.$n, htmlspecialchars($order_no[$i]));
            $templateProcessor->setValue('Subtotal#'.$n, htmlspecialchars($subtotal[$i]));
            $total1+= $subtotal[$i];
            $n++;
        }
        if($discount_type == "Percentage"){
            $discount_value = $custom_invoice_data->discount_value;
            $discount_amt = ($discount_value / 100) * $total1;
            $balance_amt = $total1-$discount_amt;
            $percent = 50;
            $commission_dis = ($percent / 100) * $balance_amt;
        }else{           
            $discount_value = (($custom_invoice_data->discount_value / $total1)*100);  
            $discount_value = number_format($discount_value,2);                  
            $discount_amt = ($discount_value / 100) * $total1;     
            $commission_dis = ($total1-$discount_amt)/2;
        }     
    }else{
            $templateProcessor->setValue('title', htmlspecialchars($title[0]));
            $templateProcessor->setValue('Price', htmlspecialchars($price[0]));
            $templateProcessor->setValue('UnitNo', htmlspecialchars($i+1));
            $templateProcessor->setValue('OrderNo', htmlspecialchars($order_no[0]));
            $templateProcessor->setValue('Subtotal', htmlspecialchars($subtotal[0]));
            if($discount_type == "Percentage"){
                $discount_value = $custom_invoice_data->discount_value;
                $discount_amt = ($discount_value / 100) * $subtotal[0];
                $subtotal = $price[0] * $unit_no[0];
                $percent = 50;
                $commission_dis = ($percent / 100) * $total_amount;
            }else{
                $discount_value = (($custom_invoice_data->discount_value / $subtotal[0])*100); 
                $discount_value = number_format($discount_value,2);               
                $discount_amt = $custom_invoice_data->discount_value;
                $commission_dis = $total_amount/2;
            }            
        }
        // $templateProcessor->setValue('title', implode("\n", $allTitles));
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('OrderDate', htmlspecialchars($date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars($invoice_no));        
        $templateProcessor->setValue('Name', htmlspecialchars($shipping_customer_name));
        $templateProcessor->setValue('EmailId', htmlspecialchars($shipping_email_id));
        $templateProcessor->setValue('discount_value', htmlspecialchars($discount_value.'%'));
        $templateProcessor->setValue('discount_amt', htmlspecialchars($discount_amt));        
        $templateProcessor->setValue('Commission', htmlspecialchars($commission_dis));
        $templateProcessor->setValue('Total', htmlspecialchars($commission_dis));
        $templateProcessor->setValue('Currency', htmlspecialchars($currency));
		$new_file_name1=str_replace("/"," ", htmlspecialchars($order_title));
		$new_file_name2=str_replace(","," ", $new_file_name1);
		$new_file_name3=str_replace("&amp;","and", $new_file_name2);
		$new_file_name4=str_replace("--"," ", $new_file_name3);
        $filename = "Invoice to".' '.$short_name.' '.$new_file_name4. ' '. "Order". ' '.htmlspecialchars($order_no[0]).".docx";
        header('Content-Disposition: attachment; filename='.$filename);
        ob_clean();
        $templateProcessor->saveAs('php://output');	
    }   
}
    

