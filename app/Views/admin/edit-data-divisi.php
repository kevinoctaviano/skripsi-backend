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
          <form class="user" action="<?= base_url('update-divisi/' . $up['divisi_id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="old_password">Nama Divisi :</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?= $up['divisi_name'] ?>" name="divisi_name">
              </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary btn-user w-25">
                Update
              </button>
              <a href="/data-divisi" class="btn btn-secondary btn-user w-25 ml-3">Back</a>
            </div>
          </form>
        <?php endforeach;  ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>