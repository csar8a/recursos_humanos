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
$route['default_controller'] = 'C_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['main'] = 'C_dashboard';
$route['login'] = 'C_login';
$route['sav'] = 'sav/C_sav';
$route['admin_sav'] = 'sav/C_admin_sav';

$route['admin_contacto'] = 'contacto/C_admin_contacto';
$route['admin_acceso'] = 'acceso_informacion/C_admin_acceso';
$route['admin_reclamos'] = 'libro_reclamaciones/C_admin_reclamos';
$route['admin_audiencias'] = 'audiencias/C_admin_audiencia'; 

$route['vecino_normas'] = 'normas/C_normas_vecino';
$route['normas'] = 'normas/C_normas';
$route['admin_normas'] = 'normas/C_admin_normas';
$route['update_normas'] = 'normas/C_update_normas';
$route['tupa'] = 'tupa/C_tupa';

$route['audiencias'] = 'audiencias/C_audiencias';


$route['consulta_reniec'] = 'pide/C_consulta_reniec'; 

$route['consulta_policial'] = 'pide/C_consulta_policial'; 
$route['pide_bienvenida'] = 'pide/C_pide_bienvenida'; 
$route['consulta_sunarp'] = 'pide/C_consulta_sunarp'; 
$route['consulta_sunarp_natural'] = 'pide/C_consulta_sunarp_natural'; 
$route['consulta_antecedentes_judiciales'] = 'pide/C_consulta_antecedentes_judiciales';
$route['consulta_antecedentes_penales'] = 'pide/C_consulta_antecedentes_penales'; 
$route['consulta_sunarp_titularidad_juridica'] = 'pide/C_consulta_sunarp_titularidad_juridica'; 
$route['consulta_licencia'] = 'pide/C_consulta_licencia';
$route['consulta_papeletas'] = 'pide/C_consulta_papeletas'; 
$route['consulta_ultima_licencia'] = 'pide/C_consulta_ultima_licencia';
$route['consulta_sunedu_grados'] = 'pide/C_consulta_sunedu_grados';
$route['consulta_ultima_sancion'] = 'pide/C_consulta_ultima_sancion';
$route['consulta_pide'] = 'pide/C_consulta_pide';
$route['reporte_pide'] = 'pide/C_reporte_pide';

$route['consulta_sunat'] = 'pide/C_consulta_sunat';
$route['envio_sms'] = 'pide/C_consulta_PCM';

$route['documentos'] = 'intranet/C_documentos';
$route['admin_documentos'] = 'intranet/C_admin_docs';
$route['admin_permisos'] = 'permisos/C_permisos';
$route['admin_usuarios'] = 'permisos/C_usuarios';
$route['noticias'] = 'intranet/C_noticias';
$route['eventos'] = 'intranet/C_eventos';
$route['admin_eventos'] = 'intranet/C_admin_eventos';
$route['usuarios_intranet'] = 'intranet/C_usuarios_intranet';
$route['admin_noticias'] = 'intranet/C_admin_noticias';
$route['ficha_casa_juventud'] = 'casa_juventud/C_ficha_casa_juventud';
$route['admin_casa_juventud'] = 'casa_juventud/C_admin_c_juventud';

$route['admin_audiencias'] = 'audiencias/C_admin_audiencias';

$route['datos_personales'] = 'recursos_humanos/C_Datos_Personales';


$route['qr'] = 'casa_juventud/C_tarjeta';

$route['contacto_ws'] = 'contacto/C_contacto_ws';
$route['contacto_call'] = 'contacto/C_contacto_call';
