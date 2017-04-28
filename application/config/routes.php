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
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login and reset password system
$route['login']['get']='Login_controller';
$route['login/sign_in']['post']='Login_controller/sign_in';
$route['login/reset_password']='Login_controller/reset_password';
$route['login/generate_reset']['post'] ='Login_controller/generate_reset';
$route['login/token/(:any)']['get']='Login_controller/token/$1';
$route['login/token/change/(:any)']['post']='Login_controller/token_change/$1';

//Admin routes
$route['sellers']['get']='Sellers_controller';
$route['sellers/new']['get']='Sellers_controller/new_seller';
$route['sellers/new/save']['post']='Sellers_controller/save_new_seller';
$route['login/logout']['get']='Logout_Controller/logout';
$route['sellers/details/(:num)']['get']='Sellers_controller/seller_details/$1';
$route['sellers/edit/(:num)']['get']='Sellers_controller/seller_edit_view/$1';
$route['sellers/edit/save/(:num)']['post']='Sellers_controller/save_seller_edit/$1';
$route['sellers/delete/(:num)']['post']='Sellers_controller/delete_seller/$1';
$route['sellers/restore']['get']='Sellers_controller/list_restore_sellers';
$route['sellers/restore/(:num)']['post']='Sellers_controller/restore_seller/$1';
$route['items/getPage/(:num)']['get']='Items_controller/getItemPage/$1';
$route['items/list/(:num)']['get']='Items_controller/show_items/$1';
$route['items/update/(:num)']['post']='Sellers_controller/update_items_list/$1';
$route['items/details/(:num)']['get']='Items_controller/items_details/$1';

//Seller routes
$route['myItems']['get']='Seller_user_controller/index';
$route['myItems/details/(:num)']['get']='Seller_user_controller/items_details/$1';
$route['myItems/update']['post']='Seller_user_controller/update_items_list';

//routes for formulary
$route['get_regions/(:num)']['get']='Sellers_controller/get_regions/$1';
$route['get_city/(:num)']['get']='Sellers_controller/get_city_regions/$1';

//Profiles
$route['Profile']['get']='ProfileController/profileAdmin';
$route['MyProfile']['get']='ProfileController/profileSeller';
