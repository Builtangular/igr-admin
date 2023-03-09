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
                                            placeholder="" onblur="reSum();" >
                                            <option value="" selected>Select</option>
                                            <option value="Sale">Sale</option>
                                            <option value="Reject">Reject</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="price" id="price" onblur="reSum();" class="form-control hide"
                                            placeholder="Price">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="discount" id="discount" onblur="reSum();" class="form-control hide"
                                            placeholder="Discount">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="absolute_price" onblur="reSum();" id="absolute_price"
                                            class="form-control hide" placeholder="Absolute Price">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="selling_price" onblur="reSum();" id="selling_price"
                                            class="form-control hide" placeholder="Selling Price">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="reason" name="reason" class="form-control hide"
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
var query_status = document.getElementById('query_status');
var price = document.getElementById('price');
var discount = document.getElementById('discount');
var selling_price = document.getElementById('selling_price');
var absolute_price = document.getElementById('absolute_price');
var reason = document.getElementById('reason');
console.log(query_status);
query_status.addEventListener('change', function() {
    if (this.value == "Sale") {
        price.classList.remove('hide');
        discount.classList.remove('hide');
        absolute_price.classList.remove('hide');
        selling_price.classList.remove('hide');
        reason.classList.add('hide');
    } else {
        reason.classList.remove('hide');
        price.classList.add('hide');
        discount.classList.add('hide');
        absolute_price.classList.add('hide');
        selling_price.classList.add('hide');
    }
})

$(document).ready(function(){

$(".show").click(function() {
    $(this).parents(".product").removeClass("hide_description");
});
$(".hide").click(function() {
    $(this).parents(".product").addClass("hide_description");
});

});

// $(document).on("change keyup blur", "#discount", function() {
//     var main = $('#price').val();
//     var disc = $('#discount').val();
//     var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
//     var mult = main * dec; // gives the value for subtract from main value
//     var discount = main - mult;
//     $('#selling_price').val(discount);
// });
// $(document).on("change keyup blur", "#discount", "#absolute", function() {
//     var main = $('#price').val();
//     var disc = $('#discount').val();
//     var abs = $('#absolute').val();
//     var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
//     var mult = main * dec; // gives the value for subtract from main value
//     var discount = main - mult;
//     var abso = main - abs;
//     $('#selling_price').val(abso);
//     $('#selling_price').val(discount);
// });
function reSum()
{
    var discount,result,mult,dis;
    var price = parseInt(document.getElementById("price").value);
    var discount = parseInt(document.getElementById("discount").value);
    var absolute_price = parseInt(document.getElementById("absolute_price").value);

     /* calculate discount*/
    discount = (discount / 100).toFixed(2);
    mult = price * discount; 
    dis = price - mult;
    /* substration of price and absolute value */
    result = price - absolute_price;
   
    if (result) {
        document.getElementById("selling_price").value = result;
    }else{
        document.getElementById("selling_price").value = dis;
    }
   
}
</script>

<?php $this->load->view('admin/footer.php'); ?>