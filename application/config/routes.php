<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
$route['base_url'] = 'front_controller/Home';
$route['admin_panel/([a-z]+)/(:any)'] = "admin_panel/home/$1/$2";
$route['admin_panel/([a-z]+)'] = "admin_panel/home/$1";
$route['admin_panel'] = "admin_panel/home";