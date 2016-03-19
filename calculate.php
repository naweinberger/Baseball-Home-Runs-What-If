<?php

$v = $_GET['velocity'];
$angle = $_GET['elevation'];
$g = $_GET['gravity'];
$P = $_GET['pressure']; // in atm
$T = $_GET['temperature'];
$P = $P * 101300; // to pascals
$T = ($T - 32.0)*5.0/9.0 + 273.15;
$m = 0.145;
$A = 3.14 * pow(0.0366*2, 2)/4;
$C = .178;
$R = 287.058;
$rho = $P/($R*$T);
$D = $rho*$C*$A/2.0;
$g = 9.81;

$planet = $_GET['planet'];

// if ($planet == 'mars') {
// 	$g = 3.73;
// 	$R = 181.0;
// 	$T = 218.0;
// }
$v = $v*0.44704; // to m/s

$theta = $angle/180.0*3.14;

$vx = $v*cos($theta);
$vy = $v*sin($theta);

$delta_t = 0.01;

$x = array();
$y = array();
$t = array();

array_push($x, 0);
array_push($y, 1); // assume hit 1 meter off ground
array_push($t, 0);

$i = 0;

while (min($y) > -0.001) {
	$ax = -($D/$m)*$v*$vx;
	$ay = -$g-($D/$m)*$v*$vy;
	$vx = $vx+$ax*$delta_t;
	$vy = $vy+$ay*$delta_t;

	array_push($x, $x[$i] + $vx*$delta_t + 0.5*$ax*pow($delta_t, 2));
	array_push($y, $y[$i] + $vy*$delta_t + 0.5*$ay*pow($delta_t, 2));
	array_push($t, $t[$i] + $delta_t);

	$i++;
}

echo "<!doctype html>
<html class='no-js' lang=''>
  <head>
	<meta charset='utf-8'>
	<meta http-equiv='x-ua-compatible' content='ie=edge'>
	<title>Motion</title>
	<meta name='description' content=''>
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<!-- Custom Fonts -->
	<link href='font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>


	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

	<!-- Optional theme -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' integrity='sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r' crossorigin='anonymous'>

	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.js'></script>

	<!-- Bootstrap -->
	<link href='css/bootstrap.min.css' rel='stylesheet'>


	<!-- Custom CSS -->
	<link rel='stylesheet' href='css/normalize.css'>
	<link rel='stylesheet' href='css/main.css'>
</head>
<body>
	<!--[if lt IE 8]>
		<p class='browserupgrade'>You are using an <strong>outdated</strong> browser. Please <a href='http://browsehappy.com/'>upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<!-- Add your site or application content here -->

	<!-- =============== navbar ================= -->

	<!--top right button, toggles overlay menu -->
	<div class='button_container' id='toggle'>
		<span class='top'></span>
		<span class='middle'></span>
		<span class='bottom'></span>
	</div>

	<!-- =============== content ================= -->
	<div class='titletext'>The ball would have travelled..</div>
	<div class='inputarea text-center'>



        	<div class='answer'>";

        	echo round(end($x)*3.28) . " feet!";
        	echo "
        	<div class='text-center'><p><a class='btn btn-primary btn-lg' href='changecond.html' role='button'>Another one</a></p></div>	
        	</div>
	
	</div>



	<!-- =============== glorious js ================= -->
	<script src='js/vendor/modernizr-2.8.3.min.js'></script>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
	<script>window.jQuery || document.write('<script src='js/vendor/jquery-1.11.3.min.js'><\/script>')</script>
	<script src='js/plugins.js'></script>
	<script src='js/main.js'></script>

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='https://www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-XXXXX-X','auto');ga('send','pageview');
	</script>
  </body>
</html>
";
 
?>