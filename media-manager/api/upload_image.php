<?php
$folderPath = $_GET['folder'];

// Array of image objects to return.
$response = array();
$image_types = array('image/jpeg','image/gif','image/jpg','image/png');

$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;

if(isset($_GET['upload_file']) && isset($_FILES['file'])){
	$nArr = explode('.',$_FILES['file']['name']);
	$extension = array_shift($nArr);
	
	$file_name = implode('.',$nArr);
	$file_name .= md5(time()+12);
	$file_tmp = $_FILES['file']['tmp_name'];
	$file_type = $_FILES['file']['type'];
	if(in_array($file_type,$image_types)){
		if(file_exists($absoluteFolderPath.$file_name)){
			$file_name .= '-'.time();
		}
		if(move_uploaded_file($file_tmp,$absoluteFolderPath.$file_name)){
			$img = array();
			$img['type'] = 'image';
			$img['url'] = $folderPath.$file_name;
			$img['filesize'] = filesize($absoluteFolderPath.'/'.$file_name);
			$img['uploaded'] = filemtime($absoluteFolderPath.'/'.$file_name);
			$img['filetype'] = $file_type;
			$img['name'] = $name;
			$response = array('status'=>'success','data'=> $img);
		}else{
			$response = array('status'=>'error','message'=>'Problem in uploading image.');
		}
	}else{
		$response = array('status'=>'error','message'=>'Invalid Image type.');
	}
}else{
  $response = array('status'=>'error','message'=>'error occured while fetching images.');
}

echo json_encode($response);
?>