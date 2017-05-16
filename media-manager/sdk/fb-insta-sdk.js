/****************************************Facebook SDK***********************************/

//Facebook SDK (Image Import)
var self,FbObj = function (FB){
	this.FB = FB,this.aurl='/import-from-facebook.php?folder='+window.userFolderDefaultPath,this.FB_uid='', this.FB_accessToken='',self=this,this.selectedImages=[],this.ai=[],this.al=[],this.currentFB,this.toSubmit={};
}

FbObj.prototype.authRequest = function (){
	//self.currentFB='me';self.getAlbumsData(); return;
	this.FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
		console.log('Logged in.');
		self.FB_uid = response.authResponse.userID;
		self.FB_accessToken = response.authResponse.accessToken;
		//self.getPhoto();
		//self.getPhotos();
		self.currentFB='me';
		self.getAlbumsData();
		self.getPages();
	  }else if (response.status === 'not_authorized') {
		console.log('not_authorized, please login');
		self._login();
	  }else{
		console.log('not logged in, please login');
		self._login();
	  }
	});
}

//prompt for login current user
FbObj.prototype._login = function (){
	this.FB.login(function(response) {
    if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
	 self.authRequest();
    } else {
     console.log('User cancelled login or did not fully authorize.');
    }
},{scope: 'email,user_photos,public_profile'});
}

//preparing response for print
FbObj.prototype.preResponse = function (r){
	var s;
	for(i=0;i<r.length;i++){
		this.al[i] = {type: "folder",subType: "fb-folder", url: r[i].id,thumb: "/froala_editor1/img/fb-album-icon.png",name: r[i].name+'('+r[i].photo_count+')', datetime: r[i].created_time};
		this.ai[r[i].id]=[];
		if(r[i].photo_count>0){
			s=r[i].photos.data;
			for(j=0;j<s.length;j++){
				this.ai[r[i].id][j] = {type: "image",subType: "fb-image",url: s[j].images[0].source,thumb: s[j].images[(s[j].images.length-1)].source,name: s[j].id, datetime: s[j].created_time};
			}
		}
	}
	return this.al;
}

FbObj.prototype.showAlbums = function (){
	$('.img_cont').hide();
	$('#fb-action-back').hide();
	var html='', r=this.al;
	for(i=0;i<r.length;i++){
		//html += '<li data-type="'+r[i].subType+'" data-url="'+r[i].url+'"><img src="'+r[i].thumb+'"><div>'+r[i].name+'</div></li>';
		html+='<li data-type="'+r[i].subType+'" data-url="'+r[i].url+'"><a href="javascript:void(0);" class="media-product-img"><img src="'+r[i].thumb+'" alt="'+r[i].name+'"></a><div>'+r[i].name+'</div></li>';
	}
	$('#fb-images-ul').html(html);
	
	$('#fb-images-ul').show();
}

FbObj.prototype.showAlbumPics = function (id){
	var html='';
	$('#fb-action-back').show();
	var r = this.ai[id];
	for(i=0;i<r.length;i++){
		//html += '<li data-type="'+r[i].subType+'" data-url="'+r[i].url+'" data-name="'+r[i].name+'"><img src="'+r[i].url+'"></li>';
		html+='<li data-id="#mediaModal'+i+'" data-type="'+r[i].subType+'" data-url="'+r[i].url+'" data-name="'+r[i].name+'"><a href="javascript:void(0);" class="media-product-img"><img src="'+r[i].url+'" alt="'+r[i].name+'"><span class="check-wrapper"><input id="fb-media-check'+i+'" class="checkbox fb-checkbox" type="checkbox"><label for="fb-media-check'+i+'" class="checkbox-label"></label></span></a></li>';
	}
	$('#fb-images-ul').html(html);
	
	$('#fb-images-ul').show();
}
//get photos of user 000 not used
FbObj.prototype.getPhotos = function (){
	this.FB.api(
	  '/me',
	  'GET',
	  {"fields":"name,photos.limit(300){images,album,name}",access_token:this.FB_accessToken},
	  function(response) {
		  console.log('user images received');
		  console.log(JSON.stringify(response));
		  //self.savePics(response);
	  }
	);
}

//get user own albums with photos
FbObj.prototype.getAlbumsData = function(i){
	this.al=[];this.ai=[];
	this.FB.api(
	  '/'+this.currentFB+'/albums',
	  'GET',
	  {"fields":"photo_count,name,created_time,photos.limit(300){created_time,name,images}"},
	  function(response) {
		  self.showAlbums(self.preResponse(response.data));
	  }
	);
}

