<?php

// Set global variables
	$optinforms_email_solution = get_option('optinforms_email_solution');

	$optinforms_form_action_mailchimp = get_option('optinforms_form_action_mailchimp');
	$optinforms_form_action_mailerlite = get_option('optinforms_form_action_mailerlite');
	$optinforms_form_action_madmimi = get_option('optinforms_form_action_madmimi');
	$optinforms_form_action_interspire = get_option('optinforms_form_action_interspire');

	$optinforms_form_list_name_aweber = get_option('optinforms_form_list_name_aweber');
	$optinforms_form_redirect_aweber = get_option('optinforms_form_redirect_aweber');
	$optinforms_form_listid_icontact = get_option('optinforms_form_listid_icontact');
	$optinforms_form_specialid_icontact = get_option('optinforms_form_specialid_icontact');
	$optinforms_form_clientid_icontact = get_option('optinforms_form_clientid_icontact');
	$optinforms_form_redirect_icontact = get_option('optinforms_form_redirect_icontact');
	$optinforms_form_error_icontact = get_option('optinforms_form_error_icontact');
	$optinforms_form_webformid_getresponse = get_option('optinforms_form_webformid_getresponse');
	$optinforms_form_name_field_interspire = get_option('optinforms_form_name_field_interspire');
        $optinforms_form_id_convertkit = get_option('optinforms_form_id_convertkit');
        $optinforms_form_user_id_convertkit = get_option('optinforms_form_user_id_convertkit');
        $optinforms_form_success_convertkit = get_option('optinforms_form_success_convertkit');
        $optinforms_form_error_convertkit = get_option('optinforms_form_error_convertkit');

	$optinforms_included_fonts = array ( "Default", "Arial", "Baumans", "Belgrano", "Chewy", "Cinzel Decorative", "Coming Soon", "Contrail One", "Damion", "Dancing Script", "Droid Sans", "Droid Serif", "Englebert", "Fenix", "Flavors", "Fredoka One", "Georgia", "Gloria Hallelujah", "Gochi Hand", "Grand Hotel", "Helvetica", "Lobster", "Luckiest Guy", "Marcellus SC", "News Cycle", "Nixie One", "Oleo Script", "Open Sans", "Oswald", "Overlock SC", "Pacifico", "Parisienne", "Quicksand", "Racing Sans One", "Roboto Condensed", "Russo One", "Sanchez", "Shadows Into Light", "Share Tech", "Signika Negative", "Tahoma", "Times New Roman", "Titan One", "Unkempt", "Verdana", "Viga");
	$optinforms_included_fonts_simple = array ( "Default", "Arial, Helvetica, sans-serif", "Times New Roman, Times, serif", "Tahoma, Geneva, sans-serif", "Courier New, Courier, monospace", "Georgia, Times New Roman, Times, serif", "Trebuchet MS, Arial, sans-serif", "Verdana, Geneva, sans-serif", "Palatino Linotype, Book Antiqua, serif");

	$optinforms_form_design = get_option('optinforms_form_design');
	$optinforms_form_placement_post = get_option('optinforms_form_placement_post');
	$optinforms_form_placement_page = get_option('optinforms_form_placement_page');
	$optinforms_form_placement_popup = get_option('optinforms_form_placement_popup');
	$optinforms_form_placement_box = get_option('optinforms_form_placement_box');
	$optinforms_form_placement_bar = get_option('optinforms_form_placement_bar');
	$optinforms_form_exclude_posts = get_option('optinforms_form_exclude_posts');
	$optinforms_form_exclude_pages = get_option('optinforms_form_exclude_pages');
	$optinforms_powered_by = get_option('optinforms_powered_by');
	$optinforms_form_target = get_option('optinforms_form_target');


