<div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Company Name <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                            placeholder="Company Name">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Company Address <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="company_address" name="company_address"
                                            class="form-control" placeholder="Company Address">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date Of Joining <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="date_of_joining" name="date_of_joining"
                                            class="form-control" placeholder="Joining Date">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Date of Releaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="date" id="date_of_releaving" name="date_of_releaving"
                                            class="form-control" placeholder="Date Of Releaving">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Designation <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="designation" name="designation" class="form-control"
                                            placeholder="Designation">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Last Drown Salary <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="last_drown_salary" name="last_drown_salary"
                                            class="form-control" placeholder="Last Drown Salary">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Job Type <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control b-none" name="job_type" placeholder="">
                                            <option value="" selected>Select Job Type</option>
                                            <option value="Single User">Full Time</option>
                                            <option value="Enterprise">Part Time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reason For Leaving <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="reason_for_leaving" name="reason_for_leaving"
                                            class="form-control" placeholder="Reason For Leaving">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Reference Contact Number <span
                                            class="text-red">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" id="reference_contact_no" name="reference_contact_no"
                                            class="form-control" placeholder="Reference Contact Number">
                                        <span class="help-block margin" id="txtHint"></span>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <!-- <label> <a href="" class="btn btn-info pull-right" data-role="button" data-inline="true">Skip</a></label> -->
                                    <input type="submit" class="btn btn-info pull-right" style='margin-right:16px'
                                        value="Next">
                                    <input type="submit" class="btn btn-info pull-right" style='margin-right:16px'
                                        value="Skip">
                                    <!-- <a href="<?php echo base_url(); ?>admin/Employee_Details/employee_details"
                                        class="btn btn-primary pull-left" id="">
                                        <i class="fa fa-plus"></i> -->
                                        <span type="button" class="btn btn-info pull-left"
                                                id="emp_addrow"><i class="fa fa-plus"></i> Add</span>
                                        <input type="hidden" name="emp_details" id="emp_details" value="Employee Details" class="form-control">
                                       
                                    </a>
                                </div>
                            </div>