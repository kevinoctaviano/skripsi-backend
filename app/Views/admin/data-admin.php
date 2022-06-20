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
            <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#tambahAdminModal"><span><i class="fas fa-plus"></i></span> Tambah Admin Baru</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $value) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= $value['firstname'] . ' ' . $value['lastname']; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['created_at']; ?></td>
                                <td><?= $value['updated_at']; ?></td>
                                <td class="d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="<?= base_url('hapus-admin/' . $value['id']) ?>" class="btn btn-danger btn-hapus"><span><i class="fas fa-eraser"></i></span></a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?= base_url('edit-admin/' . $value['id']) ?>" class="btn btn-success"><span><i class="fas fa-edit"></i></span></a>
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
<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambahAdminModal" tabindex="-1" aria-labelledby="tambahAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAdminModalLabel">Tambah Admin Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?= base_url('tambah-admin') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" id="email" placeholder="Masukkan email...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Masukkan username...">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('username') ?>
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