// Add tabs for main page
function optinforms_menu_tabs() {
	echo "<ul id=\"optinforms-menu-tabs\" class=\"shadetabs\">
			<li><a href=\"#\" rel=\"optinforms-email-solution-tab\" class=\"selected\">" . __('Email Solution', 'optin-forms') . "</a></li>
			<li><a href=\"#\" rel=\"optinforms-posts-tab\">" . __('Form', 'optin-forms') . "</a></li>
		</ul>
		<div class=\"clear\"></div>";
}

// Define an email solution
function optinforms_get_email_solution() {
	global $optinforms_email_solution;
	if(empty($optinforms_email_solution)) {
		$optinforms_email_solution = "optinforms_email_solution_option1";
	}
	return $optinforms_email_solution;
}

// Anything we need to display before the <form> tag
function optinforms_before_form() {
	
	global $optinforms_email_solution;

	if(empty($optinforms_email_solution)) {
		return;
	}
	
	if($optinforms_email_solution == 'optinforms_email_solution_option7') {
		return "<div id=\"ck_success_msg\" style=\"display:none;\"><p>" . esc_html( optinforms_form_get_success_convertkit() ) . "</p></div>";
	}

}

// Add our form action
function optinforms_get_form_action() {
	global $optinforms_email_solution;
	if(empty($optinforms_email_solution)) {
		// do nothing
	}
	// add Aweber form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option1') {
		return "https://www.aweber.com/scripts/addlead.pl";
	}
	// add iContact form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option2') {
		return optinforms_form_action_icontact();
	}
	// add Mailchimp form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option3') {
		return optinforms_form_action_mailchimp();
	}
	// add GetResponse form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option4') {
		return "https://app.getresponse.com/add_subscriber.html";
	}
	// add Mad Mimi form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option5') {
		return optinforms_form_action_madmimi();
	}
	// add Interspire form action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option6') {
		return optinforms_form_action_interspire();
	}
    // add Convertkit action
	elseif($optinforms_email_solution == 'optinforms_email_solution_option7') {
		return optinforms_form_action_convertkit();
	}
	// add mailerlite
	elseif($optinforms_email_solution == 'optinforms_email_solution_option8') {
		return optinforms_form_action_mailerlite();
	}
}

// Add our form action
function optinforms_form_action_appendix() {
	
	global $optinforms_email_solution;
	
	if(empty($optinforms_email_solution)) {
		return;
	}
	
	if($optinforms_email_solution == 'optinforms_email_solution_option7') {
        return 'data-sv-form="' . esc_attr( optinforms_form_id_convertkit() ) . '" data-uid="' . esc_attr( optinforms_form_user_id_convertkit() ) . '" data-version="5" data-options="{&quot;settings&quot;:{&quot;after_subscribe&quot;:{&quot;action&quot;:&quot;message&quot;,&quot;redirect_url&quot;:&quot;&quot;,&quot;success_message&quot;:&quot;Success! Now check your email to confirm your subscription.&quot;},&quot;return_visitor&quot;:{&quot;action&quot;:&quot;show&quot;,&quot;custom_content&quot;:&quot;&quot;},&quot;recaptcha&quot;:{&quot;enabled&quot;:false}}}" min-width="400 500 600 700 800"';
	}

}

// MailChimp form action
function optinforms_form_action_mailchimp() {
	global $optinforms_form_action_mailchimp;
	if(empty($optinforms_form_action_mailchimp)) {
		$optinforms_form_action_mailchimp = "";
	} else {
		// Let's check whether user has entered entire MailChimp HTML code
		if (strpos($optinforms_form_action_mailchimp, 'Begin MailChimp Signup Form') !== false) {
    		// if yes, strip it to get just the URL
			preg_match('|form action="([^"]*?)" method="post" id="mc-embedded-subscribe-form"|i', $optinforms_form_action_mailchimp, $matches);
			$optinforms_mailchimp_html_code = $matches[1];
			// Output our link and replace & with &amp; to keep it HTML5
			$optinforms_form_action_mailchimp = str_replace("&", "&amp;", $optinforms_mailchimp_html_code);
		} else {
			// do nothing
		}
	}
	return $optinforms_form_action_mailchimp;
}

