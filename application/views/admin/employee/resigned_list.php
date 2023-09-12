<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employee Inactive List
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
                        <h3 class="box-title"> Employee Inactive List</h3>
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
                        <table id="rddata" class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Resign Date</th>
                                    <th>Profile</th>
                                    <!-- <th>Vol</th> -->
                                    <th>Employment</th>
                                    <th>Salary Breakup</th>
                                    <th>Bank A/C</th>
                                    <th>Documents</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sr = 1; foreach($employee_details as $data){ 
                                 /* Employment */
                                $Employment_details = "SELECT * FROM tbl_emp_employment where emp_id = ".$data->id;
                                $query_employment_details = $this->db->query($Employment_details);
                                if ($query_employment_details->num_rows() > 0) { 
                                    $employment_status = "<i class=\"fa fa-file\"></i><br>View"; 
                                } else {
                                    $employment_status = "<i class=\"fa fa-plus\"></i><br>Add";
                                }
                                 /* ./ Employment */
                                /* Permant Salary breakup */
                                $salary_details = "SELECT * FROM tbl_emp_salary_permanent where emp_id = ".$data->id;
                                $query_psalary_details = $this->db->query($salary_details);
                               
                                /* ./ Permant Salary breakup */
                                /* temporary Salary breakup */
                                $salary_details = "SELECT * FROM tbl_emp_salary_temporary where emp_id = ".$data->id;
                                $query_tsalary_details = $this->db->query($salary_details);
                                if($query_psalary_details->num_rows() > 0 || $query_tsalary_details->num_rows() > 0) { $salary_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$salary_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* ./ temporary Salary breakup  */

                                /* Bank A/C */
                                $bank_details = "SELECT * FROM tbl_emp_bank_details where emp_id = ".$data->id;
                                $query_bank_details = $this->db->query($bank_details);
                                if($query_bank_details->num_rows() > 0) { $bank_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$bank_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* ./ Bank A/C  */

                                /* Documents */
                                $documents_details = "SELECT * FROM tbl_emp_document where emp_id = ".$data->id;
                                $query_documents_details = $this->db->query($documents_details);
                                if($query_documents_details->num_rows() > 0) { $document_status = "<i class=\"fa fa-file\"></i><br>View"; } else {$document_status = "<i class=\"fa fa-plus\"></i><br>Add";}
                                /* ./ Documents  */

                                /* Employee full name */
                                $full_name = $data->prefix.' '.$data->first_name.' '.$data->middle_name.' '.$data->last_name;
                                ?>
                                <tr style="font-size: 14px;">
                                    <td class="text-center"><?php echo $sr; ?></td>
                                    <td class="text-center"><?php echo $data->emp_code; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td class="text-center"><?php echo date("d-m-Y", strtotime($data->joining_date)); ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($data->resignation_date)); ?></td>
                                    <td><?php echo $data->job_profile; ?></td>
                                    <?php if($data->user_type == "Fresher"){ ?>
                                    <td class="text-center"><b><?php echo $data->user_type; ?></b>
                                    </td>
                                    <?php } else if($query_employment_details->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/employment_list/<?php echo $data->id; ?>"><b><?php echo $employment_status; ?></b></a>
                                    </td>
                                    <?php } else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/add_employment/<?php echo $data->id; ?>"><b><?php echo $employment_status; ?></b></a>
                                    </td>
                                    <?php }?>
                                    <?php if($query_psalary_details->num_rows() > 0 || $query_tsalary_details->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/salary_list/<?php echo $data->id; ?>"><b><?php echo $salary_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/add_salary/<?php echo $data->id; ?>"><b><?php echo $salary_status; ?></b></a>
                                    </td>
                                    <?php } ?>
                                    <?php if($query_bank_details->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/bank_list/<?php echo $data->id; ?>"><b><?php echo $bank_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/add_bank/<?php echo $data->id; ?>"><b><?php echo $bank_status; ?></b></a>
                                    </td>
                                    <?php }?>
                                    <?php if($query_documents_details->num_rows() > 0){ ?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/document_list/<?php echo $data->id; ?>"><b><?php echo $document_status; ?></b></a>
                                    </td>
                                    <?php }else {?>
                                    <td class="text-center"><a
                                            href="<?php echo base_url(); ?>admin/employee/add_document/<?php echo $data->id; ?>"><b><?php echo $document_status; ?></b></a>
                                    </td>
                                    <?php }?>
                                    <td><a href="<?php echo base_url(); ?>admin/employee/edit/<?php echo $data->id; ?>"
                                            class="btn btn-warning"><b><i class="fa fa-edit"></i></b></a> |
                                        <a href="<?php echo base_url(); ?>admin/employee/view/<?php echo $data->id; ?>"
                                            class="btn btn-info"><b><i class="fa fa-eye"></i></b></a> 
                                        <!-- <a href="<?php echo base_url(); ?>admin/report/edit/<?php echo $data->id; ?>" class="btn btn-success"><b><i class="fa fa-edit"></i></b></a> |  -->
                                        <!-- <a href="<?php echo base_url(); ?>admin/employee/delete_employee/<?php echo $data->id; ?>"
                                            class="btn btn-danger"><b><i class="fa fa-trash"></i></b></a> -->
                                    </td>
                                </tr>
                                <?php $sr++; } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Id</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Resign Date</th>
                                    <th>Profile</th>
                                    <!-- <th>Vol</th> -->
                                    <th>Employment</th>
                                    <th>Salary Breakup</th>
                                    <th>Bank A/C</th>
                                    <th>Documents</th>
                                    <th width="100px">Action</th>
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
        'ordering': false,
    })
})
</script>
</body>

</html>