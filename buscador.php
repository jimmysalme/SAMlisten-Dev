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
	$qr_pr = 'SELECT id_cancion, titulo, artista, link_audio, bg1_artista, nombre, nom_url, app_id_fb
				FROM
					(SELECT cn.id_cancion, cn.titulo, cn.artista, cn.link_audio, ar.bg1_artista, cnl.nombre, cnl.nom_url, cnl.app_id_fb
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

				SELECT id_cancion, titulo, artista, link_audio, bg1_artista, nombre, nom_url, app_id_fb
				FROM
					(SELECT cn.id_cancion, cn.titulo, cn.artista, cn.link_audio, ar.bg1_artista, cnl.nombre, cnl.nom_url, cnl.app_id_fb
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
                        <?php include 'form_buscador.php'; ?>
                      </div>
                      <?php /////////////Compartir/////////// ?>
                      <div id="compartir_rs" class="col-xs-12 col-md-2">
                        
                      </div>
                      <?php /////////////Votos/////////// ?>
                      <div id="div_votar" class="col-xs-12 col-md-4">
                        
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
                   data-mp3="">
                </li>
              </ul>
            </div>
            <div class="container player_wrapper">
              <div class="row">
                <div id="player-instance" class="jp-jplayer"></div>
                <div id="id_tmp01" class="jp-title audio-title"></div>
                <div class="rock_controls controls">
                  <div  class="fa fa-play jp-play btnclickplay"></div>
                  <div  class="fa fa-pause jp-pause btnclickpause"></div>
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
                <a id="scrolledbarRoja" href="#" class="playlist_expander fa fa-search"> <i class="fa fa-bars" aria-hidden="true"></i></a> </div>
                <script type="text/javascript">
					$(function(){
						$("#scrolledbarRoja").on("click" ,function(){
							if ($(window).scrollTop() == 0) {
								$(window).scrollTop(1);
							}
						});
					});
				</script>
            </div>
          </div>
        </div>
      </section>
      <?php /////////////Barra Menú/////////// ?>
      <?php
	  require_once('menu.php');
	  ?>
	  
      <?php /////////////Sección Nombre de la canción/////////// ?>
        <section id="section_12" class="about_section">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div id="nom_cancion_bs" class="section_head_widget animatedParent ">
                  
                </div>
              </div>
            </div>
          </div>
        </section>
    
        <?php /////////////Sección TOP 20/////////// ?>
        <section id="section_9" class="tours_section">
          <div class="container">
            <?php if (!empty($query)) { ?>
              <div class="row">
                <div class="col-xs-12">
                  <div class="section_head_widget">
                    <h2><?php echo $search; ?></h2>
                    <h5><?php echo $rows; ?> resultados de la búsqueda | <?php echo ($start+1).' - '.($start+count($query)); ?></h5>
                      <?php pagination($limit,$adjacent,$rows,$page); ?>
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
					  $top_id_cancion = $row_qr_top['id_cancion'];
                      $top_titulo = $row_qr_top['titulo'];
                      $top_artista = $row_qr_top['artista'];
                      $top_img = $row_qr_top['bg1_artista'];
                      //$top_link_audio 	= !empty($row_qr_top['link_audio']) ? str_replace("https://","https://a.",$row_qr_top['link_audio']).".mp3" : "";
					  $top_link_audio 	= !empty($row_qr_top['link_audio']) ? $row_qr_top['link_audio'] : "";
                      
                      $top_bg_artista = (file_exists("images/artistas/".$top_img)) ? $top_img : "bg1_background.jpg";
					  
					  $top_cnl_nombre = $row_qr_top['nombre'];
					  $top_cnl_url = $row_qr_top['nom_url'];
					  $top_cnl_app_id_fb = $row_qr_top['app_id_fb'];
                          ?>
                <div class="tour_row animatedParent  ">
                  <div class="animated fadeInDownShort">
                    <div class="column_one"> <span><?php echo $index_top; ?></span> </div>
                    <div class="column_two"> <img src="images/artistas/<?php echo $top_bg_artista; ?>" alt="<?php echo $top_artista; ?>" /> </div>
                    <div class="column_three"> <a class="cn_hover_list" href="<?php echo WEB_SITE."cn/".$top_id_cancion; ?>"><?php echo $top_titulo; ?></a> </div>
                    <div class="column_four"> <?php echo $top_artista; ?> </div>
                    <div class="column_five"> <a class="cn_hover_list" href="<?php echo WEB_SITE.$top_cnl_url; ?>"><?php echo $top_cnl_nombre; ?></a> </div>
                    <div class="column_six"> <a id="oir_<?php echo $index_top; ?>" class="btn btn_buy_ticket" <?php if (empty($top_link_audio)) { echo "href=\"".WEB_SITE."cn/".$top_id_cancion."\""; } ?>> <?php echo !empty($top_link_audio) ? "Escuchar" : "Entrar"; ?></a> </div>
                  </div>
                </div>
                <?php /////////////Modal Sección TOP 20/////////// ?>
                
                <?php if(!empty($top_link_audio)) { ?>
                <script type="text/javascript">
					$(function(){
						$('#oir_<?php echo $index_top; ?>').click(function() {
							if($("#player-instance").data().jPlayer.status.paused == false){
								$.jPlayer.pause();
							}
							$("#player-instance").jPlayer("setMedia", {
								mp3: "<?php echo $top_link_audio; ?>"
							}).jPlayer("play");
							
							$("#nom_cancion_bs").html("<h3 id=\"tit_letra\"><?php echo $top_titulo; ?></h3><h4 id=\"art_letra\"><?php echo $top_artista; ?></h4>");
							$("#div_votar").html("<form id=\"form_votos\"><input name=\"voto_cancion_id\" id=\"voto_cancion_id\" type=\"hidden\" value=\"<?php echo $top_id_cancion; ?>\"><input type=\"text\" id=\"form_val_v_1\" name=\"form_val_v_1\" /><input type=\"text\" id=\"form_val_v_2\" value=\"https://\" name=\"form_val_v_2\" /><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr align=\"center\"><td colspan=\"5\">Cuánto te gusta ésta canción?</td></tr><tr align=\"center\"><td><input name=\"voto_cancion\" type=\"radio\" value=\"1\"></td><td><input name=\"voto_cancion\" type=\"radio\" value=\"2\"></td><td><input name=\"voto_cancion\" type=\"radio\" value=\"3\"></td><td><input name=\"voto_cancion\" type=\"radio\" value=\"4\"></td><td><input name=\"voto_cancion\" type=\"radio\" value=\"5\"></td><td rowspan=\"2\"><input name=\"votar\" type=\"submit\" value=\"VOTA\" class=\"encuesta_submit btn btn_watch_video\"></td></tr><tr align=\"center\"><td class=\"encuesta_texto\">1</td><td class=\"encuesta_texto\">2</td><td class=\"encuesta_texto\">3</td><td class=\"encuesta_texto\">4</td><td class=\"encuesta_texto\">5</td></tr></table></form>");
							$("#compartir_rs").html('<table border="0" align="center" cellpadding="0" cellspacing="0"><tr align="left" valign="middle"><td align="center"><i class="fa fa-share-alt" aria-hidden="true" style="font-size:30px; color:#000; margin-right:5px;"></i></td><td align="left"><a href="https://www.facebook.com/dialog/feed?app_id=<?php echo $top_cnl_app_id_fb; ?>&link=<?php echo urlencode(WEB_SITE."cn/".$top_id_cancion); ?>&picture=<?php echo urlencode(WEB_SITE."images/artistas/".$top_bg_artista); ?>&name=<?php echo urlencode($top_titulo." - ".$top_artista);?>&to=&description=<?php echo urlencode($descripcion_canal." | Música online.");?>&redirect_uri=http://www.samlisten.com/close.php" target="_blank"><img src="images/facebook-like-4-64.png" width="48" height="48" alt="Compartir" /></a></td><td align="left"><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("SAMlisten.com/cn/".$top_id_cancion); ?>&text=<?php echo urlencode("Escucho \"".$top_titulo." - ".$top_artista."\" en SAMlisten.com/cn/".$top_id_cancion);?>&via=SAMlisten" target="_blank"><img src="images/twitter-4-64.png" width="48" height="48" alt="Compartir" /></a></td><td align="left"><a href="https://plus.google.com/share?url=<?php echo urlencode(WEB_SITE."cn/".$top_id_cancion); ?>&hl=es" target="_blank"><img src="images/google-plus-4-64.png" width="48" height="48" alt="Compartir" /></a></td></tr></table>');
						});
					});
				</script>
                <?php } 
                  }
                 pagination($limit,$adjacent,$rows,$page);
				 ?>
              </div>
            <?php
        }
        else { ?>
            <div class="row">
                <div class="col-xs-12">
                  <div class="section_head_widget">
                    <h2><?php echo $search; ?></h2>
                    <h5>No se encontraron resultados. Modifica tu búsqueda e inténtalo de nuevo.</h5>
                  </div>
                </div>
                <!--section_head_widget--> 
            </div>
            <?php /////////////Sección LOGIN/////////// ?>
              <section id="section_3" class="newsletter_section">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="team_prizes">
                        <div class="newsletter_form">
                          <form action="buscador.php" method="get">
                          	<input name="actionfunction" type="hidden" value="showData">
                            <input style="width:75%;" type="text" placeholder="Canción o artista" name="global_search">
                            <button style="width:24%;">Buscar</button>
                            <div class="clearfix"></div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            <?php
        }
        ?>
          </div>
          <!--container--> 
        </section>
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
    
    </body>
    </html>
    <?php
}

