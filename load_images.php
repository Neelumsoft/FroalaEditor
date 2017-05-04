<?php
session_start();


// Include the editor SDK.
require 'froala_php_sdk/lib/FroalaEditor.php';

// Load the images.
try {
  $response = FroalaEditor_Image::getList($_GET['folder']);
  echo stripslashes(json_encode($response));
}
catch (Exception $e) {
  http_response_code(404);
}

?>