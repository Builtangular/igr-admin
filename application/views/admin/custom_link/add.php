<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Custom link
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
                        <h1 class="box-title">Create Custom link</h1>
                    </div>
                    <form action="<?php echo base_url();?>admin/custom_link/insert_custom_link/" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Report Id</label>
                                <div class="col-md-8">
                                    <input type="text" name="report_id" id="report_id" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">SKU</label>
                                <div class="col-md-8">
                                    <input type="text" name="sku" id="sku" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Title</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Price</label>
                                <div class="col-md-8">
                                    <input type="text" name="price" id="price" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">License Type</label>
                                <div class="col-md-8">
                                    <select class="form-control b-none" name="licens_type" placeholder="">
                                        <option value="" selected>Select License Type</option>
                                        <option value="Single User">Single User</option>
                                        <option value="Enterprise">Enterprise</option>
                                        <option value="Data Sheet">Data Sheet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Status</label>
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

<?php $this->load->view('admin/footer.php'); ?>