// MailChimp form action
function optinforms_form_action_icontact() {
	$special_id = optinforms_form_specialid_icontact();
	$list_id = optinforms_form_listid_icontact();
	$client_id = optinforms_form_clientid_icontact();
	return 'https://app.icontact.com/icp/core/mycontacts/signup/designer/form/?id=' . $special_id . '&cid=' . $client_id . '&lid=' . $list_id;
}

// Mailerlite form action
function optinforms_form_action_mailerlite() {
	global $optinforms_form_action_mailerlite;
	if(empty($optinforms_form_action_mailerlite)) {
		$optinforms_form_action_mailerlite = "";
	}
	return $optinforms_form_action_mailerlite;
}

// Convertkit form action
function optinforms_form_action_convertkit() {
        return 'https://app.convertkit.com/forms/' . optinforms_form_id_convertkit() . '/subscriptions';
}

// Convertkit success message
function optinforms_form_get_success_convertkit() {
        global $optinforms_form_success_convertkit;
        if(empty($optinforms_form_success_convertkit)) {
		$optinforms_form_success_convertkit = "Success! Now check your email to confirm your subscription.";
	}
	return $optinforms_form_success_convertkit;
}

// Convertkit error message
function optinforms_form_get_error_convertkit() {
        global $optinforms_form_error_convertkit;
        if(empty($optinforms_form_error_convertkit)) {
		$optinforms_form_error_convertkit = "There was an error submitting your subscription. Please try again.";
	}
	return $optinforms_form_error_convertkit;
}

// Mad Mimi form action
function optinforms_form_action_madmimi() {
	global $optinforms_form_action_madmimi;
	if(empty($optinforms_form_action_madmimi)) {
		$optinforms_form_action_madmimi = "";
	}
	return $optinforms_form_action_madmimi;
}

// Interspire form action
function optinforms_form_action_interspire() {
	global $optinforms_form_action_interspire;
	if(empty($optinforms_form_action_interspire)) {
		$optinforms_form_action_interspire = "";
	}
	return $optinforms_form_action_interspire;
}

// Aweber list name
function optinforms_form_list_name_aweber() {
	global $optinforms_form_list_name_aweber;
	if(empty($optinforms_form_list_name_aweber)) {
		$optinforms_form_list_name_aweber = "";
	}
	return $optinforms_form_list_name_aweber;
}

// Aweber redirect URL
function optinforms_form_redirect_aweber() {
	global $optinforms_form_redirect_aweber;
	if(empty($optinforms_form_redirect_aweber)) {
		$optinforms_form_redirect_aweber = "";
	}
	return $optinforms_form_redirect_aweber;
}

// iContact list ID
function optinforms_form_listid_icontact() {
	global $optinforms_form_listid_icontact;
	if(empty($optinforms_form_listid_icontact)) {
		$optinforms_form_listid_icontact = "";
	}
	return $optinforms_form_listid_icontact;
}

// iContact special ID
function optinforms_form_specialid_icontact() {
	global $optinforms_form_specialid_icontact;
	if(empty($optinforms_form_specialid_icontact)) {
		$optinforms_form_specialid_icontact = "";
	}
	return $optinforms_form_specialid_icontact;
}

// iContact client ID
function optinforms_form_clientid_icontact() {
	global $optinforms_form_clientid_icontact;
	if(empty($optinforms_form_clientid_icontact)) {
		$optinforms_form_clientid_icontact = "";
	}
	return $optinforms_form_clientid_icontact;
}

// iContact redirect URL
function optinforms_form_redirect_icontact() {
	global $optinforms_form_redirect_icontact;
	if(empty($optinforms_form_redirect_icontact)) {
		$optinforms_form_redirect_icontact = "";
	}
	return $optinforms_form_redirect_icontact;
}

