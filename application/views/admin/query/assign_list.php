<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assigned Queries
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
                        <h3 class="box-title">Assigned Query List</h3>
                        <!-- <a href="<?php echo base_url(); ?>admin/query/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a> -->
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
                                    <th>Query Id</th>
                                    <th>Report Name</th>
                                    <th>Assigned To</th>
                                    <th>Company Name</th>
                                    <th>Date</th>
                                    <th>Follow Up</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_list as $data){ 
                                    $scope_name = $data->scope_name.' '.$data->report_name;
                                    /* Status */
                                    $status_details = "SELECT (status) AS rd_status FROM tbl_rd_query_sale_status where query_id = ".$data->query_id;
                                    $query_status_details = $this->db->query($status_details);
                                    if($query_status_details->num_rows() > 0) { 
                                        $query_status = "<i class=\"fa fa-file\"></i><br>View  <br>";
                                        $rd_status = $query_status_details->row();
                                        if($rd_status->rd_status == "Sale"){
                                            $sale_status = '<span class="text-green">';
                                        }else{
                                            $sale_status = '<span class="text-red">';
                                        }
                                    } else {
                                        $query_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    }
                                /* ./ Status  */
                                /* Follow up  */                              
                                    $followup_details = "SELECT COUNT(query_id) AS rd_followup FROM tbl_rd_query_followup where query_id = " . $data->query_id;
                                    $query_followup_details = $this->db->query($followup_details);
                                    if ($query_followup_details->num_rows() > 0) {
                                        $rd_followup = $query_followup_details->row();
                                    }
                                 /* ./ Follow up  */
                                 /* Assigned  */
                                 /* $assigned_details = "SELECT (created_user)  AS rd_status FROM tbl_rd_query_data where id = ".$data->id;
                                 $query_assigned_details = $this->db->query($assigned_details);
                                 if($query_assigned_details->num_rows() > 0) { 
                                    if($rd_status->rd_status == "created_user"){
                                        $assigned_name = '<span class="text-green">';
                                    }
                                } */
                                /* ./ Assigned */
                                ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->query_code; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->assigned_name; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($data->created_at)); ?></td>
                                    <?php if ($Role_id == 5 || $Role_id == 7) { ?>
                                    <td class="text-center">
                                        <?php if($query_followup_details->num_rows() > 0){ ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/view_followup/<?php echo $data->query_id; ?>"><b><i
                                                    class="fa fa-pencil"></i>
                                                List</b></a><br><?php echo $rd_followup->rd_followup . " Followup"; ?>
                                        <?php } else { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/add_followup/<?php echo $data->query_id; ?>"><b><i
                                                    class="fa fa-pencil"></i>
                                                List</b></a><br><?php echo $rd_followup->rd_followup . " Followup"; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($query_status_details->num_rows() > 0){ ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/view/<?php echo $data->query_id; ?>"><b><?php echo $query_status; ?></b></a>
                                        <?php echo $sale_status; ?><?php echo $rd_status->rd_status; ?></span>
                                        <?php } else {?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/add_status/<?php echo $data->query_id; ?>"><b><?php echo $query_status; ?></b></a>
                                        <?php } ?>
                                    </td>
                                    <?php }?>
                                    <td> 
                                        <a href="<?php echo base_url();?>admin/query/assign_edit/<?php echo $data->query_id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>
                                        <?php if ($Role_id == 10 || $Role_id == 5) { ?>
                                            <a href="<?php echo base_url(); ?>admin/query/assign_delete/<?php echo $data->query_id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Report Name</th>
                                    <th>Assigned To</th>
                                    <th>Company Name</th>
                                    <th>Date</th>
                                    <th>Follow Up</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
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