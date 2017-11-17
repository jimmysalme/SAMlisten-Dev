<?php
if (!empty($_POST['total_par_videos'])) {
	//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
	require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
	header('Content-Type: text/html; charset=utf-8');
	
	$total_parrila = $_POST['total_par_videos'];
	?>
	<div id="parrilla_videos_reponse" class="container">
		<div class="row">
		  <div class="col-xs-12">
			<div class="section_head_widget">
			  <h2>Videoteca</h2>
			  <h5>Virtual</h5>
			</div>
		  </div>
		</div>
		<!--row-->
		
		<div class="row media_widget">
		  <?php
			  $qr_video_artistas = DB::query("SELECT DISTINCT c.artista, a.id_artista, a.bg1_artista
											FROM psn_canciones c
											INNER JOIN psn_artistas a ON c.artista = a.artista
											WHERE c.link_video <> \"\"
												ORDER BY RAND(".strtotime(date("Y-m-d")).")
												LIMIT %i", $total_parrila);
												
			  if (!empty($qr_video_artistas)) {
				  foreach ($qr_video_artistas as $row_video_artistas) {
					  $video_artista = $row_video_artistas['artista'];
					  $video_id_artista = $row_video_artistas['id_artista'];
					  $video_bg1_artista = $row_video_artistas['bg1_artista'];
						
					  $video_bg_artista = (!empty($video_bg1_artista) && file_exists("images/artistas/".$video_bg1_artista)) ? $video_bg1_artista : "bg1_background.jpg";
					  
					  $qr_videos_artistas = DB::query("SELECT link_video, titulo
														FROM psn_canciones
														WHERE artista = %s AND link_video <> \"\"", $video_artista);
				  ?>
				  <div class="col-xs-12 col-sm-4 col-md-3">
					<figure> <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#gal_pop<?php echo $video_id_artista; ?>"> <img src="images/artistas/<?php echo $video_bg_artista; ?>" alt="<?php echo $video_artista; ?>" /> </a><!--hyperlink-->
					  <figcaption>
						<h6><?php echo $video_artista; ?></h6>
						<?php echo count($qr_videos_artistas)." video"; echo count($qr_videos_artistas)>1?"s":""; ?> </figcaption>
					</figure>
					<!--figure--> 
				  </div>
		  
				<?php /////////////MODAL VIDEOS/////////// ?>
					<div class="modal fade" id="gal_pop<?php echo $video_id_artista; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
						<button type="button" class="close destroy_owl destroy_owl_video btnclickplay" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
						<div class="modal-body">
						  <div class="gallery_popup container">
							<ul class="gallayoutOption">
							  <li class="active"><a href="#" class="fa fa-th gridGallery btnclickplay"></a></li>
							  <li style="display:none;"><a href="#" class="fa fa-picture-o sliderGallery"></a></li>
							</ul>
							<h2><?php echo $video_artista; ?></h2>
							<h6><?php echo count($qr_videos_artistas)." video"; echo count($qr_videos_artistas)>1?"s":""; ?></h6>
							<div class="galery_widget">
							  <ul class="gal_list gal_list_parent">
								<?php 
								$idx_videos_artistas = -1;
								foreach ($qr_videos_artistas as $row_videos_artistas) { 
								$idx_videos_artistas ++;
								$video_link = $row_videos_artistas['link_video'];
								$video_titulo = $row_videos_artistas['titulo'];
								?>
								<li class="trigger_slider trigger_slider_<?php echo $idx_videos_artistas; ?> btnclickpause">
								  <ul class="gal_list_child_<?php echo $idx_videos_artistas; ?>">
									<li class="">
									  <div class="gal_list_mini"> <a href="#"><img src="https://img.youtube.com/vi/<?php echo $video_link; ?>/0.jpg" alt="" /></a> 
										<br>
										<?php echo $video_titulo; ?> </div>
									  <div class="gal_list_iframevideo" style="display:none;">
										<div class="div_video_container">
										  <div class="div_video">
											<iframe id="iframe_video" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_link; ?>" frameborder="0" allowfullscreen></iframe>
										  </div>
										</div>
										<br>
										<?php echo $video_titulo; ?> </div>
									</li>
								  </ul>
								</li>
								<?php } ?>
							  </ul>
							</div>
						  </div>
						  <!--gallery-popup--> 
						</div>
					  </div>
					</div>
				  </div>
				<?php
				  }
			  }
			  ?>
		</div>
	  </div>
	 <?php
}
else {
	header("Location: https://www.samlisten.com");
	die();
}
?>