<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>
<div class="swal" data-swal="<?= session()->get('success') ?>"></div>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#tambahPegawaiModal"><span><i class="fas fa-plus"></i></span> Tambah Pegawai Baru</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Division</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $value) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value['nip']; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['firstname'] . ' ' . $value['lastname']; ?></td>
                                <td><?= $value['address']; ?></td>
                                <td><?= $value['divisi_name']; ?></td>
                                <td class="d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="<?= base_url('hapus-pegawai/' . $value['id']) ?>" class="btn btn-danger btn-hapus"><span><i class="fas fa-eraser"></i></span></a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?= base_url('edit-pegawai/' . $value['id']) ?>" class="btn btn-success"><span><i class="fas fa-edit"></i></span></a>
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
<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?= base_url('tambah-pegawai') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nip">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" class="form-control <?= $validation->hasError('nip') ? 'is-invalid' : '' ?>" name="nip" id="nip" placeholder="Masukkan NIP...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nip') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Masukkan email...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Nama Pertama</label>
                        <input type="text" class="form-control <?= $validation->hasError('firstname') ? 'is-invalid' : '' ?>" name="firstname" id="firstname" placeholder="Masukkan nama pertama...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('firstname') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nama Kedua</label>
                        <input type="text" class="form-control <?= $validation->hasError('lastname') ? 'is-invalid' : '' ?>" name="lastname" id="lastname" placeholder="Masukkan nama kedua...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('lastname') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control <?= $validation->hasError('address') ? 'is-invalid' : '' ?>" id="address" name="address" placeholder="Masukkan alamat..." rows="3"></textarea>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('address') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="division">Divisi</label>
                        <select class="form-control <?= $validation->hasError('division') ? 'is-invalid' : '' ?>" name="division" id="division">
                            <option>=Pilih Divisi=</option>
                            <?php foreach ($divisi as $dv) : ?>
                                <option value="<?= $dv['divisi_id'] ?>"><?= $dv['divisi_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('division') ?>
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