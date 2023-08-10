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
                    <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Query Name</th>
                                    <th>Client Email</th>
                                    <th>Company</th>
                                    <th>Invoice Title</th>
                                    <th>Lead Date</th>
                                    <?php if($Role_id == 1) { ?>
                                    <th>Inward No.</th>
                                    <th>Payment Mode</th>
                                    <th>Inward Date</th>
                                    <th>Main Invoice</th>
                                    <?php } ?>
                                    <th>Proforma Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_details as $data){ 
                                $scope_name = $data->scope_name.' '.$data->report_name;
                                /* Proforma invoice details */
                                $proforma_invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $data->id. " AND invoice_type='Proforma'";
                                $query_proforma_invoice_details = $this->db->query($proforma_invoice_details);
                                $proforma_invoice_data = $query_proforma_invoice_details->row();
                                if ($query_proforma_invoice_details->num_rows() > 0) {
                                    $proforma_invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    $proforma_invoice_title = $proforma_invoice_data->invoice_title;
                                } else {
                                    $proforma_invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    $proforma_invoice_title = "";
                                }
                                 /* ./ Proforma invoice details */

                                /* Main invoice details */
                                $main_invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $data->id. " AND invoice_type='Main'";
                                $query_main_invoice_details = $this->db->query($main_invoice_details);
                                $main_invoice_data = $query_main_invoice_details->row();
                                if ($query_main_invoice_details->num_rows() > 0) {
                                    $main_invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    $main_invoice_title = $main_invoice_data->invoice_title;
                                    $main_inward_no = $main_invoice_data->inward_no;
                                    $main_inward_date = $main_invoice_data->inward_date;
                                    $main_invoice_payment = $main_invoice_data->payment_mode;
                                } else {
                                    $main_invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    $main_invoice_title = "";
                                }
                                 /* ./ Main invoice details */
                                ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $data->query_code; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->client_email; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <?php if($Role_id == 5){ ?>
                                    <td><?php echo $proforma_invoice_title; ?></td>
                                    <?php } else if($Role_id == 1) { ?>
                                    <td><?php echo $main_invoice_title; ?></td>
                                    <?php } ?>
                                    <td><?php echo $data->lead_date; ?></td>
                                    <?php if($Role_id == 1){?>
                                    <td>
                                        <?php if ($query_main_invoice_details->num_rows() > 0) { ?>
                                        <?php echo $main_inward_no; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($query_main_invoice_details->num_rows() > 0) { ?>
                                        <?php echo $main_invoice_payment; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($query_main_invoice_details->num_rows() > 0) { ?>
                                        <?php echo $main_inward_date; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($query_main_invoice_details->num_rows() > 0) { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/generate_invoice/view/<?php echo $main_invoice_data->id; ?>"><b><?php echo $main_invoice_status; ?></b></a>
                                        <?php } else { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/generate_invoice/add_main_invoice/<?php echo $data->id; ?>"><b><?php echo $main_invoice_status; ?></b></a>
                                        <?php } ?>
                                    </td>
                                    <?php } ?>
                                    <td style="text-align: center">
                                        <?php if ($query_proforma_invoice_details->num_rows() > 0) { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/generate_invoice/view/<?php echo $proforma_invoice_data->id; ?>"><b><?php echo $proforma_invoice_status; ?></b></a>
                                        <?php } else { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/generate_invoice/add_proforma_invoice/<?php echo $data->id; ?>"><b><?php echo $proforma_invoice_status; ?></b></a>

                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Query Name</th>
                                    <th>Client Email</th>
                                    <th>Company</th>
                                    <th>Invoice Title</th>
                                    <th>Lead Date</th>
                                    <?php if($Role_id == 1) { ?>
                                    <th>Inward No.</th>
                                    <th>Payment Mode</th>
                                    <th>Inward Date</th>
                                    <th>Main Invoice</th>
                                    <?php } ?>
                                    <th>Proforma Invoice</th>
                                </tr>
                            </tfoot>
                        </table>
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
    <strong>Copyright © 2022 <a href="#">Infinium LLP</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

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
    $('#rddata').DataTable({
        'ordering': false,
    })

})
</script>
</body>

</html>