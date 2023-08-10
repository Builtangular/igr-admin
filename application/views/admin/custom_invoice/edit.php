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
                    <form
                        action="<?php echo base_url(); ?>admin/custom_invoice/update/<?php echo $custom_invoice_data->id;?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Invoice Title</label>
                                <div class="col-md-3">
                                    <input type="text" name="order_title" id="order_title"
                                        value="<?php echo $custom_invoice_data->order_title;?>" class="form-control"
                                        placeholder="Invoice Title" required>
                                </div>
                                <?php $invoice = explode("#", $custom_invoice_data->invoice_no);
                                    $invoiceno = $invoice[0];
                                    $invoice_no1 = $invoice[1];
                                ?>
                                <label class="control-label col-md-2">Invoice No. </label>
                                <div class="col-md-3">
                                    <input type="text" name="invoice_no" id="invoice_no"
                                        value="<?php echo $invoice_no1;?>" class="form-control"
                                        placeholder="Invoice No." required>                                    
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
                            <div class="form-group">
                                <label class="control-label col-md-2">Inward No.</label>
                                <div class="col-md-3">
                                    <input type="text" name="inward_no" id="inward_no"
                                        value="<?php echo $custom_invoice_data->inward_no;?>" class="form-control"
                                        placeholder="Order No." required>
                                </div>
                                <label class="control-label col-md-2">Inward Date</label>
                                <div class="col-md-3">
                                    <input type="date" name="inward_date" id="inward_date"
                                        value="<?php echo $custom_invoice_data->inward_date;?>" class="form-control"
                                        required>
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
                                    <?php foreach($custom_invoice_details as $data){ 
                                   $title[]= $data['title'];
                                   $price[]= $data['price'];
                                   $unit_no[]= $data['unit_no'];
                                   $total = $data['price'] * $data['unit_no'];
                                   $total1+= $total;
                                    // var_dump($total1);?>
                                    <div class="col-md-4">
                                        <b>Invoice Title<span class="text-red">*</span></b>
                                        <input type="text" name="title[]" id="title"
                                            value="<?php echo $title[]= $data['title']; ?>" class="form-control"
                                            placeholder="Invoice Title" required>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Unit Price</b>
                                        <input type="text" id="price" name="price[]"
                                            value="<?php echo $price[]= $data['price']; ?>" class="form-control"
                                            onblur="reSum();" placeholder="Unit Price" data-tag-id="">
                                    </div>
                                    <div class="col-md-3">
                                        <b>Unit No.<span class="text-red">*</span></b>
                                        <input type="text" id="unit_no" name="unit_no[]"
                                            value="<?php echo $unit_no[]= $data['unit_no']; ?>" class="form-control"
                                            onblur="reSum();" placeholder="Unit No.">
                                        <input type="hidden" id="invoice_id" name="invoice_id[]"
                                            value="<?php echo $data['id']; ?>" class="form-control">
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-2">
                                        <b>Add<span class="text-red">*</span></b>
                                        <span type="button" class="btn btn-block btn-info" id="invoice_titles"><i
                                                class="fa fa-plus"></i> Add</span>
                                    </div>
                                </div>
                               <!--  <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $custom_invoice_data1->id;?>"
                                class="form-control"> -->
                                <span id="Titles"></span>
                                <div class="form-group">
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
    // console.log(discount_type.value);
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

// function reSum() {
//     var percentage, result, result1, mult, multiplication, abs, dis, discount;
//     var price = parseFloat(document.getElementById("price").value);
//     var unit_no = parseInt(document.getElementById("unit_no").value);
//     var percentage = parseFloat(document.getElementById("dis_percentage").value);
//     var absolute_price = parseFloat(document.getElementById("absolute_price").value);
//     var discount_type = document.getElementById('discount_type');
//     console.log(discount_type.value);
//     multiplication = price * unit_no;

//     Percentage = (percentage / 100).toFixed(2);
//     // console.log(Percentage);
//     mult = multiplication * Percentage;
//     // multiplication = price * percentage;
//     discount = multiplication - mult;
//     result = price - absolute_price;

//     if (discount_type.value == "Percentage") {
//         document.getElementById("total_amount").value = discount;
//     } else {
//         // console.log(result);
//         document.getElementById("total_amount").value = result;
//     }

// }


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

jQuery(function() {
    var counter = 1;
    var i = 1;
    jQuery('#invoice_titles').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery('<div class="form-group" id="Row_' + counter +
            '"><div class="col-md-4"><b>Invoice Title ' +
            counter +
            '<span class="text-red">*</span></b><input type="text" name="title[]" id="title" class="form-control" placeholder="Invoice Title" required></div><div class="col-md-3"><b>Unit Price ' +
            counter +
            '<span class="text-red">*</span></b><input type="text" id="price" name="price[]" class="form-control" data-tag-id="" placeholder="Unit Price"></div><div class="col-md-3"><b>Unit No.' +
            counter +
            '<span class="text-red">*</span></b><input type="text" id="unit_no" name="unit_no[]" onblur="reSum();" class="form-control" placeholder="Unit No."> <input type="hidden" id="invoice_id" name="invoice_id[]" class="form-control"> </div> <div class="col-md-2"><b>Close<span class="text-red">*</span></b><a id="Rmv_' +
            counter + '" href="javascript:RemoveRow(' + counter +
            ');"><span type="button" class="btn btn-block btn-danger" id="invoice_titles"><i class="fa fa-close"></i> Close</span></a></div>   </div>     '
        );

        jQuery('#Titles').append(newRow);
        i++;
        console.log(newRow);
    });
});





function reSum() {
    var tags = [];
    var unit = [];
    var sum = 0;
    var total_price = [];
    
    var total_amt = [];

    // var unit_no = parseFloat(document.getElementById("unit_no").value);
    // var price = parseFloat(document.getElementById("price").value);
    var unit_no = document.getElementById("unit_no");
    var price = document.getElementById("price");
    $("[id='unit_no']").each(function() {
        unit.push($(this).val())
    });
    // console.log(unit);
    $("[id='price']").each(function() {
        total_price.push($(this).val())
    });
    // console.log(total_price);
    $('[data-tag-id]').each(function() {
        // $total_amt = price * unit_no;
        tags.push($(this).val())
    })
    // console.log(tags);
    n = tags.length;
    // console.log(n);

    for (var i = 0; i < n; i++) {
        mult = tags[i] * unit[i];
        //   sum = (sum+parseInt(tags[i]));
        sum = (sum + parseInt(mult));
    }
    console.log(sum);
    var discount, multiplication;
    var percentage = parseFloat(document.getElementById("dis_percentage").value);
    var absolute_price = parseFloat(document.getElementById("absolute_price").value);
    percentage = (percentage / 100).toFixed(2);
    multiplication = sum * percentage;
    discount = sum - multiplication;

    result = sum - absolute_price;
    // console.log(result);

    if (result) {
        document.getElementById("total_amount").value = result;
    } else {
        document.getElementById("total_amount").value = discount;
    }

}
</script>
<?php $this->load->view('admin/footer.php'); ?>