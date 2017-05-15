
/*

	1) For Advance setting option of Catelog page

==============================================================*/



jQuery(document).ready(function(){

	var winWidht = jQuery(window).width();
	var winHeight = jQuery(window).height();


	// For leftSidebar

	jQuery('.nav-side-list > li ').click(function() {		
		jQuery('.nav-side-list > li').removeClass('expand current');
		jQuery(this).addClass('expand');
	});

	var smenuHt = jQuery('.nav-side-list').height()-62;
	var menuHt = jQuery('.submenu-parent').height();
	
	if(smenuHt>winHeight) {
		jQuery('.nav-side-list').height(winHeight);
	}
	if(menuHt>winHeight) {
		jQuery('.submenu-parent').height(winHeight);
	}


	// 1) For Advance setting option of Catelog page

	 jQuery('.close-variant').click(function(){
	 	jQuery(this).parent('.variant-option').hide();
	 });

	jQuery('#choose-variant').on('change', function() {
		var variant_value = this.value;

		if(variant_value == 'color' || variant_value == 'size') {
			jQuery('.variant-size-container').addClass('show');
		}
		else{
			jQuery('.variant-size-container').removeClass('show');
		}

	});

		// Add another row

	jQuery('.add-another-variant').click(function(){
		 jQuery('.variant-option').clone().insertAfter(".variant-option");
	});

	jQuery('.add-variant-size-btn').click(function(){
		jQuery('.add-variant-row').show(100);
	});

	jQuery('.close-another-variant').click(function(){
	 	jQuery('.add-variant-row').hide();
	});
		

	// For Config page

	/* landingpage-infohide */

	jQuery('.land-pageinfo input').click(function(){
		if(jQuery('#landingpage-infohide').is(':checked')){
			jQuery('.landing-info-tab').hide(100);
		}
		else{
			jQuery('.landing-info-tab').show(100);
		}
	});

	/* close box in user page  */

	jQuery('.tuser-box .close').click(function(){
		jQuery(this).parents('.tuser-box').hide(100);
	});

	/* show check uncheck in payment method page */

	jQuery('.onoffswitch input[type="checkbox"]').click(function(){
		jQuery(this).parents('.payment-header').toggleClass('active');
    if(jQuery(this).is(":checked")){
      jQuery(this).parents('.payment-header').siblings('.payment-field').show(500);
    }
    else if(jQuery(this).is(":not(:checked)")){
      jQuery(this).parents('.payment-header').siblings('.payment-field').hide(500);
    }
  });


	/*  Add class in media page */

	jQuery('.bulk-select').click(function(){
		jQuery('.check-wrapper').toggleClass('show');
	});

	jQuery('.view-list-icon .list-view').click(function(){
		jQuery('.media-list-item').addClass('list-view');
	});
	jQuery('.view-list-icon .grid-view').click(function(){
		jQuery('.media-list-item').removeClass('list-view');
	});

	// For Tree menu

	jQuery(function () {
    jQuery('.tree li:has(ul)').addClass('parent_li').find(' > a .menuIcon').attr('title', 'Collapse');
    jQuery('.tree li.parent_li > a .menuIcon').on('click', function (e) {
    		e.preventDefault();
        var children = jQuery(this).parent().parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            jQuery(this).attr('title', 'Expand').addClass('glyphicon-plus').removeClass('glyphicon-minus');
        } else {
            children.show('fast');
            jQuery(this).attr('title', 'Collapse').addClass('glyphicon-minus').removeClass('glyphicon-plus');
        }
        e.stopPropagation();
    });
	});

	// Hide history
	
	jQuery('.hideHistory').click(function(){
		jQuery('.history-list').slideToggle();
		if(jQuery(this).text() == 'Hide History'){
		  jQuery(this).text('Show History');
		} 
		else {
		  jQuery(this).text('Hide History');
		}		
	});




});