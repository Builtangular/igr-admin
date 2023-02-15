<?php $this->load->view('admin/header.php'); ?>

<?php $Prefix = array('Mr.', 'Mrs.', 'Miss.'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Employee Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
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
                    <form action="<?php echo base_url(); ?>admin/employee/insert" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label class="control-label col-md-2">Employee ID <span class="text-red">*</span></label> -->
                                    <div class="col-md-3">
                                        <b>Job Type <span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="job_type" required>
                                            <option value="" selected>Select Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Part Time">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Employee Code <span class="text-red">*</span></b>
                                        <input type="text" id="emp_code" name="emp_code" class="form-control"
                                            placeholder="Employee Id" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Joining Date <span class="text-red">*</span></b>
                                        <input type="date" id="joining_date" name="joining_date" class="form-control"
                                            placeholder="Joining Date" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Next Appraisal Date </b>
                                        <input type="date" id="appraisal_date" name="appraisal_date"
                                            class="form-control" placeholder="Appraisal Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Prefix<span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="prefix" required>
                                            <option value="" selected>Select</option>
                                            <?php $i = 0; foreach($Prefix as $prefix) { ?>
                                            <option value="<?php echo $Prefix[$i]; ?>"><?php echo $Prefix[$i]; ?>
                                            </option>
                                            <?php  $i++; }  ?>
                                            <!--  <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss">Miss.</option> -->
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>First Name <span class="text-red">*</span></b>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Middle Name <span class="text-red">*</span></b>
                                        <input type="text" id="middle_name" name="middle_name" class="form-control"
                                            placeholder="Middle Name" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Last Name <span class="text-red">*</span></b>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                            placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Date of Birth <span class="text-red">*</span></b>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                            placeholder="Date Of Birth" required>
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
                                            class="form-control" placeholder="Termination Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Mobile Number <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                            placeholder="Mobile Number" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="alternate_mobile_no" name="alternate_mobile_no"
                                            class="form-control" placeholder="Alternate Mobile Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email <span class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="email" id="personal_email_id" name="personal_email_id"
                                            class="form-control" placeholder="Personal Email Address" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="official_email_id" name="official_email_id"
                                            class="form-control" placeholder="Office Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Marital Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="marital_status" id="marital_status"
                                            placeholder="" onChange="visacatOnchange();">
                                            <option value="" selected>Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="spouse_name" id="spouse" class="form-control hide"
                                            placeholder="Spouse Name">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="father" name="father_name" class="form-control hide"
                                            placeholder="Father Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <textarea name="permant_address" id="permant_address" rows="5"
                                            class="form-control" placeholder="Permanent Address" required></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <textarea name="current_address" id="current_address" rows="5"
                                            class="form-control" placeholder="Current Address" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Relative Details </label>
                                    <div class="col-md-5">
                                        <input type="text" id="relative_name" name="relative_name" class="form-control"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="relative_contact_no" name="relative_contact_no"
                                            class="form-control" placeholder="Contact Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reference Details</label>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_name" name="reference_name"
                                            class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no"
                                            class="form-control" placeholder="Contact Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Id Proof <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="aadhaar_no" name="aadhaar_no" class="form-control"
                                            placeholder="Aadhar Number" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="pan_no" name="pan_no" class="form-control"
                                            placeholder="Pan Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passport_no" name="passport_no" class="form-control"
                                            placeholder="Passport Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Education <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="education_type">
                                            <option value="" selected>Select</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Graduation">Graduation</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="degree" name="degree" class="form-control"
                                            placeholder="Degree" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passing_year" name="passing_year" class="form-control"
                                            placeholder="Passing Year">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Details <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="department" required>
                                            <option value="" selected>Select Department</option>
                                            <option value="Account">Account</option>
                                            <option value="Research">Research</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Business Department">Business Department</option>
                                            <option value="IT">IT</option>
                                            <option value="Back Office">Back Office</option>
                                            <option value="HR">HR</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Graphics">Sales</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="job_profile" name="job_profile" class="form-control"
                                            placeholder="Job Profile / Designation" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">UAN & PF No.</label>
                                    <div class="col-md-5">
                                        <input type="text" id="uan_no" name="uan_no" class="form-control"
                                            placeholder="UAN Number">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="pf_no" name="pf_no" class="form-control"
                                            placeholder="PF Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage" class="control-label col-md-2">Upload Image</label>
                                    <div class="col-md-6">
                                        <input type="file" name="upload_image" class="form-control">
                                        <input type="hidden" name="upload_image" class="form-control-file"
                                            id="upload_image">
                                    </div>
                                    <span class="help-block margin text-red" id="">Note *: Image size should be 20 to 40
                                        Kb</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <!-- <label> <a href="" class="btn btn-info pull-right" data-role="button" data-inline="true">Skip</a></label> -->
                            <input type="submit" class="btn btn-info pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

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