<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Export File
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Export File</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/spam_mail/export_data" method="post"
                        class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-2 control-label">Export File</label>
                                    <div class="col-md-9">
                                        <input type="file" name="xl_file" class="form-control">
                                        <input type="hidden" name="email_address" class="form-control-file"
                                            id="email_address">
                                        <input type="hidden" name="status" id="status" class="form-control" value="1">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" value="Export Excel" class="btn btn-info pull-left"
                                            value="Submit">
                                        <!-- <input type="hidden" name="xl_file" id="xl_file" value="<?php if(!empty($email_data)){echo $email_data->id;}?>" class="form-control"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
$(function() {
    // $('#rddata').DataTable()
    $('#rddata').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    })
})
</script>
<?php $this->load->view('admin/footer.php'); ?>