//get user pages
FbObj.prototype.getPages = function(){
	this.FB.api(
	  '/me/accounts',
	  'GET',
	  {"fields":"name,app_id"},
	  function(response) {
		  //Insert your code here
		  //console.log('All Pages');
		  //console.log(response);
		  self.showPages(JSON.parse(JSON.stringify(response)));
		  //self.getFromPage(data.data[1].id);
	  }
	);
}

//show user pages in list
FbObj.prototype.showPages = function(r){
	var items = '<option value="me">My Account</option>';
	for(i=0;i<r.data.length;i++){
		items += '<option value="'+r.data[i].id+'">'+r.data[i].name+'</option>';
	}
	$('#fr-fb-accounts-list').html(items).css('display','inline-block');
}

//get albums from pages & their images 000 not used
FbObj.prototype.getFromPage = function(pid){
	this.FB.api(
	  '/'+pid+'/albums',
	  'GET',
	  {"fields":"cover_photo,photo_count,photos.limit(300){images,id}"},
	  function(response) {
		 console.log('Page Photos');
		 console.log(JSON.stringify(response));
		 
	  }
	);
}

//save pics to local storage 
FbObj.prototype.savePics = function (){
	//console.log(JSON.stringify(this.toSubmit));
	$.ajax({
		url: this.aurl,
		type:"POST",
		data:this.toSubmit,
		dataType:"json",
		beforeSend: function(){
			//console.log(self.toSubmit);
			$('#fb-import-btn').text('Saving...');
		},
		success: function(da){
			//console.log(da);
			MM.getImages();
			$('#fb-import-btn').text('Images Imported Successfully').delay(200).text('Import');
		},
		error:function(){
			//console.log('ajax error');
			$('#fb-import-btn').text('Problem in Saving Images').delay(200).text('Import');
		}
	});
}

//FB API
var _FB;
function FBinit(){
	FB.init({appId:'853378044801613',xfbml:true,version:'v2.8'});
	_FB = new FbObj(FB);
	_FB.authRequest();
}




/****************************************IG SDK***********************************/
/****************************************IG SDK***********************************/
/****************************************IG SDK***********************************/
//Instagram SDK (Image Import)
var IGself,IGObj = function (){
	this.at,this.aju='http://'+location.hostname+'/froala_php_sdk/insta-sdk.php',IGself=this,this.ig_images,this.toSubmit={},this.aurl='/import-from-facebook.php?type=ig&folder='+window.userFolderDefaultPath;
}

IGObj.prototype.authRequest = function (){
	//this._login();
	this.getUserMedia();
}

//prompt for login current user
IGObj.prototype._login = function (){
	$.get(this.aju,'clogin',function(response){
		r = JSON.parse(response);
		if(r.status=='success'){
			IGself.getAccessToken();
		}else{
			window.open(r.link,'_self');
		}
	});
}

IGObj.prototype.getAccessToken = function (){
	$.get(this.aju,'access_token',function(response){
		r = JSON.parse(response);
		if(r.status=='success'){
			IGself.getUserMedia();
		}else{
			
		}
	});
}
IGObj.prototype.getUserMedia = function (){
	$.get(this.aju,'user_media=true&u'+encodeURIComponent(location.href+'/media-manager'),function(response){
		r = JSON.parse(response);
		if(r.status=='error'){
			switch(r.code){
				case 100:
					console.log('Warning: not logged in redirecting...');
					window.open(r.link,'_self');
					break;
				default:
					console.log('Error: '+r.message);
					break;
			}
		}else if(r.status=='success'){
			$(document).trigger('ImageManager.LoadInstaImages',[r.data]);
		}else{
			console.log('Error: Unknown error occured while fetching data from insta');
			$(document).trigger('ImageManager.OpenFacebookImages',[r.data]);
		}
	});
}

//save pics to local storage 
IGObj.prototype.savePics = function (){
	//console.log(JSON.stringify(this.toSubmit));
	$.ajax({
		url: this.aurl,
		type:"POST",
		data:this.toSubmit,
		dataType:"json",
		beforeSend: function(){
			//console.log(self.toSubmit);
			$('#fb-import-btn').text('Saving...');
		},
		success: function(da){
			//console.log(da);
			MM.getImages();
			$('#fb-import-btn').text('Images Imported Successfully').delay(200).text('Import');
		},
		error:function(){
			//console.log('ajax error');
			$('#fb-import-btn').text('Problem in Saving Images').delay(200).text('Import');
		}
	});
}

