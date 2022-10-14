<?php $this->load->view('admin/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create Company
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
                <h1 class="box-title">Create Company</h1>
            </div>
            <form action="http://localhost/testapp/public/superadmin/report/storeCompany/1" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="54wT4ss8fqeQztOl5loAI98CIPsz3UINrQh3dmLE">                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>                    
                    
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>