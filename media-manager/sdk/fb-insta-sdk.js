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

FbObj.prototype.showAlbums = function (r){
	$('.img_cont').hide();
	var html='';
	for(i=0;i<r.length;i++){
		html += '<li data-type="'+r[i].subType+'" data-url="'+r[i].url+'"><img src="'+r[i].thumb+'"><div>'+r[i].name+'</div></li>';
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
	console.log(JSON.stringify(this.toSubmit));
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
			$(document).trigger('ImageManager.OpenFacebookImages');
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
		//alert('access token response');
		//console.log(response);
		r = JSON.parse(response);
		if(r.status=='success'){
			IGself.getUserMedia();
		}else{
			
		}
	});
}
IGObj.prototype.getUserMedia = function (){
	window.B.show();
	window.C.find(".fr-list-column").empty();
	$.get(this.aju,'user_media=true&u'+encodeURIComponent(location.href),function(response){
		//alert('user media response');
		//console.log(response);
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
			$(document).trigger('ImageManager.OpenFacebookImages');
			$('#fb-import-btn').text('Images Imported Successfully').delay(200).text('Import');
		},
		error:function(){
			//console.log('ajax error');
			$('#fb-import-btn').text('Problem in Saving Images').delay(200).text('Import');
		}
	});
}



//IG API
var _IG;
function IGinit(){
	_IG = new IGObj();
	_IG.getUserMedia();
}

$(document).ready(function(e) {
    
	$(document).on('click','.imp-fb',function(){
		$(document).trigger('ImageManager.activeFB');
		if(typeof _FB != 'undefined'){
			_FB.currentFB=$(this).val();
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
	
	$(document).on('ImageManager.activeFB',function(event,r){
		$('.img_cont').hide();
		$('#fb-images-ul').html('').show();
		loader('#fb-images-ul');
	});
	
	$(document).on('ImageManager.LoadInstaImages',function(event,r){
		//console.log('--------------------');
		//console.log(r);
		if(typeof _IG != 'undefined'){
			//console.log('IG: Load Event triggered successfully');
			window.atlist=r;gN(r);
		}else{
			console.log('_IG Not Defined.');
		}
	});
	
	$(document).on('change','#fr-fb-accounts-list',function(){
		if(typeof _FB != 'undefined'){
			_FB.currentFB=$(this).val();
			_FB.getAlbumsData();
		}else{
			FBinit();
		}
	});
	
	$(document).on('click','#fb-import-btn',function(){
		if($('.fr-fb-selected').length>0){
			var Obj2 = new Array();
			var sd = new Array();
			$('.fr-fb-selected').each(function(index, element) {
				if(window.ActiveTab=='fb'){
					_FB.toSubmit[index] = {url: btoa($(element).find('img[data-url]').attr('data-url')),name: btoa($(element).find('img[data-url]').attr('data-name')+'.jpg')};
				}else{
					_IG.toSubmit[index] = {url: btoa($(element).find('img[data-url]').attr('data-url')),name: btoa($(element).find('img[data-url]').attr('data-name')+'.jpg')};
				}
			});
			if(window.ActiveTab=='fb'){_FB.savePics();}else{_IG.savePics();}
				
		}else{
			console.log('no images to import');
		}
	});
	
	//Images Check all images fb
	$(document).on('imageManager.checkAll',function (event,xys){
		window.checkActive=true;
		if(window.ActiveTab!='local'){
			$('.fr-image-list .fr-image-container[data-type=image]').addClass('fr-fb-selected');
		}else{
			
			$('.fr-image-list .fr-image-container[data-type="folder"] .fr-open-folder').attr('data-subtype','fb-image').removeClass('fa-folder-open').addClass('fa-check-circle');
			$('.fr-image-list .fr-image-container[data-type] i.fr-delete-img').addClass('fr-disabled');
			$('.fr-image-list .fr-image-container[data-type="image"] .fr-insert-img').attr('data-subtype','fb-image').removeClass('fa-plus').addClass('fa-check-circle');
			
			$('.fr-image-list .fr-image-container[data-type]').addClass('fr-fb-selected');
		}
		
		if($('.fr-image-list .fr-image-container.fr-fb-selected').length>0 && window.ActiveTab!='local'){$('#fb-import-btn').show();}else{$('#fr-del-selected-local').show();}
		$(xys).addClass('fa-check-circle').removeClass('fa-circle');
	});
	$(document).on('imageManager.unCheckAll',function (event,xys){
		window.checkActive=false;
		if(window.ActiveTab!='local'){
			$('.fr-image-list .fr-image-container[data-type=image]').removeClass('fr-fb-selected');
			$('#fb-import-btn').hide();
		}else{
			
			$('.fr-image-list .fr-image-container[data-type="folder"] .fr-open-folder').attr('data-subtype','folder').removeClass('fa-check-circle').addClass('fa-folder-open');
			$('.fr-image-list .fr-image-container[data-type] i.fr-delete-img').removeClass('fr-disabled');
			$('.fr-image-list .fr-image-container[data-type="image"] .fr-insert-img').attr('data-subtype','image').removeClass('fa-check-circle').addClass('fa-plus');
			
			$('.fr-image-list .fr-image-container[data-type]').removeClass('fr-fb-selected');
			$('#fr-del-selected-local').hide();
		}
		
		$(xys).removeClass('fa-check-circle').addClass('fa-circle');
	});
	
	$(document).on('click',"#fr-check-all-btn",function(){
		//if(window.ActiveTab=='local') return false;
		if($(this).hasClass('fa-circle')){
			//hCheck(this);
			$(document).trigger('imageManager.checkAll',[this]);
		}else{
			//hUnCheck(this);
			$(document).trigger('imageManager.unCheckAll',[this]);
		}
		/*$('.fr-image-list .fr-image-container[data-type=image]').each(function(index, element) {
                $(element).find('.fr-open-folder').trigger('click');
         });*/
	});

});

