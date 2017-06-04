
/*

	1) For Advance setting option of Catelog page

==============================================================*/

$(document).ready(function(){

	var winWidht = $(window).width();
	var winHeight = $(window).height();


	// For leftSidebar

	$(document).on('click','.nav-side-list > li ',function() {	
		$('.nav-side-list > li').removeClass('expand current');
		$(this).addClass('expand');
	});

	var smenuHt = $('.nav-side-list').height()-62;
	var menuHt = $('.submenu-parent').height();
	
	if(smenuHt>winHeight) {
		$('.nav-side-list').height(winHeight);
	}
	if(menuHt>winHeight) {
		$('.submenu-parent').height(winHeight);
	}


	

	// 1) For Advance setting option of Catelog page

	 $(document).on('click','.close-variant',function(){
	 	$(this).parent('.variant-option').hide();
	 });

	$(document).on('change','#choose-variant', function() {
		var variant_value = this.value;

		if(variant_value == 'color' || variant_value == 'size') {
			$('.variant-size-container').addClass('show');
		}
		else{
			$('.variant-size-container').removeClass('show');
		}

	});

		// Add another row

	$(document).on('click','.add-another-variant',function(){
		 $('.variant-option').clone().insertAfter(".variant-option");
	});

	$(document).on('click','.add-variant-size-btn',function(){
		$('.add-variant-row').show(100);
	});

	$(document).on('click','.close-another-variant',function(){
	 	$('.add-variant-row').hide();
	});
		

	// For Config page

	/* landingpage-infohide */

	$(document).on('click','.land-pageinfo input',function(){
		if($('#landingpage-infohide').is(':checked')){
			$('.landing-info-tab').hide(100);
		}
		else{
			$('.landing-info-tab').show(100);
		}
	});

	/* close box in user page  */

	$(document).on('click','.tuser-box .close',function(){
		$(this).parents('.tuser-box').hide(100);
	});

	/* show check uncheck in payment method page */

	$(document).on('click','.onoffswitch input[type="checkbox"]',function(){
		$(this).parents('.payment-header').toggleClass('active');
    if($(this).is(":checked")){
      $(this).parents('.payment-header').siblings('.payment-field').show(500);
    }
    else if($(this).is(":not(:checked)")){
      $(this).parents('.payment-header').siblings('.payment-field').hide(500);
    }
  });


	/*  Add class in media page */

	$(document).on('click','.bulk-select',function(){
		$('.check-wrapper').toggleClass('show');
	});

	$(document).on('click','.view-list-icon .list-view',function(){
		$('.media-list-item').addClass('list-view');
	});
	$(document).on('click','.view-list-icon .grid-view',function(){
		$('.media-list-item').removeClass('list-view');
	});

	// For Tree menu

	$(document).on('click','.tree li.parent_li > a .menuIcon',function (e) {
    		e.preventDefault();
        var children = $(this).parent().parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand').addClass('glyphicon-plus').removeClass('glyphicon-minus');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse').addClass('glyphicon-minus').removeClass('glyphicon-plus');
        }
        e.stopPropagation();
    });
	
	//setting left tree
	
	$('.tree li:has(ul)').addClass('parent_li').find(' > a .menuIcon').attr('title', 'Collapse');

	// Hide history
	
	$(document).on('click','.hideHistory',function(){
		$('.history-list').slideToggle();
		if($(this).text() == 'Hide History'){
		  $(this).text('Show History');
		} 
		else {
		  $(this).text('Hide History');
		}		
	});




});