<?php

// Include the editor SDK.
require 'froala_php_sdk/lib/FroalaEditor.php';

// Delete the image.

try {
	
	if(isset($_POST['deleteAll']) && isset($_POST['folder']) && $_POST['deleteAll'] == true  && strlen($_POST['folder']) > 0){
		FroalaEditor_Image::deleteAllFiles($_POST['folder']);
		$response = array('status'=>'success','message'=>'Files & Folders Deleted Successfully');
	}elseif(isset($_POST['deleteSelected']) && $_POST['deleteSelected'] == true && isset($_POST['data']) && count($_POST['data']) > 0){
		if(count($_POST['data'])>0){
			FroalaEditor_Image::deleteSelected();
			$response = array('status'=>'success','message'=>'Deleted successfully');
		}else{
			$response = array('status'=>'success','message'=>'No Data to Delete');
		}
	}elseif(isset($_POST['type']) && $_POST['type'] == 'folder'){
  		$response = FroalaEditor_Image::deleteDir($_POST['folder'].$_POST['name']);
	}else{
  		$response = FroalaEditor_Image::delete($_POST['src']);
	}
	echo stripslashes(json_encode('Success'));
}
catch (Exception $e) {
  http_response_code(404);
}

?>