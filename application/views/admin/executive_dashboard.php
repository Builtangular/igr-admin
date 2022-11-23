<?php $this->load->view('admin/user_header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin Dashboard
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
        <div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-file-pdf-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Global Reports</span>
<span class="info-box-number"><?=$global_count ?><small></small></span>
</div>

</div>

</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Country Reports</span>
<span class="info-box-number"><?=$country_count ?></span>
</div>

</div>

</div>


<div class="clearfix visible-sm-block"></div>
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-file-excel-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Region Reports</span>
<span class="info-box-number"><?=$region_count ?></span>
</div>

</div>

</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-file-photo-o"></i></span>
<div class="info-box-content">
<span class="info-box-text">Infographics</span>
<span class="info-box-number"><?=$info_count ?></span>
</div>

</div>

</div>

</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>