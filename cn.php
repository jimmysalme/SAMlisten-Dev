<?php
/////////////////////////////////////
//Página de "Canciones individuales"
/////////////////////////////////////
$id_cancion	= isset($_GET['cn']) ? $_GET['cn'] : 0;
$qr_cancion = DB::query("SELECT ca.id AS id_canal, c.titulo, c.artista, a.bg1_artista, c.link_video, c.link_audio, c.letra, ca.app_id_fb, ca.descripcion
							FROM psn_canciones c
							INNER JOIN psn_artistas a ON c.artista = a.artista
							INNER JOIN psn_canales ca ON c.canal = ca.id
							WHERE c.id_cancion = %i", $id_cancion);
if (!empty($qr_cancion)) {
	$titulo 		= $qr_cancion[0]['titulo'];
	$artista 		= $qr_cancion[0]['artista'];
	$bg1_artista 	= file_exists("images/artistas/".$qr_cancion[0]['bg1_artista']) ? $qr_cancion[0]['bg1_artista'] : "bg1_background.jpg";
	$link_video 	= $qr_cancion[0]['link_video'];
	//$link_audio 	= !empty($qr_cancion[0]['link_audio']) ? str_replace("https://","https://a.",$qr_cancion[0]['link_audio']).".mp3" : "";
	$link_audio 	= !empty($qr_cancion[0]['link_audio']) ? $qr_cancion[0]['link_audio'] : "";
	$letra 			= $qr_cancion[0]['letra'];

	$app_id_fb_canal 		= $qr_cancion[0]['app_id_fb'];
	$descripcion_canal 		= $qr_cancion[0]['descripcion'];

	/////SECCIÓN "LETRA"
	$div_video = "";

	$letra_seccion = $letra != "" ? "<div style=\"text-align:center;\">".$letra."</div>" : "<p style=\"text-align:center;\"><b class=\"fa fa-pencil-square-o\"></b> Pronto encontrarás la letra de ésta canción.</p>";

	if ($link_video != "" || $link_audio != "") {
		$div_video .= '<div class="fa_grande">';
		if ($link_video != "") {
			$div_video .= '<a class="btnclickpauseiframeid_'.$id_cancion.'" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cancionactual_'.$id_cancion.'"><i class="fa fa-youtube-play"></i></a>&nbsp;&nbsp;&nbsp;';
		}
		if ($link_audio != "") {
			$div_video .= '&nbsp;&nbsp;&nbsp;<a class="btnclickpauseiframeid_'.$id_cancion.'" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#cancionactual_'.$id_cancion.'"><b class="fa fa-play"></b></a>';
		}
		$div_video .= '</div>';
	}
}
else {
	header("Location: https://www.samlisten.com");
	die();
}

include 'header.php';
?>
<body data-spy="scroll" data-target="#sticktop" data-offset="70">
	<?php echo 'El index es:'. $index; ?>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=144035672418663";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div id="dt_canal">
  <input id="bgprincipal" name="bgprincipal" type="hidden" value="<?php echo $bg1_artista; ?>">
  <input id="app_id_fb_canal" name="app_id_fb_canal" type="hidden" value="<?php echo $app_id_fb_canal; ?>">
  <input id="descripcion_canal" name="descripcion_canal" type="hidden" value="<?php echo $descripcion_canal; ?>">
</div>

<?php
//Preloader
include 'include/php_files/jsplash.php';
?>
<div class="wide_layout box-wide">

  <?php /////////////Sección Imagen principal/////////// ?>
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
              <div id="btn_social" style="margin-top:25px;"> <a href="https://www.facebook.com/samlisten.romantica" target="_blank"><img src="images/facebook-5-32.png" width="32" height="32" alt="Facebook"></a>&nbsp;&nbsp;&nbsp; <a href="https://twitter.com/SAMlisten" target="_blank"><img src="images/twitter-5-32.png" width="32" height="32" alt="Twitter"></a>&nbsp;&nbsp;&nbsp; <a href="https://www.youtube.com/user/samlisten/feed" target="_blank"><img src="images/youtube-5-32.png" width="32" height="32" alt="Youtube"></a>&nbsp;&nbsp;&nbsp; </div>
              <a class="ScrollTo animated bounceInUp" href="#section_12"><i class="fa fa-angle-down"></i></a> </div>
          </div>
        </div>
      </div>


      <?php /////////////Sección Barra de audio/////////// ?>
      <?php //Do not edit this section Unless you have to modify HTML structure of Playlist// ?>
      <div class="rock_player pre_sticky">
        <div class="sticky_player" data-sticky="true">
          <?php /////////////Barra roja/////////// ?>
          <div class="play_list">
            <div class="list_scroll">
              <div class="container ">
                <ul id="rouge_menu" class="music_widget player_data">
                  <li class="music_row row" style="border:none;">
					<?php /////////////Buscador/////////// ?>
                    <div class="col-xs-12 col-md-6 div_form_buscar">
                    	<?php include 'form_buscador.php'; ?>
                    </div>
                    <?php /////////////Compartir/////////// ?>
                    <div id="compartir_rs" class="col-xs-12 col-md-2">
                      <table border="0" align="center" cellpadding="0" cellspacing="0">
                      	<tr align="left" valign="middle">
                          <td align="center"><i class="fa fa-share-alt" aria-hidden="true" style="font-size:30px; color:#000; margin-right:5px;"></i></td>
                          <td align="left"><a href="https://www.facebook.com/dialog/feed?app_id=<?php echo $app_id_fb_canal; ?>&link=<?php echo urlencode(WEB_SITE."cn/".$id_cancion); ?>&picture=<?php echo urlencode(WEB_SITE."images/artistas/".$bg1_artista); ?>&name=<?php echo urlencode($titulo." - ".$artista);?>&to=&description=<?php echo urlencode($descripcion_canal." | Música online.");?>&redirect_uri=https://www.samlisten.com/close.php" target="_blank"><img src="images/facebook-like-4-64.png" width="48" height="48" alt="Compartir" /></a></td>
                          <td align="left"><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("SAMlisten.com/cn/".$id_cancion); ?>&text=<?php echo urlencode("Escucho \"".$titulo." - ".$artista."\" en SAMlisten.com/cn/".$id_cancion);?>&via=SAMlisten" target="_blank"><img src="images/twitter-4-64.png" width="48" height="48" alt="Compartir" /></a></td>
                          <td align="left"><a href="
                            https://plus.google.com/share?url=<?php echo urlencode(WEB_SITE."cn/".$id_cancion); ?>&hl=es" target="_blank"><img src="images/google-plus-4-64.png" width="48" height="48" alt="Compartir" /></a></td>
                        </tr>
                      </table>
                    </div>
                    <?php /////////////Votos/////////// ?>
                    <div id="div_votar" class="col-xs-12 col-md-4">
                      <form id="form_votos">
                        <input name="voto_cancion_id" id="voto_cancion_id" type="hidden" value="<?php echo $id_cancion; ?>">
                        <input type="text" id="form_val_v_1" name="form_val_v_1" />
                        <input type="text" id="form_val_v_2" value="https://" name="form_val_v_2" />
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


                    <?php /////////////Código que podría ser reutilizado (Por eso está comentado)/////////// ?>
                    <?php if (isset($variable_basura)) { ?>
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
                                  <div class="item_dedicala"> <i id="btn_fb_ded_desktop" class="fa fa-facebook-official"></i> </div>
                                  <div class="item_dedicala"> <i id="btn_fb_ded_mobile" class="fa fa-facebook-official"></i> </div>
                                  <div class="item_dedicala"> <i id="btn_mail_ded" class="fa fa-envelope"></i> </div>
                                </div>
                                <div class="cnt_ded">
                                  <div id="cnt_fb_ded"> Hola FB </div>
                                  <div id="cnt_mail_ded"> Hola Mail </div>
                                </div>
                                <script type="text/javascript">
									$(function(){
										$('#btn_fb_ded_desktop').click(function() {
											FB.ui({
											  method: 'send',
											  link: 'https://www.samlisten.com/cn/<?php echo $id_cancion; ?>',
											});
										});
										$('#btn_fb_ded_mobile').click(function() {
											FB.ui({
											  method: 'share',
											  href: 'https://www.samlisten.com/cn/<?php echo $id_cancion; ?>',
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
                    <?php } ?>
                  </li>
                  <script src="assets/js/votos.js"></script>
                </ul>
              </div>
            </div>
          </div>


          <?php /////////////Reproductor/////////// ?>
          <div class="jp-playlist hidden">
            <ul class=" playlist-files">
              <li
               data-thumb="assets/img/media/media_01.jpg"
               data-title=""
               data-genre=""
               data-artist=""
               data-length=""
               data-itunes=""
               data-video=""
               data-mp3="<?php echo $link_audio; ?>">
              </li>
            </ul>
          </div>
          <div class="container player_wrapper">
            <div class="row">
              <div id="player-instance" class="jp-jplayer"></div>
              <div id="id_tmp01" class="jp-title audio-title"><?php echo $titulo." - ".$artista;?></div>
              <div class="rock_controls controls">
                <div  class="fa fa-play jp-play"></div>
                <div  class="fa fa-pause jp-pause"></div>
              </div>
              <div class="audio-progress">
                <div class="jp-seek-bar" style="cursor:pointer;">
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
              <a href="#" class="playlist_expander fa fa-search"> <i class="fa fa-bars" aria-hidden="true"></i></a> </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php /////////////Barra Menú/////////// ?>
  <?php
  require_once('menu.php');
  ?>

    <?php /////////////Sección Letra/////////// ?>
    <section id="section_12" class="about_section">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="section_head_widget animatedParent ">
              <h3 id="tit_letra" class="animated fadeInDown"><?php echo $titulo; ?></h3>
              <h4 id="art_letra"><?php echo $artista; ?></h4>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-8">
            <div id="letra" class="text_widget">
              <?php
			  if ($letra != ""){ ?>
              	<span id="panTop" class="panner" data-scroll-modifier='-1'><i class="fa fa-arrow-up ipanner" aria-hidden="true"></i></span>
              	<?php
			  }
			  echo $div_video;
			  echo $letra_seccion;
			  if ($letra != ""){ ?>
              	<span id="panBottom" class="panner" data-scroll-modifier='1'><i class="fa fa-arrow-down ipanner" aria-hidden="true"></i></span>
              	<?php
			  }
			  /*echo "<br>";
			  echo $div_video;*/
			  ?>
              <div class="modal fade" id="cancionactual_<?php echo $id_cancion; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="text-align:initial; font-family: oswald; text-transform: uppercase;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <button type="button" class="close destroy_owl destroy_owl_video jp-play btnclickplayiframeid_<?php echo $id_cancion; ?>" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <div class="modal-body">
                      <div class="gallery_popup container">
                        <h2><?php echo $titulo; ?></h2>
                        <h6><?php echo $artista; ?></h6>
                        <div class="galery_widget">
                          <?php if (!empty($link_video)) { ?>
                          <div class="div_video_container">
                            <div class="div_video">
                              <iframe id="iframe_video" class="iframe_video" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                            </div>
                          </div>
                          <?php } ?>
                          <?php if (!empty($link_audio)) { ?>
                          <div <?php if (!empty($link_video)) { echo ' style="text-align:center; margin-top:40px;"'; }?>>
                            <audio controls class="audio_recientes">
                              <source type="audio/mpeg">
                              Para poder disfrutar del audio, debes actualizar tu navegador a una versión más reciente. </audio>
                          </div>
                          <?php } ?>
                          <div class="clearfix"></div>
                          <div class="text_widget">
                            <p><?php echo $letra; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
				$(function(){
					$('.btnclickpauseiframeid_<?php echo $id_cancion; ?>').click(function() {
						if($("#player-instance").data().jPlayer.status.paused == false){
							$.jPlayer.pause();
						}
						$('iframe.iframe_video').attr('src','https://www.youtube.com/embed/<?php echo $link_video; ?>');
						$('.audio_recientes').attr('src','<?php echo $link_audio; ?>');
					});

					$('.btnclickplayiframeid_<?php echo $id_cancion; ?>').click(function() {
						if($("#player-instance").data().jPlayer.status.paused == true){
							$("#player-instance").jPlayer("play");
						}
						$('iframe.iframe_video').attr('src','');
						$('.audio_recientes').attr('src','');
					});
				});
			</script>
              <script src="assets/js/scroll_letra.js"></script>
            </div>
          </div>
          <div class="col-xs-12 col-md-4">
            <div id="img_letra">
              <?php if ($letra != ""){ ?>
                  <div class="pub300"> <img src="images/artistas/<?php echo $bg1_artista; ?>" alt="<?php echo $artista; ?>"> </div>
              <?php } ?>
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
				else { ?>
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
    </section>

    <?php /////////////Sección Parallax Facebook/////////// ?>
    <section id="section_4" class="parallax parallax_one facebook_promo animatedParent " data-stellar-background-ratio="0.5">
      <div class="parallax_inner ">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h1 class="animated fadeInUp">Nuestra fanpage oficial</h1>
              <h3 class="animated fadeInDown">fb.com/<?php echo $page_fb_canal_short; ?></h3>
              <a href="<?php echo $page_fb_canal; ?>" class="btn btn_fb" target="_blank">Síguenos en Facebook</a> </div>
          </div>
        </div>
      </div>
      <!--parallax_inner-->
    </section>
    <!--//parallax-->

    <?php /////////////Sección LOGIN/////////// ?>
	<?php /////////////Código que podría ser reutilizado (Por eso está comentado)/////////// ?>
    <?php if (isset($variable_basura)) { ?>
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
                <div class="clearfix" style="text-align:right;"><br>
                  No tienes una cuenta? <a href="#">Regístrate aquí</a>.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>




<?php /////////////Sección TOP 20/////////// ?>
    <section id="section_9" class="tours_section">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="section_head_widget">
              <h2>Más canciones</h2>
              <h5>de <?php echo $artista; ?></h5>
            </div>
          </div>
          <!--section_head_widget-->
        </div>
        <!--row-->

        <div class="tours_widget">
          <div class="tour_row_header">
            <div class="column_one"> &nbsp; </div>
            <div class="column_three"> Título </div>
            <div class="column_four"> &nbsp; </div>
            <div class="column_five"> Votos </div>
            <div class="column_two"> &nbsp;<!--no header for picture column--></div>
            <div class="column_six"> &nbsp; </div>
          </div>
          <?php
			  $qr_top = DB::query("SELECT id_cancion, titulo, link_video, link_audio, letra, votos
									FROM psn_canciones
									WHERE artista = %s
									AND titulo <> %s",$artista, $titulo);
			  $index_top = 0;
			  foreach ($qr_top as $row_qr_top) {
				  $index_top ++;
				  $top_id_cancion = $row_qr_top['id_cancion'];
				  $top_titulo = $row_qr_top['titulo'];
				  $top_votos = $row_qr_top['votos'];
				  $top_link_video = $row_qr_top['link_video'];
				  $top_link_audio = $row_qr_top['link_audio'];
				  $top_letra = $row_qr_top['letra'];
				  ?>
                  <div class="tour_row animatedParent  ">
                    <div class="animated fadeInDownShort">
                      <div class="column_one"> <span><?php echo $index_top; ?></span> </div>
                      <div class="column_three"><a class="cn_hover_list" href="<?php echo WEB_SITE."cn/".$top_id_cancion; ?>"><?php echo $top_titulo; ?></a></div>
                      <div class="column_four"> &nbsp; </div>
                      <div class="column_five"> <?php echo $top_votos; ?> </div>
                      <div class="column_two"> <?php if(!empty($top_link_video) || !empty($top_link_audio)) { echo '<i class="fa fa-youtube-play"></i>';} ?> </div>
                      <div class="column_six"> <a class="btn btn_buy_ticket" href="<?php echo WEB_SITE."cn/".$top_id_cancion; ?>">Entrar</a> </div>
                    </div>
                  </div>
          <?php
			  }
			 ?>
        </div>
      </div>
      <!--container-->
    </section>
    <?php /////////////Parallax Youtube/////////// ?>
    <section id="section_8" class="parallax parallax_three event_promo" data-stellar-background-ratio="0.5">
      <div class="parallax_inner">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 animatedParent ">
              <h1 class="animated fadeInDown">Nuestro canal de videos</h1>
              <h3 class="animated bounceInRight">youtube.com/samlisten</h3>
              <a href="https://www.youtube.com/user/samlisten/videos" class="btn" target="_blank">Suscríbete en youtube</a> </div>
          </div>
        </div>
      </div>
    </section>



     <?php /////////////Sección ARTISTA DEL MES/////////// ?>
    <section id="section_12a" class="about_section">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="section_head_widget animatedParent ">
              <h1 class="animated fadeInDown">Ana Gabriel</h1>
              <h4>Artista del mes</h4>
            </div>
          </div>
          <!--section_head_widget-->
        </div>
        <!--row-->

        <div class="row">
          <div class="col-xs-12">
            <div class="text_widget">
             <p>María Guadalupe Araújo Yong inicia su carrera el 15 de septiembre de 1974 en Tijuana. En 1979 José Barrientos, su mánager en aquel entonces, buscó un nombre con el cuál darse a conocer, decidiéndose por "Ana Gabriel", con el que se le conoce hasta ahora.</p>

<p>A principios de los años 80's empezó a cantar en los bares de Tijuana hasta que en 1984 participó en valores como compositora, nunca como intérprete. El tema No me lastimes más quedó en segundo lugar y ese fue el empuje que la dio a conocer, gracias al apoyo del Sr. José Barrientos, de la compañía C.B.S., hoy Sony Music.</p>

<p>En 1985 grabó su primer disco de larga duración que llevó por título Un estilo, que si bien no resultaba muy comercial, si era bastante elocuente para la presentación del artista. Al año siguiente Ana logró participar en el Festival de la OTI, alcanzando el quinto lugar con la canción A tu lado, misma que se incluye en su álbum Sagitario, donde también se encuentran temas como Y Aquí Estoy, Eso no Basta y Mar y Arena.</p>

<p>En 1987 Ana Gabriel alcanza el primer lugar en la selección nacional para la OTI, y en Lisboa, Portugal, donde se llevó a cabo el festival de la OTI de ese año, alcanzando un tercer lugar, el cual le abrió las puertas que la hizo conocida en toda Latinoamérica.</p>

<p>En 1989 Ana Gabriel logra posicionarse a nivel internacional, dentro del mercado estadounidense, su álbum Tierra de Nadie permaneció en listas del Billboard varios meses.</p>

<p>Ha grabado a dúo con artistas como Armando Manzanero, Pedro Fernández, Yuri, Plácido Domingo, Jon Secada, Rocío Jurado, Vikki Carr y José Feliciano entre otros.</p>

<p>En 2013, ante más de 15.000 personas que agotaron las entradas del Arena de Santiago, fue galardonada con disco de diamante por más de 1 millón de discos vendidos en Chile. En mayo de ese mismo año, es confirmada para actuar en el LV Festival de la Canción de Viña del Mar.</p>

<p>En diciembre de 2014, la cantante Ana Gabriel comunicó a los reporteros del programa Ventaneando de TV Azteca que en 2015 publicará su nuevo proyecto discográfico luego de siete años sin lanzar un disco con temas inéditos.</p>

<div id="fuente_biografia">Fuente: Wikipedia</p>
            </div>
          </div>
        </div>
      </div>
      <!--container-->
    </section>



    <?php /////////////Parallax Twitter/////////// ?>
    <div id="section_10" class="parallax parallax_four latest_tweets" data-stellar-background-ratio="0.5" style="margin-bottom:0;">
      <div class="parallax_inner">
        <div class="container">
          <div class="row">
            <div class="col-xs-12"> <a href="https://twitter.com/SAMlisten" class="btn btn_fb" target="_blank" style="font-size:40px; background-color:#55ACEE;">@SAMlisten</a>
              <div class="tweet"></div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <?php /////////////Sección FOOTER/////////// ?>
    <?php include 'footer.php'; ?>
  </div>
</div>

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
	<?php /////////////Put Your Google Tracker Code here/////////// ?>


	<?php ///////////////////////////////////////////////////////// ?>
</script>

<script src="assets/js/bgppal.js"></script>

<div id="js_bg_principal">
  <script type="text/javascript">
		$(function(){
			var bgprincipal = $("input#bgprincipal").val();
			$('#bg_principal').css({
				"background-image": "url('images/artistas/"+bgprincipal+"')"
			});
		});
	</script>
</div>
</body>
</html>
