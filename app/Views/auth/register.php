<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register Card -->
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
                <h4 class="mb-2">Register your account here! 🚀</h4>
                <?= view('Myth\Auth\Views\_message_block') ?>
                <form id="formAuthentication" class="mb-3" action="<?= route_to('register') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" placeholder="Enter your username" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control <?php if (session('errors.firstname')) : ?>is-invalid<?php endif ?>" id="firstname" name="firstname" placeholder="Enter your firstname" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control <?php if (session('errors.lastname')) : ?>is-invalid<?php endif ?>" id="lastname" name="lastname" placeholder="Enter your lastname" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password"><?= lang('Auth.password') ?></label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="off" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="pass_confirm" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" autocomplete="off" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
                </form>

                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="<?= base_url('login') ?>">
                        <span>Sign in instead</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- Register Card -->
    </div>
</div>
<?= $this->endsection() ?>