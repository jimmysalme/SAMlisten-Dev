<?php
//require_once($_SERVER['DOCUMENT_ROOT'].'/include_class_db/config.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'include_class_db'.DIRECTORY_SEPARATOR.'config.php');
$header_title = isset($header_title) ? $header_title : "Música online";
$descripcion_canal = isset($descripcion_canal) ? $descripcion_canal : "Música online";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<base href="<?php echo WEB_SITE; ?>">
<title>SAMlisten.com | <?php echo $header_title; ?></title>


<meta name="description" content="<?php echo $descripcion_canal; ?>">
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />

<meta name="msapplication-square70x70logo" content="assets/img/icon_smalltile.png">
<meta name="msapplication-square150x150logo" content="assets/img/icon_mediumtile.png">
<meta name="msapplication-wide310x150logo" content="assets/img/icon_widetile.png">

<meta name="theme-color" content="#202020">
<meta name="apple-mobile-web-app-status-bar-style" content="black">


<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
<link rel="icon" sizes="192x192" href="assets/img/icon.png">
<link rel="apple-touch-icon" href="assets/img/touch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/touch-icon-ipad-retina.png">
<link rel="apple-touch-startup-image" href="assets/img/icon.png">

<!--Google Fonts-->
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
<!--Plugins CSS Files-->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

<?php if ($index=='canal' || $index=='cn') { ?>
  <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.transitions.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.vegas.css">
  <link rel="stylesheet" type="text/css" href="assets/css/animations.css">
  <!--<link rel="stylesheet" type="text/css" href="assets/css/bigvideo.css"> -->
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<?php } ?>
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/samlisten.css">

<!-- <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script> -->
<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/js/samlisten.js"></script>
</head>