// iContact error URL
function optinforms_form_error_icontact() {
	global $optinforms_form_error_icontact;
	if(empty($optinforms_form_error_icontact)) {
		$optinforms_form_error_icontact = "";
	}
	return $optinforms_form_error_icontact;
}

// GetResponse webform ID
function optinforms_form_webformid_getresponse() {
	global $optinforms_form_webformid_getresponse;
	if(empty($optinforms_form_webformid_getresponse)) {
		$optinforms_form_webformid_getresponse = "";
	}
	return $optinforms_form_webformid_getresponse;
}

// Interspire name ID
function optinforms_form_name_field_interspire() {
	global $optinforms_form_name_field_interspire;
	if(empty($optinforms_form_name_field_interspire)) {
		$optinforms_form_name_field_interspire = "";
	}
	return $optinforms_form_name_field_interspire;
}

// Convertkit form ID
function optinforms_form_id_convertkit() {
	global $optinforms_form_id_convertkit;
	if(empty($optinforms_form_id_convertkit)) {
		$optinforms_form_id_convertkit = "";
	}
	return $optinforms_form_id_convertkit;
}

// converkit user id
function optinforms_form_user_id_convertkit() {

    global $optinforms_form_user_id_convertkit;
	if(empty($optinforms_form_user_id_convertkit)) {
		$optinforms_form_user_id_convertkit = "";
	}
	return $optinforms_form_user_id_convertkit;

}

// Open our form in a new window?
function optinforms_form_target_blank() {
	global $optinforms_form_target;
	if($optinforms_form_target == 1) {
		return "target=\"_blank\"";
	} else {
		//do nothing
	}
}

// Add our identifiers to the form
function optinforms_get_form_identifiers() {
	global $optinforms_email_solution;
	if(empty($optinforms_email_solution)) {
		return;
	}
	// add Aweber identifiers
	elseif($optinforms_email_solution == 'optinforms_email_solution_option1') {
		return "<input type=\"hidden\" name=\"listname\" value=\"" . esc_attr( optinforms_form_list_name_aweber() ) . "\" /><input type=\"hidden\" name=\"redirect\" value=\"" . esc_attr( optinforms_form_redirect_aweber() ) . "\" /><input type=\"hidden\" name=\"meta_message\" value=\"1\" />";
	}
	// add iContact identifiers
	elseif($optinforms_email_solution == 'optinforms_email_solution_option2') {
		return "<input type=\"hidden\" name=\"listid\" value=\"" . esc_attr( optinforms_form_listid_icontact() ) . "\"><input type=\"hidden\" name=\"specialid:" . esc_attr( optinforms_form_listid_icontact() ) . "\" value=\"" . esc_attr( optinforms_form_specialid_icontact() ) . "\"><input type=\"hidden\" name=\"clientid\" value=\"" . esc_attr( optinforms_form_clientid_icontact() ) . "\"><input type=\"hidden\" name=\"redirect\" value=\"" . esc_attr( optinforms_form_redirect_icontact() ) . "\"><input type=\"hidden\" name=\"errorredirect\" value=\"" . esc_attr( optinforms_form_error_icontact() ) . "\">";
	}
	// add GetResponse identifiers
	elseif($optinforms_email_solution == 'optinforms_email_solution_option4') {
		return "<input type=\"hidden\" name=\"campaign_token\" value=\"" . esc_attr( optinforms_form_webformid_getresponse() ) . "\" /><input type=\"hidden\" name=\"start_day\" value=\"0\" />";
	}
    // add Convertkit identifiers
	elseif($optinforms_email_solution == 'optinforms_email_solution_option7') {
		return "<input type=\"hidden\" name=\"id\" value=\"" . esc_attr( optinforms_form_id_convertkit() ) . "\" id=\"landing_page_id\" />
                    <div class=\"ck_errorArea\"><div id=\"ck_error_msg\" style=\"display:none\"><p>" . esc_attr( optinforms_form_get_error_convertkit() ) . "</p></div></div>
";
	} elseif ( $optinforms_email_solution == 'optinforms_email_solution_option8' ) {
		return '<input type="hidden" name="ml-submit" value="1">';
	}
}

