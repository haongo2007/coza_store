
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Login - Cozastore
  </title>
  <!-- Favicon -->
  <link href="<?php echo public_url('admin/assets') ?>/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?php echo public_url('admin/assets') ?>/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="<?php echo public_url('admin/assets') ?>/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?php echo public_url('admin/assets') ?>/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-6">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>sign in with credentials</small>
              </div>
              <form id="my_lg" role="form" action="<?php echo admin_url('login/check_login') ?>">
                <div class="alert alert-danger d-none" role="alert">
                  <strong class="txt">Danger!</strong>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="email" type="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core   -->
  <script src="<?php echo public_url('admin/assets') ?>/js/plugins/cookie/js.cookie.min.js"></script>
  <script src="<?php echo public_url('admin/assets') ?>/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo public_url('admin/assets') ?>/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo public_url('admin/assets') ?>/js/argon-dashboard.js"></script>
  <script src="<?php echo public_url('admin/assets') ?>/js/csrf_token.js"></script>
  <script src="<?php echo public_url('admin/assets') ?>/js/login.js"></script>
</body>

</html>