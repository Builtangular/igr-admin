<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_mail 
{
	public function __construct() 
	{
        $this->CI = &get_instance();
		// $this->CI->load->model('Igain_model');
    }	
	public function send_email_notification($Email_content)
	{
		/* echo"---send_Notification_email----";
		die;  */
		$Template_type = $Email_content['Template_type'];

        if($Template_type == "greythr_employee_mail")
		{
			$joining_date = $Email_content['joining_date'];
			$prefix = $Email_content['prefix'];
			$full_name = $Email_content['full_name'];
			$father_name = $Email_content['father_name'];			
			$gender = $Email_content['gender'];
			$marital_status = $Email_content['marital_status'];
			$aadhaar_no = $Email_content['aadhaar_no'];
			$pan_no = $Email_content['pan_no'];
			$personal_email_id = $Email_content['personal_email_id'];
			$mobile_number = $Email_content['mobile_number'];
			$alternate_mobile_no = $Email_content['alternate_mobile_no'];
			$bank_name = $Email_content['bank_name'];
			$account_no = $Email_content['ac_number'];
			$ifsc_code = $Email_content['ifsc_code'];
			$permant_address = $Email_content['permant_address'];
			$gross_salary = $Email_content['gross_salary'];
			
				$subject = " New Joining Details | ".ucfirst($full_name)." | Joining Date".htmlspecialchars(date("d-m-Y", strtotime($joining_date)));
				$html = '<html xmlns="http://www.w3.org/1999/xhtml">';
				$html = '<link rel="stylesheet" type="text/css" href="assets/css/email.css">';
				$html .= '<body yahoo bgcolor="#FFFFFF" style="margin: 0; padding: 0; min-width: 100%!important;">';		
				$html .= '<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0"><tr><td>';		
				$html .= '<table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 600px;">';		
				$html .= '<tr>
							<td class="innerpadding borderbottom" style="padding: 30px 30px 30px 30px;border-bottom: 1px solid #f2eeed;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<h1 align="center" style="background-color: #0a5184;height: 75%; padding: 5px; color: #fff">Infinium Global Reasearch</h1>
									<tr>
									<td class="h2" style="padding: 0 0 15px 0; font-size: 18px; line-height: 28px; font-weight: bold;color: #153643; font-family: Tahoma;">
										Hello HR Team,
									</td>
									</tr>
									<tr>
										<td class="bodycopy" style="color: #153643;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height: 22px;">
											I would like to inform you, '.$prefix.' '.ucfirst($full_name).' is the new employee of our company. Kindly add the below-mentioned details to our Greythr Portal.
											<br/><br/>													
											<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px; line-height: 22px;">
                                                <tr>
													<td style="width: 20%; vertical-align:top"><b> Joining Date </b></td>
													<td><b> : </b>'.date("d-m-Y", strtotime($joining_date)).'</td>
												</tr>
												<tr>
													<td style="width: 20%; vertical-align:top"><b> Name </b></td>
													<td><b> : </b>'.ucfirst($full_name).'</td>
												</tr>
                                                <tr>
													<td style="width: 20%; vertical-align:top"><b> Father Name </b></td>
													<td><b> : </b>'.$father_name.'</td>
												</tr>
                                                <tr>
                                                    <td style="width: 20%; vertical-align:top"><b> Gender </b></td>
                                                    <td><b> : </b>'.$gender.'</td>
                                                </tr> 
                                                <tr>
                                                    <td style="width: 20%; vertical-align:top"><b> Marital Status </b></td>
                                                    <td><b> : </b>'.$marital_status.'</td>
                                                </tr> 
                                                <tr>
                                                    <td style="width: 20%; vertical-align:top"><b> Aadhaar No. </b></td>
                                                    <td><b> : </b>'.$aadhaar_no.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%; vertical-align:top"><b> PAN Number </b></td>
                                                    <td><b> : </b>'.$pan_no.'</td>
                                                </tr> 
												<tr>
													<td style="width: 20%; vertical-align:top"><b> Email </b></td>
													<td><b> : </b>'.$personal_email_id.'</td>
												</tr>
												<tr>
													<td style="width: 20%; vertical-align:top"><b> Mobile Number </b></td>
													<td><b> : </b>'.$mobile_number.'</td>
												</tr>
                                                <tr>
													<td style="width: 20%; vertical-align:top"><b> Alternate Number </b></td>
													<td><b> : </b>'.$alternate_mobile_no.'</td>
												</tr>
												<tr>
													<td style="width: 20%; vertical-align:top"><b> Bank Name  </b></td>
													<td><b> : </b>'.$bank_name.'</td>
												</tr>
                                                <tr>
													<td style="width: 20%; vertical-align:top"><b> Account Number </b></td>
													<td><b> : </b>'.$account_no.'</td>
												</tr>
												<tr>
													<td style="width: 20%; vertical-align:top"><b> IFSC Code </b></td>
													<td><b> : </b>'.$ifsc_code.'</td>
												</tr>												
												<tr>
													<td style="width: 20%; vertical-align:top"><b> Gross Salary </b></td>
													<td><b> : </b>'.$gross_salary.'</td>
												</tr>					
											</table>
											<br>
											Regards,<br>
											<b>Infinium Global Research Team.</b>
										</td>
									</tr>
									<br/>							
								</table>
							</td>
						</tr>';
				$html .= '<tr><td class="footer" style="padding: 20px 30px 15px 30px; background: #0a5184;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="center" class="footercopy" style="font-family: Tahoma; font-size: 14px; color: #ffffff;">
									You can also visit the below link.
								</td>
							</tr>
							<tr>
								<td align="center" class="footercopy" style="font-family: Tahoma; font-size: 14px; color: #ffffff;">
									<a href="https://www.infiniumglobalresearch.com/" target="_blank" style="color: #ffffff; text-decoration: underline;">Visit Website</a>
								</td>
							</tr>';
				$html .= '</table></td></tr>';		
				$html .= '</table></td></tr></table></body></html>';
			/* echo $html; 
			die; */
		}

        if($Template_type == "greythr_employee_mail")
        {	
            $to = 'deochakek@gmail.com';
            $from_mail = 'vidya.infinium@gmail.com';
            $header .= 'Cc:  monika23.mrd@gmail.com, gawalipooja249@gmail.com' . "\r\n";
        }

        $subject = $subject; 
        $header .= "From:".$from_mail." \r\n";
        ///$header .= "bcc:rp@infiniumglobalresearch.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        // $header .= "Content-type: text/html\r\n"; 
        $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";			
        // $retval = mail($to,$subject,$html,$header); 
        
        if(@mail($to, $subject, $html, $header))
        {
            // echo "Mail Sent Successfully";
        }
        else
        {
            // echo "Mail Not Sent";
        }
        // die;
    }
}
?>