<div data-overlay class="min-vh-100 bg-light d-flex flex-column justify-content-md-center">
  <section class="py-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6">
          <!--ALERT-->
          <?php if ($this->session->flashdata('alert')) {
            $dataalert = explode("|", $this->session->flashdata('alert'));
            $status = $dataalert[0];
            $message = $dataalert[1];
          ?>
            <div class="alert alert-<?php echo $status; ?>">
              <?php echo $message; ?>
            </div>
          <?php } ?>
          <div class="card card-body shadow">
            <h1 class="h5 text-center">Sign In</h1>
            <form method="POST">
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="text-right text-small mt-2">
                  <a href="<?php echo base_url(); ?>account/forgot">Forgot Password?</a>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox text-small">
                  <input type="checkbox" class="custom-control-input" id="sign-in-remember">
                  <label class="custom-control-label" for="sign-in-remember">Remember me next time</label>
                </div>
              </div>
              <button class="btn btn-primary btn-block" type="submit">Sign In</button>
            </form>
          </div>
          <div class="text-center text-small mt-3">
            Don't have an account? <a href="<?php echo base_url(); ?>account/register">Sign up here</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>