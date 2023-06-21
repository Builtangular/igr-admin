<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Employee Tpye
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
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Update Employee Department</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/settings/update_department" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Type <span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="type" name="type"
                                            value="<?php echo $dept_data->type;?>" class="form-control"
                                            placeholder="Department Type" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($dept_data)){echo $dept_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Bootstrap 3.3.2 JS -->

<?php $this->load->view('admin/footer.php'); ?>