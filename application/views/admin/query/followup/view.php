<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Read Followup Mail
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
                        <h3 class="box-title">Read Followup Mail</h3>
                        <div class="box-tools pull-right">
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                                    class="fa fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                    class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>Subject : <?php echo $subject; ?><span class="mailbox-read-time pull-right"><?php echo $followup_date; ?></span></h3>
                            
                        </div>
                        <div class="mailbox-read-message">
                            <!-- <p><b> Dear Team,</b></p> -->
                            <p><b> Client Comment: </b></p>
                            <span><?php echo $client_comment; ?></span>
                            <br>
                            <p><b> User Comment: </b></p>
                            <p><?php echo $user_comment; ?></p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo base_url();?>admin/query/view_followup/<?php echo $id;?>"
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