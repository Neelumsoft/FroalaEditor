<?php
$folderPath = $_POST['folder'];
// Array of image objects to return.
$response = array();

$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;

function getFolders($path){
	$fnames = scandir($path);
	$n=array();
	foreach($fnames as $file){
		if($file != '.' && $file != '..' && is_dir($path.'/'.$file)){
			$n[$file] = getFolders($path.'/'.$file);
		}
	}
	return $n;
}
$folders = getFolders($absoluteFolderPath);

// Check if folder exists.
if (count($folders)>0) {
  $response = array('status'=>'success','data'=>$folders);
}else{
  $response = array('status'=>'error','message'=>'error occured while fetching folders.');
}

echo json_encode($response);
?>