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
                        <h1 class="box-title"> Salary Breakup Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/update_salary/<?php echo $single_tsalary_data->emp_id; ?>"
                        method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Year <span class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <select class="form-control b-none" name="salary_year" required>
                                            <option value="<?php echo $single_tsalary_data->salary_year;?>" selected>
                                                <?php echo $single_tsalary_data->salary_year;?></option>
                                            <?php foreach($years as $year) {	?>
                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php }	 ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Salary <span class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="salary" name="salary"
                                            value="<?php echo $single_tsalary_data->salary;?>" class="form-control"
                                            placeholder="Salary" onblur="reSum();" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="TDS" name="TDS"
                                            value="<?php echo $single_tsalary_data->tds;?>" class="form-control"
                                            placeholder="TDS" onblur="reSum();">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Gross Salary<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" id="net_salary"
                                            value="<?php echo $single_tsalary_data->gross_salary;?>" name="gross_salary"
                                            class="form-control" placeholder="Total" onblur="reSum();">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="emp_id" class="form-control" id="emp_id"
                                value="<?php if(!empty($single_tsalary_data)){echo $single_tsalary_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
/*  calculate temporarily salary breckup */
function reSum() {
    var salary = parseInt(document.getElementById("salary").value);
    var TDS = parseInt(document.getElementById("TDS").value);
    document.getElementById("net_salary").value = salary - TDS;
}
</script>

<?php $this->load->view('admin/footer.php'); ?>
