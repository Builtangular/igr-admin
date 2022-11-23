<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create PR2 Reports Master
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
                        <h1 class="box-title">Create PR2 Reports Master</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/pr2_reports/update/<?php echo $single_pr2->report_id;?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="description" rows="5"
                                            class="form-control"><?php echo $single_pr2->description;?></textarea>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($single_pr2)){echo $single_pr2->id;}?>">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>
