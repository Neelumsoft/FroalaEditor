
/*

	1) For Sidebar left Menu
	2) For Sidebar fixed bottom
	3) For Equal height in login page

===============================*/


jQuery(document).ready(function(){

	var winWidht = jQuery(window).width();
	var winHeight = jQuery(window).height();

	
	// For File Upload

	   //Custom upload_______________________________________________
	   
			jQuery('.custom-upload input[type=file]').change(function(){
		    	var filename = jQuery('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
		    	jQuery(this).next().find('input').val(filename);
			});



	function uploadFile(target) {
		document.getElementById("attach").innerHTML = target.files[0].name;
	}
	
	// 2) For Sidebar fixed bottom
	
	jQuery('.order-bottom-slide').click(function() {
		jQuery(this).toggleClass("glyphicon-menu-up");
		jQuery('.sidebar-fixed-slide').slideToggle();
	});
	//

	jQuery('.header-top .h-shop-card').click(function(){
		jQuery('.cart-dropdown-wrap').fadeIn();
		jQuery('.cart-dropdown').animate({
			 right:'0px'	 
		});
		jQuery('.cart-dropdown').addClass('open');		 
	});
	jQuery('.cart-dropdown .icon-Close').click(function(){
		jQuery('.cart-dropdown-wrap').fadeOut();
		jQuery('.cart-dropdown').animate({
			 right:'-425px'	 
		});	
	});

	// 3) For Equal height in login page

	jQuery('#adv-setting').click(function(){
    var isChecked = jQuery('#adv-setting').is(':checked');
    if(isChecked)
      jQuery('.advance-setting-option').show('slow');
    else
     jQuery('.advance-setting-option').hide('slow');
  });

	// 	
	jQuery('.count').each(function() {
    var jQuerythis = jQuery(this);
    jQuery({Counter: 0}).animate({Counter: jQuerythis.text()}, {
      duration: 1500,
      easing: 'swing',
      step: function() {
          var num = Math.ceil(this.Counter).toString();
          if(Number(num) > 999){
             while (/(\d+)(\d{3})/.test(num)) {
              num = num.replace(/(\d+)(\d{3})/, '' + ',' + ' ');
            }
          }
          jQuerythis.text(num);
      }
    });
  });

  jQuery('.count').each(function() {
    var jQuerythis = jQuery(this);
    jQuery({Counter: 0}).animate({Counter: jQuerythis.text()}, {
      duration: 1500,
      easing: 'swing',
      step: function() {
          var num = Math.ceil(this.Counter).toString();
          if(Number(num) > 999){
             while (/(\d+)(\d{3})/.test(num)) {
              num = num.replace(/(\d+)(\d{3})/, 'jQuery1' + ',' + 'jQuery2');
            }
          }
          jQuerythis.text(num);
      }
    });
  });




	// close dropdown

	jQuery('.close').click(function(){
		jQuery(this).parent('.dropdown-menu').hide();
	});

	// click class add

	jQuery('.like span, .review-like').click(function(){
		jQuery(this).toggleClass('like');
	});

	// Back to Top

	jQuery(function(){    
		jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() >200) {
			jQuery('a.top-page').fadeIn();} 
		else {
			jQuery('a.top-page').fadeOut();}
		})
	 	jQuery("a.top-page").click(function() {
	  	jQuery("html, body").animate({scrollTop: 0}, "slow");
	  	return false;
		});
	});
	//


// zoom slide 

	var pos, slides;
	pos= slides=jQuery("#gallery_01 li").length;
  jQuery("#gallery_01 .next").click(function() {
      if(pos>3){
          jQuery(".gallery-thumb").stop(true, true).animate({left: "-=190px"}, 500);pos--;
      }
  });
  jQuery("#gallery_01 .prev").click(function() {
      if(pos<slides){jQuery(".gallery-thumb").stop(true, true).animate({left: "+=191px"}, 500);pos++;}
  });

  var pos2, slide2;
  pos2 = slide2 = jQuery('.video-gallery li').length;
  jQuery(".video-gallery .next").click(function() {
      if(pos2>3){
          jQuery(".video-gallery-thumb").stop(true, true).animate({left: "-=190px"}, 500);pos2--;
      }
  });
  jQuery(".video-gallery .prev").click(function() {
      if(pos2<slide2){jQuery(".video-gallery-thumb").stop(true, true).animate({left: "+=191px"}, 500);pos2++;}
  });



