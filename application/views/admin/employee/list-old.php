<?php $this->load->view('admin/header.php'); ?>
	
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Employee Details List
                <small></small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            
<div class='row'>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="box-title">Employee Details List</h1>
                <a href="<?php echo base_url(); ?>admin/Employee_Details/add_emp_personal_details" class="btn btn-primary pull-right">
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
            <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                
            <div class="box-body">
                     <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Emp Code</th>
                            <th>Joining Date</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Mobile Number</th>
                            <th>Alternate Mobile Number</th>
                            <th>Personal Email Id</th>
                            <th>Official Email Id</th>
                            <th>Marital Status</th>
                            <th>Father Name</th>
                            <th>Spouse Name </th>
                            <th>Permant Address</th>
                            <th>Current Address </th>
                            <th>Relative Name </th>
                            <th>Relative Contact Number</th>
                            <th>Reference Name</th>
                            <th>Reference Number</th>
                            <th>Aadhar No</th>
                            <th>Pan No</th>
                            <th>Passport No</th>
                            <th>Termination Date</th>
                            <th>Education Type</th>
                            <th>Degree</th>
                            <th>Depatrtment</th>
                            <th>Job Profile</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                         foreach($job_list as $list){ ?>                                               
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $list->post_name; ?></td>
                            <!-- <td><?php echo $list->description; ?></td>                            
                            <td><?php echo $list->positions; ?></td>                             -->
                            <td><?php echo $list->status; ?></td>                            
                            <td><?php echo $list->active; ?></td>
                            
                            <td><a href="<?php echo base_url();?>admin/jobpost/edit/<?php echo $list->id;?>" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="<?php echo base_url() . "admin/jobpost/jobpost_delete/" . $list->id; ?>" class="btn btn-danger" type="submit">Delete</a>
                                
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