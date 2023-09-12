<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Queries
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
                        <h3 class="box-title">New Queries</h3>
                    </div>
                    <!-- box-body -->
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th width="100px">Query Id</th>
                                    <th>Report Name</th>
                                    <th>Query Type</th>
                                    <th>Client Name</th>
                                    <th>Company Name</th>
                                    <th>Lead Date</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_data as $data){ 
                                    if($data->priority == 1){
                                        $priority_status = "<label class='text-blue'>High Priority</label>";
                                    }else {
                                        $priority_status = "<label class='text-yellow'>Priority</label>";
                                    }
                                ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->query_code; ?></td>
                                    <td><?php echo $data->scope_name.' '.$data->report_name; ?></td>
                                    <td><?php echo $data->type; ?></td>
                                    <td><?php echo $data->client_name; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo $data->lead_date; ?></td>
                                    <td class="text-center"><?php echo $priority_status; ?></td>
                                    <td> <a href="<?php echo base_url();?>admin/query/upcoming_research_query_edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>                                        
                                    </td>
                                </tr>
                                <?php  }  ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th width="100px">Query Id</th>
                                    <th>Report Name</th>
                                    <th>Query Type</th>
                                    <th>Client Name</th>
                                    <th>Company Name</th>
                                    <th>Lead Date</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
    <strong>Copyright © 2023 <a href="#">Infinium LLP</a>.</strong> All rights reserved.
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