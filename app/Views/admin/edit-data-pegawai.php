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
          <form class="user" action="<?= base_url('update-pegawai/' . $up['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="old_password">Nomor Induk Pegawai :</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?= $up['nip'] ?>" name="nip">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="email">Email :</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?= $up['email'] ?>" name="email">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="firstname">Nama Awal :</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?= $up['firstname'] ?>" name="firstname">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="lastname">Nama Akhir :</label>
              </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?= $up['lastname'] ?>" name="lastname">
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="address">Alamat :</label>
              </div>
              <div class="col-sm-8">
                <textarea class="form-control" cols="3" name="address"><?= $up['address'] ?></textarea>
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-4 d-flex justify-content-center my-auto">
                <label for="division">Divisi</label>
              </div>
              <div class="col-sm-8">
                <select class="form-control" name="division" id="division">
                  <optgroup label="==Divisi terpilih==">
                    <option value="<?= $up['divisi_id'] ?>"><?= $up['divisi_name'] ?></option>
                  </optgroup>
                  <optgroup label="==Pilihan Divisi=="></optgroup>
                  <?php foreach ($divisi as $dv) : ?>
                    <option value="<?= $dv['divisi_id'] ?>"><?= $dv['divisi_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
              <button type="submit" class="btn btn-primary btn-user w-25">
                Update
              </button>
              <a href="/data-pegawai" class="btn btn-secondary btn-user w-25 ml-3">Back</a>
            </div>
          </form>
        <?php endforeach;  ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>