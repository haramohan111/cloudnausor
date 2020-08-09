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


$route['admin'] = 'admin/Admin_controller';
$route['admin_login']='admin/admin_controller/admin_login';
$route['admin/dashboard']='admin/dashboard_controller/dashboard';
$route['admin_logout']='admin/admin_controller/logout';


//product start
$route['admin/product/add_product']='admin/product_controller/add_product';
$route['admin/product/manage_product']='admin/product_controller/manage_product';
$route['admin/product/manage_product/(:any)']='admin/product_controller/manage_product';
$route['admin/product/update_product']='admin/product_controller/update_product';
$route['admin/product/edit_product/(:any)']='admin/product_controller/edit_product';
$route['admin/product/product_act_inact']='admin/product_controller/product_act_inact';
//product end

$route['addToCart/(:any)']='frontend/products/addToCart';
$route['checkout']='frontend/checkout';
$route['checkout/my_address_book']='frontend/checkout/add_address';
$route['cart']='frontend/cart';
$route['incItemQty']='frontend/cart/incItemQty';
$route['decItemQty']='frontend/cart/decItemQty';
$route['IncdecQty']='frontend/cart/updateItemQty';

$route['removeItem']='frontend/cart/removeItem';
$route['payment_type']='frontend/checkout/payment_type';
$route['orderPlace']='frontend/checkout/orderPlace';
$route['checkout/orderSuccess/(:any)']='frontend/checkout/orderSuccess';
$route['online']='frontend/checkout/online';
$route['onlineOrderPlace']='frontend/checkout/onlineOrderPlace';

$route['cart/removeItem/(:any)']='frontend/cart/removeItem';

$route['login']='frontend/login_controller/login';
$route['logout']='frontend/login_controller/logout';
$route['signup']='frontend/login_controller/signup';

