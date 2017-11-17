<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
include 'header.php';
header('Content-Type: text/html; charset=utf-8');
?>
<body data-spy="scroll" data-target="#sticktop" data-offset="70">
<?php
//Preloader
include 'include/php_files/jsplash.php';
?>
<!--=====================================
Track/Album
========================================-->

<div class="wide_layout box-wide">
	<div class="container pageContentArea">
        <div class=" news_popup container">
            <?php
			$id 	= isset($_GET['id']) ? $_GET['id'] : 0; 
			$number = isset($_GET['number']) ? $_GET['number'] : 0;
			$qr_cancion = DB::query("SELECT titulo, artista, link_video, link_audio, letra
									FROM psn_canciones
									WHERE id_cancion = %i", $id);
			if (!empty($qr_cancion)) {
				$titulo 	= $qr_cancion[0]['titulo'];
				$artista 	= $qr_cancion[0]['artista'];
				$link_video = $qr_cancion[0]['link_video'];
				$link_audio = $qr_cancion[0]['link_audio'];
				$letra 		= $qr_cancion[0]['letra'];
				?>
                <div id="xv-news<?php echo $number; ?>" class="newsContent">
                    <div class="row news_row">
                      <div class="col-xs-12">
                        <div class="">
                          <h2><?php echo $titulo; ?></h2>
                          <ul class="popup_meta">
                            <li><?php echo $artista; ?></li>
                          </ul>
                        </div>
                        <!--<ul class="images_grid">
                          <li> <img src="assets/img/popup/grid_01.jpg" alt="demo-image"/> </li>
                          <li> <img src="assets/img/popup/grid_02.jpg" alt="demo-image"/> </li>
                          <li> <img src="assets/img/popup/grid_03.jpg" alt="demo-image"/> </li>
                          <li> <img src="assets/img/popup/grid_04.jpg" alt="demo-image"/> </li>
                          <li> <img src="assets/img/popup/grid_05.jpg" alt="demo-image"/> </li>
                          <li> <img src="assets/img/popup/grid_06.jpg" alt="demo-image"/> </li>
                        </ul> -->
                        <div class="div_video">
                        	<?php if (!empty($link_video)) { ?>
                        		<iframe id="iframe_video" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $link_video; ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
                            <?php if (!empty($link_audio)) { ?>
                            	<p>
                                <audio controls>
                                  <source src="https://a.clyp.it/<?php echo $link_audio; ?>.mp3" type="audio/mpeg">
                                Para poder disfrutar del audio, debes actualizar tu navegador a una versión más reciente.
                                </audio>
                                </p>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="text_widget">
                          <p><?php echo $letra; ?></p>
                        </div>
                        <!--text_widget-->
                        
                      </div>
                    </div>
                </div>
                <?php
			}
			else {
				echo "Hola";
			}
			?>
         </div>
    </div>                          
</div>
<!--===================================================================
Place JavsScripts here
====================================================================--> 
<script src="assets/js/jquery-1.11.0.min.js"></script> 
<script src="assets/js/jpreloader.min.js"></script>
<script src="assets/js/css3-animate-it.js"></script> 
<script src="assets/js/jquery.easing-1.3.pack.js"></script>

<script>
$('body').jpreLoader({
		splashID: "#jSplash",
		loaderVPos: '50%',
		autoClose: true,
});
</script>



</body>
</html>
