<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Spam Mail
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
                        <h1 class="box-title"> Spam Mail</h1>
                        <span class="pull-right text-red"><b><i class="fa fa-envelope"></i> Spam Mail:
                            <?=$spam_mail_count ?></b></span>  
                            <span class="pull-right text-red"><b><i class="fa fa-envelope"></i> Unsubscribe Mail:
                            <?=$unsubscribe_mail_count ?></b> || &nbsp; </span>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/Spam_Mail/insert" method="post" class="form-horizontal"
                        autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-14">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Spam Email<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email_id" id="email_id"
                                            placeholder="Email" autofocus/>
                                        <input type="hidden" name="type" id="type" value="spam" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <center><input type="submit" class="btn btn-info pull-right" value="Submit">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="<?php echo base_url(); ?>admin/Spam_Mail/insert" method="post" class="form-horizontal"
                        autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-14">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Unsubscribe Email<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email_id" id="email_id"
                                            placeholder="Email" />
                                        <input type="hidden" name="type" id="type" class="form-control">
                                        <input type="hidden" name="type" id="type" value="unsubscribe"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <center><input type="submit" class="btn btn-info pull-right" value="Submit">
                                        </center>
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

<?php $this->load->view('admin/footer.php'); ?>