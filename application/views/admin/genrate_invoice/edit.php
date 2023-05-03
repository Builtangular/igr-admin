<?php $this->load->view('admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

<?php $Currency = array('USD', 'INR', 'EUR', 'AED', 'SAR');?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Invoice Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Order Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/genrate_invoice/update" method="post"
                        class="form-horizontal">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Invoice Title<span
                                        class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" name="invoice_title" id="invoice_title"
                                        value="<?php echo $invoice_data->invoice_title;?>" class="form-control"
                                        placeholder="Invoice Title" required>
                                </div>
                                <?php if ($Role_id == 1) { ?>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Invoice No.<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" name="main_invoice_no" id="main_invoice_no"
                                            value="<?php echo $invoice_data->main_invoice_no;?>" class="form-control"
                                            placeholder=" Main Invoice No">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Order Date<span class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="date" name="order_date" id="order_date"
                                        value="<?php echo $invoice_data->order_date;?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Currency<span class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <select class="form-control b-none" id="currency" name="currency" placeholder="">

                                        <?php $i = 0; foreach($Currency as $currency) {
                                            if ($Currency[$i] == $invoice_data->currency){ ?>
                                        <option value="<?php echo $invoice_data->currency; ?>" Selected>
                                            <?php echo $invoice_data->currency; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $Currency[$i]; ?>"><?php echo $Currency[$i]; ?>
                                        </option>
                                        <?php } $i++; }  ?>

                                    </select>
                                </div>
                            </div>
                            <?php if($invoice_data->currency == "INR"){ ?>
                            <div class="form-group" id="my_div1">
                                <label class="control-label col-md-2">State <span class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="radio" name="state" id="maharastra" value="Maharastra"
                                        <?php echo ($invoice_data->state=="Maharastra")?'checked':'' ?> />
                                    Maharastra &nbsp;&nbsp;
                                    <input type="radio" name="state" id="other_state" value="Other State"
                                        <?php echo ($invoice_data->state=="Other State")?'checked':'' ?> /> Other
                                    State
                                </div>
                            </div>
                            <div class="form-group" id="my_div">
                                <label class="control-label col-md-2">Customer Gst No.<span
                                        class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" id="customer_gst_no" name="customer_gst_no"
                                        value="<?php echo $invoice_data->customer_gst_no;?>" class="form-control"
                                        placeholder="Customer Gst No">
                                </div>
                            </div>
                            <?php } else{ ?>
                            <div class="form-group hide" id="my_div1">
                                <label class="control-label col-md-2">State <span class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="radio" name="state" id="maharastra" value="Maharastra"
                                        <?php echo ($invoice_data->state=="Maharastra")?'checked':'' ?> />
                                    Maharastra &nbsp;&nbsp;
                                    <input type="radio" name="state" id="other_state" value="Other State"
                                        <?php echo ($invoice_data->state=="Other State")?'checked':'' ?> /> Other
                                    State
                                </div>
                            </div>
                            <div class="form-group hide" id="my_div">
                                <label class="control-label col-md-2">Customer Gst No.<span
                                        class="text-red">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" id="customer_gst_no" name="customer_gst_no"
                                        value="<?php echo $invoice_data->customer_gst_no;?>" class="form-control"
                                        placeholder="Customer Gst No">
                                </div>
                            </div>
                            <?php } ?>

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h1 class="box-title">Billing Information</h1>
                                </div>
                                <div class="form-group">
                                    <!-- <b>Customer Name<span class="text-red">*</span></b> -->
                                    <input type="hidden" id="query_name" name="query_name" class="form-control"
                                        placeholder="Query Name" required>
                                    <input type="hidden" id="invoice_no" name="invoice_no" class="form-control"
                                        placeholder="Invoice No" required>

                                    <div class="col-md-5">
                                        <b>Customer Name<span class="text-red">*</span></b>
                                        <input type="text" id="billing_customer_name" name="billing_customer_name"
                                            value="<?php echo $invoice_data->billing_customer_name;?>"
                                            class="form-control" placeholder="Custome Name" required>
                                    </div>
                                    <div class="col-md-5">
                                        <b>Company Name<span class="text-red">*</span></b>
                                        <input type="text" id="billing_company_name" name="billing_company_name"
                                            value="<?php echo $invoice_data->billing_company_name;?>"
                                            class="form-control" placeholder="Company Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <b>Phone No.<span class="text-red">*</span></b>
                                        <input type="text" id="billing_phone_no" name="billing_phone_no"
                                            value="<?php echo $invoice_data->billing_phone_no;?>" class="form-control"
                                            placeholder="Phone No" required>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Email Id<span class="text-red">*</span></b>
                                        <input type="text" id="billing_email_id" name="billing_email_id"
                                            value="<?php echo $invoice_data->billing_email_id;?>" class="form-control"
                                            placeholder="Email Id" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <b>Address<span class="text-red">*</span></b>
                                        <input type="text" id="billing_address1" name="billing_address1"
                                            value="<?php echo $invoice_data->billing_address1;?>" class="form-control"
                                            placeholder="Street Address Line1" required>
                                    </div>
                                    <div class="col-md-5">
                                        <b>Address<span class="text-red">*</span></b>
                                        <input type="text" id="billing_address2" name="billing_address2"
                                            value="<?php echo $invoice_data->billing_address2;?>" class="form-control"
                                            placeholder="Street Address Line2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <b>City<span class="text-red">*</span></b>
                                        <input type="text" id="billing_city" name="billing_city" class="form-control"
                                            value="<?php echo $invoice_data->billing_city;?>" placeholder="City"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <b>State<span class="text-red">*</span></b>
                                        <input type="text" id="billing_state" name="billing_state" class="form-control"
                                            value="<?php echo $invoice_data->billing_state;?>"
                                            placeholder="Billing State" required>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Zipcode<span class="text-red">*</span></b>
                                        <input type="text" id="billing_zipcode" name="billing_zipcode"
                                            value="<?php echo $invoice_data->billing_zipcode;?>" class="form-control"
                                            placeholder="Zipcode" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="radio" name="s_address_billing" id="s_address_billing"
                                            value="Yes" <?php echo ($invoice_data->s_address_billing=="Yes")?'checked':'' ?>/> &nbsp;&nbsp;
                                        <b>Shipping address same as billing address</b>
                                    </div>
                                </div> -->
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h1 class="box-title">Shipping Information</h1>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">User Name</label>
                                    <div class="col-md-5">
                                        <input type="text" name="Shipping_Custome_Name[]"
                                            value="<?php echo $invoice_data->shipping_customer_name;?>"
                                            class="form-control" placeholder="Shipping Custome Name">
                                        <span></span>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="shipping_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="shipping_customer_name" id="shipping_customer_name"
                                        value="Shipping Custome Name" class="form-control">
                                </div>
                                <span id="Shipping"></span>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email Id</label>
                                    <div class="col-md-5">
                                        <input type="text" name="Shipping_Email_Id[]"
                                            value="<?php echo $invoice_data->shipping_email_id;?>" class="form-control"
                                            placeholder="Shipping Email Id">
                                        <span></span>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="shipping_addrow1"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="shipping_email_id" id="shipping_email_id"
                                        value="Shipping Email Id" class="form-control">
                                </div>
                                <span id="Email"></span>
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h1 class="box-title">Price Details</h1>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <b>Unit Price<span class="text-red">*</span></b>
                                        <input type="text" id="unit_price" name="unit_price" class="form-control"
                                            value="<?php echo $invoice_data->unit_price;?>" placeholder="Unit Price">
                                    </div>
                                    <div class="col-md-3">
                                        <b>Unit No.<span class="text-red">*</span></b>
                                        <select class="form-control b-none" id="unit_no" name="unit_no">
                                            <option value="<?php echo $invoice_data->unit_no;?>" selected>
                                                <?php echo $invoice_data->unit_no;?></option>
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
                                        <b>Discount (%)<span class="text-red">*</span></b>
                                        <input type="text" id="dis_percentage" name="percentage" onblur="reSum();"
                                            value="<?php echo $invoice_data->discount;?>" class="form-control"
                                            placeholder="Percentage">
                                    </div>
                                    <div class="col-md-3">
                                        <b>Discount (Absolute)<span class="text-red">*</span></b>
                                        <input type="text" id="absolute_price" name="absolute_price" onblur="reSum();"
                                            value="<?php echo $invoice_data->absolute_price;?>" class="form-control"
                                            placeholder="Absolute Price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Total Amount <span class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" id="total_amount" name="total_amount" onblur="reSum();"
                                            class="form-control" value="<?php echo $invoice_data->total_amount;?>"
                                            placeholder="Total Amount" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($invoice_data)){echo $invoice_data->id;}?>">
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
var my_div1 = document.getElementById('my_div1');
currency.addEventListener('change', function() {
    console.log(this.value);
    if (this.value == "INR") {
        my_div.classList.remove('hide');
        my_div1.classList.remove('hide');
    } else {
        my_div.classList.add('hide');
        my_div1.classList.add('hide');

    }
})

/* hide and shipping information */
$("input[name='s_address_billing']").click(function() {
    $('#displayDS').css('display', ($(this).val() === 'a') ? 'block' : 'none');
});

/* / .hide and shipping information */

function reSum() {
    var percentage, result, result1, mult, multiplication, abs, dis, discount;
    var unit_price = parseFloat(document.getElementById("unit_price").value);
    var unit_no = parseInt(document.getElementById("unit_no").value);
    var percentage = parseFloat(document.getElementById("dis_percentage").value);
    var absolute_price = parseFloat(document.getElementById("absolute_price").value);

    // console.log(absolute_price); 
    multiplication = unit_price * unit_no;
    /* calculate discount */
    if (absolute_price) {
        discount = (absolute_price / multiplication * 100).toFixed(2);
        total_amt = multiplication - absolute_price;
        document.getElementById("absolute_price").value = absolute_price;
        document.getElementById("dis_percentage").value = discount;
        document.getElementById("total_amount").value = total_amt;
    } else if (percentage) {
        absolute_val = (percentage / 100) * multiplication;
        total_amt = multiplication - absolute_val;
        document.getElementById("dis_percentage").value = percentage;
        document.getElementById("absolute_price").value = absolute_val;
        document.getElementById("total_amount").value = total_amt;
    }

}

jQuery(function() {
    var counter = 1;
    var i = 1;
    jQuery('#shipping_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_' + counter +
            '"><label class="control-label col-md-2">Shipping Custome Name ' + counter +
            '</label> <div class="col-md-5"><input type="text" name="Shipping_Custome_Name[]" class="form-control"></div><div class="col-md-1"><center><a id="Rmv_' +
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
            '</label> <div class="col-md-5"><input type="text" name="Shipping_Email_Id[]" class="form-control"></div><div class="col-md-1"><center><a id="Rmv_' +
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