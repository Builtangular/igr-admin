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
            <div class="col-md-12">
                <?php if($image){?>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title">Existing Image</h1>
                        </div>
                        <?php if($massage){ ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <p><?php echo $massage; ?></p>
                        </div>
                        <?php } ?>
                        <form action="<?php echo base_url('admin/image/image_upload');?>" method="post"
                            class="form-horizontal"  accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <h5 class="box-title text-bold">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <img src="<?php echo site_url('assets/admin/img-rd/'.$image->image_file); ?>"
                                        alt="image" width="500" height="400"/>
                                    </a>
                                </h5>
                            </div>
                            <div class="box-footer">
                            </div>
                        </form>
                    </div>
                    <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
                    <?php } ?>
                    <form action="<?php echo base_url('admin/image/image_upload');?>" method="post"
                        class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if($image){?>
                            <h5 class="box-title text-bold">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Exiting File: <?php echo $image->image_file; ?>
                                </a>
                                <input type="hidden" name="id" class="form-control"
                                        value="<?php echo $image->id;?>">
                            </h5>
                            <?php } ?>
                            <div class="form-group">
                                <label for="inputImage" class="col-sm-3 control-label">Upload Image</label>
                                <div class="col-md-9">
                                    <input type="file" name="image_file" class="form-control">                                    
                                    <input type="hidden" name="report_id" class="form-control"
                                        value="<?php echo $report_id;?>">
                </div>
                <?php } ?>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title">Upload Image</h1>
                        </div>
                        <form action="<?php echo base_url('admin/image/image_upload');?>" method="post"
                            class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-3 control-label">Upload Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image_file" class="form-control">
                                        <input type="hidden" name="id" class="form-control"
                                            value="<?php echo $image->id;?>">
                                        <input type="hidden" name="report_id" class="form-control"
                                            value="<?php echo $report_id;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <?php /* if($image){?>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <?php if($massage){ ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <p><?php echo $massage; ?></p>
                        </div>
                        <?php } ?>
                        <form action="<?php echo base_url('admin/image/image_upload');?>" method="post"
                            class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                                <h5 class="box-title text-bold">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        Exiting File: <img
                                            src="<?php echo site_url('assets/admin/img-rd/'.$image->image_file); ?>"
                                            alt="image" />
                                    </a>
                                </h5>
                        </form>
                    </div>
                </div>
                <?php }  */?>
            </div>
            <!-- <div class='row'>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="form-group">
                            <label for="inputImage" class="col-sm-3 control-label">Upload Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image_file" class="form-control">
                                <input type="hidden" name="id" class="form-control" value="<?php echo $image->id;?>">
                                <input type="hidden" name="report_id" class="form-control"
                                    value="<?php echo $report_id;?>">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary pull-right" value="Submit">
                        </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>