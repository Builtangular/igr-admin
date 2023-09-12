<?php $this->load->view('admin/header.php'); 
$countries = array("Global", "North America", "Europe", "Asia Pacific", "RoW", "Africa", "GCC", "MENA", "BRICS", "Latin America", "MEA", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Korea", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Insert Query Details
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
                        <h1 class="box-title"> Insert Query Details</h1>
                    </div>
                    <form autocomplete="off" action="<?php echo base_url(); ?>admin/query/insert" id="employment-form"
                        method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="control-label col-md-1">Source <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="source" id="source" required>
                                        <?php if($Role_id == 7 || $Role_id == 10) { ?>
                                        <option value="Email" selected>Email</option>
                                        <option value="Website">Website</option>
                                        <option value="Reseller">Reseller</option>
                                        <?php }else{ ?>
                                        <option value="" selected>Select Source</option>
                                        <option value="Email">Email</option>
                                        <option value="Website">Website</option>
                                        <option value="Reseller">Reseller</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Type <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <select class="form-control b-none" name="type" id="type" required>
                                        <option value="" selected>Select Type</option>
                                        <option value="Sample Request">Sample Request</option>
                                        <option value="TOC Request">TOC Request</option>
                                        <option value="Customization">Customization</option>
                                        <option value="Enquiry">Enquiry</option>
                                        <option value="Discount Request">Discount Request</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-1">Email Id <span class="text-red">*</span></label>
                                <div class="col-md-2">
                                    <input type="text" id="source_mail_id" name="source_mail_id" class="form-control"
                                        placeholder="Email Id" required>
                                </div>
                                <label class="control-label col-md-1 hide" id="reseller_div">Reseller</label>
                                <div class="col-md-2">
                                    <select class="form-control b-none hide" id="reseller_name" name="reseller_name">
                                        <option value="" selected>Reseller Name</option>
                                        <?php foreach($reseller_list as $list){	?>
                                        <option value="<?php echo $list->reseller_name;?>">
                                            <?php echo $list->reseller_name; ?></option>
                                        <?php }	?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Scope Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="scope_name" name="scope_name" required>
                                            <option value="" selected>Select Scope</option>
                                            <?php /* foreach($ScopeList as $scope) { ?>
                                            <option value="<?php echo $scope->name;?>"><?php echo $scope->name; ?>
                                            </option>
                                            <?php }  */ ?>
                                            <?php foreach($countries as $country){?>
                                            <option value="<?php echo $country; ?>"><?php echo $country; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_name" name="client_name" class="form-control"
                                            placeholder="Client Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone No.</label>
                                    <div class="col-md-8">
                                        <input type="text" id="phone_no" name="phone_no" class="form-control"
                                            placeholder="Phone No.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name</label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">LinkedIn Profile </label>
                                    <div class="col-md-8">
                                        <input type="text" id="linkedin_profile" name="linkedin_profile" class="form-control"
                                            placeholder="LinkedIn Profile">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Report Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="report_name" name="report_name" class="form-control"
                                            placeholder="Report Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Email</label>
                                    <div class="col-md-8">
                                        <input type="text" id="client_email" name="client_email" class="form-control"
                                            placeholder="Client Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Client Meassage </label>
                                    <div class="col-md-8">
                                        <textarea name="client_message" id="client_message" rows="6"
                                            class="form-control" placeholder="Client Meassage"></textarea>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lead Date <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="lead_date" name="lead_date" class="form-control"
                                            placeholder="Lead Date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" class="form-control" id="id"
                                value="<?php if(!empty($reseller_service_details)){echo $reseller_service_details->id;}?>">
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
</script>
<?php $this->load->view('admin/footer.php'); ?>