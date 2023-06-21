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
                                    <th>Query Name</th>
                                    <th>Client Email</th>
                                    <th>Company</th>
                                    <th>Invoice Title</th>
                                    <th>Lead Date</th>
                                    <th>Invoice</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_details as $data){ $i++;
                                $scope_name = $data->scope_name.' '.$data->report_name;
                                // var_dump($scope_name);die;
                                $invoice_details = "SELECT * FROM tbl_order_invoice_data where query_id = " . $data->id;
                                // var_dump($invoice_details);die;                              
                                $query_invoice_details = $this->db->query($invoice_details);
                                $invoice_data = $query_invoice_details->row();
                                if ($query_invoice_details->num_rows() > 0) {
                                    $invoice_status = "<i class=\"fa fa-file\"></i><br>View";
                                    $invoice_title = $invoice_data->invoice_title;
                                } else {
                                    $invoice_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    $invoice_title = "";
                                }

                                ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $data->query_code; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->client_email; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo $invoice_title; ?></td>
                                    <td><?php echo $data->lead_date; ?></td>
                                    <td align="center">
                                        <?php if ($query_invoice_details->num_rows() > 0) { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/genrate_invoice/view/<?php echo $invoice_data->id; ?>"><b><?php echo $invoice_status; ?></b></a>
                                        <?php } else { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/genrate_invoice/add_invoice/<?php echo $data->id; ?>"><b><?php echo $invoice_status; ?></b></a>

                                        <?php } ?>
                                    </td>
                                    <td>
                                    <?php if ($query_invoice_details->num_rows() > 0) { ?>
                                        <a href="<?php echo base_url();?>admin/genrate_invoice/edit/<?php echo $invoice_data->id;?>"
                                            class="btn btn-success"><i class="fa fa-edit"></i></b></a>
                                        <!-- <a href="<?php echo base_url();?>admin/query/delete_followup/<?php echo $data->id;?>" class="btn btn-danger">Delete</a> -->
                                        <a href="<?php echo base_url(); ?>admin/genrate_invoice/delete/<?php echo $invoice_data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
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
                                    <th>Invoice</th>
                                    <th width="100px">Action</th>
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