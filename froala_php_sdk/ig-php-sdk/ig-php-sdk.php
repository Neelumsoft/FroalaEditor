<?php
class IG{
var $response=array(),$client_id = '9effa014149c47a49e08084382b60c33',$client_secret='c962038ebdbf40ba821a3f369e03e3b2',$access_token='',$auth_code='';
var $urls = array(
	'auth_url' => 'https://api.instagram.com/oauth/authorize/?client_id=9effa014149c47a49e08084382b60c33&response_type=code&redirect_uri=',
	'access_token_url' => 'https://api.instagram.com/oauth/access_token',
	'user_media' => 'https://api.instagram.com/v1/users/self/media/recent/?access_token='
);

function __construct(){
	$this->urls['auth_callback'] = 'http://'.$_SERVER['HTTP_HOST'].'/insta-callback.php';
	$this->urls['auth_url'] .= urlencode($this->urls['auth_callback']);
	if(isset($_SESSION['ig-code'])){
		$this->auth_code = $_SESSION['ig-code'];
	}
	
	if(isset($_SESSION['access_token'])){
		$this->access_token = $_SESSION['access_token'];
	}
}

function checkLogin(){
	if((isset($_SESSION['ig-code']) && !empty($_SESSION['ig-code'])) || (isset($_COOKIE['ig-code']) && !empty($_COOKIE['ig-code']))){
		if(!isset($_SESSION['ig-code'])){
			$_SESSION['ig-code'] = base64_decode($_COOKIE['ig-code']);
			$this->auth_code = $_SESSION['ig-code'];
		}
		//$this->response = array('status'=>'success','message'=>'user logged in');
		$this->getAccessToken();
	}else{
		$this->response = array('status'=>'error','code'=>100,'message'=>'user not logged in','link'=>$this->urls['auth_url']);
	}

}



function check_auth_code(){
	if(!isset($_SESSION['ig-code']) or empty($_SESSION['ig-code'])){
		$this->response = array('status'=>'error','code'=>101,'message'=>'user not logged in','link'=>$this->urls['auth_url']); return false;
	}
	return true;
}

function check_access_token(){
	if(!isset($_SESSION['access_token']) or empty($_SESSION['access_token'])){
		$this->response = array('status'=>'error','code'=>102,'message'=>'user not logged in','link'=>$this->urls['auth_url']); return false;
	}
	return true;
}

function getAccessToken(){
	if(!isset($_SESSION['ig-code'])){
		$this->checkLogin();
		return true;
	}
	if(isset($_SESSION['access_token'])){
		$this->response = array('status'=>'success','message'=>'access token generated');return true;
		$this->getUserMedia();
		return true;
	}
	//if(!$this->check_auth_code()){return false;}
	$post_data = array(
		'client_id' => $this->client_id,
		'client_secret' => $this->client_secret,
		'grant_type' => 'authorization_code',
		'redirect_uri' => $this->urls['auth_callback'],
		'code' => $this->auth_code,
	);
	$res = $this->curlPost($this->urls['access_token_url'],$post_data);
	$r = json_decode($res,true);
	if(isset($r['access_token'])){
		$_SESSION['access_token'] = $r['access_token'];
		$_SESSION['user_data'] = $r['user'];
		$this->response = array('status'=>'success','message'=>'access token generated');
		$this->getUserMedia();
	}else{
		$this->response = array('status'=>'error','code'=>103,'message'=>'error occured while generating access token');
	}
}

function getUserMedia(){
	if(!isset($_SESSION['access_token'])){
		$this->getAccessToken(); return false;
	}
	
	$res = $this->curlGet($this->urls['user_media'].$_SESSION['access_token']);
	//$res = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/insta-resp.txt');
	$r = json_decode($res,true);
	if(isset($r['data']) && count($r['data']) > 0){
		
		$rr = array();$rdata=$r['data'];
		for($i=0;$i<count($r['data']);$i++){
			if(!isset($rdata[$i]['type']) || $rdata[$i]['type'] != 'image'){continue;}
			//{type: "image",subType: "fb-image",url: r[i].images.standard_resolution.url,thumb: s[j].images[(s[j].images.length-1)].source,name: s[j].id}
			
			$rr[] = array('type'=>'image','subType'=>'fb-image','url'=>$rdata[$i]['images']['standard_resolution']['url'],'thumb'=>$rdata[$i]['images']['thumbnail']['url'],'name'=>$rdata[$i]['id'],'datetime'=>$rdata[$i]['created_time']);
			
		}
		
		$this->response = array('status'=>'success','message'=>'data returned','data' => $rr);
	}else{
		$this->response = array('status' => 'error','code' => 104,'message' => 'error occured while generating access token');
	}
}


function print_response(){
	echo json_encode($this->response);
}

function curlPost($url,$post_data=array()){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function curlGet($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

}
?>