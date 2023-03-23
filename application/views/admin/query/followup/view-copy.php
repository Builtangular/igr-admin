<?php $this->load->view('admin/header.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Read Followup Mail
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <style>
    .error {
        color: red;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Read Followup Mail</h3>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/update_followup/<?php echo $followup_details->id;?>" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-tools pull-right">
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                                    class="fa fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                    class="fa fa-chevron-right"></i></a>
                        </div>
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3>Subject : <?php echo $followup_details->subject;?><span
                                        class="mailbox-read-time pull-right"><?php echo $followup_details->followup_date; ?></span></h3>
                            </div>
                            <div class="mailbox-read-message">
                                <!-- <p><b> Dear Team,</b></p> -->
                                <p><b> Client Comment: </b></p>
                                <span><?php echo $followup_details->client_comment;?></span>
                                <br>
                                <p><b> User Comment: </b></p>
                                <p><?php echo $followup_details->user_comment; ?></p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($followup_details)){echo $followup_details->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Bootstrap 3.3.2 JS -->

<?php $this->load->view('admin/footer.php'); ?>