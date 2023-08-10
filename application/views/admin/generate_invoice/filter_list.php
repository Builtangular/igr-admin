<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice List
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Invoice List</h3>
                        <form action="<?php echo  base_url('admin/generate_invoice/export'); ?>" method="post">
                            <input type="submit" value="Export Excel" class="btn btn-primary pull-right"></td>
                            <input type="hidden" name="from_date" class="form-control"
                                value="<?php echo $from_date; ?>">
                            <input type="hidden" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
                        </form>
                    </div>
                    <!-- <form method="post" action="<?php echo form_open_multipart('admin/spreadsheet/export',array('name' => 'spreadsheet'));?>"> -->
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th class="header">Query Id</th>
                                    <th class="header">Query Name</th>
                                    <th class="header">Client Email</th>
                                    <th class="header">Company</th>
                                    <th class="header">Invoice Title</th>
                                    <th class="header">Invoice No.</th>
                                    <th class="header">Lead Date</th>
                                    <th class="header">Invoice Type</th>
                                    <th class="header">Inward No.</th>
                                    <th class="header">Payment Mode</th>
                                    <th class="header">Inward Date</th>
                                    <th class="header">Order Date</th>
                                    <th class="header">Order No.</th>
                                    <th class="header">Billing Customer Name</th>
                                    <th class="header">Billing Company Name</th>
                                    <th class="header">Billing Phone No.</th>
                                    <th class="header">Billing Email Id</th>
                                    <th class="header">Billing Address</th>
                                    <th class="header">Billing City</th>
                                    <th class="header">Billing State</th>
                                    <th class="header">Shipping Customer Name</th>
                                    <th class="header">Shipping Email Id</th>
                                    <th class="header">Unit Price</th>
                                    <th class="header">Unit No.</th>
                                    <th class="header">Percent_Discount</th>
                                    <th class="header">Total Amount</th>
                                 
                                </tr>
                            <tbody>
                                <?php
                                    if (isset($list_data) && !empty($list_data)) { //var_dump($list_data);die;
                                        foreach ($list_data as $key => $list) {
                                /* Proforma invoice details */
                                // $invoice_type = $list->invoice_type;
                                /* Main invoice details */
                                $main_invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $list->query_id. " AND invoice_type='Main'";
                                $query_main_invoice_details = $this->db->query($main_invoice_details);
                                $main_invoice_data = $query_main_invoice_details->row();
                                // var_dump($main_invoice_data);die;
                                if ($query_main_invoice_details->row() > 0) {
                                    $main_invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    $main_invoice_title = $main_invoice_data->invoice_title;
                                    $main_inward_no = $main_invoice_data->inward_no;
                                    $main_invoice_type = $main_invoice_data->invoice_type;
                                    $main_payment_mode= $main_invoice_data->payment_mode;
                                    $main_inward_date= $main_invoice_data->inward_date;
                                    $main_invoice_no= $main_invoice_data->main_invoice_no;
                                    $main_inward_date= $main_invoice_data->inward_date;
                                    $main_order_date= $main_invoice_data->order_date;
                                    $main_order_no= $main_invoice_data->order_no;
                                    $billing_customer_name= $main_invoice_data->billing_customer_name;
                                    $billing_company_name= $main_invoice_data->billing_company_name;
                                    $billing_phone_no= $main_invoice_data->billing_phone_no;
                                    $billing_email_id= $main_invoice_data->billing_email_id;
                                    $billing_address1= $main_invoice_data->billing_address1;
                                    $billing_city= $main_invoice_data->billing_city;
                                    $billing_state= $main_invoice_data->billing_state;
                                    $shipping_customer_name= $main_invoice_data->shipping_customer_name;
                                    $shipping_email_id= $main_invoice_data->shipping_email_id;
                                    $unit_price= $main_invoice_data->unit_price;
                                    $unit_no= $main_invoice_data->unit_no;
                                    $percent_discount= $main_invoice_data->percent_discount;
                                    $total_amount= $main_invoice_data->total_amount;
                                 
                                } else {
                                    $main_invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    $main_invoice_title = "";
                                }
                                /* /.Main invoice details */
                                ?>
                                <tr>
                                    <td><?php echo $list->query_id; ?></td>
                                    <td><?php echo $list->query_name; ?></td>
                                    <td><?php echo $list->client_email; ?></td>
                                    <td><?php echo $list->company_name; ?></td>
                                    <td><?php echo $main_invoice_title; ?></td>
                                    <td><?php echo $main_invoice_no; ?></td>
                                    <td><?php echo $list->lead_date; ?></td>
                                    <td><?php echo $main_invoice_type; ?></td>
                                    <td><?php echo $main_inward_no; ?></td>
                                    <td><?php echo $main_payment_mode; ?></td>
                                    <td><?php echo $main_inward_date; ?></td>
                                    <td><?php echo $main_order_date; ?></td>
                                    <td><?php echo $main_order_no; ?></td>
                                    <td><?php echo $billing_customer_name; ?></td>
                                    <td><?php echo $billing_company_name; ?></td>
                                    <td><?php echo $billing_phone_no; ?></td>
                                    <td><?php echo $billing_email_id; ?></td>
                                    <td><?php echo $billing_address1; ?></td>
                                    <td><?php echo $billing_city; ?></td>
                                    <td><?php echo $billing_zipcode; ?></td>
                                    <td><?php echo $shipping_email_id; ?></td>
                                    <td><?php echo $unit_price; ?></td>
                                    <td><?php echo $unit_no; ?></td>
                                    <td><?php echo $total_amount; ?></td>
                                   
                                </tr>
                                <?php
                                        }
                                    } else {
                                        ?>
                                <tr>
                                    <td colspan="5">There is no employee.</td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                        <!-- <?php echo form_open_multipart('admin/spreadsheet/export',array('name' => 'spreadsheet')); ?> -->



                        <form action="<?php echo  base_url('admin/spreadsheet/export'); ?>" method="post">
                            <!-- <a href="<?php echo base_url(); ?>admin/spreadsheet/filter" > -->
                            <!-- <tr>
                                <td colspan="5" align="center">
                                <input type="submit" value="Export"></td>
                            </tr> -->
                            <!-- <input type="hidden" name="list_data" class="form-control" value="<?php echo $list_data->id;?>"> -->
                            <input type="hidden" name="from_date" class="form-control"
                                value="<?php echo $from_date; ?>">
                            <input type="hidden" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright © 2022 <a href="#">Infinium</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->

<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demo.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $('.sidebar-menu').tree()
})
</script>

<script>
$(function() {
    // $('#rddata').DataTable()
    $('#rddata').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    })
})
</script>
</body>

</html>