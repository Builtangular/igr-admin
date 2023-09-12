<?php defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ini_set('display_errors', '0');
class Generate_invoice extends CI_Controller {    
	public function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');		
		$this->load->model('admin/Genrate_Invoice_Model');
		$this->load->model('admin/Query_model');
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
			$data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
            $data['gimenu_active'] = "active menu-open";
			$data['glist'] = "active";
			$data['type'] = "list";
            if($data['Role_id'] == 1) {
                $data['query_details'] = $this->Genrate_Invoice_Model->get_query_details();
            }else if($data['Role_id'] == 5 && $data['User_Type'] == 'Team Lead') {
                $data['query_details'] = $this->Genrate_Invoice_Model->get_query_details();
            }else {
                $data['query_details'] = $this->Query_model->get_details_assign_user($data['Login_user_name']);
            }
		    $this->load->view('admin/generate_invoice/list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function generated_invoice_list(){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
            $data['gimenu_active'] = "active menu-open";
			$data['gilist'] = "active";
			$data['type'] = "generate";
			$data['query_details'] = $this->Genrate_Invoice_Model->get_query_details1();
            $data['invoice_title']= $data['invoice_details']->invoice_title;
		    $this->load->view('admin/generate_invoice/invoice_list',$data);			
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function add_main_invoice($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
            $data['gimenu_active'] = "active menu-open";
			$data['giadd'] = "active";
            $data['invoice_type'] = "Main";
            $query_details = $this->Genrate_Invoice_Model->get_query_records($id);
            $data['report_name'] = $query_details->report_name;
		    $this->load->view('admin/generate_invoice/main_invoice_add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function add_proforma_invoice($id){
        if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
            $data['gimenu_active'] = "active menu-open";
			$data['giadd'] = "active";
            $data['invoice_type'] = "Proforma";
            $query_details = $this->Genrate_Invoice_Model->get_query_records($id);
            $data['report_name'] = $query_details->report_name;
		    $this->load->view('admin/generate_invoice/add',$data);		
		}else{			
			$this->load->view('admin/login');
		}
    }
    public function insert_invoice($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$Login_user_name=$session_data['Login_user_name'];
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['id'] = $id;
            $type = $_POST['invoice_type'];
            $query_details = $this->Genrate_Invoice_Model->get_query_records($id);
            $report_name = $query_details->report_name;
            $s_address_billing = $_POST['s_address_billing'];
            $query_invoice_details = $this->Genrate_Invoice_Model->get_single_invoice_details();
            $last_row_id= $query_invoice_details->id;
            // var_dump($last_row_id);die;
            $last_id= $query_invoice_details->id;
            $invoice_id = $query_details->id;
            $reseller_name= $query_details->reseller_name;
            $todays_date = date('m/Y');
            $date = date('M');
            $num = 0;
            $newDate = date('M');
            $invoice_no = 'PROINV'.(strtoupper($newDate)).'10'.str_pad($last_row_id+1, 2, "0", STR_PAD_LEFT);
            $Shipping_Custome_Name=$this->input->post('Shipping_Custome_Name');
            $Shipping_Email_Id=$this->input->post('Shipping_Email_Id');
            $Shipping=$this->input->post('shipping_customer_name');
            $Email=$this->input->post('shipping_email_id');
            /* array seprate the value */
            $num = 0;
            $value= $this->input->post('Shipping_Custome_Name');
            $email= $this->input->post('Shipping_Email_Id');
            
            $i = 0;
            foreach($value as $row)
            {
                if($i==0){
                    $s_customer_name.= $row;
                }else{
                     $s_customer_name.= ','.$row;
                }
                $i++;
            }
             $n = 0;
            foreach($email as $data)
            {
                if($n==0){
                   $s_email_address.= $data;
                }else{
                    $s_email_address.= ','.$data;
                }
                $n++;
            }
             /* /.array seprate the value */
            // var_dump($s_customer_name);die;
            if($s_address_billing == "")
			{
                $Insert_invoice=array(
                    'query_id'                          => $id,
                    'query_name'                        => $report_name,
                    'invoice_title'                     => $this->input->post('invoice_title'),
                    'invoice_type'                      => $type,
                    'invoice_no'                        => $invoice_no,
                    'main_invoice_no'                   => $this->input->post('main_invoice_no'),
                    'order_date'                        => $this->input->post('order_date'),
                    'currency'                          => $this->input->post('currency'),
                    'state'                             => $this->input->post('state'),
                    'customer_gst_no'                   => $this->input->post('customer_gst_no'),
                    'order_no'                          => $this->input->post('order_no'),
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
                    'percent_discount'                  => $this->input->post('percentage'),
                    'absolute_discount'                 => $this->input->post('absolute_price'),
                    'total_amount'                      => $this->input->post('total_amount'),
                    'created_user'                      => $Login_user_name,
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
                    'invoice_type'                      => $type,
                    'invoice_no'                        => $invoice_no,
                    'main_invoice_no'                   => $this->input->post('main_invoice_no'),
                    'order_date'                        => $this->input->post('order_date'),
                    'currency'                          => $this->input->post('currency'),
                    'state'                             => $this->input->post('state'),
                    'customer_gst_no'                   => $this->input->post('customer_gst_no'),
                    'order_no'                          => $this->input->post('order_no'),
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
                    'percent_discount'                  => $this->input->post('percentage'),
                    'absolute_discount'                 => $this->input->post('absolute_price'),
                    'total_amount'                      => $this->input->post('total_amount'),
                    'created_user'                      => $Login_user_name,
                    'created_at'                        => date('Y-m-d'),
                    'updated_at'                        => date('Y-m-d'),
                );
                $result=$this->Genrate_Invoice_Model->insert_invoice_details($Insert_billing);
			}
			if($result)
			{
				$this->session->set_flashdata('msg', 'Data has been inserted successfully....!!!');
			}
			redirect('admin/generate_invoice/list');
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
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
            $id = $id;
            $data['invoice_data'] = $this->Genrate_Invoice_Model->get_single_invoice_records($id);
            $data['invoice_type'] = $data['invoice_data']->invoice_type;
            $data['type'] = $this->input->post('type');
			$this->load->view("admin/generate_invoice/edit",$data);
		}else{
			$this->load->view("admin/login");			
		}
    }
    public function update(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $type= $this->input->post('type');
			$id = $this->input->post('id');
            $value= $this->input->post('Shipping_Custome_Name');
            $email= $this->input->post('Shipping_Email_Id');
            $i = 0;
            foreach($value as $row)
            {
                if($i==0){
                    $s_customer_name.= $row;
                }else{
                     $s_customer_name.= ','.$row;
                }
                $i++;
            }
             $n = 0;
            foreach($email as $data)
            {
                if($n==0){
                   $s_email_address.= $data;
                }else{
                    $s_email_address.= ','.$data;
                }
                $n++;
            }
			$this->Genrate_Invoice_Model->update($id,$s_customer_name,$s_email_address);
			$this->session->set_flashdata('msg', 'Data has been updated successfully....!!!');
            if($type == 'generate'){
			    redirect('admin/generate_invoice/generated_invoice_list');
            }else{
                redirect('admin/generate_invoice/list');
            }
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function delete($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['delete'] = $this->Genrate_Invoice_Model->delete($id);
			$this->session->set_flashdata('msg', 'Data has been delete successfully....!!!');
			redirect('admin/generate_invoice/list');
		}else{
			$this->load->view("admin/login");			
		}
	}
    public function view($id){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			$data['Login_user_name']=$session_data['Login_user_name'];	
			$data['Role_id']=$session_data['Role_id'];
            $data['User_Type']=$session_data['User_Type'];
			$data['department']=$session_data['department'];
			$data['massage'] = $this->session->userdata('msg');
			$data['id'] = $id;
            $data['list'] = $this->input->post('genrated_invoice_list');
			$invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
			$query_details = $this->Genrate_Invoice_Model->get_query_record($id);
            $s_address_billing = $invoice_records->s_address_billing;
            $data['main_invoice_no'] = 'INVOICE' .'#'.($invoice_records->main_invoice_no);
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
            $data['percent_discount'] = $invoice_records->percent_discount;
            $data['absolute_discount'] = $invoice_records->absolute_discount;
            $data['currency']= $invoice_records->currency;
            $data['mult'] = $data['unit_price'] * $data['unit_no'];
            $data['invoice_title'] = $invoice_records->invoice_title;
            $data['invoice_type'] = $invoice_records->invoice_type;
            $data['invoice_no'] = $invoice_records->invoice_no;
            $data['inward_no'] = $invoice_records->inward_no;
            $amount = $data['total_amount'];
            $percent = 18;
            $subtotal = $amount;
            $data['discount_igst'] = ($percent / 100) * $subtotal;
            if($data['currency'] == "INR"){
                $data['Total_amount']= $amount + $data['discount_igst'];
            }else{
                $data['Total_amount']= $amount;
            }
            $this->load->view('admin/generate_invoice/view',$data);		
		}else{			
			$this->load->view('admin/login');
		}
	}
    public function download($id){
        $invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/invoice.docx');
        $todays_date = date('F d, Y');
        $invoice_no = $invoice_records->invoice_no;
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
        $discount = $invoice_records->percent_discount;
        $absolute_value = $invoice_records->absolute_discount;
        $mult = $unit_price * $unit_no;
        $discount_amt = ($discount / 100) * $mult;
        $discount_amt1 = $discount_amt;
        $percent = 18;
        $total = $total_amount;
        $discount_igst = ($percent / 100) * $total;

        $order_date = date('d F, Y', strtotime($order_date));
        $address = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' - '.$billing_zipcode;
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars('Proforma Invoice No: '.$invoice_no));
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
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("27AAIFI7844N1ZN"));
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
        $templateProcessor->setValue('disc_amount', htmlspecialchars($absolute_value));
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
        $total_price = $invoice_records->total_amount;
        if($currency == "INR"){
            $total_price = $total_price + $discount_igst;            
        }else{
            $total_price = $total_price;
        }
        $templateProcessor->setValue('total', htmlspecialchars($total_price));
        
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
            $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
         
           
        $filename = $report_name."- Proforma Invoice.docx";
        header('Content-Disposition: attachment; filename='.$filename);
        ob_clean();
        $templateProcessor->saveAs('php://output');
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

    public function download_main_invoice($id){
        $invoice_records = $this->Genrate_Invoice_Model->get_invoice_records($id);
        $query_details = $this->Genrate_Invoice_Model->get_query_record($id);
        $reseller_name= $query_details->reseller_name;
        $service_no= $query_details->service_no;
        $service = explode("-", $service_no);
        $service_no1 = $service[1];
        $main_invoice_no = 'INVOICE' .'#'.($invoice_records->main_invoice_no);
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
        $discount = $invoice_records->percent_discount;
        $absolute_value = $invoice_records->absolute_discount;
        $mult = $unit_price * $unit_no;
        $discount_amt = ($discount / 100) * $mult;
        $discount_amt1 = $discount_amt;
        $percent = 18;
        $total = $total_amount;
        $discount_igst = ($percent / 100) * $total;
        $order_date = date('d F, Y', strtotime($order_date));
        $address = $billing_address1.' '.$billing_address2.' '.$billing_city.' '.$billing_state.' - '.$billing_zipcode;
        $templateProcessor->setValue('TodayDate', htmlspecialchars($todays_date));
        $templateProcessor->setValue('InvoiceNo', htmlspecialchars('Invoice No: '.$main_invoice_no));
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
            $templateProcessor->setValue('GSTLUTNo', htmlspecialchars("27AAIFI7844N1ZN"));
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
        $templateProcessor->setValue('disc_amount', htmlspecialchars($absolute_value));
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
        $total_price = $invoice_records->total_amount;
        if($currency == "INR"){
            $total_price = $total_price + $discount_igst;            
        }else{
            $total_price = $total_price;
        }
        $templateProcessor->setValue('total', htmlspecialchars($total_price));
        
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
        
            $templateProcessor->setValue('amt_in_word', htmlspecialchars($result));
        $filename = $report_name."- Main Invoice.docx";
        header('Content-Disposition: attachment; filename='.$filename);
        ob_clean();
        $templateProcessor->saveAs('php://output');
}
public function filter(){
    if($this->session->userdata('logged_in'))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['Login_user_name']=$session_data['Login_user_name'];	
        $data['Role_id']=$session_data['Role_id'];
        $data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
        $data['gimenu_active'] = "active menu-open";
        $data['giflist'] = "active";
        $data['type'] = "filter";
        $data['list_data'] = $this->Genrate_Invoice_Model->getlist();
        $this->load->view('admin/generate_invoice/filter',$data);	
    }		
    else
    {			
        $this->load->view('admin/login');
    }
}
public function filter_list(){
    if($this->session->userdata('logged_in'))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['Login_user_name']=$session_data['Login_user_name'];	
        $data['Role_id']=$session_data['Role_id'];
        $data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $data['invoice_type'] = $this->input->post('invoice_type');
        $data['query_details'] = $this->Genrate_Invoice_Model->get_query_details();
        $data['list_data'] = $this->Genrate_Invoice_Model->getfilterdata($data['from_date'] ,$data['to_date']);
        $this->load->view('admin/generate_invoice/filter_list',$data);			
    }		
    else
    {			
        $this->load->view('admin/login');
    }
}
public function export(){
    if($this->session->userdata('logged_in'))
    {
        $session_data = $this->session->userdata('logged_in');
        $data['Login_user_name']=$session_data['Login_user_name'];	
        $data['Role_id']=$session_data['Role_id'];
        $data['User_Type']=$session_data['User_Type'];
		$data['department']=$session_data['department'];
        $data['list_data'] = $this->Genrate_Invoice_Model->getlist();
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $list_data = $this->Genrate_Invoice_Model->getfilterdata($data['from_date'] ,$data['to_date']);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Order Date');
        $sheet->getStyle('A1:B1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('B1', 'Query Name');
        $sheet->setCellValue('C1', 'Billing Customer Name');
        $sheet->getStyle('C1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('D1', 'Shipping Email Id');
        $sheet->getStyle('D1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('E1', 'Unit Price');
        $sheet->getStyle('E1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('F1', 'Order No.');
        $sheet->getStyle('F1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('G1', 'Invoice Title');
        $sheet->getStyle('G1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('H1', 'Invoice No.');
        $sheet->getStyle('H1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('I1', 'Total Amount');
        $sheet->getStyle('I1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('J1', 'Currency');
        $sheet->getStyle('J1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('K1', 'Inward No.');
        $sheet->getStyle('K1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('L1', 'Payment Mode');
        $sheet->getStyle('L1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->setCellValue('M1', 'Inward Date');
        $sheet->getStyle('M1')->applyFromArray(
            array(
                'fill' => array(
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => [
                        'argb' => 'FFDD12',
                    ]
                )
            )
        );
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C1:D1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E1:F1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G1:H1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('I1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('K1:L1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('M1')->getAlignment()->setHorizontal('center');
        $rowCount = 3;
        foreach ($list_data as $list) {
            $sheet->SetCellValue('A' . $rowCount, htmlspecialchars($list->order_date));
            $sheet->SetCellValue('B' . $rowCount, htmlspecialchars($list->query_name));
            $sheet->SetCellValue('C' . $rowCount, htmlspecialchars($list->billing_customer_name));
            $sheet->SetCellValue('D' . $rowCount, htmlspecialchars($list->billing_email_id));
            $sheet->SetCellValue('E' . $rowCount, htmlspecialchars($list->unit_price));
            $sheet->SetCellValue('F' . $rowCount, htmlspecialchars($list->order_no));
            $sheet->SetCellValue('G' . $rowCount, htmlspecialchars($list->invoice_title));
            $sheet->SetCellValue('H' . $rowCount, htmlspecialchars($list->invoice_no));
            $sheet->SetCellValue('I' . $rowCount, htmlspecialchars($list->total_amount));
            $sheet->SetCellValue('J' . $rowCount, htmlspecialchars($list->currency));
            $sheet->SetCellValue('K' . $rowCount, htmlspecialchars($list->inward_no));
            $sheet->SetCellValue('L' . $rowCount, htmlspecialchars($list->payment_mode));
            $sheet->SetCellValue('M' . $rowCount, htmlspecialchars($list->inward_date));
            $rowCount++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Generate Invoice Data-'.$data['from_date'].' to '.$data['to_date'].'.xlsx';     
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$fileName);
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        $writer->save('php://output'); // download file
        }else{			
            $this->load->view('admin/login');
        }
    
}

}