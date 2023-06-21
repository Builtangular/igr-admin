<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User List
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
                        <h3 class="box-title">User List</h3>
                        <a href="<?php echo base_url(); ?>admin/register_user/add" class="btn btn-primary pull-right">
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
                        <div class="box-body">
                            <table id="rddata" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size: 14px;">
                                        <th>Id</th>
                                        <th>User Type</th>
                                        <th>Full Name</th>
                                        <th>Department</th>
                                        <th>Head</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        $i=1;
                        foreach($user_details as $list){ ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $list->user_type; ?></td>
                                        <td><?php echo $list->full_name; ?></td>
                                        <td><?php echo $list->department; ?></td>
                                        <td><?php echo $list->head_name; ?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>admin/register_user/edit/<?php echo $list->id;?>"
                                                class="btn btn-warning" type="submit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url();?>admin/register_user/delete/<?php echo $list->id;?>"
                                                class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                            <a href="<?php echo base_url();?>admin/register_user/email/<?php echo $list->id;?>"
                                                class="btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Send</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr style="font-size: 14px;">
                                        <th>Id</th>
                                        <th>User Type</th>
                                        <th>Full Name</th>
                                        <th>Department</th>
                                        <th>Head</th>
                                        <th colspan="2">Action</th>
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
<!-- Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright © 2023 <a href="#">Infinium</a>.</strong> All rights reserved.
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
    $('#rddata').DataTable()
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
})
</script>
</body>

</html>