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
            <li><a href="<?php echo base_url(); ?>admin/employee"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View</li>
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
                                    <label class="control-label col-md-2">Bank Name :
                                    </label>
                                    <div class="col-md-10">
                                        <span><?php echo $single_bank_data->bank_name;?></span>
                                        <!-- <input type="text" id="bank_name" name="bank_name"
                                            value="<?php echo $single_bank_data->bank_name;?>" class="form-control"
                                            placeholder="Name" required> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Account Name :
                                    </label>
                                    <div class="col-md-10">
                                        <span><?php echo $single_bank_data->ac_name;?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Account Number : </label>
                                    <div class="col-md-10">
                                        <span><?php echo $single_bank_data->ac_no;?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">IFSC Code :
                                    </label>
                                    <div class="col-md-10">
                                        <span><?php echo $single_bank_data->ifsc_code;?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Branch Name :
                                    </label>
                                    <div class="col-md-10">
                                        <span><?php echo $single_bank_data->branch_name;?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo base_url(); ?>admin/employee/bank_list/<?php echo $single_bank_data->emp_id; ?>"
                                class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- jQuery 2.1.3 -->
<?php $this->load->view('admin/footer.php'); ?>