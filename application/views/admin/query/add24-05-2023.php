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
                    <form autocomplete="off" action="<?php echo base_url(); ?>admin/query/insert" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-1">Source <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="source" id="source" required>
                                        <option value="" selected>Select Source</option>
                                        <option value="Email">Email</option>
                                        <option value="Website">Website</option>
                                        <option value="Reseller">Reseller</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Type<span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="type" id="type" required>
                                        <option value="" selected>Select Type</option>
                                        <option value="Sample Request">Sample Request</option>
                                        <option value="TOC Request">TOC Request</option>
                                        <option value="Customization">Customization</option>
                                        <option value="Enquiry">Enquiry</option>
                                        <option value="Discount Request">Discount Request</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Email Id<span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="source_mail_id" name="source_mail_id" class="form-control"
                                        placeholder="Email Id" required>
                                </div>
                                <label class="control-label col-md-1 hide" id="reseller_div">Name</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none hide" id="reseller_name" name="reseller_name">
                                        <option value="" selected>Reseller Name</option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name<span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name" required>
                                            <option value="" selected>Scope Name</option>
                                            <?php 						
                                            foreach($ScopeList as $scope)						
                                            {				
                                            ?>
                                            <option value="<?php echo $scope->name;?>"><?php echo $scope->name; ?>
                                            </option>
                                            <?php						
                                            }					
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name" class="form-control"
                                            placeholder="Client Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone No.</label>
                                    <div class="col-md-8">
                                        <input type="text" id="phone_no" name="phone_no" class="form-control"
                                            placeholder="Phone No.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name<span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name" class="form-control"
                                            placeholder="Report Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email" class="form-control"
                                            placeholder="Client Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage </label>
                                    <div class="col-md-8">
                                        <textarea name="client_message" id="client_message" rows="4"
                                            class="form-control" placeholder="Client Meassage"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lead Date<span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="lead_date" name="lead_date" class="form-control"
                                            placeholder="Lead Date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($reseller_service_details)){echo $reseller_service_details->id;}?>">
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
<script>
var source = document.getElementById('source');
var reseller_div = document.getElementById('reseller_div');
var reseller_name = document.getElementById('reseller_name');

source.addEventListener('change', function() {
    if (this.value == "Reseller") {
        reseller_name.classList.remove('hide');
        reseller_div.classList.remove('hide');
    } else {
        reseller_name.classList.add('hide');
        reseller_div.classList.add('hide');
    }
})

var reseller_name = document.getElementById('reseller_name');
var service_no = document.getElementById('service_no');

source.addEventListener('change', function() {
    if (this.value == "Reseller") {
        service_no.classList.remove('hide');
        my_div.classList.remove('hide');
    } else {
        service_no.classList.add('hide');
        my_div.classList.add('hide');
    }
})
</script>
<?php $this->load->view('admin/footer.php'); ?>