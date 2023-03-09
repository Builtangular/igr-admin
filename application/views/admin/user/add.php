<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Details
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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> User Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/register_user/insert"
                        id="employment-form" method="post" class="form-horizontal" 
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Head Name </label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="head_name" name="head_name"
                                        required>
                                            <option value="" selected>Select Head</option>
                                            <?php 						
                                            foreach($user_details as $data)						
                                            {						
                                            ?>
                                            <option value="<?php echo $data->full_name;?>"><?php echo $data->full_name; ?></option>
                                            <?php						
                                            }					
                                            ?>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Full Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="full_name" name="full_name" class="form-control"
                                            placeholder="Full Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4">Email Id <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="email_id" name="email_id" class="form-control"
                                            placeholder="Email" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mobile No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="mobile_no" name="mobile_no" class="form-control"
                                            placeholder="Mobile No" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                               
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">User Type </label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="user_type" name="user_type"
                                        required>
                                            <option value="0" selected>Select User Type</option>
                                            <?php 						
                                            foreach($user_record as $data)						
                                            {						
                                            ?>
                                            <option value="<?php echo $data->id;?>"><?php echo $data->role_type; ?></option>
                                            <?php						
                                            }					
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Department</label>
                                    <div class="col-md-8">
                                        <input type="text" id="department" name="department"
                                            class="form-control" placeholder="Department" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Password</label>
                                    <div class="col-md-8">
                                        <input type="text" id="password" name="password"
                                            class="form-control" placeholder="Password" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit"> 
                                <input type="hidden" id="role_id" name="role_id" class="form-control"
                                        placeholder="role">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->

