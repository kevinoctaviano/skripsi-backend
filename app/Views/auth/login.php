<?php

use CodeIgniter\Database\BaseUtils;
?>
<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
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
                <h4 class="mb-2 text-center">Welcome to Serve Me App! 👋</h4>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form id="formAuthentication" class="mb-3" action="<?= base_url('login') ?>" method="POST">
                    <?= csrf_field() ?>
                    <?php if ($config->validFields === ['email']) : ?>
                        <div class="mb-3">
                            <label for="login" class="form-label">Email or Username</label>
                            <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="email" name="login" placeholder="Enter your email or username" autofocus />
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label for="login" class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?= lang('Auth.emailOrUsername') ?>" name="login">
                            <div class="invalid-feedback">
                                <?= session('errors.login') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <?php if ($config->activeResetter) : ?>
                                <a href="<?= base_url('forgot') ?>">
                                    <small><?= lang('Auth.forgotYourPassword') ?></small>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($config->allowRemembering) : ?>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" <?php if (old('remember')) : ?> checked <?php endif ?> />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($config->allowRegistration) : ?>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit"><?= lang('Auth.loginAction') ?></button>
                        </div>
                    <?php endif; ?>
                </form>

                <p class="text-center">
                    <span>New on our platform?</span>
                    <a href="<?= base_url('register') ?>">
                        <span>Create an account</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>
<?= $this->endsection() ?>