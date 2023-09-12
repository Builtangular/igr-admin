<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Segment Overview
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
                        <h1 class="box-title">Segment Overview</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/segment_overview/insert/<?php echo $report_id; ?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <?php foreach($get_rd_segment as $data){ ?>
                            <div class="form-group">
                                <label class="control-label col-md-2"><?php echo $data->name;?></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="description[]" rows="5" class="form-control"></textarea>
                                    <span></span>
                                </div>
                                <input type="hidden" name="seg_id[]" id="seg_id" value="<?php echo $data->id;?>"
                                    class="form-control">
                            </div>
                            <?php } ?>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
            <!-- ./ col-md-8 -->
            <!-- col-md-4 -->
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
            <!-- ./ col-md-4 -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>