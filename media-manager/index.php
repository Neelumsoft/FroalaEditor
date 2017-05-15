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
.glyphicon{
	color:#000000 !important;
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



	<!-- Content start here -->
	<section class="content sidebar-content">

		<div class="content-mid">
			<div class="content-midleft">
				<h2 class="seller-heading"><span>Media Library</span></h2>
				<div class="root-box-top">
					<div class="root-menu-heading">
						<ul>
							<li><a href="javascript:void(0)" class="root-listitem">
									<span class="foldericon-root"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="22px" viewBox="0 0 14.5 11.5" enable-background="new 0 0 14.5 11.5" xml:space="preserve">
													<g><path fill="#F9FFD9" stroke="#707171" stroke-width="0.5" stroke-miterlimit="10" d="M4.6,2.775h8.583
													c0.59,0,1.068,0.479,1.068,1.066v6.34c0,0.59-0.479,1.068-1.068,1.068H1.317c-0.591,0-1.067-0.479-1.067-1.068V1.316
													c0-0.59,0.477-1.066,1.067-1.066h2.464L4.6,2.775z"/>
													<path fill="#FFFFFF" stroke="#707171" stroke-width="0.5" stroke-miterlimit="10" d="M12.983,2.775V2.027
													c0-0.588-0.479-1.066-1.068-1.066H4.011L4.6,2.775h8.084H12.983z"/>
													</g></svg>													
													</span>
									<span class="ficon-txt"> Add Root Category</span></a>
								<ul>
									<li><a href="javascript:void(0)">
										<span class="foldericon-root"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="22px" viewBox="0 0 14.5 11.5" enable-background="new 0 0 14.5 11.5" xml:space="preserve"><g>	<path fill="#DDE8E8" stroke="#707171" stroke-width="0.5" stroke-miterlimit="10" d="M4.6,2.775h8.583	c0.59,0,1.068,0.479,1.068,1.066v6.34c0,0.59-0.479,1.068-1.068,1.068H1.318c-0.592,0-1.068-0.479-1.068-1.068V1.316 c0-0.588,0.477-1.066,1.068-1.066h2.463L4.6,2.775z"/>	<path fill="#FFFFFF" stroke="#707171" stroke-width="0.5" stroke-miterlimit="10" d="M12.983,2.775V2.029		c0-0.59-0.479-1.066-1.068-1.066H4.012L4.6,2.775h8.084H12.983z"/></g></svg></span>
										<span class="ficon-txt"> Add Subcategory</span>
									</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="root-box">
					<div class="tree">
				    <ul id="mm-folders-tree-ul">
			        <li>
		            <a href="javascript:void(0)"><i class="menuIcon glyphicon glyphicon-minus"></i>
		           	<i><img src="images/folder.svg" alt=""></i> Default Category</a> 
		            <ul>
	                <li>
	                	<a href="http://google.com"><i class="menuIcon glyphicon glyphicon-minus"></i>
	                		<i><img src="images/folder.svg" alt=""></i> Root Catagory 001 (8)</a> 
	                    <ul>
	                        <li>
		                       		<a href="javascript:void(0)"><i class="icon-leaf"></i>
		                       		<i><img src="images/subfolder.svg" alt=""></i> Grand Child</a> 
	                        </li>
	                    </ul>
	                </li>
	                <li>
	                	<a href="javascript:void(0)"><i class="menuIcon glyphicon glyphicon-minus"></i>
												<i><img src="images/folder.svg" alt=""></i> Child
											</a> 
	                    <ul>
	                        <li>
		                        <a href="javascript:void(0)">
		                        <i><img src="images/subfolder.svg" alt=""></i> Grand Child</a> 
	                        </li>
	                        <li>
	                        	<a href="javascript:void(0)"><i class="menuIcon glyphicon glyphicon-minus"></i>
	                        	<i><img src="images/subfolder.svg" alt=""></i> Grand Child</a> 
	                            <ul>
	                                <li>
		                                <a href="javascript:void(0)"><i class="menuIcon glyphicon glyphicon-minus"></i>
		                                <i><img src="images/subfolder.svg" alt=""></i> Great Grand Child</a> 
			                            <ul>
			                                <li>
				                                <a href="javascript:void(0)">
				                                <i><img src="images/subfolder.svg" alt=""></i> Great great Grand Child</a> 
			                                </li>
			                                <li>
				                                <a href="javascript:void(0)">
				                                <i><img src="images/subfolder.svg" alt=""></i> Great great Grand Child</a> 
			                                </li>
			                             </ul>
	                                </li>
	                                <li>
		                                <a href="javascript:void(0)">
		                                <i><img src="images/subfolder.svg" alt=""></i> Great Grand Child</a> 
	                                </li>
	                                <li>
		                                <a href="javascript:void(0)">
		                                <i><img src="images/subfolder.svg" alt=""></i> Great Grand Child</a> 
	                                </li>
	                            </ul>
	                        </li>
	                        <li>
		                        <a href="javascript:void(0)">
		                        <i><img src="images/subfolder.svg" alt=""></i> Grand Child</a> 
	                        </li>
	                    </ul>
	                </li>
		            </ul>
			        </li>
			        <li>
			          <a href="javascript:void(0)"><i class="menuIcon glyphicon glyphicon-minus"></i>
			          <i><img src="images/folder.svg" alt=""></i> Parent2</a> 
			          <ul>
			            <li>
			              <a href="javascript:void(0)">
			              <i><img src="images/subfolder.svg" alt=""></i> Child</a> 
					        </li>
					    	</ul>
			        </li>
				    </ul>
					</div>
				</div>
			</div>
			<div class="content-midright">
				<button class="btn-skyblue btn-md pull-right">Remove Category</button>
				<div class="media-box">
					<div class="media-header">		
						<div class="media-list-view">
							<!--<span class="media-category-name">Categories Name (10 / 20)</span>-->
							<div class="pull-right view-list-icon">
								<span class="glyphicon glyphicon-th-list list-view"></span>
								<span class="glyphicon glyphicon-th-large grid-view"></span>
							</div>
						</div>
						<div class="media-btn-group clearfix">
                        	<input type="file" id="upload_file_input" style="display:none;" accept="image/*">
							<button class="btn-md btn-skyblue" onClick="document.getElementById('upload_file_input').click();" title="Add New Media"> <span class="glyphicon glyphicon-cloud-upload"></span></button>
							<button class="btn-md btn-skyblue bulk-select" title="Bulk Select"><span class="glyphicon glyphicon-check"></span></button>
							<button class="btn-md btn-skyblue imp-fb" title="Import from Facebook"> Facebook </button>
							<button class="btn-md btn-skyblue img-insta" title="Import from Instagram"> Instagram </button>
						</div>
					</div>				
					<div class="media-upload-item">		
						<ul class="media-list-item img_cont" id="mm-images-ul">
							<?php /*?><li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check1" class="checkbox" type="checkbox" checked="checked">
										<label for="media-check1" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img2.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check2" class="checkbox" type="checkbox" checked="checked">
										<label for="media-check2" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img3.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check3" class="checkbox" type="checkbox" checked="checked">
										<label for="media-check3" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img4.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check4" class="checkbox" type="checkbox">
										<label for="media-check4" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img5.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check5" class="checkbox" type="checkbox">
										<label for="media-check5" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img6.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check6" class="checkbox" type="checkbox">
										<label for="media-check6" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img7.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check7" class="checkbox" type="checkbox">
										<label for="media-check7" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img8.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check8" class="checkbox" type="checkbox">
										<label for="media-check8" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img9.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check9" class="checkbox" type="checkbox">
										<label for="media-check9" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check10" class="checkbox" type="checkbox">
										<label for="media-check10" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img2.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check11" class="checkbox" type="checkbox">
										<label for="media-check11" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img3.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check12" class="checkbox" type="checkbox">
										<label for="media-check12" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img4.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check13" class="checkbox" type="checkbox">
										<label for="media-check13" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img5.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check14" class="checkbox" type="checkbox">
										<label for="media-check14" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img6.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check15" class="checkbox" type="checkbox">
										<label for="media-check15" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img7.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check16" class="checkbox" type="checkbox">
										<label for="media-check16" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img8.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check17" class="checkbox" type="checkbox">
										<label for="media-check17" class="checkbox-label"></label>
									</span>
								</a>
							</li>
							<li data-toggle="modal" data-target="#mediaModal">
								<a href="#mediaGallery" class="media-product-img">
									<img src="images/media/media-img9.jpg" alt="">
									<span class="check-wrapper">
										<input id="media-check18" class="checkbox" type="checkbox">
										<label for="media-check18" class="checkbox-label"></label>
									</span>
								</a>
							</li><?php */?>
						</ul>
<style>
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
</style>
                        <ul class="img_cont" id="fb-images-ul">
							<li><img src="../uploads/a5dcc89c3be1903b69a571e786fdcc342cd69209.jpg"><div>Name (12)</div></li>
							<li><img src="../uploads/a5dcc89c3be1903b69a571e786fdcc342cd69209.jpg"><div>&nbsp;</div></li>
							<li><img src="../froala_editor1/img/fb-album-icon.png"><div>&nbsp;</div></li>
							<li><img src="../uploads/a5dcc89c3be1903b69a571e786fdcc342cd69209.jpg"></li>
						</ul>
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
					<div class="carousel-inner">
						
                        <?php /*?>
                        <div class="item row active"> 
							<div class="col-sm-5 media-detail-img">
								<img src="images/media/popup-large.jpg" alt="item0">
							</div>
							<div class="col-sm-7">
								<div class="media-img-deatail">
									<div class="form-row">
										<span>File Type : </span> Photo001.Jpg
									</div>
									<div class="form-row">
										<span>Uploaded On : </span> Image/Jpg
									</div>
									<div class="form-row">
										<span>File Name : </span> Aug 26 2016
									</div>
									<div class="form-row">
										<span>File Size : </span> 500 kb
									</div>
									<div class="form-row">
										<span>Dimension : </span> 300x400
									</div>
								</div>
								<div class="media-form">
									<div class="form-row">
										<span class="label">Url</span>
										<div class="form-item">
											<a href="https://www.pinterest.com/pin/140244975875642">https://www.pinterest.com/pin/140244975875642</a>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Title</span>
										<div class="form-item">
											<input type="text" placeholder="IMG 2">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Caption</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Alt Text</span>
										<div class="form-item">
											<input type="text">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Description</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Uploaded By</span>
										<div class="form-item">
											<span class="upload-name">Seller 1</span>
										</div>
									</div>
								</div>
								<div class="media-footer">
									<div class="form-row">
										<span class="label">Delete Permanently</span>
										<div class="form-item">
											<button class="btn-md btn-skyblue">Update</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item row"> 
							<div class="col-sm-5 media-detail-img">
								<img src="http://lorempixel.com/600/400/nature/4" alt="item3">
							</div>
							<div class="col-sm-7">
								<div class="media-img-deatail">
									<div class="form-row">
										<span>File Type : </span> Photo001.Jpg
									</div>
									<div class="form-row">
										<span>Uploaded On : </span> Image/Jpg
									</div>
									<div class="form-row">
										<span>File Name : </span> Aug 26 2016
									</div>
									<div class="form-row">
										<span>File Size : </span> 500 kb
									</div>
									<div class="form-row">
										<span>Dimension : </span> 300x400
									</div>
								</div>
								<div class="media-form">
									<div class="form-row">
										<span class="label">Url</span>
										<div class="form-item">
											<a href="https://www.pinterest.com/pin/140244975875642">https://www.pinterest.com/pin/140244975875642</a>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Title</span>
										<div class="form-item">
											<input type="text" placeholder="IMG 2">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Caption</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Alt Text</span>
										<div class="form-item">
											<input type="text">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Description</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Uploaded By</span>
										<div class="form-item">
											<span class="upload-name">Seller 1</span>
										</div>
									</div>
								</div>
								<div class="media-footer">
									<div class="form-row">
										<span class="label">Delete Permanently</span>
										<div class="form-item">
											<button class="btn-md btn-skyblue">Update</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item row"> 
							<div class="col-sm-5 media-detail-img">
								<img src="http://lorempixel.com/600/400/nature/4" alt="item3">
							</div>
							<div class="col-sm-7">
								<div class="media-img-deatail">
									<div class="form-row">
										<span>File Type : </span> Photo001.Jpg
									</div>
									<div class="form-row">
										<span>Uploaded On : </span> Image/Jpg
									</div>
									<div class="form-row">
										<span>File Name : </span> Aug 26 2016
									</div>
									<div class="form-row">
										<span>File Size : </span> 500 kb
									</div>
									<div class="form-row">
										<span>Dimension : </span> 300x400
									</div>
								</div>
                                
								<div class="media-form">
									<div class="form-row">
										<span class="label">Url</span>
										<div class="form-item">
											<a href="https://www.pinterest.com/pin/140244975875642">https://www.pinterest.com/pin/140244975875642</a>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Title</span>
										<div class="form-item">
											<input type="text" placeholder="IMG 2">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Caption</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Alt Text</span>
										<div class="form-item">
											<input type="text">
										</div>
									</div>
									<div class="form-row">
										<span class="label">Description</span>
										<div class="form-item">
											<textarea></textarea>
										</div>
									</div>
									<div class="form-row">
										<span class="label">Uploaded By</span>
										<div class="form-item">
											<span class="upload-name">Seller 1</span>
										</div>
									</div>
								</div>
								
                                <div class="media-footer">
									<div class="form-row">
										<span class="label">Delete Permanently</span>
										<div class="form-item">
											<button class="btn-md btn-skyblue">Update</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php */?>
                        
						<!--end carousel-inner--></div>
						<!--Begin Previous and Next buttons-->
						<a class="left carousel-control" href="#myGallery" role="button" data-slide="prev"> 
							<span class="icon-arrow-left2">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
              </span>
            </a> 
            <a class="right carousel-control" href="#myGallery" role="button" data-slide="next"> 
            	<span class="icon-arrow-right2">
              	<span class="path1"></span><span class="path2"></span><span class="path3"></span>
              </span>
            </a>
				</div><!--end carousel-->
			</div><!--end modal-body-->
		</div><!--end modal-content-->
	</div><!--end modal-dialoge-->
</div><!--end myModal-->

<?php echo '
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dd.min.js"></script>
<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/seller-custom.js"></script>
'; ?>

<style type="text/css">
.mm-loader{
	height:50px;
	width:100px;
}
</style>

<script type="text/javascript">
function loader(x){
	$(x).html('<li><img src="/froala_editor1/img/loader.gif" class="mm-loader"></li>');
}
var uPath = '<?php echo $user_folder; ?>',iself;
window.userFolderDefaultPath = uPath;
var MediaManager = function(){
	this.IMGCONT = '#mm-images-ul',this.FolderTree='#mm-folders-tree-ul',this.galleryCONT='#myGallery .carousel-inner',this.cPath=uPath,iself=this;
}

MediaManager.prototype.getImages = function(){
	loader(this.IMGCONT);
	$.get('api/load_images.php','folder='+this.cPath,function (data){
		d = JSON.parse(data);
		if(d.status=='success'){ iself.loadImage(d.data); }else{ console.log('Error: '.d.message); }
	});
}

MediaManager.prototype.loadImage = function(d){
	var html=html2='',s;
	for(i=0;i<d.length;i++){
		s = d[i]; active = (i==0)?'active':'';
		html+='<li data-toggle="modal" data-target="#mediaModal" data-id="#mediaModal'+i+'"><a href="#mediaGallery" class="media-product-img"><img src="'+s.url+'" alt="'+s.name+'"><span class="check-wrapper"><input id="media-check'+i+'" class="checkbox" type="checkbox"><label for="media-check'+i+'" class="checkbox-label"></label></span></a></li>';
		
		html2 +='<div class="item row '+active+'" id="mediaModal'+i+'"><div class="col-sm-5 media-detail-img"><img src="'+s.url+'" alt="item3"></div><div class="col-sm-7"><div class="media-img-deatail"><div class="form-row"><span>File Type : </span> '+s.filetype+'</div><div class="form-row"><span>Uploaded On : </span> '+s.uploaded+'</div><div class="form-row"><span>File Name : </span> '+s.name+'</div><div class="form-row"><span>File Size : </span> '+s.filesize+'</div><div class="form-row"><span>Dimension : </span> '+s.dimension+'</div></div><div class="media-form"><div class="form-row"><span class="label">Url</span><div class="form-item"><a href="'+s.url+'">'+s.url+'</a></div></div></div><div class="media-footer"><div class="form-row"><div class="form-item"><button class="btn-md btn-skyblue del_btn" data-url="'+s.url+'">Delete</button></div></div></div></div></div>';
	}
	$(iself.IMGCONT).html(html);
	$(iself.galleryCONT).html(html2);
}
MediaManager.prototype.getFolders = function(){
	this.loader(this.IMGCONT);
	$.get('api/load_folders.php','folder='+this.cPath,function (data){
		iself.loadFolders(data);
	});
}

MediaManager.prototype.loadFolders = function(r){
	var html='',s,d = JSON.parse(r);
	if(d.status=='success'){
		return false;
		for(i=0;i<d.data.length;i++){
			s = d.data[i];
			
			html+='<li data-toggle="modal"><a href="#mediaGallery" data-type="folder" data-uploaded-on="12-23-2010" data-name="filename" data-size="23kb" data-dimension="300x233" class="media-product-img"><img src="'+s.url+'" alt="'+s.name+'"><span class="check-wrapper"><input id="media-check18" class="checkbox" type="checkbox"><label for="media-check18" class="checkbox-label"></label></span></a></li>';
		}
		$(iself.IMGCONT).html(html);
		
	}else{
		console.log('Error: '.d.message);
	}
}

MediaManager.prototype.uploadFile1 = function(){
	if (window.FileReader) {
		// FileReader are supported.
		var file = document.getElementById('upload_file_input').files[0];
		
		var reader = new FileReader();
		// Handle errors load
		reader.onload = function(evt){
			var csv = evt.target.result;
			alert('loaded');
			$('body').append('<img src="'+csv+'">');
		};
		reader.onerror = function(evt){
			if(evt.target.error.name == "NotReadableError") {
				alert("Canno't read file !");
			}
		};
		reader.readAsText(file);
		
	} else {
		alert('FileReader are not supported in this browser.');
	}
}
MediaManager.prototype.appendIMG = function(s){

	var html = '<li data-toggle="modal" data-target="#mediaModal'+i+'"><a href="#mediaGallery" class="media-product-img"><img src="'+s.url+'" alt="'+s.name+'"><span class="check-wrapper"><input id="media-check18" class="checkbox" type="checkbox"><label for="media-check18" class="checkbox-label"></label></span></a></li>';
	
	var html2 = '<div class="item row" id="mediaModal'+$(iself.galleryCONT).find('.item').length+'"><div class="col-sm-5 media-detail-img"><img src="'+s.url+'" alt="item3"></div><div class="col-sm-7"><div class="media-img-deatail"><div class="form-row"><span>File Type : </span> '+s.filetype+'</div><div class="form-row"><span>Uploaded On : </span> '+s.uploaded+'</div><div class="form-row"><span>File Name : </span> '+s.name+'</div><div class="form-row"><span>File Size : </span> '+s.filesize+'</div><div class="form-row"><span>Dimension : </span> '+s.dimension+'</div></div><div class="media-form"><div class="form-row"><span class="label">Url</span><div class="form-item"><a href="'+s.url+'">'+s.url+'</a></div></div></div><div class="media-footer"><div class="form-row"><div class="form-item"><button class="btn-md btn-skyblue del_btn" data-url="'+s.url+'">Delete</button></div></div></div></div></div>';
	
	$(iself.IMGCONT).prepend(html);
	
	$(iself.galleryCONT).prepend(html2);
	
}
MediaManager.prototype.uploadFile = function(){
	file = document.getElementById('upload_file_input').files[0];
	var data = new FormData();
    data.append('file', file);
	
	$.ajax({
        url: 'api/upload_image.php?upload_file&folder='+this.cPath,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
            d = JSON.parse(data);
			if(d.status=='success'){
				iself.appendIMG(d.data);
			}else{
				alert(d.message);
			}
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });
	
	
}

MediaManager.prototype.deleteFile = function(src,el){
	$.get('api/delete_api.php?type=file&src='+src,function(data){ $('.close').click(); $(el).remove(); $('[data-id="'+el+'"]').remove(); });
}


var MM;
$(document).ready(function(e) {
    MM =  new MediaManager();
	//MM.getImages();
	//MM.getFolders();
	$(document).on('click','li[data-target]',function(){
		var id = $(this).attr('data-id');
		$(MM.galleryCONT).find('.item').removeClass('active');
		$(id).addClass('active');
		return false;
	});
	
	
	$('#upload_file_input').change(function(event){
		MM.uploadFile();
	});
	
	$(document).on('click','.del_btn',function(){
		if(confirm('Are you sure? to delete the file!')){
			MM.deleteFile($(this).attr('data-url'),'#'+$(this).closest('.item.row').attr('id'));
		}
	});
	
});

</script>
<script type="text/javascript" src="sdk/fb-insta-sdk.js"></script>

</body>
</html>
