<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <!-- Alert -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('warning')) : ?>
        <div class="alert alert-warning" role="alert">
            <?= session()->getFlashdata('warning') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('danger')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('danger') ?>
        </div>
    <?php endif; ?>
    <div class="d-flex justify-content-center">
        <div class="card o-hidden border-0 shadow-lg w-75">
            <div class="card-body p-5">
                <form class="user" action="/password-changed/<?= user_id() ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group row mb-3">
                        <div class="col-sm-4 d-flex justify-content-center my-auto">
                            <label for="old_password">Old Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-user <?= $validation->hasError('old_password') ? 'is-invalid' : '' ?>" placeholder="Old Password" name="old_password">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('old_password') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-sm-4 d-flex justify-content-center my-auto">
                            <label for="new_password">New Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-user <?= $validation->hasError('new_password') ? 'is-invalid' : '' ?>" placeholder="New Password" name="new_password">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('new_password') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-sm-4 d-flex justify-content-center my-auto">
                            <label for="confirmation_password">Confirmation Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control form-control-user <?= $validation->hasError('confirmation_password') ? 'is-invalid' : '' ?>" placeholder="Confirmation Password" name="confirmation_password">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('confirmation_password') ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-user w-25">
                            Update Password
                        </button>
                        <a href="<?= base_url() ?>" class="btn btn-secondary btn-user w-25 ml-3">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>