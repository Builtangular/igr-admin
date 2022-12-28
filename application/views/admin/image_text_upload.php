<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload Image
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
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Upload Image</h1>
                    </div>
                    <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
                    <?php } ?>
                    <form action="<?php echo base_url();?>admin/image_text_write/image_write/<?php echo $id; ?>" method="post"
                        class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                     
                        <div class="form-group">
                                <label for="inputImage" class="col-sm-3 control-label">Upload Image</label>
                                <div class="col-md-9">
                                    <input type="file" name="image_file" class="form-control">
                                    <input type="hidden" name="image_file" class="form-control-file" id="image_file">
                                </div>
                            </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>