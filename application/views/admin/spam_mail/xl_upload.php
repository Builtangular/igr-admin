<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Export File
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Export File</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/spam_mail/export_data" method="post"
                        class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputImage" class="col-md-2 control-label">Export File</label>
                                    <div class="col-md-8">
                                        <input type="file" name="xl_file" class="form-control">
                                        <input type="hidden" name="xl_file" class="form-control-file" id="xl_file">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" value="Export Excel" class="btn btn-info pull-left"
                                            value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Email Format List</h3>
                        <!-- <a href="<?php echo base_url(); ?>admin/spam-mail" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a> -->
                    </div>
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th class="text-center">Id</th>
                                    <th>Company</th>
                                    <th>Domain</th>
                                    <th>Email</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($get_mail_data as $data){ ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->id; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo $data->domain; ?></td>
                                    <td><?php echo $data->email_address; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url(); ?>admin/spam_mail/format_edit/<?php echo $data->id; ?>"
                                            class="btn btn-warning"><b><i class="fa fa-edit"></i></b></a>
                                        <!-- | <a href="<?php echo base_url(); ?>admin/Spam_Mail/delete/<?php echo $data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a> -->
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th class="text-center">Id</th>
                                    <th>Company</th>
                                    <th>Domain</th>
                                    <th>Email</th>
                                    <th class="text-center">Action</th>
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
$(function() {
    $('#rddata').DataTable({
        'paging': true,
        'ordering': false,
    })

})
</script>
</body>

</html>