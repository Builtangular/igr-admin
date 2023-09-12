<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Query List
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
                                    <?php if ($Role_id == 5) { ?>
                                    <th>Follow Up</th>
                                    <th>Status</th>
                                    <?php } ?>
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
                                /* Status */
                                    $status_details = "SELECT * FROM tbl_rd_query_current_status where query_id = ".$data->id;                               
                                    $query_status_details = $this->db->query($status_details);
                                    $rd_status = $query_status_details->row();
                                    // $query_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                /* ./ Status  */
                                
                                 /* follow up  */
                                    $followup_details = "SELECT COUNT(query_id) AS rd_followup FROM tbl_rd_query_followup where query_id = " . $data->id;
                                    $followup_data = "SELECT * FROM tbl_rd_query_followup where query_id = " . $data->id;
                                    $query_followup_details = $this->db->query($followup_details);
                                    $followup_data = "SELECT * FROM tbl_rd_query_followup where query_id = " . $data->id;
                                    $query_followup_data = $this->db->query($followup_data);
                                    if ($query_followup_details->num_rows() > 0) {
                                        $rd_followup = $query_followup_details->row();
                                    } 
                                    if ($query_followup_data->num_rows() > 0) {
                                        $followup = $query_followup_data->result();
                                    }
                                 /* ./ follow up  */
                                ?>
                                <?php // if($rd_status->query_id!= $data->id){?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $data->query_code; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->client_email; ?></td>
                                    <td><?php echo $data->company_name; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($data->lead_date)); ?></td>
                                    <td><?php echo $data->created_user; ?></td>
                                    <!-- <td> <button type="button" class="btn btn-primary" data-toggle="popover" title="Dates" data-content="<?php foreach($followup as $followup_date){ print "{$followup_date->followup_date}&nbsp;&nbsp;"; } ?>">Popover</button></td> -->
                                    <td class="text-center"><?php echo $status; ?></td>
                                    <?php if ($Role_id == 5) { ?>
                                    <td class="text-center">
                                        <?php if($rd_followup->rd_followup != "0"){ ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/view_followup/<?php echo $data->query_id; ?>">
                                            <span
                                                class="badge bg-light-blue" data-toggle="popover" title="Dates" data-content="<?php foreach($followup as $followup_date){ print date('d-M-Y', strtotime($followup_date->followup_date)).'&nbsp;&nbsp;'; } ?>"><?php echo $rd_followup->rd_followup; ?></span>
                                        </a><!-- <br><?php echo $rd_followup->rd_followup . " Followup"; ?> -->
                                        <?php }else { ?>
                                        <a
                                            href="<?php echo base_url(); ?>admin/query/add_followup/<?php echo $data->query_id; ?>"><b><i
                                                    class="fa fa-plus"></i> Add</b></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($query_status_details->num_rows() > 0){ ?>
                                        <!-- <a href="<?php echo base_url(); ?>admin/query/view/<?php echo $data->query_id; ?>"> -->
                                            <?php if($rd_status->status == 'Sale'){ ?>
                                                <span class="label label-success"><?php echo "Sale"; ?></span>
                                            <?php } else if($rd_status->status == 'Reject') { ?>
                                                <span class="label label-danger">Rejected</span>
                                            <?php } else if($rd_status->status == 'Spam') { ?>
                                                <span class="label label-warning">Spam</span>
                                            <?php } else if($rd_status->status == 'Student') { ?>
                                                <span class="label label-primary">Student</span>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url(); ?>admin/query/view/<?php echo $data->query_id; ?>"><span class="label label-info">Inprocess</span></a>
                                            <?php } ?>
                                        <!-- </a> -->
                                        <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>admin/query/add_status/<?php echo $data->query_id; ?>">
                                            <b><i class="fa fa-plus"></i> Add</b>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td><?php echo date("d-m-Y", strtotime($data->updated_on)); ?></td> -->
                                    <?php } ?>
                                    <td> <?php if ($Role_id == 5) { ?>
                                        <a href="<?php echo base_url();?>admin/query/query_edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>
                                        <?php }else{ ?>
                                        <a href="<?php echo base_url();?>admin/query/edit/<?php echo $data->id;?>"
                                            class="btn btn-success"><b><i class="fa fa-edit"></i></b></a>
                                        <?php } ?>
                                        <?php if ($Role_id == 10 || $Role_id == 5 || $Role_id == 1) { ?>
                                        <a href="<?php echo base_url(); ?>admin/query/delete/<?php echo $data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                                <?php // } }?>
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
                                    <?php if ($Role_id == 5) { ?>
                                    <th>Follow Up</th>
                                    <th>Status</th>
                                    <?php }  ?>
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
    $('.sidebar-menu').tree();
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });
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