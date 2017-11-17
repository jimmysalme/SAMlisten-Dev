<?php
if (!empty($_POST['centova'])) {
	date_default_timezone_set('America/Bogota');
	$centova = $_POST['centova'];
	$titulo = $_POST['titulo'];
	$artista = $_POST['artista'];

	$app_id_fb_canal = $_POST['app_id_fb_canal'];
	$descripcion_canal = $_POST['descripcion_canal'];
	//$path_total = $_POST['path_total'];

	//$centova = "http://162.244.80.30:8072";
	$url_datainfo = $centova."/currentsong";
	$contenido_datainfo = file_get_contents($url_datainfo);

	$tituloYartista = explode(" - ",$contenido_datainfo);
	$titulo_tmp = trim($tituloYartista[1]);
	$artista_tmp = trim($tituloYartista[0]);
	$callmeback_start = 0;

	if ($titulo_tmp != $titulo || $artista_tmp != $artista) {
		$callmeback_start = 1;
		require_once('api_php.php');
		?>
        <!--*********************** -->
        <div id="qr_reponse">
        <input id="centova" name="centova" type="hidden" value="<?php echo $centova; ?>">
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
        <ul id="rouge_menu_reponse" class="music_widget player_data">
          <li class="music_row row" style="border:none;">
            <?php /////////////Buscador/////////// ?>
            <div class="col-xs-12 col-md-6 div_form_buscar">
                <form class="form_buscar">
                  <input class="box_buscar" type="text" placeholder="Canción o artista"/>
                  <button class="btn_buscar">Buscar</button>
                  <div class="clearfix"></div>
                </form>
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


        <!--*********************** -->
        <h3 id="tit_letra_reponse" class="animated fadeInDown"><?php echo $titulo; ?></h3>


        <!--*********************** -->
        <h4 id="art_letra_reponse"><?php echo $artista; ?></h4>


        <!--*********************** -->
        <div id="letra_reponse" class="text_widget">
            <?php
            echo $div_video;
            echo $letra_seccion;
            /*echo "<br>";
            echo $div_video;*/
            ?>
            <div class="modal fade" id="cancionactual_<?php echo $id_cancion; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="text-align:initial; font-family: oswald; text-transform: uppercase;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <button type="button" class="close destroy_owl destroy_owl_video btnclickplay btnclickplayiframeid_<?php echo $id_cancion; ?>" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
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
						$('iframe.iframe_video').attr('src','');
						$('.audio_recientes').attr('src','');
						if($("#player-instance").data().jPlayer.status.paused == true){
							$("#player-instance").jPlayer("setMedia", {
								mp3: "<?php echo $centova."/;stream.mp3"; ?>"
							}).jPlayer("play");
						}
					});
				});
			</script>
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
          <div id="recientes_reponse" class="news_carousel animatedParent ">
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
					<div class="news_box">
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
							if($("#player-instance").data().jPlayer.status.paused == false){
								$.jPlayer.pause();
							}
							$('iframe.iframe_video').attr('src','https://www.youtube.com/embed/<?php echo $row_history['link_video']; ?>');
							/*$('.audio_recientes').attr('src','<?php echo str_replace("https://","https://a.",$row_history['link_audio']).".mp3"; ?>');*/
							$('.audio_recientes').attr('src','<?php echo $row_history['link_audio']; ?>');
						});

						$('.btnclickplayiframe<?php echo $index_history_songs; ?>').click(function() {
							$('iframe.iframe_video').attr('src','');
							$('.audio_recientes').attr('src','');
							if($("#player-instance").data().jPlayer.status.paused == true){
								$("#player-instance").jPlayer("setMedia", {
									mp3: "<?php echo $centova."/;stream.mp3"; ?>"
								}).jPlayer("play");
							}
						});
					});
				</script>
					<?php
				}
			  	?>
              </div>
			<?php
		}
		?>
		<div id="callmeback_start_reponse">
        	<input id="callmeback_start_input" name="callmeback_start" type="hidden" value="<?php echo $callmeback_start; ?>">
        </div>
		<?php
	}
?>
