<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Documents List
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
                        <h3 class="box-title">Documents List</h3>
                        <a href="<?php echo base_url(); ?>admin/employee/add_document/<?php echo $Emp_id; ?>"
                            class="btn btn-primary pull-right">
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Document Type</th>
                                    <th>Upload file</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i=1;
                         foreach($document_list as $list){?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list->doc_type; ?></td>
                                    <td><a href="<?php echo base_url()."assets/admin/emp_data/document/".$list->upload_file; ?>"
                                            target="blank"><?php echo $list->upload_file; ?></a></td>
                                    <td><a href="<?php echo base_url();?>admin/employee/edit_document/<?php echo $list->id;?>"
                                            class="btn btn-warning">Edit</a></td>
                                    <td>
                                        <form action="" method="post">
                                            <a href="<?php echo base_url();?>admin/employee/delete_document/<?php echo $list->id;?>"
                                                class="btn btn-danger" type="submit">Delete</a>

                                        </form>
                                    </td>
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
    <strong>Copyright © 2022 <a href="#">Infinium LLP</a>.</strong> All rights reserved.
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
    $('#rddata').DataTable({
        'ordering': false,
    })

})
</script>
</body>

</html>