function pagination($limit,$adjacents,$rows,$page){
	$pagination = '';
	if ($page == 0)
		$page = 1;     //if no page var is given, default to 1.
	$prev = $page - 1;       //previous page is page - 1
	$next = $page + 1;       //next page is page + 1
	$prev_ = '';
	$first = '';
	$lastpage = ceil($rows / $limit);
	$next_ = '';
	$last = '';
	$vargets = $_SERVER['REQUEST_URI'];
	
	$pos = strpos($vargets, "&page");
	if ($pos !== false) {
		$vargets = substr($vargets, 0, $pos);
	}

	if ($lastpage > 1) {
	
		//previous button
		if ($page > 1)
			$prev_ .= "<a class='page-numbers' href=\"".$vargets."&page=$prev\">Anterior</a>";
		else {
			//$pagination.= "<span class=\"disabled\">previous</span>";	
		}
	
		//pages	
		if ($lastpage < 5 + ($adjacents * 2)) { //not enough pages to bother breaking it up
			$first = '';
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$pagination .= "<span class=\"current\">$counter</span>";
				else
					$pagination .= "<a class='page-numbers' href=\"".$vargets."&page=$counter\">$counter</a>";
			}
			$last = '';
		}
		elseif ($lastpage > 3 + ($adjacents * 2)) { //enough pages to hide some
			//close to beginning; only hide later pages
			$first = '';
			if ($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
						$pagination .= "<a class='page-numbers' href=\"".$vargets."&page=$counter\">$counter</a>";
				}
				$last .= "<a class='page-numbers' href=\"".$vargets."&page=$lastpage\">Final</a>";
			}
	
			//in middle; hide some front and some back
			elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				$first .= "<a class='page-numbers' href=\"".$vargets."&page=1\">Inicio</a>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
						$pagination .= "<a class='page-numbers' href=\"".$vargets."&page=$counter\">$counter</a>";
				}
				$last .= "<a class='page-numbers' href=\"".$vargets."&page=$lastpage\">Final</a>";
			}
			//close to end; only hide early pages
			else {
				$first .= "<a class='page-numbers' href=\"".$vargets."&page=1\">Inicio</a>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
						$pagination .= "<a class='page-numbers' href=\"".$vargets."&page=$counter\">$counter</a>";
				}
				$last = '';
			}
		}
		if ($page < $counter - 1)
			$next_ .= "<a class='page-numbers' href=\"".$vargets."&page=$next\">Siguiente</a>";
		else {
			//$pagination.= "<span class=\"disabled\">next</span>";
		}
		$pagination = "<div class=\"pagination\">" . $first . $prev_ . $pagination . $next_ . $last;
		//next button
	
		$pagination .= "</div>\n";
	} else {
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