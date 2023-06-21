<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Insert Employee Designations
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
                        <h1 class="box-title"> Insert Employee Designations</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/settings/insert_designations" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Department Type <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" name="dept_type" id="dept_type" required>
                                            <option value="" selected>Select Type</option>
                                            <?php 						
                                            foreach($department_details as $data)						
                                            {				
                                            ?>
                                            <option value="<?php echo $data->id;?>"><?php echo $data->type; ?>
                                            </option>

                                            <?php						
                                            }					
                                            ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Type <span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation_type" name="designation_type"
                                            class="form-control" placeholder="Employee Type">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                        <<input type="hidden" id="roleid" name="roleid" class="form-control" placeholder="role">
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