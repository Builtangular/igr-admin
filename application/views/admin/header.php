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
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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

<body class="hold-transition skin-blue sidebar-mini">
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
                    <?php if($Role_id == 1){ ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-table"></i><span class="text-bold">Master Setup</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <!-- <li><a href="http://localhost/testapp/public/superadmin/codetype"><span>Code Type</span></a></li>
							<li><a href="http://localhost/testapp/public/superadmin/codedecode"><span>Code Decode</span></a></li> -->
                            <li><a href="<?php echo base_url(); ?>admin/scope"><span>Scope Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/category"><span>Category Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country"><span>Country Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/region"><span>Region Master</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/codedecode_type"><span>Codedecode
                                        Type</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/codedecode_description"><span>Codedecode
                                        Description</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/dro_type"><span>DRO Type</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/image_text_write"><span>Upload Text Write Image</span></a></li> 
                        </ul>
                    </li>
                    <?php } if($Role_id == 1 || $Role_id == 2){ ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-files-o"></i><span class="text-bold">Report Management</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url(); ?>admin/report"><span>Published Reports</span></a></li>
                            <li><a href="<?php echo base_url(); ?>admin/country-rd"><span>Country Reports</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url(); ?>admin/report/verified"><i class="fa fa-file-word-o"></i><span
                                class="text-bold">Verified RDs</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/report/add"><i class="fa fa-plus"></i><span
                                class="text-bold">Add New RD</span></a></li>
                    <li><a href="<?php echo base_url(); ?>admin/spreadsheet/filter"><i
                                class="fa fa-file-excel-o"></i><span class="text-bold">Export Reports</span></a></li>
                    <?php } ?>


                    <?php if($Role_id == 3){ ?>

                    <li><a href="<?php echo base_url(); ?>analyst/report/published"><i
                                class="fa fa-file-word-o"></i><span class="text-bold">Published Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/report/processed"><i
                                class="fa fa-files-o"></i><span>Processed Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>analyst/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                 
                    <li><a href="<?php echo base_url(); ?>analyst/report/add"><i class="fa fa-plus"></i><span
                                class="text-bold">Add New RD</span></a></li>
                    <!-- <li><a href="#"><span>Generate Report</span></a></li> -->
                    <?php } ?>

                    <?php if($Role_id == 4){ ?>

                    <li><a href="<?php echo base_url(); ?>manager/report/published"><i class="fa fa-file-word-o"></i><span
                                class="text-bold">Published Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>manager/report/processed"><i class="fa fa-files-o"></i><span>Processed
                                Report</span></a></li>
                    <li><a href="<?php echo base_url(); ?>manager/report/drafts"><i class="fa fa-file-code-o"></i><span
                                class="text-bold">Drafts</span></a></li>
                   
                   
                    <!-- <li><a href="#"><span>Generate Report</span></a></li> -->
                    <?php } ?>
                    <?php if($Role_id == 5){ ?>

                    <li><a href="<?php echo base_url(); ?>sales/custom_link"><i class="fa fa-file-word-o"></i><span
                                class="text-bold">Custom Link</span></a></li>

                    <!-- <li><a href="#"><span>Generate Report</span></a></li> -->
                    <?php } ?>
                </ul>
                </li>
                <!-- <li><a href="http://localhost/testapp/public/superadmin/enroll"><span>Enrollment</span></a></li>
                    <li><a href="#"><span>Generate Report</span></a></li> -->

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>