IGObj.prototype.showPics = function (r){
	var html='';
	for(i=0;i<r.length;i++){
		//html += '<li data-type="'+r[i].subType+'" data-url="'+r[i].url+'" data-name="'+r[i].name+'"><img src="'+r[i].url+'"></li>';
		html+='<li data-id="#mediaModal'+i+'" data-type="'+r[i].subType+'" data-url="'+r[i].url+'" data-name="'+r[i].name+'"><a href="javascript:void(0);" class="media-product-img"><img src="'+r[i].thumb+'" alt="'+r[i].name+'"><span class="check-wrapper"><input id="fb-media-check'+i+'" class="checkbox fb-checkbox" type="checkbox"><label for="fb-media-check'+i+'" class="checkbox-label"></label></span></a></li>';
	}
	$('#fb-images-ul').html(html);
	
	$('#fb-images-ul').show();
}



//IG API
var _IG;
function IGinit(){
	_IG = new IGObj();
	_IG.getUserMedia();
}

$(document).ready(function(e) {
    
	$(document).on('click','.imp-fb',function(){
		$(document).trigger('ImageManager.activateFB');
		if(typeof _FB != 'undefined'){
			_FB.currentFB=$('#fr-fb-accounts-list').val();
			_FB.getPages();
			_FB.getAlbumsData();
			
		}else{
			FBinit();
		}
	});
	
	$(document).on('ImageManager.LoadFacebookImages',function(event,r){
		if(typeof _FB != 'undefined' && typeof MM != 'undefined'){
			MM.loadImage(r);
		}else{
			console.log('_FB Not Defined.');
		}
	});
	
	$(document).on('ImageManager.activateFB',function(event,r){
		$('.img_cont').hide();
		window.ActiveTab='fb';
		$('#del_selected_images,#fb-import-btn').hide();
		$('#fb-images-ul').html('').show();
		loader('#fb-images-ul');
	});
	
	
	
	$(document).on('click','[data-type="fb-folder"]',function(){
		_FB.showAlbumPics($(this).attr('data-url'));
	});
	
	
	$('#fb-action-back').click(function(){
		_FB.showAlbums();
	});
	window.st_bul_sel=false;
	$('.bulk-select').click(function(){
		if(!window.st_bul_sel){
			$('.checkbox').attr('checked',true);
			$('#del_selected_images').show();
			window.st_bul_sel = true;
			$('#mm-images-ul li').removeAttr('data-target');
			if(window.ActiveTab=='fb'){$('#fb-import-btn').show();}
		}else{
			$('.checkbox').attr('checked',false);
			$('#del_selected_images').hide();
			window.st_bul_sel = false;
			$('#mm-images-ul li').removeAttr('data-target','#mediaModal');
			$('#mm-images-ul li').removeAttr('data-target','#mediaModal');
			if(window.ActiveTab=='fb'){$('#fb-import-btn').hide();}
		}
	});
	
	$(document).on('click','#fb-import-btn',function(){
		if($('input.fb-checkbox:checked').length>0){
			$('input.fb-checkbox:checked').each(function(index, element) {
				if(window.ActiveTab=='fb'){
					_FB.toSubmit[index] = {url: btoa($(element).closest('li').attr('data-url')),name: btoa($(element).closest('li').attr('data-name')+'.jpg')};
				}else{
					_IG.toSubmit[index] = {url: btoa($(element).closest('li').attr('data-url')),name: btoa($(element).closest('li').attr('data-name')+'.jpg')};
				}
			});
			if(window.ActiveTab=='fb'){_FB.savePics();}else{_IG.savePics();}
				
		}else{
			console.log('no images to import');
		}
	});
	
	
	
	
/**** InstaGram Payments ******/


	
	$(document).on('click','.img-insta',function(){
		$(document).trigger('ImageManager.activateIG');
		if(typeof _IG != 'undefined'){
			_IG.getUserMedia();
		}else{
			IGinit();
		}
	});
	
	$(document).on('ImageManager.activateIG',function(event,r){
		$('.img_cont').hide();
		window.ActiveTab='insta';
		$('#del_selected_images,#fb-import-btn').hide();
		$('#fb-images-ul').html('').show();
		loader('#fb-images-ul');
	});
	
	$(document).on('ImageManager.LoadInstaImages',function(event,r){
		if(typeof _IG != 'undefined'){
			_IG.showPics(r);
		}else{
			console.log('_IG Not Defined.');
		}
	});

});

