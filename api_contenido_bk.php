<?php
if (!empty($_POST['id_radioco_canal'])) {
	date_default_timezone_set('America/Bogota');
	$id_radioco_canal = $_POST['id_radioco_canal'];
	require_once('api_php.php');
?>
	<!--*********************** -->
    <div id="qr_reponse">
    <?php //echo $callmeback." 2<br>"; ?>
    <input id="id_radioco_canal" name="id_radioco_canal" type="hidden" value="<?php echo $id_radioco_canal; ?>">
    <input id="callmeback" name="callmeback" type="hidden" value="<?php echo $callmeback; ?>">
    <input id="titulo" name="titulo" type="hidden" value="<?php echo $titulo; ?>">
    <input id="artista" name="artista" type="hidden" value="<?php echo $artista; ?>">
    <input id="bgprincipal" name="bgprincipal" type="hidden" value="<?php echo $bg1_artista; ?>">
    </div>
    
   
   <!--*********************** -->
   <div id="js_bg_principal_reponse">
        <script type="text/javascript">
            $(function(){
				var bgprincipal = $("input#bgprincipal").val();
				//alert("Hora de cambiar:" + bgprincipal);
				$('#bg_principal').css({
					"background-image": "url('images/artistas/"+bgprincipal+"')"
				});
			});
        </script> 
    </div>
    
    
    <!--*********************** -->
    <h4 id="cover_h4_reponse" style="color:#FFFFFF;" class="animated bounceInLeft"><?php echo $titulo;  ?></h4>
    
    
    <!--*********************** -->
    <h5 id="cover_h5_reponse" style="color:#cc1313;" class="animated bounceInLeft "><?php echo $artista; ?></h5>
    
    
    <!--*********************** -->
    <div id="id_tmp01_reponse" class="jp-title audio-title"><?php echo $titulo." - ".$artista;?></div>
    
    
    <!--*********************** -->
    <h3 id="tit_letra_reponse" class="animated fadeInDown"><?php echo $titulo; ?></h3>
    
    
    <!--*********************** -->
    <h4 id="art_letra_reponse"><?php echo $artista; ?></h4>
    
    
    <!--*********************** -->
    <div id="letra_reponse" class="text_widget">
    	<?php 
		if ($letra != ""){
			?> 
			<span id="panTop" class="panner" data-scroll-modifier='-1'><i class="fa fa-arrow-up ipanner" aria-hidden="true"></i></span>
			<?php 
		}
		echo $div_video; 
		echo $letra_seccion;
		if ($letra != ""){
			?>
			<span id="panBottom" class="panner" data-scroll-modifier='1'><i class="fa fa-arrow-down ipanner" aria-hidden="true"></i></span>
			<?php 
		}
		/*echo "<br>";
		echo $div_video;*/
		?>
		<script src="assets/js/scroll_letra.js"></script>
    </div>
    
    
    <!--*********************** -->
    <div id="img_letra_reponse">
		  <?php 
            if ($letra != ""){
                ?> 
                <div class="pub300">
                    <img src="images/artistas/<?php echo $bg1_artista; ?>" alt="<?php echo $artista; ?>">
                </div>
                <?php 
            }
            ?>
      </div>
      
      
      
      <!--*********************** -->
      	<div id="subsection_2_reponse">
            <div class="container animatedParent ">
              <div class="row">
                <div class="col-xs-12">
                  <div class="section_head_widget">
                    <h2 class="animated fadeInDown">Han sonado</h2>
                    <h5 class="animated fadeInLeft">recientemente</h5>
                  </div>
                </div>
                <!--column--> 
              </div>
              <!--row--> 
            </div>
            <!--contaier-->
            <div class="news_widget">
              <div class="container controls_wrapper animatedParent ">
                <div class="carousel_controls"> <span id="news-prev" class="fa fa-angle-left animated fadeInLeft"></span> <span id="news-next" class="fa fa-angle-right animated bounceInRight "></span> </div>
                <!--controls--> 
              </div>
              <!--//controls_wrapper//carousel_overlay-->
              <div id="recientes" class="news_carousel animatedParent ">
              	<?php
				$index_history_songs = 0;
              	foreach ($history_songs as $history_song) {
					$history_tituloYartista = explode(" - ",$history_song['title']);
					$history_titulo = $history_tituloYartista[1];
					$history_artista = $history_tituloYartista[0];
					if ($history_titulo != $titulo && $history_artista != $artista && $history_titulo != "SAMlisten.com" && $history_artista != "Romántica") {
						$index_history_songs ++;
						?>
						<div class="news_box fadeInUp animated">
                        <?php
						  $qr_ht_img = DB::query("SELECT bg1_artista
												FROM psn_artistas
												WHERE artista = %s
												LIMIT 1", $history_artista);
						  $history_bg_artista = (!empty($qr_ht_img) && file_exists("images/artistas/".$qr_ht_img[0]['bg1_artista'])) ? $qr_ht_img[0]['bg1_artista'] : "bg1_background.jpg";
						  ?>
						  <figure><img src="images/artistas/<?php echo $history_bg_artista; ?>" alt="<?php echo $history_artista; ?>" /></figure>
						  <div class="news_info_wrapper">
							<div class="news_info" style="width:100%;">
							  <h5><?php echo $history_titulo; ?></h5>
							  <ul class="news_meta">
								<li><?php echo $history_artista; ?></li>
							  </ul>
							  <!--//news_meta-->
							  <?php
							  $qr_ht = DB::query("SELECT id_cancion, link_video, link_audio, letra
										FROM psn_canciones
										WHERE artista = %s 
											AND titulo = %s
										 LIMIT 1", $history_artista, $history_titulo);
							  if (!empty($qr_ht)) {
								$dtl_v = !empty($qr_ht[0]['link_video']) ? '&nbsp;&nbsp;<i class="fa fa-youtube-play"></i>&nbsp;&nbsp;' : '';
								$dtl_a = !empty($qr_ht[0]['link_audio']) ? '&nbsp;&nbsp;<i class="fa fa-play"></i>&nbsp;&nbsp;' : '';
								$dtl_l = !empty($qr_ht[0]['letra']) ? '&nbsp;&nbsp;<i class="fa fa-align-center"></i>&nbsp;&nbsp;' : '';
							  }
							  ?>
							  <h6><?php echo $dtl_v.$dtl_a.$dtl_l; ?></h6>
							</div>
							<!--news_info--> 
						  </div>
						  <!--//news_info_wrapper-->
						  <div class="hover"> 
							 <a class="triggerNews" href="cancion.php?id=<?php echo $qr_ht[0]['id_cancion']; ?>&number=<?php echo $index_history_songs; ?>" data-number="<?php echo $index_history_songs; ?>">
								  Entrar
							  </a> 
							</div>
						  <!--//hover--> 
						</div>
						<!--//news_box bounceInUp animated-->
						<?php
					}
				}
			  	?>
              </div>
              <!--//news_carousel--> 
              
            </div>
            <!--//news_widget--> 
            </div>
    <?php
}
?>