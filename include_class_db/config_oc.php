<?php
header('Content-Type: text/html; charset=utf-8');

require_once 'class_db/meekrodb.2.2.class.php';

DB::$host = 'localhost';
DB::$dbName = 'seapetro_tennis_pav';
DB::$user = 'seapetro_tennis';
DB::$password = 'ST(ZqkTMmCy@';

//define('WEB_SITE', "https://www.samlisten.com/romantica/");


//Notificar errores
include('display_error.php');
?>