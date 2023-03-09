<?php $this->load->view('admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add FollowUp Details
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">FollowUp Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/insert_record/<?php echo $id;?>" method="post"
                        class="form-horizontal">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Subject</label>
                                <div class="col-md-10">
                                    <input type="text" name="subject" id="subject"
                                        value="<?php echo $followup_record->subject;?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Client Comment</label>
                                <div class="col-md-10">
                                    <textarea id="editor1" name="client_comment" id="client_comment" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">User Comment</label>
                                <div class="col-md-10">
                                    <textarea id="editor2" name="user_comment" id="user_comment" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">FollowUp Date</label>
                                <div class="col-md-10">
                                    <input type="date" name="followup_date" id="followup_date" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($followup_record)){echo $followup_record->id;}?>">
                                <a href="<?php echo base_url();?>admin/query/view_followup/<?php echo $id;?>"
                                    class="btn btn-default pull-left"><b><i class="fa fa-arrow-left"></i> Back</b></a>
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>

<script src="<?php echo base_url();?>assets/admin/plugins/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/bootstrap3-wysihtml5.all.min.js"></script>

<script>
  $(function () {
    //Add text editor
    CKEDITOR.replace('editor1')
    $(".compose-textarea").wysihtml5() 
    CKEDITOR.replace('editor2')
    $(".neweditSSS").wysihtml5();
  });
  $(function () {
    // Add text editor
    CKEDITOR.replace('editor2')
    $(".textarea").wysihtml5()
  });
</script>