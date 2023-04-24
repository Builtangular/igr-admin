<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Update Job Post
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
                        <h1 class="box-title"> Update Job Post</h1>
                    </div>
                    <form action="<?php echo base_url('admin/jobpost/update_job_data');?>" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Post Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="post_name" id="post_name" value="<?php echo $single_jobpost_data->post_name;?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Job Description</label>
                                <!-- <div class="col-md-8">
                                    <textarea name="description" id="description" rows="5" class="form-control"><?php echo $single_jobpost_data->description;?></textarea>
                                </div> -->
                                <div class="col-md-8">
                                    <!-- <textarea name="description" id="description" rows="5" class="form-control" required></textarea> -->
                                    <textarea id="editor1" name="description" rows="10" cols="80">
                                            </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">No Of Positions</label>
                                <div class="col-md-8">
                                    <input type="number" name="positions" id="positions" value="<?php echo $single_jobpost_data->positions;?>" class="form-control">
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
                            <input type="hidden" name="id" class="form-control" id="id" value="<?php if(!empty($single_jobpost_data)){echo $single_jobpost_data->id;}?>">
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