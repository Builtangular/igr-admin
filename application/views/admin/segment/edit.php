<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Segment
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Segment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Update Segment</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/segment/update/<?php echo $seg_id; ?>" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" value="<?php echo $seg_name; ?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Parent</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="parent">
                                        <option value="0">Select</option>
                                        <?php foreach($segments as $data){
                                            if ($data->id == $parent_id){ ?>
                                            <option value="<?php echo $data->id; ?>" Selected><?php echo $data->name; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                        <?php }} ?>
                                    </select>
                                    <input type="hidden" name="report_id" value="<?php echo $report_id; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>