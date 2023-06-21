<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employee List
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
                        <h3 class="box-title"> Employee List</h3>
                        <a href="<?php echo base_url(); ?>admin/employee/add" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <?php if($massage){ ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <p><?php echo $massage; ?></p>
                    </div>
                    <?php } ?>
                    <div class="box-body">
                        <!-- Custom Filter -->
                        <div>
                            <select id='searchByDepartment'>
                                <option value=''>-- Select Department --</option>
                                <?php 
                                        foreach($department as $department){
                                        echo "<option value='".$department."'>".$department."</option>";
                                        }
                                        ?>
                            </select>
                            <select id='searchByGender'>
                                        <option value=''>-- Select Profile --</option>
                                        <?php 
                                        foreach($job_profiles as $profiles){
                                        echo "<option value='".$profiles."'>".$profiles."</option>";
                                        }
                                        ?>
                                    </select>
                        </div>
                        <!-- <table class="table">
                            <tr>
                                <td>
                                    <select id='searchByDepartment'>
                                        <option value=''>-- Select Department --</option>
                                        <?php 
                                        foreach($department as $department){
                                        echo "<option value='".$department."'>".$department."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select id='searchByGender'>
                                        <option value=''>-- Select Profile --</option>
                                        <?php 
                                        foreach($job_profiles as $profiles){
                                        echo "<option value='".$profiles."'>".$profiles."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table> -->
                        <br>

                        <table id="rddata" class="display table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Appraisal Date</th>
                                    <th>Profile</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
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
/* $(function() {
    $('#rddata').DataTable({
        'ordering': false,
    })
}); */

$(document).ready(function() {
    var dataTable = $('#rddata').DataTable({
        'ordering': false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        //'searching': false, // Remove default Search Control
        'ajax': {
            'url': '<?php echo base_url(); ?>admin/employee/filter_result',
            'data': function(data) {
                // Read values
                var job_profile = $('#searchByGender').val();
                var name = $('#searchByDepartment').val();
                // alert(job_profile);
                // Append to data
                data.searchByGender = job_profile;
                data.searchByDepartment = name;
            },
            dataType: 'json'

        },
        'columns': [{
                data: 'emp_code'
            },
            {
                data: 'emp_name'
            },
            {
                data: 'joining_date'
            },
            {
                data: 'appraisal_date'
            },
            {
                data: 'job_profile'
            },
            {
                data: 'department'
            },
        ]
    });

    $('#searchByDepartment').change(function() {
        dataTable.draw();
    });

    $('#searchByGender').change(function() {
        dataTable.draw();
    });
});
</script>
</body>

</html>