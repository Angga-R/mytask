<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// ----- AUTH -----
//login
$routes->get('/login', 'Auth\Login::index');
$routes->post('/proses_login', 'Auth\Login::proses');
// register
$routes->get('/register', 'Auth\Register::index');
$routes->post('/proses_register', 'Auth\Register::proses');
// logout
$routes->get('/logout', 'Auth\Logout::index');
// lupa password
$routes->get('/lupa_password/(:segment)', 'Auth\LupaPassword::index/$1');
$routes->post('/cek_pertanyaan_keamanan', 'Auth\LupaPassword::cek');
$routes->post('/ubah_password', 'Auth\LupaPassword::ubah_password');

// ----- USER -----
$routes->get('/', 'User\Home::index');

// ----- ADMIN -----
// home
$routes->get('/admin', 'Admin\Home::index');
// data user
$routes->get('/data_user', 'Admin\Data_User::index');
$routes->delete('hapus_user/(:num)', 'Admin\Data_User::hapus_user/$1');
// pesan dari user
$routes->get('/admin_message', 'Admin\Message::index');
$routes->post('/kirim_balasan/(:num)', 'Admin\Message::kirim_balasan/$1');
// rencana pengembangan
$routes->get('/pengembangan', 'Admin\RencanaPengembangan::index');
$routes->post('/tambah_rencana', 'Admin\RencanaPengembangan::tambah_rencana');
$routes->post('/rencana_selesai/(:num)', 'Admin\RencanaPengembangan::rencana_selesai/$1');
$routes->post('/rencana_gagal/(:num)', 'Admin\RencanaPengembangan::rencana_gagal/$1');
// data admin
$routes->get('/data_admin', 'Admin\Data_Admin::index');
$routes->post('/ganti_foto_admin', 'Admin\Data_Admin::ganti_foto');
$routes->post('/ganti_nama_admin', 'Admin\Data_Admin::ganti_nama');
$routes->post('/ganti_email_admin', 'Admin\Data_Admin::ganti_email');
$routes->post('/ganti_link_admin', 'Admin\Data_Admin::ganti_link');
$routes->post('/ganti_tentang_admin', 'Admin\Data_Admin::ganti_tentang');
$routes->post('/ganti_password_admin', 'Admin\Data_Admin::ganti_password');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}