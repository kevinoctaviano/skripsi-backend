<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="far fa-clipboard"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Absensi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $request->uri->getSegment(1) === '' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url() ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Absen Pegawai</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if ($request->uri->getSegment(1) === 'data-admin' || $request->uri->getSegment(1) === 'data-divisi' || $request->uri->getSegment(1) === 'data-pegawai' || $request->uri->getSegment(1) === 'edit-admin' || $request->uri->getSegment(1) === 'edit-divisi' || $request->uri->getSegment(1) === 'edit-pegawai') {
                            echo 'active';
                        } else {
                            echo '';
                        } ?>">
        <a class="nav-link collapsed" href="#collapseTwo" data-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo" id="data-user">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if (in_groups("Moderator")) : ?>
                    <a class="collapse-item <?= (($request->uri->getSegment(1) === 'data-admin') || ($request->uri->getSegment(1) === 'edit-admin')) ? 'active' : '' ?>" href="<?= base_url('data-admin') ?>">Data Admin</a>
                    <a class="collapse-item <?= (($request->uri->getSegment(1) === 'data-divisi') || ($request->uri->getSegment(1) === 'edit-divisi')) ? 'active' : '' ?>" href="<?= base_url('data-divisi') ?>">Data Divisi</a>
                <?php endif; ?>
                <a class="collapse-item <?= (($request->uri->getSegment(1) === 'data-pegawai') || ($request->uri->getSegment(1) === 'edit-pegawai')) ? 'active' : '' ?>" href="<?= base_url('data-pegawai') ?>">Data Pegawai</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->