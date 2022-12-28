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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/login'] ='admin/login/index';
// $route['admin/dashboard'] ='admin/dashboard/dashboard';
$route['admin/report/rd-update'] ='admin/report/rd_update';
$route['admin/country-rd'] ='admin/country_rd/index';
$route['admin/scope'] ='admin/scope/index';
$route['admin/scope/add'] ='admin/scope/add';
$route['admin/scope/scope_delete'] ='admin/scope/scope_delete';
$route['admin/scope_register'] ='admin/dashboard/scope_register';
$route['admin/company/(:any)'] ='admin/company/index/$1';
$route['admin/segment/(:any)'] ='admin/segment/index/$1';
$route['admin/image/(:num)'] ='admin/image/index/$1';
$route['admin/market-insight/(:num)'] ='admin/market_insight/index/$1';
$route['admin/market-insight/add/(:num)'] ='admin/market_insight/add/$1';
$route['admin/market-insight/insert/(:num)'] ='admin/market_insight/insert/$1';
$route['admin/market-insight/view/(:num)'] ='admin/market_insight/view/$1';
$route['admin/market-insight/edit/(:num)'] ='admin/market_insight/edit/$1';
$route['admin/market-insight/update/(:num)'] ='admin/market_insight/update/$1';
$route['admin/market-insight/delete/(:num)'] ='admin/market_insight/delete/$1';

$route['admin/dro-type/(:num)'] ='admin/dro_type/index/$1';
$route['admin/dro-reports/(:num)'] ='admin/dro_reports/index/$1';
$route['admin/dro-reports/add/(:num)'] ='admin/dro_reports/add/$1';
$route['admin/dro-reports/edit/(:num)'] ='admin/dro_reports/edit/$1';
$route['admin/dro-reports/delete/(:num)'] ='admin/dro_reports/delete/$1';

$route['admin/pr2-reports/(:num)'] ='admin/pr2_reports/index/$1';
$route['admin/pr2-reports/add/(:num)'] ='admin/pr2_reports/add/$1';

$route['admin/dro-reports/insert_dro_records/(:num)'] ='admin/dro_reports/insert_dro_records/$1';
$route['admin/segment-overview/(:num)'] ='admin/segment_overview/index/$1';
$route['admin/segment-overview/add/(:num)'] ='admin/segment_overview/add/$1';
$route['admin/image/image_upload'] ='admin/image/image_upload';
$route['admin/category'] ='admin/category/index';

$route['admin/image-text-write'] ='admin/image_text_write/index';
$route['admin/image-text-write/(:num)'] ='admin/image_text_write/image_write/$1';

$route['admin/spreadsheet'] = 'admin/PhpspreadsheetController';
$route['admin/spreadsheet/filter'] = 'admin/PhpspreadsheetController/filter';
$route['admin/spreadsheet/index'] = 'admin/PhpspreadsheetController/index';
$route['admin/spreadsheet/export'] = 'admin/PhpspreadsheetController/export';

/* analyst urls */
$route['analyst/report/processed'] ='admin/analyst_report/analyst_processed_rd';
$route['analyst/report/published'] ='admin/analyst_report/analyst_published_rd';
$route['analyst/report/drafts'] ='admin/report/drafts';
$route['analyst/report/add'] ='admin/report/add';

/* manager urls */
$route['manager/report/processed'] ='admin/manager_report/manager_processed_rd';
$route['manager/report/published'] ='admin/manager_report/manager_published_rd';
$route['manager/report/drafts'] ='admin/manager_report/drafts';

/* custom link urls */
$route['sales/custom-link'] ='admin/custom_link';
$route['sales/custom-link/add'] ='admin/custom_link/add';

/* Queries urls */
$route['sales/sample-query'] ='admin/queries';
$route['sales/toc-query'] ='admin/queries/toc_list';
$route['sales/customization-query'] ='admin/queries/customization_list';
$route['sales/enquiry-query'] ='admin/queries/enquiry_list';