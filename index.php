<?php
//echo __DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php'.'<br>';
//echo __DIR__.'<br>';
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
$index='home';
if(isset( $_GET['canal']))  {
	$canal=$_GET['canal'];
	$query_canales = DB::query("SELECT *
					 FROM psn_canales
					 WHERE nom_url = %s", $canal);
	if (!empty($query_canales)) {
		/*// Caduca en un año
		setcookie('samlisten_canal',  $_GET['canal'], time() + 365 * 24 * 60 * 60); */
		$id_canal = $query_canales[0]['id'];
		$header_title = $nombre_canal = $query_canales[0]['nombre'];
		$nom_url_canal = $query_canales[0]['nom_url'];
		$descripcion_canal = $query_canales[0]['descripcion'];
		$id_radioco_canal = $query_canales[0]['id_radioco'];
		$centova = $query_canales[0]['centova'];
		$app_id_fb_canal = $query_canales[0]['app_id_fb'];
		$page_fb_canal = $query_canales[0]['page_fb'];
		$page_fb_canal_short = str_replace("http://www.facebook.com/","",$page_fb_canal);
		$img_fb_canal = $query_canales[0]['img_fb'];
		$radiouid_canal = $query_canales[0]['radiouid'];
		$apikey_canal = $query_canales[0]['apikey'];
		$url_radionomy_canal = $query_canales[0]['url_radionomy'];

		$titulo 	= "Tus canciones favoritas";
		$artista 	= "Tus artistas favoritos";
		$index='canal';
	}
}
elseif(isset( $_GET['cn'])) {
	$index='cn';
}
include $index.'.php';
?>
