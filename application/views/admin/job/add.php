<?php $this->load->view('admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap3-wysihtml5.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Job Post
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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Create Job Post</h1>
                    </div>
                    <form action="<?php echo base_url('admin/jobpost/insert');?>" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Post Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="post_name" id="post_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Job Description</label>
                                <div class="col-md-8">
                                    <!-- <textarea name="description" id="description" rows="5" class="form-control" required></textarea> -->
                                    <textarea id="editor1" name="description" rows="10" cols="80">
                                            </textarea>
                                </div>
                            </div>
<!-- 

                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="box-header">
                                                <h3 class="box-title">CK Editor
                                                    <small>Advanced and full of features</small>
                                                </h3>
                                                <div class="pull-right box-tools">
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fa fa-minus"></i></button>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-widget="remove" data-toggle="tooltip" title="Remove">
                                                        <i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body pad">
                                                <form>
                                                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            This is my textarea to be replaced with CKEditor. </textarea>
                                                </form>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </section>



 -->
                            <div class="form-group">
                                <label class="control-label col-md-3">No Of Positions</label>
                                <div class="col-md-8">
                                    <input type="number" name="positions" id="positions" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label><input type="radio" name="status" value="1" checked />Active</label>
                                        <label><input type="radio" name="status" value="0" />Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
})
</script>
<?php $this->load->view('admin/footer.php'); ?>