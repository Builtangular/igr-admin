<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create DRO Reports Master
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
                        <h1 class="box-title">Create DRO Reports Master</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/dro_reports/update/<?php echo $single_dro->report_id;?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Description</label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="description" rows="5"
                                            class="form-control"><?php echo $single_dro->description;?></textarea>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">DRO Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control b-none" name="type" placeholder="">
                                            <option value="0">--Select Dro Type--</option>
                                            <?php foreach($get_dro_type as $data) { 
                                            if($data->name == $single_dro->type){
                                            ?>
                                            <option value="<?php echo $data->name; ?>" selected><?php echo $data->name; ?>
                                            </option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $data->name ?>"><?php echo $data->name?> </option>
                                            <?php  } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Status</label>
                                    <div class="col-md-8">
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="1" checked />Active</label>
                                            <label><input type="radio" name="status" value="0" />Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($single_dro)){echo $single_dro->id;}?>">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>