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

$route['admin/pr2-reports/(:num)'] ='admin/PR2_Reports/index/$1';
$route['admin/pr2-reports/add/(:num)'] ='admin/PR2_Reports/add/$1';
$route['admin/pr2_reports/edit/(:num)'] ='admin/PR2_Reports/edit/$1';
$route['admin/pr2_reports/update/(:num)'] ='admin/PR2_Reports/update/$1';
$route['admin/pr2_reports/delete/(:num)'] ='admin/PR2_Reports/delete/$1';

$route['admin/dro-reports/insert_dro_records/(:num)'] ='admin/dro_reports/insert_dro_records/$1';
$route['admin/segment-overview/(:num)'] ='admin/segment_overview/index/$1';
$route['admin/segment-overview/add/(:num)'] ='admin/segment_overview/add/$1';
$route['admin/image/image_upload'] ='admin/image/image_upload';
$route['admin/category'] ='admin/category/index';

$route['admin/spreadsheet'] = 'admin/PhpspreadsheetController';
$route['admin/spreadsheet/filter'] = 'admin/PhpspreadsheetController/filter';
$route['admin/spreadsheet/index'] = 'admin/PhpspreadsheetController/index';
$route['admin/spreadsheet/export'] = 'admin/PhpspreadsheetController/export';
$route['admin/spreadsheet/metadata'] = 'admin/PhpspreadsheetController/metadata';
$route['admin/spreadsheet/export_metadata'] = 'admin/PhpspreadsheetController/export_metadata';

/* analyst urls */
$route['analyst/report/processed'] ='admin/Analyst_Report/analyst_processed_rd';
$route['analyst/report/published'] ='admin/Analyst_Report/analyst_published_rd';
$route['analyst/report/drafts'] ='admin/report/drafts';
$route['analyst/report/add'] ='admin/report/add';

/* manager urls */
$route['manager/report/processed'] ='admin/Manager_Report/manager_processed_rd';
$route['manager/report/published'] ='admin/Manager_Report/manager_published_rd';
$route['manager/report/drafts'] ='admin/Manager_Report/drafts';

/* Generate RD & Sample by Analyst & Manager */
$route['analyst/generate-rd'] ='admin/generate_rd/index';

/* custom link urls */
$route['sales/custom-link'] ='admin/Custom_link';
$route['sales/custom-link/add'] ='admin/Custom_link/add';

/* Queries urls */
$route['sales/sample-query'] ='admin/queries';
$route['sales/toc-query'] ='admin/queries/toc_list';
$route['sales/customization-query'] ='admin/queries/customization_list';
$route['sales/enquiry-query'] ='admin/queries/enquiry_list';
$route['admin/spam-mail'] ='admin/Spam_Mail';
$route['admin/spam-mail/list'] ='admin/Spam_Mail/list';
$route['admin/Spam_Mail/insert'] ='admin/Spam_Mail/insert';
$route['admin/spam-mail/edit/(:any)'] ='admin/Spam_Mail/edit/$1';
$route['admin/spam-mail/update/(:any)'] ='admin/Spam_Mail/update/$1';
$route['admin/Spam_Mail/delete/(:any)'] ='admin/Spam_Mail/delete/$1';
$route['admin/spam-mail/import_file'] ='admin/Spam_Mail/import_file';
$route['admin/spam_mail/export_data'] ='admin/Spam_Mail/export_data';
$route['admin/spam-mail/email-formater'] ='admin/Spam_Mail/email_formater';

/* invoice urls */
$route['invoice/index'] ='admin/invoice/index';
$route['admin/generate-invoice'] ='admin/invoice/add_invoice';

/* employee urls */
$route['admin/employee/employee_document/(:num)'] ='admin/Employee/employee_document/$1';
$route['admin/employee/upload_employee_documents/(:num)'] ='admin/employee/upload_employee_documents/$1';

/* user register urls */
$route['admin/register-user'] ='admin/register_user';

/* Country RD Generation Redirects */
$route['admin/country_segment/(:num)'] ='admin/Country_segment/index/$1';
$route['admin/country_segment/overview/(:num)'] ='admin/Country_segment/overview/$1';
$route['admin/country_company/(:num)'] ='admin/Country_company/index/$1';
$route['admin/country_insight/(:num)'] ='admin/Country_insight/index/$1';
$route['admin/country_rd_dro/(:num)'] ='admin/Country_rd_dro/index/$1';
$route['admin/country_rd_pr/add/(:num)'] ='admin/Country_rd_pr/add/$1';