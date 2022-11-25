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
                        <h1 class="box-title">Export Data For Selected Date</h1>
                    </div>
                    <form action="<?php echo base_url('admin/spreadsheet');?>" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Choose Date</label>
                                <div class="col-md-8">
                                <input type='text' class='datepicker' placeholder="From date" name="from_date" id='from_date' readonly>
                                <input type='text' class='datepicker' placeholder="To date" name="to_date" id='to_date' readonly>
                                </div>
                            </div>
                           
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>
<script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="js/datepickers.js"></script>
<script>


$(document).ready(function(){

// From datepicker
$("#from_date").datepicker({ 
   dateFormat: 'yy-mm-dd',
   changeYear: true,
   onSelect: function (selected) {
      var dt = new Date(selected);
      dt.setDate(dt.getDate() + 1);
      $("#to_date").datepicker("option", "minDate", dt);
   }
});

// To datepicker
$("#to_date").datepicker({
   dateFormat: 'yy-mm-dd',
   changeYear: true,
   onSelect: function (selected) {
      var dt = new Date(selected);
      dt.setDate(dt.getDate() - 1);
      $("#from_date").datepicker("option", "maxDate", dt);
   }
});
});


</script>