<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Market Insight
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
                        <h1 class="box-title"> Market Insight</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/market-insight/insert/<?php echo $report_id; ?>" method="post" class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Report Definition 1</label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="Report_definition[]" rows="5"
                                            class="form-control"></textarea>
                                        <span></span>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="definition_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="definition" id="definition" value="Report Definition" class="form-control">
                                </div>
                                <span id="Definition"></span>
                               <!--  Report Description -->
                                <div class="form-group">
                                    <label class="control-label col-md-2">Report Description 1<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="Report_description[]" rows="8"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="description_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="description" id="description" value="Report Description" class="form-control">
                                </div>
                                <span id="Description"></span>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Summary - DRO Para 1 <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="Executive_summary_DRO[]" rows="8"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="summary_dro_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="summary_DRO" id="summary_DRO" value="Summary DRO" class="form-control">
                                </div>
                                <span id="Summary_DRO"></span>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Summary - Regional Para 1 <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="Executive_summary_regional_description[]" rows="8"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="summary_regional_description_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="summary_regional_description" id="summary_regional_description" value="Summary Regional Description" class="form-control">
                                </div>
                                <span id="Summary_regional_description"></span>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Competitive Landscape Para 1<span
                                            class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <textarea type="text" name="competitive_landscape[]" rows="8"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <center><span type="button" class="btn btn-block btn-info"
                                                id="competitive_landscape_description_addrow"><i class="fa fa-plus"></i> Add</span></center>
                                    </div>
                                    <input type="hidden" name="competitive_landscape_type" id="competitive_landscape_type" value="Competitive Landscape" class="form-control">
                                </div>
                                <span id="Competitive_landscape_description"></span>
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
<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script>
/* add new description */
jQuery(function() {
    var counter = 1;
    var i = 2;
    jQuery('#definition_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_'+counter+'"><label class="control-label col-md-2">Report Definition '+counter+'</label> <div class="col-md-9"><textarea type="text" name="Report_definition[]" rows="5" class="form-control"></textarea></div><div class="col-md-1"><center><a id="Rmv_'+counter+'" href="javascript:RemoveRow('+counter+');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Definition').append(newRow);
        i++;
        console.log(newRow);
    });
});
jQuery(function() {
    var counter = 1;
    var i = 2;
    jQuery('#description_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_'+counter+'"><label class="control-label col-md-2">Report Description '+counter+'</label> <div class="col-md-9"> <textarea type="text" name="Report_description[]" rows="8" class="form-control"></textarea></div><div class="col-md-1"><center><a id="Rmv_'+counter+'" href="javascript:RemoveRow('+counter+');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Description').append(newRow);
        i++;
        console.log(newRow);
    });
});
jQuery(function() {
    var counter = 1;
    var i = 2;
    jQuery('#summary_dro_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_'+counter+'"><label class="control-label col-md-2">Summary - DRO Para '+counter+'</label> <div class="col-md-9"> <textarea type="text" name="Executive_summary_DRO[]" rows="8" class="form-control"></textarea></div><div class="col-md-1"><center><a id="Rmv_'+counter+'" href="javascript:RemoveRow('+counter+');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center></div></div>'
        );

        jQuery('#Summary_DRO').append(newRow);
        i++;
        console.log(newRow);
    });
});
jQuery(function() {
    var counter = 1;
    var i = 2;
    jQuery('#summary_regional_description_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_'+counter+'"><label class="control-label col-md-2">Summary - Regional Para '+counter+'</label> <div class="col-md-9"> <textarea type="text" name="Executive_summary_regional_description[]" rows="8" class="form-control"></textarea></div> <div class="col-md-1"><center><a id="Rmv_'+counter+'" href="javascript:RemoveRow('+counter+');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center> </div></div>'
        );

        jQuery('#Summary_regional_description').append(newRow);
        i++;
    });
});

jQuery(function() {
    var counter = 1;
    var i = 2;
    jQuery('#competitive_landscape_description_addrow').click(function(event) {
        event.preventDefault();
        counter++;
        var newRow = jQuery(
            '<div class="form-group" id="Row_'+counter+'"><label class="control-label col-md-2">Competitive Landscape Para '+counter+'</label> <div class="col-md-9"> <textarea type="text" name="competitive_landscape[]" rows="8" class="form-control"></textarea></div> <div class="col-md-1"><center><a id="Rmv_'+counter+'" href="javascript:RemoveRow('+counter+');"><span type="button" class="btn btn-block btn-danger"><i class="fa fa-close"></i></span></a></center> </div></div>'
        );

        jQuery('#Competitive_landscape_description').append(newRow);
        i++;
    });
});

function RemoveRow(rowID) {
    jQuery('#Row_' + rowID).remove();
    
}
</script>
<?php $this->load->view('admin/footer.php'); ?>