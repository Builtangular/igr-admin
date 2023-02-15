<?php $this->load->view('admin/header.php'); ?>

<?php $Period = array('2010' , '2011' , '2012' , '2013' , '2014' , '2015' , '2016' , '2017' , '2018' , '2019' , '2020' , '2021' , '2022' , '2023' , '2024' , '2025' , '2026' , '2027' , '2028' , '2029' , '2030' , '2031' , '2032' , '2033' , '2034' , '2035' , '2036' , '2037' , '2038' , '2039' , '2040' , '2041' , '2042' , '2043' , '2044' , '2045' , '2046' , '2047' , '2048' , '2049' , '2050' , '2051' , '2052' , '2053' , '2054' , '2055' , '2056' , '2057' , '2058' , '2059' , '2060' , '2061' , '2062' , '2063' , '2064' , '2065' , '2066' , '2067' , '2068' , '2069' , '2070' , '2071' , '2072' , '2073' , '2074' , '2075' , '2076' , '2077' , '2078' , '2079' , '2080' , '2081' , '2082' , '2083' , '2084' , '2085' , '2086' , '2087' , '2088' , '2089' , '2090' , '2091' , '2092' , '2093' , '2094' , '2095' , '2096' , '2097' , '2098' , '2099');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Employment Details
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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title"> Update Employment Details</h1>
                    </div>
                    <form action="<?php echo base_url(); ?>admin/employee/update_employment/<?php echo $emp_id; ?>"
                        id="employment-form" method="post" class="form-horizontal" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            value="<?php echo $single_empolyment_data->company_name;?>"
                                            placeholder="Company Name" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Date of Joining <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="date_of_joining" name="date_of_joining"
                                            value="<?php echo $single_empolyment_data->date_of_joining;?>"
                                            class="form-control" placeholder="Joining Date">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            value="<?php echo $single_empolyment_data->designation;?>"
                                            placeholder="Designation">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Job Type <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control b-none" id="job_type" name="job_type"
                                            placeholder="">
                                            <option value="<?php echo $single_empolyment_data->job_type; ?>" selected>
                                                <?php echo $single_empolyment_data->job_type; ?></option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Freelance">Freelance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Reason For Leaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="reason_for_leaving" name="reason_for_leaving"
                                            class="form-control"
                                            value="<?php echo $single_empolyment_data->reason_for_leaving;?>"
                                            placeholder="Reason For Leaving">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Company Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <textarea name="company_address" id="company_address" rows="3"
                                            class="form-control"
                                            placeholder="Company Address"><?php echo $single_empolyment_data->company_address; ?></textarea>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Date of Releaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" id="date_of_releaving" name="date_of_releaving"
                                            value="<?php echo $single_empolyment_data->date_of_releaving;?>"
                                            class="form-control" placeholder="Date Of Releaving" required>
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Last Drown Salary <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="last_drown_salary" name="last_drown_salary"
                                            value="<?php echo $single_empolyment_data->last_drown_salary;?>"
                                            class="form-control" placeholder="Last Drown Salary">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Ref. Contact No. <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no"
                                            value="<?php echo $single_empolyment_data->reference_contact_no;?>"
                                            class="form-control" placeholder="Reference Contact Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" id="emp_id" name="emp_id"
                                value="<?php echo $single_empolyment_data->emp_id;?>" class="form-control">
                            <input type="submit" class="btn btn-info pull-right" style='margin-right:16px' name="button"
                                value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('admin/footer.php'); ?>