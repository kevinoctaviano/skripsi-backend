<?php
helper('auth');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendor/datatables/datatables.bootstrap4.min.css">

    <!-- SweetAlert 2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/sweetalert2/sweetalert2.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content -->
        <?= $this->include('admin/layout/sidebar') ?>
        <?= $this->include('admin/layout/topbar') ?>
        <?= $this->renderSection('content') ?>
        <?= $this->include('admin/layout/footer') ?>

    </div>

    <!-- JQuery -->
    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>/assets/js/demo/datatables-demo.js"></script>

    <!-- SweetAlert -->
    <script src="<?= base_url() ?>/assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- My Script -->
    <script src="<?= base_url() ?>/assets/js/script.js"></script>

</body>

</html>