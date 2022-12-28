<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Segment
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
                        <h1 class="box-title">Create Segment</h1>
                    </div>

                    <form autocomplete="off" action="<?php echo base_url(); ?>admin/segment/insert/<?php echo $report_id; ?>" method="post"
                        class="form-horizontal">

                    <form action="<?php echo base_url(); ?>admin/segment/insert/<?php echo $report_id; ?>" method="post"
                        class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Parent</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="parent">
                                        <option value="0">Select</option> 
                                        <?php foreach($segments as $data) { ?>  
                                            <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option> 
                                            
                                        <?php } ?>                                       
                                    </select>
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