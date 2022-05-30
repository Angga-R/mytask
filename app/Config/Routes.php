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

if(!session()->has('logged_user')) {
    //login
    $routes->get('/', 'Auth\Login::index');
}else{
    // user
    $routes->get('/', 'User\Home::index');
}

// ----- AUTH -----
// login
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
// profil
$routes->get('/profil', 'User\Profil::index');
$routes->post('/profil/ganti_foto', 'User\Profil::ganti_foto');
$routes->post('/profil/ganti_username', 'User\Profil::ganti_username');
$routes->post('/profil/ganti_nama', 'User\Profil::ganti_nama');
$routes->post('/profil/ganti_gender', 'User\Profil::ganti_gender');
$routes->post('/profil/ganti_pertanyaan_keamanan', 'User\Profil::ganti_pertanyaan_keamanan');
$routes->post('/profil/ganti_jawaban_keamanan', 'User\Profil::ganti_jawaban_keamanan');
$routes->post('/profil/ganti_password_user', 'User\Profil::ganti_password');
// catatan
$routes->get('/catatan', 'User\Catatan::index');
$routes->post('/catatan/buat_catatan', 'User\Catatan::add');
$routes->delete('/catatan/hapus/(:num)', 'User\Catatan::hapus/$1');
// task
$routes->get('/task/semua_task', 'User\Task::index');
$routes->get('/task/buat_task', 'User\Task::buat_task');
$routes->get('/task/task_saat_ini', 'User\Task::berjalan');
$routes->get('/task/riwayat_task', 'User\Task::riwayat');
$routes->post('/task/buat_task', 'User\Task::new');
$routes->post('/task/task_selesai/(:num)', 'User\Task::selesai/$1');
$routes->post('/task/task_gagal/(:num)', 'User\Task::gagal/$1');
$routes->delete('/task/hapus/(:num)', 'User\Task::hapus/$1');
// message
$routes->get('/pesan_admin', 'User\Pesan::index');
$routes->get('/pesan_admin/kirim_pesan', 'User\Pesan::kirim_pesan');
$routes->get('/pesan_admin/lihat_pesan/(:num)', 'User\Pesan::lihat_pesan/$1');
$routes->post('/pesan_admin/kirim', 'User\Pesan::kirim');
// creator
$routes->get('/creator', 'User\Creator::index');



// ----- ADMIN -----
// home
$routes->get('/admin', 'Admin\Home::index');
// data user
$routes->get('/admin/data_user', 'Admin\Data_User::index');
$routes->delete('/admin/hapus_user/(:num)', 'Admin\Data_User::hapus_user/$1');
// pesan dari user
$routes->get('/admin/admin_message', 'Admin\Message::index');
$routes->post('/admin/kirim_balasan/(:num)', 'Admin\Message::kirim_balasan/$1');
// rencana pengembangan
$routes->get('/admin/pengembangan', 'Admin\RencanaPengembangan::index');
$routes->post('/admin/tambah_rencana', 'Admin\RencanaPengembangan::tambah_rencana');
$routes->post('/admin/rencana_selesai/(:num)', 'Admin\RencanaPengembangan::rencana_selesai/$1');
$routes->post('/admin/rencana_gagal/(:num)', 'Admin\RencanaPengembangan::rencana_gagal/$1');
// data admin
$routes->get('/admin/data_admin', 'Admin\Data_Admin::index');
$routes->post('/admin/ganti_foto_admin', 'Admin\Data_Admin::ganti_foto');
$routes->post('/admin/ganti_username_admin', 'Admin\Data_Admin::ganti_username');
$routes->post('/admin/ganti_nama_admin', 'Admin\Data_Admin::ganti_nama');
$routes->post('/admin/ganti_email_admin', 'Admin\Data_Admin::ganti_email');
$routes->post('/admin/ganti_link_admin', 'Admin\Data_Admin::ganti_link');
$routes->post('/admin/ganti_tentang_admin', 'Admin\Data_Admin::ganti_tentang');
$routes->post('/admin/ganti_password_admin', 'Admin\Data_Admin::ganti_password');
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