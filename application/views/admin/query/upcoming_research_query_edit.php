<?php $this->load->view('admin/header.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Upcoming Query</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/upcoming_research_query_update"
                        id="employment-form" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="box-body no-padding">
                                    <div class="mailbox-read-message">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:50%">Query Type:</th>
                                                            <td><?php echo $type; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Title:</th>
                                                            <td><?php echo $report_name.' '.$scope_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Client Name:</th>
                                                            <td><?php echo $client_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Designation:</th>
                                                            <td><?php echo $designation; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Client Message:</th>
                                                            <td><?php echo $client_message; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Lead Date:</th>
                                                            <td><?php echo $lead_date; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Assign to Team</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team">
                                            <option value="" selected>Assign to Team</option>
                                            <?php foreach($user_details as $data) { ?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Bootstrap 3.3.2 JS -->

<?php $this->load->view('admin/footer.php'); ?>