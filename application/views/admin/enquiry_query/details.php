<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Read Mail
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Mail</h3>
                        <div class="box-tools pull-right">
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                                    class="fa fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                    class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            
                            <h3 style="color: #153643; font-family: Tahoma;font-size: 14px; line-height: 22px;"><?php echo $short_report_name; ?></h3>
                            <h5>From: <a href="mailto: <?php echo $Email_Address;?>"><?php echo $Email_Address;?></a></a>
                                <span class="mailbox-read-time pull-right"><?php echo $Creation_date; ?></span>
                            </h5>
                        </div>
                        <div class="mailbox-read-message">
                            <p><b> Dear Team,</b></p>
                            <p>The following enquiry has come for report titled <?php echo $Report_name; ?>.</p>
                            <p>Following are the details of the client and his/her message :</p>
                            <p><b> Full Name : </b><?php echo $First_name; ?> <?php echo $Last_name; ?></p>
                            <p><b>Report Title : </b><?php echo $Report_name; ?></p>
                            <p><b>Email Id : </b><a href="mailto:<?php echo $Email_Address;?>"><?php echo $Email_Address;?></a></p>
                            <p><b>Contact Number : </b><?php echo $Contact_Number; ?></p>
                            <p><b>Company Name : </b><?php echo $Company_Name; ?></p>
                            <p><b>Job Title : </b><?php echo $Job_Title; ?></p>
                            <p><b>Message :</b><?php echo $Comments_SMS; ?></p>
                            <p><b>Request Date : </b><?php echo $Creation_date; ?></p>
                            <p>Thanks,<br><?php echo $First_name;?></p>
                        </div>

                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <a type="button" href="mailto:<?php echo $Email_Address;?>" class="btn btn-default"><i class="fa fa-reply"></i> Reply</a>
                            <!-- <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button> -->
                        </div>

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