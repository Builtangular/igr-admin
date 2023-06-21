<html>

<head>
    <meta charset="UTF-8">
    <title>Infinium Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/admin//css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/admin/css/skin-blue.min.css" rel="stylesheet" type="text/css" />
</head>
<script nonce="7f47fcf6-fd16-454e-8992-bf3ea737a930">
(function(w, d) {
    ! function(a, e, t, r) {
        a.zarazData = a.zarazData || {};
        a.zarazData.executed = [];
        a.zaraz = {
            deferred: [],
            listeners: []
        };
        a.zaraz.q = [];
        a.zaraz._f = function(e) {
            return function() {
                var t = Array.prototype.slice.call(arguments);
                a.zaraz.q.push({
                    m: e,
                    a: t
                })
            }
        };
        for (const e of ["track", "set", "debug"]) a.zaraz[e] = a.zaraz._f(e);
        a.zaraz.init = () => {
            var t = e.getElementsByTagName(r)[0],
                z = e.createElement(r),
                n = e.getElementsByTagName("title")[0];
            n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
            a.zarazData.x = Math.random();
            a.zarazData.w = a.screen.width;
            a.zarazData.h = a.screen.height;
            a.zarazData.j = a.innerHeight;
            a.zarazData.e = a.innerWidth;
            a.zarazData.l = a.location.href;
            a.zarazData.r = e.referrer;
            a.zarazData.k = a.screen.colorDepth;
            a.zarazData.n = e.characterSet;
            a.zarazData.o = (new Date).getTimezoneOffset();
            a.zarazData.q = [];
            for (; a.zaraz.q.length;) {
                const e = a.zaraz.q.shift();
                a.zarazData.q.push(e)
            }
            z.defer = !0;
            for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith(
                "_zaraz_"))).forEach((t => {
                try {
                    a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                } catch {
                    a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                }
            }));
            z.referrerPolicy = "origin";
            z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData)));
            t.parentNode.insertBefore(z, t)
        };
        ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded",
            zaraz.init)
    }(w, d, 0, "script");
})(window, document);
</script>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Header -->
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <span class="logo-mini"><b>IGR</b></span>
                <span class="logo-lg"><b>Infinium</b> Admin</span>
            </a>
            <!-- <a href="" class="logo"><b>Infinium Admin</b></a> -->

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Logout Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="<?php echo base_url(); ?>admin/login/logout">
                                <i class="fa fa-power-off"></i>
                                <span class="hidden-xs">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Sidebar -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url(); ?>assets/admin/img/user2-160x160.jpg" class="img-circle"
                            alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $Login_user_name; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><a href="<?php echo base_url(); ?>admin/dashboard"><span>Dashboard</span></a>
                    </li>
                    <!-- Optionally, you can add icons to the links -->
                    <?php if($Role_id == 0){ ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-table"></i><span class="text-bold">Master Setup</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/scope"><span>Scope Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/category"><span>Category Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country"><span>Country Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/region"><span>Region Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/codedecode_type"><span>Codedecode
                                        Type</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/codedecode_description"><span>Codedecode
                                        Description</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/dro_type"><span>DRO Type</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/image_text_write"><span>Upload Text Write
                                        Image</span></a></li>
                        </ul>
                    </li>
                    <?php } if($Role_id == 0 || $Role_id == 2){ ?>
                    <!--  <li class="treeview">
                        <a href="#"><i class="fa fa-files-o"></i><span class="text-bold">Report Management</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/report"><span>Published Reports</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country-rd"><span>Country Reports</span></a>
                            </li>
                        </ul>
                    </li> -->
                    <li><a href="<?php echo base_url(); ?>admin/report"><i class="fa fa-file-pdf-o"></i><span
                                class="text-bold">Published Reports</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/country-rd"><i class="fa fa-file-word-o"></i><span
                                class="text-bold">Country Reports</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/report/verified_rd"><i class="fa fa-file"></i><span
                                class="text-bold">Verified RDs</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/report/add"><i class="fa fa-plus"></i><span
                                class="text-bold">Add New RD</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/spreadsheet/filter"><i
                                class="fa fa-file-excel-o"></i><span class="text-bold">Export Reports</span></a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>analyst/generate-rd"><i class="fa fa-arrow-down"></i><span
                                class="text-bold">Generate RD</span></a></li> -->
                    <li><a href="<?php echo base_url(); ?>admin/report/assign_rd"><i class="fa fa-arrow-right"></i><span
                                class="text-bold">Assign & Generate RDs</span></a></li>
                    <?php } ?>
                    <?php if($Role_id == 3){ ?>
                    <li><a href="<?php echo base_url(); ?>analyst/report/published"><i
                                class="fa fa-file-word-o"></i><span class="text-bold">Published Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/report/processed"><i class="fa fa-files-o"></i><span
                                class="text-bold">Processed Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/report/add"><i class="fa fa-plus"></i><span
                                class="text-bold">Add New RD</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/generate-rd"><i class="fa fa-arrow-down"></i><span
                                class="text-bold">Generate RD</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-flag"></i><span class="text-bold">Country RD</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/country_rd/add"><i class="fa fa-circle-o"></i>Add</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country_rd/drafts"><i class="fa fa-circle-o"></i>Drafts</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country_rd/list"><i class="fa fa-circle-o"></i>List</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($Role_id == 4){ ?>
                    <li><a href="<?php echo base_url(); ?>manager/report/published"><i
                                class="fa fa-file-word-o"></i><span class="text-bold">Published Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>manager/report/processed"><i class="fa fa-files-o"></i><span
                                class="text-bold">Processed Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>manager/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                    <?php } ?>
                    <?php if($Role_id == 0 || $Role_id == 5){ ?>
                    <li><a href="<?php echo base_url(); ?>sales/custom-link"><i class="fa fa-link"></i><span
                                class="text-bold">Custom Link</span></a></li>
                    <li><a href="<?php echo base_url(); ?>sales/sample-query"><i class="fa fa-list"></i><span
                                class="text-bold">Sample Queries</span></a></li>
                    <li><a href="<?php echo base_url(); ?>sales/toc-query"><i class="fa fa-list-alt"></i><span
                                class="text-bold">TOC Queries</span></a></li>
                    <li><a href="<?php echo base_url(); ?>sales/customization-query"><i class="fa fa-list-ol"></i><span
                                class="text-bold">Customization Queries</span></a></li>
                    <li><a href="<?php echo base_url(); ?>sales/enquiry-query"><i class="fa fa-list-ul"></i><span
                                class="text-bold">Enquiry Queries</span></a></li>
                    <li class="treeview"><a href="#"><i class="fa fa-table"></i><span class="text-bold">Query
                                Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/query/add"><span>Add</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/query/drafts"><span>Drafts</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/query/list"><span>List</span></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($Role_id == 5 && $User_Type == "Team Lead" && $department == "Sales"){ ?>
                    <li><a href="<?php echo base_url(); ?>admin/query/assign_list"><i class="fa fa-file-text"></i><span
                                class="text-bold">Assigned Queries</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/query/upcoming_query_list"><i
                                class="fa fa-file-text"></i><span class="text-bold">Upcoming Queries</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/genrate_invoice/list"><i
                                class="fa fa-file-text"></i><span class="text-bold">Generate
                                Invoice</span></a></li>
                    <?php } ?>
                    <?php if($Role_id == 6){?>
                    <li><a href="<?php echo base_url(); ?>admin/jobpost"><i class="fa fa-tasks"></i><span
                                class="text-bold">Job Post</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/employee"><i class="fa fa-users"></i><span
                                class="text-bold">Employee Data</span></a></li>
                    <?php } ?>

                    <?php if($Role_id == 0 || $Role_id == 1){?>
                    <li class="treeview <?php echo $rmenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $rulist;?>"><a
                                    href="<?php echo base_url(); ?>admin/register-user"><span>Register
                                        User</span></a>
                            </li>
                            <li class="<?php echo $rqlist;?>"><a
                                    href="<?php echo base_url(); ?>admin/query/reseller_list"><span>Reseller</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $rjmenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">HRA</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $rjlist;?>"><a href="<?php echo base_url(); ?>admin/jobpost"><span>Job
                                        Post</span></a></li>
                            <li class="<?php echo $elist;?>"><a
                                    href="<?php echo base_url(); ?>admin/employee"><span>Employee
                                        Data</span></a></li>
                            <li class="<?php echo $ellist;?>"><a
                                    href="<?php echo base_url(); ?>admin/employee/letters"><span>Employment
                                        Letters</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $smenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">Marketing</span>
                            <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $slist;?>"><a
                                    href="<?php echo base_url(); ?>admin/spam-mail/list"><span>Mail
                                        List</span></a></li>
                            <li class="<?php echo $sadd;?>"><a
                                    href="<?php echo base_url(); ?>admin/spam-mail"><span>Spam Mail</span></a>
                            </li>
                            <li class="<?php echo $supload;?>"><a
                                    href="<?php echo base_url(); ?>admin/spam-mail/import_file"><span>Verify
                                        Mail</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $qmenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">Query
                                Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $qadd;?>"><a
                                    href="<?php echo base_url(); ?>admin/query/add"><span>Add</span></a></li>
                            <li class="<?php echo $qlist; ?>"><a
                                    href="<?php echo base_url(); ?>admin/query/list"><span>List</span></a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $gimenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">Generate Invoice
                            </span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $gilist;?>"><a
                                    href="<?php echo base_url(); ?>admin/genrate_invoice/list"><span>List</span></a>
                            </li>
                            <li class="<?php echo $ilist;?>"><a
                                    href="<?php echo base_url(); ?>admin/genrate_invoice/genrated_invoice_list"><span>Generated</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $cimenu_active;?>"><a href="#"><i class="fa fa-table"></i><span
                                class="text-bold">Custom Invoice
                            </span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="<?php echo $ciadd;?>"><a
                                    href="<?php echo base_url(); ?>admin/custom_invoice/add"><span>Add</span></a></li>
                            <li class="<?php echo $cilist;?>"><a
                                    href="<?php echo base_url(); ?>admin/custom_invoice/list"><span>List</span></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($Role_id == 7 || $Role_id == 10){?>
                    <li><a href="<?php echo base_url(); ?>admin/spam-mail"><i class="fa fa-envelope-o"></i><span
                                class="text-bold">Spam Mail</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/spam-mail/import_file"><i
                                class="fa fa-file-excel-o"></i><span class="text-bold">Verify Mail</span></a></li>
                    <li class="treeview"><a href="#"><i class="fa fa-table"></i><span class="text-bold">Query
                                Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/query/add"><span>Add</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/query/list"><span>List</span></a></li>
                        </ul>
                    </li>
                    <!-- <li class="treeview">
                        <a href="#"><i class="fa fa-table"></i><span class="text-bold">Reseller</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/query/add_reseller"><span>Add</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/query/reseller_list"><span> List</span></a></li>
                        </ul>
                    </li> -->
                    <?php } if($Role_id == 8){?>
                    <li><a href="<?php echo base_url(); ?>analyst/generate-rd"><i class="fa fa-arrow-down"></i><span
                                class="text-bold">Generate RD</span></a></li>
                    <?php } ?>
            </section>
            <!-- /.sidebar -->
        </aside>