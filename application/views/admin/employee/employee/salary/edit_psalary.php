<?php $this->load->view('admin/header.php'); ?>

<?php $years = array('2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Salary
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
                        <h1 class="box-title"> Update Salary Details</h1>
                    </div>
                    <form
                        action="<?php echo base_url(); ?>admin/employee/update_salary/<?php echo $single_psalary_data->id; ?>"
                        method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Year <span class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <select class="form-control b-none" name="salary_year" required>
                                            <option value="<?php echo $single_psalary_data->salary_year;?>" selected>
                                                <?php echo $single_psalary_data->salary_year;?></option>
                                            <?php foreach($years as $year) {	?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php }	 ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Basic <span class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="Gross_basic_salary" name="Gross_basic_salary"
                                            value="<?php echo $single_psalary_data->gross_basic_salary;?>"
                                            class="form-control" placeholder="Basic" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="G_HRA" name="G_HRA"
                                            value="<?php echo $single_psalary_data->gross_hra;?>" class="form-control"
                                            placeholder="HRA" onblur="reSum();">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="G_other" name="G_other"
                                            value="<?php echo $single_psalary_data->gross_other;?>" class="form-control"
                                            placeholder="Other" onblur="reSum();">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Gross Salary<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="Gross_salary" name="Gross_salary"
                                            value="<?php echo $single_psalary_data->gross_salary; ?>"
                                            class="form-control" placeholder="Total">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Employee Deduction <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="Emp_PF" name="Emp_PF"
                                            value="<?php echo $single_psalary_data->emp_pf;?>" class="form-control"
                                            placeholder="PF" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="Emp_ESIC" name="Emp_ESIC"
                                            value="<?php echo $single_psalary_data->emp_esic;?>" class="form-control"
                                            placeholder="ESIC" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="Emp_PT" name="Emp_PT"
                                            value="<?php echo $single_psalary_data->emp_pt;?>" class="form-control"
                                            placeholder="PT" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Net Salary<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="Net_salary" name="Net_salary"
                                            value="<?php echo $single_psalary_data->net_salary;?>" class="form-control"
                                            placeholder="Total">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Employer Share<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="Employer_PF" name="Employer_PF"
                                            value="<?php echo $single_psalary_data->employer_pf;?>" class="form-control"
                                            placeholder="PF" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="Employer_ESIC" name="Employer_ESIC"
                                            value="<?php echo $single_psalary_data->employer_esic;?>"
                                            class="form-control" placeholder="ESIC" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="Employer_other" name="Employer_other"
                                            value="<?php echo $single_psalary_data->employer_other;?>"
                                            class="form-control" placeholder="Other" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">CTC<span
                                            class="text-red">*</span></label></label>
                                    <div class="col-md-5">
                                        <input type="text" id="CTC" name="CTC"
                                            value="<?php echo $single_psalary_data->ctc;?>" class="form-control"
                                            placeholder="CTC">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="emp_id" class="form-control" id="emp_id"
                                value="<?php if(!empty($single_psalary_data)){echo $single_psalary_data->emp_id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
/*  calculate salary breckup */
/*  gross salary */
function reSum() {
    var res, res1, res2, result_net_salary, result_ctc;
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
<?php $this->load->view('admin/footer.php'); ?>