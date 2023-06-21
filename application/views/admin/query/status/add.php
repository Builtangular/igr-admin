<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Status
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
                                    <label class="control-label col-md-1"> Status <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-2">
                                        <select class="form-control b-none" name="status" id="query_status"
                                            placeholder="" onblur="reSum();">
                                            <option value="" selected>Select</option>
                                            <option value="Sale">Sale</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <select class="form-control b-none" name="licence_price" id="licence_price"
                                            placeholder="">
                                            <option value="" selected>Select</option>
                                            <option value="USD">USD</option>
                                            <option value="AED">AED</option>
                                            <option value="EUR">EUR</option>
                                            <option value="SAR">SAR</option>
                                            <option value="INR">INR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group hide" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price" onblur="reSum();"
                                            class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price" onblur="reSum();" id="absolute_price"
                                            class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price" id="selling_price"
                                            class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <div class="form-group hide" id="reason_div">
                                    <div class="col-md-4">
                                        <input type="text" id="reason" name="reason" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
// var query_status = document.getElementById('query_status');
// var sale_div = document.getElementById('sale_div');
// var reason_div = document.getElementById('reason_div');
// query_status.addEventListener('change', function() {
//     if (this.value == "Sale") {
//         sale_div.classList.remove('hide');
//         reason_div.classList.add('hide');
//     } else if (this.value == "Reject") {
//         reason_div.classList.remove('hide');
//         sale_div.classList.add('hide');
//     } else {
//         reason_div.classList.add('hide');
//         sale_div.classList.add('hide');
//     }
// })
var query_status = document.getElementById('query_status');
var licence = document.getElementById('licence');
var reason_div = document.getElementById('reason_div');

query_status.addEventListener('change', function() {
    if (this.value == "Sale") {
        licence.classList.remove('hide');
        reason_div.classList.add('hide');
    } else if (this.value == "Reject") {
        reason_div.classList.remove('hide');
        licence.classList.add('hide');
    } else {
        licence.classList.add('hide');
        reason_div.classList.add('hide');
    }
})

var licence = document.getElementById('licence');
var sale_div = document.getElementById('sale_div');
var licence_price = document.getElementById('licence_price');

licence.addEventListener('change', function() {
    // console.log(licence_price.value);
    if (licence_price.value == "USD" || "AED" || "EUR" || "SAR" || "INR") {
        sale_div.classList.remove('hide');
        // reason_div.classList.remove('hide');
    } else {
        sale_div.classList.add('hide');
        // reason_div.classList.add('hide');
    }
})


function reSum() {
    var discount, result, mult, dis;
    /* var price = parseInt(document.getElementById("price").value);
    var discount = parseInt(document.getElementById("discount").value);
    var absolute_price = parseInt(document.getElementById("absolute_price").value); */
    var price = document.getElementById("price").value;
    var discount = parseInt(document.getElementById("discount").value);
    var absolute_price = parseInt(document.getElementById("absolute_price").value);
    /* calculate discount */
    discount = (discount / 100).toFixed(2);
    mult = price * discount;
    dis = price - mult;
    /* substration of price and absolute value */
    result = price - absolute_price;
    console.log(price);
    console.log(result);
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