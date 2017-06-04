<?php
session_start();
if(isset($_GET['usd']) && !empty($_GET['usd'])){
	$_SESSION['callback_u'] = $_GET['usd'];
}

require('ig-php-sdk/ig-php-sdk.php');
$ig = new IG();

if(isset($_POST['clogin'])){
	$ig->checkLogin();
}

if(isset($_POST['access_token'])){
	$ig->getAccessToken();
}

if(isset($_POST['user_media'])){
	$ig->getUserMedia();
}

echo $ig->print_response();
?>