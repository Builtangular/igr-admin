<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Custom List
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
                        <h3 class="box-title">Custom List</h3>
                        <a href="<?php echo base_url(); ?>admin/custom_link/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
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
                                    <th style="width: 69px;">Action</th>
                                    <th>Title</th>
                                    <th>Currency</th>
                                    <th>Price</th>
                                    <th>License</th>
                                    <th>SKU</th>
                                    <th>Report Id</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             foreach($custom_list as $list){ ?> 
                                <tr style="font-size: 14px;">
                                    <td><a href="<?php echo base_url(); ?>admin/custom_link/edit/<?php echo $list->id; ?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a> |
                                        <a href="<?php echo base_url(); ?>admin/custom_link/delete/<?php echo $list->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                        <a href="http://localhost/infinium_new/custom_report/checkout_form/<?php echo $list->report_id;  ?>" onclick="return confirm('Please click on OK to continue.');">click me</a>
                                    </td>
                                    <td><?php echo $list->title; ?></td>
                                    <td><?php echo $list->currency; ?></td>
                                    <td><?php echo $list->price; ?></td>
                                    <td class="text-center"><?php echo $list->licens_type; ?></td>
                                    <td class="text-center"><?php echo $list->sku; ?></td>
                                    <td class="text-center"><?php echo $list->report_id; ?></td>
                                    <td class="text-center"><?php echo $list->status; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th style="width: 69px;">Action</th>
                                    <th>Title</th>
                                    <th>Currency</th>
                                    <th>Price</th>
                                    <th>License</th>
                                    <th>SKU</th>
                                    <th>Report Id</th>
                                    <th>Status</th>
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


// <script type="text/javascript">
//     function clicked() {
//        if (confirm('Do you want to submit?')) {
//            window.location.href = "/custom_report/checkout_form"
//            yourformelement.submit();
//        } else {
//            return false;
//        }
//     }

// </script>

<script type="text/javascript">
function AlertIt() {
var answer = confirm ("Please click on OK to continue.")
if (answer)
window.location="https://www.infiniumglobalresearch.com/custom_report/checkout_form/";
}
</script>

</body>

</html>