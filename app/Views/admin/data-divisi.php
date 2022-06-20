<?= $this->extend('admin/layout/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <!-- <div class="swal" data-swal="<?= session()->get('message') ?>"></div> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#tambahDivisiModals"><span><i class="fas fa-plus"></i></span> Tambah Divisi Baru</button>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>Nama Divisi</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($hasil as $value) : ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $value['divisi_name']; ?></td>
                <td class="d-flex justify-content-center">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="<?= base_url('hapus-divisi/' . $value['divisi_id']) ?>" class="btn btn-danger btn-hapus"><span><i class="fas fa-eraser"></i></span></a>
                    </div>
                    <div class="col-sm-6">
                      <a href="<?= base_url('edit-divisi/' . $value['divisi_id']) ?>" class="btn btn-success"><span><i class="fas fa-edit"></i></span></a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah Divisi -->
<div class="modal fade" id="tambahDivisiModals" tabindex="-1" aria-labelledby="tambahDivisiModalsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahDivisiModalsLabel">Tambah Admin Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="user" action="<?= base_url('tambah-divisi') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="nip">Nama Divisi</label>
            <input type="text" class="form-control <?= $validation->hasError('divisi_name') ? 'is-invalid' : '' ?>" name="divisi_name" id="divisi_name" placeholder="Masukkan nama divisi...">
            <div id="validationServer03Feedback" class="invalid-feedback">
              <?= $validation->getError('divisi_name') ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>