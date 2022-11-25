<?php $this->load->view('admin/header.php'); ?>
	
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Country List
                <small></small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Country</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            
<div class='row'>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="box-title">Country List</h1>
                <a href="<?php echo base_url(); ?>admin/country/add" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
            <?php } ?>
            <form action="http://localhost/testapp/public/scopes" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                <div class="box-body">
                     <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Scope</th>
                        <th>Cat</th>
                        <th>Forecast</th>
                        <!-- <th>Vol</th> -->
                        <th>Company</th>
                        <th>Segment</th>
                        <!-- <th>Status</th> -->
                        <th>Insight</th>
                        <th>DRO</th>
                        <th>Overview</th>
                        <th>PR2</th>
                        <th>Image</th>
                        <th>Country</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($Global_Rds as $data){ /* $sql ="SELECT * FROM tbl_rd_companies where report_id = ".$data->id; */ $sql = "SELECT COUNT(report_id) AS rd_companies FROM tbl_rd_companies where report_id = ".$data->id;
								$query = $this->db->query($sql);
								if ($query->num_rows() > 0) { $rd_company = $query->row(); }
								$sql_seg = "SELECT COUNT(report_id) AS rd_segments FROM tbl_rd_segments where report_id = ".$data->id." And parent_id = 0";
								$query_seg = $this->db->query($sql_seg);
								if ($query_seg->num_rows() > 0) { $rd_segment = $query_seg->row(); }
								$sql_img = "SELECT * FROM tbl_rd_image where report_id = ".$data->id;
								$query_img = $this->db->query($sql_img);
								/* if ($query_img->num_rows() > 0) { $rd_image = "<img src=\"http://localhost/igr_admin/assets/admin/img-rd/global-automotive-display-system-market.jpg\" class=\"fa \" alt=\"User Image\" style=\"height:20px; width: 40px;\"> <br> Edit"; } else {$rd_image = "<i class=\"fa fa-plus\"></i><br> Add";} */
								if ($query_img->num_rows() > 0) { $rd_image = "<i class=\"fa fa-image\"></i><br>"; } else {$rd_image = "NA";}
                                $market_insight = "SELECT * FROM tbl_rd_market_insight_data where report_id = ".$data->id;
								$query_market_insight = $this->db->query($market_insight);
								if ($query_market_insight->num_rows() > 0) { $insight_status = "Yes"; } else {$insight_status = "NA";}
                                /* Report DROs */
                                $dro_reports = "SELECT * FROM tbl_rd_dro_data where report_id = ".$data->id;
								$query_dro_reports = $this->db->query($dro_reports);
                                if ($query_dro_reports->num_rows() > 0) { $dro_status = "Yes"; } else {$dro_status = "NA";}
                                /* Segment Overview */
                                $segment_overview = "SELECT * FROM tbl_segment_overview where report_id = ".$data->id;
								$query_segment_overview = $this->db->query($segment_overview);
                                if ($query_segment_overview->num_rows() > 0) { $segment_status = "Yes"; } else {$segment_status = "NA";}
                                /* PR2 Writeup */
                                $pr2_reports = "SELECT * FROM tbl_rd_pr2_data where report_id = ".$data->id;
								$query_pr2_reports = $this->db->query($pr2_reports);
                                if ($query_pr2_reports->num_rows() > 0) { $pr2_reports_status = "Yes"; } else {$pr2_reports_status = "NA";}
								?> 
                                                                     
                        <tr>
                            <!-- <td><?php echo $i++; ?></td> -->
                            <td><?php echo $data->id; ?></td>
                            <td><?php echo $data->title; ?></td>                            
                            <td><?php echo $data->scope_id; ?></td>
                            <td><?php echo $data->category_id; ?></td>
                            <td><?php echo $data->forecast_from.'-'.$data->forecast_to; ?></td>
                            <td><?php echo $rd_company->rd_companies;?></td>
                            <td><?php echo $rd_segment->rd_segments; ?></td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/market-insight/view/<?php echo $data->id; ?>"><b><?php echo $insight_status; ?></b></a></td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/dro-reports/<?php echo $data->id; ?>"><b><?php echo $dro_status; ?></b></a></td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/segment_overview/edit/<?php echo $data->id; ?>"><b><?php echo $segment_status; ?></b></a></td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/pr2-reports/<?php echo $data->id; ?>"><b><?php echo $pr2_reports_status; ?></b></a></td>
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/image/<?php echo $data->id; ?>"><b><?php echo $rd_image; ?></b></a></td>
                            <?php if($data->country_status == 1){ ?>
                            <td class="text-center text-yellow"><i class="fa fa-check-circle"></i><b> Created</b></td>
                            <?php }else { ?> 
                            <td class="text-center"><a href="<?php echo base_url(); ?>admin/country_rd/create/<?php echo $data->id; ?>"><b><i class="fa fa-globe"></i>  Create</b></a></td>                                        
                            <?php }?>
                            <form action="" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
                
            </form>
        </div>
    </div>
</div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<script>
$("#del_all").on('click', function(e) {
	e.preventDefault();
	var checkValues = $('.checkbox1:checked').map(function()
    {
		return $(this).val();
	}).get();
	console.log(checkValues);
			
	$.each( checkValues, function( i, val ) {
	$("#"+val).remove();
	});
//                    return  false;
	$.ajax({
	url: '<?php echo base_url(); ?>admin/Master/delete',
	type: 'post',
	data: 'ids=' + checkValues
	}).done(function(data) {
    $("#respose").html(data);
	$('#selecctall').attr('checked', false);
	window.location.reload();
	});
});
</script>
<?php $this->load->view('admin/footer.php'); ?>