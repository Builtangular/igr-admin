<?php $this->load->view('admin/header.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assign User
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Assign User</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Add User</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/update_assigned_user/<?php echo $single_data->id;?>" method="post" class="form-horizontal"
                        autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-2 text-red">Title :</label>
                                    <div class="col-md-10">
                                        <label class="control-label"><?php  echo $scope_name." ".$single_data->report_name; ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">User <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="user_name" required>
                                            <option value="">Select</option>
                                            <?php foreach($user_details as $user_name){?>
                                            <option value="<?php echo  $user_name['Full_name'];; ?>"><?php echo $user_name['Full_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
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