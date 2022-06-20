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
        <div class="card o-hidden border-0 shadow-lg w-100">
            <div class="card-body p-5">
                <form class="user" action="/profile/<?= user_id() ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?= csrf_field() ?>
                        <div class="col-sm-6">
                            <label for="foto">Profile Picture</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon01" onchange="PreviewImage()">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <?php foreach ($result as $rs) :  if ($rs['img'] === null) : ?>
                                        <img src="/img/undraw_profile.svg" class="img-thumbnail img-preview" width="250">
                                    <?php else : ?>
                                        <img src="/img/<?= $rs['img'] ?>" class="img-thumbnail img-preview" width="250">
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="form-control-plaintext" for="email"><?= lang('Auth.email') ?></label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control-plaintext font-weight-bold" id="exampleInputEmail" placeholder="Email Address" value="<?= $rs['email'] ?>" name="email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="email">Firstname</label>
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstname" value="<?= $rs['firstname'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Lastname</label>
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="lastname" value="<?= $rs['lastname'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-user" name="username" value="<?= $rs['username'] ?>">
                            </div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary btn-user w-25">
                                Update Profile
                            </button>
                            <a href="<?= base_url() ?>" class="btn btn-secondary btn-user w-25 ml-3">Back</a>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>