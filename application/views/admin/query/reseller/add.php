<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Insert Reseller Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <style>
    .error {
        color: red;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Insert Reseller Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/insert_reseller" id="employment-form" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Reseller Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="reseller_name" name="reseller_name" class="form-control"
                                            placeholder="Reseller Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Reseller Email Id <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="reseller_email" name="reseller_email" class="form-control"
                                            placeholder="Reseller Email" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Service No.
                                    <span
                                            class="text-red">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" id="service_no" name="service_no" class="form-control"
                                            placeholder="Service No" required>
                                        <span class="help-block margin" id="txtHint"></span>
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


<!-- Bootstrap 3.3.2 JS -->

<?php $this->load->view('admin/footer.php'); ?>