<?php
$folderPath = $_GET['folder'];

// Array of image objects to return.
$response = array();

$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;

// Image types.
$image_types = array('image/jpeg','image/gif','image/jpg','image/png');

// Filenames in the uploads folder.
$fnames = scandir($absoluteFolderPath);

/*echo json_encode($fnames);
die;*/

// Check if folder exists.
if ($fnames) {
	$images=array();
  // Go through all the filenames in the folder.
  foreach ($fnames as $name) {
	if($name=='.' || $name == '..'){continue;}
	
	  $file_type = mime_content_type($absoluteFolderPath . $name);
	  if (!is_dir($absoluteFolderPath.'/'.$name) && in_array($file_type, $image_types)) {
		// Build the image.
		$img = array();
		$img['type'] = 'image';
		$img['url'] = $folderPath . $name;
		$img['filesize'] = filesize($absoluteFolderPath.'/'.$name);
		$img['uploaded'] = filemtime($absoluteFolderPath.'/'.$name);
		$img['filetype'] = $file_type;
		$img['name'] = $name;

		// Add to the array of image.
		array_push($images, $img);
	  }

  }
  //foreach($folders as $a){array_push($response,$a);}
  $response = array('status'=>'success','data'=>$images);
}else{
  $response = array('status'=>'error','message'=>'error occured while fetching images.');
}

echo json_encode($response);
?>