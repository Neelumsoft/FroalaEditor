<?php

$cdn_css = array(
'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css',
);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
  
<?php
foreach($cdn_css as $v){
	echo '<link rel="stylesheet" type="text/css" href="'.$v.'">';
}
?>

</head>

<body>
<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header" style="text-align:center;">
            <a class="navbar-brand" href="#">Froala Editor</a>
          </div>
          <!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<?php
echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/dynamic.txt');
?>     

    </div>

  
<?php
$bs_js = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js';
$jq_js = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js';
?>

  <!-- Latest compiled and minified JavaScript -->
  <script type="text/javascript" src="<?php echo $jq_js; ?>"></script>
  <script type="text/javascript" src="<?php echo $bs_js; ?>"></script>


</body>
</html>