<?php $this->load->view('admin/header.php');
$Source = array('Email', 'Website', 'Reseller');
$Type = array('Sample Request', 'TOC Request', 'Customization', 'Enquiry', 'Discount Request');
$countries = array("Global", "North America", "Europe", "Asia Pacific", "RoW", "Africa", "GCC", "MENA", "BRICS", "Latin America", "MEA", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Korea", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update
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
                        <h1 class="box-title"> Upcoming Query</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/query/upcoming_query_update" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-1">Source <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="source" id="source">
                                        <?php foreach($Source as $source){ 
                                                if($source == $single_query_data->source){ ?>
                                        <option value="<?php echo $single_query_data->source;?>" selected>
                                            <?php echo $single_query_data->source;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $source;?>"> <?php echo $source; ?> </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Type <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="type" id="type" required>
                                        <?php foreach($Type as $type){ 
                                                if($type == $single_query_data->type){ ?>
                                        <option value="<?php echo $single_query_data->type;?>" selected>
                                            <?php echo $single_query_data->type;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $type;?>"> <?php echo $type; ?> </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Email Id <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="source_mail_id" name="source_mail_id"
                                        value="<?php echo $single_query_data->source_mail_id;?>" class="form-control"
                                        placeholder="Email Id">
                                </div>
                                <?php if($single_query_data->source == "Reseller"){ ?>
                                <label class="control-label col-md-1" id="reseller_div">Reseller</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" id="reseller_name" name="reseller_name">
                                        <?php foreach($reseller_list as $list) { 
                                        if($single_query_data->reseller_name == $list->reseller_name){ ?>
                                        <option value="<?php echo $single_query_data->reseller_name;?>" selected>
                                            <?php echo $single_query_data->reseller_name;?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <?php } else { ?>
                                <label class="control-label col-md-1 hide" id="reseller_div">Reseller</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none hide" id="reseller_name" name="reseller_name">
                                        <option value="" selected>Select Reseller</option>
                                        <?php foreach($reseller_list as $list) { ?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name">
                                            <?php /* foreach($scopelist as $scope)	{ 
                                            if($single_query_data->scope_name == $scope->name){ ?>
                                            <option value="<?php echo $single_query_data->scope_name;?>" selected>
                                                <?php echo $single_query_data->scope_name;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $scope->name;?>">
                                                <?php echo $scope->name; ?>
                                            </option>
                                            <?php } }  */?>
                                            <?php foreach($countries as $scope){
                                           
                                            if($single_query_data->scope_name == $scope){ ?>
                                            <option value="<?php echo $single_query_data->scope_name;?>" selected>
                                                <?php echo $single_query_data->scope_name;?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $scope;?>">
                                                <?php echo $scope; ?>
                                            </option>
                                            <?php }  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name"
                                            value="<?php echo $single_query_data->client_name;?>" class="form-control"
                                            placeholder="Client Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone No.</label>
                                    <div class="col-md-8">
                                        <input type="text" id="phone_no" name="phone_no"
                                            value="<?php echo $single_query_data->phone_no;?>" class="form-control"
                                            placeholder="Phone No.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name"
                                            value="<?php echo $single_query_data->company_name;?>" class="form-control"
                                            placeholder="Company Name">
                                    </div>
                                    <span class="help-block margin" id="txtHint"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation"
                                            value="<?php echo $single_query_data->designation;?>" class="form-control"
                                            placeholder="Designation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lead Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="lead_date" name="lead_date"
                                            value="<?php echo $single_query_data->lead_date;?>" class="form-control"
                                            placeholder="Lead Date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name"
                                            value="<?php echo $single_query_data->report_name;?>" class="form-control"
                                            placeholder="Report Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email"
                                            value="<?php echo $single_query_data->client_email;?>" class="form-control"
                                            placeholder="Client Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage </label>
                                    <div class="col-md-8">
                                        <textarea name="client_message" id="client_message" rows="4"
                                            class="form-control" placeholder="Client Meassage"
                                            required><?php echo $single_query_data->client_message;?></textarea>
                                    </div>
                                </div>
                                <?php if($Role_id == 1 || $Role_id == 5) {?>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Assign to Team</label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="assign_to_team" name="assign_to_team">
                                            <option value="0" selected>Select</option>
                                            <?php foreach($user_details as $data) {	?>
                                            <option value="<?php echo $data->full_name;?>">
                                                <?php echo $data->full_name; ?>
                                            </option>
                                            <?php }	?>
                                        </select>
                                    </div>
                                </div>
                                <!--  <div class="form-group">
                                    <label class="control-label col-md-4">Assign to Analyst</label>
                                    <div class="col-md-8">
                                        <input type="radio" name="assign_analyst" value="1"
                                            <?php echo ($single_query_data->assign_analyst == 1)?'checked':'' ?> /> Yes
                                        &nbsp;&nbsp;
                                        <input type="radio" name="assign_analyst" value="0"
                                            <?php echo ($single_query_data->assign_analyst == 0)?'checked':'' ?> /> No
                                    </div>
                                </div> -->

                                <?php } ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($single_query_data)){echo $single_query_data->id;}?>">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Bootstrap 3.3.2 JS -->
<script>
var source = document.getElementById('source');
var reseller_div = document.getElementById('reseller_div');
var reseller_name = document.getElementById('reseller_name');

source.addEventListener('change', function() {
    if (this.value == "Reseller") {
        reseller_name.classList.remove('hide');
        reseller_div.classList.remove('hide');
    } else {
        reseller_name.classList.add('hide');
        reseller_div.classList.add('hide');
    }
})
/* 
var reseller_name = document.getElementById('reseller_name');
var service_no = document.getElementById('service_no');

source.addEventListener('change', function() {
    if (this.value == "Reseller") {
        service_no.classList.remove('hide');
        my_div.classList.remove('hide');
    } else {
        service_no.classList.add('hide');
        my_div.classList.add('hide');
    }
}) */
</script>
<?php $this->load->view('admin/footer.php'); ?>