// Define our name field
function optinforms_get_name_field() {
	global $optinforms_email_solution;
	if(empty($optinforms_email_solution)) {
		return "name";
	}
	// define Aweber name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option1') {
		return "name";
	}
	// define iContact name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option2') {
		return "data[fname]";
	}
	// define Mailchimp name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option3') {
		return "OF_NAME";
	}
	// define GetResponse name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option4') {
		return "name";
	}
	// define Mad Mimi name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option5') {
		return "signup[name]";
	}
	// define Interspire name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option6') {
		return "CustomFields[" . esc_attr( optinforms_form_name_field_interspire() ) . "]";
	}
    // define Convertkit name field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option7') {
		return "fields[first_name]";
	// MailerLite name field
	} elseif($optinforms_email_solution == 'optinforms_email_solution_option8') {
		return "fields[name]";
	}
}

// Define our email field
function optinforms_get_email_field() {
	global $optinforms_email_solution;
	if(empty($optinforms_email_solution)) {
		return "email";
	}
	// define Aweber email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option1') {
		return "email";
	}
	// define iContact email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option2') {
		return "data[email]";
	}
	// define Mailchimp email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option3') {
		return "EMAIL";
	}
	// define GetResponse email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option4') {
		return "email";
	}
	// define Mad Mimi email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option5') {
		return "signup[email]";
	}
	// define Interspire email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option6') {
		return "email";
	}
    // define Convertkit email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option7') {
		return "email_address";
	}
	// define Mailerlite email field
	elseif($optinforms_email_solution == 'optinforms_email_solution_option8') {
		return 'fields[email]';
	}
}

// Define a form design
function optinforms_get_form_design() {
	global $optinforms_form_design;
	if(empty($optinforms_form_design)) {
		$optinforms_form_design = 01;
	}
	return $optinforms_form_design;
}

// Get excluded posts for In Content forms
function optinforms_form_exclude_posts() {
	global $optinforms_form_exclude_posts;
	return $optinforms_form_exclude_posts;
}

// Get excluded pages for In Content forms
function optinforms_form_exclude_pages() {
	global $optinforms_form_exclude_pages;
	return $optinforms_form_exclude_pages;
}

// Decide when our admin notices are loaded
function optinforms_configuration() {
	global $optinforms_email_solution, $optinforms_form_list_name_aweber, $optinforms_form_listid_icontact, $optinforms_form_specialid_icontact, $optinforms_form_clientid_icontact, $optinforms_form_action_mailchimp, $optinforms_form_action_mailerlite, $optinforms_form_webformid_getresponse, $optinforms_form_action_madmimi, $optinforms_form_action_interspire, $optinforms_form_id_convertkit, $optinforms_form_user_id_convertkit;
	if(($optinforms_email_solution == 'optinforms_email_solution_option1') && (empty($optinforms_form_list_name_aweber))) {
		echo optinforms_configuration_message();
	}
	elseif(($optinforms_email_solution == 'optinforms_email_solution_option2') && (empty($optinforms_form_listid_icontact) || empty($optinforms_form_specialid_icontact) || empty($optinforms_form_clientid_icontact))) {
		echo optinforms_configuration_message();
	}
	elseif (($optinforms_email_solution == 'optinforms_email_solution_option3') && (empty($optinforms_form_action_mailchimp))) {
		echo optinforms_configuration_message();
	}
	elseif (($optinforms_email_solution == 'optinforms_email_solution_option4') && (empty($optinforms_form_webformid_getresponse))) {
		echo optinforms_configuration_message();
	}
	elseif (($optinforms_email_solution == 'optinforms_email_solution_option5') && (empty($optinforms_form_action_madmimi))) {
		echo optinforms_configuration_message();
	}
	elseif (($optinforms_email_solution == 'optinforms_email_solution_option6') && (empty($optinforms_form_action_interspire))) {
		echo optinforms_configuration_message();
	}
    elseif (($optinforms_email_solution == 'optinforms_email_solution_option7') && (empty($optinforms_form_id_convertkit))) {
		echo optinforms_configuration_message();
	}
	elseif (($optinforms_email_solution == 'optinforms_email_solution_option8') && (empty($optinforms_form_action_mailerlite))) {
		echo optinforms_configuration_message();
	}
}

// Create our admin notice - user needs to configure the plugin
function optinforms_configuration_message() {
	global $current_user;
	$userid = $current_user->ID;
	if ( !get_user_meta( $userid, 'optinforms_dismiss_email_configuration' ) ) {
	echo "<div id=\"message\" class=\"error\">
        		<p>" . __('Your email solution is not configured yet. Your form will not work properly until you configure the settings.', 'optin-forms') . " <a href=\"?page=optinforms&optinforms_dismiss_ec=yes\">" . __('I know, don\'t bug me', 'optin-forms') . "</a></p>
    		</div>";
	}
}

// Add user meta value when dismiss link is clicked
function optinforms_dismiss_admin_notice() {
	global $current_user;
	$userid = $current_user->ID;

	// If "Dismiss" link has been clicked, user meta field is added
	if ( isset( $_GET['optinforms_dismiss_ec'] ) && 'yes' == $_GET['optinforms_dismiss_ec'] ) {
		add_user_meta( $userid, 'optinforms_dismiss_email_configuration', 'yes', true );
	}
}
add_action( 'admin_init', 'optinforms_dismiss_admin_notice' );

// Show us some love :)
function optinforms_powered_by() {

	$return = '';
	global $optinforms_powered_by;
	if($optinforms_powered_by == 0) {
		// do nothing
	}
	elseif($optinforms_powered_by == 1) {
		$return = "<div id=\"optinforms-powered-by\">Powered by <a href=\"http://www.codeleon.com/products/optin-forms\" target=\"_blank\">Optin Forms</a></div><!--optinforms-powered-by-->";
	}

	$return_append = apply_filters( 'optinforms_before_form_close', '' );

	return $return . $return_append;

}

// Check radiobutton show Powered By link
function optinforms_powered_by_show() {
	global $optinforms_powered_by;
	if($optinforms_powered_by == 1) {
		echo "checked=\"checked\"";
	}
}

// Check radiobutton hide Powered By link
function optinforms_powered_by_hide() {
	global $optinforms_powered_by;
	if($optinforms_powered_by == 0) {
		echo "checked=\"checked\"";
	}
}

