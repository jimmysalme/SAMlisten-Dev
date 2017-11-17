<?php 
//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');

function replace_specials_characters($s) {
		//$s = mb_convert_encoding($s, 'UTF-8','');
		
		$s = strtolower($s);
		$s = preg_replace("/á|à|â|ã|ª/","a",$s);
		//$s = preg_replace("/A|Á|À|Â|Ã/","a",$s);
		$s = preg_replace("/é|è|ê/","e",$s);
		//$s = preg_replace("/E|É|È|Ê/","e",$s);
		$s = preg_replace("/í|ì|î/","i",$s);
		//$s = preg_replace("/I|Í|Ì|Î/","i",$s);
		$s = preg_replace("/ó|ò|ô|õ|º/","o",$s);
		//$s = preg_replace("/O|Ó|Ò|Ô|Õ/","o",$s);
		$s = preg_replace("/ú|ù|û/","u",$s);
		//$s = preg_replace("/U|Ú|Ù|Û/","u",$s);
		$s = str_replace(" ","-",$s);
		$s = str_replace("ñ","n",$s);
		//$s = str_replace("Ñ","n",$s);
		$s = str_replace(".","",$s);
		

		$s = preg_replace('/[^a-zA-Z0-9_\.-]/', '', $s);
		return $s;
}

$query = DB::query("SELECT *
					FROM psn_canciones_copy");
foreach ($query as $row){
	$id_cancion = $row['id_cancion'];
	$artista = $row['artista'];
	$titulo = $row['titulo'];
	
	
	//sauvegarde salon_form_inscription_commercant
		/*DB::insert("psn_artistas",array(
		'artista' => $artista));*/
		
		//update mijishop_customer champ adress_id
		DB::update("psn_canciones_copy",array(
		'alias' => replace_specials_characters($titulo).replace_specials_characters($artista)),"id_cancion = %i",$id_cancion);
	
}
echo "FIN";
?>