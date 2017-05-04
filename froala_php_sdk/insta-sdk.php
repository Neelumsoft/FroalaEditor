<?php
session_start();
if(isset($_GET['u']) && !empty($_GET['u'])){
	$_SESSION['callback_u'] = $_GET['u'];
}

require('ig-php-sdk/ig-php-sdk.php');
$ig = new IG();

if(isset($_GET['clogin'])){
	$ig->checkLogin();
}

if(isset($_GET['access_token'])){
	$ig->getAccessToken();
}

if(isset($_GET['user_media'])){
	$ig->getUserMedia();
}

echo $ig->print_response();
?>