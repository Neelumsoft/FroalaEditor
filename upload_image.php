<?php

// Include the editor SDK.
require 'froala_php_sdk/lib/FroalaEditor.php';


$options = array(
  'validation' => array(
      'allowedExts' => array('gif', 'jpeg', 'jpg', 'png', 'svg', 'blob'),
      'allowedMimeTypes' => array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png', 'image/svg+xml')
  )
);


// Store the image.
try {
  $response = FroalaEditor_Image::upload($_GET['folder'], $options);
  echo stripslashes(json_encode($response));
}
catch (Exception $e) {
  http_response_code(404);
}

?>