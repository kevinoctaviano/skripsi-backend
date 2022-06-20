<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <form class="user" action="<?= route_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="email">Firstname</label>
                                <input type="text" class="form-control form-control-user <?php if(session('errors.firstname')) : ?>is-invalid<?php endif ?>" id="exampleFirstName"
                                    placeholder="First Name" name="firstname">
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Lastname</label>
                                <input type="text" class="form-control form-control-user <?php if(session('errors.lastname')) : ?>is-invalid<?php endif ?>" id="exampleLastName"
                                    placeholder="Last Name" name="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"><?=lang('Auth.email')?></label>
                            <input type="email" class="form-control form-control-user <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" id="exampleInputEmail"
                                placeholder="Email Address" value="<?= old('email') ?>" name="email">
                        </div>
                        <div class="form-group">
                            <label for="username"><?=lang('Auth.username')?></label>
                            <input type="text" class="form-control form-control-user <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="password"><?=lang('Auth.password')?></label>
                                <input type="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" autocomplete="off"
                                    id="exampleInputPassword" placeholder="<?=lang('Auth.password')?>" name="password">
                            </div>
                            <div class="col-sm-6">
                                <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                                <input type="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" autocomplete="off"
                                    id="exampleRepeatPassword" placeholder="<?=lang('Auth.repeatPassword')?>" name="pass_confirm">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            <?=lang('Auth.register')?>
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= route_to('login') ?>">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>