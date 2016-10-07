<?php 
	if(!isset($_GET["tab"])):
		$controller = "specialty";
		include 'pages/specialty.php';
	endif;
	
	if(isset($_GET["tab"]) && $_GET["tab"]==2):
		$controller = "location";
		include 'pages/location.php';
	endif;
	
	if(isset($_GET["tab"]) && $_GET["tab"]==3):
		$controller = "clinic";
		include 'pages/clinic.php';
	endif;
	
	if(isset($_GET["tab"]) && $_GET["tab"]==4):
		$controller = "doctor";
		include 'pages/doctor.php';
	endif;

	include DIR_NETWORK_DOCTORS.'/pages/js_table.php';	
?>
