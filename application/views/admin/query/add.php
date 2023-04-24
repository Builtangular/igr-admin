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
                    <form action="<?php echo base_url(); ?>admin/query/insert" id="employment-form" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Source </label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" name="source" id="source" required>
                                            <option value="" selected>Select Source Type</option>
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
                                            class="form-control" placeholder="Email Id" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name">
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
                                    <label class="control-label col-md-4">Client Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name" class="form-control"
                                            placeholder="Client Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            placeholder="Company Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <textarea name="client_message" id="client_message" rows="3"
                                            class="form-control" placeholder="Client Meassage" required></textarea>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4 hide" id="reseller_div">Reseller Name</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none hide" id="reseller_name"
                                            name="reseller_name">
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
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4 hide" id="my_div">Service No. </label>
                                    <div class="col-md-8 ">
                                        <input type="text" id="service_no" name="service_no" class="form-control hide"
                                            placeholder="Service No." required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name" class="form-control"
                                            placeholder="Report Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email" class="form-control"
                                            placeholder="Client Email" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email1</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email1" name="client_email1" class="form-control"
                                            placeholder="Client Email">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Assign To</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="assigned_to" name="assigned_to">
                                            <option value="" selected>Assign To</option>
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

// $(document).ready(function() {
//  $('.hidden').hide();    
//  $("select#reseller_name").on('change',function() {
//         var selected = $(this).val();
//         $('div.hidden').hide();
//         $('div.'+selected).show()
//  });
// });
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