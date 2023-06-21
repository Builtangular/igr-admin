<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Insight List
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
                        <h1 class="box-title">Insight List</h1>
                        <a href="<?php echo base_url(); ?>admin/country_insight/add/<?php echo $report_id; ?>"
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
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach($market_insight as $data) { 
                                // var_dump($data); die;
                                    $type_name = explode(" ", $data['type']);
                                    $area_name = str_replace(' ','_', $data['type']);
                                    // var_dump($type_name); die;
                                    ?>
                               
                                <tr style="font-size: 14px;">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['type']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/country_insight/edit/<?php echo $data['id']; ?>"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                    <form action="<?php echo base_url(); ?>admin/country_insight/delete/<?php echo $data['id']; ?>" method="post"
                                        class="form-horizontal">
                                        <td>
                                            <input type="hidden" name="report_id" value="<?php echo $data['report_id']; ?>">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </td>
                                    </form>
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