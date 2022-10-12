<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                 Create Report
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
                <h1 class="box-title"> Create Report</h1>
            </div>
            <form action="http://localhost/testapp/public/superadmin/report" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="E2lWHFIYSGpFwclGKM4XZgfX9bcT6dV9L5qsJ9bb">
                <div class="box-body">
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Scope</label>
                            <div class="col-md-8">
                                <select class="form-control" name="scope">
                                    <option value="0">Select</option>
                                    :
                                        <option value="1">Global</option>
                                    :
                                        <option value="2">North America</option>
                                    :
                                        <option value="3">Europe</option>
                                    :
                                        <option value="4">Asia Pacific</option>
                                    :
                                        <option value="5">RoW</option>
                                    ;
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Forecast From </label>
                            <div class="col-md-8">
                                <select class="form-control" name="forecast_from" id="From_forecast_period" Onchange = "changeyear(this.value)" required>
                                    <option value="">Select From Forecast Period</option>
                                                                            <option value="2010">2010</option>
                                                                            <option value="2011">2011</option>
                                                                            <option value="2012">2012</option>
                                                                            <option value="2013">2013</option>
                                                                            <option value="2014">2014</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                            <option value="2019">2019</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                            <option value="2026">2026</option>
                                                                            <option value="2027">2027</option>
                                                                            <option value="2028">2028</option>
                                                                            <option value="2029">2029</option>
                                                                            <option value="2030">2030</option>
                                                                            <option value="2031">2031</option>
                                                                            <option value="2032">2032</option>
                                                                            <option value="2033">2033</option>
                                                                            <option value="2034">2034</option>
                                                                            <option value="2035">2035</option>
                                                                            <option value="2036">2036</option>
                                                                            <option value="2037">2037</option>
                                                                            <option value="2038">2038</option>
                                                                            <option value="2039">2039</option>
                                                                            <option value="2040">2040</option>
                                                                            <option value="2041">2041</option>
                                                                            <option value="2042">2042</option>
                                                                            <option value="2043">2043</option>
                                                                            <option value="2044">2044</option>
                                                                            <option value="2045">2045</option>
                                                                            <option value="2046">2046</option>
                                                                            <option value="2047">2047</option>
                                                                            <option value="2048">2048</option>
                                                                            <option value="2049">2049</option>
                                                                            <option value="2050">2050</option>
                                                                            <option value="2051">2051</option>
                                                                            <option value="2052">2052</option>
                                                                            <option value="2053">2053</option>
                                                                            <option value="2054">2054</option>
                                                                            <option value="2055">2055</option>
                                                                            <option value="2056">2056</option>
                                                                            <option value="2057">2057</option>
                                                                            <option value="2058">2058</option>
                                                                            <option value="2059">2059</option>
                                                                            <option value="2060">2060</option>
                                                                            <option value="2061">2061</option>
                                                                            <option value="2062">2062</option>
                                                                            <option value="2063">2063</option>
                                                                            <option value="2064">2064</option>
                                                                            <option value="2065">2065</option>
                                                                            <option value="2066">2066</option>
                                                                            <option value="2067">2067</option>
                                                                            <option value="2068">2068</option>
                                                                            <option value="2069">2069</option>
                                                                            <option value="2070">2070</option>
                                                                            <option value="2071">2071</option>
                                                                            <option value="2072">2072</option>
                                                                            <option value="2073">2073</option>
                                                                            <option value="2074">2074</option>
                                                                            <option value="2075">2075</option>
                                                                            <option value="2076">2076</option>
                                                                            <option value="2077">2077</option>
                                                                            <option value="2078">2078</option>
                                                                            <option value="2079">2079</option>
                                                                            <option value="2080">2080</option>
                                                                            <option value="2081">2081</option>
                                                                            <option value="2082">2082</option>
                                                                            <option value="2083">2083</option>
                                                                            <option value="2084">2084</option>
                                                                            <option value="2085">2085</option>
                                                                            <option value="2086">2086</option>
                                                                            <option value="2087">2087</option>
                                                                            <option value="2088">2088</option>
                                                                            <option value="2089">2089</option>
                                                                            <option value="2090">2090</option>
                                                                            <option value="2091">2091</option>
                                                                            <option value="2092">2092</option>
                                                                            <option value="2093">2093</option>
                                                                            <option value="2094">2094</option>
                                                                            <option value="2095">2095</option>
                                                                            <option value="2096">2096</option>
                                                                            <option value="2097">2097</option>
                                                                            <option value="2098">2098</option>
                                                                            <option value="2099">2099</option>
                                                                    </select>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Forecast To </label>
                            <div class="col-md-8">
                                <select class="form-control" name="forecast_to" id="forecast_to">
                                    <option value="">Select To Forecast Period</option>
                                                                            <option value="2010">2010</option>
                                                                            <option value="2011">2011</option>
                                                                            <option value="2012">2012</option>
                                                                            <option value="2013">2013</option>
                                                                            <option value="2014">2014</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                            <option value="2019">2019</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                            <option value="2026">2026</option>
                                                                            <option value="2027">2027</option>
                                                                            <option value="2028">2028</option>
                                                                            <option value="2029">2029</option>
                                                                            <option value="2030">2030</option>
                                                                            <option value="2031">2031</option>
                                                                            <option value="2032">2032</option>
                                                                            <option value="2033">2033</option>
                                                                            <option value="2034">2034</option>
                                                                            <option value="2035">2035</option>
                                                                            <option value="2036">2036</option>
                                                                            <option value="2037">2037</option>
                                                                            <option value="2038">2038</option>
                                                                            <option value="2039">2039</option>
                                                                            <option value="2040">2040</option>
                                                                            <option value="2041">2041</option>
                                                                            <option value="2042">2042</option>
                                                                            <option value="2043">2043</option>
                                                                            <option value="2044">2044</option>
                                                                            <option value="2045">2045</option>
                                                                            <option value="2046">2046</option>
                                                                            <option value="2047">2047</option>
                                                                            <option value="2048">2048</option>
                                                                            <option value="2049">2049</option>
                                                                            <option value="2050">2050</option>
                                                                            <option value="2051">2051</option>
                                                                            <option value="2052">2052</option>
                                                                            <option value="2053">2053</option>
                                                                            <option value="2054">2054</option>
                                                                            <option value="2055">2055</option>
                                                                            <option value="2056">2056</option>
                                                                            <option value="2057">2057</option>
                                                                            <option value="2058">2058</option>
                                                                            <option value="2059">2059</option>
                                                                            <option value="2060">2060</option>
                                                                            <option value="2061">2061</option>
                                                                            <option value="2062">2062</option>
                                                                            <option value="2063">2063</option>
                                                                            <option value="2064">2064</option>
                                                                            <option value="2065">2065</option>
                                                                            <option value="2066">2066</option>
                                                                            <option value="2067">2067</option>
                                                                            <option value="2068">2068</option>
                                                                            <option value="2069">2069</option>
                                                                            <option value="2070">2070</option>
                                                                            <option value="2071">2071</option>
                                                                            <option value="2072">2072</option>
                                                                            <option value="2073">2073</option>
                                                                            <option value="2074">2074</option>
                                                                            <option value="2075">2075</option>
                                                                            <option value="2076">2076</option>
                                                                            <option value="2077">2077</option>
                                                                            <option value="2078">2078</option>
                                                                            <option value="2079">2079</option>
                                                                            <option value="2080">2080</option>
                                                                            <option value="2081">2081</option>
                                                                            <option value="2082">2082</option>
                                                                            <option value="2083">2083</option>
                                                                            <option value="2084">2084</option>
                                                                            <option value="2085">2085</option>
                                                                            <option value="2086">2086</option>
                                                                            <option value="2087">2087</option>
                                                                            <option value="2088">2088</option>
                                                                            <option value="2089">2089</option>
                                                                            <option value="2090">2090</option>
                                                                            <option value="2091">2091</option>
                                                                            <option value="2092">2092</option>
                                                                            <option value="2093">2093</option>
                                                                            <option value="2094">2094</option>
                                                                            <option value="2095">2095</option>
                                                                            <option value="2096">2096</option>
                                                                            <option value="2097">2097</option>
                                                                            <option value="2098">2098</option>
                                                                            <option value="2099">2099</option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Domain</label>
                            <div class="col-md-8">
                                <select class="form-control" name="domain">
                                    <option value="0">Select</option>
                                    :
                                        <option value="1">Automotive &amp; Transport</option>
                                    :
                                        <option value="2">Automotive</option>
                                    :
                                        <option value="3">Automotive Parts</option>
                                    :
                                        <option value="4">Marine</option>
                                    :
                                        <option value="5">Public Transport</option>
                                    :
                                        <option value="6">Chemicals &amp; Materials</option>
                                    :
                                        <option value="7">Adhesives &amp; Sealants</option>
                                    :
                                        <option value="8">Advanced Materials</option>
                                    :
                                        <option value="9">Chemicals</option>
                                    :
                                        <option value="10">Composites</option>
                                    :
                                        <option value="11">Metals &amp; Minerals</option>
                                    :
                                        <option value="12">Nanomaterials</option>
                                    :
                                        <option value="13">Plastics</option>
                                    :
                                        <option value="14">Consumer Goods &amp; Services</option>
                                    :
                                        <option value="15">Consumer Electronics</option>
                                    :
                                        <option value="16">Household</option>
                                    :
                                        <option value="17">Personal Care Products</option>
                                    :
                                        <option value="18">Retail</option>
                                    :
                                        <option value="19">Sporting Goods &amp; Equipment</option>
                                    :
                                        <option value="20">Defense</option>
                                    :
                                        <option value="21">Ammunition</option>
                                    :
                                        <option value="22">Homeland Defense</option>
                                    :
                                        <option value="23">Infantry Weapons &amp; Equipment</option>
                                    :
                                        <option value="24">Military Aerospace &amp; Defense</option>
                                    :
                                        <option value="25">Military Unmanned Systems</option>
                                    :
                                        <option value="26">Electronics &amp; Semiconductors</option>
                                    :
                                        <option value="27">Embedded</option>
                                    :
                                        <option value="28">Ics, LED &amp; PCB</option>
                                    :
                                        <option value="29">Medical Electronics</option>
                                    :
                                        <option value="30">Photonics</option>
                                    :
                                        <option value="31">Semiconductor</option>
                                    :
                                        <option value="32">Sensors</option>
                                    :
                                        <option value="33">Test &amp; Measurement</option>
                                    :
                                        <option value="34">Food &amp; Beverages</option>
                                    :
                                        <option value="35">Beverage</option>
                                    :
                                        <option value="36">Agriculture</option>
                                    :
                                        <option value="37">Food</option>
                                    :
                                        <option value="38">Food Ingredients</option>
                                    :
                                        <option value="39">Food Service</option>
                                    ;
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Category</label>
                            <div class="col-md-8">
                                <select class="form-control" name="category">
                                    <option value="0">Select</option>
                                    :
                                        <option value="1">Automotive &amp; Transport</option>
                                    :
                                        <option value="2">Automotive</option>
                                    :
                                        <option value="3">Automotive Parts</option>
                                    :
                                        <option value="4">Marine</option>
                                    :
                                        <option value="5">Public Transport</option>
                                    :
                                        <option value="6">Chemicals &amp; Materials</option>
                                    :
                                        <option value="7">Adhesives &amp; Sealants</option>
                                    :
                                        <option value="8">Advanced Materials</option>
                                    :
                                        <option value="9">Chemicals</option>
                                    :
                                        <option value="10">Composites</option>
                                    :
                                        <option value="11">Metals &amp; Minerals</option>
                                    :
                                        <option value="12">Nanomaterials</option>
                                    :
                                        <option value="13">Plastics</option>
                                    :
                                        <option value="14">Consumer Goods &amp; Services</option>
                                    :
                                        <option value="15">Consumer Electronics</option>
                                    :
                                        <option value="16">Household</option>
                                    :
                                        <option value="17">Personal Care Products</option>
                                    :
                                        <option value="18">Retail</option>
                                    :
                                        <option value="19">Sporting Goods &amp; Equipment</option>
                                    :
                                        <option value="20">Defense</option>
                                    :
                                        <option value="21">Ammunition</option>
                                    :
                                        <option value="22">Homeland Defense</option>
                                    :
                                        <option value="23">Infantry Weapons &amp; Equipment</option>
                                    :
                                        <option value="24">Military Aerospace &amp; Defense</option>
                                    :
                                        <option value="25">Military Unmanned Systems</option>
                                    :
                                        <option value="26">Electronics &amp; Semiconductors</option>
                                    :
                                        <option value="27">Embedded</option>
                                    :
                                        <option value="28">Ics, LED &amp; PCB</option>
                                    :
                                        <option value="29">Medical Electronics</option>
                                    :
                                        <option value="30">Photonics</option>
                                    :
                                        <option value="31">Semiconductor</option>
                                    :
                                        <option value="32">Sensors</option>
                                    :
                                        <option value="33">Test &amp; Measurement</option>
                                    :
                                        <option value="34">Food &amp; Beverages</option>
                                    :
                                        <option value="35">Beverage</option>
                                    :
                                        <option value="36">Agriculture</option>
                                    :
                                        <option value="37">Food</option>
                                    :
                                        <option value="38">Food Ingredients</option>
                                    :
                                        <option value="39">Food Service</option>
                                    ;
                                </select>
                            </div>
                        </div>                   
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Analysis From </label>
                            <div class="col-md-8">
                                <select class="form-control" name="analysis_form" id="analysis_form">
                                <option value="">Select From Period</option>
                                                                            <option value="2010">2010</option>
                                                                            <option value="2011">2011</option>
                                                                            <option value="2012">2012</option>
                                                                            <option value="2013">2013</option>
                                                                            <option value="2014">2014</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                            <option value="2019">2019</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                            <option value="2026">2026</option>
                                                                            <option value="2027">2027</option>
                                                                            <option value="2028">2028</option>
                                                                            <option value="2029">2029</option>
                                                                            <option value="2030">2030</option>
                                                                            <option value="2031">2031</option>
                                                                            <option value="2032">2032</option>
                                                                            <option value="2033">2033</option>
                                                                            <option value="2034">2034</option>
                                                                            <option value="2035">2035</option>
                                                                            <option value="2036">2036</option>
                                                                            <option value="2037">2037</option>
                                                                            <option value="2038">2038</option>
                                                                            <option value="2039">2039</option>
                                                                            <option value="2040">2040</option>
                                                                            <option value="2041">2041</option>
                                                                            <option value="2042">2042</option>
                                                                            <option value="2043">2043</option>
                                                                            <option value="2044">2044</option>
                                                                            <option value="2045">2045</option>
                                                                            <option value="2046">2046</option>
                                                                            <option value="2047">2047</option>
                                                                            <option value="2048">2048</option>
                                                                            <option value="2049">2049</option>
                                                                            <option value="2050">2050</option>
                                                                            <option value="2051">2051</option>
                                                                            <option value="2052">2052</option>
                                                                            <option value="2053">2053</option>
                                                                            <option value="2054">2054</option>
                                                                            <option value="2055">2055</option>
                                                                            <option value="2056">2056</option>
                                                                            <option value="2057">2057</option>
                                                                            <option value="2058">2058</option>
                                                                            <option value="2059">2059</option>
                                                                            <option value="2060">2060</option>
                                                                            <option value="2061">2061</option>
                                                                            <option value="2062">2062</option>
                                                                            <option value="2063">2063</option>
                                                                            <option value="2064">2064</option>
                                                                            <option value="2065">2065</option>
                                                                            <option value="2066">2066</option>
                                                                            <option value="2067">2067</option>
                                                                            <option value="2068">2068</option>
                                                                            <option value="2069">2069</option>
                                                                            <option value="2070">2070</option>
                                                                            <option value="2071">2071</option>
                                                                            <option value="2072">2072</option>
                                                                            <option value="2073">2073</option>
                                                                            <option value="2074">2074</option>
                                                                            <option value="2075">2075</option>
                                                                            <option value="2076">2076</option>
                                                                            <option value="2077">2077</option>
                                                                            <option value="2078">2078</option>
                                                                            <option value="2079">2079</option>
                                                                            <option value="2080">2080</option>
                                                                            <option value="2081">2081</option>
                                                                            <option value="2082">2082</option>
                                                                            <option value="2083">2083</option>
                                                                            <option value="2084">2084</option>
                                                                            <option value="2085">2085</option>
                                                                            <option value="2086">2086</option>
                                                                            <option value="2087">2087</option>
                                                                            <option value="2088">2088</option>
                                                                            <option value="2089">2089</option>
                                                                            <option value="2090">2090</option>
                                                                            <option value="2091">2091</option>
                                                                            <option value="2092">2092</option>
                                                                            <option value="2093">2093</option>
                                                                            <option value="2094">2094</option>
                                                                            <option value="2095">2095</option>
                                                                            <option value="2096">2096</option>
                                                                            <option value="2097">2097</option>
                                                                            <option value="2098">2098</option>
                                                                            <option value="2099">2099</option>
                                                                    </select>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="control-label col-md-3">Analysis To </label>
                            <div class="col-md-8">
                                <select class="form-control" name="analysis_to" id="analysis_to">
                                <option value="">Select To Period</option>
                                                                            <option value="2010">2010</option>
                                                                            <option value="2011">2011</option>
                                                                            <option value="2012">2012</option>
                                                                            <option value="2013">2013</option>
                                                                            <option value="2014">2014</option>
                                                                            <option value="2015">2015</option>
                                                                            <option value="2016">2016</option>
                                                                            <option value="2017">2017</option>
                                                                            <option value="2018">2018</option>
                                                                            <option value="2019">2019</option>
                                                                            <option value="2020">2020</option>
                                                                            <option value="2021">2021</option>
                                                                            <option value="2022">2022</option>
                                                                            <option value="2023">2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                            <option value="2026">2026</option>
                                                                            <option value="2027">2027</option>
                                                                            <option value="2028">2028</option>
                                                                            <option value="2029">2029</option>
                                                                            <option value="2030">2030</option>
                                                                            <option value="2031">2031</option>
                                                                            <option value="2032">2032</option>
                                                                            <option value="2033">2033</option>
                                                                            <option value="2034">2034</option>
                                                                            <option value="2035">2035</option>
                                                                            <option value="2036">2036</option>
                                                                            <option value="2037">2037</option>
                                                                            <option value="2038">2038</option>
                                                                            <option value="2039">2039</option>
                                                                            <option value="2040">2040</option>
                                                                            <option value="2041">2041</option>
                                                                            <option value="2042">2042</option>
                                                                            <option value="2043">2043</option>
                                                                            <option value="2044">2044</option>
                                                                            <option value="2045">2045</option>
                                                                            <option value="2046">2046</option>
                                                                            <option value="2047">2047</option>
                                                                            <option value="2048">2048</option>
                                                                            <option value="2049">2049</option>
                                                                            <option value="2050">2050</option>
                                                                            <option value="2051">2051</option>
                                                                            <option value="2052">2052</option>
                                                                            <option value="2053">2053</option>
                                                                            <option value="2054">2054</option>
                                                                            <option value="2055">2055</option>
                                                                            <option value="2056">2056</option>
                                                                            <option value="2057">2057</option>
                                                                            <option value="2058">2058</option>
                                                                            <option value="2059">2059</option>
                                                                            <option value="2060">2060</option>
                                                                            <option value="2061">2061</option>
                                                                            <option value="2062">2062</option>
                                                                            <option value="2063">2063</option>
                                                                            <option value="2064">2064</option>
                                                                            <option value="2065">2065</option>
                                                                            <option value="2066">2066</option>
                                                                            <option value="2067">2067</option>
                                                                            <option value="2068">2068</option>
                                                                            <option value="2069">2069</option>
                                                                            <option value="2070">2070</option>
                                                                            <option value="2071">2071</option>
                                                                            <option value="2072">2072</option>
                                                                            <option value="2073">2073</option>
                                                                            <option value="2074">2074</option>
                                                                            <option value="2075">2075</option>
                                                                            <option value="2076">2076</option>
                                                                            <option value="2077">2077</option>
                                                                            <option value="2078">2078</option>
                                                                            <option value="2079">2079</option>
                                                                            <option value="2080">2080</option>
                                                                            <option value="2081">2081</option>
                                                                            <option value="2082">2082</option>
                                                                            <option value="2083">2083</option>
                                                                            <option value="2084">2084</option>
                                                                            <option value="2085">2085</option>
                                                                            <option value="2086">2086</option>
                                                                            <option value="2087">2087</option>
                                                                            <option value="2088">2088</option>
                                                                            <option value="2089">2089</option>
                                                                            <option value="2090">2090</option>
                                                                            <option value="2091">2091</option>
                                                                            <option value="2092">2092</option>
                                                                            <option value="2093">2093</option>
                                                                            <option value="2094">2094</option>
                                                                            <option value="2095">2095</option>
                                                                            <option value="2096">2096</option>
                                                                            <option value="2097">2097</option>
                                                                            <option value="2098">2098</option>
                                                                            <option value="2099">2099</option>
                                                                    </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">CAGR</label>
                            <div class="col-md-8">
                                <input type="text" name="cagr" class="form-control">
                            </div>
                        </div>                                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Value Unit</label>
                            <div class="col-md-8">
                                <input type="text" name="Value_based_unit" class="form-control">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Volume Based Report?</label>
                            <div class="col-md-8">
                                <div class="radio">
                                    <label><input type="radio" name="volume" value="1" onclick="return HideVunit(1)" />Yes</label>
                                
                                    <label><input type="radio" name="volume" value="0" onclick="return HideVunit(0)" checked />No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="div1" style="display: none;">
                            <label class="control-label col-md-3">Volume CAGR</label>
                            <div class="col-md-8">
                                <input type="text" id="Volume_CAGR" name="volumeCagr" class="form-control"  placeholder="Volume CAGR"/>
                            </div>
                        </div>                                          
                        <div class="form-group" id="div3" style="display: none;">
                            <label class="control-label col-md-3">Volume Unit</label>
                             <div class="col-md-8">
                                <input type="text" id="Volume_unit" name="Volume_based_unit" class="form-control"  placeholder="Volume Unit"/>
                            </div>
                        </div>                 
                     </div>
                    
                </div>
                <div class="col-md-12">
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Report Definition</label>
                         <div class="col-md-8">
                             <textarea type="text" name="Report_definition" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Report Description</label>
                         <div class="col-md-8">
                             <textarea type="text" name="Report_description" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Executive Summary-DRO</label>
                         <div class="col-md-8">
                             <textarea type="text" name="Executive_summary_DRO" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Executive Summary - Regional Description</label>
                         <div class="col-md-8">
                             <textarea type="text" name="Executive_summary_regional_description" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Largest Region</label>
                         <div class="col-md-8">
                             <input type="text" name="Largest_region" class="form-control">
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
function changeyear(inputYear)
	{
		//alert(inputYear);
		
		/* var ToForecastPeriod
		var FromPeriod
		var ToPeriod */
		
		var To_forecast=parseInt(inputYear)+parseInt(6);
		var From_Period=parseInt(inputYear)-parseInt(2);
		var To_Period=parseInt(inputYear)+parseInt(6);
			// $("#To_forecast_period option[value='United State']");
            //alert(To_forecast);
			$("#forecast_to").val(To_forecast);
			$("#analysis_form").val(From_Period);
			$("#analysis_to").val(To_Period);
		
	}
function HideVunit(input)
	{
	   if(input==1)
	   {
		   $('#div2').hide('fast');
           $('#div1').show('fast');
           $('#div4').hide('fast');
		   $('#div3').show('fast');
		   $('#Volume_unit').attr("required","required");
		   $('#Volume_CAGR').attr("required","required");
	   }
	   else{
		    $('#div1').hide('fast');
          $('#div2').show('fast');
          $('#div3').hide('fast');
		  $('#div4').show('fast');
		  $('#Volume_unit').removeAttr('required', '');
		  $('#Volume_CAGR').removeAttr('required', '');
	   }
    }	
</script>
<?php $this->load->view('admin/footer.php'); ?>