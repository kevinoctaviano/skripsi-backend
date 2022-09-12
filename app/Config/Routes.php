<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Data Admin
$routes->get('/', 'Admin::index');
$routes->get('/data-admin', 'Admin::dataAdmin', ['filter' => 'role:Moderator']);
$routes->get('/data-admin/(:any)', 'Admin::dataAdmin/$1', ['filter' => 'role:Moderator']);
$routes->add('/tambah-admin', 'Admin::createDataAdmin', ['filter' => 'role:Moderator']);
$routes->get('/hapus-admin/(:num)', 'Admin::hapusDataAdmin/$1', ['filter' => 'role:Moderator']);
$routes->add('/edit-admin/(:num)', 'Admin::editDataAdmin/$1', ['filter' => 'role:Moderator']);
$routes->add('/update-admin/(:num)', 'Admin::updateDataAdmin/$1', ['filter' => 'role:Moderator']);

// Data Divisi
$routes->get('/data-divisi', 'Admin::dataDivisi', ['filter' => 'role:Moderator']);
$routes->add('/tambah-divisi', 'Admin::createDataDivisi', ['filter' => 'role:Moderator']);
$routes->add('/edit-divisi/(:num)', 'Admin::editDataDivisi/$1', ['filter' => 'role:Moderator']);
$routes->add('/update-divisi/(:num)', 'Admin::updateDataDivisi/$1', ['filter' => 'role:Moderator']);
$routes->get('/hapus-divisi/(:num)', 'Admin::hapusDataDivisi/$1', ['filter' => 'role:Moderator']);

// Data Pegawai
$routes->get('/data-pegawai', 'Pegawai::index');
$routes->add('/tambah-pegawai', 'Pegawai::createDataPegawai');
$routes->add('/edit-pegawai/(:num)', 'Pegawai::editDataPegawai/$1');
$routes->add('/update-pegawai/(:num)', 'Pegawai::updateDataPegawai/$1');
$routes->get('/hapus-pegawai/(:num)', 'Pegawai::hapusDataPegawai/$1');

// User / Profile
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/(:num)', 'Profile::updateProfile/$1');
$routes->get('/ubah-password', 'Profile::updatePassword');
$routes->post('/password-changed/(:num)', 'Profile::updatePasswordForm/$1');

$routes->add('/export-excel', 'Admin::exportExcel');

// REST API
$routes->resource('restapipegawai');
$routes->post('/authentikasi', 'AuthPegawai::index');
$routes->resource('restapiuserpegawai');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
