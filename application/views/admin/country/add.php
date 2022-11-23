<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Country Region Master
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
                        <h1 class="box-title">Create Country Region Master</h1>
                    </div>
                    <form action="<?php echo base_url('admin/country/insert_country');?>" method="post"
                        class="form-horizontal" autocomplete="off">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Parent</label>
                                <div class="col-md-8">
                                    <select class="form-control b-none" name="parent" placeholder="">
                                        <option value="0">--Select Parent--</option>
                                        <?php 						
							            foreach($get_country_data as $data)						
                                        {						
                                        ?>
                                        <option value="<?php echo $data->id;?>"><?php echo $data->name; ?></option>
                                        <?php						
                                        }					
                                        ?>
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