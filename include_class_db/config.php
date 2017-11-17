<?php
date_default_timezone_set("America/Toronto");
header('Content-Type: text/html; charset=utf-8');
require_once 'class_db/meekrodb.2.2.class.php';

// DB::$host = 'localhost';
// DB::$dbName = 'seapetro_samlisten';
// DB::$user = 'seapetro_samlist';
// DB::$password = '1#dMF3s2J6G7';
//
// if(strstr($_SERVER['DOCUMENT_ROOT'], 'dev')){
// 	define('WEB_SITE', "https://dev.samlisten.com/");
// 	define('ENV', "dev");
// }
// else{
// 	define('WEB_SITE', "https://www.samlisten.com/");
// 	define('ENV', "prod");
// }

switch (true) {
	case ($_SERVER['DOCUMENT_ROOT'] == '/home/seapetro/public_html/dev'):
		DB::$host = 'localhost';
		DB::$dbName = 'seapetro_samlisten';
		DB::$user = 'seapetro_samlist';
		DB::$password = '1#dMF3s2J6G7';
		define('WEB_SITE', "https://dev.samlisten.com/");
		define('ENV', "dev");
		break;

	case ($_SERVER['DOCUMENT_ROOT'] == '/home/seapetro/public_html'):
		DB::$host = 'localhost';
		DB::$dbName = 'seapetro_samlisten';
		DB::$user = 'seapetro_samlist';
		DB::$password = '1#dMF3s2J6G7';
		define('WEB_SITE', "https://www.samlisten.com/");
		define('ENV', "prod");
		break;

	case (strstr(dirname(__FILE__), 'Dropbox')):
		DB::$host = 'localhost';
		DB::$dbName = 'samlisten';
		DB::$user = 'mic@webtotal.ca';
		DB::$password = 'mike1234';
		define('WEB_SITE', "https://localhost/Dropbox/www/dev/");
		define('ENV', "dev");
		break;

	case (strstr(dirname(__FILE__), 'Cofomo')):
		DB::$host = 'localhost';
		DB::$dbName = 'samlisten';
		DB::$user = 'mic@webtotal.ca';
		DB::$password = 'mike1234';
		define('WEB_SITE', "https://localhost/Cofomo/dev/");
		define('ENV', "dev");
		break;
}


/*if (basename(getcwd()) == "romantica") {
	define('WEB_SITE', "https://www.samlisten.com/romantica/");
}
else {
	define('WEB_SITE', "https://www.samlisten.com/");
}*/


//Variables utilizadas en "script/script_temporal.php"
$query_string = $_SERVER['QUERY_STRING'] != "" ? "?" . $_SERVER['QUERY_STRING'] : "";
$path_total = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . $query_string;
//----------------------------------------------------


$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012


//Notificar errores
include('display_error.php');
?>
