<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Salary List
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
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Salary List</h3>
                        <a href="<?php echo base_url(); ?>admin/employee/add_salary/<?php echo $emp_id; ?>"
                            class="btn btn-primary pull-right">
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
                        <table class="table table-striped">
                            <!-- Permanant Salary -->
                            <?php if($p_salary_details){ ?>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Year</th>
                                    <th>Gross Salary</th>
                                    <th colspan="2"  class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($p_salary_details as $list){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list->salary_year; ?></td>
                                    <td><?php echo $list->gross_salary; ?></td>
                                   <!--  <td>
                                        <a href="<?php echo base_url();?>admin/employee/edit_salary/<?php echo $list->id;?>"
                                            class="btn btn-warning" type="submit"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url();?>admin/employee/delete_salary/<?php echo $list->id;?>"
                                            class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                    </td> -->
                                    <td class="text-center">
                                        <form
                                            action="<?php echo base_url();?>admin/employee/edit_salary/<?php echo $list->emp_id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-warning btn-xs" value="Edit">
                                        </form>
                                        <form
                                            action="<?php echo base_url();?>admin/employee/delete_salary/<?php echo $list->emp_id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-danger btn-xs" value="Delete">
                                        </form> 
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <?php } ?>
                            <!-- /.Permanant Salary -->
                            <!-- Temprory Salary -->
                            <?php if($t_salary_details){ ?>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Year</th>
                                    <th>Net Salary</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($t_salary_details as $list){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list->salary_year; ?></td>
                                    <td><?php echo $list->gross_salary; ?></td>
                                    <!-- <td><a href="<?php echo base_url();?>admin/employee/edit_salary/<?php echo $list->id;?>" class="btn btn-warning">Edit</a></td> -->
                                    <!--  <td>
                                        <form
                                            action="<?php echo base_url();?>admin/employee/edit_salary/<?php echo $list->id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-warning" value="Edit">
                                        </form>
                                    </td> -->
                                    <td class="text-center">
                                        <form
                                            action="<?php echo base_url();?>admin/employee/edit_salary/<?php echo $list->id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-warning" value="Edit">
                                        </form>
                                    </td>
                                    <td>
                                        <form
                                            action="<?php echo base_url();?>admin/employee/delete_salary/<?php echo $list->id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form> 
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <?php } ?>
                            <!-- /.Temprory Salary -->
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
        'ordering': false,
    })

})
</script>
</body>

</html>