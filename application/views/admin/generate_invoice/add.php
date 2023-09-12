    <?php $this->load->view('admin/header.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Invoice Details
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
                        <form autocomplete="off"
                            action="<?php echo base_url(); ?>admin/generate_invoice/insert_invoice/<?php echo $id;?>"
                            method="post" class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Invoice Title <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" name="invoice_title" id="invoice_title" class="form-control"
                                            placeholder="Invoice Title" required>
                                    </div>
                                    <label class="control-label col-md-2">Order Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" name="order_date" id="order_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                               <!--  <div class="form-group">
                                    <label class="control-label col-md-2">Order Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" name="order_date" id="order_date" class="form-control"
                                            required>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-2">Order No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" name="order_no" id="order_no" class="form-control"
                                            placeholder="Order No" required>
                                    </div>
                               <!--  </div>
                                <div class="form-group"> -->
                                    <label class="control-label col-md-2">Currency <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" id="currency" name="currency"
                                            placeholder="">
                                            <option value="" selected>Select Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="INR">INR</option>
                                            <option value="EUR">EUR</option>
                                            <option value="AED">AED</option>
                                            <option value="SAR">SAR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group hide" id="my_div1">
                                    <label class="control-label col-md-2">State <span class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="radio" name="state" id="maharastra" value="Maharastra" required/>
                                        Maharastra &nbsp;&nbsp;
                                        <input type="radio" name="state" id="other_state" value="Other State" /> Other
                                        State
                                    </div>
                                <!-- </div>
                                <div class="form-group hide" id="my_div"> -->
                                    <label class="control-label col-md-2">Customer Gst No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="customer_gst_no" name="customer_gst_no"
                                            class="form-control" placeholder="Customer Gst No" >
                                    </div>
                                </div>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h1 class="box-title">Billing Information</h1>
                                    </div>
                                    <div class="form-group">
                                        <!-- <b>Customer Name<span class="text-red">*</span></b> -->
                                        <input type="hidden" id="invoice_type" name="invoice_type"
                                            value="<?php echo $invoice_type; ?>" class="form-control">
                                        <div class="col-md-6">
                                            <b>Customer Name <span class="text-red">*</span></b>
                                            <input type="text" id="billing_customer_name" name="billing_customer_name"
                                                class="form-control" placeholder="Customer Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Company Name <span class="text-red">*</span></b>
                                            <input type="text" id="billing_company_name" name="billing_company_name"
                                                class="form-control" placeholder="Company Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <b>Phone No. <span class="text-red">*</span></b>
                                            <input type="text" id="billing_phone_no" name="billing_phone_no"
                                                class="form-control" placeholder="Phone Number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Email Id <span class="text-red">*</span></b>
                                            <input type="text" id="billing_email_id" name="billing_email_id"
                                                class="form-control" placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <b>Address Line 1<span class="text-red">*</span></b>
                                            <input type="text" id="billing_address1" name="billing_address1"
                                                class="form-control" placeholder="Street Address Line 1" required>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Address Line 2</b>
                                            <input type="text" id="billing_address2" name="billing_address2"
                                                class="form-control" placeholder="Street Address Line 2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <b>City<span class="text-red">*</span></b>
                                            <input type="text" id="billing_city" name="billing_city"
                                                class="form-control" placeholder="City">
                                        </div>
                                        <div class="col-md-4">
                                            <b>State<span class="text-red">*</span></b>
                                            <input type="text" id="billing_state" name="billing_state"
                                                class="form-control" placeholder="State">
                                        </div>
                                        <div class="col-md-4">
                                            <b>Zipcode<span class="text-red">*</span></b>
                                            <input type="text" id="billing_zipcode" name="billing_zipcode"
                                                class="form-control" placeholder="Zipcode">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="radio" name="s_address_billing" id="s_address_billing"
                                                value="Yes" /> &nbsp;&nbsp;
                                            <b>Shipping address same as billing address</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-primary" id="displayDS">
                                    <div class="box-header with-border">
                                        <h1 class="box-title">Shipping Information</h1>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">User Name</label>
                                        <div class="col-md-5">
                                            <input type="text" name="Shipping_Custome_Name[]" class="form-control"
                                                placeholder="Shipping Customer Name">
                                        </div>
                                        <div class="col-md-1">
                                            <span type="button" class="btn btn-block btn-info"
                                                    id="shipping_addrow"><i class="fa fa-plus"></i> Add</span>
                                        </div>
                                        <input type="hidden" name="shipping_customer_name" id="shipping_customer_name"
                                            value="Shipping Customer Name" class="form-control">
                                    </div>
                                    <span id="Shipping"></span>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Email Id</label>
                                        <div class="col-md-5">
                                            <input type="text" name="Shipping_Email_Id[]" class="form-control"
                                                placeholder="Shipping Email Id">
                                        </div>
                                        <div class="col-md-1">
                                            <span type="button" class="btn btn-block btn-info"
                                                    id="shipping_addrow1"><i class="fa fa-plus"></i> Add</span>
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
                                        <div class="col-md-2">
                                            <b>Order No. <span class="text-red">*</span></b>
                                            <input type="text" id="order_no" name="order_no[]" class="form-control"
                                                placeholder="Order No.">
                                        </div>
                                        <div class="col-md-6">
                                            <b>Report Title <span class="text-red">*</span></b>
                                            <input type="text" id="report_title" name="report_title[]"
                                                class="form-control" placeholder="Report Title">
                                        </div>
                                        <div class="col-md-2">
                                            <b>Unit Price <span class="text-red">*</span></b>
                                            <input type="text" id="unit_price" name="unit_price" class="form-control"
                                                placeholder="Unit Price">
                                        </div>
                                        <div class="col-md-2">
                                            <b>Unit No.<span class="text-red">*</span></b>
                                            <select class="form-control b-none" id="unit_no" name="unit_no">
                                                <option value="1" selected>1</option>
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
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <b>Discount (%) <span class="text-red">*</span></b>
                                            <input type="text" id="dis_percentage" name="percentage" onblur="reSum();"
                                                class="form-control" placeholder="Percentage">
                                        </div>
                                        <div class="col-md-3">
                                            <b>Discount (Absolute) <span class="text-red">*</span></b>
                                            <input type="text" id="absolute_price" name="absolute_price"
                                                onblur="reSum();" class="form-control" placeholder="Absolute Price">
                                        </div>
                                        <div class="col-md-4">
                                            <b>Total Amount <span class="text-red">*</span></b>
                                            <input type="text" id="total_amount" name="total_amount" onblur="reSum();"
                                                class="form-control" placeholder="Total Amount" required>
                                        </div>
                                        <div class="col-md-2">
                                            <b>Add New </b>
                                            <span type="button" class="btn btn-block btn-info" id="invoice_titles">
                                                <i class="fa fa-plus"></i> Add
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="id" class="form-control" id="id"
                                        value="<?php if(!empty($followup_record)){echo $followup_record->id;}?>">
                                    <input type="submit" class="btn btn-primary pull-right" value="Submit">
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
var my_div = document.getElementById('my_div1');

currency.addEventListener('change', function() {
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

    // console.log(percentage); 
    multiplication = unit_price * unit_no;
    /* calculate discount */
    if (absolute_price) {
        discount = (absolute_price / multiplication * 100).toFixed(2);
        total_amt = multiplication - absolute_price;
        console.log(discount);
        document.getElementById("absolute_price").value = absolute_price;
        document.getElementById("dis_percentage").value = discount;
        document.getElementById("total_amount").value = total_amt;
    } else {
        absolute_val = (percentage / 100) * multiplication;
        console.log(absolute_val);
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
            '"><label class="control-label col-md-2">User Name ' + counter +
            '</label> <div class="col-md-5"><input type="text" name="Shipping_Custome_Name[]" class="form-control" placeholder="Shipping Customer Name"></div><div class="col-md-1"><center><a id="Rmv_' +
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
            '"><label class="control-label col-md-2">Email Id ' + counter +
            '</label> <div class="col-md-5"><input type="text" name="Shipping_Email_Id[]" class="form-control" placeholder="Shipping Email Id"></div><div class="col-md-1"><center><a id="Rmv_' +
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