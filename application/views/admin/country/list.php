<?php $this->load->view('admin/header.php'); ?>
	
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Country List
                <small></small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Country</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            
<div class='row'>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="box-title">Country List</h1>
                <a href="<?php echo base_url(); ?>admin/country/add" class="btn btn-primary pull-right">
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
            <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                <div class="box-body">
                     <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Active</th>
                        
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                         foreach($list_country as $list){ ?>                                               
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $list->name; ?></td>
                            <td><?php echo $list->parent; ?></td>                            
                            <td><?php echo $list->active; ?></td>
                            
                            <td><a href="<?php echo base_url();?>admin/country/edit/<?php echo $list->id;?>" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="<?php echo base_url() . "admin/country/country_delete/" . $list->id; ?>" class="btn btn-danger" type="submit">Delete</a>
                                
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