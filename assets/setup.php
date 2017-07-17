<?php 
	$SiteUrl = 'http://localhost:8012/beepy_online2/';
	$lang;

	if (isset($_GET['lang'])&&!empty($_GET['lang'])) {
		if ($_GET['lang']=='en'||$_GET['lang']=='lv'||$_GET['lang']=='ru') {
			$_SESSION['lang'] = $_GET['lang'];
		}
	}
	
	if (isset($_SESSION['lang'])) {
		$lang = $_SESSION['lang'];
	}else{
		$lang = 'en';
	}



 ?>