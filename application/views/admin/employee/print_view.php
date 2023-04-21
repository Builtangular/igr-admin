<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $employee_data->first_name.'_'.$employee_data->last_name.'_details'; ?></title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">


    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script nonce="9affe377-fd07-43d7-a31d-019d7c2de80f">
    (function(w, d) {
            ! function(f, g, h, i) {
                f[h] = f[h] || {};
                f[h].executed = [];
                f.zaraz = {
                    deferred: [],
                    listeners: []
                };
                f.zaraz.q = [];
                f.zaraz._f = function(j) {
                    return function() {
                        var k = Array.prototype.slice.call(arguments);
                        f.zaraz.q.push({
                            m: j,
                            a: k
                        })
                    }
                };
                for (const l of ["track", "set ","
                            debug "])f.zaraz[l]=f.zaraz._f(l);f.zaraz.init=()=>{var m=g.getElementsByTagName(i)[0],n=g.createElement(i),o=g.getElementsByTagName("
                            title ")[0];o&&(f[h].t=g.getElementsByTagName("
                            title ")[0].text);f[h].x=Math.random();f[h].w=f.screen.width;f[h].h=f.screen.height;f[h].j=f.innerHeight;f[h].e=f.innerWidth;f[h].l=f.location.href;f[h].r=g.referrer;f[h].k=f.screen.colorDepth;f[h].n=g.characterSet;f[h].o=(new Date).getTimezoneOffset();if(f.dataLayer)for(const s of Object.entries(Object.entries(dataLayer).reduce(((t,u)=>({...t[1],...u[1]})))))zaraz.set(s[0],s[2],{scope:"
                            page "});f[h].q=[];for(;f.zaraz.q.length;){const v=f.zaraz.q.shift();f[h].q.push(v)}n.defer=!0;for(const w of[localStorage,sessionStorage])Object.keys(w||{}).filter((y=>y.startsWith("
                            _zaraz_ "))).forEach((x=>{try{f[h]["
                            z_ "+x.slice(7)]=JSON.parse(w.getItem(x))}catch{f[h]["
                            z_ "+x.slice(7)]=w.getItem(x)}}));n.referrerPolicy="
                            origin ";n.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(f[h])));m.parentNode.insertBefore(n,m)};["
                            complete ","
                            interactive "].includes(g.readyState)?zaraz.init():f.addEventListener("
                            DOMContentLoaded ",zaraz.init)}(w,d,"
                            zarazData ","
                            script ");})(window,document);
    </script>
</head>

<body onload="window.print();">
<!-- <body> -->
    <div class="wrapper">
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-user"></i> Employee Details
                        <small class="pull-right">Date: <?php echo date('d-m-Y'); ?></small>
                    </h2>
                </div>
            </div>
            <div class="row">
                <h4 class="box-title text-info list-group"><i class="fa fa-arrow-right"></i> Personal Information</h4>
                <div class="col-xs-6 table-responsive">
                    <table class="table table-striped">
                        <thead>
                           <!--  <tr>
                                <th>Title</th>
                                <th>Value</th>
                            </tr> -->
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold">Employee ID</td>
                                <td><?php echo $employee_data->emp_code; ?></td>
                            </tr>                           
                            <tr>
                                <td class="text-bold">Joining Date</td>
                                <td><?php echo date('d-m-Y', strtotime($employee_data->joining_date)); ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Full Name</td>
                                <td><?php echo $employee_data->prefix.' '.$employee_data->first_name.' '.$employee_data->middle_name.' '.$employee_data->last_name; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Gender</td>
                                <td><?php echo $employee_data->gender; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Mobile No.</td>
                                <td><?php echo $employee_data->mobile_number; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Email Id</td>
                                <td><?php echo $employee_data->personal_email_id; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Status</td>
                                <td><?php echo $employee_data->marital_status; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Father Name</td>
                                <td><?php echo $employee_data->father_name; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Permant Address</td>
                                <td><?php echo $employee_data->permant_address; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Relative Name</td>
                                <td><?php echo $employee_data->relative_name; ?></td>
                            </tr> 
                            <tr>
                                <td class="text-bold">Reference Name</td>
                                <td><?php echo $employee_data->reference_name; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Aadhaar No.</td>
                                <td><?php echo $employee_data->aadhaar_no; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Education</td>
                                <td><?php echo $employee_data->degree; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Department</td>
                                <td><?php echo $employee_data->department; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">UAN</td>
                                <td><?php echo $employee_data->uan_no; ?></td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-6 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <!-- <tr>
                                <th>Title</th>
                                <th>Value</th>
                            </tr> -->
                        </thead>
                        <tbody>                             
                            <tr>
                                <td class="text-bold">Job Type</td>
                                <td><?php echo $employee_data->job_type; ?></td>
                            </tr>                            
                            <tr>
                                <td class="text-bold">Appraisal On</td>
                                <td><?php echo date('d-m-Y', strtotime($employee_data->appraisal_date)); ?></td>
                            </tr>                            
                            <tr>
                                <td class="text-bold">DOB</td>
                                <td><?php echo date('d-m-Y', strtotime($employee_data->date_of_birth)); ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">User Type</td>
                                <td><?php echo $employee_data->user_type; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">A/T Mobile</td>
                                <td><?php echo $employee_data->alternate_mobile_no; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Official Email</td>
                                <td><?php echo $employee_data->official_email_id; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Resign Date</td>
                                <td><?php echo $employee_data->resignation_date; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Spouse</td>
                                <td><?php echo $employee_data->spouse_name; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Current Address</td>
                                <td><?php echo $employee_data->current_address; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Relative Number</td>
                                <td><?php echo $employee_data->relative_contact_no; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Reference Number</td>
                                <td><?php echo $employee_data->reference_contact_no; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">PAN No.</td>
                                <td><?php echo $employee_data->pan_no; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Passing Year</td>
                                <td><?php echo $employee_data->passing_year; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Job Profile</td>
                                <td><?php echo $employee_data->job_profile; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">PF No.</td>
                                <td><?php echo $employee_data->pf_no; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($employment_details){?>
            <div class="row">
                <h4 class="box-title text-info list-group"><i class="fa fa-arrow-right"></i> Employment Details</h4>
                <?php foreach($employment_details as $employment){?>
                <div class="col-xs-6 table-responsive">
                    <table class="table table-striped">                    
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold">Company Name</td>
                                <td><?php echo $employment->company_name; ?></td>
                            </tr>                           
                            <tr>
                                <td class="text-bold">Joining Date</td>
                                <td><?php echo date('d-m-Y', strtotime($employment->date_of_joining)); ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Designation</td>
                                <td><?php echo $employment->designation; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Reason for Leaving</td>
                                <td><?php echo $employment->reason_for_leaving; ?></td>
                            </tr>                       
                        </tbody>                    
                    </table>
                </div>
                <div class="col-xs-6 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        </thead>
                        <tbody>                             
                            <tr>
                                <td class="text-bold">Company Address</td>
                                <td><?php echo $employment->company_address; ?></td>
                            </tr>                            
                            <tr>
                                <td class="text-bold">Releaving Date</td>
                                <td><?php echo date('d-m-Y', strtotime($employee_data->appraisal_date)); ?></td>
                            </tr>                            
                            <tr>
                                <td class="text-bold">Last Drown Salary</td>
                                <td><?php echo $employment->last_drown_salary; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold">Ref. Contact No</td>
                                <td><?php echo $employment->reference_contact_no; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            </section><!-- /.invoice -->

    </div> <!-- /.wrapper -->

    <script data-cfasync="false"
        src="https://adminlte.io/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
</body>

</html>