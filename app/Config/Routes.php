<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Study::home');
$routes->get('study/download-excel', 'Study::downloadExcel');
$routes->post('study/import-excel', 'Study::importExcel');
$routes->get('study/edit/(:segment)', 'Study::edit/$1');
$routes->post('study/save', 'Study::save');
$routes->get('export/pdf', 'ExportController::exportToPDF');
$routes->get('export/download/(:any)', 'ExportController::downloadPDF/$1');
// $routes->post('/pekerjaan/addPekerjaan', 'PekerjaanController::addPekerjaan');

// $routes->post('/pendidikan/addPendidikan', 'Pendidikan::addPendidikan');
// $routes->get('/pendidikan/editPendidikan/(:any)', 'Pendidikan::editPendidikan/$1');




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