// Get the fonts which are used on the selected form
function optinforms_get_used_fonts() {
	global $optinforms_form_design;
	$optinforms_unsupported_fonts = array( "inherit", "Arial", "Georgia", "Helvetica", "Tahoma", "Times New Roman", "Verdana");
	if($optinforms_form_design == 'optinforms_form_design_option1' || empty($optinforms_form_design)) {
		global $optinforms_form1_title_font, $optinforms_form1_subtitle_font;

		// Strip unsupported fonts to prevent 'Forbidden' output
		$optinforms_first_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form1_default_title_font());
		$optinforms_second_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form1_default_subtitle_font());

		// Decide whether we need a delimiter
		if($optinforms_first_used_font == "" || $optinforms_second_used_font == ""){
			$optinforms_font_delimiter = "";
		} else {
			$optinforms_font_delimiter = "%7C";
		}

		return $optinforms_first_used_font . $optinforms_font_delimiter . $optinforms_second_used_font;
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option2') {
		global $optinforms_form2_title_font;

		// Strip unsupported fonts to prevent 'Forbidden' output
		$optinforms_first_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form2_default_title_font());
		return $optinforms_first_used_font;
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option3') {
		global $optinforms_form3_title_font, $optinforms_form3_subtitle_font;

		// Strip unsupported fonts to prevent 'Forbidden' output
		$optinforms_first_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form3_default_title_font());
		$optinforms_second_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form3_default_subtitle_font());

		// Decide whether we need a delimiter
		if($optinforms_first_used_font == "" || $optinforms_second_used_font == ""){
			$optinforms_font_delimiter = "";
		} else {
			$optinforms_font_delimiter = "%7C";
		}

		return $optinforms_first_used_font . $optinforms_font_delimiter . $optinforms_second_used_font;
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option4') {
		global $optinforms_form4_title_font, $optinforms_form4_subtitle_font;

		// Strip unsupported fonts to prevent 'Forbidden' output
		$optinforms_first_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form4_default_title_font());
		$optinforms_second_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form4_default_subtitle_font());

		// Decide whether we need a delimiter
		if($optinforms_first_used_font == "" || $optinforms_second_used_font == ""){
			$optinforms_font_delimiter = "";
		} else {
			$optinforms_font_delimiter = "%7C";
		}

		return $optinforms_first_used_font . $optinforms_font_delimiter . $optinforms_second_used_font;
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option5') {
		global $optinforms_form5_title_font, $optinforms_form5_subtitle_font;

		// Strip unsupported fonts to prevent 'Forbidden' output
		$optinforms_first_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form5_default_title_font());
		$optinforms_second_used_font = str_replace($optinforms_unsupported_fonts, "", optinforms_form5_default_subtitle_font());

		// Decide whether we need a delimiter
		if($optinforms_first_used_font == "" || $optinforms_second_used_font == ""){
			$optinforms_font_delimiter = "";
		} else {
			$optinforms_font_delimiter = "%7C";
		}

		return $optinforms_first_used_font . $optinforms_font_delimiter . $optinforms_second_used_font;
	}
}

// Now include only these fonts to optimize load time
function optinforms_used_fonts() {

	$optinforms_google_url = "//fonts.googleapis.com/css?family=";
	return $optinforms_google_url.optinforms_get_used_fonts();

}
	
/**
 * Fixes issue with Mailchimp needing 2 inputs ( first and last name )
 *
 * @since 1.2.8.5
 */
function optinforms_mailchimp_full_name_fix() {

	global $optinforms_email_solution;
	$output = '';

	// mailchimp
	if ( $optinforms_email_solution == 'optinforms_email_solution_option3' ) {

		// start output buffer
		ob_start();
		?>

		<input type="hidden" name="FNAME" autocomplete="off" class="optinforms-mailchimp-field" />
		<input type="hidden" name="LNAME" autocomplete="off" class="optinforms-mailchimp-field" />

		<?php
		// end output buffer
		$output .= ob_get_contents();
		ob_end_clean();

	}

	return $output;

}

/**
 * Adds a checkbox for confirmation
 *
 * @since 1.2.8.6
 */
