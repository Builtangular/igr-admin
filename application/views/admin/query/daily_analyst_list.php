<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Daily Analyst Query List
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <!-- Main content -->
    <style>
    #search {
        width: 20em;
        height: 2em;
    }
    </style>
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Query List</h3>
                        <a href="<?php echo base_url(); ?>admin/query/add" class="btn btn-primary pull-right">
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
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Report Name</th>
                                    <th>Client Email</th>
                                    <th>Company</th>
                                    <th>Lead Date</th>
                                    <th>Created User</th>
                                    <th>Assign To Analyst</th>
                                    <th>Status</th>
                                    <th width="120px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query_details as $data){ 
                                     $scope_name = $data->scope_name.' '.$data->report_name;
                                     
                                     if($data->assign_analyst == 1){
                                        $status = "Yes";
                                     }else {
                                        $status = "No";
                                     }

                                     if($data->priority == 1){
                                        $priority_status = "<label class='text-blue'>High Priority</label>";
                                     }else {
                                        $priority_status = "<label class='text-yellow'>Priority</label>";
                                     }
                                /* Status 
                                $status_details = "SELECT * FROM tbl_rd_query_current_status where query_id = ".$data->id;
                                // var_dump($status_details);die;
                                $query_status_details = $this->db->query($status_details);
                                $rd_status = $query_status_details->row();
                                // var_dump($rd_status);
                                    $query_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                /* ./ Status  */
                                
                                 /* follow up  */
                                    $followup_details = "SELECT COUNT(query_id) AS rd_followup FROM tbl_rd_query_followup where query_id = " . $data->id;
                                    $query_followup_details = $this->db->query($followup_details);
                                    if ($query_followup_details->num_rows() > 0) {
                                        $rd_followup = $query_followup_details->row();
                                    }
                                 /* ./ follow up  */
                                //  var_dump($rd_status->query_id);
                                ?>
                                <?php /* if($rd_status->query_id!= $data->id){ */
                                    if($status!= "No"){ ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->query_code; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->client_email; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($data->lead_date)); ?></td>
                                    <td><?php echo $data->created_user; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <?php if ($Role_id == 5) { ?>

                                    <td class="text-center">
                                        <!-- <a href="<?php echo base_url(); ?>admin/query/add_status/<?php echo $data->query_id; ?>"><b><?php echo $query_status; ?></b></a> -->
                                        <?php echo $priority_status; ?>
                                    </td>
                                    <!-- <td><?php echo date("d-m-Y", strtotime($data->updated_on)); ?></td> -->
                                    <?php }?>
                                    <td> <?php if ($Role_id == 5) { ?>
                                        <a href="<?php echo base_url();?>admin/query/query_edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>
                                        <?php }else{ ?>
                                        <a href="<?php echo base_url();?>admin/query/edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>
                                        <?php } ?>
                                        <?php /* if ($Role_id == 10 || $Role_id == 5 || $Role_id == 1) { */ ?>
                                        <?php if ($Role_id == 10 || $Role_id == 1) { ?>
                                        <a href="<?php echo base_url(); ?>admin/query/delete/<?php echo $data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } } /* } */?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Query Id</th>
                                    <th>Report Name</th>
                                    <th>Client Email</th>
                                    <th>Company</th>
                                    <th>Lead Date</th>
                                    <th>Created User</th>
                                    <th>Assign To Analyst</th>
                                    <th>Status</th>
                                    <th width="120px">Action</th>
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