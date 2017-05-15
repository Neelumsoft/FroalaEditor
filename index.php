<?php

session_start();
$_SESSION['user_id'] = 382;
$user_folder = getUserFolder();


function getUserFolder(){
	$path = '/uploads/'.md5($_SESSION['user_id']).'/';
	if(!is_dir(__DIR__.$path)){
		mkdir(__DIR__.$path);
	}
	return $path;
}


$base = 'froala_editor_2.5.1/';
$base = 'froala_editor1/';

$css_files = array(
'css/froala_editor.css?v='.time(),
'css/froala_style.css',
'css/plugins/code_view.css',
'css/plugins/colors.css',
'css/plugins/emoticons.css',
'css/plugins/image_manager.css?v='.time(),
'css/plugins/image.css',
'css/plugins/line_breaker.css',
'css/plugins/table.css',
'css/plugins/char_counter.css',
'css/plugins/video.css',
'css/plugins/fullscreen.css',
'css/plugins/file-plugin.css',
'',
);
$cdn_css = array(
'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css',
'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css',
'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css',
);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
  <link rel="stylesheet" href="<?php echo $cdn_css[3]; ?>">

  <link rel="stylesheet" href="<?php echo $cdn_css[0]; ?>">
  
<?php
foreach($css_files as $k=>$v){
	echo '<link rel="stylesheet" type="text/css" href="'.$base.$v.'">';
}
?>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="<?php echo $cdn_css[1]; ?>">

  <!-- Optional theme -->
  <link rel="stylesheet" href="<?php echo $cdn_css[2]; ?>">

  <style>
      body {
          text-align: center;
      }

      div#editor {
          width: 81%;
          margin: auto;
          text-align: left;
      }

      .fr-inner:not(.row) {
        border: solid 1px #CCC;
      }
  </style>
</head>

<body>
<script type="text/javascript">
//Facebook SDK
(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<?php /*?><script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '853378044801613',
      xfbml      : true,
      version    : 'v2.8'
    });
	var uid,accessToken;
    FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
		console.log('Logged in.');
		uid = response.authResponse.userID;
    	accessToken = response.authResponse.accessToken;
		
		///permissions
		FB.api(
			"/"+uid+"/photos",
			function (response) {
			if (response && !response.error) {
				
				console.log(JSON.stringify(response));
			}else{
				console.log(JSON.stringify(response));
			}
			}
		);
		
		FB.api(
		  '/me',
		  'GET',
		  {"fields":"id,name,photos{link}",access_token:accessToken},
		  function(response) {
			  // Insert your code here
			  console.log(JSON.stringify(response));
		  }
		);
		
	  } else if (response.status === 'not_authorized') {
		// the user is logged in to Facebook, 
		// but has not authenticated your app
		FB.login();
	  }else{
		FB.login();
	  }
	});
		
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php */?>
<?php
$file_name = $_SERVER['DOCUMENT_ROOT'].'/dynamic.txt';
if(isset($_POST['submit'])){
	$data = $_POST['da'];
	file_put_contents($file_name,$data);
}
$da = file_get_contents($file_name);
?>
<form method="post" action="">
  <div id="editor">
      <textarea name="da" id='edit'>
          <?php echo $da; ?>
      </textarea>
  </div>
  <hr>
  <button type="submit" name="submit" class="btn btn-success btn-lg">Save</button>
  <a href="front.php" class="btn btn-warning btn-lg">View</button>
</form>
<div id="instaO"></div>
<?php
$js_files = array(
'js/froala_editor.js?v='.time(),
'js/plugins/align.min.js',
'js/plugins/code_beautifier.min.js',
'js/plugins/code_view.min.js',
'js/plugins/colors.min.js',
'js/plugins/draggable.min.js',
'js/plugins/emoticons.min.js',
'js/plugins/font_size.min.js',
'js/plugins/font_family.min.js',
'js/plugins/image.js?v='.time(),
'js/plugins/file-plugin.js',
'js/plugins/image_manager.js?v='.time(),
'js/plugins/line_breaker.min.js',
'js/plugins/link.min.js',
'js/plugins/lists.min.js',
'js/plugins/paragraph_format.min.js',
'js/plugins/paragraph_style.min.js',
'js/plugins/video.min.js',
'js/plugins/table.min.js',
'js/plugins/url.min.js',
'js/plugins/entities.min.js',
'js/plugins/char_counter.min.js',
'js/plugins/inline_style.min.js',
'js/plugins/save.min.js',
'js/plugins/fullscreen.min.js',
'js/plugins/quote.min.js',
'js/languages/ro.js',
);

$cdn_js = array(
'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js',
'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js'
);

foreach($cdn_js as $k=>$v){
	echo '<script type="text/javascript" src="'.$v.'"></script>';
}

foreach($js_files as $k=>$v){
	echo '<script type="text/javascript" src="'.$base.$v.'"></script>';
}

$bs_js = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js';
?>

  <!-- Latest compiled and minified JavaScript -->
  <script type="text/javascript" src="<?php echo $bs_js; ?>"></script>

<script>

$(document).ready(function(e) {
window.userFolderDefaultPath = '<?php echo $user_folder; ?>';
$('#edit').froalaEditor({
	enter: $.FroalaEditor.ENTER_BR,
	videoInsertButtons: ['videoBack', '|', 'videoByURL', 'videoEmbed',],
	//Folder Path
	userFolderDefaultPath: window.userFolderDefaultPath,
	
	// Set the image Load URL.
	imageManagerLoadURL: '/load_images.php?folder='+window.userFolderDefaultPath,
	
	// Set the Default Path
	imageManagerDefaultURL: '/load_images.php?folder='+window.userFolderDefaultPath,
	
	// Set the image delete URL.
	imageManagerDeleteURL: '/delete_image.php?folder='+window.userFolderDefaultPath,

	// Set the Default image delete URL.
	imageManagerDefaultDeleteURL: '/delete_image.php?folder='+window.userFolderDefaultPath,
	
	// Set the image upload URL.
    imageUploadURL: '/upload_image.php?folder='+window.userFolderDefaultPath,

	// Set the Default Upload Path
	imageManagerDefaultUploadURL: '/upload_image.php?folder='+window.userFolderDefaultPath,

	// Set the new folder URL.
    imageManagerNewFolderURL: '/new_folder.php?path='+window.userFolderDefaultPath,

	// Set the default new folder urlURL.
    imageManagerNewFolderDefaultURL: '/new_folder.php?path='+window.userFolderDefaultPath,
	
})

});
</script>
</body>
</html>