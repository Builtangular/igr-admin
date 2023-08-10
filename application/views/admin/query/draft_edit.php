<?php $this->load->view('admin/header.php'); 
$Source = array('Email', 'Website', 'Reseller');
$Type = array('Sample Request', 'TOC Request', 'Customization', 'Enquiry', 'Discount Request');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Query
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Update Query Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/draft_update" id="query-form" method="post"
                        class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-1">Source <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="source" id="source">
                                        <?php foreach($Source as $source){ 
                                                if($source == $single_query->source){ ?>
                                        <option value="<?php echo $single_query->source;?>" selected>
                                            <?php echo $single_query->source;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $source;?>"> <?php echo $source; ?> </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Type <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="type" id="type" required>
                                        <?php foreach($Type as $type){ 
                                            if($type == $single_query->type){ ?>
                                        <option value="<?php echo $single_query->type;?>" selected>
                                            <?php echo $single_query->type;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $type;?>"> <?php echo $type; ?> </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Email Id <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="source_mail_id" name="source_mail_id"
                                        value="<?php echo $single_query->source_mail_id;?>" class="form-control"
                                        placeholder="Email Id">
                                </div>
                                <?php if($single_query->source == "Reseller"){ ?>
                                <label class="control-label col-md-1" id="reseller_div">Reseller</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" id="reseller_name" name="reseller_name">
                                        <?php foreach($reseller_list as $list) { 
                                        if($single_query->reseller_name == $list->reseller_name){ ?>
                                        <option value="<?php echo $single_query->reseller_name;?>" selected>
                                            <?php echo $single_query->reseller_name;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <?php }else { ?>
                                <label class="control-label col-md-1 hide" id="reseller_div">Reseller</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none hide" id="reseller_name" name="reseller_name">
                                        <option value="" selected>Select Reseller</option>
                                        <?php foreach($reseller_list as $list) { ?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name">
                                            <?php foreach($scopelist as $scope)	{ 
                                            if($single_query->scope_name == $scope->name){ ?>
                                            <option value="<?php echo $single_query->scope_name;?>" selected>
                                                <?php echo $single_query->scope_name;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $scope->name;?>">
                                                <?php echo $scope->name; ?>
                                            </option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name"
                                            value="<?php echo $single_query->client_name;?>" class="form-control"
                                            placeholder="Client Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone No.</label>
                                    <div class="col-md-8">
                                        <input type="text" id="phone_no" name="phone_no"
                                            value="<?php echo $single_query->phone_no;?>" class="form-control"
                                            placeholder="Phone No.">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name"
                                            value="<?php echo $single_query->company_name;?>" class="form-control"
                                            placeholder="Company Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation"
                                            value="<?php echo $single_query->designation;?>" class="form-control"
                                            placeholder="Designation">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">LinkedIn Profile </label>
                                    <div class="col-md-8">
                                        <input type="text" id="linkedin_profile" name="linkedin_profile"
                                            value="<?php echo $single_query->linkedin_profile;?>" class="form-control"
                                            placeholder="LinkedIn Profile">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name"
                                            value="<?php echo $single_query->report_name;?>" class="form-control"
                                            placeholder="Report Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email"
                                            value="<?php echo $single_query->client_email;?>" class="form-control"
                                            placeholder="Client Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage </label>
                                    <div class="col-md-8">
                                        <textarea name="client_message" id="client_message" rows="3"
                                            class="form-control" placeholder="Client Meassage"
                                            required><?php echo $single_query->client_message;?></textarea>
                                    </div>
                                </div>
                                <?php if($Role_id == 5) {?>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Assign to Team</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team">
                                            <option value="0" selected>Select</option>
                                            <?php foreach($user_details as $data) {	?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php }	?>
                                        </select>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lead Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="lead_date" name="lead_date"
                                            value="<?php echo $single_query->lead_date; ?>" class="form-control"
                                            placeholder="Lead Date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_query)){echo $single_query->id;}?>">
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