<?php $this->load->view('admin/header.php'); ?>

<?php $years = array('2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bank Details
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
                        <h1 class="box-title"> Personal Bank Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/insert_bank/<?php echo $Emp_id; ?>"
                        id="bank-form" method="post" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Bank Name </label>
                                    <div class="col-md-10">
                                        <input type="text" id="p_bank_name" name="p_bank_name" class="form-control"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Account Name. </label>
                                    <div class="col-md-5">
                                        <input type="text" id="p_account_name" name="p_account_name"
                                            class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="p_account_no" name="p_account_no" class="form-control"
                                            placeholder="Account No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">IFSC Code </label>
                                    <div class="col-md-5">
                                        <input type="text" id="p_ifsc_code" name="p_ifsc_code" class="form-control"
                                            placeholder="IFSC Code">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="p_branch_name" name="p_branch_name" class="form-control"
                                            placeholder="Branch Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="hidden" id="p_type" name="p_type" value="Personal"
                                            class="form-control" placeholder="Type">
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h1 class="box-title"> Salary Bank Details</h1>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Bank Name </label>
                                    <div class="col-md-10">
                                        <input type="text" id="s_bank_name" name="s_bank_name" class="form-control"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Account Name. </label>
                                    <div class="col-md-5">
                                        <input type="text" id="s_account_name" name="s_account_name"
                                            class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="s_account_no" name="s_account_no" class="form-control"
                                            placeholder="Account No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">IFSC Code </label>
                                    <div class="col-md-5">
                                        <input type="text" id="s_ifsc_code" name="s_ifsc_code" class="form-control"
                                            placeholder="IFSC Code">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="s_branch_name" name="s_branch_name" class="form-control"
                                            placeholder="Branch Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="hidden" id="s_type" name="s_type" value="Salary"
                                            class="form-control" placeholder="Type">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- jQuery 2.1.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script>
$(document).ready(function() {
    $("#bank-form").validate({
        rules: {
            p_bank_name: {
                required: true
            },
            p_account_name: {
                required: true
            },
            p_account_no: {
                required: true
            },
            p_ifsc_code: {
                required: true
            },
            p_branch_name: {
                required: true
            },
            p_type: {
                required: true
            },
        }
    });
});
</script>
<?php $this->load->view('admin/footer.php'); ?>