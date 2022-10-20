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
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
									<th>Title</th>
									<th>Scope</th>
									<th>Cat</th>
									<th>Forecast</th>
									<!-- <th>Vol</th> -->
									<th>Company</th>
									<th>Segment</th>
									<th>Status</th>
									<th>Image</th>
									<th>Country</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($Global_Rds as $data){ ?>

                                    <tr style="font-size: 14px;">
                                        <td class="text-center"><?php echo $data->id; ?></td>
                                        <td><?php echo $data->name; ?></td>
                                        <td class="text-center"><?php echo $data->scope_id; ?></td>
                                        <td class="text-center"><?php echo $data->category_id; ?></td>
                                        <td><?php echo $data->forecast_from.'-'.$data->forecast_to; ?></td>
                                        <!--<td><?php echo $data->analysis_from.'-'.$data->analysis_to; ?></td>-->
                                        <!-- <td><?php echo $data->is_volume_based; ?></td> -->
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/company/<?php echo $data->id; ?>"><b><i class="fa fa-pencil"></i> List</b></a></td>
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/segment/<?php echo $data->id; ?>"><b><i class="fa fa-pencil"></i> List</b></a></td>
										<td class="text-center"><?php echo $data->status; ?></td>
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/image/<?php echo $data->id; ?>"><b><i class="fa fa-image"></i>  Image</b></a></td>
                                        <?php if($data->country_status == 1){ ?>
                                            <td class="text-center text-yellow"><i class="fa fa-check-circle"></i><b> Created</b></td>
                                        <?php }else {?>                                        
                                        <td class="text-center"><a href="<?php echo base_url(); ?>admin/counry_rd/create/<?php echo $data->id; ?>"><b><i class="fa fa-globe"></i>  Create</b></a></td>
                                        <?php }?>
                                        <td><a href="<?php echo base_url(); ?>admin/report/edit/<?php echo $data->id; ?>" class="btn btn-success"><b><i class="fa fa-edit"></i></b></a> | 
											<a href="<?php echo base_url(); ?>admin/report/delete/<?php echo $data->id; ?>" class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a>
										</td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
									<th>Title</th>
									<th>Scope</th>
									<th>Cat</th>
									<th>Forecast</th>
									<!-- <th>Analysis</th> -->
									<!-- <th>Vol</th> -->
									<th>Company</th>
									<th>Segment</th>									
									<th>Status</th>
									<th>Image</th>
									<th>Country</th>
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
    <strong>Copyright © 2022 <a href="#">Infinium</a>.</strong> All rights reserved.
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
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
  </script>
  
<script>
  $(function () {
    $('#rddata').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
        </body>
</html>