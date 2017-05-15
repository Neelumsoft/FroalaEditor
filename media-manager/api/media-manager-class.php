<?php

class MediaManager{


public static function getImages($folderPath) {
	// Array of image objects to return.
	$response = array();
	
	$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;
	
	// Image types.
	$image_types = Image::$defaultUploadOptions['validation']['allowedMimeTypes'];
	
	// Filenames in the uploads folder.
	$fnames = scandir($absoluteFolderPath);
	
	/*echo json_encode($fnames);
	die;*/
	
	// Check if folder exists.
	if ($fnames) {
		$folder_icon = 'froala_editor1/img/folder-icon-2.png';
		$folders=array();$images=array();
	  // Go through all the filenames in the folder.
	  foreach ($fnames as $name) {
		if($name=='.' || $name == '..'){continue;}
		// Filename must not be a folder.
		if (is_dir($absoluteFolderPath.'/'.$name)) {
			// if is directory
			array_push($folders, array(
				'type' => 'folder',
				'url' => $folderPath.$name,
				'thumb' => $folder_icon,
				'name' => $name,
				'datetime'=>filemtime($absoluteFolderPath.'/'.$name)
			));
			
		}else{
		  // Check if file is an image.
		  
		  if (in_array(mime_content_type($absoluteFolderPath . $name), $image_types)) {
			// Build the image.
			$img = new \StdClass;
			$img->type = 'image';
			$img->url = $folderPath . $name;
			$img->thumb = $thumbPath . $name;
			$img->name = $name;
			$img->datetime = filemtime($absoluteFolderPath.'/'.$name);
	
			// Add to the array of image.
			array_push($images, $img);
		  }
		}
	  }
	  foreach($folders as $a){array_push($response,$a);}
	  foreach($images as $a){array_push($response,$a);}
	}
	
	// Folder does not exist, respond with a JSON to throw error.
	else {
	  throw new Exception('Images folder does not exist!');
	}
	
	return $response;
}

public static function getFolders($folderPath) {
	//$folderPath = str_replace('//','/',$folderPath);
	
	// Array of image objects to return.
	$response = array();
	
	$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;
	
	// Image types.
	$image_types = Image::$defaultUploadOptions['validation']['allowedMimeTypes'];
	
	// Filenames in the uploads folder.
	$fnames = scandir($absoluteFolderPath);
	
	/*echo json_encode($fnames);
	die;*/
	
	// Check if folder exists.
	if ($fnames) {
		$folder_icon = 'froala_editor1/img/folder-icon-2.png';
		$folders=array();$images=array();
	  // Go through all the filenames in the folder.
	  foreach ($fnames as $name) {
		if($name=='.' || $name == '..'){continue;}
		// Filename must not be a folder.
		if (is_dir($absoluteFolderPath.'/'.$name)) {
			// if is directory
			array_push($folders, array(
				'type' => 'folder',
				'url' => $folderPath.$name,
				'thumb' => $folder_icon,
				'name' => $name,
				'datetime'=>filemtime($absoluteFolderPath.'/'.$name)
			));
			
		}else{
		  // Check if file is an image.
		  
		  if (in_array(mime_content_type($absoluteFolderPath . $name), $image_types)) {
			// Build the image.
			$img = new \StdClass;
			$img->type = 'image';
			$img->url = $folderPath . $name;
			$img->thumb = $thumbPath . $name;
			$img->name = $name;
			$img->datetime = filemtime($absoluteFolderPath.'/'.$name);
	
			// Add to the array of image.
			array_push($images, $img);
		  }
		}
	  }
	  foreach($folders as $a){array_push($response,$a);}
	  foreach($images as $a){array_push($response,$a);}
	}
	
	// Folder does not exist, respond with a JSON to throw error.
	else {
	  throw new Exception('Images folder does not exist!');
	}
	
	return $response;
}


}

?>