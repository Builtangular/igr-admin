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
                                    <th>Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($Companies as $data){ ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data->name; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/company/edit/<?php echo $data->id; ?>"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                    <form
                                        action="<?php echo base_url(); ?>admin/company/delete/<?php echo $data->id; ?>"
                                        method="post" class="form-horizontal">
                                        <td>
                                            <input type="hidden" name="report_id"
                                                value="<?php echo $data->report_id; ?>">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </td>
                                    </form>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Companies</h1>
                    </div>
                    <div class="box-body">
                        <!-- main segment -->
                        <ol>
                            <?php foreach($Companies as $data){ ?>
                            <li>
                                <?php echo $data->name; ?>
                            </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <div class="box-footer">
                        <input type="button" name="button" class="btn pull-left" value="Back" onclick="redirect()">
                    </div>
                </div>
            </div>
        </div>
        <script>
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 3000);

        function redirect() {
            window.location.href = "<?php echo base_url(); ?>analyst/report/drafts";
            // document.write(document.referrer);
            // window.location.href = document.referrer;
        }
        </script>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>