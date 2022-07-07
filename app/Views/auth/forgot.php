<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>
<div class="authentication-wrapper authentication-basic container-p-y">
  <div class="authentication-inner py-4">
    <!-- Forgot Password -->
    <div class="card">
      <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
          <a href="<?= base_url('login') ?>" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
              <img src="<?= base_url() ?>/img/logo.png" width="80px" alt="">
            </span>
            <span class="app-brand-text demo text-body fw-bolder">Serve Me!</span>
          </a>
        </div>
        <!-- /Logo -->
        <?= view('Myth\Auth\Views\_message_block') ?>
        <h4 class="mb-2">Forgot Password? 🔒</h4>
        <p class="mb-4"><?= lang('Auth.enterEmailForInstructions') ?></p>
        <form id="formAuthentication" class="mb-3" action="<?= route_to('forgot') ?>" method="POST">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" placeholder="Enter your email" autofocus />
            <div class="invalid-feedback">
              <?= session('errors.email') ?>
            </div>
          </div>
          <button type="submit" class="btn btn-primary d-grid w-100"><?= lang('Auth.sendInstructions') ?></button>
        </form>
        <div class="text-center">
          <a href="<?= base_url('login') ?>" class="d-flex align-items-center justify-content-center">
            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
            Back to login
          </a>
        </div>
      </div>
    </div>
    <!-- /Forgot Password -->
  </div>
</div>
<?= $this->endsection() ?>