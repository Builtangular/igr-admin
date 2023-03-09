<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Status Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
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
                        <h1 class="box-title"> Status Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/insert_status/<?php echo $id;?>" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2"> Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="status" id="query_status"
                                            placeholder="">
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <option value="Sale">Sale</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <?php if($status_details->status == "Sale"){ ?>
                                    <div class="col-md-4">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" class="form-control"
                                            placeholder="Price">
                                        <input type="text" name="reason" id="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control hide"
                                            placeholder="Reason">
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" class="form-control hide"
                                            placeholder="Price">
                                        <input type="text" name="reason" id="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($status_details)){echo $status_details->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

<script>
var query_status = document.getElementById('query_status');
var price = document.getElementById('price');
var reason = document.getElementById('reason');
// console.log(reason); die;
query_status.addEventListener('change', function() {
    if (this.value == "Sale") {
        price.classList.remove('hide');
        reason.classList.add('hide');
    } else {
        price.classList.add('hide');
        reason.classList.remove('hide');
    }
})
</script>


<?php $this->load->view('admin/footer.php'); ?>