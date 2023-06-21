<?php $this->load->view('admin/header.php'); ?>

<?php 
// $Job_type = array('Full Time', 'Part Time', 'Freelance');
$Prefix = array('Mr.', 'Mrs.', 'Miss.');
$Departments = array('Account', 'Research', 'Marketing', 'Business Department', 'IT', 'Back Office', 'HR', 'Sales', 'Graphics');
$Education_type = array('Diploma', 'Graduation', 'Post Graduation');
?>
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
                        <h1 class="box-title" style="color:green"> Basic Information</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/insert" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Prefix<span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="prefix" required>
                                            <option value="" selected>Select</option>
                                            <?php $i = 0; foreach($Prefix as $prefix) { ?>
                                            <option value="<?php echo $Prefix[$i]; ?>"><?php echo $Prefix[$i]; ?>
                                            </option>
                                            <?php  $i++; }  ?>
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
                                    <div class="col-md-4">
                                        <b>Personal Email <span class="text-red">*</span></b>
                                        <input type="email" id="personal_email_id" name="personal_email_id"
                                            class="form-control" placeholder="Personal Email Address" required>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Mobile Number <span class="text-red">*</span></b>
                                        <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                            placeholder="Mobile Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Alternate Mobile Number </b>
                                        <input type="text" id="alternate_mobile_no" name="alternate_mobile_no"
                                            class="form-control" placeholder="Alternate Mobile Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label>Gender <span class="text-red">*</span></label><br>
                                        <input type="radio" name="gender" value="Male" checked /> Male &nbsp;&nbsp;
                                        <input type="radio" name="gender" value="Female" /> Female
                                    </div>
                                    <div class="col-md-3">
                                        <label>User Type <span class="text-red">*</span></label><br>
                                        <input type="radio" name="user_type" value="Fresher" checked /> Fresher
                                        &nbsp;&nbsp;
                                        <input type="radio" name="user_type" value="Experienced" /> Experienced
                                    </div>

                                    <div class="col-md-3">
                                        <label>Upload Image <span class="text-red">*</span></label><br>
                                        <input type="file" name="upload_image" class="form-control">
                                        <!-- <input type="hidden" name="upload_image" class="form-control-file"
                                            id="upload_image"> -->
                                    </div>
                                </div>

                                <div class="box-header with-border">
                                    <h1 class="box-title pull-left" style="color:green"> Work Information</h1>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Employee Code <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="emp_code" name="emp_code" class="form-control"
                                            placeholder="Employee Id">
                                    </div>
                                    <label class="control-label col-md-2">Office Email Address </label>
                                    <div class="col-md-4">
                                        <input type="text" id="official_email_id" name="official_email_id"
                                            class="form-control" placeholder="Employee Mail Id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Type <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="job_type" id="job_type" required>
                                            <option value="" selected>Select Type</option>
                                            <?php 						
                                            foreach($type_details as $data)						
                                            {				
                                            ?>
                                            <option value="<?php echo $data->type;?>"><?php echo $data->type; ?>
                                            </option>
                                            <?php						
                                            }					
                                            ?>
                                            </option>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-2">Department <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="department" id="sel_depart" required>
                                            <option value="" selected>Select Department</option>
                                            <!-- <option value="Admin" selected>Admin</option> -->

                                            <?php 						
                                            foreach($department_details as $data)						
                                            {				
                                            ?>
                                            <option value="<?php echo $data->id;?>"><?php echo $data->type; ?>
                                            </option>
                                            <?php						
                                            }					
                                            ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Designation <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                    <select class="form-control b-none" name="designation" id="sel_design" required>
                                            <option value="">Select Designation</option>
                                            
                                        </select>
                                       <!--  <select class="form-control b-none" name="designation" id="sel_design" required>
                                            <option value="" selected>Select Designation</option>
                                            <?php 						
                                            foreach($designation_data as $data)						
                                            {				
                                            ?>
                                            <option value="<?php echo $data->designation_type;?>"><?php echo $data->designation_type; ?>
                                            </option>
                                            
                                            <?php						
                                            }					
                                            ?>
                                            </option>
                                        </select> -->
                                       
                                    </div>
                                  
                                    <label class="control-label col-md-2">Head Name </label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="head_name" id='sel_head'>
                                            <option value="">-- Select head --</option>
                                            <!-- <option value="Admin">Admin</option> -->
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" id="type_id">Joining Date <span
                                            class="text-red">*</span></label>
                                    <label class="control-label col-md-2 hide" id="start_id">Contract Start Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="joining_date" name="joining_date" class="form-control"
                                            placeholder="Joining Date" required>
                                    </div>
                                    <label class="control-label col-md-2" id="resign_date">Resignation Date <span
                                            class="text-red">*</span></label>
                                    <label class="control-label col-md-2 hide" id="end_date">Contract End Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="resignation_date" name="resignation_date"
                                            class="form-control" placeholder="Termination Date">
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                <label class="control-label col-md-2" id="next_id">Next Appraisal Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4" id="my_div">
                                        <input type="date" id="appraisal_date" name="appraisal_date"
                                            class="form-control" placeholder="Appraisal Date">
                                    </div>
                                    <label class="control-label col-md-2">Employee Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="emp_status" id="emp_status"
                                            placeholder="" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Terminated">Terminated</option>
                                            <option value="Deceased">Deceased</option>
                                            <option value="Leave of Absence">Leave of Absence</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="box-header with-border">
                                    <h1 class="box-title pull-left" style="color:green"> Personal Information</h1>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Date of Birth <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                            placeholder="Date Of Birth" required>
                                    </div>
                                    <label class="control-label col-md-2">Blood Group </label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="blood_group" id="blood_group"
                                            placeholder="">
                                            <option value="" selected>Select Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="A1-">A1-</option>
                                            <option value="A1+">A1+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="AB-">B+</option>
                                            <option value="AB-">B-</option>
                                            <option value="AB-">B1+</option>
                                            <option value="AB-">B1-</option>
                                            <option value="AB-">O+</option>
                                            <option value="AB-">O-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Marital Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="marital_status" id="marital_status"
                                            placeholder="" onChange="visacatOnchange();" required>
                                            <option value="" selected>Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
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
                                    <label class="control-label col-md-2">Permanent Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <textarea name="permant_address" id="permant_address" rows="3"
                                            class="form-control" placeholder="Permanent Address" required></textarea>
                                    </div>
                                    <label class="control-label col-md-2">Current Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <textarea name="current_address" id="current_address" rows="3"
                                            class="form-control" placeholder="Current Address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Relative Details </label>
                                    <div class="col-md-4">
                                        <input type="text" id="relative_name" name="relative_name" class="form-control"
                                            placeholder="Relative Name">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="relative_contact_no" name="relative_contact_no"
                                            class="form-control" placeholder="Relative Contact Number">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="relation" name="relation" class="form-control"
                                            placeholder="Relationship">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Emergency Details <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="emergency_name" name="emergency_name"
                                            class="form-control" placeholder="Full Name">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="emergency_contact_no" name="emergency_contact_no"
                                            class="form-control" placeholder="Contact Number">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="emergency_relation" name="emergency_relation"
                                            class="form-control" placeholder="Relationship">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">UAN No.</label>
                                    <div class="col-md-4">
                                        <input type="text" id="uan_no" name="uan_no" class="form-control"
                                            placeholder="UAN Number">
                                    </div>
                                    <label class="control-label col-md-2">PF No.</label>
                                    <div class="col-md-4">
                                        <input type="text" id="pf_no" name="pf_no" class="form-control"
                                            placeholder="PF Number">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Id Proof <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="aadhaar_no" name="aadhaar_no" class="form-control"
                                            placeholder="Aadhar Number" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="pan_no" name="pan_no" class="form-control"
                                            placeholder="Pan Number" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="passport_no" name="passport_no" class="form-control"
                                            placeholder="Passport Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Education <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="education_type" required>
                                            <option value="" selected>Select</option>
                                            <?php $i = 0; foreach($Education_type as $education) { ?>
                                            <option value="<?php echo $Education_type[$i]; ?>">
                                                <?php echo $Education_type[$i]; ?>
                                            </option>
                                            <?php  $i++; }  ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="degree" name="degree" class="form-control"
                                            placeholder="Degree" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passing_year" name="passing_year" class="form-control"
                                            placeholder="Passing Year" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                        <input type="hidden" id="roleid" name="roleid" class="form-control" placeholder="role">
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

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
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

