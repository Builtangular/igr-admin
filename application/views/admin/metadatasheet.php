<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            RD2 Metadata List
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
                    <div class="box-header with-border">
                        <h3 class="box-title">RD2 Metadata List</h3>
                        <form action="<?php echo  base_url('admin/spreadsheet/export_metadata'); ?>" method="post">
                            <input type="submit" value="Export Excel" class="btn btn-primary pull-right"></td>
                            <input type="hidden" name="from_date" class="form-control" value="<?php echo $from_date; ?>">
                            <input type="hidden" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
                            <input type="hidden" name="scope" class="form-control" value="<?php echo $scope; ?>">
                        </form>
                    </div>
                    <!-- <form method="post" action="<?php echo form_open_multipart('admin/spreadsheet/export_metadata',array('name' => 'spreadsheet'));?>"> -->
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th class="header">Report Title</th>
                                    <th class="header">Report Code</th>
                                    <th class="header">Category</th>
                                    <th class="header">Publish Date</th>
                                    <th class="header">Scope</th>
                                    <th class="header">Single User</th>
                                    <th class="header">Enterprise User</th>
                                </tr>
                            <tbody>
                                <?php
                                    if (isset($list_data) && !empty($list_data)) {
                                        foreach ($list_data as $key => $list) {
                                            foreach($ScopeList as $scope){
                                                if($scope->id == $list->scope_id){
                                                    $scope_name = $scope->name;
                                                    // var_dump($scope_name);
                                                }
                                            }
                                            foreach($category_data as $category){
                                                if($category->id == $list->category_id){
                                                    $category_name = $category->name;
                                                    // var_dump($scope_name);
                                                }
                                            }
                                ?>
                                <tr>
                                    <td><?php echo $scope_name.' '.$list->title; ?></td>
                                    <td><?php echo $list->sku; ?></td>
                                    <td><?php echo $category_name; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($list->updated_at)); ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $list->singleuser_price; ?></td>
                                    <td><?php echo $list->enterprise_price; ?></td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        ?>
                                <tr>
                                    <td colspan="5">There is no record.</td>
                                </tr>
                                <?php } ?>

                            </tbody>
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