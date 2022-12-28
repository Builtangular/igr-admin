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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Segment Overview</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/segment_overview/update/<?php echo $report_id; ?>"
                        method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-12">
                                <?php
                        
                                foreach($get_rd_segment as $data){ 
                                    
                                    $segment_overview = "SELECT id, description FROM tbl_rd_segment_overview where segment_id = ".$data->id;
                                    $query_segment_overview = $this->db->query($segment_overview);
                                    if ($query_segment_overview->num_rows() > 0) {
                                        $rd_segment_overview = $query_segment_overview->row();
                                        // var_dump($rd_segment_overview); 
                                     }
                                    ?>
                                <div class="form-group">
                                    <label class="control-label col-md-2"><?php echo $data->name;?></label>
                                    <div class="col-md-9">
                                        <?php  if ($query_segment_overview->num_rows() > 0) { ?><textarea type="text"
                                            name="description[]" rows="5"
                                            class="form-control"><?php echo $rd_segment_overview->description;?></textarea>
                                        <input type="hidden" name="overview_id[]" id="overview_id"
                                            value="<?php echo $rd_segment_overview->id;?>" class="form-control">
                                        <input type="hidden" name="seg_id[]" id="seg_id" value="<?php echo $data->id;?>"
                                            class="form-control">
                                        <?php } else { ?>
                                        <textarea type="text" name="description_new[]" rows="5"
                                            class="form-control"></textarea>
                                        <input type="hidden" name="seg_id_new[]" id="seg_id_new" value="<?php echo $data->id;?>"
                                            class="form-control">                                       
                                        <?php } ?>
                                        <input type="hidden" name="report_id" id="report_id"
                                            value="<?php echo $report_id;?>" class="form-control">
                                    </div>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>