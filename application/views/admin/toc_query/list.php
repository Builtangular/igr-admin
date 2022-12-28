<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TOC Queries List
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
                        <h3 class="box-title">TOC Queries List</h3>

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
                                    <th>Name</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                             foreach($toc_data as $data){ ?>
                                <tr style="font-size: 14px;">
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/queries/toc_details/<?php echo $data->Report_id; ?>"
                                            class="btn btn-block btn-info btn-xs"><b>View</i></b></a>
                                    </td>
                                    <td><?php echo $data->Report_name; ?></td>
                                    <td><?php echo $data->First_name; ?></td>
                                    <td><?php echo $data->Creation_date; ?></td>

                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th style="width: 69px;">Action</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Date</th>
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
    <strong>Copyright © 2022<a href="#">Infinium</a>.</strong> All rights reserved.
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

// 
</script>

<!-- <script type="text/javascript">
function AlertIt() {
var answer = confirm ("Please click on OK to continue.")
if (answer)
window.location="http://localhost/infinium_new/custom_report/checkout_form";
}
</script>

<a href="javascript:AlertIt();">click me</a>
</script> -->



</body>

</html>