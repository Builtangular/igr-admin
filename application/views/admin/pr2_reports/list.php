<?php $this->load->view('admin/header.php'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            PR2 List
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <section class="content">
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">PR2 List</h1>
                        <a href="<?php echo base_url(); ?>admin/pr2_reports/add/<?php echo $report_id; ?>"
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
                            <td><?php echo $list->active; ?></td>                            
                            <td><a href="<?php echo base_url();?>admin/pr2_reports/edit/<?php echo $list->id;?>" class="btn btn-warning">Edit</a></td>
                            <td>
                                <a href="<?php echo base_url()."admin/pr2_reports/delete/".$list->id; ?>" class="btn btn-danger" type="submit">Delete</a>
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