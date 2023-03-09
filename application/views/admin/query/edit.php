<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Insert Query Details
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
                        <h1 class="box-title"> Insert Query Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/update" id="employment-form" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Source </label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="source" name="source" required>
                                            <option value="<?php echo $single_query_data->source;?>" selected>
                                                <?php echo $single_query_data->source;?></option>
                                            <option value="Email">Email</option>
                                            <option value="Website">Website</option>
                                            <option value="Reseller">Reseller</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="scope_name" name="scope_name"
                                            value="<?php echo $single_query_data->scope_name;?>" class="form-control"
                                            placeholder="Scope Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name"
                                            value="<?php echo $single_query_data->client_name;?>" class="form-control"
                                            placeholder="Client Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name"
                                            value="<?php echo $single_query_data->company_name;?>" class="form-control"
                                            placeholder="Company Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_message" name="client_message"
                                            value="<?php echo $single_query_data->client_message;?>"
                                            class="form-control" placeholder="Client Meassage" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Source Email Id <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="source_mail_id" name="source_mail_id"
                                            value="<?php echo $single_query_data->source_mail_id;?>"
                                            class="form-control" placeholder="Email Id" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name"
                                            value="<?php echo $single_query_data->report_name;?>" class="form-control"
                                            placeholder="Report Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email"
                                            value="<?php echo $single_query_data->client_email;?>" class="form-control"
                                            placeholder="Client Email" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation"
                                            value="<?php echo $single_query_data->designation;?>" class="form-control"
                                            placeholder="Designation" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Assign To</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="assigned_to" name="assigned_to">
                                            <option value="<?php echo $single_query_data->assigned_to;?>" selected>
                                                <?php echo $single_query_data->assigned_to;?></option>
                                            <?php 						
                                            foreach($user_details as $data)						
                                            {				
                                            ?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php						
                                            }					
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
                            <input type="hidden" id="role_id" name="role_id" class="form-control" placeholder="role">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<?php $this->load->view('admin/footer.php'); ?>