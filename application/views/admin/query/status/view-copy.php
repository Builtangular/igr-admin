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

    hidden-panel {
        display: none;
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
                    <form action="<?php echo base_url(); ?>admin/query/update_status/" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-1"> Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="status" id="query_status"
                                            placeholder="" onblur="reSum();">
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <option value="Sale">Sale</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <?php if($status_details->status == "Sale"){ ?>
                                    <div class="form-group" id="sale_div">
                                        <div class="col-md-2">
                                            <input type="text" name="price" id="price"
                                                value="<?php echo $status_details->price;?>" onblur="reSum();"
                                                class="form-control" placeholder="Price">
                                            <input type="text" name="reason" id="reason"
                                                value="<?php echo $status_details->reason;?>" class="form-control hide"
                                                placeholder="Reason">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="discount" id="discount"
                                                value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                                class="form-control" placeholder="Discount">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="absolute_price"
                                                value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                                id="absolute_price" class="form-control" placeholder="Absolute Price">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="selling_price"
                                                value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                                id="selling_price" class="form-control" placeholder="Selling Price">
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group" id="reason_div">
                                        <div class="col-md-2">
                                            <input type="text" name="price" id="price" onblur="reSum();"
                                                class="form-control hide" placeholder="Price">
                                            <input type="text" id="reason" name="reason"
                                                value="<?php echo $status_details->reason;?>" class="form-control"
                                                placeholder="Reason">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="discount" id="discount" onblur="reSum();"
                                                class="form-control hide" placeholder="Discount">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="absolute_price" onblur="reSum();"
                                                id="absolute_price" class="form-control hide"
                                                placeholder="Absolute Price">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="selling_price" onblur="reSum();" id="selling_price"
                                                class="form-control hide" placeholder="Selling Price">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($status_details)){echo $status_details->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Update">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var query_status = document.getElementById('query_status');
var sale_div = document.getElementById('sale_div');
var reason_div = document.getElementById('reason_div');
query_status.addEventListener('change', function() {
    if (this.value == "Sale") {
        price.classList.remove('hide');
        discount.classList.remove('hide');
        absolute_price.classList.remove('hide');
        selling_price.classList.remove('hide');
        reason.classList.add('hide');
    } else {
        price.classList.add('hide');
        discount.classList.add('hide');
        absolute_price.classList.add('hide');
        selling_price.classList.add('hide');
        reason.classList.remove('hide');
    }
})
function reSum() {
    var discount, result, mult, dis;
    var price = parseInt(document.getElementById("price").value);
    var discount = parseInt(document.getElementById("discount").value);
    var absolute_price = parseInt(document.getElementById("absolute_price").value);
    /* calculate discount */
    discount = (discount / 100).toFixed(2);
    mult = price * discount;
    dis = price - mult;
    /* substration of price and absolute value */
    result = price - absolute_price;
    if (result) {
        document.getElementById("selling_price").value = result;
    } else {
        document.getElementById("selling_price").value = dis;
    }
}
$(document).ready(function() {
    $('#discount').click(function() {
        $('#absolute_price').attr('disabled', 'disabled');
    });
    $('#absolute_price').click(function() {
        $('#discount').attr('disabled', 'disabled');
    });
});
</script>
<?php $this->load->view('admin/footer.php'); ?>