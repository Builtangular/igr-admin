<?php $this->load->view('admin/report-header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employment List
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
                        <h3 class="box-title"> Employment List</h3>
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
                                    <th>Generate</th>
                                    <th>Id</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Designation</th>
                                    <th>Resignation Date</th>
                                    <!-- <th>Vol</th> -->
                                    <!--  <th>Employment</th>
                                    <th>Salary Breakup</th>
                                    <th>Bank A/C</th>
                                    <th>Documents</th> -->
                                    <th>Generate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($employee_details as $data){ 
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
                                    <td class="">
                                        <a href="<?php echo base_url(); ?>admin/employee/offer_letter/?emp_id=<?php echo $data->id;?>"
                                            title="Download Offer Letter with Letter Head"><b><i class="fa fa-download"></i> &nbsp;Offer Letter</b>
                                        </a> <br />
                                        <a href="<?php echo base_url()?>admin/employee/printable_offer_letter/?emp_id=<?php echo $data->id;?>"
                                            title="Download Printable Offer Letter"><b><i class="fa fa-download"></i> &nbsp;Offer Letter (Printable)</b>
                                        </a> 
                                    </td>
                                    <td class="text-center"><?php echo $data->id; ?></td>
                                    <td class="text-center"><?php echo $data->emp_code; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td class="text-center"><?php echo date("d-m-Y", strtotime($data->joining_date)); ?>
                                    </td>
                                    <td class=""><?php echo $data->job_profile; ?></td>
                                    <td class="text-center"><?php echo $data->resignation_date; ?></td>
                                    <td class="">                                      
                                        <a href="<?php echo base_url()?>admin/employee/releaving_letter/?emp_id=<?php echo $data->id;?>"
                                            title="Get TOC"><b><i class="fa fa-download"></i> &nbsp;Experience/Relieving</b>
                                        </a> <br />
                                        <a href="<?php echo base_url()?>admin/employee/printable_releaving_letter/?emp_id=<?php echo $data->id;?>"
                                            title="Get Sample Pages"><b><i class="fa fa-download"></i> &nbsp;Experience/Relieving (Printable)</b>
                                        </a> 
                                    </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-size: 14px;">
                                    <th>Generate</th>
                                    <th>Id</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Joining Date</th>
                                    <th>Designation</th>
                                    <th>Resignation Date</th>
                                    <!-- <th>Vol</th> -->
                                    <!-- <th>Employment</th>
                                    <th>Salary Breakup</th>
                                    <th>Bank A/C</th>
                                    <th>Documents</th> -->
                                    <th>Generate</th>
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