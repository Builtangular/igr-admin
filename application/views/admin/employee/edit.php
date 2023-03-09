<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
$Prefix = array('Mr.', 'Mrs.', 'Miss.');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Employee Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
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
                        <h1 class="box-title"> Personal Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/update/<?php echo $employee_data->id; ?>"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label class="control-label col-md-2">Employee ID <span class="text-red">*</span></label> -->
                                    <div class="col-md-3">
                                        <b>Job Type <span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="job_type">
                                            <option value="<?php echo $employee_data->job_type; ?>" selected>
                                                <?php echo $employee_data->job_type; ?></option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Part Time">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Employee Code <span class="text-red">*</span></b>
                                        <input type="text" id="emp_code" name="emp_code"
                                            value="<?php echo $employee_data->emp_code;?>" class="form-control"
                                            placeholder="Employee Id">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Joining Date <span class="text-red">*</span></b>
                                        <input type="date" id="joining_date" name="joining_date"
                                            value="<?php echo $employee_data->joining_date;?>" class="form-control"
                                            placeholder="Joining Date">
                                    </div>
                                    <div class="col-md-3">
                                        <b>Next Appraisal Date </b>
                                        <input type="date" id="appraisal_date" name="appraisal_date"
                                        value="<?php echo $employee_data->appraisal_date;?>" class="form-control" placeholder="Appraisal Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Prefix<span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="prefix" required>
                                            <option value="">Select</option>
                                            <?php $i = 0; foreach($Prefix as $prefix) {
                                            if ($Prefix[$i] == $employee_data->prefix){ ?>
                                            <option value="<?php echo $employee_data->prefix; ?>" Selected>
                                                <?php echo $employee_data->prefix; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $Prefix[$i]; ?>"><?php echo $Prefix[$i]; ?>
                                            </option>
                                            <?php } $i++; }  ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>First Name <span class="text-red">*</span></b>
                                        <input type="text" id="first_name" name="first_name"
                                            value="<?php echo $employee_data->first_name;?>" class="form-control"
                                            placeholder="First Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Middle Name <span class="text-red">*</span></b>
                                        <input type="text" id="middle_name" name="middle_name"
                                            value="<?php echo $employee_data->middle_name;?>" class="form-control"
                                            placeholder="Middle Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Last Name <span class="text-red">*</span></b>
                                        <input type="text" id="last_name" name="last_name"
                                            value="<?php echo $employee_data->last_name;?>" class="form-control"
                                            placeholder="Last Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Date of Birth <span class="text-red">*</span></b>
                                        <input type="date" id="date_of_birth" name="date_of_birth"
                                            value="<?php echo $employee_data->date_of_birth;?>" class="form-control"
                                            placeholder="Date Of Birth">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Gender <span class="text-red">*</span></label><br>
                                        <input type="radio" name="gender" value="Male" checked /> Male &nbsp;&nbsp;
                                        <input type="radio" name="gender" value="Female" /> Female
                                    </div>
                                    <div class="col-md-3">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <b>Resignation Date </b>
                                        <input type="date" id="resignation_date" name="resignation_date"
                                            class="form-control"  value="<?php echo $employee_data->resignation_date;?>" placeholder="Termination Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Mobile Number <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="mobile_number" name="mobile_number"
                                            value="<?php echo $employee_data->mobile_number;?>" class="form-control"
                                            placeholder="Mobile Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="alternate_mobile_no" name="alternate_mobile_no"
                                            value="<?php echo $employee_data->alternate_mobile_no;?>"
                                            class="form-control" placeholder="Alternate Mobile Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email <span class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="email" id="personal_email_id" name="personal_email_id"
                                            value="<?php echo $employee_data->personal_email_id;?>" class="form-control"
                                            placeholder="Personal Email Address">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="official_email_id" name="official_email_id"
                                            value="<?php echo $employee_data->official_email_id;?>" class="form-control"
                                            placeholder="Office Email Address">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Marital Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="marital_status"
                                            value="<?php echo $employee_data->marital_status;?>" id="marital_status"
                                            placeholder="" onChange="visacatOnchange();">
                                            <option value="<?php echo $employee_data->marital_status; ?>" selected>
                                                <?php echo $employee_data->marital_status; ?></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                    <?php if($employee_data->marital_status == 'Single'){ ?>
                                    <div class="col-md-4">
                                        <input type="text" name="spouse_name" id="spouse" class="form-control hide"
                                            value="<?php echo $employee_data->spouse_name; ?>"
                                            placeholder="Spouse Name">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="father" name="father_name" class="form-control hide"
                                            value="<?php echo $employee_data->father_name; ?>"
                                            placeholder="Father Name">
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="spouse_name" id="spouse" class="form-control"
                                            value="<?php echo $employee_data->spouse_name; ?>"
                                            placeholder="Spouse Name">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="father" name="father_name" class="form-control"
                                            value="<?php echo $employee_data->father_name; ?>"
                                            placeholder="Father Name">
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <textarea name="permant_address" id="permant_address" rows="5"
                                            class="form-control"
                                            placeholder="Permanent Address"><?php echo $employee_data->permant_address;?></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <textarea name="current_address" id="current_address" rows="5"
                                             class="form-control"
                                            placeholder="Current Address"><?php echo $employee_data->current_address;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Relative Details </label>
                                    <div class="col-md-5">
                                        <input type="text" id="relative_name" name="relative_name" class="form-control"
                                            value="<?php echo $employee_data->relative_name;?>" placeholder="Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="relative_contact_no" name="relative_contact_no"
                                            value="<?php echo $employee_data->relative_contact_no;?>"
                                            class="form-control" placeholder="Contact Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reference Details</label>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_name" name="reference_name"
                                            value="<?php echo $employee_data->reference_name;?>" class="form-control"
                                            placeholder="Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no"
                                            value="<?php echo $employee_data->reference_contact_no;?>"
                                            class="form-control" placeholder="Contact Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Id Proof <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="aadhaar_no" name="aadhaar_no" class="form-control"
                                            value="<?php echo $employee_data->aadhaar_no;?>" placeholder="Aadhar Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="pan_no" name="pan_no" class="form-control"
                                            value="<?php echo $employee_data->pan_no;?>" placeholder="Pan Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passport_no" name="passport_no" class="form-control"
                                            value="<?php echo $employee_data->passport_no;?>"
                                            placeholder="Passport Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Education <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="education_type">
                                            <option value="<?php echo $employee_data->education_type; ?>" selected>
                                                <?php echo $employee_data->education_type; ?></option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Graduation">Graduation</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="degree" name="degree" class="form-control"
                                            value="<?php echo $employee_data->degree;?>" placeholder="Degree">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passing_year" name="passing_year" class="form-control"
                                            value="<?php echo $employee_data->passing_year;?>"
                                            placeholder="Passing Year">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Details <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="department">
                                            <option value="<?php echo $employee_data->department; ?>" selected>
                                                <?php echo $employee_data->department; ?></option>
                                            <option value="Account">Account</option>
                                            <option value="Research">Research</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Business Department">Business Department</option>
                                            <option value="IT">IT</option>
                                            <option value="Back Office">Back Office</option>
                                            <option value="HR">HR</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Graphics">Graphics</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="job_profile" name="job_profile"
                                            value="<?php echo $employee_data->job_profile;?>" class="form-control"
                                            placeholder="Job Profile / Designation">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">UAN & PF No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="uan_no" name="uan_no"
                                            value="<?php echo $employee_data->uan_no;?>" class="form-control"
                                            placeholder="UAN Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="pf_no" name="pf_no"
                                            value="<?php echo $employee_data->pf_no;?>" class="form-control"
                                            placeholder="PF Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="control-label col-md-2">Upload Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="upload_image" class="form-control">
                                        <input type="hidden" name="upload_image" class="form-control-file"
                                            id="upload_image">
                                    </div>
                                    <span class="help-block margin text-blue" id="">Exiting File: <a
                                            href="<?php echo base_url()."assets/admin/emp_data/profile/".$employee_data->upload_image; ?>"
                                            target="blank"><?php echo $employee_data->upload_image; ?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($employee_data)){echo $employee_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
var marital_status = document.getElementById('marital_status');
var spouse = document.getElementById('spouse');
var father = document.getElementById('father');

marital_status.addEventListener('change', function() {
    if (this.value == "Married") {
        spouse.classList.remove('hide');
        father.classList.remove('hide');
    } else {
        spouse.classList.add('hide');
        father.classList.add('hide');
    }
})
</script>


<?php $this->load->view('admin/footer.php'); ?>