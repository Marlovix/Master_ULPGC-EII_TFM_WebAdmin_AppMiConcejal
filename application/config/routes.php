<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['404_override'] = 'errors/html/error_404';
$route['translate_uri_dashes'] = FALSE;
$route['assets/(:any)'] = 'assets/$1';

$route['usuarios/crear']['get'] = 'usuarios/form';
$route['usuarios/editar/(:num)']['get'] = 'usuarios/form/$1';

$route['administradores/asignar_ayuntamiento/(:num)']['get'] = 'administradores/form/$1';

$route['ayuntamientos/crear']['get'] = 'ayuntamientos/form';
$route['ayuntamientos/editar/(:num)']['get'] = 'ayuntamientos/form/$1';

$route['partidos_politicos/crear']['get'] = 'partidos_politicos/form';
$route['partidos_politicos/editar/(:num)']['get'] = 'partidos_politicos/form/$1';

$route['distritos/crear']['get'] = 'distritos/form';
$route['distritos/editar/(:num)']['get'] = 'distritos/form/$1';

$route['concejales/crear']['get'] = 'concejales/form';
$route['concejales/editar/(:num)']['get'] = 'concejales/form/$1';