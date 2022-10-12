<?php $this->load->view('admin/header.php'); ?>
	
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Scope List
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
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="box-title">Scope List</h1>
                <a href="<?php echo base_url(); ?>admin/scope/add" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
                        <form action="http://localhost/testapp/public/scopes" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                <div class="box-body">
                     <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent</th>
                        
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                                               
                        <tr>
                            <td>1</td>
                            <td>Global</td>                            
                            <td>0</td>
                            
                            <td><a href="http://localhost/testapp/public/superadmin/scopes/1/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/scopes/1" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                                               
                        <tr>
                            <td>2</td>
                            <td>North America</td>                            
                            <td>1</td>
                            
                            <td><a href="http://localhost/testapp/public/superadmin/scopes/2/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/scopes/2" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                                               
                        <tr>
                            <td>3</td>
                            <td>Europe</td>                            
                            <td>1</td>
                            
                            <td><a href="http://localhost/testapp/public/superadmin/scopes/3/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/scopes/3" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                                               
                        <tr>
                            <td>4</td>
                            <td>Asia Pacific</td>                            
                            <td>1</td>
                            
                            <td><a href="http://localhost/testapp/public/superadmin/scopes/4/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/scopes/4" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
                                               
                        <tr>
                            <td>5</td>
                            <td>RoW</td>                            
                            <td>1</td>
                            
                            <td><a href="http://localhost/testapp/public/superadmin/scopes/5/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/scopes/5" method="post">
                                <input type="hidden" name="_token" value="Sk3doWItxaoAFLb19cHZYUeNW7yMPNDp1QqkSi60">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>
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

<?php $this->load->view('admin/footer.php'); ?>