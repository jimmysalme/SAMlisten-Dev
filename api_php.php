<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
//header('Content-Type: text/html; charset=utf-8');

$callmeback_start = isset($callmeback_start) ? $callmeback_start : 0;

//////CANCIÓN ACTUAL
if (!isset($url_datainfo)) {
	//$centova = "http://162.244.80.30:8072";
	$url_datainfo = $centova."/currentsong";
	$contenido_datainfo = file_get_contents($url_datainfo);

	$tituloYartista = explode(" - ",$contenido_datainfo);
	$titulo_tmp = trim($tituloYartista[1]);
	$artista_tmp = trim($tituloYartista[0]);
	//var_dump($contenido_datainfo);
}

$callmeback = 15000;

$id_cancion = 0;
$canal = 0;
$carpeta = 0;
$segundos = 0;
$duracion = "00:00:00";
$letra_coveralia = "";
$letra = "";
$link_video = "";
$link_audio = "";
$ultima_cancion = 0;
$votos = 0;
$item_reciente = 0;

if ($titulo_tmp != $titulo || $artista_tmp != $artista) {
	$titulo = $titulo_tmp;
	$artista = $artista_tmp;


	/////DATA CANCIONES /////CALLMEBACK
	$query_cancion = DB::query("SELECT *
					FROM psn_canciones
					WHERE titulo = %s
					AND artista = %s", $titulo, $artista);



	if ((!empty($query_cancion)) && $titulo != "SAMlisten.com") {
		$id_cancion = $query_cancion[0]['id_cancion'];
		$canal = $query_cancion[0]['canal'];
		$carpeta = $query_cancion[0]['carpeta'];
		$segundos = $query_cancion[0]['segundos'];
		$duracion = $query_cancion[0]['duracion'];
		$letra_coveralia = $query_cancion[0]['letra_coveralia'];
		$letra = $query_cancion[0]['letra'];
		$link_video = $query_cancion[0]['link_video'];
		//$link_audio = !empty($query_cancion[0]['link_audio']) ? str_replace("https://","https://a.",$query_cancion[0]['link_audio']).".mp3" : "";
		$link_audio = !empty($query_cancion[0]['link_audio']) ? $query_cancion[0]['link_audio'] : "";
		//$link_audio = $query_cancion[0]['link_audio'];
		$ultima_cancion = $query_cancion[0]['ultima_cancion'];
		$votos = $query_cancion[0]['votos'];
		$item_reciente = $query_cancion[0]['item_reciente'];

		if ($callmeback_start > 0) {
			$callmeback = ($segundos*1000);
		}

		if ($callmeback < 0) {
			$callmeback = $callmeback * (-1);
		}

		if ($item_reciente == 0) {
			DB::update("psn_canciones",array(
				'item_reciente' => 0),"item_reciente = 11");

			for ($i=10;$i>=1;$i--) {
				DB::update("psn_canciones",array(
				'item_reciente' => $i+1),"item_reciente = %i",$i);
			}
			DB::update("psn_canciones",array(
				'item_reciente' => 1),"id_cancion = %i",$id_cancion);
		}

	}
	elseif ($titulo == "SAMlisten.com") {
			$callmeback = 4000;
	}
	else {

	}

	/////IMAGES ARTISTA
	$query_artista = DB::query("SELECT bg1_artista, bg2_artista, md_artista, pq_artista
				 FROM psn_artistas
				 WHERE artista = %s
				 LIMIT 1", $artista);

	if (!empty($query_artista)) {
		foreach ($query_artista as $row_query_artista) {
			foreach ($row_query_artista as $clave=>$valor) {
				$$clave = $valor;
				if (!file_exists("images/artistas/".$$clave)) {
					$$clave = "bg1_background.jpg";
				}
			}
		}
		if ($bg2_artista == "bg1_background.jpg") {
			$bg2_artista = "bg2_background.jpg";
		}
	}
	else {
		//$id_artista = $query_artista[0]['id_artista'];
		$bg1_artista = $md_artista = $pq_artista = "bg1_background.jpg";
		$bg2_artista = "bg2_background.jpg";
	}


	/////SECCIÓN "LETRA"
	$div_video = "";
	$letra_seccion = $letra != "" ? "<div style=\"text-align:center;\">".$letra."</div>" : "<p style=\"text-align:center;\"><b class=\"fa fa-pencil-square-o\"></b> Pronto encontrarás la letra de ésta canción.</p>";
	if ($link_video != "" || $link_audio != "") {
		$div_video .= '<div class="fa_grande">';
		if ($link_video != "") {
			$div_video .= '<a class="btnclickpause btnclickpauseiframeid_'.$id_cancion.'" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cancionactual_'.$id_cancion.'"><i class="fa fa-youtube-play"></i></a>&nbsp;&nbsp;&nbsp;';
		}
		if ($link_audio != "") {
			$div_video .= '&nbsp;&nbsp;&nbsp;<a class="btnclickpause btnclickpauseiframeid_'.$id_cancion.'" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cancionactual_'.$id_cancion.'"><b class="fa fa-play"></b></a>';
		}
		$div_video .= '</div>';
	}


	//////CANCIONES RECIENTES
	$query_history = DB::query("SELECT c.id_cancion, c.titulo, c.artista, a.bg1_artista, c.link_video, c.link_audio, c.letra, c.item_reciente
										FROM psn_canciones c
										INNER JOIN psn_artistas a ON c.artista = a.artista
										WHERE c.item_reciente > 1
										ORDER BY item_reciente");
}

?>
