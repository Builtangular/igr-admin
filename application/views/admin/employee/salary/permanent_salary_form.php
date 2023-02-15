<?php $this->load->view('admin/header.php'); ?>

<?php $years = array('2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Salary Breakup
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
                        <h1 class="box-title">  Salary Breakup Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/insert_salary/<?php echo $Emp_id; ?>"
                        method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Year <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-5">
                                            <select class="form-control b-none" name="salary_year" required>
                                                <option value="" selected>Select Year</option>
                                                <?php foreach($years as $year) {	?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php }	 ?>
                                            </select>
                                        </div>
                                        <!-- <label class="control-label col-md-1">Approxal Date<span
                                                class="text-red">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="Gross_basic_salary" name="Gross_basic_salary"
                                                class="form-control" placeholder="Basic" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Basic <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="Gross_basic_salary" name="Gross_basic_salary"
                                                class="form-control" placeholder="Basic" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="G_HRA" name="G_HRA" class="form-control"
                                                placeholder="HRA" onblur="reSum();">
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="G_other" name="G_other" class="form-control"
                                                placeholder="Other" onblur="reSum();">
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Gross Salary<span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="Gross_salary" value="" name="Gross_salary"
                                                class="form-control" placeholder="Total">
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Employee Deduction <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="Emp_PF" name="Emp_PF"
                                                class="form-control" placeholder="PF" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="Emp_ESIC" name="Emp_ESIC" class="form-control"
                                                placeholder="ESIC" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="Emp_PT" name="Emp_PT"
                                                class="form-control" placeholder="PT" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Net Salary<span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="Net_salary" value="" name="Net_salary"
                                                class="form-control" placeholder="Total">
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Employer Share<span
                                                class="text-red">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="Employer_PF" name="Employer_PF"
                                                class="form-control" placeholder="PF" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="Employer_ESIC" name="Employer_ESIC" class="form-control"
                                                placeholder="ESIC" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="Employer_other" name="Employer_other" class="form-control"
                                                placeholder="Other" onblur="reSum();" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">CTC<span
                                                class="text-red">*</span></label></label>
                                        <div class="col-md-5">
                                            <input type="text" id="CTC" name="CTC" value="" class="form-control"
                                                placeholder="CTC">
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <!-- <label> <a href="" class="btn btn-info pull-right" data-role="button" data-inline="true">Skip</a></label> -->
                                        <input type="submit" class="btn btn-info pull-right" value="Submit">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
$(function() {
    $("#datepicker").datepicker();
});
$(function() {
    $("#date").date();
});

/* select marital status */
var marital_status = document.getElementById('marital_status');
var spouse = document.getElementById('spouse');
var father = document.getElementById('father');

marital_status.addEventListener('change', function() {
    if (this.value == "married") {
        spouse.classList.remove('hide');
        father.classList.remove('hide');
    } else {
        spouse.classList.add('hide');
        father.classList.add('hide');
    }


})

/*  calculate salary breckup */
/*  gross salary */
function reSum()
{
    var res,res1,res2,result_net_salary,result_ctc;
    var Gross_basic_salary = parseInt(document.getElementById("Gross_basic_salary").value);
    var G_HRA = parseInt(document.getElementById("G_HRA").value);
    var G_other = parseInt(document.getElementById("G_other").value);
    var Emp_PF = parseInt(document.getElementById("Emp_PF").value);
    var Emp_ESIC = parseInt(document.getElementById("Emp_ESIC").value);
    var Emp_PT = parseInt(document.getElementById("Emp_PT").value);
    var Employer_PF = parseInt(document.getElementById("Employer_PF").value);
    var Employer_ESIC = parseInt(document.getElementById("Employer_ESIC").value);
    var Employer_other = parseInt(document.getElementById("Employer_other").value);

    /* gross - salary deduction */
    res = Gross_basic_salary + G_HRA + G_other;
    res1 = Emp_PF + Emp_ESIC + Emp_PT;
    result_net_salary = res - res1;

    /* gross + employer share */
    res2 = Employer_PF + Employer_ESIC + Employer_other;
    result_ctc = res + res2;

    document.getElementById("Gross_salary").value = Gross_basic_salary + G_HRA + G_other;
    document.getElementById("Net_salary").value = result_net_salary;
    document.getElementById("CTC").value = result_ctc;
}
</script>