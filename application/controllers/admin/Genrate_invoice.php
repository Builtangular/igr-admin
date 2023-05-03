<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '0');
class Genrate_invoice extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Genrate_Invoice_Model');
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
			$data['query_details'] = $this->Genrate_Invoice_Model->get_query_details();
			$data['invoice_details'] = $this->Genrate_Invoice_Model->get_invoice_details();
            $data['invoice_title']= $data['invoice_details']->invoice_title;
		    $this->load->view('admin/genrate_invoice/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function add_invoice($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
            $query_details = $this->Genrate_Invoice_Model->get_query_records($id);
            $data['report_name'] = $query_details->report_name;
		    $this->load->view('admin/genrate_invoice/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert_invoice($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['id'] = $id;
            // $id = $_POST['id'];
            $query_details = $this->Genrate_Invoice_Model->get_query_records($id);
            $report_name = $query_details->report_name;
            $s_address_billing = $_POST['s_address_billing'];
            $query_invoice_details = $this->Genrate_Invoice_Model->get_single_invoice_details();
            $last_row_id= $query_invoice_details->id;
            $last_id= $query_invoice_details->id;
            $invoice_id = $query_details->id;
            $reseller_name= $query_details->reseller_name;
            $todays_date = date('m/Y');
            $date = date('M');
            $num = 0;
            // $invoice_no = 'INVOICE' .'#'.($todays_date.'-IN'.'-').str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT);
            $newDate = date('M');
            $invoice_no = 'PROINV'.(strtoupper($newDate)).'10'.str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT);
            $order_no = 'INH'.''.(strtoupper($newDate)).'0'.str_pad($last_id+1, 2, "0", STR_PAD_LEFT);
            $Shipping_Custome_Name=$this->input->post('Shipping_Custome_Name');
            $Shipping_Email_Id=$this->input->post('Shipping_Email_Id');
            $Shipping=$this->input->post('shipping_customer_name');
            $Email=$this->input->post('shipping_email_id');
            /* array seprate the value */
            $num = 0;
            $value= $this->input->post('Shipping_Custome_Name');
            $email= $this->input->post('Shipping_Email_Id');
            
            foreach($value as $row)
            {
            $s_customer_name.= $row.', ';
            }

            foreach($email as $data)
            {
            $s_email_address.= $data.', ';
            }
             /* /.array seprate the value */
            // var_dump($s_customer_name);die;
            if($s_address_billing == "")
			{
                $Insert_invoice=array(
                    'query_id'                          => $id,
                    'query_name'                        => $report_name,
                    'invoice_title'                     => $this->input->post('invoice_title'),
                    'invoice_no'                        => $invoice_no,
                    'main_invoice_no'                   => $this->input->post('main_invoice_no'),
                    'order_date'                        => $this->input->post('order_date'),
                    'currency'                          => $this->input->post('currency'),
                    'state'                             => $this->input->post('state'),
                    'customer_gst_no'                   => $this->input->post('customer_gst_no'),
                    'order_no'                          => $order_no,
                    'billing_customer_name'             => $this->input->post('billing_customer_name'),
                    'billing_company_name'              => $this->input->post('billing_company_name'),
                    'billing_phone_no'                  => $this->input->post('billing_phone_no'),
                    'billing_email_id'                  => $this->input->post('billing_email_id'),
                    'billing_zipcode'                   => $this->input->post('billing_zipcode'),
                    'billing_address1'                  => $this->input->post('billing_address1'),
                    'billing_address2'                  => $this->input->post('billing_address2'),
                    'billing_city'                      => $this->input->post('billing_city'),
                    'billing_state'                     => $this->input->post('billing_state'),
                    'shipping_customer_name'            => $s_customer_name,
                    'shipping_email_id'                 => $s_email_address,
                    'unit_price'                        => $this->input->post('unit_price'),
                    'unit_no'                           => $this->input->post('unit_no'),
                    'discount'                          => $this->input->post('percentage'),
                    // 'absolute_price'                    => $this->input->post('absolute_price'),
                    'total_amount'                      => $this->input->post('total_amount'),
                    'created_at'                        => date('Y-m-d'),
                    'updated_at'                        => date('Y-m-d'),			
                );
                $result=$this->Genrate_Invoice_Model->insert_invoice_details($Insert_invoice);
            }
           else if($s_address_billing =="Yes")
			{
				$Insert_billing=array(
                    'query_id'                          => $id,
                    'query_name'                        => $report_name,
                    'invoice_title'                     => $this->input->post('invoice_title'),
                    'invoice_no'                        => $invoice_no,
                    'main_invoice_no'                   => $this->input->post('main_invoice_no'),
                    'order_date'                        => $this->input->post('order_date'),
                    'currency'                          => $this->input->post('currency'),
                    'state'                             => $this->input->post('state'),
                    'customer_gst_no'                   => $this->input->post('customer_gst_no'),
                    'order_no'                          => $order_no,
                    'billing_customer_name'             => $this->input->post('billing_customer_name'),
                    'billing_company_name'              => $this->input->post('billing_company_name'),
                    'billing_phone_no'                  => $this->input->post('billing_phone_no'),
                    'billing_email_id'                  => $this->input->post('billing_email_id'),
                    'billing_zipcode'                   => $this->input->post('billing_zipcode'),
                    'billing_address1'                  => $this->input->post('billing_address1'),
                    'billing_address2'                  => $this->input->post('billing_address2'),
                    'billing_city'                      => $this->input->post('billing_city'),
                    'billing_state'                     => $this->input->post('billing_state'),
                    's_address_billing'                 => $s_address_billing,
                    'shipping_customer_name'            => $this->input->post('billing_customer_name'),
                    'shipping_email_id'                 => $this->input->post('billing_email_id'),
                    'unit_price'                        => $this->input->post('unit_price'),
                    'unit_no'                           => $this->input->post('unit_no'),
                    'discount'                          => $this->input->post('percentage'),
                    'total_amount'                      => $this->input->post('total_amount'),
                    'created_at'                        => date('Y-m-d'),
                    'updated_at'                        => date('Y-m-d'),
                );
                $result=$this->Genrate_Invoice_Model->insert_invoice_details($Insert_billing);
			}
			if($result)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/genrate_invoice/list');
	 	}else
		{
			$this->load->view("admin/login");
		}
	}
    public function edit($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $id = $id;
            // var_dump($id);die;
            $data['invoice_data'] = $this->Genrate_Invoice_Model->get_single_invoice_records($id);
            // var_dump($data['invoice_data']);die;
			$this->load->view("admin/genrate_invoice/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    public function update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$id = $this->input->post('id');
			$this->Genrate_Invoice_Model->update($id);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
			redirect('admin/genrate_invoice/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['delete'] = $this->Genrate_Invoice_Model->delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/genrate_invoice/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function view($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
			$invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
			$query_details = $this->Genrate_Invoice_Model->get_query_record($id);
            $s_address_billing = $invoice_records->s_address_billing;
            $data['order_date'] = $invoice_records->order_date;
            $data['billing_customer_name'] = $invoice_records->billing_customer_name;
            $data['billing_company_name'] = $invoice_records->billing_company_name;
            $data['billing_phone_no'] = $invoice_records->billing_phone_no;
            $data['billing_email_id'] = $invoice_records->billing_email_id;
            $data['billing_address1'] = $invoice_records->billing_address1;
            $data['billing_address2'] = $invoice_records->billing_address2;
            $data['billing_city'] = $invoice_records->billing_city;
            $data['billing_state'] = $invoice_records->billing_state;
            $data['billing_zipcode'] = $invoice_records->billing_zipcode;
            $data['s_address_billing'] = $invoice_records->s_address_billing;
            $data['shipping_customer_name'] = $invoice_records->shipping_customer_name;
            $data['shipping_email_id'] = $invoice_records->shipping_email_id;
            $data['customer_gst_no'] = $invoice_records->customer_gst_no;
            $data['total_amount'] = $invoice_records->total_amount;
            $data['unit_no'] = $invoice_records->unit_no;
            $data['order_no'] = $invoice_records->order_no;
            $data['unit_price'] = $invoice_records->unit_price;
            $data['created_at'] = $invoice_records->created_at;
            $data['discount'] = $invoice_records->discount;
            $data['currency']= $invoice_records->currency;
            $data['mult'] = $data['unit_price'] * $data['unit_no'];
            $data['invoice_title'] = $invoice_records->invoice_title;
            $amount = $data['total_amount'];
            $percent = 18;
            $subtotal = $amount;
            $data['discount_igst'] = ($percent / 100) * $subtotal;
            if($data['currency'] == "INR"){
                $data['Total_amount']= $amount + $data['discount_igst'];
            }else{
                $data['Total_amount']= $amount;
            }
            // var_dump($data['Total_amount']);die;
            $this->load->view('admin/genrate_invoice/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function donwload($id){
        $invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
        // var_dump($invoice_records);die;
        $query_details = $this->Genrate_Invoice_Model->get_query_record($id);
        // var_dump($query_details);die;
        $reseller_name= $query_details->reseller_name;
        $service_no= $query_details->service_no;
        $service = explode("-", $service_no);
        $service_no1 = $service[1];
        if($service_no1 == "RNM" || $service_no1 == "GII" || $service_no1 == "SC" || $service_no1 == "MRC"){
            $todays_date = date('m/Y');
            $date = date('M');
            $reseller = $reseller_name;
            $invoice_no = 'INVOICE' .'#'.($todays_date.$service_no1).($last_row_id + 1);
        }else {
            $todays_date = date('m/Y');
            $date = date('M');
            $invoice_no = 'INVOICE' .'#'.($todays_date.'-IN').($last_row_id + 1);
        }
        $main_invoice_no = $invoice_records->main_invoice_no;
        // var_dump($main_invoice_no);die;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice.docx');
        $todays_date = date('F d, Y');
        $s_address_billing = $invoice_records->s_address_billing;
        $report_name = $invoice_records->invoice_title;
        $billing_customer_name = $invoice_records->billing_customer_name;
        $billing_phone_no = $invoice_records->billing_phone_no;
        $billing_email_id = $invoice_records->billing_email_id;
        $billing_address1 = $invoice_records->billing_address1;
        $billing_address2 = $invoice_records->billing_address2;
        $billing_city = $invoice_records->billing_city;
        $billing_state = $invoice_records->billing_state;
        $billing_zipcode = $invoice_records->billing_zipcode;
        $billing_company_name = $invoice_records->billing_company_name;
        $shipping_customer_name = $invoice_records->shipping_customer_name;
        $shipping_email_id = $invoice_records->shipping_email_id;
        $customer_gst_no = $invoice_records->customer_gst_no;
        $order_no = $invoice_records->order_no;
        $currency = $invoice_records->currency;
        $state = $invoice_records->state;
        $order_date = $invoice_records->order_date;
        $currency = $invoice_records->currency;
        $total_amount = $invoice_records->total_amount;
        $unit_no = $invoice_records->unit_no;
        $unit_price = $invoice_records->unit_price;
        $discount = $invoice_records->discount;
        $mult = $unit_price * $unit_no;
        $discount_amt = ($discount / 100) * $mult;
        // $discount_amt1 = number_format($discount_amt,2);
        $discount_amt1 = $discount_amt;
        $percent = 18;
        $total = $total_amount;
        // var_dump($total);die;
        $discount_igst = ($percent / 100) * $total;
        // var_dump($discount_igst);die;

        $order_date = date('d F, Y', strtotime($order_date));
        $address = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' - '.$billing_zipcode;
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars('Proforma Invoice No:'.$invoice_no));
        $templateProcessor->setValue('Invoice', htmlspecialchars($reseller_name));
        $templateProcessor->setValue('PhoneNO', htmlspecialchars($billing_phone_no));
        $templateProcessor->setValue('BName', htmlspecialchars($billing_customer_name));
        $templateProcessor->setValue('BEmail', htmlspecialchars($billing_email_id));
        $templateProcessor->setValue('Address', htmlspecialchars($address));
        $templateProcessor->setValue('Company Name', htmlspecialchars($billing_company_name));
        $templateProcessor->setValue('OrderNo', htmlspecialchars($order_no));
        $templateProcessor->setValue('UnitNo', htmlspecialchars($unit_no));
        $templateProcessor->setValue('Report Title', htmlspecialchars($report_name));
        $templateProcessor->setValue('Unit Price', htmlspecialchars($unit_price));
        $templateProcessor->setValue('Subtotal', htmlspecialchars($mult));
        $templateProcessor->setValue('OrderDate', htmlspecialchars($order_date));
        if($currency == "INR"){
            $templateProcessor->setValue('GSTNoLabel', htmlspecialchars("GST No.:"));
            $templateProcessor->setValue('GSTNo', htmlspecialchars($customer_gst_no));
            $templateProcessor->setValue('GSTNLUTLabel', htmlspecialchars("GST No.:"));
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("XYZ232655"));
        }else {
            $templateProcessor->setValue('GSTNoLabel', htmlspecialchars(""));
            $templateProcessor->setValue('GSTNo', htmlspecialchars(""));
            $templateProcessor->setValue('GSTNLUTLabel', htmlspecialchars("LUT No.:"));
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("AD270721010182M"));
        }
        $templateProcessor->setValue('User Name', htmlspecialchars($shipping_customer_name));
        $templateProcessor->setValue('SEmail', htmlspecialchars($shipping_email_id));
        $templateProcessor->setValue('currency', htmlspecialchars($currency));
        if($discount > 0){
        $templateProcessor->setValue('Discount', htmlspecialchars("- Discount (".$discount."%)"));
        $templateProcessor->setValue('disc_amount', htmlspecialchars($discount_amt1));
        }else{
            $templateProcessor->setValue('Discount', htmlspecialchars(""));
            $templateProcessor->setValue('disc_amount', htmlspecialchars(""));
        }
        if($state == "Maharastra"){
            $percent = 9;
            $total = $total_amount;
            $discount_cgst = ($percent / 100) * $total;
            $discount_sgst = ($percent / 100) * $total;
            $templateProcessor->setValue('gst_type1', htmlspecialchars("+ CGST (9%)"));
            $templateProcessor->setValue('gst_type2', htmlspecialchars("+ SGST (9%)"));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars($discount_cgst));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars($discount_sgst));
        }else if($state == "Other State"){
           
            $templateProcessor->setValue('gst_type1', htmlspecialchars("+ IGST (18%)"));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars($discount_igst));
            $templateProcessor->setValue('gst_type2', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars(""));
        }else{
            
            $templateProcessor->setValue('gst_type1', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars(""));
            $templateProcessor->setValue('gst_type2', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars(""));
        }
        $total_price = $mult - $discount_amt1;
        // var_dump($total);die;
        if($currency == "INR"){
            $total_price = $total_price + $discount_igst;            
        }else{
            $total_price = $total_price;
        }
        // $total_price = ceil($total_price);
        $total_price = $total_price;
        if($currency == "INR"){
            $data['Total_amount']= $amount + $data['discount_igst'];
        }else{
            $data['Total_amount']= $amount;
        }
        // var_dump( $total_price);die;
        $templateProcessor->setValue('total', htmlspecialchars(number_format($total_price,2)));
        
        if (($total_price < 0) || ($total_price > 999999999)) 
        {
            throw new Exception('Number is out of range');
        }
        // var_dump($total_price);die;
      
        $giga = floor($total_price / 1000000);
        // Millions (giga)
        $total_price -= $giga * 1000000;
        // var_dump($total_price);die;
        $kilo = floor($total_price / 1000);
        // Thousands (kilo)
        $total_price -= $kilo * 1000;
        $hecto = floor($total_price / 100);
        // Hundreds (hecto)
        $total_price -= $hecto * 100;
        $deca = floor($total_price / 10);
        // Tens (deca)
        $n = $total_price % 10;
        $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen');
        $tens = array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety');
        // Ones
        $result = '';
        // var_dump($total_price);die;
        if ($giga) 
        {
            $result.= $this->convert_number($giga) .  'Million';
        }
        if($kilo){
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($kilo) . $ones[$kilo].' Thousand';
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($hecto) . $ones[$hecto].' Hundred';
        }
       
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= ' and ';
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= '-' . $ones[$n];
                }
            }
        }

        if (empty($result)) 
        {
            $result = 'zero';
        }
        // return $result;
        // var_dump($data['Total_amount']);die;
        
            $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
         
            // $templateProcessor->setValue('amt_in_word', htmlspecialchars("In Word: ".$currency.' '.$result));
      
        // $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
        $filename = $report_name."- Proforma Invoice.docx";
        header('Content-Disposition: attachment; filename='.$filename);
        ob_clean();
        $templateProcessor->saveAs('php://output');		
        // $data = file_get_contents('resources/Invoice Vertical Farming Market.docx');
        // force_download('Invoice Vertical Farming Market.docx', $data);
    
}
    public function convert_number($total_price) {
        if (($total_price < 0) || ($total_price > 999999999)) 
        {
            throw new Exception('Number is out of range');
        }
        $giga = floor($total_price / 1000000);
        // Millions (giga)
        $total_price -= $giga * 1000000;
        $kilo = floor($total_price / 1000);
        // Thousands (kilo)
        $total_price -= $kilo * 1000;
        $hecto = floor($total_price / 100);
        // Hundreds (hecto)
        $total_price -= $hecto * 100;
        $deca = floor($total_price / 10);
        // Tens (deca)
        $n = $total_price % 10;
        // var_dump($n);die;
    }

    public function donwload_main_invoice($id){
        $invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
        $query_details = $this->Genrate_Invoice_Model->get_query_record($id);
        $reseller_name= $query_details->reseller_name;
        $service_no= $query_details->service_no;
        $service = explode("-", $service_no);
        $service_no1 = $service[1];
        $main_invoice_no = $invoice_records->main_invoice_no;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice.docx');
        $todays_date = date('F d, Y');
        $s_address_billing = $invoice_records->s_address_billing;
        $report_name = $invoice_records->invoice_title;
        $billing_customer_name = $invoice_records->billing_customer_name;
        $billing_phone_no = $invoice_records->billing_phone_no;
        $billing_email_id = $invoice_records->billing_email_id;
        $billing_address1 = $invoice_records->billing_address1;
        $billing_address2 = $invoice_records->billing_address2;
        $billing_city = $invoice_records->billing_city;
        $billing_state = $invoice_records->billing_state;
        $billing_zipcode = $invoice_records->billing_zipcode;
        $billing_company_name = $invoice_records->billing_company_name;
        $shipping_customer_name = $invoice_records->shipping_customer_name;
        $shipping_email_id = $invoice_records->shipping_email_id;
        $customer_gst_no = $invoice_records->customer_gst_no;
        $order_no = $invoice_records->order_no;
        $currency = $invoice_records->currency;
        $state = $invoice_records->state;
        $order_date = $invoice_records->order_date;
        $currency = $invoice_records->currency;
        $total_amount = $invoice_records->total_amount;
        $unit_no = $invoice_records->unit_no;
        $unit_price = $invoice_records->unit_price;
        $discount = $invoice_records->discount;
        $mult = $unit_price * $unit_no;
        $discount_amt = ($discount / 100) * $mult;
        $discount_amt1 = $discount_amt;
        $percent = 18;
        $total = $total_amount;
        $discount_igst = ($percent / 100) * $total;
        $order_date = date('d F, Y', strtotime($order_date));
        // $todays_date = date('d F, Y');
        // var_dump($todays_date);die;
        $address = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' - '.$billing_zipcode;
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars('Invoice No:'.$main_invoice_no));
        $templateProcessor->setValue('Invoice', htmlspecialchars($reseller_name));
        $templateProcessor->setValue('PhoneNO', htmlspecialchars($billing_phone_no));
        $templateProcessor->setValue('BName', htmlspecialchars($billing_customer_name));
        $templateProcessor->setValue('BEmail', htmlspecialchars($billing_email_id));
        $templateProcessor->setValue('Address', htmlspecialchars($address));
        $templateProcessor->setValue('Company Name', htmlspecialchars($billing_company_name));
        $templateProcessor->setValue('OrderNo', htmlspecialchars($order_no));
        $templateProcessor->setValue('UnitNo', htmlspecialchars($unit_no));
        $templateProcessor->setValue('Report Title', htmlspecialchars($report_name));
        $templateProcessor->setValue('Unit Price', htmlspecialchars($unit_price));
        $templateProcessor->setValue('Subtotal', htmlspecialchars($mult));
        $templateProcessor->setValue('OrderDate', htmlspecialchars($order_date));
        if($currency == "INR"){
            $templateProcessor->setValue('GSTNoLabel', htmlspecialchars("GST No.:"));
            $templateProcessor->setValue('GSTNo', htmlspecialchars($customer_gst_no));
            $templateProcessor->setValue('GSTNLUTLabel', htmlspecialchars("GST No.:"));
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("XYZ232655"));
        }else {
            $templateProcessor->setValue('GSTNoLabel', htmlspecialchars(""));
            $templateProcessor->setValue('GSTNo', htmlspecialchars(""));
            $templateProcessor->setValue('GSTNLUTLabel', htmlspecialchars("LUT No.:"));
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("AD270721010182M"));
        }
        $templateProcessor->setValue('User Name', htmlspecialchars($shipping_customer_name));
        $templateProcessor->setValue('SEmail', htmlspecialchars($shipping_email_id));
        $templateProcessor->setValue('currency', htmlspecialchars($currency));
        if($discount > 0){
        $templateProcessor->setValue('Discount', htmlspecialchars("- Discount (".$discount."%)"));
        $templateProcessor->setValue('disc_amount', htmlspecialchars($discount_amt1));
        }else{
            $templateProcessor->setValue('Discount', htmlspecialchars(""));
            $templateProcessor->setValue('disc_amount', htmlspecialchars(""));
        }
        if($state == "Maharastra"){
            $percent = 9;
            $total = $total_amount;
            $discount_cgst = ($percent / 100) * $total;
            $discount_sgst = ($percent / 100) * $total;
            $templateProcessor->setValue('gst_type1', htmlspecialchars("+ CGST (9%)"));
            $templateProcessor->setValue('gst_type2', htmlspecialchars("+ SGST (9%)"));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars($discount_cgst));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars($discount_sgst));
        }else if($state == "Other State"){
           
            $templateProcessor->setValue('gst_type1', htmlspecialchars("+ IGST (18%)"));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars($discount_igst));
            $templateProcessor->setValue('gst_type2', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars(""));
        }else{
            
            $templateProcessor->setValue('gst_type1', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type1', htmlspecialchars(""));
            $templateProcessor->setValue('gst_type2', htmlspecialchars(""));
            $templateProcessor->setValue('disc_gst_type2', htmlspecialchars(""));
        }
        $total_price = $mult - $discount_amt1;
        if($currency == "INR"){
            $total_price = $total_price + $discount_igst;            
        }else{
            $total_price = $total_price;
        }
        $total_price = $total_price;
        if($currency == "INR"){
            $data['Total_amount']= $amount + $data['discount_igst'];
        }else{
            $data['Total_amount']= $amount;
        }
        $templateProcessor->setValue('total', htmlspecialchars(number_format($total_price,2)));
        
        if (($total_price < 0) || ($total_price > 999999999)) 
        {
            throw new Exception('Number is out of range');
        }
        $giga = floor($total_price / 1000000);
        // Millions (giga)
        $total_price -= $giga * 1000000;
        // var_dump($total_price);die;
        $kilo = floor($total_price / 1000);
        // Thousands (kilo)
        $total_price -= $kilo * 1000;
        $hecto = floor($total_price / 100);
        // Hundreds (hecto)
        $total_price -= $hecto * 100;
        $deca = floor($total_price / 10);
        // Tens (deca)
        $n = $total_price % 10;
        $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen');
        $tens = array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety');
        // Ones
        $result = '';
        if ($giga) 
        {
            $result.= $this->convert_number($giga) .  'Million';
        }
        if($kilo){
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($kilo) . $ones[$kilo].' Thousand';
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? '' : ' ') .$this->convert_number($hecto) . $ones[$hecto].' Hundred';
        }
       
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= ' and ';
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= '-' . $ones[$n];
                }
            }
        }

        if (empty($result)) 
        {
            $result = 'zero';
        }
        // return $result;
        // var_dump($data['Total_amount']);die;
        
            $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
         
            // $templateProcessor->setValue('amt_in_word', htmlspecialchars("In Word: ".$currency.' '.$result));
      
        // $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
        $filename = $report_name."- Proforma Invoice.docx";
        header('Content-Disposition: attachment; filename='.$filename);
        ob_clean();
        $templateProcessor->saveAs('php://output');		
        // $data = file_get_contents('resources/Invoice Vertical Farming Market.docx');
        // force_download('Invoice Vertical Farming Market.docx', $data);
    
}

}