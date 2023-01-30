<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
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

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Personal Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/Employee_Details/insert_emp_personal_details"
                        method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label class="control-label col-md-2">Employee ID <span class="text-red">*</span></label> -->
                                    <div class="col-md-3">
                                        <b>Job Type <span class="text-red">*</span></b>
                                        <select class="form-control b-none" name="job_type" required>
                                            <option value="" selected>Select Job Type</option>
                                            <option value="Single User">Full Time</option>
                                            <option value="Enterprise">Part Time</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Employee Code <span class="text-red">*</span></b>
                                        <input type="text" id="emp_code" name="emp_code" class="form-control"
                                            placeholder="Employee Id" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Joining Date <span class="text-red">*</span></b>
                                        <input type="date" id="joining_date" name="joining_date" class="form-control"
                                            placeholder="Joining Date" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Termination Date </b>
                                        <input type="date" id="termination_date" name="termination_date"
                                            class="form-control" placeholder="Termination Date">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <b>First Name <span class="text-red">*</span></b>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                            placeholder="First Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Middle Name <span class="text-red">*</span></b>
                                        <input type="text" id="middle_name" name="middle_name" class="form-control"
                                            placeholder="Middle Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Last Name <span class="text-red">*</span></b>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                            placeholder="Last Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Date of Birth <span class="text-red">*</span></b>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                                            placeholder="Date Of Birth" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Gender <span class="text-red">*</span></label><br>
                                        <input type="radio" name="gender" value="Male" checked /> Male &nbsp;&nbsp;
                                        <input type="radio" name="gender" value="Female" /> Female 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Mobile Number <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <!-- <b>Mobile Number <span class="text-red">*</span> </b> -->
                                        <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                            placeholder="Mobile Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <!-- <b>Alternate Mobile Number </b> -->
                                        <input type="text" id="alternate_mobile_no" name="alternate_mobile_no"
                                            class="form-control" placeholder="Alternate Mobile Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email <span class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="email" id="personal_email_id" name="personal_email_id"
                                            class="form-control" placeholder="Personal Email Address" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="official_email_id" name="official_email_id"
                                            class="form-control" placeholder="Office Email Address">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Marital Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="marital_status" id="marital_status" placeholder="">
                                            <option value="" selected>Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="spouse_name" name="spouse_name" class="form-control hide"
                                            placeholder="Spouse Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="father_name" name="father_name" class="form-control hide"
                                            placeholder="Father Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
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
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="relative_contact_no" name="relative_contact_no"
                                            class="form-control" placeholder="Contact Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reference Details</label>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_name" name="reference_name"
                                            class="form-control" placeholder="Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no"
                                            class="form-control" placeholder="Contact Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Id Proof <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="adhar_no" name="adhar_no" class="form-control"
                                            placeholder="Aadhar Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="pan_no" name="pan_no" class="form-control"
                                            placeholder="Pan Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passport_no" name="passport_no" class="form-control"
                                            placeholder="Passport Number">
                                        <span class="help-block margin" id="txtHint"></span>
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
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="passing_year" name="passing_year" class="form-control"
                                            placeholder="Passing Year">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Details <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="department" required>
                                            <option value="" selected>Select Department</option>
                                            <option value="Single User">Account</option>
                                            <option value="Enterprise">Research</option>
                                            <option value="Enterprise">Marketing</option>
                                            <option value="Enterprise">Business Department</option>
                                            <option value="Enterprise">IT</option>
                                            <option value="Enterprise">Back Office</option>
                                            <option value="Enterprise">HR</option>
                                            <option value="Enterprise">Sales</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="job_profile" name="job_profile" class="form-control"
                                            placeholder="Job Profile / Designation" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">UAN & PF No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="uan_no" name="uan_no" class="form-control"
                                            placeholder="UAN Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="pf_no" name="pf_no" class="form-control"
                                            placeholder="PF Number" required>
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
                                    <span class="help-block margin text-red" id="">Note *: Image size should be 20 to 40 Kb</span>
                                </div>
                                <div class="box-footer">
                                    <!-- <label> <a href="" class="btn btn-info pull-right" data-role="button" data-inline="true">Skip</a></label> -->
                                    <input type="submit" class="btn btn-info pull-right" value="Next">
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
function changeyear(inputYear) {
    //alert(inputYear);

    /* var ToForecastPeriod
    var FromPeriod
    var ToPeriod */

    var To_forecast = parseInt(inputYear) + parseInt(6);
    var From_Period = parseInt(inputYear) - parseInt(2);
    var To_Period = parseInt(inputYear) + parseInt(6);
    // $("#To_forecast_period option[value='United State']");
    //alert(To_forecast);
    $("#forecast_to").val(To_forecast);
    $("#analysis_form").val(From_Period);
    $("#analysis_to").val(To_Period);

}

function HideVunit(input) {
    if (input == 1) {
        $('#div2').hide('fast');
        $('#div1').show('fast');
        $('#div4').hide('fast');
        $('#div3').show('fast');
        $('#Volume_unit').attr("required", "required");
        $('#Volume_CAGR').attr("required", "required");
    } else {
        $('#div1').hide('fast');
        $('#div2').show('fast');
        $('#div3').hide('fast');
        $('#div4').show('fast');
        $('#Volume_unit').removeAttr('required', '');
        $('#Volume_CAGR').removeAttr('required', '');
    }
}
</script>
<!-- jQuery 2.1.3 -->
<script src="http://localhost/igr_admin/assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script>
$(document).mouseup(function(e) {
    if ($(e.target).closest("#txtHint").length === 0) {
        $("#txtHint").hide();
    }
});
$("#txtHint").css("display", "none");
$(document).ready(function() {
    $("#search").keyup(function() {
        var str = $("#search").val();
        if (str == "") {
            $("#txtHint").css("display", "none");
        } else {
            $.get("<?php echo base_url(); ?>admin/report/title_exist?name=" + str, function(data) {
                //$("#txtHint" ).html("");
                if (data == "") {
                    // console.log("in if");
                    $("#txtHint").css("display", "none");
                    //$("#txtHint").removeClass("search-result");								
                } else {
                    // console.log("in else");
                    $("#txtHint").html(data);
                    $("#txtHint").css("display", "");
                    //$("#txtHint").addClass("search-result");
                }

            });
        }
    });
});
</script>
<?php $this->load->view('admin/footer.php'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$(function() {
    $("#datepicker").datepicker();
});
$(function() {
    $("#date").date();
});


var marital_status = document.getElementById('marital_status');
var spouse_name = document.getElementById('spouse_name');
var father_name = document.getElementById('father_name');

pageSelector.addEventListener('change', function(){
    if(this.value == "custom") {
        spouse_name.classList.remove('hide');
        father_name.classList.remove('father_name');
    } else {
        spouse_name.classList.add('hide');
        father_name.classList.add('hide');
    }
})
</script>



</script>