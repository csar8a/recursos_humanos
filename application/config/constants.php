<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('ESTADO_CONTACTO_PENDIENTE')   OR define('ESTADO_CONTACTO_PENDIENTE',  38);
defined('ESTADO_CONTACTO_DERIVADO')    OR define('ESTADO_CONTACTO_DERIVADO',   39);
defined('ESTADO_CONTACTO_ARCHIVADO')   OR define('ESTADO_CONTACTO_ARCHIVADO',  40);
defined('ESTADO_CONTACTO_FINALIZADO')  OR define('ESTADO_CONTACTO_FINALIZADO', 41);

defined('ESTADO_ACCESOINFO_ASIGNADO')    OR define('ESTADO_ACCESOINFO_ASIGNADO',   'ASIGNADO');

defined('FLG_PERSONA_VECINO')      OR define('FLG_PERSONA_VECINO',     '1');
defined('FLG_PERSONA_TRABAJADOR')  OR define('FLG_PERSONA_TRABAJADOR', '2');

defined('FLG_ACCESO_MODULO_MANTENIMIENTO')  OR define('FLG_ACCESO_MODULO_MANTENIMIENTO',  '1');
defined('FLG_ACCESO_MODULO_INTRANET')       OR define('FLG_ACCESO_MODULO_INTRANET',       '2');

defined('CON_TIPO_CONTACTO')       OR define('CON_TIPO_CONTACTO',       19);
defined('CON_TIPO_RECLAMO')       OR define('CON_TIPO_RECLAMO',       36);
defined('CON_TIPO_ACCESO')       OR define('CON_TIPO_ACCESO',       37);
defined('CON_TIPO_AUDIENCIA')       OR define('CON_TIPO_AUDIENCIA',          107);

$oficinas = array(
    'LIMA'=> ['01','01'],   
    'CALLAO'=> ['01','02'],
    'HUARAL'=> ['01','03'],
    'HUACHO'=> ['01','04'],
    'CAÑETE'=> ['01','05'],
    'BARRANCA'=> ['01','06'],
    'HUANCAYO'=> ['02','01'],
    'HUANUCO'=> ['02','02'],
    'PASCO'=> ['02','04'],
    'SATIPO'=> ['02','05'],
    'LA MERCED'=> ['02','06'],
    'TARMA'=> ['02','07'],
    'TINGO MARIA'=> ['02','08'],
    'HUANCAVELICA'=> ['02','09'],
    'AREQUIPA'=> ['03','01'],
    'CAMANA'=> ['03','02'],
    'CASTILLA - APLAO'=> ['03','03'],
    'ISLAY - MOLLENDO'=> ['03','04'],
    'HUARAZ'=> ['04','01'],
    'CASMA'=> ['04','02'],
    'CHIMBOTE'=> ['04','03'],
    'PIURA'=> ['05','01'],
    'SULLANA'=> ['05','02'],
    'TUMBES'=> ['05','03'],
    'CUSCO'=> ['06','01'],
    'ABANCAY'=> ['06','02'],
    'MADRE DE DIOS'=> ['06','03'],
    'QUILLABAMBA'=> ['06','04'],
    'SICUANI'=> ['06','05'],
    'ESPINAR'=> ['06','06'],
    'ANDAHUAYLAS'=> ['06','07'],
    'TACNA'=> ['07','01'],
    'ILO'=> ['07','02'],
    'JULIACA'=> ['07','03'],
    'MOQUEGUA'=> ['07','04'],
    'PUNO'=> ['07','05'],
    'TRUJILLO'=> ['08','01'],
    'CHEPEN'=> ['08','02'],
    'HUAMACHUCO'=> ['08','03'],
    'OTUZCO'=> ['08','04'],
    'SAN PEDRO'=> ['08','05'],
    'MAYNAS'=> ['09','01'],
    'ICA'=> ['10','01'],
    'CHINCHA'=> ['10','02'],
    'PISCO'=> ['10','03'],
    'NAZCA'=> ['10','04'],
    'CHICLAYO'=> ['11','01'],
    'CAJAMARCA'=> ['11','02'],
    'JAEN'=> ['11','03'],
    'BAGUA'=> ['11','04'],
    'CHACHAPOYAS'=> ['11','05'],
    'CHOTA'=> ['11','06'],
    'MOYOBAMBA'=> ['12','01'],
    'TARAPOTO'=> ['12','02'],
    'JUANJUI'=> ['12','03'],
    'YURIMAGUAS'=> ['12','04'],
    'PUCALLPA'=> ['13','01'],
    'AYACUCHO'=> ['14','01'],
    'HUANTA'=> ['14','02'],




);
defined('CONSULTA_OFICINA')       OR define('CONSULTA_OFICINA', json_encode($oficinas));

defined('URL_SERVER')           OR define('URL_SERVER', 'http://localhost:8080/server_files/');