<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Report List
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
                        <h3 class="box-title">Report List</h3>
                        <a href="<?php echo base_url(); ?>admin/report/add" class="btn btn-primary pull-right">
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
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <!-- FOR GRAPHICS -->
                                <?php if($Role_id == 8){ ?>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>
                                    <th>DRO</th>
                                </tr>
                                <!-- ./ FOR GRAPHICS -->
                                <?php } else { ?>
                                <tr style="font-size: 14px;">
                                    <th style="width: 85px;">Action</th>
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>
                                    <th>Forecast</th>
                                    <th>Segment</th>
                                    <th>Company</th>
                                    <th>Insight</th>
                                    <th>DRO</th>
                                    <th>Overview</th>
                                    <th>PR2</th>
                                </tr>
                                <?php } ?>
                            </thead>
                            <tbody>
                                <?php foreach($Published_rds as $data){ 
                                /* COMPANIES */
                                $sql = "SELECT COUNT(report_id) AS rd_companies FROM tbl_rd_companies where report_id = ".$data->id;
								$query = $this->db->query($sql);
								if ($query->num_rows() > 0) { $rd_company = $query->row(); }
                                /* ./ COMPANIES */
                                /* SEGMENTS */
								$sql_seg = "SELECT COUNT(report_id) AS rd_segments FROM tbl_rd_segments where report_id = ".$data->id." And parent_id = 0";
								$query_seg = $this->db->query($sql_seg);
								if ($query_seg->num_rows() > 0) { $rd_segment = $query_seg->row(); }
                                /* ./ SEGMENTS */
                                /* IMAGE 
								$sql_img = "SELECT id FROM tbl_rd_image where report_id = ".$data->id;
								$query_img = $this->db->query($sql_img);
								if ($query_img->num_rows() > 0) { $rd_image = "<i class=\"fa fa-image\"></i><br> Edit"; } else {$rd_image = "<i class=\"fa fa-plus\"></i><br> Add";}
                                 ./ IMAGE */
                                /* Market Insight */
                                $market_insight = "SELECT id FROM tbl_rd_market_insight_data where report_id = ".$data->id;
								$query_market_insight = $this->db->query($market_insight);
								if ($query_market_insight->num_rows() > 0) { $insight_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$insight_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* Report DROs */
                                $dro_reports = "SELECT id FROM tbl_rd_dro_data where report_id = ".$data->id;
								$query_dro_reports = $this->db->query($dro_reports);
                                if ($query_dro_reports->num_rows() > 0) { $dro_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$dro_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* Segment Overview */
                                $segment_overview = "SELECT id FROM tbl_rd_segment_overview where report_id = ".$data->id;
								$query_segment_overview = $this->db->query($segment_overview);
                                if ($query_segment_overview->num_rows() > 0) { $segment_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$segment_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* PR2 Writeup */
                                $pr2_reports = "SELECT id FROM tbl_rd_pr2_data where report_id = ".$data->id;
								$query_pr2_reports = $this->db->query($pr2_reports);
                                if ($query_pr2_reports->num_rows() > 0) { $pr2_reports_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$pr2_reports_status = "<i class=\"fa fa-plus\"></i><br>Add";}
								/* SCOPE */
                                $ScopeList = $this->Data_model->get_scope_master();	
                                foreach($ScopeList as $scope){
                                    if($scope->id == $data->scope_id){
                                        $scope_name = $scope->name;
                                    }
                                }
                                ?>
                                <?php if($Role_id == 8){ ?>
                                <tr style="font-size: 14px;">
                                    <td><?php echo $data->id; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->title; ?></td>
                                    <?php if($query_dro_reports->num_rows() > 0){ ?>
                                    <td><a
                                            href="<?php echo base_url(); ?>admin/dro-reports/<?php echo $data->id; ?>"><b><?php echo $dro_status; ?></b></a>
                                    </td>
                                    <?php } else {?>
                                    <td><a
                                            href="<?php echo base_url(); ?>admin/dro-reports/add/<?php echo $data->id; ?>"><b><?php echo $dro_status; ?></b></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php } else { ?>
                                <tr style="font-size: 14px;">
                                    <td class="">
                                        <a href="<?php echo base_url()?>admin/generate_rd/sample_pages/?report_id=<?php echo $data->id;?>"
                                            title="Get Sample Pages"><b><i class="fa fa-download"></i> &nbsp;Sample</b>
                                        </a> <br />
                                        <a href="<?php echo base_url()?>admin/generate_rd/mail_draft/?report_id=<?php echo $data->id;?>"
                                            title="Get Sample Pages Mail Draft"><b><i class="fa fa-download"></i>
                                                &nbsp;Mail Draft</b>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $data->id; ?></td>
                                    <td><?php echo $scope_name; ?></td>
                                    <td><?php echo $data->title; ?></td>                                    
                                    <td><?php echo $data->forecast_from.'-'.$data->forecast_to; ?></td>
                                    <?php if($data->status == 3){ ?>
                                        <td class="text-center"><?php echo $rd_segment->rd_segments." segments"; ?></td>
                                        <td class="text-center"><?php echo $rd_company->rd_companies." companies"; ?></td>
                                        <?php if($query_market_insight->num_rows() > 0){ ?>
                                        <td class="text-center"><b><?php echo "Added"; ?></b></td>
                                        <?php } else { ?>
                                        <td class="text-center"><b><?php echo "NA"; ?></b></td>
                                        <?php } ?>
                                        <?php /* if($query_dro_reports->num_rows() > 0){ ?>
                                        <td class="text-center"><b><?php echo "Added"; ?></b></td>
                                        <?php }else {?>
                                        <td class="text-center"><b><?php echo "NA"; ?></b></td>
                                        <?php }  */ ?>
                                    <?php }else{ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/segment/<?php echo $data->id; ?>"><b><i
                                                    class="fa fa-pencil"></i>
                                                List</b></a><br><?php echo $rd_segment->rd_segments." segment"; ?></td>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/company/<?php echo $data->id; ?>"><b><i
                                                    class="fa fa-pencil"></i>
                                                List</b></a><br><?php echo $rd_company->rd_companies." company"; ?></td>
                                    <?php if($query_market_insight->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/market-insight/view/<?php echo $data->id; ?>"><b><?php echo $insight_status; ?></b></a>
                                    </td>
                                    <?php } else { ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/market-insight/<?php echo $data->id; ?>"><b><?php echo $insight_status; ?></b></a>
                                    </td>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php if($query_dro_reports->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/dro-reports/<?php echo $data->id; ?>"><b><?php echo $dro_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/dro-reports/add/<?php echo $data->id; ?>"><b><?php echo $dro_status; ?></b></a>
                                    </td>
                                    <?php } ?>
                                    
                                    <?php if($query_segment_overview->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/segment_overview/edit/<?php echo $data->id; ?>"><b><?php echo $segment_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/segment-overview/add/<?php echo $data->id; ?>"><b><?php echo $segment_status; ?></b></a>
                                    </td>
                                    <?php }?>
                                    <?php if($query_pr2_reports->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/pr2-reports/<?php echo $data->id; ?>"><b><?php echo $pr2_reports_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/pr2-reports/add/<?php echo $data->id; ?>"><b><?php echo $pr2_reports_status; ?></b></a>
                                    </td>
                                    <?php }  ?>
                                </tr>
                                <?php  } } ?>
                            </tbody>
                            <tfoot>
                                <?php if($Role_id == 8){ ?>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>
                                    <th>DRO</th>
                                </tr>
                                <?php } else { ?>
                                <tr style="font-size: 14px;">
                                    <th style="width: 85px;">Action</th>
                                    <th>Id</th>
                                    <th>Scope</th>
                                    <th>Title</th>                                    
                                    <th>Forecast</th>
                                    <th>Segment</th>
                                    <th>Company</th>
                                    <th>Insight</th>
                                    <th>DRO</th>
                                    <th>Overview</th>
                                    <th>PR2</th>
                                </tr>
                                <?php } ?>
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
    <strong>Copyright © 2023 <a href="#">Infinium</a>.</strong> All rights reserved.
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
         'info': true,
         'autoWidth': true */
    })
})
</script>
</body>

</html>