<div class="row justify-content-center p-tb-50 w-100">
  <div class="col-lg-5 col-md-7">
    <div class="card bg-secondary border-0 mb-0">
      <div class="card-header bg-transparent pb-5">
        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
        <div class="btn-wrapper text-center">
          <a href="<?php echo $facebook_login_url ?>" class="btn btn-neutral btn-icon">
            <span class="btn-inner--icon"><img src="<?php echo $assets ?>/images/icons/icon-facebook.png"></span>
            <span class="btn-inner--text">Facebook</span>
          </a>
          <a href="<?php echo $google_login_url ?>" class="btn btn-neutral btn-icon">
            <span class="btn-inner--icon"><img src="<?php echo $assets ?>/images/icons/google.svg"></span>
            <span class="btn-inner--text">Google</span>
          </a>
        </div>
      </div>
      <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
          <small>Or sign in with credentials</small>
        </div>
        <form role="form">
          <div class="form-group mb-3">
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
              </div>
              <input class="form-control" placeholder="Email" type="email">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
              </div>
              <input class="form-control" placeholder="Password" type="password">
            </div>
          </div>
          <div class="custom-control custom-control-alternative custom-checkbox">
            <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
            <label class="custom-control-label" for=" customCheckLogin">
              <span class="text-muted">Remember me</span>
            </label>
          </div>
          <div class="text-center">
            <button type="button" class="btn btn-primary my-4">Sign in</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-6">
        <a href="#" class="text-light"><small>Forgot password?</small></a>
      </div>
      <div class="col-6 text-right">
        <a href="<?php echo base_url('user/register') ?>" class="text-light"><small>Create new account</small></a>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin') ?>/assets/css/argon-dashboard.min.css">
<link href="<?php echo public_url('admin') ?>/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />