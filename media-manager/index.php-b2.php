<?php
session_start();
$_SESSION['user_id'] = 382;
$user_folder = getUserFolder();


function getUserFolder(){
	$path = '/uploads/'.md5($_SESSION['user_id']).'/';
	if(!is_dir($_SERVER['DOCUMENT_ROOT'].$path)){
		mkdir($_SERVER['DOCUMENT_ROOT'].$path);
	}
	return $path;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Media Manager</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php
echo '
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> 
	<link rel="stylesheet" type="text/css" href="css/global.css" /> 
	<link rel="stylesheet" type="text/css" href="css/select.css" /> 
	<link rel="stylesheet" type="text/css" href="css/file-upload.css" /> 
	<link rel="stylesheet" type="text/css" href="css/style.css" /> 
	<!--[if IE]>
  <link rel="stylesheet" type="text/css" href="css/ie.css" />
	<![endif]-->
';
?>
<style type="text/css">
#media_manager_footer{
	display:block;
	margin-top:15px;
	padding-top:5px;
	border-top:#E7E7E7 solid 1px;
}
#media_manager_footer ul.pagination{
	list-style:none;
	margin:0;
	padding:0;
}

#media_manager_footer ul.pagination li{
	display:inline-block;
	background-color:#F0F0F0;
	padding:5px;
	margin:1px;
	height:30px;
	width:30px;
}
#media_manager_footer ul.pagination li:hover{
	cursor:pointer;
}
#media_manager_footer ul.pagination li.active{
	background-color:#D4D4D4;
}

.glyphicon {
	color: #000000 !important;
}
#fb-images-ul{
	list-style:none;
	padding:0;
	margin:0;
}
#fb-images-ul li{
	display:inline-block;
	margin:2px;
	border:#DFDFDF solid 1px;
}
#fb-images-ul li div{
	text-align:center;
}
#fb-images-ul li img{
	height:202px;
	width:220px;
}
#fb-images-ul li img:hover{
	cursor:pointer;
}
.mm-loader{
	width:100px;
}
.current-tp-open{
	color:#1F549B;
	font-weight:bolder;
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
<!-- Header Section Start --> 

<!-- Content section start -->
<div class="content-wrapper"> 
  <!-- Left Sidebar start --> 
<style>
ul#mm-folders-tree-ul li ul{
	display:none;
}
</style>
  <!-- Content start here -->
  <section class="content sidebar-content">
    <div class="content-mid">
      <div class="content-midleft">
        <h2 class="seller-heading"><span>Media Library</span></h2>
        <div class="root-box-top">
          <div class="root-menu-heading">
            <button type="button" class="btn btn-success" id="create-new-folder" title="Add New Folder"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" style="background-color:#FBD7D8;" class="btn btn-danger" id="delete-current-folder" title="Remove Current Folder"><span class="glyphicon glyphicon-remove"></span></button>
            <button type="button" class="btn btn-danger" id="rename-current-folder" title="Rename Current Folder"><span class="glyphicon glyphicon-pencil"></span></button>
          </div>
        </div>
        <div class="root-box">
          <div class="tree" id="mm-folder-tree">
            <ul id="mm-folders-tree-ul"></ul>
          </div>
        </div>
      </div>
      <div class="content-midright">
        <div class="media-box">
          <div class="media-header">
            <div class="media-list-view"> 
              <!--<span class="media-category-name">Categories Name (10 / 20)</span>-->
              <div class="pull-right view-list-icon"> <span class="glyphicon glyphicon-th-list list-view"></span> <span class="glyphicon glyphicon-th-large grid-view"></span> </div>
            </div>
            <div class="media-btn-group clearfix">
              <input type="file" id="upload_file_input" style="display:none;" accept="image/*">
              <button class="btn-md btn-skyblue" onClick="document.getElementById('upload_file_input').click();" title="Add New Media"> <span class="glyphicon glyphicon-cloud-upload"></span></button>
              <button class="btn-md btn-skyblue bulk-select" title="Bulk Select"><span class="glyphicon glyphicon-check"></span></button>
              <button class="btn-md btn-skyblue local-view" title="Show Manager Images"> Manager </button>
              <button class="btn-md btn-skyblue imp-fb" title="Import from Facebook"> Facebook </button>
              <button class="btn-md btn-skyblue img-insta" title="Import from Instagram"> Instagram </button>
              <div>
                  <hr>
                  <select title="Sort By" id="mm-page-sort"><option value="name-asc">Name ASC</option><option value="name-desc">Name DESC</option><option value="date-asc">Date ASC</option><option value="date-desc">Date DESC</option></select>
                  <select title="Images/Page" id="mm-images-per-page"><option value="10">10</option><option value="25">25</option><option value="50">50</option></select>
                  <button type="button" class="btn btn-default" style="display:none;" id="fb-action-back"><span class="glyphicon glyphicon-arrow-left"></span></button>
                  <select style="display:none;" id="fr-fb-accounts-list">
                    <option value="me">My Account</option>
                  </select>
                  <button style="display:none; background-color:#FBD7D8;" class="btn btn-danger" id="del_selected_images" title="Delete Selected Media"><span class="glyphicon glyphicon-remove"></span></button>
                  <button style="display:none;" class="btn btn-primary" id="fb-import-btn" title="Import Selected Media">Import</button>
                  <button style="display:none; color:#191919;" class="btn btn-primary" id="check_uncheck_btn" data-status="0" title="Check All/Uncheck All">Check All</button>
              </div>
            </div>
          </div>
          <div class="media-upload-item">
            <ul class="media-list-item img_cont" id="mm-images-ul"></ul>
            <ul class="img_cont" id="fb-images-ul"></ul>
          </div>
          <div id="media_manager_footer">
          	
          </div>
          
        </div>
      </div>
    </div>
    
    <!-- help section start -->
    <div class="help-content visible-lg">
      <h3><span class="question-icon">?</span> Help</h3>
      <div class="help-row">
        <h3>Product Details</h3>
        <p>Specify what category this product  falls under in your product catalogue. </p>
        <p><span class="example"> EXAMPLE </span> Men's T-Shirts, Women's Accessories, Sports Shoes. Specify what category this product falls under in your product catalogue.</p>
      </div>
      <div class="help-row">
        <h3>Product Advance Setting</h3>
        <p>Specify what category this product falls under in your product catalogue. </p>
        <p><span class="example"> EXAMPLE </span> Men's T-Shirts, Women's Accessories, Sports Shoes. Specify what category this product falls under in your product catalogue.</p>
      </div>
    </div>
    <!-- help section end -->
    
    <div class="push-content"></div>
  </section>
</div>

<!-- Content end --> 

<!--begin modal window-->
<div class="modal media-modal" id="mediaModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pull-left">Attachment Details</div>
        <button type="button" class="close" data-dismiss="modal" title="Close"> <span class="icon-remove"></span></button>
      </div>
      <div class="modal-body"> 
        
        <!--begin carousel-->
        <div id="myGallery" class="carousel slide" data-interval="false">
          <div class="carousel-inner"></div>
          <!--Begin Previous and Next buttons--> 
          <a class="left carousel-control" href="#myGallery" role="button" data-slide="prev"> <span class="icon-arrow-left2"> <span class="path1"></span><span class="path2"></span><span class="path3"></span> </span> </a> <a class="right carousel-control" href="#myGallery" role="button" data-slide="next"> <span class="icon-arrow-right2"> <span class="path1"></span><span class="path2"></span><span class="path3"></span> </span> </a> </div>
        <!--end carousel--> 
      </div>
      <!--end modal-body--> 
    </div>
    <!--end modal-content--> 
  </div>
  <!--end modal-dialoge--> 
</div>
<!--end myModal--> 

<?php echo '
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dd.min.js"></script>
<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/seller-custom.js"></script>
'; ?>
<script type="text/javascript">
function loader(x){
	$(x).html('<li><img src="/froala_editor1/img/loader.gif" class="mm-loader"></li>');
}
var uPath = '<?php echo $user_folder; ?>',iself;
window.userFolderDefaultPath = uPath;
window.currentPath = uPath;
window.imgPerPage=10;


var MediaManager = function(){
	this.IMGCONT = '#mm-images-ul',this.FolderTree='#mm-folders-tree-ul',this.galleryCONT='#myGallery .carousel-inner',this.cPath=uPath,iself=this;
}

MediaManager.prototype.newFolder = function(){
	$.post('/new_folder.php?path='+window.currentPath,'name=New-Folder-1',function (data){
		iself.getFolders();
		iself.getImages();
	});
}

MediaManager.prototype.appendFolder = function(d){
	var st = '<li> <a href="javascript:void(0)"> <span class="icon-leaf"></span> <i><img src="images/folder.svg" alt=""></i> <i class="tp-open" data-name="'+d.name+'"> ' + d.name +'</i></a></li>';
	if($('.current-tp-open').find(' > ul').length>0){
		$('.current-tp-open > ul').append(st);
	}else{
		iself.getFolders();
	}
}

MediaManager.prototype.renameFolder = function(path,oldName,newName){
	$.post('/new_folder.php?path='+path,'renameFolder=true&oldName='+oldName+'&newName='+newName,function (data){
		d = JSON.parse(data);
		if(d.status=='success'){ $('.current-tp-open').attr('data-name',newName).text(newName); }else{ console.log('Error: '+d.message); }
	});
}

MediaManager.prototype.getImages = function(){
	$(document).trigger('ImageManager.activateMM');
	$.get('api/load_images.php','folder='+window.currentPath,function (data){
		d = JSON.parse(data);
		if(d.status=='success'){ processPagination(sortArr(d.data)); }else{ console.log('Error: '.d.message); }
	});
}

MediaManager.prototype.loadImage = function(d){
	var html=html2='',s;
	if(d.length==0){
		$(iself.IMGCONT).html('<li>Empty Folder.</li>');
		$(iself.galleryCONT).html('');
		return false;
	}
	for(i=0;i<d.length;i++){
		s = d[i]; active = (i==0)?'active':'';
		html+='<li data-toggle="modal" data-target="#mediaModal" data-id="#mediaModal'+i+'"><a href="#mediaGallery" class="media-product-img"><img src="'+s.url+'" alt="'+s.name+'"><span class="check-wrapper"><input data-src="'+s.url+'" id="media-check'+i+'" class="checkbox local-checkbox" type="checkbox"><label for="media-check'+i+'" class="checkbox-label"></label></span></a></li>';
		
		html2 +='<div class="item row '+active+'" id="mediaModal'+i+'"><div class="col-sm-5 media-detail-img"><img src="'+s.url+'" alt="item3"></div><div class="col-sm-7"><div class="media-img-deatail"><div class="form-row"><span>File Type : </span> '+s.filetype+'</div><div class="form-row"><span>Uploaded On : </span> '+s.uploaded+'</div><div class="form-row"><span>File Name : </span> '+s.name+'</div><div class="form-row"><span>File Size : </span> '+s.filesize+'</div><div class="form-row"><span>Dimension : </span> '+s.dimension+'</div></div><div class="media-form"><div class="form-row"><span class="label">Url</span><div class="form-item"><a href="'+s.url+'">'+s.url+'</a></div></div></div><div class="media-footer"><div class="form-row"><div class="form-item"><button class="btn-md btn-skyblue del_btn" data-url="'+s.url+'">Delete</button></div></div></div></div></div>';
	}
	$(iself.IMGCONT).html(html);
	$(iself.galleryCONT).html(html2);
}
MediaManager.prototype.getFolders = function(){
	loader(this.FolderTree);
	$.get('api/load_folders.php?folder='+this.cPath,function (data){
		iself.loadFolders(data);
		
	});
}

MediaManager.prototype.getFolderTree2 = function(c){
	if(c.length==0){return '';};
	var out = '<ul>';
	for(var key in c){
		ch = iself.getFolderTree2(c[key]);
		cha = (ch.length>0)?'<i class="menuIcon glyphicon glyphicon-plus"></i>':'<span class="icon-leaf"></span>';
		out += '<li> <a href="javascript:void(0)">'+cha+' <i><img src="images/folder.svg" alt=""></i> <i class="tp-open" data-name="'+key+'"> ' + key +'</i></a>';
		 out += ch;
		out += '</li>';
	}
	out+= '</ul>';
	return out;
}
MediaManager.prototype.getFolderTree = function(c){
	var out = '<li class="parent-li"> <a href="javascript:void(0)"> <span class="icon-leaf"></i> <i><img src="images/folder.svg" alt=""></i> <i class="tp-open current-tp-open" data-name=""> Home</i></a></li>';
	for(var key in c){
		ch = iself.getFolderTree2(c[key]);
		cha = (ch.length>0)?'<i class="menuIcon glyphicon glyphicon-plus"></i>':'<span class="icon-leaf"></i>';
		out += '<li class="parent-li"> <a href="javascript:void(0)">'+cha+' <i><img src="images/folder.svg" alt=""></i> <i class="tp-open" data-name="'+key+'"> ' + key +'</i></a>';
		 out += ch;
		out += '</li>';
	}
	return out;
}

MediaManager.prototype.loadFolders = function(r){
	var d = JSON.parse(r);
	if(d.status == 'success'){
		shtml = iself.getFolderTree(d.data);
		$(iself.FolderTree).html(shtml);
	}else{
		$(iself.FolderTree).html('<li class="parent-li"> <a href="javascript:void(0)"> <span class="icon-leaf"></i> <i><img src="images/folder.svg" alt=""></i> <i class="tp-open current-tp-open" data-name=""> Home</i></a></li>');
		console.log('Error: '+d.message);
	}
}

MediaManager.prototype.appendIMG = function(s){
	
	sdcount = $(iself.IMGCONT).find('li').length;
	if(sdcount==0){
		active = 'active';
	}
	
	html = '<li data-toggle="modal" data-target="#mediaModal" data-id="#mediaModal'+sdcount+'"><a href="#mediaGallery" class="media-product-img"><img src="'+s.url+'" alt="'+s.name+'"><span class="check-wrapper"><input data-src="'+s.url+'" id="media-check'+i+'" class="checkbox local-checkbox" type="checkbox"><label for="media-check'+i+'" class="checkbox-label"></label></span></a></li>';
		
	html2 = '<div class="item row '+active+'" id="mediaModal'+sdcount+'"><div class="col-sm-5 media-detail-img"><img src="'+s.url+'" alt="item3"></div><div class="col-sm-7"><div class="media-img-deatail"><div class="form-row"><span>File Type : </span> '+s.filetype+'</div><div class="form-row"><span>Uploaded On : </span> '+s.uploaded+'</div><div class="form-row"><span>File Name : </span> '+s.name+'</div><div class="form-row"><span>File Size : </span> '+s.filesize+'</div><div class="form-row"><span>Dimension : </span> '+s.dimension+'</div></div><div class="media-form"><div class="form-row"><span class="label">Url</span><div class="form-item"><a href="'+s.url+'">'+s.url+'</a></div></div></div><div class="media-footer"><div class="form-row"><div class="form-item"><button class="btn-md btn-skyblue del_btn" data-url="'+s.url+'">Delete</button></div></div></div></div></div>';
	
	
	if($(iself.IMGCONT).find('li').length==1 && $(iself.IMGCONT).find('li:first').text()=='Empty Folder.'){
		$(iself.IMGCONT).html(html);
	}else{
		$(iself.IMGCONT).prepend(html);
	}
	
	if($(iself.IMGCONT).find('.item').length==0){
		$(iself.galleryCONT).html(html2);
	}else{
		$(iself.galleryCONT).prepend(html2);
	}
}

MediaManager.prototype.getCurrentPath = function(){
	var s = [];
	$('.current-tp-open').parents('li').each(function(index, element) {
		s.push($(element).find('i.tp-open').attr('data-name'));
	});
	s.reverse();
	if(s.length>0){
		window.currentPath = uPath+s.join('/')+'/';
	}
	return window.currentPath;
}

MediaManager.prototype.uploadFile = function(){
	file = document.getElementById('upload_file_input').files[0];
	var data = new FormData();
    data.append('file', file);
	this.getCurrentPath();
	
	$.ajax({
        url: 'api/upload_image.php?upload_file&folder='+window.currentPath,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(d)
        {
			if(d.status=='success'){
				iself.appendIMG(d.data);
			}else{
				console.log('Error: '+d.message);
			}
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log('ERRORS: ' + textStatus);
        }
    });
	
	
}
MediaManager.prototype.deleteBulk = function(){
	var toDelList=[];
	$('input.local-checkbox:checked').each(function(index, element) {
		toDelList.push($(element).attr('data-src'));
	});
	MM.deleteBulk(toDelList);
	
	var dataToSend = 'links='+JSON.stringify(s);
	$.ajax({
		type:"POST",
		url:"api/delete_api.php?bulk_delete=true",
		data:dataToSend,
		success: function(data){
			var d = JSON.parse(data);
			console.log(d);
		},
		error: function(){
			console.log('Error: while deleting');
		}
	});
}

MediaManager.prototype.deleteFile = function(src,el){
	$.get('api/delete_api.php?type=file&src='+src,function(data){
		var d = JSON.parse(data);
		if(d.status=='success'){
			
			$(iself.galleryCONT).find('.item.active').remove();
			$(iself.galleryCONT).find('.item:nth-of-type(1)').addClass('active');
			$('.close').click();
			$(iself.IMGCONT).find('img[src="'+src+'"]').closest('li').remove();
			
		}else{
			console.log('Error: '+d.message);
		}
	});
}

MediaManager.prototype.deleteFolder = function(src,el){
	$.get('api/delete_api.php?type=folder&dir='+src,function(data){
		var d = JSON.parse(data);
		if(d.status=='success'){
			iself.getFolders();
			window.currentPath = uPath;
			iself.getImages();
		}else{
			console.log('Error: '+d.message);
		}
	});
}



var MM;
$(document).ready(function(e) {
    MM =  new MediaManager();
	MM.getImages();
	MM.getFolders();
	$(document).on('click','li[data-target]',function(){
		var id = $(this).attr('data-id');
		$(MM.galleryCONT).find('.item').removeClass('active');
		$(id).addClass('active');
		return false;
	});
	
	$('#create-new-folder').click(function(){
		MM.newFolder();
	});
	
	$(document).on('click','#mm-folders-tree-ul li i.tp-open',function(){
		var s = [];
		$('#mm-folders-tree-ul li i.tp-open').removeClass('current-tp-open');
		$(this).addClass('current-tp-open');
		
		$(this).parents('li').each(function(index, element) {
            s.push($(element).find('i.tp-open').attr('data-name'));
        });
		s.reverse();
		if(s.length>0){
		window.currentPath = uPath+s.join('/')+'/';
		}
		MM.getImages();
	});
	
	$(document).on('ImageManager.activateMM',function(){
		window.ActiveTab='local';
		window.st_bul_sel=false;
		resetCheckBtn();
		$('#check_uncheck_btn').hide();
		$('.img_cont,#fr-fb-accounts-list,#fb-import-btn,#del_selected_images').hide();
		$('#fb-action-back').hide();
		$('#mm-images-ul').html('').show();
		loader('#mm-images-ul');
	});
	
	$('.local-view').click(function(){
		MM.getImages();
	});
	
	$('#upload_file_input').change(function(event){
		MM.uploadFile();
	});
	
	$(document).on('click','.del_btn',function(){
		if(confirm('Are you sure? to delete the file!')){
			MM.deleteFile($(this).attr('data-url'));
		}
	});
	
	$(document).on('click','#delete-current-folder',function(){
		if($('.current-tp-open').attr('data-name').length==0){return false;}else if(confirm('Are you sure to delete the Folder?')){
			
			var s = [];
			$('#mm-folders-tree-ul li i.tp-open').removeClass('current-tp-open');
			
			$(this).parents('li').each(function(index, element) {
				s.push($(element).find('i.tp-open').attr('data-name'));
			});
			s.reverse();
			if(s.length>0){
				window.currentPath = uPath+s.join('/')+'/';
			}
			
			MM.deleteFolder(window.currentPath,'#'+$('.current-tp-open').closest('li'));
		}
	});
	
	$(document).on('click','#rename-current-folder',function(){
		if($('.current-tp-open').attr('data-name').length==0 || $('.current-tp-open').attr('data-name')=='Facebook-Images' || $('.current-tp-open').attr('data-name') == 'Instagram-Images'){return false;}else{
			var oldName = $('.current-tp-open').attr('data-name');
			var allNames = [];
			$('.current-tp-open').closest('ul').find('li').each(function(index, element) {
                allNames.push($(element).find('i.tp-open').attr('data-name'));
            });
			do{
				newName = prompt('Enter New Name:',oldName);
			}while(allNames.indexOf(newName) != -1 && (newName != false && newName != null) && newName.length > 0 );
			
			var s = [];var f=0;
			$('.current-tp-open').parents('li').each(function(index, element) {
				if(f!=0){
					s.push($(element).find('i.tp-open').attr('data-name'));
				}
				f++;
			});
			s.reverse();
			olPath = uPath;
			if(s.length>0){
				olPath += s.join('/')+'/';
			}
			
			MM.renameFolder(olPath,oldName,newName);
		}
	});
	
	$('#del_selected_images').click(function(){
		if($('input.local-checkbox:checked').length>0){
			if(confirm('Are you sure to delete?')){
				MM.deleteBulk();
			}
		}else{
			console.log('Warning: No Item Selected');
		}
	});
	
	$(document).on('click','.menuIcon',function(){
		if($(this).closest('li').find(' > ul').css('display')!='none'){
			$(this).closest('li').find(' > ul').slideUp();
			$(this).attr('title', 'Expand').addClass('glyphicon-plus').removeClass('glyphicon-minus');
		}else{
			$(this).closest('li').find(' > ul').slideDown();
			$(this).attr('title', 'Expand').addClass('glyphicon-minus').removeClass('glyphicon-plus');
		}
	});
	
	$(document).on('click','#check_uncheck_btn',function(){
		if(window.ActiveTab=='fb' && window.fbSt != 1){return false;}
		if($(this).attr('data-status')==0){
			checkAll(this);
		}else{
			unCheckAll(this);
		}
	});
	
	$(document).on('click','#media_manager_footer ul.pagination > li',function(){
		openPage($(this).attr('data-value'));
	});
	
	$('#mm-page-sort').change(function(){
		processPagination(sortArr(window.unSrtArr));
	});
	
	$('#mm-images-per-page').change(function(){
		window.imgPerPage=$(this).val();
		processPagination(window.unSrtArr);
	});
	
});

function resetCheckBtn(){
	$('#check_uncheck_btn').text('Check All').attr('data-status',0);
}

function checkAll(x){
	$(x).text('Uncheck All');
	$(x).attr('data-status',1);
	$('input.checkbox').attr('checked',true);
}

function unCheckAll(x){
	$(x).text('Check All');
	$(x).attr('data-status',0);
	$('input.checkbox').attr('checked',false);
}


function srt(s){
	function cmpr(ss,tt){ss = ss.toUpperCase();tt = tt.toUpperCase();if (ss < tt) {return -1;}if (ss > tt) {return 1;}return 0;}
	
	s.sort(function(aa, bb) {
		switch($('#mm-page-sort').val()){
			case 'name-desc':
				return cmpr(bb.name,aa.name);
				break;
			case 'date-asc':
				return aa.datetime-bb.datetime;
				break;
			case 'date-desc':
				return bb.datetime-aa.datetime;
				break;
			default:
				return  cmpr(aa.name,bb.name);
		}
		
	});
	return s;
}

function sortArr(s){
	window.unSrtArr = s;
	var sFiles=[];
	for(i=0;i<s.length;i++){
		sFiles.push(s[i]);
	}
	return srt(sFiles);
}


function processPagination(a){
	window.pg_a=a,window.pg_t = a.length;window.pg_tp=Math.ceil(window.pg_t/window.imgPerPage);showPagination(window.pg_tp);
}

function showPagination(pg_tp){
	var pg_act,pg_html='<ul class="pagination">';
	for(i=1;i<=pg_tp;i++){
		if(i==1){pg_act='active';}else{pg_act='';}
		pg_html+='<li class="'+pg_act+'" data-value="'+i+'">'+i+'</li>';
	}
	pg_html+='</ul>';
	$('#media_manager_footer').html(pg_html);
	openPage(1);
}

function openPage(pg_n){
	$('#media_manager_footer ul.pagination > li').removeClass('active');
	$('#media_manager_footer ul.pagination > li[data-value='+pg_n+']').addClass('active');
	var maxN = (pg_n*window.imgPerPage)-1;
	var nArr=[],pg_t_mx=(maxN-(window.imgPerPage-1));
	for(i=pg_t_mx;i<=maxN;i++){if(window.pg_a.indexOf(window.pg_a[i])!=-1) nArr.push(window.pg_a[i]);}	
	switch(window.ActiveTab){
		case 'fb':
			if(window.fbSt==1){
				_FB.showAlbumPics(nArr);
			}else{
				_FB.showAlbums(nArr);
			}
			
			break;
		case 'insta':
			_IG.showPics(nArr);
			break;
		default:
			MM.loadImage(nArr);
	}
	
}


</script> 
<script type="text/javascript" src="sdk/fb-insta-sdk.js?v=<?php echo time(); ?>"></script>

</body>
</html>
