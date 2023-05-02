<?php $this->load->view('admin/header.php'); 
$discount_type = array('Percentage','Absolute');
$currency = array('USD','AED','SAR','EUR');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Reseller Invoice
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Invoice Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/custom_invoice/update/<?php echo $custom_invoice_data->id;?>" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Invoice Title</label>
                                <div class="col-md-3">
                                    <input type="text" name="title" id="title"
                                        value="<?php echo $custom_invoice_data->title;?>" class="form-control"
                                        placeholder="Invoice Title" required>
                                </div>
                                <?php $invoice = explode("-", $custom_invoice_data->invoice_no);
                                    $invoiceno = $invoice[0];
                                    $invoice_no1 = $invoice[1];
                                    $invoice_no2 = $invoice[2];
                                ?>
                                <label class="control-label col-md-2">Invoice No. </label>
                                <div class="col-md-3">
                                    <input type="text" name="invoice_number" id="invoice_number"
                                        value="<?php echo $invoice_no2;?>" class="form-control"
                                        placeholder="Invoice No." required>
                                    <input type="hidden" name="invoice_no" id="invoice_no"
                                        value="<?php echo $custom_invoice_data->invoice_no;?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Order No.</label>
                                <div class="col-md-3">
                                    <input type="text" name="order_no" id="order_no"
                                        value="<?php echo $custom_invoice_data->order_no;?>" class="form-control"
                                        placeholder="Order No." required>
                                </div>
                                <label class="control-label col-md-2">Order Date</label>
                                <div class="col-md-3">
                                    <input type="date" name="order_date" id="order_date"
                                        value="<?php echo $custom_invoice_data->order_date;?>" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Reseller Name</label>
                                <div class="col-md-3">
                                    <select class="form-control b-none" name="reseller_name" id="reseller_name"
                                        required>
                                        <?php foreach($reseller_list as $list) { 
                                        if($custom_invoice_data->reseller_name == $list->reseller_name){ ?>
                                        <option value="<?php echo $custom_invoice_data->reseller_name;?>" selected>
                                            <?php echo $custom_invoice_data->reseller_name;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php }	} ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-2">Currency</label>
                                <div class="col-md-3">
                                    <select class="form-control b-none" id="currency" name="currency" placeholder="">
                                    <?php foreach($currency as $data) { 
                                        if($custom_invoice_data->currency == $data){ ?>
                                        <option value="<?php echo $custom_invoice_data->currency;?>" selected>
                                            <?php echo $custom_invoice_data->currency;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $data;?>"><?php echo $data;?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h1 class="box-title">Shipping Information</h1>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="Shipping_Custome_Name[]"
                                            value="<?php echo $custom_invoice_data->shipping_customer_name;?>"
                                            class="form-control" placeholder="Shipping Custome Name">
                                        <span></span>
                                    </div>
                                    <div class="col-md-1">
                                        <span type="button" class="btn btn-block btn-info" id="shipping_addrow"><i
                                                class="fa fa-plus"></i> Add</span>
                                    </div>
                                    <!-- <input type="hidden" name="shipping_customer_name" id="shipping_customer_name"
                                        value="Shipping Custome Name" class="form-control"> -->

                                </div>
                                <span id="Shipping"></span>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email Id</label>
                                    <div class="col-md-6">
                                        <input type="text" name="Shipping_Email_Id[]"
                                            value="<?php echo $custom_invoice_data->shipping_email_id;?>"
                                            class="form-control" placeholder="Shipping Email Id">
                                        <span></span>
                                    </div>
                                    <div class="col-md-1">
                                        <span type="button" class="btn btn-block btn-info" id="shipping_addrow1"><i
                                                class="fa fa-plus"></i> Add</span>
                                    </div>
                                    <!-- <input type="hidden" name="shipping_email_id" id="shipping_email_id"
                                        value="Shipping Email Id" class="form-control"> -->
                                </div>
                                <span id="Email"></span>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h1 class="box-title">Price Details</h1>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Unit Price</b>
                                        <input type="text" id="price" name="price"
                                            value="<?php echo $custom_invoice_data->price;?>" class="form-control"
                                            placeholder="Unit Price">
                                    </div>
                                    <div class="col-md-3">
                                        <b>Unit No.</b>
                                        <select class="form-control b-none" id="unit_no" name="unit_no">
                                            <option value="<?php echo $custom_invoice_data->unit_no;?>" selected>
                                                <?php echo $custom_invoice_data->unit_no;?></option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Discount Type</b>
                                        <select class="form-control b-none" name="discount_type" id="discount_type"
                                            required>
                                            <?php foreach($discount_type as $type) {
                                                // var_dump($type);die;
                                                if($custom_invoice_data->discount_type == $type){                                                		
                                            ?>
                                            <option value="<?php echo $custom_invoice_data->discount_type;?>" selected>
                                                <?php echo $custom_invoice_data->discount_type; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $type;?>"><?php echo $type; ?></option>
                                            <?php }	} ?>
                                        </select>
                                    </div>
                                    <?php if($custom_invoice_data->discount_type == "Percentage"){ ?>
                                    <div class="col-md-3 " id="discount">
                                        <b>Percentage (%)</b>
                                        <input type="text" id="dis_percentage" name="percentage"
                                            value="<?php echo $custom_invoice_data->discount_value;?>" onblur="reSum();"
                                            class="form-control" placeholder="Percentage">
                                    </div>
                                    <?php } else {?>
                                    <div class="col-md-3 hide" id="discount">
                                        <b>Percentage (%)</b>
                                        <input type="text" id="dis_percentage" name="percentage" value=""
                                            onblur="reSum();" class="form-control" placeholder="Percentage">
                                    </div>
                                    <?php } ?>
                                    <?php if($custom_invoice_data->discount_type == "Absolute"){ ?>
                                    <div class="col-md-3" id="absolute">
                                        <b>Discount (Absolute)</b>
                                        <input type="text" id="absolute_price" name="absolute_price"
                                            value="<?php echo $custom_invoice_data->discount_value;?>" onblur="reSum();"
                                            class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <?php }else{?>
                                    <div class="col-md-3 hide" id="absolute">
                                        <b>Discount (Absolute)</b>
                                        <input type="text" id="absolute_price" name="absolute_price" value=""
                                            onblur="reSum();" class="form-control" placeholder="Absolute Price">
                                    </div>
                                    <?php }  ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Total Amount </label>
                                    <div class="col-md-3">
                                        <input type="text" id="total_amount" name="total_amount"
                                            value="<?php echo $custom_invoice_data->total_amount;?>" onblur="reSum();"
                                            class="form-control" placeholder="Total Amount" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <!-- <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($custom_invoice_data)){echo $custom_invoice_data->id;}?>"> -->
                                <input type="submit" class="btn btn-primary pull-right" value="Update">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
var currency = document.getElementById('currency');
var my_div = document.getElementById('my_div');

currency.addEventListener('change', function() {
    if (this.value == "INR") {
        my_div.classList.remove('hide');
    } else {
        my_div.classList.add('hide');

    }
})

var discount_type = document.getElementById('discount_type');
var discount = document.getElementById('discount');
var absolute = document.getElementById('absolute');

discount_type.addEventListener('change', function() {
    console.log(discount_type.value);
    if (this.value == "Percentage") {
        discount.classList.remove('hide');
        absolute.classList.add('hide');
    } else if (this.value == "Absolute") {
        discount.classList.add('hide');
        absolute.classList.remove('hide');
    } else {
        discount.classList.remove('hide');
        absolute.classList.remove('hide');

    }
})


/* hide and shipping information */
$("input[name='s_address_billing']").click(function() {
    $('#displayDS').css('display', ($(this).val() === 'a') ? 'block' : 'none');
});

/* / .hide and shipping information */

function reSum() {
    var percentage, result, result1, mult, multiplication, abs, dis, discount;
    var price = parseFloat(document.getElementById("price").value);
    var unit_no = parseInt(document.getElementById("unit_no").value);
    var percentage = parseFloat(document.getElementById("dis_percentage").value);
    var absolute_price = parseFloat(document.getElementById("absolute_price").value);
    var discount_type = document.getElementById('discount_type');
    console.log(discount_type.value);
    multiplication = price * unit_no;

    Percentage = (percentage / 100).toFixed(2);
    // console.log(Percentage);
    mult = multiplication * Percentage;
    // multiplication = price * percentage;
    discount = multiplication - mult;
    result = price - absolute_price;

    if (discount_type.value == "Percentage") {
        document.getElementById("total_amount").value = discount;
    } else {
        // console.log(result);
        document.getElementById("total_amount").value = result;
    }
    /* calculate discount */
    // if (absolute_price) {
    //     discount = (absolute_price / multiplication * 100).toFixed(2);
    //     total_amt = multiplication - absolute_price;

    //     document.getElementById("absolute_price").value = absolute_price;
    //     document.getElementById("dis_percentage").value = discount;
    //     document.getElementById("total_amount").value = total_amt;
    // } else {
    //     absolute_val = (percentage / 100) * multiplication;
    //     total_amt = multiplication - absolute_val;
    //     document.getElementById("dis_percentage").value = percentage;
    //     document.getElementById("absolute_price").value = absolute_val;
    //     document.getElementById("total_amount").value = total_amt;
    // }

}


jQuery(function() {
    var counter = 1;
    var i = 1;
    jQuery('#shipping_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_' + counter +
            '"><label class="control-label col-md-2">Shipping User Name ' + counter +
            '</label> <div class="col-md-6"><input type="text" name="Shipping_Custome_Name[]" class="form-control"></div><div class="col-md-1"><center><a id="Rmv_' +
            counter + '" href="javascript:RemoveRow(' + counter +
            ');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Shipping').append(newRow);
        i++;
        console.log(newRow);
    });
});

jQuery(function() {
    var counter = 1;
    var i = 1;
    jQuery('#shipping_addrow1').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_' + counter +
            '"><label class="control-label col-md-2">Shipping Email Id ' + counter +
            '</label> <div class="col-md-6"><input type="text" name="Shipping_Email_Id[]" class="form-control"></div><div class="col-md-1"><center><a id="Rmv_' +
            counter + '" href="javascript:RemoveRow(' + counter +
            ');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Email').append(newRow);
        i++;
        console.log(newRow);
    });
});

function RemoveRow(rowID) {
    jQuery('#Row_' + rowID).remove();

}
</script>
<?php $this->load->view('admin/footer.php'); ?>