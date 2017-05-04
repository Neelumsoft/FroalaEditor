<?php
set_time_limit(60*10);
function checkFolder($x){
	if(!is_dir($x)){
		if(mkdir($x,0755)){return true;}
		return false;
	}
	return true;
}

function getImages(){
	return $_POST;
}
function save1($x,$d){
	foreach($d as $k=>$v){
		$d[$k] = base64_decode($v);
	}
	try{
		if(!file_exists($x.$d['name'])){
			$image = file_get_contents($d['url']);
			file_put_contents($x.$d['name'], $image);
		}else{return 2;}
	}catch(Exception $e){
		return 3;
	}
	return 1;
}

if(isset($_GET['type']) && $_GET['type']=='ig'){
	$fb_upload_path = $_SERVER['DOCUMENT_ROOT'].$_GET['folder'].'Instagram-Images/';
}else{
	$fb_upload_path = $_SERVER['DOCUMENT_ROOT'].$_GET['folder'].'Facebook-Images/';
}
$response = array();

if(is_dir($_SERVER['DOCUMENT_ROOT'].$_GET['folder'])){
	
	if(checkFolder($fb_upload_path)){
		$images = getImages();
		if(is_array($images) && count($images)>0){
			$u=$a=$f=0;
			foreach($images as $img){
				$res = save1($fb_upload_path,$img);
				switch($res){
					case 1:
						$u++; break;
					case 2:
						$a++; break;
					case 3:
						$f++; break;
						break;
				}
			}
			$response = array('status'=>'sucess','total'=>count($images),'uploaded'=>$u,'failed'=>$f,'already'=>$a);
		}else{
			$response = array('status'=>'error','Invalid Facebook Graph API Response.');
		}
	}else{
		$response = array('status'=>'error','Problem in creating Facebook Images Folder.');
	}
	
}else{
	$response = array('status'=>'error','User Folder Not Found.');
}

echo json_encode($response);

?>