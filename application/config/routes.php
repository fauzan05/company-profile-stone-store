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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'app';
$route['404_override'] = 'app/not_found';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
// ADMIN
$route['admin/dashboard'] = 'admin';
$route['admin/products'] = 'admin/product';
$route['admin/categories'] = 'admin/category';
$route['admin/categories/(:num)'] = 'admin/edit_category/$1';
$route['admin/products/(:num)'] = 'admin/edit_product/$1';
// $route['admin/applications'] = 'admin/application';
// $route['admin/applications/(:num)'] = 'admin/edit_application/$1';
$route['admin/settings'] = 'admin/setting';
$route['admin/settings/profile'] = 'admin/setting_profile';
$route['admin/settings/password'] = 'admin/setting_password';
$route['admin/settings/social-media'] = 'admin/setting_social_media';
$route['admin/settings/social-media/(:num)'] = 'admin/edit_social_media/$1';
$route['admin/upload_product_images'] = 'product/upload_product_images';
// $route['create_admin'] = 'admin/create_account';

// USER
$route['products'] = 'app/products';
$route['products/(:any)'] = 'app/show_all_products/$1';
$route['about-us'] = 'app/about_us';
