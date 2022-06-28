<?= $this->extend('admin/layout/layout') ?>

<?= $this->section('content') ?>
<div class="swal" data-swal="<?= session()->get('success') ?>"></div>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableDashboard" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Karyawan</th>
                            <th>Absen Masuk</th>
                            <th>Absen Keluar</th>
                            <th>Divisi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $value) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?php $date = date_create($value['waktu']);
                                    echo date_format($date, 'l, d M Y'); ?></td>
                                <td><?= $value['firstname'] . ' ' . $value['lastname']; ?></td>
                                <td class="text-center"><?php $date = date_create($value['absen_masuk']);
                                                        echo date_format($date, 'H:i:s'); ?></td>
                                <td class="text-center"><?php if ($value['absen_keluar'] !== NULL) {
                                                            $date = date_create($value['absen_keluar']);
                                                            echo date_format($date, 'H:i:s');
                                                        } else {
                                                            echo '-';
                                                        } ?></td>
                                <td class="text-center"><?= $value['divisi_name']; ?></td>
                                <?php $datetime1 = strtotime($value['absen_keluar']);
                                $datetime2 = strtotime($value['absen_masuk']);
                                $hour = $datetime1 - $datetime2;
                                $res = $hour / 3600;
                                if ($res > 8 && $value['absen_keluar'] != NULL) : ?>
                                    <td class="text-center"><span class="badge badge-pill badge-success py-2 px-4">Lembur</span></td>
                                <?php elseif ($res <= 8 && $value['absen_keluar'] != NULL) : ?>
                                    <td class="text-center"><span class="badge badge-pill badge-primary py-2 px-4">Tidak Lembur</span></td>
                                <?php else : ?>
                                    <td class="text-center"><span class="badge badge-pill badge-danger py-2 px-4">Belum Absen Keluar</span></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endsection() ?>