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

if(isset($_POST['type']) && $_POST['type']=='file' && isset($_POST['src'])){
	if(!empty($_POST['src'])){
		if(delete($_POST['src'])){
			$response = array('status'=>'success','message'=>'image deleted successfully');
		}else{
			$response = array('status'=>'error','message'=>'Problem in deleting file');
		}
	}else{
		$response = array('status'=>'error','message'=>'Source Invalid');
	}
	
}elseif(isset($_POST['type']) && $_POST['type']=='folder' && isset($_POST['dir'])){
	if(!empty($_POST['dir'])){deleteDir($_SERVER['DOCUMENT_ROOT'].$_POST['dir']);}
	$response = array('status'=>'success','message'=>'Folder deleted successfully');
}elseif(isset($_POST['bulk_delete']) && isset($_POST['links'])){
	$files = json_decode($_POST['links']);
	foreach($files as $file){
		if(!empty($file)){
			delete($file);
		}
	}
  $response = array('status'=>'success','message'=>'images deleted successfully');
}else{
  $response = array('status'=>'error','message'=>'error occured while deleting images.');
}

echo json_encode($response);
?>