function optinforms_confirm_checkbox( $form = 'form1' ) {

	global $optinforms_email_solution;
	global $optinforms_form1_hide_confirm_checkbox;
	global $optinforms_form2_hide_confirm_checkbox;
	global $optinforms_form3_hide_confirm_checkbox;
	global $optinforms_form4_hide_confirm_checkbox;
	global $optinforms_form5_hide_confirm_checkbox;
	global $optinforms_form6_hide_confirm_checkbox;
	global $optinforms_form1_confirm_checkbox;
	global $optinforms_form2_confirm_checkbox;
	global $optinforms_form3_confirm_checkbox;
	global $optinforms_form4_confirm_checkbox;
	global $optinforms_form5_confirm_checkbox;
	global $optinforms_form6_confirm_checkbox;
	$hide_confirm_checkbox_var_name = 'optinforms_' . $form . '_hide_confirm_checkbox';
	$confirm_checbox_text_var_name = 'optinforms_' . $form . '_confirm_checkbox';
	$output = '';

	if ( $$hide_confirm_checkbox_var_name == '1' ) {
		return '';
	}

	$text = $$confirm_checbox_text_var_name;
	if ( ! $text ) {
		$text = 'I agree to have my personal information transfered to [optinform_provider] ( <a href="[optinform_privacy_url]" target="_blank">more information</a> )';
	}

	// start output buffer
	ob_start();
	?>

		<div class="optinforms-confirm-checkbox optinforms-form1-confirm-checkbox">

			<input type="checkbox" required /> <?php echo do_shortcode( $text ); ?>

		</div><!-- .optinforms-confirm-checkbox -->

	<?php
	// end output buffer
	$output = ob_get_contents();
	ob_end_clean();

	return $output;

}

/**
 * Provider shortcode
 *
 * @since 1.2.8.7
 */
function optinforms_provider_sc() {

	global $optinforms_email_solution;
	$provider = 'Mailchimp';
	$privacy_url = 'https://mailchimp.com/legal/privacy/';
	if ( $optinforms_email_solution == 'optinforms_email_solution_option1' ) {
		$provider = 'AWeber';
		$privacy_url = 'https://www.aweber.com/privacy.htm';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option2' ) {
		$provider = 'iContact';
		$privacy_url = 'https://www.icontact.com/legal/privacy';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option3' ) {
		$provider = 'MailChimp';
		$privacy_url = 'https://mailchimp.com/legal/privacy/';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option4' ) {
		$provider = 'GetResponse';
		$privacy_url = 'https://www.getresponse.com/legal/privacy.html';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option5' ) {
		$provider = 'Mad Mimi';
		$privacy_url = 'https://uk.godaddy.com/Agreements/Privacy.aspx';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option6' ) {
		$provider = 'Interspire Email Marketer';
		$privacy_url = false;
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option7' ) {
		$provider = 'ConvertKit';
		$privacy_url = 'https://convertkit.com/privacy/';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option8' ) {
		$provider = 'MailerLite';
		$privacy_url = 'https://www.mailerlite.com/legal/privacy-policy';
	}

	return $provider;

} add_shortcode( 'optinform_provider', 'optinforms_provider_sc' );

/**
 * Provider shortcode
 *
 * @since 1.2.8.7
 */
function optinforms_privacy_url_sc() {

	global $optinforms_email_solution;
	$provider = 'Mailchimp';
	$privacy_url = 'https://mailchimp.com/legal/privacy/';
	if ( $optinforms_email_solution == 'optinforms_email_solution_option1' ) {
		$provider = 'AWeber';
		$privacy_url = 'https://www.aweber.com/privacy.htm';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option2' ) {
		$provider = 'iContact';
		$privacy_url = 'https://www.icontact.com/legal/privacy';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option3' ) {
		$provider = 'MailChimp';
		$privacy_url = 'https://mailchimp.com/legal/privacy/';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option4' ) {
		$provider = 'GetResponse';
		$privacy_url = 'https://www.getresponse.com/legal/privacy.html';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option5' ) {
		$provider = 'Mad Mimi';
		$privacy_url = 'https://uk.godaddy.com/Agreements/Privacy.aspx';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option6' ) {
		$provider = 'Interspire Email Marketer';
		$privacy_url = '';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option7' ) {
		$provider = 'ConvertKit';
		$privacy_url = 'https://convertkit.com/privacy/';
	} else if ( $optinforms_email_solution == 'optinforms_email_solution_option8' ) {
		$provider = 'MailerLite';
		$privacy_url = 'https://www.mailerlite.com/legal/privacy-policy';
	}

	return $privacy_url;

} add_shortcode( 'optinform_privacy_url', 'optinforms_privacy_url_sc' );


?>