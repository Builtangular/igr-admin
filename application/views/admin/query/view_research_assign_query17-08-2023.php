<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Query Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Query Details</h3>
                        <?php
                        $privious_query_details = "SELECT * FROM tbl_query_assignment_research where id = (SELECT min(id) FROM tbl_query_assignment_research where query_id < $id AND assigned_name = '$Login_user_name' AND status = 1) ";
                        
                        $privious_query_assign_details = $this->db->query($privious_query_details);
                        $privious_status = $privious_query_assign_details->row();
                        $privious_id = $privious_status->query_id;

                        $next_query_details = "SELECT * FROM tbl_query_assignment_research where id = (SELECT max(id) FROM tbl_query_assignment_research where query_id > $id AND assigned_name = '$Login_user_name' AND status = 1)";
                        
                        $next_query_assign_details = $this->db->query($next_query_details);
                        $next_status = $next_query_assign_details->row();
                        $next_id = $next_status->query_id;
                       
                        ?>
                        <div class="box-tools pull-right">
                            <a href="<?php echo $privious_id; ?>" class="btn btn-box-tool" data-toggle="tooltip"
                                title="Previous"><i class="fa fa-chevron-left"></i></a>
                            <a href="<?php echo $next_id; ?>" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                    class="fa fa-chevron-right"></i></a>
                        </div>
                        
                    </div>
                    <div class="box-body no-padding">
                        <div class="mailbox-read-message">
                            <p><b> Query Type : </b><?php echo $type; ?> </p>
                            <p><b> Title : </b><?php echo $report_name.' '.$scope_name; ?> </p>
                            <p><b> Designation : </b><?php echo $designation; ?> </p>
                            <p><b> Client Message : </b><?php echo $client_message; ?> </p>
                            <p><b> Lead Date : </b><?php echo $lead_date; ?> </p>
                            <p><b> Assigned Date : </b><span><?php echo $assigned_date; ?></span></p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo base_url();?>admin/query/research_assign_query_list/<?php echo $query_id;?>"
                            class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->


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


/

</body>

</html>