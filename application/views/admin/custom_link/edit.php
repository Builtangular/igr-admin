<?php $this->load->view('admin/header.php'); 
$currency = array('USD', 'INR', 'EUR', 'AED', 'SAR');
$licens_type = array('Single User', 'Enterprise', 'Data Sheet');
?>

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
                    <form action="<?php echo base_url('admin/custom_link/update_custom_link');?>" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <?php foreach($single_custom_data as $data){  ?>
                            <div class="form-group">
                                <label class="control-label col-md-2">Title</label>
                                <div class="col-md-10">
                                    <input type="text" name="title" id="title" value="<?php echo $data->title;?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Report Id</label>
                                <div class="col-md-4">
                                    <input type="text" name="report_id" id="report_id"
                                        value="<?php echo $data->report_id;?>" class="form-control">
                                </div>
                                <label class="control-label col-md-2">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" name="sku" id="sku" value="<?php echo $data->sku;?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Currency</label>
                                <div class="col-md-4">
                                    <select class="form-control b-none" name="currency" id="licens_type" placeholder="">
                                        <?php foreach($currency as $currency ) {
                                            if($currency == $data->currency){ ?>
                                        <option value="<?php echo $currency; ?>" selected>
                                            <?php echo $currency; ?></option>
                                        <?php }else {?>
                                        <option value="<?php echo $currency; ?>"><?php echo $currency; ?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                                <label class="control-label col-md-2">Price</label>
                                <div class="col-md-4">
                                    <input type="text" name="price" id="price" value="<?php echo $data->price;?>"
                                        class="form-control">
                                    <input type="hidden" name="id" class="form-control" id="id"
                                        value="<?php if(!empty($data)){echo $data->id;}?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Licens Type</label>
                                <div class="col-md-4">
                                    <select class="form-control b-none" name="licens_type" id="licens_type">
                                        <?php foreach($licens_type as $ltype){
                                            if($ltype == $data->licens_type){ ?>
                                            <option value="<?php echo $data->licens_type; ?>" selected>
                                            <?php echo $data->licens_type; ?></option>
                                        <?php }else { ?>
                                            <option value="<?php echo $ltype; ?>"><?php echo $ltype; ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                           
                                <label class="control-label col-md-2">Status</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label><input type="radio" name="status" value="1" checked />Active</label>
                                        <label><input type="radio" name="status" value="0" />Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <?php }  ?>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-info pull-right" value="Update">
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>