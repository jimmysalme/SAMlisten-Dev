<?php 
//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
set_time_limit (0); 
/*function replace_specials_characters($s) {
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



//==============================================================
$query = DB::query("SELECT id_cancion, titulo, artista
			FROM psn_canciones");
foreach ($query as $row){
	$id_cancion = $row['id_cancion'];
	$artista = trim($row['artista']);
	$titulo = trim($row['titulo']);

	DB::update("psn_canciones",array(
	'titulo' => $titulo,
	'artista' => $artista),"id_cancion = %i",$id_cancion);
	
}

echo "FINAL TRIM<br>";


//==============================================================
$query = DB::query("SELECT Title, Artist, Length
					FROM mp3tag");
foreach ($query as $row){
	$Title = $row['Title'];
	$Artist = $row['Artist'];
	$Length = $row['Length'];
	
	
	//*****************************
	$query_2 = DB::query("SELECT id_cancion, titulo, artista
							FROM psn_canciones
							WHERE titulo = %s AND artista = %s", $Title, $Artist);
							
	if (!empty($query_2)) {
		DB::update("psn_canciones",array(
			'titulo' => $Title,
			'artista' => $Artist),"id_cancion = %i",$query_2[0]['id_cancion']);
	}
	else {
		DB::insert("psn_canciones",array(
			'artista' => $Artist,
			'titulo' => $Title,
			'canal' => 1,
			'carpeta' => 1,
			'segundos' => $Length,
			'duracion' => gmdate("H:i:s", $Length),
			'letra_coveralia' => "",
			'letra' => "",
			'link_video' => "",
			'link_audio' => "",
			'ultima_cancion' => 0,
			'votos' => 0
			));
	}
	
	//*****************************
	$query_3 = DB::query("SELECT id_artista, artista
							FROM psn_artistas
							WHERE artista = %s", $Artist);
							
	if (!empty($query_3)) {
		DB::update("psn_artistas",array(
			'artista' => $Artist),"id_artista = %i",$query_3[0]['id_artista']);
	}
	else {
		DB::insert("psn_artistas",array(
			'artista' => $Artist,
			'bg1_artista' => "bg1_background.jpg",
			'bg2_artista' => "bg2_background.jpg",
			'md_artista' => "md_background.jpg",
			'pq_artista' => "pq_background.jpg"
			));
	}
}*/


$query = DB::query("SELECT id_cancion
					FROM psn_canciones
					WHERE titulo <> \"SAMlisten.com\"
					ORDER BY RAND() LIMIT 11");
/*$index_random_a = 1;
$index_random_b = 2;*/
$contador = 0;
foreach ($query as $row) {
	$id = $row['id_cancion'];
	$contador ++;
	/*$top_votos = mt_rand($index_random_a,$index_random_b);
	$index_random_a = $index_random_b;
	$index_random_b = $index_random_b*2;*/
	DB::update("psn_canciones",array(
			'item_reciente' => $contador),"id_cancion = %i",$id);
}
						
echo "FINAL UPDATE";
?>