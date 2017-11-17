<?php
include 'header.php';
?>
<body class="body_home">
	<div id="body-wrap">
		<?php
		//Preloader
		include 'include/php_files/jsplash.php';
		?>
		<section class="demo_banner text-center">
			<div class="container">
				<img src="assets/img/basic/logo_home.png" alt="Logo SAMlisten.com"/>
		    <p>Hemos creado una radio diferentepos2689Sofía, una radio donde solamente escucharás música.</p>
		  </div>
		</section>
		<div class=" container">
		    <ul class="demos_links">
		        <li><a href="?canal=romantica"><img src="assets/img/selection/romantica.png" alt="Imagen versión romántica (Rocío Dúrcal)"><br> Version <span>Romántica</span></a></li>
		        <li><a href="?canal=retro"><img src="assets/img/selection/retro.png" alt="Imagen versión retro (Freddie Mercury)"><br> Version <span>Retro</span></a></li>
		    </ul>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
	<!--===================================================================
	Scripts
	====================================================================-->
	<!-- <script src="assets/js/jquery-1.11.0.min.js"></script> -->
	<script src="assets/js/jpreloader.min.js"></script>
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
</body>
</html>
