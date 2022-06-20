<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>
  <div class="d-flex justify-content-center">
    <div class="card o-hidden border-0 shadow-lg w-75">
      <div class="card-body p-5">
        <?php foreach ($update as $up) : ?>
          <form class="user" action="<?= base_url('update-admin/' . $up['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="email">Email</label>
              </div>
              <div class="col-sm-8">
                <input type="email" class="form-control form-control-user" value="<?= $up['email'] ?>" name="email">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="firstname">Nama Awal</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-user" value="<?= $up['firstname'] ?>" name="firstname">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="lastname">Nama Akhir</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-user" value="<?= $up['lastname'] ?>" name="lastname">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="address">Username</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-user" value="<?= $up['username'] ?>" name="username">
              </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary btn-user w-25">
                Update
              </button>
              <a href="/data-admin" class="btn btn-secondary btn-user w-25 ml-3">Back</a>
            </div>
          </form>
        <?php endforeach;  ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>