<?php
if((isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!='')) {
	//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
	require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
	
	$actionfunction = $_REQUEST['actionfunction'];
	$limit = 20;
	$adjacent = 3;

    call_user_func($actionfunction,$_GET,$limit,$adjacent);
}

function showData($data,$limit,$adjacent){
	$search = isset($_REQUEST['global_search']) ? $_REQUEST['global_search'] : "";
	if ($search == "") {
		header("Location: https://www.samlisten.com");
		die();
	}
	
	if ($_REQUEST['order']=="artista") {
		$orderget = "cn.artista";
		$orderhreftit = '<a href="buscador.php?actionfunction=showData&global_search='.urlencode($search).'&order=titulo">Título</a>';
		$orderhrefart = 'Artista <i class="fa fa-arrow-up" aria-hidden="true" style="font-size:10px;"></i>';
	}
	else {
		$orderget = "cn.titulo";
		$orderhreftit = 'Título <i class="fa fa-arrow-up" aria-hidden="true" style="font-size:10px;"></i>';
		$orderhrefart = '<a href="buscador.php?actionfunction=showData&global_search='.urlencode($search).'&order=artista">Artista</a>';
	}

	$explode_search = explode(" ", $search);
	$search2t = $search2a = "";
	foreach( $explode_search as $key => $value) {
		$explode_search[$key] = trim($value);
		if (strlen($explode_search[$key]) > 3) {
			$search2t .= ' OR cn.titulo LIKE "%'.$explode_search[$key].'%"
						 ';
			$search2a .= ' OR cn.artista LIKE "%'.$explode_search[$key].'%"
					 ';
		}
	}
	$search1 = "+".implode(" +", $explode_search);
	
	
	
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

	if($page==1){
		$start = 0;  
	}
	else{
		$start = ($page-1)*$limit;
	}
	
	//QUERY GENERAL PARA LA LISTA DE TITULOS********************
	$qr_pr = 'SELECT id_cancion, titulo, artista, bg1_artista, nombre
				FROM
					(SELECT cn.id_cancion, cn.titulo, cn.artista, ar.bg1_artista, cnl.nombre
						FROM psn_canciones cn
						INNER JOIN psn_artistas ar ON cn.artista = ar.artista
						INNER JOIN psn_canales cnl ON cn.canal = cnl.id
						WHERE MATCH ( cn.titulo, cn.artista )
						AGAINST ("'.$search1.'" IN BOOLEAN MODE)
						ORDER BY '.$orderget.'
					)
				AS a';
	
	$query_count_pr = DB::count();
	
	$qr_all = $qr_pr. ' 
				
				UNION

				SELECT id_cancion, titulo, artista, bg1_artista, nombre
				FROM
					(SELECT cn.id_cancion, cn.titulo, cn.artista, ar.bg1_artista, cnl.nombre
						FROM psn_canciones cn
						INNER JOIN psn_artistas ar ON cn.artista = ar.artista
						INNER JOIN psn_canales cnl ON cn.canal = cnl.id
						WHERE FALSE 
						 '.$search2t.'
						 '.$search2a.'
						ORDER BY '.$orderget.'
					)
				AS b';
	
	$query_count = DB::query($qr_all);
	
	
	$rows = DB::count();
	
	/*echo "<pre>";
	echo $qr_all." LIMIT ".$start.", ".$limit;
	echo "</pre>";*/
	
	$query = DB::query($qr_all." LIMIT ".$start.", ".$limit);
	
	//***************************************************************	
	
	if (!empty($query)) {

include 'header.php';
//header('Content-Type: text/html; charset=utf-8');
?>
<body data-spy="scroll" data-target="#sticktop" data-offset="70">
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
  <input id="callmeback_start_input" name="callmeback_start" type="hidden" value="<?php echo $callmeback_start; ?>">
</div>
<div id="dt_canal">
  <input id="app_id_fb_canal" name="app_id_fb_canal" type="hidden" value="<?php echo $app_id_fb_canal; ?>">
  <input id="descripcion_canal" name="descripcion_canal" type="hidden" value="<?php echo $descripcion_canal; ?>">
</div>

<?php
//Preloader
include 'include/php_files/jsplash.php';
?>
<div class="wide_layout box-wide"> 
  
  <?php /////////////Sección Imagen principal/////////// ?>
<section id="section_1" style="padding-top:0; padding-bottom:0;">
       <?php /////////////Sección Barra de audio/////////// ?>
      <?php //Do not edit this section Unless you have to modify HTML structure of Playlist// ?>
      <div class="rock_player pre_sticky" style="position:initial;">
        <div class="sticky_player" data-sticky="true">
          <?php /////////////Barra roja/////////// ?>
          <div class="play_list">
            <div class="list_scroll">
              <div class="container ">
                <ul id="rouge_menu" class="music_widget player_data">
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
               data-mp3="<?php echo $centova."/;stream.mp3"; ?>">
              </li>
            </ul>
          </div>
          <div class="container player_wrapper">
            <div class="row">
              <div id="player-instance" class="jp-jplayer"></div>
              <div id="id_tmp01" class="jp-title audio-title"><?php echo $titulo." - ".$artista;?></div>
              <div class="rock_controls controls"> 
                <div  class="fa fa-play jp-play btnclickplay"></div>
                <div  class="fa fa-stop jp-pause btnclickpause"></div>
              </div>
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
        </div>
      </div>
    </section>  
  <?php /////////////Barra Menú/////////// ?>
  <header>
    <nav id="sticktop" class="navbar navbar-default" data-sticky="true">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          	<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
          </button>
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
              <h2><?php echo $search; ?></h2>
              <h5><?php echo $rows; ?> resultados de la búsqueda | <?php echo ($start+1).' - '.($start+count($query)); ?></h5>
              <p style="text-align:center; background-color:#D41010; color:#FFF; margin-top:15px;">35 <?php pagination($limit,$adjacent,$rows,$page); ?> 36</p>
            </div>
          </div>
          <!--section_head_widget--> 
        </div>
        <!--row-->
        
        <div class="tours_widget">
          <div class="tour_row_header">
            <div class="column_one"> &nbsp;</div>
            <div class="column_two"> &nbsp;<!--no header for picture column--> 
            </div>
            <div class="column_three"> <?php echo $orderhreftit; ?> </div>
            <div class="column_four"> <?php echo $orderhrefart; ?> </div>
            <div class="column_five"> Canal </div>
            <div class="column_six"> &nbsp; </div>
          </div>
          <?php
			  $index_top = 0;
			  foreach ($query as $row_qr_top) {
				  $index_top ++;
				  $top_titulo = $row_qr_top['titulo'];
				  $top_artista = $row_qr_top['artista'];
				  $top_img = $row_qr_top['bg1_artista'];
				  //$top_votos = substr($row_qr_top['votos'],0,3);
				  $top_votos = $row_qr_top['votos'];
				  $top_link_video = $row_qr_top['link_video'];
				  $top_link_audio = $row_qr_top['link_audio'];
				  $top_letra = $row_qr_top['letra'];
				  
				  $top_bg_artista = (file_exists("images/artistas/".$top_img)) ? $top_img : "bg1_background.jpg";
					  ?>
					  <div class="tour_row animatedParent  ">
						<div class="animated fadeInDownShort">
						  <div class="column_one"> <span><?php echo $index_top; ?></span> </div>
						  <div class="column_two"> <img src="images/artistas/<?php echo $top_bg_artista; ?>" alt="<?php echo $top_artista; ?>" /> </div>
						  <div class="column_three"> <?php echo $top_titulo; ?> </div>
						  <div class="column_four"> <?php echo $top_artista; ?> </div>
						  <div class="column_five"> Romántica </div>

						  <div class="column_six"> <a class="btn btn_buy_ticket <?php if(!empty($top_link_video) || !empty($top_link_audio)) { echo "btnclickpause btnclickpauseiframetop".$index_top;} ?>" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#top_20_<?php echo $index_top; ?>">Escuchar</a> </div>
						</div>
					  </div>
					  
					  <?php /////////////Modal Sección TOP 20/////////// ?>
					  <div class="modal fade" id="top_20_<?php echo $index_top; ?>" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
						  <div class="modal-content" style="color:#000;">
							<button type="button" class="close destroy_owl destroy_owl_video btnclickplay <?php if(!empty($top_link_video) || !empty($top_link_audio)) { echo "btnclickplayiframetop".$index_top;} ?>" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
							<div class="modal-body">
							  <div class="gallery_popup container">
								<h2><?php echo $top_titulo; ?></h2>
								<h6><?php echo $top_artista; ?></h6>
								<div class="galery_widget">
								  <?php if (!empty($top_link_video)) { ?>
								  <div class="div_video_container">
									<div class="div_video">
									  <iframe id="iframe_video" class="iframe_video" width="560" height="315" frameborder="0" allowfullscreen></iframe>
									</div>
								  </div>
								  <?php } ?>
								  <?php if (!empty($top_link_audio)) { ?>
								  <div <?php if (!empty($top_link_video)) { echo ' style="text-align:center; margin-top:40px;"'; }?>>
									<audio controls class="audio_recientes">
									  <source type="audio/mpeg">
									  Para poder disfrutar del audio, debes actualizar tu navegador a una versión más reciente. </audio>
								  </div>
								  <?php } ?>
								  <div class="clearfix"></div>
								  <div class="text_widget">
									<p><?php echo $top_letra; ?></p>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
						<?php if(!empty($top_link_video) || !empty($top_link_audio)) { ?>
						<script type="text/javascript">
							$(function(){
								$('.btnclickpauseiframetop<?php echo $index_top; ?>').click(function() {
									$('iframe.iframe_video').attr('src','https://www.youtube.com/embed/<?php echo $top_link_video; ?>');
									/*$('.audio_recientes').attr('src','<?php echo str_replace("https://","https://a.",$top_link_audio).".mp3"; ?>');*/
									$('.audio_recientes').attr('src','<?php echo $top_link_audio; ?>');
								});
								
								$('.btnclickplayiframetop<?php echo $index_top; ?>').click(function() {
									$('iframe.iframe_video').attr('src','');
									$('.audio_recientes').attr('src','');
								});
							});
						</script>
						<?php } ?>
			  <?php
				  
			  }
			 ?>
             <p style="text-align:center; background-color:#D41010; color:#FFF; margin-top:15px;">35 <?php pagination($limit,$adjacent,$rows,$page); ?> 36</p>
        </div>
      </div>
      <!--container--> 
    </section>

    <?php /////////////Sección FOOTER/////////// ?>
    <footer id="section_13" class="parallax parallax_five footer" data-stellar-background-ratio="0.5">
      <div class="parallax_inner">
        <div class="container"> 
          <div class="contact_Us">
            <div class="tabs-wrap tabs-wrap-active clearfix">
              <ul class="tabs">
                <li class="tab-link tab-link1 active" data-tab="tab1"> <span>Comentarios</span> </li>
                <li class="tab-link tab-link2" data-tab="tab2"> <span>Contáctanos</span> </li>
              </ul>
            </div>
            
            <div id="tab1" class="tab-content active"> 
              <div class="fb-comments" data-href="https://www.samlisten.com/romantica/index1.php?canal=romantica" data-width="100%" data-numposts="5"></div>
            </div>
            <div id="tab2" class="tab-content animatedParent">
              <div class="contactFormWrapper ">
                <form id="contactform" action="assets/php/submit.php" method="post">
                  <div id="form_val" class="row">
                    <div class="col-xs-12 col-md-6">
                      <input type="text" id="form_val_1" name="form_val_1" />
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <input type="text" id="form_val_2" value="https://" name="form_val_2" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-md-4">
                      <input type="text" id="name" placeholder="Nombre"/>
                    </div>
                    <div class="col-xs-12 col-md-4">
                      <input type="text" name="email" id="email" placeholder="Email" />
                    </div>
                    <div class="col-xs-12 col-md-4">
                      <input type="text" name="subject" id="subject" placeholder="Asunto" />
                    </div>
                    <div class="col-xs-12 col-md-8">
                      <textarea placeholder="Mensaje" name="message" id="message"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-4">
                      <button class="btn btn-default" id="submit1" type="submit"> Enviar mensaje </button>
                    </div>
                  </div>
                </form>
                <div id="valid-issue" style="display:none;"> Todos los campos son requeridos.</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="copyrights">&copy; <?php echo date("Y");?> SAMLISTEN.COM &nbsp;|&nbsp; Powered by <a href="https://www.jimsa.ca/" target="_blank">JIMSA.CA</a></div>
            </div>
          </div>
        </div>
      </div>
    </footer>
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

<script src="assets/js/currentsong.js"></script>
 
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
		<?php
	}
	else { ?>
    <p></p>
		<div id="label_total"><?php echo' Aucun résultat pour la recherche "'.$search.'". <br> Veuillez essayer avec d\'autres mots clés.'; ?></div>
        <?php
	}
	
}

