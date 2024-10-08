var root_path_url = "http";
jQuery(document).ready(function($) {
	root_path_url = $('link[rel="start"]').attr("href") + "/";
});

function is_touch_device() {
  return !!('ontouchstart' in window);
}


/**
 * Switches backend forms based on drop down selection.
 */
jQuery(document).ready(function($) {

	// Runs when form design select list changes.
	$("#optinforms_form_design").change(function() {

		// Hides all design specific options.
		$('#optinforms-design-backend-wrap > div').css('display', 'none');

		// Displays only the options corresponding with the chosen form.
		$('#' + this.value).css('display', 'block');
	});
});



/***************************************************
	     TOGGLE STYLE
***************************************************/
jQuery(document).ready(function($) {

	$(".toggle-container").hide();
	$(document).on( 'click', '.trigger', function(){
		$(this).toggleClass('active');
		$(this).next(".toggle-container").slideToggle();
	});
});

/***************************************************
	     ACCORDION
***************************************************/
jQuery(document).ready(function($){
	$(document).on( 'click', '.trigger-button', function(){
		$(".trigger-button").removeClass("active")
	 	$('.accordion').slideUp('normal');
		if($(this).next().is(':hidden') == true) {
			$(this).next().slideDown('normal');
			$(this).addClass("active");
		 }
	 });
	$('.accordion').hide();
});


/***************************************************
	  Check path
***************************************************/

jQuery(document).ready(function($){

	$('.check_path').each(function(){
		var icon_path = $(this).attr("src");
		if (icon_path.substr(0, 10) == "wp-content") {
			$(this).attr("src", root_path_url + ""+ icon_path);
		}
	});
});


/**
 * Tabs
 */

jQuery(document).ready(function($){

	function activateTab( tabID ) {
		$(tabID).show().siblings('.tabcontent').hide();
	}

	$('.shadetabs').each(function(){

		let active = $(this).find('a.selected');

		if ( active.length ) {
			let activeID = '#' + active.attr('rel');
			activateTab( activeID );
		}

	});

	$(document).on( 'click', '.shadetabs a', function(e){

		e.preventDefault();

		$(this).closest('.shadetabs').find('.selected').removeClass('selected');
		$(this).addClass('selected');

		let activeID = '#' + $(this).attr('rel');
		activateTab( activeID );

	});

});

