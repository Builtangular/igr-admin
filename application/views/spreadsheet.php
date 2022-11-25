<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            RD List
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
                        <h3 class="box-title">RD List</h3>
                        <form action="<?php echo  base_url('admin/spreadsheet/export'); ?>" method="post" >
                       
                                <input type="submit" value="Export Excel" class="btn btn-primary pull-right"></td>
                   
                        <input type="hidden" name="from_date" class="form-control" value="<?php echo $from_date; ?>">
                        <input type="hidden" name="to_date" class="form-control" value="<?php echo $to_date; ?>">
                    </form>
                    </div>
					<!-- <form method="post" action="<?php echo form_open_multipart('admin/spreadsheet/export',array('name' => 'spreadsheet'));?>"> -->
                    <div class="box-body">
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                <th class="header">Title</th>                      
                                <th class="header">Sku</th>                      
                                <th class="header">Category ID</th>                      
                                <th class="header">Scope ID</th>                      
                                <th class="header">URL</th>                      
                                <th class="header">Forecast From</th>                      
                                <th class="header">Forecast To</th>                      
                                <th class="header">Analysis From</th>                      
                                <th class="header">Analysis To</th>                      
                                <th class="header">Value CAGR</th>                      
                                <th class="header">Value Unit</th>                      
                                <th class="header">Is Valume Based</th>                      
                                <th class="header">Valume Unit</th>                      
                                <th class="header">Valume CAGR</th>                      
                                <th class="header">SingleUser Price</th>                      
                                <th class="header">Enterprise Price</th>                      
                                <th class="header">Datasheet Price</th>                      
                                <th class="header">CAGR Market Value</th>   
                                <th class="header">Report Defination</th>                      
                                <th class="header">Report Description</th>                      
                                <th class="header">Executive Summary DRO</th>                      
                                <th class="header">Executive Summary Regional Description</th>
                                <th class="header">Largest Region</th>                      
                                <th class="header">Country Status</th>                      
                                <th class="header">Status</th>                      
                                <th class="header">Created User</th>                      
                                <th class="header">Field</th>                      
                                <th class="header">Field1</th>                      
                                <th class="header">Field2</th>                      
                                <th class="header">Field3</th>                      
                                <th class="header">Created At</th>                      
                                <th class="header">Updated At</th> 
                            </tr>
                                <tbody>
                                    <?php
                                    if (isset($list_data) && !empty($list_data)) {
                                        foreach ($list_data as $key => $list) {
                                            ?>
                                            <tr>
                                                <td><?php echo $list->name; ?></td>   
                                                <td><?php echo $list->title; ?></td> 
                                                <td><?php echo $list->sku; ?></td> 
                                                <td><?php echo $list->category_id; ?></td> 
                                                <td><?php echo $list->scope_id; ?></td> 
                                                <td><?php echo $list->url; ?></td> 
                                                <td><?php echo $list->forecast_from; ?></td> 
                                                <td><?php echo $list->forecast_to; ?></td> 
                                                <td><?php echo $list->analysis_from; ?></td> 
                                                <td><?php echo $list->analysis_to; ?></td> 
                                                <td><?php echo $list->value_cagr; ?></td> 
                                                <td><?php echo $list->value_unit; ?></td> 
                                                <td><?php echo $list->is_volume_based; ?></td> 
                                                <td><?php echo $list->volume_based_unit; ?></td> 
                                                <td><?php echo $list->volume_based_cagr; ?></td> 
                                                <td><?php echo $list->singleuser_price; ?></td> 
                                                <td><?php echo $list->enterprise_price; ?></td> 
                                                <td><?php echo $list->datasheet_price; ?></td> 
                                                <td><?php echo $list->cagr_market_value; ?></td> 
                                                <td><?php echo $list->report_definition; ?></td> 
                                                <td><?php echo $list->report_description; ?></td> 
                                                <td><?php echo $list->executive_summary_DRO; ?></td> 
                                                <td><?php echo $list->executive_summary_regional_description; ?></td> 
                                                <td><?php echo $list->largest_region; ?></td> 
                                                <td><?php echo $list->country_status; ?></td> 
                                                <td><?php echo $list->status; ?></td> 
                                                <td><?php echo $list->created_user; ?></td> 
                                                <td><?php echo $list->field; ?></td> 
                                                <td><?php echo $list->field1; ?></td> 
                                                <td><?php echo $list->field2; ?></td> 
                                                <td><?php echo $list->field3; ?></td> 
                                                <td><?php echo $list->created_at; ?></td> 
                                                <td><?php echo $list->updated_at; ?></td> 
                                            
                            </tr>
                                    <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">There is no employee.</td>    
                                        </tr>
                                    <?php } ?>
                        
                                </tbody>
                        </table>
                        
                        <!-- <?php echo form_open_multipart('admin/spreadsheet/export',array('name' => 'spreadsheet')); ?> -->
                      
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
    // $('#rddata').DataTable()
    $('#rddata').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
        </body>
</html>