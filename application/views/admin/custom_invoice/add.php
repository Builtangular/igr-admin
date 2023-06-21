    <?php $this->load->view('admin/header.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Custome Details
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
                        <form action="<?php echo base_url(); ?>admin/custom_invoice/insert" method="post"
                            class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Invoice Title<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Invoice Title" required>
                                    </div>
                                    <label class="control-label col-md-2">Invoice No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                                            placeholder="Invoice No." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Order No.<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="text" name="order_no" id="order_no" class="form-control"
                                            placeholder="Order No." required>
                                    </div>
                                    <label class="control-label col-md-2">Order Date<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <input type="date" name="order_date" id="order_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reseller Name<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <select class="form-control b-none" name="reseller_name" id="reseller_name"
                                            required>
                                            <option value="" selected>Select Source Type</option>
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
                                    <label class="control-label col-md-2">Currency<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-3">
                                        <select class="form-control b-none" id="currency" name="currency"
                                            placeholder="">
                                            <option value="" selected>Select Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                            <option value="AED">AED</option>
                                            <option value="SAR">SAR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h1 class="box-title">Client Information</h1>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">User Name</label>
                                        <div class="col-md-5">
                                            <input type="text" name="Shipping_Custome_Name[]" class="form-control"
                                                placeholder="Shipping Custome Name">
                                            <span></span>
                                        </div>
                                        <div class="col-md-1">
                                            <center><span type="button" class="btn btn-block btn-info"
                                                    id="shipping_addrow"><i class="fa fa-plus"></i> Add</span>
                                            </center>
                                        </div>
                                        <input type="hidden" name="shipping_customer_name" id="shipping_customer_name"
                                            value="Shipping Custome Name" class="form-control">
                                    </div>
                                    <span id="Shipping"></span>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Email Id</label>
                                        <div class="col-md-5">
                                            <input type="text" name="Shipping_Email_Id[]" class="form-control"
                                                placeholder="Shipping Email Id">
                                            <span></span>
                                        </div>
                                        <div class="col-md-1">
                                            <center><span type="button" class="btn btn-block btn-info"
                                                    id="shipping_addrow1"><i class="fa fa-plus"></i> Add</span>
                                            </center>
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
                                            <input type="text" id="price" name="price" class="form-control"
                                                placeholder="Unit Price">
                                        </div>
                                        <div class="col-md-3">
                                            <b>Unit No.<span class="text-red">*</span></b>
                                            <select class="form-control b-none" id="unit_no" name="unit_no">
                                                <option value="" selected>Select Unit No.</option>
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
                                            <b>Discount Type<span class="text-red">*</span></b>
                                            <select class="form-control b-none" name="discount_type" id="discount_type"
                                                required>
                                                <option value="" selected>Select Discount Type</option>
                                                <option value="Percentage">Percentage</option>
                                                <option value="Absolute">Absolute</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 hide" id="discount">
                                            <b>Percentage (%)<span class="text-red">*</span></b>
                                            <input type="text" id="dis_percentage" name="percentage" onblur="reSum();"
                                                class="form-control" placeholder="Percentage">
                                        </div>
                                        <div class="col-md-3 hide" id="absolute">
                                            <b>Discount (Absolute)<span class="text-red">*</span></b>
                                            <input type="text" id="absolute_price" name="absolute_price"
                                                onblur="reSum();" class="form-control" placeholder="Absolute Price">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2">Total Amount <span class="text-red">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="total_amount" name="total_amount" onblur="reSum();"
                                                class="form-control" placeholder="Total Amount" required>
                                            <span class="help-block margin" id="txtHint"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
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
    if (this.value == "Percentage") {
        discount.classList.remove('hide');
        absolute.classList.add('hide');
    } else if (this.value == "Absolute") {
        discount.classList.add('hide');
        absolute.classList.remove('hide');
    } else {
        discount.classList.add('hide');
        absolute.classList.add('hide');

    }
})

function reSum() {
    var percentage, result, result1, mult, multiplication, abs, dis, discount;
    var price = parseFloat(document.getElementById("price").value);
    var unit_no = parseInt(document.getElementById("unit_no").value);
    var percentage = parseFloat(document.getElementById("dis_percentage").value);
    var absolute_price = parseFloat(document.getElementById("absolute_price").value);
    var total_amt = parseFloat(document.getElementById("total_amount").value);

    // console.log(price);
    multiplication = price * unit_no;
    /* calculate discount */
    percentage = (percentage / 100).toFixed(2);
    mult = multiplication * percentage;
    // multiplication = price * percentage;
    discount = multiplication - mult;
    // console.log(discount);
    /* substration of price and absolute value */
    result = multiplication - absolute_price;
    // console.log(result); 
    if (result) {
        document.getElementById("total_amount").value = result;
    } else {
        document.getElementById("total_amount").value = discount;
    }
}
    // if(percentage){
    //     percentage = (percentage / 100).toFixed(2);
    //     multiplication = price * percentage;
    //     total_amt = price - multiplication;
    //     // document.getElementById("dis_percentage").value = discount;
    //     document.getElementById("total_amount").value = total_amt;
    // } else {
    //     total_amt = multiplication - absolute_price;
    //     document.getElementById("dis_percentage").value = percentage;
    //     document.getElementById("dis_percentage").value = percentage;
    //     document.getElementById("total_amount").value = total_amt;
    // } 
    // console.log(discount);
    // if (absolute_price) {
    //     discount = (absolute_price / multiplication * 100).toFixed(2);
    //     total_amt = multiplication - absolute_price;

    //     document.getElementById("absolute_price").value = absolute_price;
    //     document.getElementById("dis_percentage").value = discount;
    //     document.getElementById("total_amount").value = total_amt;
    // } else {
    //     absolute_val = (percentage / 100) * multiplication;
    //     // console.log(absolute_val);
    //     total_amt = multiplication - absolute_val;
    //     document.getElementById("dis_percentage").value = percentage;
    //     document.getElementById("absolute_price").value = absolute_val;
    //     document.getElementById("total_amount").value = total_amt;
    // }

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