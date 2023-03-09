<?php $this->load->view('admin/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User List
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
                        <h3 class="box-title">User List</h3>
                        <a href="<?php echo base_url(); ?>admin/register_user/add"
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
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Type</th>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>Head</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i=1;
                        foreach($user_details as $list){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $list->user_type; ?></td>
                                    <td><?php echo $list->full_name; ?></td>
                                    <td><?php echo $list->department; ?></td>
                                    <td><?php echo $list->head_name; ?></td>
                                    <td> 
                                        <form
                                            action="<?php echo base_url();?>admin/register_user/edit/<?php echo $list->id;?>"
                                            method="post">
                                            <input type="hidden" id="emp_id" name="emp_id"
                                                value="<?php echo $list->emp_id; ?>">
                                            <input type="submit" class="btn btn-warning" value="Edit">
                                        </form>
                                    </td>                                   
                                    <td><a href="<?php echo base_url();?>admin/register_user/delete/<?php echo $list->id;?>"
                                            class="btn btn-danger" type="submit">Delete</a></td>
                                    <td><a href="<?php echo base_url();?>admin/register_user/email/<?php echo $list->id;?>"
                                            type="submit">Send Mail</a></td>
                            
                                </tr>
                                <?php } ?>
                            </tbody>
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
</div>


</body>

</html>