<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo $title; ?> RDs
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
                        <h3 class="box-title"><?php echo $title; ?> RDs</h3>
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
                                    <th>Action</th>
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>
                                    <th>Forecast</th>
                                    <th>Created User</th>
                                    <th>Assign</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($Global_Rds as $data){
                                 $sql = "SELECT COUNT(report_id) AS rd_companies FROM tbl_rd_companies where report_id = ".$data->id;
								$query = $this->db->query($sql);
								if ($query->num_rows() > 0) { $rd_company = $query->row(); }
								$sql_seg = "SELECT COUNT(report_id) AS rd_segments FROM tbl_rd_segments where report_id = ".$data->id." And parent_id = 0";
								$query_seg = $this->db->query($sql_seg);
								if ($query_seg->num_rows() > 0) { $rd_segment = $query_seg->row(); }
								/* get scope data */
                                $ScopeList = $this->Data_model->get_scope_master();	
                                foreach($ScopeList as $scope){
                                    if($scope->id == $data->scope_id){
                                        $scope_name = $scope->name;
                                    }
                                }
                               /* ./ get scope data */
                                ?>
                                <tr style="font-size: 14px;">
                                    <td class=""><a href="<?php echo base_url()?>admin/generate_rd/rd_2/?report_id=<?php echo $data->id;?>"
                                            title="Get RD2"><b><i class="fa fa-download"></i> &nbsp;RD2</b>
                                        </a> <br />
                                        <a href="<?php echo base_url()?>admin/generate_rd/toc/?report_id=<?php echo $data->id;?>"
                                            title="Get TOC"><b><i class="fa fa-download"></i> &nbsp;TOC</b>
                                        </a></td>
                                    <td class=""><?php echo $data->id; ?></td>
                                    <td class=""><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->title; ?></td>
                                    <td><?php echo $data->forecast_from.'-'.$data->forecast_to; ?></td>
                                    <td class=""><?php echo $data->created_user; ?></td>
                                    <td class=""><a href="<?php echo base_url(); ?>admin/report/assign_user/<?php echo $data->id; ?>"><b>Assign</b></a></td>
                                </tr>
                                <?php  } /* /. End foreach */  ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Action</th>
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>
                                    <th>Forecast</th>
                                    <th>Created User</th>
                                    <th>Assign</th>
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
    $('#rddata').DataTable({
        'paging': true,
       /*  'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true */
    })
})
</script>
</body>

</html>