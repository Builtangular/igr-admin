<?php $this->load->view('admin/header.php'); ?>

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
                        <h3 class="box-title">Invoice List</h3>
                        <a href="<?php echo base_url(); ?>admin/custom_invoice/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
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
                                    <th>Id</th>
                                    <th>Order No.</th>
                                    <th>Order Title</th>
                                    <th>Reseller Name</th>
                                    <th>Invoice No</th>
                                    <th>Order Date</th>
                                    <th>Inward No.</th>
                                    <th>Inward Date</th>
                                    <th>Invoice</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($custom_details as $data){ $i++;
                                $invoice_no = $data->invoice_no;
                                // var_dump($invoice_no);die;
                                $invoice_details = "SELECT * FROM tbl_custome_invoice where id = " . $data->id;                              
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
                                <tr style="font-size: 14px;">
                                    <td><?php echo $data->id; ?></td>
                                    <td><?php echo $data->order_no; ?></td>
                                    <td><?php echo $data->order_title; ?></td>
                                    <td><?php echo $data->reseller_name; ?></td>
                                    <td><?php echo $data->invoice_no; ?></td>
                                    <td><?php echo date('F, Y', strtotime($data->order_date)); ?></td>
                                    <td><?php echo $data->inward_no; ?></td>
                                    <td><?php echo $data->inward_date; ?></td>
                                    
                                    <td class="text-center">                                   
                                    <?php /* if ($custom_invoice_details->num_rows() > 0) { ?>
                                    
                                        <a href="<?php echo base_url(); ?>admin/custom_invoice/view/<?php echo $data->id; ?>"><b><?php echo $invoice_status; ?></b></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>admin/custom_invoice/view/<?php echo $data->id; ?>"><b><?php echo $invoice_status; ?></b></a>
                                    
                                    <?php } */ ?>
                                    <a href="<?php echo base_url(); ?>admin/custom_invoice/view/<?php echo $data->id; ?>"><b><?php echo $invoice_status; ?></b></a>
                                    </td>
                                    <td>
                                    <a href="<?php echo base_url();?>admin/custom_invoice/edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><i class="fa fa-edit"></i></b></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Order No.</th>
                                    <th>Order Title</th>
                                    <th>Reseller Name</th>
                                    <th>Invoice No</th>
                                    <th>Order Date</th>
                                    <th>Inward No.</th>
                                    <th>Inward Date</th>
                                    <th>Invoice</th>
                                    <th>Action</th>
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