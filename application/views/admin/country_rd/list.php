<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Country RD List
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
                        <h3 class="box-title">Country RD List</h3>
                    </div>
                    <?php if($success_code){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $success_code; ?></p>
                    </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Sku</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($Country_Rds as $data){ ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->id; ?></td>
                                    <td><?php echo $data->title; ?></td>
                                    <td class="text-center"><?php echo $data->sku; ?></td>
                                    <td class="text-center"><?php echo $data->country; ?></td>
                                    <td class="text-center"><?php echo $data->status; ?></td>
                                    <td class="text-center"><?php echo date("d-m-Y", strtotime($data->updated_at)); ?></td>
                                    <td><a href="<?php echo base_url(); ?>admin/country_rd/edit/<?php echo $data->id; ?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a> |
                                        <a href="<?php echo base_url(); ?>admin/country_rd/contry_rd_delete/<?php echo $data->id; ?>"" class="
                                            btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Sku</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <!-- <th>Vol</th> -->
                                    <th>Date</th>
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