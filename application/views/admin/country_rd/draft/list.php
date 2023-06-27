<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Under Study Report List
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
                    <div class="box-header">
                        <h3 class="box-title">Under Study Report List</h3>
                        <a href="<?php echo base_url(); ?>admin/country_rd/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <?php if ($success_code) { ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <p><?php echo $success_code; ?></p>
                        </div>
                    <?php } ?>
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>                                    
                                    <th>Cat</th>
                                    <th>Forecast</th>
                                    <!-- <th>Vol</th> -->
                                    <th>Segment</th>
                                    <th>Company</th>
                                    <!-- <th>Status</th> -->
                                    <th>Insight</th>
                                    <?php if ($Role_id == 1 || $Role_id == 3 || $Role_id == 4) { ?>
                                        <th>DRO</th>
                                        <th>Overview</th>
                                        <th>PR2</th>
                                    <?php } ?>
                                    <?php if ($Role_id == 1 || $Role_id == 2) { ?>
                                        <th>Image</th>
                                        <th>Country</th>
                                    <?php } ?>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Country_rds as $data) {
                                    /* $sql ="SELECT * FROM tbl_rd_companies where report_id = ".$data->id; */
                                    $sql = "SELECT COUNT(report_id) AS rd_companies FROM tbl_country_rd_companies where report_id = " . $data->id;
                                    $query = $this->db->query($sql);
                                    if ($query->num_rows() > 0) {
                                        $rd_company = $query->row();
                                    }
                                    $sql_seg = "SELECT COUNT(report_id) AS rd_segments FROM tbl_country_rd_segments where report_id = " . $data->id . " And parent_id = 0";
                                    $query_seg = $this->db->query($sql_seg);
                                    if ($query_seg->num_rows() > 0) {
                                        $rd_segment = $query_seg->row();
                                    }
                                    $sql_img = "SELECT id FROM tbl_rd_image where report_id = " . $data->id;
                                    $query_img = $this->db->query($sql_img);
                                    /* if ($query_img->num_rows() > 0) { $rd_image = "<img src=\"http://localhost/igr_admin/assets/admin/img-rd/global-automotive-display-system-market.jpg\" class=\"fa \" alt=\"User Image\" style=\"height:20px; width: 40px;\"> <br> Edit"; } else {$rd_image = "<i class=\"fa fa-plus\"></i><br> Add";} */
                                    if ($query_img->num_rows() > 0) {
                                        $rd_image = "<i class=\"fa fa-image\"></i><br> Edit";
                                    } else {
                                        $rd_image = "<i class=\"fa fa-plus\"></i><br> Add";
                                    }
                                    /* Market Insight */
                                    $market_insight = "SELECT id FROM tbl_country_rd_market_insight where report_id = " . $data->id;
                                    $query_market_insight = $this->db->query($market_insight);
                                    if ($query_market_insight->num_rows() > 0) {
                                        $insight_status = "<i class=\"fa fa-file\"></i><br>View";
                                    } else {
                                        $insight_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    }
                                    /* Report DROs */
                                    $dro_reports = "SELECT id FROM tbl_country_rd_dro where report_id = " . $data->id;
                                    $query_dro_reports = $this->db->query($dro_reports);
                                   /*  if ($query_dro_reports->num_rows() > 0) {
                                        $dro_status = "<i class=\"fa fa-file\"></i><br>View";
                                    } else {
                                        $dro_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    } */
                                    /* Segment Overview */
                                    $segment_overview = "SELECT id FROM tbl_country_rd_segment_overview where report_id = " . $data->id;
                                    $query_segment_overview = $this->db->query($segment_overview);
                                    if ($query_segment_overview->num_rows() > 0) {
                                        $segment_status = "<i class=\"fa fa-file\"></i><br>View";
                                    } else {
                                        $segment_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    }
                                    /* PR2 Writeup */
                                    $pr2_reports = "SELECT id FROM tbl_country_rd_pr2_data where report_id = " . $data->id;
                                    $query_pr2_reports = $this->db->query($pr2_reports);
                                    if ($query_pr2_reports->num_rows() > 0) {
                                        $pr2_reports_status = "<i class=\"fa fa-file\"></i><br>View";
                                    } else {
                                        $pr2_reports_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                    }
                                    /* get country names */                                   
                                    $CountryList = $this->Country_model->get_country_master();				
                                    foreach($CountryList as $country){
                                        if($country->id == $data->country_id){
                                            $country_name = $country->name;
                                        }
                                    }
                                    /* ./ get country names */
                                ?>
                                    <tr style="font-size: 14px;">
                                        <td class="text-center"><?php echo $data->id; ?></td>
                                        <td class="text-center"><?php echo $data->country; ?></td>
                                        <td><?php echo $data->title; ?></td>
                                        <td class="text-center"><?php echo $data->category_id; ?></td>
                                        <td><?php echo $data->forecast_from . '-' . $data->forecast_to; ?></td>
                                        <!--<td><?php // echo $data->analysis_from.'-'.$data->analysis_to; 
                                                ?></td>-->
                                        <!-- <td><?php // echo $data->is_volume_based; 
                                                    ?></td> -->
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_segment/<?php echo $data->id; ?>"><b><i class="fa fa-pencil"></i>
                                                    List</b></a><br><?php echo $rd_segment->rd_segments . " segment"; ?></td>
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_company/<?php echo $data->id; ?>"><b><i class="fa fa-pencil"></i>
                                                    List</b></a><br><?php echo $rd_company->rd_companies . " company"; ?></td>
                                        <!-- <td class="text-center"><?php echo $data->status; ?></td> -->                                        
                                        <?php if($query_market_insight->num_rows() > 0){ ?>
                                        <td class="text-center"><a
                                                href="<?php echo base_url(); ?>admin/country_insight/view/<?php echo $data->id; ?>"><b><?php echo $insight_status; ?></b></a>
                                        </td>
                                        <?php }else { ?>
                                        <td class="text-center"><a
                                                href="<?php echo base_url(); ?>admin/country_insight/<?php echo $data->id; ?>"><b><?php echo $insight_status; ?></b></a>
                                        </td>
                                        <?php } ?> 
                                        <?php if ($Role_id == 1 || $Role_id == 3 || $Role_id == 4) { ?>
                                            <?php if ($query_dro_reports->num_rows() > 0) { ?>
                                                <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_rd_dro/<?php echo $data->id; ?>"><b><i class="fa fa-file"></i><br>View</b></a>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_rd_dro/add/<?php echo $data->id; ?>"><b><i class="fa fa-plus"></i><br>Add</b></a>
                                                </td>
                                            <?php } ?>
                                            <?php if ($query_segment_overview->num_rows() > 0) { ?>
                                                <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_segment/overview_edit/<?php echo $data->id; ?>"><b><?php echo $segment_status; ?></b></a>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_segment/overview/<?php echo $data->id; ?>"><b><?php echo $segment_status; ?></b></a>
                                                </td>
                                            <?php } ?>
                                            <?php if ($query_pr2_reports->num_rows() > 0) { ?>
                                                <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_rd_pr/view/<?php echo $data->id; ?>"><b><?php echo $pr2_reports_status; ?></b></a>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url(); ?>admin/country_rd_pr/add/<?php echo $data->id; ?>"><b><?php echo $pr2_reports_status; ?></b></a>
                                                </td>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($Role_id == 1 || $Role_id == 2) { ?>
                                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/image/<?php echo $data->id; ?>"><b><?php echo $rd_image; ?></b></a>
                                            </td>
                                            <?php if ($data->country_status == 1) { ?>
                                                <td class="text-center text-yellow"><i class="fa fa-check-circle"></i><br /><b>
                                                        Created</b></td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <?php if ($data->scope_id == 1) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/country_rd/create/<?php echo $data->id; ?>"><b><i class="fa fa-globe"></i> <br />Create</b></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo base_url(); ?>admin/country_rd/create/<?php echo $data->id; ?>"><b><i class="fa fa-globe"></i> <br />Create</b></a>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                        <?php } ?>
                                        <td>
                                        <!-- <a href="<?php echo base_url(); ?>admin/country_rd/view/<?php echo $data->id; ?>" class="btn btn-info"><b><i class="fa fa-eye"></i></b></a> | -->
                                            <a href="<?php echo base_url(); ?>admin/country_rd/edit_rd/<?php echo $data->id; ?>" class="btn btn-success"><b><i class="fa fa-edit"></i></b></a> | 
                                            <a href="<?php echo base_url(); ?>admin/country_rd/delete_rd/<?php echo $data->id; ?>" class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a> |
                                            <a href="<?php echo base_url(); ?>admin/country_rd_generate/sample_pages/<?php echo $data->id; ?>" class="btn btn-info" title="Sample Pages"><b><i class="fa fa-download"></i></b></a>
                                            <a href="<?php echo base_url(); ?>admin/countrysample/sample_pages/<?php echo $data->id; ?>" class="btn btn-warning" title="Sample Pages"><b><i class="fa fa-download"></i></b></a>
                                        </td>
                                    </tr>
                                <?php  }  ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>                                    
                                    <th>Cat</th>
                                    <th>Forecast</th>
                                    <!-- <th>Analysis</th> -->
                                    <!-- <th>Vol</th> -->
                                    <th>Segment</th>
                                    <th>Company</th>
                                    <!-- <th>Status</th> -->
                                    <th>Insight</th>
                                    <?php if ($Role_id == 1 || $Role_id == 3 || $Role_id == 4) { ?>
                                        <th>DRO</th>
                                        <th>Overview</th>
                                        <th>PR2</th>
                                    <?php } ?>
                                    <?php if ($Role_id == 1 || $Role_id == 2) { ?>
                                        <th>Image</th>
                                        <th>Country</th>
                                    <?php } ?>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright © 2022 <a href="#">Infinium LLP</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->

<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demo.js" type="text/javascript"></script>


<script>
    $(document).ready(function() {
        $('.sidebar-menu').tree()
    })
</script>

<script>
    $(function() {
        $('#rddata').DataTable({
            'paging': true,
            'ordering': false,
       /*  'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true */
        })

    })
</script>
</body>

</html>