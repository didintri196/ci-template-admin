<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//PAGE
$route['default_controller'] = 'C_dashboard/redirect';
$route['account'] = 'C_dashboard/redirect';
$route['account/dashboard'] = 'C_dashboard';
$route['account/register-paket'] = 'C_paket/register';

$route['account/transaksi'] = 'C_transaksi';
$route['account/transaksi/payout/(.*)'] = 'C_transaksi/payout/$1';
$route['account/transaksi/cancel/(.*)'] = 'C_transaksi/cancel/$1';

$route['account/register-paket/checkout/(.*)'] = 'C_transaksi/checkout/$1';

$route['account/profile'] = 'C_account/profile';

$route['account/kategori'] = 'C_kategori';
$route['account/kategori/add'] = 'C_kategori/ack_add';
$route['account/kategori/view/(.*)'] = 'C_kategori/ack_view/$1';
$route['account/kategori/update'] = 'C_kategori/ack_update';
$route['account/kategori/delete'] = 'C_kategori/ack_delete';

$route['account/coupon'] = 'C_coupon';
$route['account/coupon/add'] = 'C_coupon/ack_add';
$route['account/coupon/view/(.*)'] = 'C_coupon/ack_view/$1';
$route['account/coupon/update'] = 'C_coupon/ack_update';
$route['account/coupon/delete'] = 'C_coupon/ack_delete';

$route['account/asrama'] = 'C_asrama';
$route['account/asrama/add'] = 'C_asrama/ack_add';
$route['account/asrama/view/(.*)'] = 'C_asrama/ack_view/$1';
$route['account/asrama/update'] = 'C_asrama/ack_update';
$route['account/asrama/delete'] = 'C_asrama/ack_delete';
$route['account/asrama/(.*)/fasilitas'] = 'C_asrama/fasilitas/$1';
$route['account/asrama/(.*)/fasilitas/add'] = 'C_asrama/ack_add_detail/$1';
$route['account/asrama/fasilitas/view/(.*)'] = 'C_asrama/ack_view_detail/$1';
$route['account/asrama/(.*)/fasilitas/update'] = 'C_asrama/ack_update_detail/$1';
$route['account/asrama/(.*)/fasilitas/delete'] = 'C_asrama/ack_delete_detail/$1';

$route['account/materi'] = 'C_materi';
$route['account/materi/add'] = 'C_materi/ack_add';
$route['account/materi/view/(.*)'] = 'C_materi/ack_view/$1';
$route['account/materi/update'] = 'C_materi/ack_update';
$route['account/materi/delete'] = 'C_materi/ack_delete';

$route['account/jadwal'] = 'C_jadwal';
$route['account/jadwal/add'] = 'C_jadwal/ack_add';
$route['account/jadwal/view/(.*)'] = 'C_jadwal/ack_view/$1';
$route['account/jadwal/update'] = 'C_jadwal/ack_update';
$route['account/jadwal/delete'] = 'C_jadwal/ack_delete';
$route['account/jadwal/(.*)/materi'] = 'C_jadwal/materi/$1';
$route['account/jadwal/(.*)/materi/add'] = 'C_jadwal/ack_add_detail/$1';
$route['account/jadwal/materi/view/(.*)'] = 'C_jadwal/ack_view_detail/$1';
$route['account/jadwal/(.*)/materi/update'] = 'C_jadwal/ack_update_detail/$1';
$route['account/jadwal/(.*)/materi/delete'] = 'C_jadwal/ack_delete_detail/$1';

$route['account/user'] = 'C_user';
$route['account/user/add'] = 'C_user/ack_add';
$route['account/user/view/(.*)'] = 'C_user/ack_view/$1';
$route['account/user/update'] = 'C_user/ack_update';
$route['account/user/delete'] = 'C_user/ack_delete';

$route['account/paket'] = 'C_paket';
$route['account/paket/add'] = 'C_paket/ack_add';
$route['account/paket/view/(.*)'] = 'C_paket/ack_view/$1';
$route['account/paket/update'] = 'C_paket/ack_update';
$route['account/paket/delete'] = 'C_paket/ack_delete';

$route['api/upload/image/(.*)'] = 'C_upload/image/$1';
$route['api/paket/kategori/(.*)'] = 'C_paket/api_getpaketwherecat/$1';
$route['api/cek-coupon/(.*)'] = 'C_coupon/api_getcodewherecode/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
