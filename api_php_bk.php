<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
header('Content-Type: text/html; charset=utf-8');

$callmeback_val = 0;
	
//////CANCIÓN ACTUAL
//$id_radioco_canal = "sa1d457733";
$url_datainfo = "https://public.radio.co/stations/".$id_radioco_canal."/status";
$contenido_datainfo = file_get_contents($url_datainfo);
$datainfo = json_decode($contenido_datainfo, true);
/*echo "<pre>";
var_dump ($datainfo["history"]);
echo "</pre>";*/

$tituloYartista = explode(" - ",$datainfo['current_track']['title']);
$titulo = $tituloYartista[1];
$artista = $tituloYartista[0];

$starttime_hora_array = explode("+", substr($datainfo['current_track']['start_time'], 11));
$starttime_hora = $starttime_hora_array[0];

$callmeback = 180000;

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

/////DATA CANCIONES /////CALLMEBACK
		$query_cancion = DB::query("SELECT *
						FROM psn_canciones
						WHERE titulo = %s 
						AND artista = %s", $titulo, $artista);
		
		if (!empty($query_cancion)) {
			$playduration_segundos = $query_cancion[0]['segundos'];
			
			$starttime_hora_prox = strtotime ( '+'.$playduration_segundos.' second' , strtotime ( $starttime_hora ) ) ;
			$starttime_hora_prox = date ( 'H:i:s' , $starttime_hora_prox );
			
			$hora_actual = date ( 'H:i:s' , strtotime ( '+5 hour' , strtotime ( date ( 'H:i:s' ) ) ) );

			$callmeback = (((strtotime($starttime_hora_prox) - strtotime($hora_actual))*1000)+7000);
			
			$id_cancion = $query_cancion[0]['id_cancion'];
			$canal = $query_cancion[0]['canal'];
			$carpeta = $query_cancion[0]['carpeta'];
			$segundos = $query_cancion[0]['segundos'];
			$duracion = $query_cancion[0]['duracion'];
			$letra_coveralia = $query_cancion[0]['letra_coveralia'];
			$letra = $query_cancion[0]['letra'];
			$link_video = $query_cancion[0]['link_video'];
			$link_audio = $query_cancion[0]['link_audio'];
			$ultima_cancion = $query_cancion[0]['ultima_cancion'];
			$votos = $query_cancion[0]['votos'];
			
			if ($callmeback < 0) {
				$callmeback = $callmeback * (-1);
			}
		}
		elseif ($titulo == "SAMlisten.com" && $artista = "Romántica") {
			$titulo 	= "Tus canciones favoritas";
			$artista 	= "Tus artistas favoritos";
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

$link_video_url 	= $link_video != "" ? "https://www.youtube.com/watch?v=".$link_video : "";
$link_video_embed 	= $link_video != "" ? '<iframe id="iframe_video" src="https://www.youtube.com/embed/'.$link_video.'" frameborder="0" allowfullscreen></iframe>' : '';

$link_audio_url = $link_audio != "" ? "https://a.clyp.it/".$link_audio.".mp3" : "";

if ($link_video != "" || $link_audio != "") {
	$div_video .= '<div class="fa_grande">';	
	if ($link_video != "") {
		$div_video .= '<a href="#"><i class="fa fa-youtube-play"></i></a>&nbsp;&nbsp;&nbsp;';	
	}
	if ($link_audio != "") {
		$div_video .= '&nbsp;&nbsp;&nbsp;<a href="#"><b class="fa fa-play"></b></a>';	
	}
	$div_video .= '</div>';
}
		

//////CANCIONES RECIENTES
$history_songs = $datainfo["history"];
?>
