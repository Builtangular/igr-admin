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
                        <h1 class="box-title"> <?php echo $single_bank_data->type;?> Bank Details</h1>
                    </div>
                    <form
                        action="<?php echo base_url(); ?>admin/employee/update_bank/<?php echo $single_bank_data->id; ?>"
                        id="bank-form" method="post" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Bank Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" id="bank_name" name="bank_name"
                                            value="<?php echo $single_bank_data->bank_name;?>" class="form-control"
                                            placeholder="Bank Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Account Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="account_name" name="account_name" class="form-control"
                                            value="<?php echo $single_bank_data->ac_name;?>" placeholder="Account Name"
                                            required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="account_no" name="account_no" class="form-control"
                                            value="<?php echo $single_bank_data->ac_no;?>" placeholder="Account No"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">IFSC Code <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" id="ifsc_code" name="ifsc_code" class="form-control"
                                            value="<?php echo $single_bank_data->ifsc_code;?>" placeholder="IFSC Code"
                                            required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="branch_name" name="branch_name" class="form-control"
                                            value="<?php echo $single_bank_data->branch_name;?>"
                                            placeholder="Branch Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="hidden" id="type" name="type" class="form-control"
                                            value="<?php echo $single_bank_data->type;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="emp_id" id="emp_id" class="form-control"
                                value="<?php echo $single_bank_data->emp_id; ?>">
                            <a href="<?php echo base_url(); ?>admin/employee/bank_list/<?php echo $single_bank_data->emp_id; ?>"
                                class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
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