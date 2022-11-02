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
                                    <form
                                        action="<?php echo base_url(); ?>admin/segment/delete/<?php echo $data->id; ?>"
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
                    <div class="box-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Segments</h1>
                    </div>
                    <div class="box-body">
						<!-- main segment -->
                        <ol>                            
                            <?php foreach($main_segments as $data){ ?>
                            <li><?php echo $data->name; ?>
                                <!-- sub segment -->
								<?php $sql = "SELECT * FROM tbl_rd_segments where report_id = ".$data->report_id." AND parent_id = ".$data->id;
								$query = $this->db->query($sql);
								if ($query->num_rows() > 0) { ?>
                                <ol>                                    
                                    <?php foreach ($query->result() as $sub_seg) {?>
                                    <li><?php echo $sub_seg->name; ?>
                                        <!-- child segment -->
										<?php $sql1 = "SELECT * FROM tbl_rd_segments where report_id = ".$data->report_id." AND parent_id = ".$sub_seg->id;
										$query1 = $this->db->query($sql1);
										if ($query1->num_rows() > 0) { ?>
                                        <ol>                                            
                                            <?php foreach ($query1->result() as $child_seg) {?>
                                            <li><?php echo $child_seg->name; ?>
                                                <!-- sub child segment -->
												<?php $sql2 = "SELECT * FROM tbl_rd_segments where report_id = ".$data->report_id." AND parent_id = ".$child_seg->id;
												$query2 = $this->db->query($sql2);
												if ($query2->num_rows() > 0) { ?>
                                                <ol>                                                   
                                                    <?php foreach ($query2->result() as $sub_child_seg) {?>
                                                    <li><?php echo $sub_child_seg->name; ?> </li>
                                                    <?php } ?>
                                                </ol>
                                                <?php } ?>
												<!-- sub child segment -->
                                            </li>
                                            <?php } ?>
                                        </ol>
                                        <?php } ?>
										 <!-- child segment -->
                                    </li>
                                    <?php } ?>
                                </ol>
                                <?php } ?>
								<!-- sub segment -->
                            </li>
                            <?php } ?>							
                        </ol>
						<!-- main segment -->
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