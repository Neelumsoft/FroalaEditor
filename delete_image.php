<?php

// Include the editor SDK.
require 'froala_php_sdk/lib/FroalaEditor.php';

// Delete the image.

try {
	if(isset($_POST['deleteSelected']) && $_POST['deleteSelected'] == true && isset($_POST['data']) && count($_POST['data'])){
		if(count($_POST['data'])>0){
			FroalaEditor_Image::deleteSelected();
			$response = array('status'=>'success','message'=>'Deleted successfully');
		}else{
			$response = array('status'=>'success','message'=>'No Data to Delete');
		}
	}elseif(isset($_POST['type']) && $_POST['type'] == 'folder'){
  		$response = FroalaEditor_Image::deleteDir($_GET['folder'].$_POST['name']);
	}else{
  		$response = FroalaEditor_Image::delete($_POST['src']);
	}
	echo stripslashes(json_encode('Success'));
}
catch (Exception $e) {
  http_response_code(404);
}

?>