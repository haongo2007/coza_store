<div class="row justify-content-center m-auto p-tb-80 w-100">
  <div class="col-xl-8 col-sm-10 order-xl-1">
    <div class="card">
      <div class="card-profile-image">
        <a href="#">
          <img src="<?php echo $user['avatar'] ?>" class="rounded-circle w-100">
        </a>
      </div>
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Edit profile </h3>
          </div>
          <div class="col-4 text-right">
            <a href="#!" class="btn btn-sm btn-primary">Settings</a>

            <a href="<?php echo base_url('user/logout') ?>" class="btn btn-sm btn-danger">Logout</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form>
          <h6 class="heading-small text-muted mb-4">User information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-username">User Name</label>
                  <input type="text" id="input-username" class="form-control" placeholder="Full Name" value="<?php echo $user['name'] ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Email address</label>
                  <input type="email" id="input-email" class="form-control" placeholder="Your Email" value="<?php echo $user['email'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="exampleDatepicker">Birthday</label>
                  <input type="text" id="input-birthday" class="form-control datepicker" placeholder="01/01/1996" value="<?php echo $user['birthday'] ?>">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-last-name">Gender</label>
                  <input type="text" id="input-last-name" class="form-control" placeholder="Gender" value="<?php echo $user['gender'] ?>">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <!-- Address -->
          <h6 class="heading-small text-muted mb-4">Contact information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="input-address">Address</label>
                  <input id="input-address" class="form-control" placeholder="Home Address" value="<?php echo $user['address'] ?>" type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="input-city">City</label>
                  <input type="text" id="input-city" class="form-control" placeholder="City" value="<?php echo $user['city'] ?>">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="input-country">Country</label>
                  <input type="text" id="input-country" class="form-control" placeholder="Country" value="<?php echo $user['country'] ?>">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" for="input-country">Postal code</label>
                  <input type="number" id="input-postal-code" class="form-control" placeholder="Postal code" value="<?php echo $user['postcode'] ?>">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <!-- Description -->
          <h6 class="heading-small text-muted mb-4">About me</h6>
          <div class="pl-lg-4">
            <div class="form-group">
              <label class="form-control-label">About Me</label>
              <textarea rows="4" class="form-control" placeholder="A few words about you ...">A beautiful premium dashboard for Bootstrap 4.</textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo public_url('admin') ?>/assets/css/argon-dashboard.min.css">