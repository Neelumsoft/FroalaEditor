<?php
$folderPath = $_GET['folder'];


$ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'] . $folderPath), RecursiveIteratorIterator::CHILD_FIRST);
$r = array();
foreach ($ritit as $splFileInfo) {
   $path = $splFileInfo->isDir()
         ? array($splFileInfo->getFilename() => array())
         : array($splFileInfo->getFilename());

   for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) {
       $path = array($ritit->getSubIterator($depth)->current()->getFilename() => $path);
   }
   $r = array_merge_recursive($r, $path);
}

echo json_encode($r);

die;
// Array of image objects to return.
$response = array();

$absoluteFolderPath = $_SERVER['DOCUMENT_ROOT'] . $folderPath;

// Filenames in the uploads folder.
$fnames = scandir($absoluteFolderPath);

/*echo json_encode($fnames);
die;*/
$GLOBALS['folders_tree'] = array();
function getFolders($index){
	
	if($name=='.' || $name == '..'){continue;}
	if (is_dir($absoluteFolderPath.$name)) {
		
	}
	
	$img = array();
	$img['type'] = 'folder';
	$img['url'] = $folderPath . $name;
	$img['name'] = $name;
	$img['datetime'] = filemtime($absoluteFolderPath.'/'.$name);
	// Add to the array of image.
	array_push($images, $img);
	
}

// Check if folder exists.
if ($fnames) {
	$folder_icon = 'images/subfolder.svg';
	$folders=array();
  // Go through all the filenames in the folder.
  foreach ($fnames as $name) {
	if($name=='.' || $name == '..'){continue;}
	  
	  if (is_dir($absoluteFolderPath . $name)) {
		  
	  }

  }
  //foreach($folders as $a){array_push($response,$a);}
  $response = array('status'=>'success','data'=>$images);
}else{
  $response = array('status'=>'error','message'=>'error occured while fetching images.');
}

echo json_encode($response);
?>