var job_type = document.getElementById('job_type');
var start_id = document.getElementById('start_id');
var type_id = document.getElementById('type_id');
var resign_date = document.getElementById('resign_date');
var end_id = document.getElementById('end_id');
var next_id = document.getElementById('next_id');
var my_div = document.getElementById('my_div');

job_type.addEventListener('change', function() {
    if (this.value == "Contract") {
        start_id.classList.remove('hide');
        type_id.classList.add('hide');
        end_date.classList.remove('hide');
        resign_date.classList.add('hide');
        next_id.classList.add('hide');
        my_div.classList.add('hide');
    } else {
        start_id.classList.add('hide');
        type_id.classList.remove('hide');
        end_date.classList.add('hide');
        resign_date.classList.remove('hide');
        next_id.classList.remove('hide');
        my_div.classList.remove('hide');
    }
})
/* 
$('#sel_depart').change(function() {
    var department = $(this).val();
    console.log(department);
    AJAX request
    $.ajax({
        url: '<?=base_url()?>admin/employee/get_head_name',
        method: 'post',
        data: {
            department: department
        },
        dataType: 'json',
        success: function(response) {
            alert(response);
            Remove options
            $('#sel_head').find('option').not(':first').remove();

            Add options
            $.each(response, function(index, data) {
                $('#sel_head').append('<option value="' + data['first_name'] + '">' + data[
                    'first_name'] + '</option>');
            });
        }

    });
    console.log(data)
}); */

$('#sel_depart').change(function() {
    var dept_id = $(this).val();
    //console.log(dept_id);
    // AJAX request
    $.ajax({
        url: '<?=base_url()?>admin/employee/get_designation_name',
        method: 'post',
        data: {
            dept_id: dept_id
        },
        dataType: 'json',
        success: function(response) {
            // alert(response);
            // Remove options
            $('#sel_design').find('option').not(':first').remove();
            // Add options
            $.each(response, function(index, data) {
                $('#sel_design').append('<option value="' + data['designation_type'] + '">' + data[
                    'designation_type'] + '</option>');
            });
        }

    });
    // console.log(data)
});


$('#sel_design').change(function() {
    var designation = $(this).val();
    var department = document.getElementById('sel_depart');
    // var designation = document.getElementById('sel_design');
    // console.log(department.value);
   console.log(designation);
    // AJAX request
    $.ajax({
        url: '<?=base_url()?>admin/employee/get_head_name',
        method: 'post',
        data: {
            designation: designation,
            department: department.value
        },
        dataType: 'json',
        success: function(response) {
            //alert(response);
            // Remove options
            $('#sel_head').find('option').not(':first').remove();
            // Add options
            $.each(response, function(index, data) {
                $('#sel_head').append('<option value="' + data['first_name'] + '">' + data[
                    'first_name'] + '</option>');
            });
        }

    });
    // console.log(data)
});
</script>

<?php $this->load->view('admin/footer.php'); ?>