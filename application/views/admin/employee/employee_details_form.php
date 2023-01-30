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
                        <h1 class="box-title"> Employee Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/Employee_Details/insert_employee_details/<?php echo $id; ?>" method="post" class="form-horizontal"
                        autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Company Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            placeholder="Company Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date Of Joining <span
                                            class="text-red">*</span></label>
                                            <div class="col-md-4">
                                                <input type="date" id="date_of_joining" name="date_of_joining" class="form-control"
                                                placeholder="Joining Date" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Company Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="company_address" name="company_address" class="form-control"
                                            placeholder="Company Address" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date of Releaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="date_of_releaving" name="date_of_releaving" class="form-control"
                                            placeholder="Date Of Releaving" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Designation <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Last Drown Salary <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="last_drown_salary" name="last_drown_salary" class="form-control"
                                            placeholder="Last Drown Salary" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Type <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="job_type" placeholder="">
                                            <option value="" selected>Select Job Type</option>
                                            <option value="Single User">Full Time</option>
                                            <option value="Enterprise">Part Time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reason For Leaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="reason_for_leaving" name="reason_for_leaving" class="form-control"
                                            placeholder="Reason For Leaving" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reference Contact Number <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no" class="form-control"
                                            placeholder="Reference Contact Number" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
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
</script>



</script>