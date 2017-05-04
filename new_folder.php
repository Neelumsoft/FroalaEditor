<?php

// Include the editor SDK.
require 'froala_php_sdk/lib/FroalaEditor.php';

// Delete the image.
try {
	if(isset($_POST['renameFolder'])){
		$response = FroalaEditor_Image::renameFolder($_GET['path'],$_POST['oldName'],$_POST['newName']);
	}else{
		$response = FroalaEditor_Image::newFolder($_GET['path'],$_POST['name']);
	}
  echo stripslashes(json_encode($response));
}
catch (Exception $e) {
  http_response_code(404);
}

?>