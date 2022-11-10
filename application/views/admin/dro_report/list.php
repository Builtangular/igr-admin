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
                        <a href="<?php echo base_url(); ?>admin/dro_reports/add/<?php echo $report_id; ?>"
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
                            <th>Description</th>
                            <th>Dro Type</th>
                            <th>Active</th>
                        
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                         foreach($list_data as $list){ ?>                                               
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $list->description; ?></td>
                            <td><?php echo $list->name; ?></td>
                            <td><?php echo $list->active; ?></td>
                            
                            <td><a href="<?php echo base_url();?>admin/dro_reports/edit/<?php echo $list->id;?>" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="<?php echo base_url() . "admin/dro_reports/delete/" . $list->id; ?>" class="btn btn-danger" type="submit">Delete</a>
                                
                            </form>
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