<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DRO List
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">DRO List</h1>
                        <a href="<?php echo base_url(); ?>admin/country_rd_dro/add/<?php echo $report_id; ?>"
                            class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
                    <?php } ?>
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($list_data as $list){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list->name; ?></td>
                                    <td><?php echo $list->description; ?></td>
                                    <td><?php echo $list->status; ?></td>
                                    <td><a href="<?php echo base_url();?>admin/country_rd_dro/edit/<?php echo $list->id;?>"
                                            class="btn btn-warning">Edit</a></td>
                                    <form
                                        action="<?php echo base_url(); ?>admin/country_rd_dro/delete/<?php echo $list->id; ?>"
                                        method="post" class="form-horizontal">
                                        <td>
                                            <input type="hidden" name="report_id" value="<?php echo $report_id; ?>">
                                            <!-- <a href="<?php echo base_url();?>admin/dro_reports/delete/<?php echo $list->id;?>" class="btn btn-danger">Delete</a> -->
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </td>
                                    </form>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>
            </div>
        </div>
        <script>
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 3000);
        </script>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>