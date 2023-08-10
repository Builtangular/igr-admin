<?php $this->load->view('admin/header.php'); 
$status_option = array('Acknowledgement Sent - Analyst Response Pending', 'Sample Sent', 'Client Interested - Need to Discuss with Seniors/Team', 'Client Interested - Budget Issues/Discount Required', 'Client Interested - Need More Time', 'Sale','Reject','Spam','Student');
$currency = array('USD','AED','EUR','SAR','INR');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Status Details
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
                                <?php if($status_details->status == "Sale"){ ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <?php foreach($status_option as $statuses){ if($status_details->status == $statuses){ ?>
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $statuses;?>"><?php echo $statuses;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <?php foreach($currency as $currencies){ if($status_details->licence_price == $currencies){ ?>
                                            <option value="<?php echo $status_details->licence_price;?>" selected>
                                                <?php echo $status_details->licence_price;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $currencies;?>" selected>
                                                <?php echo $currencies;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 hide" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2 hide" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup"
                                            value="<?php echo $status_details->followup_date;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" onblur="reSum();"
                                            class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount"
                                            value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price"
                                            value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                            id="absolute_price" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price"
                                            value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                            id="selling_price" class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <?php } else if($status_details->status == "Reject") { ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <?php foreach($status_option as $statuses){ if($status_details->status == $statuses){ ?>
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $statuses;?>"><?php echo $statuses;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <option value="" selected>Select Currency</option>
                                            <?php foreach($currency as $currencies){ ?>
                                            <option value="<?php echo $currencies;?>">
                                                <?php echo $currencies;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2 hide" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup"
                                            value="<?php echo $status_details->followup_date;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group hide" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" onblur="reSum();"
                                            class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount"
                                            value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price"
                                            value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                            id="absolute_price" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price"
                                            value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                            id="selling_price" class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <?php }else if($status_details->status == "Spam") { ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <?php foreach($status_option as $statuses){ if($status_details->status == $statuses){ ?>
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $statuses;?>"><?php echo $statuses;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <option value="" selected>Select Currency</option>
                                            <?php foreach($currency as $currencies){ ?>
                                            <option value="<?php echo $currencies;?>">
                                                <?php echo $currencies;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 hide" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2 hide" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup"
                                            value="<?php echo $status_details->followup_date;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group hide" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" onblur="reSum();"
                                            class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount"
                                            value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price"
                                            value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                            id="absolute_price" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price"
                                            value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                            id="selling_price" class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <?php }else if($status_details->status == "Student") { ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <?php foreach($status_option as $statuses){ if($status_details->status == $statuses){ ?>
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $statuses;?>"><?php echo $statuses;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <option value="" selected>Select Currency</option>
                                            <?php foreach($currency as $currencies){ ?>
                                            <option value="<?php echo $currencies;?>">
                                                <?php echo $currencies;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 hide" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2 hide" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup"
                                            value="<?php echo $status_details->followup_date;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group hide" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" onblur="reSum();"
                                            class="form-control" placeholder="Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount"
                                            value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price"
                                            value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                            id="absolute_price" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price"
                                            value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                            id="selling_price" class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Status <span class="text-red">*</span></label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status"
                                            id="query_status" onblur="reSum();" required>
                                            <?php foreach($status_option as $statuses){ if($status_details->status == $statuses){ ?>
                                            <option value="<?php echo $status_details->status;?>" selected>
                                                <?php echo $status_details->status;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $statuses;?>"><?php echo $statuses;?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 hide" id="licence">
                                        <label>Currency <span class="text-red">*</span></label>
                                        <select class="form-control b-none" name="currency" id="currency">
                                            <option value="" selected>Select Currency</option>
                                            <?php foreach($currency as $currencies){ ?>
                                            <option value="<?php echo $currencies;?>">
                                                <?php echo $currencies;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 hide" id="reason_div">
                                        <label>Reason <span class="text-red">*</span></label>
                                        <input type="text" id="reason" name="reason"
                                            value="<?php echo $status_details->reason;?>" class="form-control"
                                            placeholder="Reason">
                                    </div>
                                    <div class="col-md-2" id="next_followup_div">
                                        <label>Next FollowUp <span class="text-red">*</span></label>
                                        <input type="date" id="next_followup" name="next_followup"
                                            value="<?php echo $status_details->followup_date;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group hide" id="sale_div">
                                    <div class="col-md-3">
                                        <input type="text" name="price" id="price"
                                            value="<?php echo $status_details->price;?>" onblur="reSum();"
                                            class="form-control" placeholder="Price">                                        
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="discount" id="discount"
                                            value="<?php echo $status_details->discount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="absolute_price"
                                            value="<?php echo $status_details->absolute_price;?>" onblur="reSum();"
                                            id="absolute_price" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="selling_price"
                                            value="<?php echo $status_details->selling_price;?>" onblur="reSum();"
                                            id="selling_price" class="form-control" placeholder="Selling Price">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($status_details)){echo $status_details->id;}?>">
                                <input type="submit" class="btn btn-info pull-right" value="Update">
                            </div>
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
var sale_div = document.getElementById('sale_div');
var reason_div = document.getElementById('reason_div');
var licence = document.getElementById('licence');
var next_followup_div = document.getElementById('next_followup_div');

query_status.addEventListener('change', function() {
    console.log(this.value);
    if (this.value == "Sale") {
        sale_div.classList.remove('hide');
        licence.classList.remove('hide');
        next_followup_div.classList.add('hide');
        reason_div.classList.add('hide');
    } else if (this.value == "Reject") {
        sale_div.classList.add('hide');
        licence.classList.add('hide');
        next_followup_div.classList.add('hide');
        reason_div.classList.remove('hide');
    } else if (this.value == "Spam" || this.value == "Student") {
        sale_div.classList.add('hide');
        licence.classList.add('hide');
        next_followup_div.classList.add('hide');
        reason_div.classList.add('hide');
    } else {
        sale_div.classList.add('hide');
        licence.classList.add('hide');
        next_followup_div.classList.remove('hide');
        reason_div.classList.add('hide');
    }
})

var licence = document.getElementById('licence');
var sale_div = document.getElementById('sale_div');
var licence_price = document.getElementById('licence_price');

licence.addEventListener('change', function() {
    console.log(licence_price.value);
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