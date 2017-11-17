<?php
if (!empty($_POST['voto_cancion_id']) && !empty($_POST['voto_cancion'])) {
	require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
	$query = DB::query("SELECT votos
					FROM psn_canciones
					WHERE id_cancion = %i",$_POST['voto_cancion_id']);
	if (!empty($query)) {
		foreach ($query as $row) {
			$votos = $row['votos'];
			DB::update("psn_canciones",array(
				'votos' => $votos+$_POST['voto_cancion']),"id_cancion = %i",$_POST['voto_cancion_id']);
		}
		echo "Perfecto! Gracias por tu voto.";
		unset($_POST['voto_cancion_id']);
		unset($_POST['voto_cancion']);
	}
	else {
		echo "Gracias por tu voto.";
	}
}
else {
	//header("Location: https://www.samlisten.com");
	die();
	//echo "Buuu";
}
?>
