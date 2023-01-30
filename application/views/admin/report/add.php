<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Report
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
                        <h1 class="box-title"> Add Report</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/report/insert" method="post" class="form-horizontal" autocomplete="off">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Scope <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="scope" required >
                                            <option value="">Select</option>
                                            <?php foreach($scopes_data as $scopes){?>
                                            <option value="<?php echo $scopes->id; ?>"><?php echo $scopes->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3">Title Case Name <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" id="search" name="title" class="form-control" required>
										<span class="help-block margin" id="txtHint"></span>
                                    </div>								
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Forecast From <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="forecast_from" id="From_forecast_period"
                                            Onchange="changeyear(this.value)" required>
                                            <option value="">Select From Forecast Period</option>
                                            <?php foreach($Period as $Period) {
												$Period1[]=$Period;
												$Period2[]=$Period;
												$Period3[]=$Period;
												?>
                                            <option value="<?php echo $Period; ?>"><?php echo $Period; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Forecast To <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="forecast_to" id="forecast_to">
                                            <option value="">Select To Forecast Period</option>
                                            <?php foreach($Period1 as $Period1) { ?>
                                            <option value="<?php echo $Period1; ?>"><?php echo $Period1; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3">CAGR <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="cagr" class="form-control" required>
                                    </div>
                                </div>                                
								<div class="form-group">
                                    <label class="control-label col-md-3">Report Status <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="3" />Published</label>
                                            <label><input type="radio" name="status" value="0" checked/>Draft</label>
                                            <!-- <label><input type="radio" name="status" value="2" />Draft</label> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
								<div class="form-group">
                                    <label class="control-label col-md-3">Category <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="category" required>
                                            <option value="">Select</option>
											<?php foreach($category_data as $category){?>
                                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?>
                                            </option>
											<?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Small Case Name <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" id="search" name="name" class="form-control" required>
										<span class="help-block margin" id="txtHint"></span>
                                    </div>								
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Analysis From <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="analysis_form" id="analysis_form">
                                            <option value="">Select From Period</option>
                                            <?php foreach($Period3 as $Period3) { ?>
                                            <option value="<?php echo $Period3; ?>"><?php echo $Period3; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Analysis To <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="analysis_to" id="analysis_to">
                                            <option value="">Select To Period</option>
                                            <?php foreach($Period2 as $Period2) { ?>
                                            <option value="<?php echo $Period2; ?>"><?php echo $Period2; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3">Value Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" name="value_based_unit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Volume Based Report?</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label><input type="radio" name="volume" value="1"
                                                    onclick="return HideVunit(1)" />Yes</label>

                                            <label><input type="radio" name="volume" value="0"
                                                    onclick="return HideVunit(0)" checked />No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div1" style="display: none;">
                                    <label class="control-label col-md-3">Volume CAGR</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_cagr" name="volume_cagr" class="form-control"
                                            placeholder="Volume CAGR" />
                                    </div>
                                </div>
                                <div class="form-group" id="div3" style="display: none;">
                                    <label class="control-label col-md-3">Volume Unit</label>
                                    <div class="col-md-9">
                                        <input type="text" id="volume_unit" name="volume_based_unit"
                                            class="form-control" placeholder="Volume Unit" />
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="col-md-12">
							<div class="form-group">
                                <label class="control-label col-md-2">Report Price <span class="text-red">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" id="single_user" name="single_user" class="form-control" placeholder="Single User License" autocomplete="on" required />
                                </div>
								<div class="col-md-3">
                                    <input type="text" id="enterprise_user" name="enterprise_user" class="form-control" placeholder="Enterprise License" autocomplete="on" required />
                                </div>
								<div class="col-md-3">
                                    <input type="text" id="datasheet" name="datasheet" class="form-control" placeholder="Data Sheet License" autocomplete="on" required/>
                                </div>
                            </div>
						</div>
                        <div class="col-md-12">
							<div class="form-group">
                                <label class="control-label col-md-2">CAGR Market Value</label>
                                <div class="col-md-10">
                                    <input type="text" id="market_value" name="market_value" class="form-control" placeholder="Market Value During the Forecast Period" />
                                </div>
                            </div>
							<!--<div class="form-group">
                                <label class="control-label col-md-2">Insight Para 1</label>
                                <div class="col-md-10">
                                    <textarea type="text" name="Report_definition" rows="5"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Market Insight Para 1 <span class="text-red">*</span></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="Report_description" rows="8"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Market Insight Para 2 <span class="text-red">*</span></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="Executive_summary_DRO" rows="8"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Market Insight Para 3 <span class="text-red">*</span></label>
                                <div class="col-md-10">
                                    <textarea type="text" name="Executive_summary_regional_description" rows="8"
                                        class="form-control"></textarea>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-2">Largest Region <span class="text-red">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="Largest_region" class="form-control" required>
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
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
<script>
$(document).mouseup(function (e) { 
	if ($(e.target).closest("#txtHint").length === 0) {										
		$("#txtHint").hide(); 
	} 
});
$( "#txtHint" ).css("display","none");
$(document).ready(function(){
	$("#search").keyup(function(){				
		var str=  $("#search").val();
		if(str == "") {
			$("#txtHint" ).css("display","none");
		} else {
			$.get("<?php echo base_url(); ?>admin/report/title_exist?name="+str, function(data){
				//$("#txtHint" ).html("");
				if(data == ""){
					// console.log("in if");
					$("#txtHint" ).css("display","none");
					//$("#txtHint").removeClass("search-result");								
				} else {
					// console.log("in else");
					$("#txtHint" ).html( data );
					$("#txtHint" ).css("display","");
					//$("#txtHint").addClass("search-result");
				}
				
			});
		}
	});
});
</script>
<?php $this->load->view('admin/footer.php'); ?>