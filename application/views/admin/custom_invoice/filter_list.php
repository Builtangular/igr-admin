<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Custom Invoice List
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
                        <h3 class="box-title">Custom Invoice List</h3>
                        <form action="<?php echo  base_url('admin/custom_invoice/export'); ?>" method="post">
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
                                    <th class="header">Order Title</th>
                                    <th class="header">Invoice No.</th>
                                    <th class="header">Inward No.</th>
                                    <th class="header">Inward Date</th>
                                    <th class="header">Order No.</th>
                                    <th class="header">Order Date.</th>
                                    <th class="header">Reseller Name</th>
                                    <th class="header">Shipping Customer Name</th>
                                    <th class="header">Shipping Email Id</th>
                                    <th class="header">Currency</th>
                                    <th class="header">Discount Type</th>
                                    <th class="header">Discount Value</th>
                                    <th class="header">Total Amount</th>
                                </tr>
                            <tbody>
                                <?php
                                    if (isset($list_data) && !empty($list_data)) { //var_dump($list_data);die;
                                        foreach ($list_data as $key => $list) {
                                            $invoice_details = "SELECT * FROM tbl_custome_invoice where id = " . $list->id;                              
                                            $custom_invoice_details = $this->db->query($invoice_details);
                                            $invoice_data = $custom_invoice_details->row();
                                            if ($custom_invoice_details->num_rows() > 0) {
                                                $invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                                $invoice_title = $invoice_data->invoice_title;
                                            } else {
                                                $invoice_status = "";
                                                $invoice_title = "";
                                            }
                                    ?>
                                <tr>
                                    <td><?php echo $list->order_title; ?></td>
                                    <td><?php echo $list->invoice_no; ?></td>
                                    <td><?php echo $list->inward_no; ?></td>
                                    <td><?php echo $list->inward_date; ?></td>
                                    <td><?php echo $list->order_no; ?></td>
                                    <td><?php echo $list->order_date; ?></td>
                                    <td><?php echo $list->reseller_name; ?></td>
                                    <td><?php echo $list->shipping_customer_name; ?></td>
                                    <td><?php echo $list->shipping_email_id; ?></td>
                                    <td><?php echo $list->currency; ?></td>
                                    <td><?php echo $list->discount_type; ?></td>
                                    <td><?php echo $list->discount_value; ?></td>
                                    <td><?php echo $list->total_amount; ?></td>
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