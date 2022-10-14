<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Company List
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
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Company List</h1>
                        <a href="<?php echo base_url(); ?>admin/company/add/<?php echo $report_id; ?>"
                            class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                        <div class="box-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="font-size: 14px;">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php foreach($Companies as $data){ ?>
                                    <tr style="font-size: 14px;">
                                        <td><?php echo $data->id; ?></td>
                                        <td><?php echo $data->name; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/company/edit/<?php echo $data->id; ?>"
                                                class="btn btn-warning">Edit</a>
                                        </td>
                                        <td>
											<a href="<?php echo base_url(); ?>admin/company/delete/<?php echo $data->id; ?>"
                                                class="btn btn-danger">Delete</a>
                                        </td>
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