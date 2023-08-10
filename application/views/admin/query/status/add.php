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
                        <h1 class="box-title">Add Status</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/insert_status/<?php echo $id;?>" method="post"
                        class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label class="control-label col-md-1"> Status <span
                                            class="text-red">*</span></label> -->
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <option value="" selected>Select Status</option>
                                            <option value="Acknowledgement Sent - Analyst Response
                                                Pending">Acknowledgement Sent - Analyst Response
                                                Pending</option>
                                            <option value="Sample Sent">Sample Sent</option>
                                            <option value="Client Interested - Need to Discuss with Seniors/Team">Client
                                                Interested - Need to Discuss with Seniors/Team</option>
                                            <option value="Client Interested - Budget Issues/Discount Required">Client
                                                Interested - Budget Issues/Discount Required</option>
                                            <option value="Client Interested - Need More Time">Client Interested - Need
                                                More Time</option>
                                            <!-- <option value="Handled - Client Not Interested/Closed">Handled - Client Not
                                                Interested/Closed</option> -->
                                            <!-- <option value="Client Declined">Client Declined</option> -->
                                            <option value="Sale">Sale</option>
                                            <option value="Reject">Reject</option>
                                            <option value="Spam">Spam</option>
                                            <option value="Student">Student</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <option value="" selected>Select Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="AED">AED</option>
                                            <option value="EUR">EUR</option>
                                            <option value="SAR">SAR</option>
                                            <option value="INR">INR</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 hide" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2 hide" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup" class="form-control">
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
                                        <input type="text" name="selling_price" onblur="reSum();" id="selling_price"
                                            class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <!-- <div class="form-group hide" id="reason_div">
                                    <div class="col-md-6">
                                        <input type="text" id="reason" name="reason" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                </div> -->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var query_status = document.getElementById('query_status');
var licence = document.getElementById('licence');
var reason_div = document.getElementById('reason_div');
var sale_div = document.getElementById('sale_div');
var followup_div = document.getElementById('next_followup_div');

query_status.addEventListener('change', function() {
    if (this.value == "Sale") {
        licence.classList.remove('hide');
        reason_div.classList.add('hide');
        followup_div.classList.add('hide');
    } else if (this.value == "Reject") {
        reason_div.classList.remove('hide');
        licence.classList.add('hide');
        sale_div.classList.add('hide');
        followup_div.classList.add('hide');
    } else if (this.value == "Spam") {
        reason_div.classList.add('hide');
        licence.classList.add('hide');
        sale_div.classList.add('hide');
        followup_div.classList.add('hide');
    } else if (this.value == "Student") {
        reason_div.classList.add('hide');
        licence.classList.add('hide');
        sale_div.classList.add('hide');
        followup_div.classList.add('hide');
    } else {
        licence.classList.add('hide');
        reason_div.classList.add('hide');
        followup_div.classList.remove('hide');
    }
})

var licence = document.getElementById('licence');
var sale_div = document.getElementById('sale_div');
var currency = document.getElementById('currency');

licence.addEventListener('change', function() {
    // console.log(currency.value);
    if (currency.value == "USD" || "AED" || "EUR" || "SAR" || "INR") {
        sale_div.classList.remove('hide');
        // reason_div.classList.remove('hide');
    } else {
        sale_div.classList.add('hide');
        // reason_div.classList.add('hide');
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