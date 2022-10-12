<?php $this->load->view('admin/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Report List
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
                        <h1 class="box-title">Report List</h1>
                        <a href="<?php echo base_url(); ?>admin/report/add"
                            class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/report" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="E2lWHFIYSGpFwclGKM4XZgfX9bcT6dV9L5qsJ9bb">
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>scope</th>
                                        <th>forcast</th>
                                        <th>analysis</th>
                                        <th>Volume</th>
                                        <th>Company</th>
                                        <th>Data</th>
                                        <th>graphs</th>
                                        <th>Piecharts</th>
                                        <th>Segment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td><a
                                                href="http://localhost/testapp/public/superadmin/report/editReport/1">1</a>
                                        </td>

                                        <td>Compostable Tableware Market</td>
                                        <td>1</td>
                                        <td>2018 - 2024 </td>
                                        <td>2016 - 2024</td>
                                        <td>No</td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/company/1"
                                                class="btn btn-warning">Company</a></td>
                                        <td>Imported</td>
                                        <td> <a href="http://localhost/testapp/public/superadmin/report/generatereport/1"
                                                class="btn btn-link">Generate</a>
                                        </td>
                                        <td> <a href="http://localhost/testapp/public/superadmin/report/generatepiereport/1"
                                                class="btn btn-link">Generate</a>
                                        </td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/segments/1"
                                                class="btn btn-link">List</a></td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/reportreview/1"
                                                class="btn btn-success">Export</a></td>
                                        <!--<td></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/segments/1" class="btn btn-warning">Segment</a></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/company/1" class="btn btn-warning">Company</a></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/1/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/report/1" method="post">
                                <input type="hidden" name="_token" value="E2lWHFIYSGpFwclGKM4XZgfX9bcT6dV9L5qsJ9bb">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/reporthierarchy/1" class="btn btn-warning">Get Reports</a></td>
                            -->
                                    </tr>

                                    <tr>
                                        <td><a
                                                href="http://localhost/testapp/public/superadmin/report/editReport/2">2</a>
                                        </td>

                                        <td>Industrial Scrap Market</td>
                                        <td>1</td>
                                        <td>2022 - 2028 </td>
                                        <td>2020 - 2028</td>
                                        <td>No</td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/company/2"
                                                class="btn btn-warning">Company</a></td>
                                        <td> <a href="http://localhost/testapp/public/superadmin/report/reporthierarchy/2"
                                                class="btn btn-link">Import Now</a>
                                        </td>
                                        <td> <a href="http://localhost/testapp/public/superadmin/report/generatereport/2"
                                                class="btn btn-link">Generate</a>
                                        </td>
                                        <td> <a href="http://localhost/testapp/public/superadmin/report/generatepiereport/2"
                                                class="btn btn-link">Generate</a>
                                        </td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/segments/2"
                                                class="btn btn-link">List</a></td>
                                        <td><a href="http://localhost/testapp/public/superadmin/report/reportreview/2"
                                                class="btn btn-success">Export</a></td>
                                        <!--<td></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/segments/2" class="btn btn-warning">Segment</a></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/company/2" class="btn btn-warning">Company</a></td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/2/edit" class="btn btn-warning">Edit</a></td>
                            <td>
                            <form action="http://localhost/testapp/public/superadmin/report/2" method="post">
                                <input type="hidden" name="_token" value="E2lWHFIYSGpFwclGKM4XZgfX9bcT6dV9L5qsJ9bb">                                <input type="hidden" name="_method" value="DELETE">

                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                            <td><a href="http://localhost/testapp/public/superadmin/report/reporthierarchy/2" class="btn btn-warning">Get Reports</a></td>
                            -->
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