function pagination($limit,$adjacents,$rows,$page){	
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	if($lastpage > 1)
	{	
		
		//previous button
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">Précédent</a>";
		else{
			//$pagination.= "<span class=\"disabled\">previous</span>";	
			}
		
		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Dernier</a>";			
			}
			
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
			   $first.= "<a class='page-numbers' href=\"?page=1\">Premier</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Dernier</a>";			
			}
			//close to end; only hide early pages
			else
			{
				$first.= "<a class='page-numbers' href=\"?page=1\">Premier</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
			
			}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">Suivant</a>";
		else{
			//$pagination.= "<span class=\"disabled\">next</span>";
			}
		$pagination = "<div class=\"pagination\" style=\"text-align:center; clear:both; float:none;\">".$first.$prev_.$pagination.$next_.$last;
		//next button
		
		$pagination.= "</div>\n";
	}
	else {
		$pagination = '<div class="pager_fake"></div>';
	}

	echo $pagination;  
}
?>

<?php
	$vars_gard = isset($_SERVER['QUERY_STRING']) ? '&'.$_SERVER['QUERY_STRING'] : '';
?>

<script type="text/javascript">
$(function(){
	$('#container_etablissements').on('click','.page-numbers',function(){
		$page = $(this).attr('href');
		$pageind = $page.indexOf('page=');
		$page = $page.substring(($pageind+5));
		
		var url = $.url(); // parse the current page URL
		pageurl = "<?php echo WEB_SITE; ?>index.php/resultats-de-la-recherche?" + url.attr('query');
		//alert ('pageurl: ' + pageurl);
		
		
		if(typeof(url.param('page')) != "undefined" && url.param('page') !== null) {
			pageurl = pageurl.replace("&page=" + url.param('page'), "");
			pageurl = pageurl + "&page=" + $page;
		}
		
		else {
			pageurl = "<?php echo WEB_SITE; ?>index.php/resultats-de-la-recherche?" + url.attr('query') + "&page=" + $page;
		}
		
		if(pageurl!=window.location){
			window.history.pushState({path:pageurl},'',pageurl);	
		}
		
		var newurl = $.url(); // parse the current page URL
		var newvars = newurl.attr('query');
		//alert ("query: " + newvars);
		
		
		$.ajax({
			url:"<?php echo WEB_SITE; ?>script_pavillon/resultats_de_la_recherche.php?actionfunction=showData<?php echo $vars_gard; ?>&page="+$page,
			type:"POST",
			//data:"actionfunction=showData&page="+$page+"<?php echo $vars_gard; ?>",
			cache: false,
			success: function(response){
				$('#container_etablissements').html(response);
			}
		});
		return false;
	});
});
</script>