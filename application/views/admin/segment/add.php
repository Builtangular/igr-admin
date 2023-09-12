<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Segment
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Segment</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->

        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Create Segment</h1>
                    </div>
                    <form autocomplete="off"
                        action="<?php echo base_url(); ?>admin/segment/insert/<?php echo $report_id; ?>" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" placeholder="Segment Name"
                                        autofocus required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Parent</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="parent">
                                        <option value="0">Select</option>
                                        <?php foreach($segments as $data) { ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" name="button" class="btn btn-info pull-right" value="Submit">
                            <input type="button" name="button" class="btn btn-warning pull-left" value="Finish"
                                onclick="redirect()">
                        </div>
                    </form>
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
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
function redirect() {
    window.location.href = "<?php echo base_url(); ?>analyst/report/drafts";
}
</script>
<?php $this->load->view('admin/footer.php'); ?>