<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Infinium Admin</title>
    <link href="<?php echo base_url(); ?>assets/admin/css/style.min.css" rel="stylesheet" />
</head>
<body>
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <!-- Page wrapper  -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
			<div class="error-body text-center">
				<h1 class="error-title text-cyan">Infinium Admin</h1>
			</div>
                <center><div class="col-md-4">
                    <div class="card">
                        <form action="<?php echo base_url('admin/login'); ?>" class="form-horizontal" method="post">
                            <div class="card-body">
                                <center><h4 class="card-title">Login</h4></center>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 text-end control-label col-form-label">User Name
                                        </label>
                                    <div class="col-sm-9">
                                        <input type="email" name="username" class="form-control" id="username"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 text-end control-label col-form-label">Password
                                        </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Password" required>
                                    </div>
                                </div>
                              <div class="border-top">
                                  <div class="card-body">
                                      <button type="submit" class="btn btn-primary">
                                          Submit
                                      </button>
                                  </div>
                              </div>
                        </form>
                    </div></center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>