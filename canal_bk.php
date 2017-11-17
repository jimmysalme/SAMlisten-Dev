<?php
include 'header.php';
header('Content-Type: text/html; charset=utf-8');
?>
<body data-spy="scroll" data-target="#sticktop" data-offset="70">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=144035672418663";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="qr">
    	<?php
		require_once('api_php.php');
		?>
        <input id="centova" name="centova" type="hidden" value="<?php echo $centova; ?>">
        <input id="callmeback" name="callmeback" type="hidden" value="<?php echo $callmeback; ?>">
        <input id="titulo" name="titulo" type="hidden" value="<?php echo $titulo; ?>">
        <input id="artista" name="artista" type="hidden" value="<?php echo $artista; ?>">
        <input id="bgprincipal" name="bgprincipal" type="hidden" value="<?php echo $bg1_artista; ?>">
    </div>
    <div id="callmeback_start">
        <input id="callmeback_start" name="callmeback_start" type="hidden" value="<?php echo $callmeback_start; ?>">
    </div>
    
    <!--=====================================
    Preloader
    ========================================-->
    <div id="jSplash">
        <figure class="preload_logo">
            <img src="assets/img/basic/logo2.png" alt="SAMlisten.com"/>
        </figure>
    </div>
    <div class="wide_layout box-wide">
        <!--================
         Banner
        ==='=================-->
        <div id="bg_principal" class="fullscreen background parallax_ppal" style="background-image:url('images/artistas/<?php echo $bg1_artista; ?>'); transition: background-image 1s ease-in-out;" data-img-width="1920" data-img-height="1080" data-diff="100">
            <section id="section_1" class="banner hero_section">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                        <div class="hero_content animatedParent animateLoop">
                           <h1 class="animated bounceInDown"><img src="assets/img/basic/logo_gr.png" alt="SAMlisten.com" longdesc="SAMlisten.com"></h1>
                          <br>
                          <h4 id="cover_h4" style="color:#FFFFFF;" class="animated bounceInLeft"><?php echo $titulo; ?></h4>
                          <h5 id="cover_h5" style="color:#cc1313;" class="animated bounceInLeft "><?php echo $artista; ?></h5>
                          <div id="btn_social" style="margin-top:25px;">
                            <a href="https://www.facebook.com/samlisten.romantica" target="_blank"><img src="images/facebook-5-32.png" width="32" height="32" alt="Facebook"></a>&nbsp;&nbsp;&nbsp;
                            <a href="https://twitter.com/SAMlisten" target="_blank"><img src="images/twitter-5-32.png" width="32" height="32" alt="Twitter"></a>&nbsp;&nbsp;&nbsp;
                            <a href="https://www.youtube.com/user/samlisten/feed" target="_blank"><img src="images/youtube-5-32.png" width="32" height="32" alt="Youtube"></a>&nbsp;&nbsp;&nbsp;
                          </div>
                          <a class="ScrollTo animated bounceInUp" href="#section_12"><i class="fa fa-angle-down"></i></a>
                       </div>
                  </div>
                </div>
              </div>
            <!--=================================
            JPlayer (Audio Player)
            =================================-->
              <!--Do not edit this section Unless you have to modify HTML structure of Playlist-->
              <div class="rock_player pre_sticky">
              <div class="sticky_player" data-sticky="true">
                <div class="play_list">
                  <div class="list_scroll">
                    <div class="container ">
                      <ul id="rouge_menu" class="music_widget player_data">
                        <li class="music_row row" style="border:none;">
                          <div class="col-xs-12 col-md-4">
                            <a class="btn btn_watch_video" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#dedicala">Dedicar</a>
                          </div>
                          <div id="compartir_rs" class="col-xs-12 col-md-4">
                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr align="left" valign="middle">
                                <td align="left"><a href="
                            https://www.facebook.com/dialog/feed?
                            app_id=<?php echo $app_id_fb_canal; ?>&
                            link=<?php echo urlencode("http://www.samlisten.com?cn=".$id_cancion); ?>&
                            picture=<?php echo WEB_SITE."images/artistas/".$bg1_artista; ?>&
                            name=<?php echo urlencode($titulo." - ".$artista);?>&
                            to=&
                            description=<?php echo urlencode($descripcion_canal." | Música online.");?>&
                            redirect_uri=http://www.samlisten.com/close.php" target="_blank"><img src="images/facebook-like-4-64.png" width="48" height="48" alt="Compartir" /></a></td>
                                  <td align="left"><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("SAMlisten.com/?cn=".$id_cancion); ?>&text=<?php echo urlencode("Escucho \"".$titulo." - ".$artista."\" en SAMlisten.com/?cn=".$id_cancion);?>&via=SAMlisten" target="_blank"><img src="images/twitter-4-64.png" width="48" height="48" alt="Compartir" /></a></td>
                                    <td align="left"><a href="
                            https://plus.google.com/share?url=<?php echo urlencode(WEB_SITE."?cn=".$id_cancion); ?>&hl=es" target="_blank"><img src="images/google-plus-4-64.png" width="48" height="48" alt="Compartir" /></a></td> 
                                </tr>
                              </table>
                          </div>
                          <div id="div_votar" class="col-xs-12 col-md-4">
                            <form id="form_votos">
                            <input name="voto_cancion_id" id="voto_cancion_id" type="hidden" value="<?php echo $id_cancion; ?>">
                            <input type="text" id="form_val_v_1" name="form_val_v_1" />
                            <input type="text" id="form_val_v_2" value="http://" name="form_val_v_2" />
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr align="center">
                                <td colspan="5">Cuánto te gusta ésta canción?</td>
                              </tr>
                              <tr align="center">
                                <td><input name="voto_cancion" type="radio" value="1"></td>
                                <td><input name="voto_cancion" type="radio" value="2"></td>
                                <td><input name="voto_cancion" type="radio" value="3"></td>
                                <td><input name="voto_cancion" type="radio" value="4"></td>
                                <td><input name="voto_cancion" type="radio" value="5"></td>
                                <td rowspan="2"><input name="votar" type="submit" value="VOTA" class="encuesta_submit btn btn_watch_video"></td>
                              </tr>
                              <tr align="center">
                                <td class="encuesta_texto">1</td>
                                <td class="encuesta_texto">2</td>
                                <td class="encuesta_texto">3</td>
                                <td class="encuesta_texto">4</td>
                                <td class="encuesta_texto">5</td>
                              </tr>
                            </table>
                            </form> 
                          </div>
                          
                          
                          <!--Popup Dedícala-->
                          <div class="modal fade" id="dedicala" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <button type="button" class="close destroy_owl destroy_owl_video" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                                <div class="modal-body">
                                
                                      <div class="gallery_popup container">
                                        <h2><?php echo $titulo; ?></h2>
                                        <h6><?php echo $artista; ?></h6>
                                        
                                        <div class="galery_widget" style="color:#CC1313;">
                                        	<div class="btn_ded">
                                            	<div class="item_dedicala">
                                                	<i id="btn_fb_ded_desktop" class="fa fa-facebook-official"></i>
                                                </div>
                                                <div class="item_dedicala">
                                                	<i id="btn_fb_ded_mobile" class="fa fa-facebook-official"></i>
                                                </div>
                                                <div class="item_dedicala">
                                                	<i id="btn_mail_ded" class="fa fa-envelope"></i>
                                                </div>
                                            </div>
                                            <div class="cnt_ded">
                                            	<div id="cnt_fb_ded">
                                                	Hola FB
                                                </div>
                                                <div id="cnt_mail_ded">
                                                	Hola Mail
                                                </div>
                                            </div>
                                            
                                            <script type="text/javascript">
												$(function(){
													$('#btn_fb_ded_desktop').click(function() {
														FB.ui({
														  method: 'send',
														  link: 'http://www.samlisten.com?cn=<?php echo $id_cancion; ?>',
														});
													});
													$('#btn_fb_ded_mobile').click(function() {
														FB.ui({
														  method: 'share',
														  href: 'http://www.samlisten.com?cn=<?php echo $id_cancion; ?>',
														}, function(response){});
													});
												});
											</script>
                                        </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <!--music row-->
                        <?php
						//include 'assets/php/votos.js.php';
						?>
                        <script src="assets/js/votos.js"></script>
                      </ul>
                      <!--music_widget--> 
                    </div>
                    <!--container--> 
                  </div>
                </div>
                <!--//=============================================================
                Edit or Modify Playist content in the following Hypertext
                ==============================================================-->
                <div class="jp-playlist hidden"> 
                  <!--Add Songs In mp3 formate here-->
                  <ul class=" playlist-files">
                    <li 
                           data-thumb="assets/img/media/media_01.jpg"
                           data-title=""
                           data-genre=""  
                           data-artist="" 
                           data-length="" 
                           data-itunes="" 
                           data-video="" 
                           data-mp3="<?php echo $centova."/;stream.mp3"; ?>">
                    </li>
                  </ul>
                  <!--Playlist ends--> 
                </div>
                <div class="container player_wrapper">
                  <div class="row">
                    <div id="player-instance" class="jp-jplayer"></div>
                    <div id="id_tmp01" class="jp-title audio-title"><?php echo $titulo." - ".$artista;?></div>
                    <div class="rock_controls controls">
                    	<!--<div style="padding: 9px 5px;"><?php echo $player_radioco_canal;?></div> -->
                      <div  class="fa fa-play jp-play btnclickplay"></div>
                      <div  class="fa fa-stop jp-pause btnclickpause"></div>
                    </div> 
                    <!--controls-->
                    <div class="audio-progress">
                      <div class="jp-seek-bar" style="pointer-events: none;">
                        <div class="audio-play-bar jp-play-bar" style="width:20%;"></div>
                      </div>
                      <!--jp-seek-bar--> 
                    </div>
                    <!--audio-progress-->
                    <div class="audio-timer"> <span class="jp-current-time"></span> </div>
                    <div class="jp-volume">
                      <ul>
                        <li class="active"><a href="#"></a></li>
                        <li class="active"><a href="#"></a></li>
                        <li class="active"><a href="#"></a></li>
                        <li class="active"><a href="#"></a></li>
                        <li><a href="#"></a></li>
                      </ul>
                    </div>
                    <a href="#" class="playlist_expander fa fa-bars"></a> </div>
                </div>
              </div></div>
            </section>
    	</div>
        
        <!--//banner--> 
        <!--=========================
         BARRA MENÚ
        ===========================-->
        <header>
          <nav id="sticktop" class="navbar navbar-default" data-sticky="true">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#"><img src="assets/img/basic/logo.png" alt="logo"/></a> </div>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="?canal=retro">Retro</a></li>
                  <li><a style="padding-top: 7px;" href="https://www.facebook.com/samlisten.romantica" target="_blank"><img src="images/facebook-5-32.png" width="32" height="32"></a></li>
                  <li><a style="padding-top: 7px;" href="https://twitter.com/SAMlisten" target="_blank"><img src="images/twitter-5-32.png" width="32" height="32"></a></li>
                  <li><a style="padding-top: 7px;" href="https://www.youtube.com/user/samlisten/videos" target="_blank"><img src="images/youtube-5-32.png" width="32" height="32"></a></li>
                </ul>
              </div>
              <!--/.nav-collapse --> 
            </div>
          </nav>
        </header>
        
        <div class="sections_wrapper"> 
        
        
        <!--======================================
        LETRA
        ==========================================-->
          <section id="section_12" class="about_section">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">

                  <div class="section_head_widget animatedParent ">
                    <h3 id="tit_letra" class="animated fadeInDown"><?php echo $titulo; ?></h3>
                    <h4 id="art_letra"><?php echo $artista; ?></h4>
                  </div>
                </div>
                <!--section_head_widget--> 
              </div>
              <!--row-->
              
              <div class="row">
                <div class="col-xs-12 col-md-8">
                  <div id="letra" class="text_widget">
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
                </div>
                
                <div class="col-xs-12 col-md-4">
                  <div id="img_letra">
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
                  <div id="pub01">
                        <div class="pub300">
                        	<!--<p class="tit_pub">Sección patrocinada</p>
                            <div align="center">
                            	<?php //contenido dinámico ?>
                            </div> -->
							<?php 
                            include('geo/geolocalizacion.php');
                            if ($locations['countryCode'] == 'CO') {
                                ?>
                                <p class="tit_pub">Sección patrocinada para <?php echo $locations['countryName']; ?></p>
                                <img src="images/pub/pub_abc.png" alt="Publicidad ABC Autoservicio">
                                <?php
                            }
                            else {
                                ?>
                                	<p class="tit_pub">Sección patrocinada</p>
                                    <div align="center">
                                    	<div style="background:#FFF; border:1px solid red; padding:20px 10px;">
                                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                                <input type="hidden" name="cmd" value="_s-xclick">
                                                <input type="hidden" name="hosted_button_id" value="3KH2SCRR25VHC">
                                                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"> 
                                            </form>
                                            <p class="tit_pub" style="text-transform: none; line-height: normal; margin-top: 20px;">Hazte patrocinador. Tu aporte voluntario nos ayudará a mantener éste sitio Web activo y en crecimiento.</p>
                                       </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                  </div>
                </div>
                
              </div>
            </div>
            <!--container--> 
          </section>
          
          
        <!--================
         HAN SONADO RECIENTEMENTE
        ====================-->
          <section id="section_2" class="news_section section_first">
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
              	foreach($query_history as $row_history) {
					$history_id_cancion = $row_history['id_cancion'];
					$history_titulo 	= $row_history['titulo'];
					$history_artista 	= $row_history['artista'];
					$history_bg_artista = file_exists("images/artistas/".$row_history['bg1_artista']) ? $row_history['bg1_artista'] : "bg1_background.jpg";
					$history_item_reciente = $row_history['item_reciente'];
					$dtl_v = !empty($row_history['link_video']) ? '&nbsp;&nbsp;<i class="fa fa-youtube-play"></i>&nbsp;&nbsp;' : '';
					$dtl_a = !empty($row_history['link_audio']) ? '&nbsp;&nbsp;<i class="fa fa-play"></i>&nbsp;&nbsp;' : '';
					$dtl_l = !empty($row_history['letra']) ? '&nbsp;&nbsp;<i class="fa fa-align-center"></i>&nbsp;&nbsp;' : '';
					$index_history_songs ++;
					?>
					<div class="news_box fadeInUp animated">
					  <figure><img src="images/artistas/<?php echo $history_bg_artista; ?>" alt="<?php echo $history_artista; ?>" /></figure>
					  <div class="news_info_wrapper">
						<div class="news_info" style="width:100%;">
						  <h5><?php echo $history_titulo; ?></h5>
						  <ul class="news_meta">
							<li><?php echo $history_artista; ?></li>
						  </ul>
						  <!--//news_meta-->
						  <h6><?php echo $dtl_v.$dtl_a.$dtl_l; ?></h6>
						</div>
						<!--news_info--> 
					  </div>
					  <!--//news_info_wrapper-->
					  <div class="hover"> 
                      	<a class="<?php if(!empty($row_history['link_video']) || !empty($row_history['link_audio'])) { echo "btnclickpause btnclickpauseiframe".$index_history_songs;} ?>" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#recientes_pop<?php echo $index_history_songs; ?>">
                            Entrar
                        </a>
						</div>
					  <!--//hover--> 
					</div>
					<!--//news_box bounceInUp animated-->
                    
                    
                    <div class="modal fade" id="recientes_pop<?php echo $index_history_songs; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <button type="button" class="close destroy_owl destroy_owl_video btnclickplay <?php if(!empty($row_history['link_video']) || !empty($row_history['link_audio'])) { echo "btnclickplayiframe".$index_history_songs;} ?>" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                            <div class="modal-body">
                            
                                  <div class="gallery_popup container">
                                    <h2><?php echo $history_titulo; ?></h2>
                                    <h6><?php echo $history_artista; ?></h6>
                                    
                                    <div class="galery_widget">
                                    	<?php if (!empty($row_history['link_video'])) { ?>
                                    	<div class="div_video_container">
                                            <div class="div_video">
                                               <iframe id="iframe_video" class="iframe_video" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if (!empty($row_history['link_audio'])) { ?>
                                            <div <?php if (!empty($row_history['link_video'])) { echo ' style="text-align:center; margin-top:40px;"'; }?>>
                                            <audio controls class="audio_recientes">
                                              <source type="audio/mpeg">
                                            Para poder disfrutar del audio, debes actualizar tu navegador a una versión más reciente.
                                            </audio>
                                            </div>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                        <div class="text_widget">
                                          <p><?php echo $row_history['letra']; ?></p>
                                        </div>
                                    </div>
                                </div><!--gallery-popup-->
                              </div>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
						$(function(){
							$('.btnclickpauseiframe<?php echo $index_history_songs; ?>').click(function() {
								$('iframe.iframe_video').attr('src','https://www.youtube.com/embed/<?php echo $row_history['link_video']; ?>');
								$('.audio_recientes').attr('src','<?php echo str_replace("https://","https://a.",$row_history['link_audio']).".mp3"; ?>');
							});
							
							$('.btnclickplayiframe<?php echo $index_history_songs; ?>').click(function() {
								$('iframe.iframe_video').attr('src','');
								$('.audio_recientes').attr('src','');
							});
						});
					</script> 
					<?php
				}
			  	?>
              </div>
              <!--//news_carousel--> 
              
            </div>
            <!--//news_widget--> 
            
          </section>
          <!--//News--> 
            
          <section id="newsAjaxWrapper" class="container">
                <a class="closeNewsAjax" href="#section_2"><i class="fa fa-times"></i></a>
                <div id="newsAjax" class="content_expander"></div>
          </section>
          
          
          
         <!--======================================
        Parallax/facebook page promotion Section
        ==========================================-->
          <section id="section_4" class="parallax parallax_one facebook_promo animatedParent " data-stellar-background-ratio="0.5">
            <div class="parallax_inner ">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    <h1 class="animated fadeInUp">Nuestra fanpage oficial</h1>
                    <h3 class="animated fadeInDown">fb.com/<?php echo $page_fb_canal_short; ?></h3>
                    <a href="<?php echo $page_fb_canal; ?>" class="btn btn_fb" target="_blank">Síguenos en Facebook</a> </div>
                  <!--column--> 
                </div>
                <!--row--> 
              </div>
              <!--container--> 
            </div>
            <!--parallax_inner--> 
          </section>
          <!--//parallax--> 
        
        
         
          
          <!--================
         LOGIN
        ====================-->
          <section id="section_3" class="newsletter_section">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="team_prizes"> 
                    <div class="newsletter_form">
                      <form>
                        <input type="text" placeholder="Usuario"/>
                        <input type="password" placeholder="Contraseña"/>
                        <!--<input type="email" placeholder="Email"/> -->
                        <button>Entrar</button>
                        <div class="clearfix"></div>
                      </form>
                      <div class="clearfix" style="text-align:right;"><br>No tienes una cuenta? <a href="#">Regístrate aquí</a>.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          
        
        
        
        <!--======================================
        VIDEOS SECTION
        ==========================================-->
          <section id="section_7" class="media_section">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="section_head_widget animatedParent">
                    <h2 class="animated fadeInLeft">Videoteca</h2>
                    <h5 class="animated bounceInUp">Virtual</h5>
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
												ORDER BY RAND()
												LIMIT 8");
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
                <div class="col-xs-12 col-sm-4 col-md-3 animatedParent">
                  <figure class="animated fadeInUp"> 
                    <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#gal_pop<?php echo $video_id_artista; ?>">
                        <img src="images/artistas/<?php echo $video_bg_artista; ?>" alt="<?php echo $video_artista; ?>" />
                    </a><!--hyperlink-->
                    <figcaption>
                      <h6><?php echo $video_artista; ?></h6>
                      <?php echo count($qr_videos_artistas)." video"; echo count($qr_videos_artistas)>1?"s":""; ?> </figcaption>
                  </figure>
                  <!--figure--> 
                </div>

					<!--=====================================
				Gallery Pop Ups : 
				You can create as many modals/poups as needed,
				==========================================-->
			
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
                                                            <div class="gal_list_mini">
                                                                <a href="#"><img src="http://img.youtube.com/vi/<?php echo $video_link; ?>/0.jpg" alt="" /></a>
                                                                <!--<a class="owl-video" href="http://www.youtube.com/watch?v=<?php echo $video_link; ?>"><img src="http://img.youtube.com/vi/<?php echo $video_link; ?>/0.jpg" alt="" /></a> -->
                                                                <br>
                                                                <?php echo $video_titulo; ?>
                                                            </div>
                                                            
                                                            <div class="gal_list_iframevideo" style="display:none;">
                                                            	<div class="div_video_container">
                                            						<div class="div_video">
                                                                		<iframe id="iframe_video" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_link; ?>" frameborder="0" allowfullscreen></iframe>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <?php echo $video_titulo; ?>
                                                            </div>
                                                        </li>
                                                   </ul>
                                                </li>
											<?php } ?>
                                        </ul>
                                        
                                        <ul class="social_share">
                                            <li><a class="btn-share twitter" href="#">Tweet</a><span class="share-count">896</span></li>
                                            <li><a class="btn-share facebook" href="#">Like</a><span class="share-count">2k</span></li>
                                            <li><a class="btn-share google-plus" href="#">1+</a><span class="share-count">18</span></li>
                                        </ul>
                                        
                                        <!--<ul class="channels_list row">
                                          <li class="col-xs-12 col-sm-4"> <a href="#"><i class="fa fa-circular fa-music"></i>poison itunes</a></li>
                                          <li class="col-xs-12 col-sm-4"><a href="#"><i class="fa fa-soundcloud"></i>poison soundcloud</a></li>
                                          <li class="col-xs-12 col-sm-4"> <a href="#"><i class="fa fa-youtube"></i>poison youtube</a></li>
                                        </ul> -->
                                        
                                    </div>
                                </div><!--gallery-popup-->
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
            <!--container--> 
            <div style="height:20px;"></div>
            <div class="container">
              <ul class="channels_list row animatedParent ">
                <li class="col-xs-12 animated fadeInLeft"><a href="#"><i class="fa fa-circular fa-youtube-play"></i>Ver lista completa</a></li>
              </ul>
           </div>
          </section>
          <!--//media_section-->  
          
        
             
          
         <!--======================================
        Parallax/youtube
        ==========================================-->
          <section id="section_8" class="parallax parallax_three event_promo" data-stellar-background-ratio="0.5">
            <div class="parallax_inner">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 animatedParent ">
                    <h1 class="animated fadeInDown">Nuestro canal de videos</h1>
                    <h3 class="animated bounceInRight">youtube.com/samlisten</h3>
                    <!--<h5  class="animated bounceInUp">november 5th 2013</h5> -->
                    <a href="https://www.youtube.com/user/samlisten/videos" class="btn" target="_blank">Suscríbete en youtube</a> </div>
                  <!--column--> 
                </div>
                <!--row--> 
              </div>
              <!--container--> 
            </div>
            <!--parallax_inner--> 
          </section>
          <!--//parallax--> 
          
           
       
        <!--======================================
        Tours Section
        ==========================================-->
          <section id="section_9" class="tours_section">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="section_head_widget">
                    <h2>TOP 20</h2>
                    <h5><?php echo $meses[date('n')-1]. " ".date('Y') ; ?></h5>
                  </div>
                </div>
                <!--section_head_widget--> 
              </div>
              <!--row-->
              
              <div class="tours_widget">
                <div class="tour_row_header">
                  <div class="column_one"> Pos. </div>
                  <div class="column_two"> &nbsp;<!--no header for picture column--> 
                  </div>
                  <div class="column_three"> Título </div>
                  <div class="column_four"> Artista </div>
                  <div class="column_five"> Votos </div>
                  <div class="column_six"> &nbsp; </div>
                </div>
                
                <?php
			  $qr_top = DB::query("SELECT c.titulo, c.artista, a.bg1_artista, c.votos
									FROM psn_canciones c
									INNER JOIN psn_artistas a ON c.artista = a.artista
									WHERE c.carpeta = 1
									AND c.titulo <> \"SAMlisten.com\"
									ORDER BY votos DESC
									LIMIT 20");
			  $index_top = 0;
			  foreach ($qr_top as $row_qr_top) {
				  $index_top ++;
				  $top_titulo = $row_qr_top['titulo'];
				  $top_artista = $row_qr_top['artista'];
				  $top_img = $row_qr_top['bg1_artista'];
				  $top_votos = substr($row_qr_top['votos'],0,3);
				  
				  $top_bg_artista = (file_exists("images/artistas/".$top_img)) ? $top_img : "bg1_background.jpg";
				  ?>
                  <div class="tour_row animatedParent  ">
                  <div class="animated fadeInDownShort">
                    <div class="column_one">
                      <span><?php echo $index_top; ?></span>
                    </div>
                    <div class="column_two"> <img src="images/artistas/<?php echo $top_bg_artista; ?>" alt="<?php echo $top_artista; ?>" /> </div>
                    <div class="column_three"> <?php echo $top_titulo; ?> </div>
                    <div class="column_four"> <?php echo $top_artista; ?> </div>
                    <div class="column_five"> <?php echo $top_votos; ?> </div>
                    <div class="column_six"> <a class="btn btn_buy_ticket" href="#">Escuchar</a> </div>
                  </div>
                </div>
                <!--tour row-->
                  <?php
			  }
			 ?>
              </div>
            </div>
            <!--container--> 
          </section>
          <!--//tours--> 
          
          <!--======================================
        Parallax/Tweets Section
        ==========================================-->
          <div id="section_10" class="parallax parallax_four latest_tweets" data-stellar-background-ratio="0.5">
            <div class="parallax_inner">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12"> <a href="https://twitter.com/SAMlisten" class="btn btn_fb" target="_blank" style="font-size:40px; background-color:#55ACEE;">@SAMlisten</a>
                    <div class="tweet"></div>
                  </div>
                  <!--column--> 
                </div>
                <!--row--> 
              </div>
              <!--container--> 
            </div>
            <!--parallax_inner--> 
          </div>
          <!--//parallax--> 
          
           <!--======================================
    Artista del mes
    ==========================================-->
      <section id="section_12" class="about_section">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="section_head_widget animatedParent ">
                <h1 class="animated fadeInDown">Juan Gabriel</h1>
                <h4>Artista del mes</h4>
              </div>
            </div>
            <!--section_head_widget--> 
          </div>
          <!--row-->
          
          <div class="row">
            <div class="col-xs-12">
              <div class="text_widget">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero ligula, mollis eget ipsum a, aliquet pellentesque nisi. Donec mollis vel orci eget consequat. Etiam ultrices eu erat eu facilisis. Morbi nec suscipit tortor. Sed eu est leo. Phasellus a enim a sem auctor sodales. Vestibulum interdum ultrices tincidunt. Vivamus suscipit odio id pretium commodo. Donec vitae pellentesque dui. Nullam a hendrerit mi, vel placerat neque. Nunc et nunc turpis. Mauris sed congue lectus, ut blandit diam. Sed pellentesque egestas magna in feugiat. Praesent in ipsum velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <p>Quisque lacinia euismod lobortis. Pellentesque purus orci, consequat vel mi id, pretium accumsan urna. In hac habitasse platea dictumst. Aenean ut accumsan nunc. Nam ac bibendum mi. Maecenas ultricies blandit vehicula. Nullam posuere metus congue odio dictum vestibulum. Quisque pharetra, nisl sit amet fermentum dignissim, est felis consequat sapien, eu pellentesque nulla mi sed lacus. Aenean molestie condimentum consequat.</p>
                <p>Sed a lectus suscipit, blandit arcu a, vehicula nisi. Quisque faucibus elit ac mauris sodales auctor. Quisque scelerisque aliquam accumsan. Donec ullamcorper tortor nec nisl egestas, vitae interdum diam dignissim. Donec sollicitudin eu tellus in fermentum. Ut eu dui sit amet erat euismod euismod in non turpis. Pellentesque luctus dui massa.</p>
              </div>
            </div>
          </div>
        </div>
        <!--container--> 
      </section> 
        
    <!--======================================
        Parallax/Testimonial Section
        ==========================================-->
          <div id="section_6" class="parallax parallax_two testimonial" data-stellar-background-ratio="0.5">
            <div class="parallax_inner">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="testimonial_quotes owl-carousel owl-theme ">
                      <blockquote> <b class="fa fa-quote-left"></b> Me encanta su emisora. Odiaba escuchar radio. Pero desde hace 15 días estoy super enganchado con uds felicitaciones y sigan con esas baladas maravillosas. <b class="fa fa-quote-right"></b> <a class="author_name">Enzo Vega</a> </blockquote>
                      <blockquote> <b class="fa fa-quote-left"></b> hola de que país y ciudad es esta radio online los felicito por poner muy bonitas música romantica <b class="fa fa-quote-right"></b> <a class="author_name">Jean Pierre De La Torre</a> </blockquote>
                    </div>
                    <!--testimonial_quotes carousel end here--> 
                    
                  </div>
                  <!--column--> 
                </div>
                <!--row--> 
              </div>
              <!--container--> 
              <!--<a href="#" class="btn_itunes"><span class="fa fa-music"></span>poison itunes</a>--> </div> 
            <!--parallax_inner--> 
          </div>
          <!--//parallax--> 
          
           
               
                
          <!--======================================
        Footer
        ==========================================-->
          <footer id="section_13" class="parallax parallax_five footer" data-stellar-background-ratio="0.5">
            <div class="parallax_inner">
              <div class="container">
                  <!--=========================
                  Contact Form
                  ===========================-->          
                <div class="contact_Us">
                   <div class="tabs-wrap tabs-wrap-active clearfix">
                        <ul class="tabs">
                            <li class="tab-link tab-link1 active" data-tab="tab1">
                                <span>Comentarios</span>
                            </li>
                            <li class="tab-link tab-link2" data-tab="tab2">
                                <span>Contáctanos</span>
                            </li>
                        </ul>
                    </div><!--tab wrapper-->
    
                    <div id="tab1" class="tab-content active">   
                        <!--<ul class="channels_list row animatedParent " data-sequence="400">
                          <li class="col-xs-12 col-sm-4 animated fadeInLeftShort" data-id="1"> <a href="#"><i class="fa fa-circular fa-music"></i>poison itunes</a></li>
                          <li class="col-xs-12 col-sm-4 animated fadeInLeft" data-id="2"><a href="#"><i class="fa fa-soundcloud"></i>poison soundcloud</a></li>
                          <li class="col-xs-12 col-sm-4  animated fadeInLeft" data-id="3"> <a href="#"><i class="fa fa-youtube"></i>poison youtube</a></li>
                          <li class="col-xs-12 col-sm-4 animated fadeInLeft" data-id="4"> <a href="#"><i class="fa fa-instagram"></i>poison Instagram</a></li>
                          <li class="col-xs-12 col-sm-4  animated fadeInLeft" data-id="5"> <a href="#"><i class="fa fa-flickr"></i>poison Flicker</a></li>
                          <li class="col-xs-12 col-sm-4  animated fadeInLeft" data-id="6"> <a href="#"><i class="fa fa-pinterest"></i>poison pinterest</a></li>
                        </ul> -->
                        <div class="fb-comments" data-href="http://www.samlisten.com/romantica/index1.php?canal=romantica" data-width="100%" data-numposts="5"></div>
                    </div>
                    <div id="tab2" class="tab-content animatedParent">  
                        <div class="contactFormWrapper ">
                            <form id="contactform" action="assets/php/submit.php" method="post">
                            	<div id="form_val" class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <input type="text" id="form_val_1" name="form_val_1" />
                                    </div><!--column-->
                                    <div class="col-xs-12 col-md-6">
                                        <input type="text" id="form_val_2" value="http://" name="form_val_2" />
                                    </div><!--column-->
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" id="name" placeholder="Nombre"/>
                                    </div><!--column-->
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" name="email" id="email" placeholder="Email" />
                                    </div><!--column-->
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" name="subject" id="subject" placeholder="Asunto" />
                                    </div><!--column-->
                                    <div class="col-xs-12 col-md-8">
                                        <textarea placeholder="Mensaje" name="message" id="message"></textarea>
                                    </div><!--column-->
                                    <div class="col-xs-12 col-md-4">
                                        <button class="btn btn-default" id="submit1" type="submit">
                                            Enviar mensaje
                                        </button>
                                    </div><!--column-->
    
                                </div><!--row-->
                            </form>
                            <div id="valid-issue" style="display:none;"> Todos los campos son requeridos.</div>  
                        </div>
                    </div>
                    
                </div>  
                
                
                <div class="row">
                  <div class="col-xs-12">
                    <div class="copyrights">&copy; <?php echo date("Y");?> SAMLISTEN.COM &nbsp;|&nbsp; Powered by <a href="http://www.jimsa.ca/" target="_blank">JIMSA.CA</a></div>
                  </div>
                </div>
              </div><!--container--> 
            </div><!--parallax_inner--> 
          </footer><!--//parallax--> 
        </div>
        
    </div>
    <!--===================================================================
    Scripts
    ====================================================================--> 
	<!--<script src="assets/js/jquery-1.11.0.min.js"></script> --> 
    <script src="assets/js/jpreloader.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
    <script src="assets/js/jquery.easing-1.3.pack.js"></script>
    <script src="assets/js/jquery.stellar.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="assets/js/tweetie.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/jPlayer/jquery.jplayer.min.js"></script>
    <script src="assets/jPlayer/add-on/jplayer.playlist.min.js"></script>
    <script src="assets/js/jquery.vegas.min.js"></script>
    <script src="assets/js/css3-animate-it.js"></script>
    <script src="assets/js/jquery.fractionslider.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="assets/js/jquery.waitforimages.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/bigvideo.js"></script>
    <script src="assets/js/main.js"></script>
    
    
    
    
     
    <script>
    
    $('body').jpreLoader({
            splashID: "#jSplash",
            loaderVPos: '50%',
            autoClose: true,
    });
    /*====================================================================
    Put Your Google Tracker Code here
    ===================================================================*/
    </script>
	
	
    <script type="text/javascript">
			/*====================================================================
			JIMSA bg_principal
			===================================================================*/
			/* detect touch */
			if("ontouchstart" in window){
				document.documentElement.className = document.documentElement.className + " touch";
			}
			if(!$("html").hasClass("touch")){
				/* background fix */
				$(".parallax_ppal").css("background-attachment", "fixed");
			}
			
			/* fix vertical when not overflow
			call fullscreenFix() if .fullscreen content changes */
			function fullscreenFix(){
				var h = $('body').height();
				// set .fullscreen height
				$(".content-b").each(function(i){
					if($(this).innerHeight() > h){ $(this).closest(".fullscreen").addClass("overflow");
					}
				});
			}
			$(window).resize(fullscreenFix);
			fullscreenFix();
			
			/* resize background images */
			function backgroundResize(){
				var windowH = $(window).height();
				$(".background").each(function(i){
					var path = $(this);
					// variables
					var contW = path.width();
					var contH = path.height();
					var imgW = path.attr("data-img-width");
					var imgH = path.attr("data-img-height");
					var ratio = imgW / imgH;
					// overflowing difference
					var diff = parseFloat(path.attr("data-diff"));
					diff = diff ? diff : 0;
					// remaining height to have fullscreen image only on parallax
					var remainingH = 0;
					if(path.hasClass("parallax_ppal") && !$("html").hasClass("touch")){
						var maxH = contH > windowH ? contH : windowH;
						remainingH = windowH - contH;
					}
					// set img values depending on cont
					imgH = contH + remainingH + diff;
					imgW = imgH * ratio;
					// fix when too large
					if(contW > imgW){
						imgW = contW;
						imgH = imgW / ratio;
					}
					//
					path.data("resized-imgW", imgW);
					path.data("resized-imgH", imgH);
					path.css("background-size", imgW + "px " + imgH + "px");
				});
			}
			$(window).resize(backgroundResize);
			$(window).focus(backgroundResize);
			backgroundResize();
			
			/* set parallax background-position */
			function parallaxPosition(e){
				var heightWindow = $(window).height();
				var topWindow = $(window).scrollTop();
				var bottomWindow = topWindow + heightWindow;
				var currentWindow = (topWindow + bottomWindow) / 2;
				$(".parallax_ppal").each(function(i){
					var path = $(this);
					var height = path.height();
					var top = path.offset().top;
					var bottom = top + height;
					// only when in range
					if(bottomWindow > top && topWindow < bottom){
						var imgW = path.data("resized-imgW");
						var imgH = path.data("resized-imgH");
						// min when image touch top of window
						var min = 0;
						// max when image touch bottom of window
						var max = - imgH + heightWindow;
						// overflow changes parallax
						var overflowH = height < heightWindow ? imgH - height : imgH - heightWindow; // fix height on overflow
						top = top - overflowH;
						bottom = bottom + overflowH;
						// value with linear interpolation
						var value = min + (max - min) * (currentWindow - top) / (bottom - top);
						// set background-position
						var orizontalPosition = path.attr("data-oriz-pos");
						orizontalPosition = orizontalPosition ? orizontalPosition : "50%";
						$(this).css("background-position", orizontalPosition + " " + value + "px");
					}
				});
			}
			if(!$("html").hasClass("touch")){
				$(window).resize(parallaxPosition);
				//$(window).focus(parallaxPosition);
				$(window).scroll(parallaxPosition);
				parallaxPosition();
			}

			</script>
    
    <div id="js_bg_principal">
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
    
    <script type="text/javascript">
    /*====================================================================
    Recargar API "Currentsong"
    ===================================================================*/
		$(function(){
			var callmeback = $("input#callmeback").val();
			var interval = setInterval(function(){get_feedback();}, callmeback);
			
			function get_feedback(){
				var callmeback 			= $("input#callmeback").val();
				var centova 			= $("input#centova").val();
				var titulo 				= $("input#titulo").val();
				var artista 			= $("input#artista").val();
				
				var datos = {
					"centova" 				: centova,
					"titulo" 				: titulo,
					"artista" 				: artista,
					"app_id_fb_canal" 		: "<?php echo $app_id_fb_canal; ?>",
					"descripcion_canal" 	: "<?php echo $descripcion_canal; ?>"
				 };
				$.ajax({
					data:  datos,
					type: "POST",
					url: "api_contenido.php",
					async: false, 
					success: function(response) {
						//alert("Hora de cambiar:");
						$('#qr').html( $(response).filter('#qr_reponse').html() );
						
						$('#callmeback_start').html( $(response).filter('#callmeback_start_reponse').html());
						
						var callmeback_start = $("input#callmeback_start").val();
						
						if (callmeback_start == 1 || callmeback_start == "1") {
							$(".modal-backdrop.fade.in").remove();
							
							$('#js_bg_principal').fadeOut(400, function()	{
								$('#js_bg_principal').html( $(response).filter('#js_bg_principal_reponse').html() ).fadeIn(400);
							});
							
							$('#cover_h4').fadeOut(400, function()	{
								$('#cover_h4').html( $(response).filter('#cover_h4_reponse').html() ).fadeIn(400);
							});
							
							$('#cover_h5').fadeOut(400, function()	{
								$('#cover_h5').html( $(response).filter('#cover_h5_reponse').html() ).fadeIn(400);
							});
							
	
							//*****Extraído del backup
							/*$('#id_tmp01').fadeOut(400, function()	{
								$('#id_tmp01').html( $(response).filter('#id_tmp01_reponse').html() ).fadeIn(400);
							});*/
							
							$('#rouge_menu').fadeOut(400, function()	{
								$('#rouge_menu').html( $(response).filter('#rouge_menu_reponse').html() ).fadeIn(400);
							});
							
							$('#rouge_menu').fadeOut(400, function()	{
								$('#rouge_menu').html( $(response).filter('#rouge_menu_reponse').html() ).fadeIn(400);
							});
							//*****Fin Extraído del backup
							
							
							$('#tit_letra').fadeOut(400, function()	{
								$('#tit_letra').html( $(response).filter('#tit_letra_reponse').html() ).fadeIn(400);
							});
							
							$('#art_letra').fadeOut(400, function()	{
								$('#art_letra').html( $(response).filter('#art_letra_reponse').html() ).fadeIn(400);
							});
							
							$('#letra').fadeOut(400, function()	{
								$('#letra').html( $(response).filter('#letra_reponse').html() ).fadeIn(400);
							});
							
							
							//*****Extraído del backup
							$('#img_letra').fadeOut(400, function()	{
								$('#img_letra').html( $(response).filter('#img_letra_reponse').html() ).fadeIn(400);
							});
							
							$('#recientes').fadeOut(400, function()	{
								$('#recientes').html( $(response).filter('#recientes_reponse').html() ).fadeIn(400);
							});
							
							//*****Fin Extraído del backup
						}
					} ,
					error: function(){
						alert("Error al cargar la página. Refresca tu navegador para intentarlo de nuevo.");
					}
				}).complete(function(){
					if (interval != 0 || interval !== 0) {
						clearInterval(interval);
						interval = 0;
					}
					var callmeback2 = $("input#callmeback").val();
					setTimeout(function(){get_feedback();}, callmeback2);
				}).responseText;
			}
		});
	</script>
    <script type="text/javascript">
		$(function(){
			$('.btnclickpause').click(function() {
				if($("#player-instance").data().jPlayer.status.paused == false){
					$.jPlayer.pause();
				}
			});
			
			$('.btnclickplay').click(function() {
				if($("#player-instance").data().jPlayer.status.paused == true){
					$("#player-instance").jPlayer("setMedia", {
						mp3: "<?php echo $centova."/;stream.mp3"; ?>"
					}).jPlayer("play");
				}
			});
		});
	</script>
   
   
    
    
    </body>
    </html>
