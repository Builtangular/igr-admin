<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit PR Description
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">PR Description</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/country_rd_pr/update/<?php echo $single_pr_data->id;?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">PR Description</label>
                                    <div class="col-md-10">
                                        <textarea type="text" name="description" rows="7"
                                            class="form-control"><?php echo $single_pr_data->description;?></textarea>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="report_id" class="form-control" id="report_id"
                                    value="<?php if(!empty($single_pr_data)){echo $single_pr_data->report_id;}?>">
                                <input type="submit" class="btn btn-primary pull-right" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>
