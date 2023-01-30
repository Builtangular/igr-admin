<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Report
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
                        <h1 class="box-title"> Update Report</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/report/rd-update" method="post"
                        class="form-horizontal">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Scope</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="scope">
                                            <!-- <option value="0">Select</option> -->
                                            <?php foreach($scopes_data as $scopes){
                                            if ($scopes->id == $scope_id){ ?>
                                            <option value="<?php echo $scopes->id; ?>" Selected>
                                                <?php echo $scopes->name; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $scopes->id; ?>"><?php echo $scopes->name; ?>
                                            </option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Title Case Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="search" name="title" value="<?php echo $title; ?>"
                                            class="form-control">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Forecast From </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="forecast_from" id="From_forecast_period"
                                            Onchange="changeyear(this.value)" required>
                                            <option value="">Select From Forecast Period</option>
                                            <?php foreach($Period as $Period) {
												$Period1[]=$Period;
												$Period2[]=$Period;
												$Period3[]=$Period;
                                                if($Period == $forecast_from){
												?>
                                            <option value="<?php echo $forecast_from; ?>" Selected>
                                                <?php echo $forecast_from; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $Period; ?>"><?php echo $Period; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Forecast To </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="forecast_to" id="forecast_to">
                                            <option value="">Select To Forecast Period</option>
                                            <?php foreach($Period1 as $Period1) { 
                                                if($Period1 == $forecast_to){
                                                    ?>
                                            <option value="<?php echo $forecast_to; ?>" Selected>
                                                <?php echo $forecast_to; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $Period1; ?>"><?php echo $Period1; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">CAGR</label>
                                    <div class="col-md-9">
                                        <input type="text" name="cagr" value="<?php echo $value_cagr; ?>"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">SKU</label>
                                    <div class="col-md-9">
                                        <input type="text" name="sku" value="<?php echo $sku; ?>" class="form-control">
                                    </div>
                                </div>
                                <?php if($Role_id == 1 || $Role_id == 2){  ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Report Status</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <?php if($status == 2){ ?>
                                            <label><input type="radio" name="status" value="2"
                                                    <?php echo ($status==2)?'checked':'' ?> />Verified</label>
                                            <?php } ?>
                                            <label><input type="radio" name="status" value="0"
                                                    <?php echo ($status==0)?'checked':'' ?> />Draft</label>
                                            <label><input type="radio" name="status" value="3"
                                                    <?php echo ($status==3)?'checked':'' ?> />Publish</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Country RD Status</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="country_status" value="1"
                                                    <?php echo ($country_status==1)?'checked':'' ?> />Created</label>
                                            <label><input type="radio" name="country_status" value="0"
                                                    <?php echo ($country_status==0)?'checked':'' ?> />Generate</label>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Category</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="category">
                                            <option value="0">Select</option>
                                            <?php foreach($category_data as $category){
                                                if($category->id == $category_id){
                                                    ?>
                                            <option value="<?php echo $category->id; ?>" Selected>
                                                <?php echo $category->name; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?>
                                            </option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Small Case Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="search" name="name" value="<?php echo $name; ?>"
                                            class="form-control">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Analysis From </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="analysis_form" id="analysis_form">
                                            <option value="">Select From Period</option>
                                            <?php foreach($Period3 as $Period3) { 
                                             if($Period3 == $analysis_from){
												?>
                                            <option value="<?php echo $analysis_from; ?>" Selected>
                                                <?php echo $analysis_from; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $Period3; ?>"><?php echo $Period3; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Analysis To </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="analysis_to" id="analysis_to">
                                            <option value="">Select To Period</option>
                                            <?php foreach($Period2 as $Period2) { 
                                                 if($Period2 == $analysis_to){
                                                    ?>
                                            <option value="<?php echo $analysis_to; ?>" Selected>
                                                <?php echo $analysis_to; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $Period2; ?>"><?php echo $Period2; ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Value Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" name="value_based_unit" value="<?php echo $value_unit; ?>"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">URL Path</label>
                                    <div class="col-md-9">
                                        <input type="text" name="url" value="<?php echo $url; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Volume Based Report?</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="volume" value="1"
                                                    onclick="return HideVunit(1)"
                                                    <?php echo ($is_volume_based==1)?'checked':'' ?> />Yes</label>

                                            <label><input type="radio" name="volume" value="0"
                                                    onclick="return HideVunit(0)"
                                                    <?php echo ($is_volume_based==0)?'checked':'' ?> />No</label>
                                        </div>
                                    </div>
                                </div>
                                <?php if($is_volume_based == 1){?>
                                <div class="form-group" id="div1" style="display: block;">
                                    <label class="control-label col-md-3">Volume CAGR</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_cagr" name="volume_cagr"
                                            value="<?php echo $volume_based_cagr; ?>" class="form-control"
                                            placeholder="Volume CAGR" />
                                    </div>
                                </div>
                                <div class="form-group" id="div3" style="display: block;">
                                    <label class="control-label col-md-3">Volume Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_unit" name="volume_based_unit"
                                            value="<?php echo $volume_based_unit; ?>" class="form-control"
                                            placeholder="Volume Unit" />
                                    </div>
                                </div>
                                <?php } else {?>
                                <div class="form-group" id="div1" style="display: none;">
                                    <label class="control-label col-md-3">Volume CAGR</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_cagr" name="volume_cagr"
                                            value="<?php echo $volume_based_cagr; ?>" class="form-control"
                                            placeholder="Volume CAGR" />
                                    </div>
                                </div>
                                <div class="form-group" id="div3" style="display: none;">
                                    <label class="control-label col-md-3">Volume Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_unit" name="volume_based_unit"
                                            value="<?php echo $volume_based_unit; ?>" class="form-control"
                                            placeholder="Volume Unit" />
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2">Report Price</label>
                                <div class="col-md-4">
                                    <input type="text" id="single_user" name="single_user"
                                        value="<?php echo $singleuser_price; ?>" class="form-control"
                                        placeholder="Single User License" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="enterprise_user" name="enterprise_user"
                                        value="<?php echo $enterprise_price; ?>" class="form-control"
                                        placeholder="Enterprise License" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="datasheet" name="datasheet"
                                        value="<?php echo $datasheet_price; ?>" class="form-control"
                                        placeholder="Data Sheet License" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2">CAGR Market Value</label>
                                <div class="col-md-10">
                                    <input type="text" id="market_value" name="market_value" class="form-control"
                                        value="<?php echo $cagr_market_value; ?>"
                                        placeholder="Market Value During the Forecast Period" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Largest Region</label>
                                <div class="col-md-10">
                                    <input type="text" name="Largest_region" value="<?php echo $largest_region; ?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Publish Date</label>
                                <div class="col-md-10">
                                    <input type="text" name="Publish_date" value="<?php echo $updated_at; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Market Insight Part -->
                        <?php if($market_insight){ ?>
                        <h4 class="col-md-12 page-header text-red">Market Insight</h4>
                        <?php foreach($market_insight as $insight){ ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2"><?php echo $insight['type']; ?></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="insight_description[]" rows="9"
                                        class="form-control"><?php echo $insight['description']; ?></textarea>
                                    <input type="hidden" name="insight_type[]" value="<?php echo $insight['type']; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <!-- ./ Market Insight Part -->
                        <!-- Segments Part -->
                        <?php if($segments){  ?>
                        <!-- <h3 class="col-md-12 text-center"><span class="label label-success">Segments List</span></h3> -->
                        <!-- <h4 class="col-md-12">Segment List</h4> -->
                        <h4 class="col-md-12 page-header text-red">Segments List</h4>
                        <?php foreach($segments as $seg){  ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php if($seg->parent_id == 0){  ?>
                                <label class="control-label col-md-2"><?php echo $seg->name; ?></label>
                                <?php }else {  ?>
                                <label class="control-label col-md-2"></label>
                                <?php }  ?>
                                <div class="col-md-10">
                                    <input type="text" name="segment_name[]" value="<?php echo $seg->name; ?>"
                                        class="form-control">
                                    <input type="hidden" name="segment_id[]" value="<?php echo $seg->id; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <!-- ./ Segments Part -->
                        <!-- Companies Part -->
                        <?php if($companies){  ?>
                        <h4 class="col-md-12 page-header text-red">Companies List</h4>
                        <?php foreach($companies as $company){  ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2"></label>
                                <div class="col-md-10">
                                    <input type="text" name="company_name[]" value="<?php echo $company->name; ?>"
                                        class="form-control">
                                    <input type="hidden" name="company_id[]" value="<?php echo $company->id; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <!-- ./ Companies Part -->
                        <!-- DRO Part -->
                        <?php if($dro_data){  ?>
                        <h4 class="col-md-12 page-header text-red">DRO List</h4>
                        <?php foreach($dro_data as $dro){  ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2"><?php echo $dro->type; ?></label>
                                <div class="col-md-10">
                                    <input type="text" name="dro_description[]" value="<?php echo $dro->description; ?>"
                                        class="form-control">
                                    <input type="hidden" name="dro_id[]" value="<?php echo $dro->id; ?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <!-- ./ DRO Part -->
                        <!-- Segment Overview Part -->
                        <?php if($Role_id == 3){  ?>
                        <?php if($segment_overview_data){  ?>
                        <h4 class="col-md-12 page-header text-red">Segment Overview</h4>
                        <!-- <h4 class="col-md-12 text-red">DRO List</h4> -->
                        <?php foreach($segment_overview_data as $segment_overview){  
                            
                            foreach($MainSegment as $name){
                            if ($segment_overview['id'] == $name->id){
                                $segment_id = $name->id;
                                $segment_name.= $name->name;
                                // var_dump($segment_name); 
                            } } 
                            // die;
                            ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label
                                    class="control-label col-md-2"><?php echo $segment_name; ?></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="segment_overview[]" rows="5"
                                        class="form-control"><?php echo $segment_overview['description']; ?></textarea>
                                    <!-- <input type="text" name="dro_description[]" value="<?php echo $segment_overview['description']; ?>"
                                        class="form-control"> -->
                                    <input type="hidden" name="seg_overview_id[]"
                                        value="<?php echo $segment_overview['id']; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php }  ?>
                        <!-- ./ Segment Overview Part -->

                        <div class="box-footer">
                            <input type="hidden" name="report_id" class="form-control"
                                value="<?php echo $report_id; ?>">
                            <input type="submit" class="btn btn-info pull-left" name="request" value="Update">
                            <?php if($Role_id == 4){ ?>
                            <input type="submit" class="btn btn-success pull-right" name="request" value="Verify">
                            <?php } else if($Role_id == 3){ ?>
                            <input type="submit" class="btn btn-success pull-right" name="request" value="Process">
                            <?php } else{ ?>
                            <input type="submit" class="btn btn-success pull-right" name="request" value="Publish">
                            <?php }?>
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