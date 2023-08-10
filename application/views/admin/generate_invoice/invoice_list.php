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
                    <!-- <div class="box-header">
                        <h3 class="box-title">Invoice List</h3>
                        <a href="<?php echo base_url(); ?>admin/query/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div> -->
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
                                    <th>Invoice Title</th>
                                    <th>Invoice No.</th>
                                    <th>Lead Date</th>
                                    <th>Inward No.</th>
                                    <th>Payment Mode</th>
                                    <th>Inward Date</th>
                                    <th style="text-align: center">Main Invoice</th>
                                    <th style="text-align: center">Proforma Invoice</th>
                                    <!--  <th width="100px">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_details as $data){ $i++;
                                $scope_name = $data->scope_name.' '.$data->report_name;
                                  /* Proforma invoice details */
                                //   $proforma_invoice_details = "SELECT * FROM tbl_order_invoice_data where invoice_type='Proforma'";
                                  $proforma_invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $data->query_id. " AND invoice_type='Proforma'";
                                  $query_proforma_invoice_details = $this->db->query($proforma_invoice_details);
                                  $proforma_invoice_data = $query_proforma_invoice_details->row();
                                    // $invoice_type = $proforma_invoice_data->invoice_type;
                                    // var_dump($proforma_invoice_data> 0);die;
                                  if ($query_proforma_invoice_details->row() > 0) {
                                      $proforma_invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    } else {
                                        $proforma_invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                        $proforma_invoice_title = "";
                                    }
                                    // var_dump($proforma_invoice_status);die;
                                   /* ./ Proforma invoice details */
                                /* Main invoice details */
                                $main_invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $data->query_id. " AND invoice_type='Main'";
                                $query_main_invoice_details = $this->db->query($main_invoice_details);
                                // var_dump($main_invoice_details);die;
                                $main_invoice_data = $query_main_invoice_details->row();
                                // var_dump($query_main_invoice_details);die;
                                if ($query_main_invoice_details->row() > 0) {
                                    $main_invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    $main_invoice_title = $main_invoice_data->invoice_title;
                                } else {
                                    $main_invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    $main_invoice_title = "";
                                }
                               
                                ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $data->query_code; ?></td>
                                    <td><?php echo $data->invoice_title; ?></td>
                                    <td><?php echo $data->main_invoice_no; ?></td>
                                    <td><?php echo date('F, Y', strtotime($data->order_date)); ?></td>
                                    <td><?php echo $data->inward_no; ?></td>
                                    <td><?php echo $data->payment_mode; ?></td>
                                    <td><?php echo $data->inward_date; ?></td>
                                    <td style="text-align: center">
                                            <form
                                            action="<?php echo base_url(); ?>admin/generate_invoice/view/<?php echo $data->id; ?>"
                                            method="post">
                                            <button class="btn btn-primary "><i class="fa fa-eye"></i></button>
                                            <input type="hidden" name="genrated_invoice_list" id="genrated_invoice_list"
                                                value="genrated_invoice_list" class="form-control">
                                        </form>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($query_proforma_invoice_details->row() > 0) { ?>
                                        <form
                                            action="<?php echo base_url(); ?>admin/generate_invoice/view/<?php echo $proforma_invoice_data->id; ?>"
                                            method="post">
                                            <button class="btn btn-primary "><i class="fa fa-eye"></i></button>
                                            <input type="hidden" name="genrated_invoice_list" id="genrated_invoice_list"
                                                value="genrated_invoice_list" class="form-control">
                                        </form>
                                        <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>admin/generate_invoice/add_proforma_invoice/<?php echo $data->id; ?>"
                                            method="post"><b><?php echo $proforma_invoice_status; ?></b>
                                            <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <a href="<?php echo base_url();?>admin/genrate_invoice/edit1/<?php echo $data->id;?>"
                                            class="btn btn-success"><i class="fa fa-edit"></i></b></a>
                                     
                                        <a href="<?php echo base_url(); ?>admin/genrate_invoice/delete/<?php echo $data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                    </td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Invoice Title</th>
                                    <th>Invoice No.</th>
                                    <th>Lead Date</th>
                                    <th>Inward No.</th>
                                    <th>Payment Mode</th>
                                    <th>Inward Date</th>
                                    <th style="text-align: center">Main Invoice</th>
                                    <th style="text-align: center">Proforma Invoice</th>
                                    <!-- <th width="100px">Action</th> -->
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