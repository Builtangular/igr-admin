<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
$Prefix = array('Mr.', 'Mrs.', 'Miss.');
$Departments = array('Account', 'Research', 'Marketing', 'Business Department', 'IT', 'Back Office', 'HR', 'Sales', 'Graphics');
$Education_type = array('Diploma', 'Graduation', 'Post Graduation');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Employee Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>admin/employee"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View</li>
        </ol>
    </section>
    <style>
    .hide {
        width: 0;
        height: 0;
        opacity: 0;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Employee Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/update/<?php echo $employee_data->id; ?>"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label class="control-label col-md-2">Employee ID : </label> -->
                                    <b class="col-md-2">Job Type : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->job_type; ?></span>
                                    </div>
                                    <b class="col-md-2">Employee Code : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->emp_code; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b class="col-md-2">Joining Date : </b>
                                    <div class="col-md-4">
                                        <span><?php echo date('d-m-Y', strtotime($employee_data->joining_date)); ?></span>
                                    </div>
                                    <b class="col-md-2">Next Appraisal Date : </b>
                                    <div class="col-md-4">
                                        <span><?php echo date('d-m-Y', strtotime($employee_data->appraisal_date)); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b class="col-md-2">Full Name : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->prefix.' '.$employee_data->first_name.' '.$employee_data->middle_name.' '.$employee_data->last_name; ?></span>
                                    </div>
                                    <b class="col-md-2">Date of Birth : </b>
                                    <div class="col-md-4">
                                        <span><?php echo date('d-m-Y', strtotime($employee_data->date_of_birth)); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b class="col-md-2">Gender : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->gender; ?></span>
                                    </div>
                                    <b class="col-md-2">User Type : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->user_type; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b class="col-md-2">Mobile Number : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->mobile_number; ?></span>
                                    </div>
                                    <b class="col-md-2">A/T Mobile Number : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->alternate_mobile_no; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Personal Email : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->personal_email_id; ?></span>
                                    </div>
                                    <label class="col-md-2">Official Email : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->official_email_id; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Marital Status : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->marital_status; ?></span>
                                    </div>
                                    <?php if($employee_data->marital_status == 'Married'){ ?>
                                    <label class="col-md-2">Father Name : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->father_name; ?></span>
                                    </div>
                                    <label class="col-md-2">Spouse Name : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->spouse_name; ?></span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Permant Address : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->permant_address; ?></span>
                                    </div>
                                    <label class="col-md-2">Current Address : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->current_address; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Relative Details : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->relative_name; ?></span>
                                    </div>
                                    <label class="col-md-2">Relative Number : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->relative_contact_no; ?></span>
                                    </div>
                                    <label class="col-md-2">Relation : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->relation; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Emergency Details : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->emergency_name; ?></span>
                                    </div>
                                    <label class="col-md-2">Mobile No. : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->emergency_contact_no; ?></span>
                                    </div>
                                    <label class="col-md-2">Relation : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->emergency_relation; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Employee Status : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->emp_status; ?></span>
                                    </div>
                                    <label class="col-md-2">Blood Group : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->blood_group; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Aadhaar No. : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->aadhaar_no; ?></span>
                                    </div>
                                    <label class="col-md-2">PAN No. : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->pan_no; ?></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Education : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->education_type; ?></span>
                                    </div>
                                    <label class="col-md-2">Degree : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->degree; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Passing Year : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->passing_year; ?></span>
                                    </div>
                                    <label class="col-md-2">Passport No. : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->passport_no; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Department : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->department; ?></span>
                                    </div>
                                    <label class="col-md-2">Job Profile : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->designation; ?></span>
                                    </div>
                                    <label class="col-md-2">Head Name : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $employee_data->head_name; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">UAN : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->uan_no; ?></span>
                                    </div>
                                    <label class="col-md-2">PF No. : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->pf_no; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b class="col-md-2">Resignation Date : </b>
                                    <div class="col-md-4">
                                        <span><?php echo $employee_data->resignation_date; ?></span>
                                    </div>
                                    <label class="col-md-2">Profile Image: </label>
                                    <div class="col-md-4">
                                        <img class="fit-picture"
                                            src="<?php echo base_url()."assets/admin/emp_data/profile/".$employee_data->upload_image; ?>"
                                            height="180" width="240"
                                            alt="<?php echo $employee_data->first_name." Profile"; ?>">
                                    </div>
                                </div>
                                <?php if($employment_details){?>
                                <hr>
                                <h4 class="box-title text-info list-group"> Employment Details</h4>
                                <?php foreach($employment_details as $employment){?>
                                <div class="form-group">
                                    <label class="col-md-2">Company Name: </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->company_name; ?></span>
                                    </div>
                                    <label class="col-md-2">Company Address: </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->company_address; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Joining Date: </label>
                                    <div class="col-md-4">
                                        <span><?php echo date('d-m-Y', strtotime($employment->date_of_joining)); ?></span>
                                    </div>
                                    <label class="col-md-2">Releaving Date: </label>
                                    <div class="col-md-4">
                                        <span><?php echo date('d-m-Y', strtotime($employment->date_of_releaving)); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Designation: </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->designation; ?></span>
                                    </div>
                                    <label class="col-md-2">Last Drown Salary : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->last_drown_salary; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Reason for Leaving: </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->reason_for_leaving; ?></span>
                                    </div>
                                    <label class="col-md-2">Reference Contact No : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $employment->reference_contact_no; ?></span>
                                    </div>
                                </div>
                                <?php } } ?>
                                <?php if($p_salary_details){ $s = 0; ?>
                                <hr>
                                <h4 class="box-title text-info list-group"> Salary Details</h4>
                                <?php foreach($p_salary_details as $psalary){ ?>
                                <?php if($s == 1 || $s == 2 || $s == 3){ ?>
                                <hr>
                                <?php } ?>
                                <h5 class="text-warning text-bold list-group"><u>Year -
                                        <?php echo $psalary->salary_year; ?></u></h5>
                                <div class="form-group">
                                    <label class="col-md-2">Basic Pay : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->gross_basic_salary; ?></span>
                                    </div>
                                    <label class="col-md-2">House Rent Allowance : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->gross_hra; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Other Allowances : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->gross_other; ?></span>
                                    </div>
                                    <label class="col-md-2 text-green">Total Gross Salary : </label>
                                    <div class="col-md-4 text-green">
                                        <span><b><?php echo $psalary->gross_salary; ?></b></span>
                                    </div>
                                </div>
                                <h5 class="box-title text-warning list-group"><u>Deductions</u></h5>
                                <div class="form-group">
                                    <label class="col-md-2">Professional Tax : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->emp_pt; ?></span>
                                    </div>
                                    <label class="col-md-2">Provident Fund : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->emp_pf; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">ESIC : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->emp_esic; ?></span>
                                    </div>
                                    <label class="col-md-2 text-green">Net Earnings : </label>
                                    <div class="col-md-4 text-green">
                                        <span><b><?php echo $psalary->net_salary; ?></b></span>
                                    </div>
                                </div>
                                <h5 class="box-title text-warning list-group"><u>Employer Contribution</u></h5>
                                <div class="form-group">
                                    <label class="col-md-2">Emp Provident Fund : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->employer_pf; ?></span>
                                    </div>
                                    <label class="col-md-2">Employee ESIC : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->employer_esic; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Other : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $psalary->employer_other; ?></span>
                                    </div>
                                    <label class="col-md-2 text-purple">Package (CTC) : </label>
                                    <div class="col-md-4 text-purple">
                                        <span><b><?php echo $psalary->ctc*12; ?></b></span>
                                    </div>
                                </div>
                                <?php $s++; } } else if($t_salary_details) { ?>
                                <hr>
                                <h4 class="box-title text-info list-group"> Salary Details</h4>
                                <?php foreach($t_salary_details as $tsalary){ ?>
                                <?php if($s == 1 || $s == 2 || $s == 3){ ?>
                                <hr>
                                <?php } ?>
                                <h5 class="text-warning text-bold list-group"><u>Year -
                                        <?php echo $tsalary->salary_year; ?></u></h5>
                                <div class="form-group">
                                    <label class="col-md-2">Basic Pay : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $tsalary->salary; ?></span>
                                    </div>
                                    <label class="col-md-2">TDS : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $tsalary->tds; ?></span>
                                    </div>
                                    <label class="col-md-2 text-purple">Gross Salary : </label>
                                    <div class="col-md-2 text-purple">
                                        <span><b><?php echo $tsalary->gross_salary; ?></b></span>
                                    </div>
                                </div>
                                <?php $s++; } }  ?>
                                <?php if($bank_details){  ?>
                                <hr>
                                <h4 class="box-title text-info list-group"> Bank Details</h4>
                                <?php foreach($bank_details as $bank){ ?>
                                <h5 class="text-warning text-bold list-group">
                                    <u><?php echo $bank->type." Bank Account"; ?></u>
                                </h5>
                                <div class="form-group">
                                    <label class="col-md-2">Bank Name : </label>
                                    <div class="col-md-4">
                                        <span><?php echo $bank->bank_name; ?></span>
                                    </div>
                                    <label class="col-md-2">Account Name : </label>
                                    <div class="col-md-4">
                                        <span><b><?php echo $bank->ac_name; ?></b></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Account Number : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $bank->ac_no; ?></span>
                                    </div>
                                    <label class="col-md-2">IFSC Code : </label>
                                    <div class="col-md-2">
                                        <span><?php echo $bank->ifsc_code; ?></span>
                                    </div>
                                    <label class="col-md-1">Branch : </label>
                                    <div class="col-md-3">
                                        <span><?php echo $bank->branch_name; ?></span>
                                    </div>
                                </div>
                                <?php  } }  ?>
                                <?php if($document_list){  ?>
                                <hr>
                                <h4 class="box-title text-info list-group"> Documents</h4>
                                <?php foreach($document_list as $document){ ?>
                                <div class="form-group">
                                    <label class="col-md-4"><?php echo $document->doc_type; ?> : </label>
                                    <div class="col-md-8">
                                        <span><a href="<?php echo base_url()."assets/admin/emp_data/document/".$document->upload_file; ?>"
                                                target="blank"><?php echo $document->upload_file; ?></a></span>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo base_url(); ?>admin/employee" class="btn btn-default pull-left"><b><i
                                        class="fa fa-arrow-left"></i> Back</b></a>
                            <a href="<?php echo base_url(); ?>admin/employee/print_view/<?php echo $employee_data->id; ?>"
                                target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
                            <!--  <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($employee_data)){echo $employee_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Update"> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this->load->view('admin/footer.php'); ?>