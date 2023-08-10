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
                        <span class="pull-right text-blue"><b><i class="fa fa-envelope"></i> Email Formats:
                            <?=$mail_count ?></b></span>
                        <span class="pull-right text-blue"><b><i class="fa fa-institution"></i> Companies:
                            <?=$company_count ?></b> || &nbsp; </span>  
                        <span class="pull-right text-red"><b><i class="fa fa-envelope"></i> Spam Mail:
                            <?=$spam_mail_count ?> || &nbsp; </b></span>  
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
                                            placeholder="Email" autofocus />
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
                    <form action="<?php echo base_url(); ?>admin/Spam_Mail/insert" method="post" class="form-horizontal"
                        autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-14">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Unsubscribe Domain<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="email_id" id="email_id"
                                            placeholder="Domain" />
                                        <input type="hidden" name="type" id="type" value="domain"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <center><input type="submit" class="btn btn-info pull-right" value="Submit">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><div class="box-header with-border">
                        <h1 class="box-title text-blue"> Verify Mail</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/spam_mail/export_data" method="post"
                        class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputImage" class="col-sm-1 control-label">Export File</label>
                                    <div class="col-md-9">
                                        <input type="file" name="xl_file" class="form-control">
                                        <input type="hidden" name="xl_file" class="form-control-file" id="xl_file">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" value="Export Excel" class="btn btn-info pull-left"
                                            value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="box-header with-border">
                        <h1 class="box-title text-blue"> Email Formater</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/Spam_Mail/format_insert" method="post"
                        class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-14">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Company Name<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="company" id="company"
                                            placeholder="Company" required/>
                                    </div>
                                    <label class="control-label col-md-2">Domain<span class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="domain" id="domain"
                                            placeholder="Domain" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Email 1 <span class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email_address[]" id="email_address"
                                            placeholder="Email Address" required/>
                                        <input type="hidden" name="type" id="type" value="spam" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="email_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                </div>
                                <span id="Shipping"></span>
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" class="form-control" id="id"
                                    value="<?php if(!empty($followup_record)){echo $followup_record->id;}?>">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    jQuery(function() {
    var counter = 1;
    var i = 1;
    jQuery('#email_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_' + counter +
            '"><label class="control-label col-md-2">Email ' + counter +
            '</label> <div class="col-md-8"><input type="text" name="email_address[]" class="form-control" placeholder="Email Address '+ counter +'" ></div><div class="col-md-1"><center><a id="Rmv_' +
            counter + '" href="javascript:RemoveRow(' + counter +
            ');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Shipping').append(newRow);
        i++;
        console.log(newRow);
    });
});

function RemoveRow(rowID) {
    jQuery('#Row_' + rowID).remove();

}
</script>

<?php $this->load->view('admin/footer.php'); ?>