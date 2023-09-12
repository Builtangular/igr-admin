<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Company
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Company</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Create Company</h1>
                    </div>
                    <form autocomplete="off" action="<?php echo base_url(); ?>admin/company/insert/<?php echo $report_id; ?>" method="post"
                        class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" placeholder="Company Name" autofocus required>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" name="button" class="btn btn-info pull-right" value="Submit">
                            <input type="button" name="button" class="btn btn-warning pull-left" value="Finish"
                                onclick="redirect()">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Companies</h1>
                    </div>
                    <div class="box-body">
                        <!-- main segment -->
                        <ol>
                            <?php foreach($Companies as $data){ ?>
                            <li>
                                <?php echo $data->name; ?>
                            </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <div class="box-footer">
                        <input type="button" name="button" class="btn pull-left" value="Back" onclick="redirect()">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
function redirect() {
    window.location.href = "<?php echo base_url(); ?>analyst/report/drafts";
}
</script>
<?php $this->load->view('admin/footer.php'); ?>