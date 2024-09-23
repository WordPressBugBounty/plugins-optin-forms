<?php

add_action( 'admin_init', 'optinforms_register_settings' );

// Register Optin Forms settings
function optinforms_register_settings()
{
	global $optinforms_forms;

	// Are there any custom optin form designs registered?
	if ( is_array( $optinforms_forms ) ) {

		// Loop through registered optin form designs.
		foreach ( $optinforms_forms as $id => $design ) {

			// Are the default settings provided?
			if ( is_array( $design->defaults ) ) {

				// Loop through each default setting.
				foreach ( $design->defaults as $setting_id => $setting_default ) {

					// Register a WordPress setting to store the setting value.
					register_setting( 'optinforms-settings-group', $setting_id );
				}
			}
		}
	}

	// solutions - general

	$settings = array(
		'optinforms_email_solution',
		'optinforms_form_action',
		'optinforms_form_action_mailchimp',
		'optinforms_form_action_mailerlite',
		'optinforms_form_action_madmimi',
		'optinforms_form_action_interspire',
	);

	foreach ($settings as $setting) {
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => 'sanitize_text_field',
		));
	}

	// solutions - misc

	$settings = array(
		'optinforms_form_list_name_aweber',
		'optinforms_form_redirect_aweber',
		'optinforms_form_listid_icontact',
		'optinforms_form_specialid_icontact',
		'optinforms_form_clientid_icontact',
		'optinforms_form_redirect_icontact',
		'optinforms_form_error_icontact',
		'optinforms_form_webformid_getresponse',
		'optinforms_form_name_field_interspire',
		'optinforms_form_id_convertkit',
		'optinforms_form_user_id_convertkit',
		'optinforms_form_success_convertkit',
		'optinforms_form_error_convertkit',
	);

	foreach ($settings as $setting) {
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => 'sanitize_text_field',
		));
	}

	// general

	$settings = array(
		'optinforms_form_design',
		'optinforms_form_placement_post',
		'optinforms_form_placement_page',
		'optinforms_form_placement_popup',
		'optinforms_form_placement_box',
		'optinforms_form_placement_bar',
		'optinforms_form_exclude_posts',
		'optinforms_form_exclude_pages',
		'optinforms_powered_by',
		'optinforms_form_target',
	);

	foreach ($settings as $setting) {
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => 'sanitize_text_field',
		));
	}

	// form 1

	$settings = array(
		'optinforms_form1_background',
		'optinforms_form1_border',
		'optinforms_form1_title',
		'optinforms_form1_title_font',
		'optinforms_form1_title_size',
		'optinforms_form1_title_color',
		'optinforms_form1_subtitle',
		'optinforms_form1_subtitle_font',
		'optinforms_form1_subtitle_size',
		'optinforms_form1_subtitle_color',
		'optinforms_form1_name_field',
		'optinforms_form1_email_field',
		'optinforms_form1_fields_font',
		'optinforms_form1_fields_size',
		'optinforms_form1_fields_color',
		'optinforms_form1_button_text',
		'optinforms_form1_button_text_font',
		'optinforms_form1_button_text_size',
		'optinforms_form1_button_text_color',
		'optinforms_form1_button_background',
		'optinforms_form1_disclaimer',
		'optinforms_form1_disclaimer_font',
		'optinforms_form1_disclaimer_size',
		'optinforms_form1_disclaimer_color',
		'optinforms_form1_width',
		'optinforms_form1_width_pixels',
		'optinforms_form1_hide_title',
		'optinforms_form1_hide_subtitle',
		'optinforms_form1_hide_name_field',
		'optinforms_form1_hide_disclaimer',
		'optinforms_form1_css',
		'optinforms_form1_hide_confirm_checkbox',
		'optinforms_form1_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		$sanitize_callback = 'sanitize_text_field';
		if ( $setting == 'optinforms_form1_confirm_checkbox' ) {
			$sanitize_callback = 'wp_kses_post';
		}
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => $sanitize_callback
		));
	}

	// form 2

	$settings = array(
		'optinforms_form2_background',
		'optinforms_form2_title',
		'optinforms_form2_title_font',
		'optinforms_form2_title_size',
		'optinforms_form2_title_color',
		'optinforms_form2_email_field',
		'optinforms_form2_fields_font',
		'optinforms_form2_fields_size',
		'optinforms_form2_fields_color',
		'optinforms_form2_button_text',
		'optinforms_form2_button_text_font',
		'optinforms_form2_button_text_size',
		'optinforms_form2_button_text_color',
		'optinforms_form2_button_background',
		'optinforms_form2_disclaimer',
		'optinforms_form2_disclaimer_font',
		'optinforms_form2_disclaimer_size',
		'optinforms_form2_disclaimer_color',
		'optinforms_form2_width',
		'optinforms_form2_width_pixels',
		'optinforms_form2_hide_title',
		'optinforms_form2_hide_disclaimer',
		'optinforms_form2_css',
		'optinforms_form2_hide_confirm_checkbox',
		'optinforms_form2_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		$sanitize_callback = 'sanitize_text_field';
		if ( $setting == 'optinforms_form2_confirm_checkbox' ) {
			$sanitize_callback = 'wp_kses_post';
		}
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => $sanitize_callback
		));
	}

	// form 3

	$settings = array(
		'optinforms_form3_background',
		'optinforms_form3_title',
		'optinforms_form3_title_font',
		'optinforms_form3_title_size',
		'optinforms_form3_title_color',
		'optinforms_form3_subtitle',
		'optinforms_form3_subtitle_font',
		'optinforms_form3_subtitle_size',
		'optinforms_form3_subtitle_color',
		'optinforms_form3_name_field',
		'optinforms_form3_email_field',
		'optinforms_form3_fields_font',
		'optinforms_form3_fields_size',
		'optinforms_form3_fields_color',
		'optinforms_form3_button_text',
		'optinforms_form3_button_text_font',
		'optinforms_form3_button_text_size',
		'optinforms_form3_button_text_color',
		'optinforms_form3_button_background',
		'optinforms_form3_width',
		'optinforms_form3_width_pixels',
		'optinforms_form3_hide_title',
		'optinforms_form3_hide_subtitle',
		'optinforms_form3_hide_name_field',
		'optinforms_form3_css',
		'optinforms_form3_hide_confirm_checkbox',
		'optinforms_form3_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		$sanitize_callback = 'sanitize_text_field';
		if ( $setting == 'optinforms_form3_confirm_checkbox' ) {
			$sanitize_callback = 'wp_kses_post';
		}
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => $sanitize_callback
		));
	}

	// form 4

	$settings = array(
		'optinforms_form4_background',
		'optinforms_form4_border',
		'optinforms_form4_title',
		'optinforms_form4_title_font',
		'optinforms_form4_title_size',
		'optinforms_form4_title_color',
		'optinforms_form4_subtitle',
		'optinforms_form4_subtitle_font',
		'optinforms_form4_subtitle_size',
		'optinforms_form4_subtitle_color',
		'optinforms_form4_email_field',
		'optinforms_form4_fields_font',
		'optinforms_form4_fields_size',
		'optinforms_form4_fields_color',
		'optinforms_form4_button_text',
		'optinforms_form4_button_text_font',
		'optinforms_form4_button_text_size',
		'optinforms_form4_button_text_color',
		'optinforms_form4_button_background',
		'optinforms_form4_disclaimer',
		'optinforms_form4_disclaimer_font',
		'optinforms_form4_disclaimer_size',
		'optinforms_form4_disclaimer_color',
		'optinforms_form4_width',
		'optinforms_form4_width_pixels',
		'optinforms_form4_hide_title',
		'optinforms_form4_hide_subtitle',
		'optinforms_form4_hide_disclaimer',
		'optinforms_form4_css',
		'optinforms_form4_hide_confirm_checkbox',
		'optinforms_form4_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		$sanitize_callback = 'sanitize_text_field';
		if ( $setting == 'optinforms_form4_confirm_checkbox' ) {
			$sanitize_callback = 'wp_kses_post';
		}
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => $sanitize_callback
		));
	}
	
	// form 5

	$settings = array(
		'optinforms_form5_background',
		'optinforms_form5_title',
		'optinforms_form5_title_font',
		'optinforms_form5_title_size',
		'optinforms_form5_title_color',
		'optinforms_form5_subtitle',
		'optinforms_form5_subtitle_font',
		'optinforms_form5_subtitle_size',
		'optinforms_form5_subtitle_color',
		'optinforms_form5_name_field',
		'optinforms_form5_email_field',
		'optinforms_form5_fields_font',
		'optinforms_form5_fields_size',
		'optinforms_form5_fields_color',
		'optinforms_form5_button_text',
		'optinforms_form5_button_text_font',
		'optinforms_form5_button_text_size',
		'optinforms_form5_button_text_color',
		'optinforms_form5_button_background',
		'optinforms_form5_disclaimer',
		'optinforms_form5_disclaimer_font',
		'optinforms_form5_disclaimer_size',
		'optinforms_form5_disclaimer_color',
		'optinforms_form5_width',
		'optinforms_form5_width_pixels',
		'optinforms_form5_hide_title',
		'optinforms_form5_hide_subtitle',
		'optinforms_form5_hide_name_field',
		'optinforms_form5_hide_disclaimer',
		'optinforms_form5_css',
		'optinforms_form5_hide_confirm_checkbox',
		'optinforms_form5_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		$sanitize_callback = 'sanitize_text_field';
		if ( $setting == 'optinforms_form5_confirm_checkbox' ) {
			$sanitize_callback = 'wp_kses_post';
		}
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => $sanitize_callback
		));
	}

	// form 6

	$settings = array(
		'optinforms_form6_hide_confirm_checkbox',
		'optinforms_form6_confirm_checkbox',
	);

	foreach ($settings as $setting) {
		register_setting('optinforms-settings-group', $setting, array(
			'sanitize_callback' => 'sanitize_text_field',
		));
	}












}
?>