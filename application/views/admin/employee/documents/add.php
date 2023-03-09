<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>
<style>
ul {
    list-style: none;
}

ul b::before {
    content: "\2022";
    color: green;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Employee Documents
            <small></small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <style>
    .error {
        color: red;
    }
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class='row'>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Upload Documents</h1>
                    </div>
                    <form
                        action="<?php echo base_url(); ?>admin/employee/upload_documents/<?php echo $Emp_id;?>"
                        id="document-form" method="post" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Type <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control b-none" name="type" id="type"
                                            onchange="showDiv(this)" required>
                                            <option value="">--Select Type--</option>
                                            <option value="Aadhaar">Aadhaar</option>
                                            <option value="PAN">PAN</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Releaving Letter">Releaving Letter</option>
                                            <option value="SSC">SSC</option>
                                            <option value="HSC">HSC</option>
                                            <option value="Graduation">Graduation</option>
                                            <option value="Post Graduation">Post Graduation</option>
                                            <option value="Certificatioin">Certification</option>
                                            <option value="1">Other</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="my_id" style="display: none;">
                                    <label class="control-label col-md-3">Type <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" id="other_type" name="other_type" class="form-control"
                                            placeholder="insert type " />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="upload_file" id="upload_file" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Submit">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px'
                                formnovalidate name="button" value="Finish">                        
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">Documents List</h1>
                    </div>
                    <div class="box-body">
                        <ul>
                            <?php if($employee_doc[0]->doc_type == "Aadhaar" || $employee_doc[1]->doc_type == "Aadhaar" || $employee_doc[2]->doc_type == "Aadhaar" || $employee_doc[3]->doc_type == "Aadhaar" || $employee_doc[4]->doc_type == "Aadhaar" || $employee_doc[5]->doc_type == "Aadhaar" || $employee_doc[6]->doc_type == "Aadhaar" || $employee_doc[7]->doc_type == "Aadhaar" || $employee_doc[8]->doc_type == "Aadhaar" || $employee_doc[9]->doc_type == "Aadhaar" || $employee_doc[10]->doc_type == "Aadhaar"){?>
                            <li><b>Aadhaar</b></li>
                            <?php } else {?>
                            <li>Aadhaar</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "PAN" || $employee_doc[1]->doc_type == "PAN" || $employee_doc[2]->doc_type == "PAN" || $employee_doc[3]->doc_type == "PAN" || $employee_doc[4]->doc_type == "PAN" || $employee_doc[5]->doc_type == "PAN" || $employee_doc[6]->doc_type == "PAN" || $employee_doc[7]->doc_type == "PAN" || $employee_doc[8]->doc_type == "PAN" || $employee_doc[9]->doc_type == "PAN" || $employee_doc[10]->doc_type == "PAN"){?>
                            <li><b>PAN</b></li>
                            <?php } else {?>
                            <li>PAN</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Passport" || $employee_doc[1]->doc_type == "Passport" || $employee_doc[2]->doc_type == "Passport" || $employee_doc[3]->doc_type == "Passport" || $employee_doc[4]->doc_type == "Passport" || $employee_doc[5]->doc_type == "Passport" || $employee_doc[6]->doc_type == "Passport" || $employee_doc[7]->doc_type == "Passport" || $employee_doc[8]->doc_type == "Passport" || $employee_doc[9]->doc_type == "Passport" || $employee_doc[10]->doc_type == "Passport"){?>
                            <li><b>Passport</b></li>
                            <?php } else {?>
                            <li>Passport</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Releaving Letter" || $employee_doc[1]->doc_type == "Releaving Letter" || $employee_doc[2]->doc_type == "Releaving Letter" || $employee_doc[3]->doc_type == "Releaving Letter" || $employee_doc[4]->doc_type == "Releaving Letter" || $employee_doc[5]->doc_type == "Releaving Letter" || $employee_doc[6]->doc_type == "Releaving Letter" || $employee_doc[7]->doc_type == "Releaving Letter" || $employee_doc[8]->doc_type == "Releaving Letter" || $employee_doc[9]->doc_type == "Releaving Letter" || $employee_doc[10]->doc_type == "Releaving Letter"){?>
                            <li><b>Releaving Letter</b></li>
                            <?php } else {?>
                            <li>Releaving Letter</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "SSC" || $employee_doc[1]->doc_type == "SSC" || $employee_doc[2]->doc_type == "SSC" || $employee_doc[3]->doc_type == "SSC" || $employee_doc[4]->doc_type == "SSC" || $employee_doc[5]->doc_type == "SSC" || $employee_doc[6]->doc_type == "SSC" || $employee_doc[7]->doc_type == "SSC" || $employee_doc[8]->doc_type == "SSC" || $employee_doc[9]->doc_type == "SSC" || $employee_doc[10]->doc_type == "SSC"){?>
                            <li><b>SSC</b></li>
                            <?php } else {?>
                            <li>SSC</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "HSC" || $employee_doc[1]->doc_type == "HSC" || $employee_doc[2]->doc_type == "HSC" || $employee_doc[3]->doc_type == "HSC" || $employee_doc[4]->doc_type == "HSC" || $employee_doc[5]->doc_type == "HSC" || $employee_doc[6]->doc_type == "HSC" || $employee_doc[7]->doc_type == "HSC" || $employee_doc[8]->doc_type == "HSC" || $employee_doc[9]->doc_type == "HSC" || $employee_doc[10]->doc_type == "HSC"){?>
                            <li><b>HSC</b></li>
                            <?php } else {?>
                            <li>HSC</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Graduation" || $employee_doc[1]->doc_type == "Graduation" || $employee_doc[2]->doc_type == "Graduation" || $employee_doc[3]->doc_type == "Graduation" || $employee_doc[4]->doc_type == "Graduation" || $employee_doc[5]->doc_type == "Graduation" || $employee_doc[6]->doc_type == "Graduation" || $employee_doc[7]->doc_type == "Graduation" || $employee_doc[8]->doc_type == "Graduation" || $employee_doc[9]->doc_type == "Graduation" || $employee_doc[10]->doc_type == "Graduation"){?>
                            <li><b>Graduation</b></li>
                            <?php } else {?>
                            <li>Graduation</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Post Graduation" || $employee_doc[1]->doc_type == "Post Graduation" || $employee_doc[2]->doc_type == "Post Graduation" || $employee_doc[3]->doc_type == "Post Graduation" || $employee_doc[4]->doc_type == "Post Graduation" || $employee_doc[5]->doc_type == "Post Graduation" || $employee_doc[6]->doc_type == "Post Graduation" || $employee_doc[7]->doc_type == "Post Graduation" || $employee_doc[8]->doc_type == "Post Graduation" || $employee_doc[9]->doc_type == "Post Graduation" || $employee_doc[10]->doc_type == "Post Graduation"){?>
                            <li><b>Post Graduation</b></li>
                            <?php } else {?>
                            <li>Post Graduation</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Certificatioin" || $employee_doc[1]->doc_type == "Certificatioin" || $employee_doc[2]->doc_type == "Certificatioin" || $employee_doc[3]->doc_type == "Certificatioin" || $employee_doc[4]->doc_type == "Certificatioin" || $employee_doc[5]->doc_type == "Certificatioin" || $employee_doc[6]->doc_type == "Certificatioin" || $employee_doc[7]->doc_type == "Certificatioin" || $employee_doc[8]->doc_type == "Certificatioin" || $employee_doc[9]->doc_type == "Certificatioin" || $employee_doc[10]->doc_type == "Certificatioin"){?>
                            <li><b>Certificatioin</b></li>
                            <?php } else {?>
                            <li>Certificatioin</li>
                            <?php } ?>
                            <?php if($employee_doc[0]->doc_type == "Other" || $employee_doc[1]->doc_type == "Other" || $employee_doc[2]->doc_type == "Other" || $employee_doc[3]->doc_type == "Other" || $employee_doc[4]->doc_type == "Other" || $employee_doc[5]->doc_type == "Other" || $employee_doc[6]->doc_type == "Other" || $employee_doc[7]->doc_type == "Other" || $employee_doc[8]->doc_type == "Other" || $employee_doc[9]->doc_type == "Other" || $employee_doc[10]->doc_type == "Other"){?>
                            <li><b>Other</b></li>
                            <?php } else {?>
                            <li>Other</li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
function showDiv(select) {
    if (select.value == 1) {
        document.getElementById('my_id').style.display = "block";
    } else {
        document.getElementById('my_id').style.display = "none";
    }
}
</script>