// For left sidebar shop page

	var leftSide = jQuery('.left-sidebar').height();

	leftsp = leftSide - winHeight;  
	
	if(winWidht>767) {
		// jQuery('.left-sidebar').height(winHeight);

		jQuery(function(){    
			jQuery(window).scroll(function(){
			if (jQuery(this).scrollTop() >leftsp) {

				jQuery('.left-sidebar').addClass('sider-fixed');
				jQuery('.left-sidebar').css('top','-leftsp');
			} 
			else {
				jQuery('.left-sidebar').removeClass('sider-fixed');}
			})
		});
	}

	jQuery('.menu .glyphicon-menu-right').click(function(){
		jQuery(this).toggleClass('glyphicon-menu-down');
		jQuery(this).siblings('.submenu-category').slideToggle();
	});

	// For Cart expand button

	jQuery('.cart-table .expand').on('click',function(){
		if(jQuery(this).hasClass('shrink')){
			jQuery(this).removeClass('shrink');
			jQuery(this).html('Expand All');
			jQuery(this).siblings('.cart-item-container').animate({ "max-height": 400}, 500);
		}
		else {
			jQuery(this).addClass('shrink');
			jQuery(this).siblings('.cart-item-container').animate({ "max-height": 2000}, 1000);
			jQuery(this).html('Shrink');	
		}
	});


	// For bank transfer radio

	jQuery(".select-shipping .radio").change(function () {
	  if (jQuery("#bank-transfer").prop("checked")) {
	    jQuery('.bank-list').slideDown();
	  }
	  else {
	    // jQuery('#r1edit:input').attr('disabled', true);
	    jQuery('.bank-list').slideUp();
	  }
	});

	// Delete cart row


	jQuery('.delete-cart-item').click(function(){
		jQuery(this).parents('.cart-item-list').hide();
	});
	jQuery('.cart-box .icon-remove').click(function(){
		jQuery(this).parent('.cart-box').hide();
	});


	//   For Filter dropdown 

	jQuery(function(){
		jQuery(".dropdown-menu > li > a.trigger").on("click",function(e){
			var current=jQuery(this).next();
			var grandparent=jQuery(this).parent().parent();
			if(jQuery(this).hasClass('left-caret')||jQuery(this).hasClass('right-caret'))
				jQuery(this).toggleClass('right-caret left-caret');
			grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
			grandparent.find(".sub-menu:visible").not(current).hide();
			current.toggle();
			e.stopPropagation();
		});
		jQuery(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
			var root=jQuery(this).closest('.dropdown');
			root.find('.left-caret').toggleClass('right-caret left-caret');
			root.find('.sub-menu:visible').hide();
		});
	});


	// 
	
	jQuery('.select-lang li').click(function(){
		jQuery('.select-lang li').removeClass('active');
		jQuery(this).addClass('active');
	});

	// For popup hide show

	jQuery('.addBoard').click(function(){
		jQuery('.new-board-pane').animate({
			'right':25
		});
	});
	jQuery('.new-board-pane .closeBoard').click(function(){
		jQuery('.new-board-pane').animate({
			'right':-350
		});
	});

	


	// For language select box

	 //jQuery(".select-lang select").msDropdown({roundedBorder:false});

	//

	var Event_Type = 'ontouchend' in document ? 'touchend' : 'click';
	jQuery(document).on(Event_Type, 'div.qty-form-input i', function(event) {
		event.preventDefault();
		var textVal = 0;
		if (jQuery(this).hasClass('glyphicon-triangle-top')) {
			textVal = parseInt(jQuery('div.qty-form-input #quantity').val());
			var maxVal = parseInt(jQuery('div.qty-form-input #quantity').attr('max'));
			if (textVal < maxVal) {
				textVal++;
				jQuery('div.qty-form-input #quantity').val(textVal);
			}
		} else if (jQuery(this).hasClass('glyphicon-triangle-bottom')) {
			textVal = parseInt(jQuery('div.qty-form-input #quantity').val());
			var minVal = parseInt(jQuery('div.qty-form-input #quantity').attr('min'));
			if (textVal > minVal) {
				textVal--;
				jQuery('div.qty-form-input #quantity').val(textVal);
			}
		}
	})

	// choosen

	 // jQuery('.select').chosen();





});


