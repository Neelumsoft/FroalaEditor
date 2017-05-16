<?php

// Array of image objects to return.
$response = array();

function delete($link) {
    $filePath = $_SERVER['DOCUMENT_ROOT'].$link;
    // Check if file exists.
    if (file_exists($filePath)) {
      // Delete file.
      return unlink($filePath);
    }
    return true;
  }
function deleteDir($dirPath){
	if (!is_dir($dirPath)) {
		//throw new InvalidArgumentException("$dirPath must be a directory");
	}
	if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		$dirPath .= '/';
	}
	$files = glob($dirPath.'*', GLOB_MARK);
	
	foreach($files as $file){
		if(is_dir($file)){
			deleteDir($file);
		}else{
			unlink($file);
		}
	}
	rmdir($dirPath);
}


if(isset($_GET['type']) && $_GET['type']=='file' && isset($_GET['src'])){
	if(!empty($_GET['src'])){delete($_GET['src']);}
}if(isset($_GET['type']) && $_GET['type']=='folder' && isset($_GET['dir'])){
	if(!empty($_GET['dir'])){deleteDir();}
}elseif(isset($_GET['bulk_delete']) && isset($_POST['links'])){
	$files = json_decode($_POST['links']);
	foreach($files as $file){
		if(!empty($file)){
			delete($file);
		}
	}
  $response = array('status'=>'success','message'=>'images deleted successfully');
}else{
  $response = array('status'=>'error','message'=>'error occured while fetching images.');
}

echo json_encode($response);
?>