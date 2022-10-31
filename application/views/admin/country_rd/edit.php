<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Country RD
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Update Country RD</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/country_rd/update_country_rd" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-1">Title</label>
                                    <div class="col-md-11">
                                        <input type="text" id="search" name="title"
                                            value="<?php echo $single_country_data->title;?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--  <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Title</label>
                                    <div class="col-md-6">
                                        <input type="text" id="search" name="title"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->title;}?>"
                                            class="form-control">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-2">SKU</label>
                                    <div class="col-md-10">
                                        <input type="text" name="sku" class="form-control"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->sku;}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Price</label>
                                    <div class="col-md-5">
                                        <input type="text" id="singleuser_price" name="singleuser_price"
                                            class="form-control" placeholder="Single User License"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->singleuser_price;}?>" />
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="enterprise_price" name="enterprise_price"
                                            class="form-control" placeholder="Enterprise License"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->enterprise_price;}?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Country</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="country">
                                            <option value="0">Select</option>
                                            <?php foreach($country_rd_data as $country_rd){
                                            if ($country_rd->name == $single_country_data->country){ ?>
                                            <option value="<?php echo $country_rd->name; ?>" Selected>
                                                <?php echo $country_rd->name; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $country_rd->name; ?>">
                                                <?php echo $country_rd->name; ?>
                                            </option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Pages</label>
                                    <div class="col-md-10">
                                        <input type="text" name="pages" class="form-control"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->pages;}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">URL</label>
                                    <div class="col-md-10">
                                        <input type="text" name="url" class="form-control"
                                            value="<?php if(!empty($single_country_data)){echo $single_country_data->url;}?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Status</label>
                                    <div class="col-md-10">
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="1" <?php echo ($single_country_data->status==1)?'checked':'' ?> />Active</label>
                                            <label><input type="radio" name="status" value="0" <?php echo ($single_country_data->status==0)?'checked':'' ?> />Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_country_data)){echo $single_country_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" value="Submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
function changeyear(inputYear) {
    //alert(inputYear);

    /* var ToForecastPeriod
    var FromPeriod
    var ToPeriod */

    var To_forecast = parseInt(inputYear) + parseInt(6);
    var From_Period = parseInt(inputYear) - parseInt(2);
    var To_Period = parseInt(inputYear) + parseInt(6);
    // $("#To_forecast_period option[value='United State']");
    //alert(To_forecast);
    $("#forecast_to").val(To_forecast);
    $("#analysis_form").val(From_Period);
    $("#analysis_to").val(To_Period);

}

function HideVunit(input) {
    if (input == 1) {
        $('#div2').hide('fast');
        $('#div1').show('fast');
        $('#div4').hide('fast');
        $('#div3').show('fast');
        $('#Volume_unit').attr("required", "required");
        $('#Volume_CAGR').attr("required", "required");
    } else {
        $('#div1').hide('fast');
        $('#div2').show('fast');
        $('#div3').hide('fast');
        $('#div4').show('fast');
        $('#Volume_unit').removeAttr('required', '');
        $('#Volume_CAGR').removeAttr('required', '');
    }
}
</script>
<!-- jQuery 2.1.3 -->
<script src="http://localhost/igr_admin/assets/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script>
$(document).mouseup(function(e) {
    if ($(e.target).closest("#txtHint").length === 0) {
        $("#txtHint").hide();
    }
});
$("#txtHint").css("display", "none");
$(document).ready(function() {
    $("#search").keyup(function() {
        var str = $("#search").val();
        if (str == "") {
            $("#txtHint").css("display", "none");
        } else {
            $.get("<?php echo base_url(); ?>admin/report/title_exist?name=" + str, function(data) {
                //$("#txtHint" ).html("");
                if (data == "") {
                    // console.log("in if");
                    $("#txtHint").css("display", "none");
                    //$("#txtHint").removeClass("search-result");								
                } else {
                    // console.log("in else");
                    $("#txtHint").html(data);
                    $("#txtHint").css("display", "");
                    //$("#txtHint").addClass("search-result");
                }

            });
        }
    });
});
</script>
<?php $this->load->view('admin/footer.php'); ?>