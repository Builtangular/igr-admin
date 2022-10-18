<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Segment List
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
                        <h1 class="box-title">Segment List</h1>
                        <a href="<?php echo base_url(); ?>admin/segment/add/<?php echo $report_id; ?>"
                            class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <?php if($success_code){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $success_code; ?></p>
                    </div>
                    <?php } ?>
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                foreach($segments as $data){ ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data->name; ?></td>
                                    <td><?php echo $data->parent_id; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/segment/edit/<?php echo $data->id; ?>"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/segment/delete/<?php echo $data->id; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
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