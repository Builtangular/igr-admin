<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Export Data For Selected Date
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Export RD Data For Selected Date</h1>
                    </div>
                    <form action="<?php echo base_url('admin/spreadsheet');?>" method="post" class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Choose Date</label>
                                <div class="col-md-8">
                                    <input type='text' class='datepicker' placeholder="From date" name="from_date"
                                        id='from_date' required>
                                    <input type='text' class='datepicker' placeholder="To date" name="to_date"
                                        id='to_date' required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Export MetaData For Selected Date</h1>
                    </div>
                    <form action="<?php echo base_url('admin/spreadsheet/metadata');?>" method="post"
                        class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Choose Date</label>
                                <div class="col-md-8">
                                    <input type='text' class='datepicker' placeholder="From date" name="from_date"
                                        id='from_date_reseller' required>
                                    <input type='text' class='datepicker' placeholder="To date" name="to_date"
                                        id='to_date_reseller' required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </div>
                    </form>
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

<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demo.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $('.sidebar-menu').tree()
})
</script>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function() {

    // From datepicker
    $("#from_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        onSelect: function(selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#to_date").datepicker("option", "minDate", dt);
        }
    });

    // To datepicker
    $("#to_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        onSelect: function(selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#from_date").datepicker("option", "maxDate", dt);
        }
    });

    // for metadata
    $("#from_date_reseller").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        onSelect: function(selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#to_date_reseller").datepicker("option", "minDate", dt);
        }
    });

    // To datepicker
    $("#to_date_reseller").datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        onSelect: function(selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#from_date_reseller").datepicker("option", "maxDate", dt);
        }
    });
});
</script>
</body>

</html>