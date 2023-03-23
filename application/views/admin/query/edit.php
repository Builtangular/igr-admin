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
                                    <label class="control-label col-md-4">Scope Name</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name">
                                            <option value="<?php echo $single_query_data->scope_name;?>" selected>
                                                <?php echo $single_query_data->scope_name;?></option>
                                            <?php 						
                                            foreach($ScopeList as $scope)						
                                            {				
                                            ?>
                                            <option value="<?php echo $scope->name;?>">
                                                <?php echo $scope->name; ?>
                                            </option>
                                            <?php						
                                            }					
                                            ?>
                                        </select>
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
                                        <textarea name="client_message" id="client_message" rows="3"
                                            class="form-control" placeholder="Client Meassage"
                                            required><?php echo $single_query_data->client_message;?></textarea>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if($single_query_data->source == "Reseller"){ ?>
                                <div class="form-group">
                                    <label class="control-label col-md-4" id="reseller_div">Reseller Name</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="reseller_name" name="reseller_name">
                                            <option value="<?php echo $single_query_data->reseller_name;?>" selected>
                                                <?php echo $single_query_data->reseller_name;?></option>
                                            <?php 						
                                            foreach($reseller_list as $list)						
                                            {				
                                            ?>
                                            <option value="<?php echo $list->reseller_name;?>">
                                                <?php echo $list->reseller_name; ?></option>
                                            <?php						
                                            }					
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
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
                                    <label class="control-label col-md-4">Client Email1</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email1" name="client_email1"
                                            value="<?php echo $single_query_data->client_email1;?>" class="form-control"
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

<script>
var source = document.getElementById('source');
var reseller_name = document.getElementById('reseller_name');
var reseller_div = document.getElementById('reseller_div');

source.addEventListener('change', function() {
    if (this.value == "Reseller") {
        reseller_name.classList.remove('hide');
        reseller_div.classList.remove('hide');
    } else {
        reseller_name.classList.add('hide');
        reseller_div.classList.add('hide');
    }
})

</script>
<?php $this->load->view('admin/footer.php'); ?>