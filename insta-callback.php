<?php
ob_start();
session_start();
if(isset($_GET['code'])){

$code = $_GET['code'];
$_SESSION['ig-code'] = $code;
setcookie('ig-code',base64_encode($code),3600);

}

if(isset($_SESSION['callback_u']) && !empty($_SESSION['callback_u'])){
	header('location: '.$_SESSION['callback_u']);
}else{
	header('location: http://'.$_SERVER['HTTP_HOST']);
}

?>