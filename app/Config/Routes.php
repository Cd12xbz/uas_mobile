<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

//Bendahara
$routes->resource('pembayaran', ['controller' => 'PembayaranController']);

//siswa dan Wali Murid
$routes->resource('siswa', ['controller' => 'SiswaController']);

//Kepala Sekolah
$routes->resource('kepala', ['controller' => 'HeadController']);