<?php

// Get excluded posts and create an array
function optinforms_get_excluded_posts() {
	global $optinforms_form_exclude_posts;
	if(empty($optinforms_form_exclude_posts)) {
		$optinforms_get_excluded_posts = '0';
	}
	if(!is_string($optinforms_form_exclude_posts)) {
		$optinforms_get_excluded_posts = '0';
	}
	else {
	  $optinforms_form_exclude_posts = str_replace( ' ', '', $optinforms_form_exclude_posts );
	  $optinforms_get_excluded_posts = explode(',', $optinforms_form_exclude_posts);
	}
	return $optinforms_get_excluded_posts;
}

// Get excluded pages and create an array
function optinforms_get_excluded_pages() {
	global $optinforms_form_exclude_pages;
	if(empty($optinforms_form_exclude_pages)) {
		$optinforms_get_excluded_pages = '0';
	}
	if(!is_string($optinforms_form_exclude_pages)) {
		$optinforms_get_excluded_pages = '0';
	}
	else {
	  $optinforms_get_excluded_pages = explode(',', $optinforms_form_exclude_pages);
	}
	return $optinforms_get_excluded_pages;
}

// Insert form on post, after first paragraph
add_filter( "the_content", "optinform_insert_form_first_paragraph_post" );

function optinform_insert_form_first_paragraph_post($content) {
	global $optinforms_form_placement_post, $optinforms_form_exclude_posts;
	$optinforms_get_excluded_posts = optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_post == '1'){
		$ad_code = optinforms_create_form();
		if(empty($optinforms_form_exclude_posts) && is_single()) {
			return optinform_insert_form_after_paragraph($ad_code, 1, $content);
		}
		elseif (!empty($optinforms_form_exclude_posts) && is_single()) {
			if(is_single($optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				return optinform_insert_form_after_paragraph($ad_code, 1, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on page, after first paragraph
add_filter( "the_content", "optinform_insert_form_first_paragraph_page" );

function optinform_insert_form_first_paragraph_page($content) {
	global $optinforms_form_placement_page;
	$optinforms_get_excluded_pages = optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_page == '1'){
		$ad_code = optinforms_create_form();
		if(is_page()) {
			if(is_page($optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				return optinform_insert_form_after_paragraph($ad_code, 1, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on post, after second paragraph
add_filter( "the_content", "optinform_insert_form_second_paragraph_post" );

function optinform_insert_form_second_paragraph_post($content) {
	global $optinforms_form_placement_post;
	$optinforms_get_excluded_posts = optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_post == '2'){
		$ad_code = optinforms_create_form();
		if(is_single()) {
			if(is_single($optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				return optinform_insert_form_after_paragraph($ad_code, 2, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Insert form on page, after second paragraph
add_filter( "the_content", "optinform_insert_form_second_paragraph_page" );

function optinform_insert_form_second_paragraph_page($content) {
	global $optinforms_form_placement_page;
	$optinforms_get_excluded_pages = optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_page == '2'){
		$ad_code = optinforms_create_form();
		if(is_page()) {
			if(is_page($optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				return optinform_insert_form_after_paragraph($ad_code, 2, $content);
			}
		}
	}
	else {
		// do nothing
	}
	return $content;
}

// Help us insert form in between paragraphs
function optinform_insert_form_after_paragraph($insertion, $paragraph_id, $content) {
	$closing_p = '</p>';
	$paragraphs = explode($closing_p, $content);
	foreach ($paragraphs as $index => $paragraph) {
		if (trim($paragraph)) {
			$paragraphs[$index] .= $closing_p;
		}
		if ($paragraph_id == $index + 1) {
			$paragraphs[$index] .= $insertion;
		}
	}
	return implode('', $paragraphs);
}

// Insert form after post content
add_filter( "the_content", "optinforms_insert_form_after_post" );

function optinforms_insert_form_after_post($content) {
	global $optinforms_form_placement_post, $optinforms_form_exclude_posts;
	$optinforms_get_excluded_posts = optinforms_get_excluded_posts(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_post == '3' || empty($optinforms_form_placement_post)) {

		if(empty($optinforms_form_exclude_posts) && is_single()) {
			$content .= optinforms_create_form();
		}
		elseif (!empty($optinforms_form_exclude_posts) && is_single()) {
			if(is_single($optinforms_get_excluded_posts)) {
				// do nothing
			}
			else {
				$content .= optinforms_create_form();
			}
		}

	}
	return $content;
}

// Insert form after page content
add_filter( "the_content", "optinforms_insert_form_after_page" );

function optinforms_insert_form_after_page($content) {
	global $optinforms_form_placement_page, $optinforms_form_exclude_pages;
	$optinforms_get_excluded_pages = optinforms_get_excluded_pages(); // THIS ONE IS NEW !!!
	if($optinforms_form_placement_page == '3' || empty($optinforms_form_placement_page)) {
		if(is_page()) {
			if(is_page($optinforms_get_excluded_pages)) {
				// do nothing
			}
			else {
				$content .= optinforms_create_form();
			}
		}
	}
	return $content;
}

// Create our shortcode for inclusion in sidebar
add_shortcode( 'optinform', 'optinforms_create_form' );

// Make sure our shortcode will work in widgets
add_filter('widget_text', 'do_shortcode');

// Code comment beginning
function optinforms_code_comment(){
	return "\n\n<!-- Form created by Optin Forms plugin by WPKube: create beautiful optin forms with ease! -->\n<!-- https://wpkube.com/ -->\n";
}

// Code comment end
function optinforms_code_comment_end(){
	return "\n<!-- / Optin Forms -->\n\n";
}

function optinforms_status_messages() {

	global $optinforms_email_solution;

	ob_start();
	?>
	<div class="optinforms-status-success-message" style="display:none;">Thank you for subscribing.</div>
	<div class="optinforms-status-error-message" style="display:none;">Something went wrong.</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;

}

function optinforms_form_class() {

	global $optinforms_email_solution;

	$class = '';

	if ( $optinforms_email_solution == 'optinforms_email_solution_option8' ) {
		$class .= 'optinforms-solution-mailerlite';
	}

	return $class;

}

// Form 1
function optinforms_create_form() {
	global $optinforms_form_design;
	
	if($optinforms_form_design == 'optinforms_form_design_option1') {
		ob_start(); ?>

			<?php echo optinforms_code_comment(); ?>
			<div id="optinforms-form1-container" class="optinforms-form-container" <?php echo optinforms_form1_get_width(); ?>>
				<?php echo optinforms_before_form(); ?>
				<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr(optinforms_get_form_action()); ?>" <?php echo optinforms_form_action_appendix(); ?>>
					<?php echo optinforms_get_form_identifiers(); ?>
					<div id="optinforms-form1" style="background:<?php echo esc_attr( optinforms_form1_default_background() ); ?>; border-color:<?php echo esc_attr( optinforms_form1_default_border() ); ?>">
						<p id="optinforms-form1-title" style="font-family:<?php echo esc_attr( optinforms_form1_default_title_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_title_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form1_default_title_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_title_color() ); ?>"><?php echo esc_html( optinforms_form1_default_title() ); ?></p>
						<p id="optinforms-form1-subtitle" style="font-family:<?php echo esc_attr( optinforms_form1_default_subtitle_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_subtitle_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form1_default_subtitle_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_subtitle_color() ); ?>"><?php echo esc_html( optinforms_form1_default_subtitle() ); ?></p>
						<div id="optinforms-form1-name-field-container">
							<input required type="text" id="optinforms-form1-name-field" name="<?php echo esc_attr( optinforms_get_name_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form1_default_name_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form1_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_fields_color() ); ?>" />
							<?php echo optinforms_mailchimp_full_name_fix(); ?>
						</div><!--optinforms-form1-name-field-container-->
						<div id="optinforms-form1-email-field-container">
							<input required type="text" id="optinforms-form1-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form1_default_email_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form1_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_fields_color() ); ?>" />
						</div><!--optinforms-form1-email-field-container-->
						<div id="optinforms-form1-button-container">
							<input type="submit" name="submit" id="optinforms-form1-button" value="<?php echo esc_attr( optinforms_form1_default_button_text() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form1_default_button_text_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_button_text_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_button_text_color() ); ?>; background-color:<?php echo esc_attr( optinforms_form1_default_button_background() ); ?>" />
						</div><!--optinforms-form1-button-container-->
						<div class="clear"></div>
						<?php echo optinforms_status_messages(); ?>
						<?php echo optinforms_confirm_checkbox('form1'); ?>
						<p id="optinforms-form1-disclaimer" style="font-family:<?php echo esc_attr( optinforms_form1_default_disclaimer_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form1_default_disclaimer_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form1_default_disclaimer_size() ); ?>; color:<?php echo esc_attr( optinforms_form1_default_disclaimer_color() ); ?>"><?php echo wp_kses_post( optinforms_form1_default_disclaimer() ); ?></p>
					</div><!--optinforms-form1-->
					<div class="clear"></div>
					<?php echo optinforms_powered_by(); ?>
				</form>
			</div><!--optinforms-form1-container-->
			<div class="clear"></div>
			<?php echo optinforms_code_comment_end(); ?>
			<?php echo optinforms_form1_add_custom_css(); ?>
		
		<?php return ob_get_clean();
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option2') {
		ob_start(); ?>

			<?php echo optinforms_code_comment(); ?>
			<div id="optinforms-form2-container" class="optinforms-form-container" <?php echo optinforms_form2_get_width(); ?>>
				<?php echo optinforms_before_form(); ?>
				<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr(optinforms_get_form_action()); ?>" <?php echo optinforms_form_action_appendix(); ?>>
					<?php echo optinforms_get_form_identifiers(); ?>
					<div id="optinforms-form2" style="background:<?php echo esc_attr( optinforms_form2_default_background() ); ?>">
						<div id="optinforms-form2-title-container">
							<div id="optinforms-form2-title" style="font-family:<?php echo esc_attr( optinforms_form2_default_title_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form2_default_title_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form2_default_title_size() ); ?>; color:<?php echo esc_attr( optinforms_form2_default_title_color() ); ?>"><?php echo esc_html( optinforms_form2_default_title() ); ?></div><!--optinforms-form2-title-->
						</div><!--optinforms-form2-title-container-->
						<div id="optinforms-form2-email-field-container">
							<input required type="text" id="optinforms-form2-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form2_default_email_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form2_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form2_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form2_default_fields_color() ); ?>" />
						</div><!--optinforms-form2-email-field-container-->
						<div id="optinforms-form2-button-container">
							<input type="submit" name="submit" id="optinforms-form2-button" value="<?php echo esc_attr( optinforms_form2_default_button_text() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form2_default_button_text_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form2_default_button_text_size() ); ?>; color:<?php echo esc_attr( optinforms_form2_default_button_text_color() ); ?>; background-color:<?php echo esc_attr( optinforms_form2_default_button_background() ); ?>" />
						</div><!--optinforms-form2-button-container-->
						<div id="optinforms-form2-disclaimer-container">
							<p id="optinforms-form2-disclaimer" style="font-family:<?php echo esc_attr( optinforms_form2_default_disclaimer_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form2_default_disclaimer_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form2_default_disclaimer_size() ); ?>; color:<?php echo esc_attr( optinforms_form2_default_disclaimer_color() ); ?>"><?php echo wp_kses_post( optinforms_form2_default_disclaimer() ); ?></p>
						</div><!--optinforms-form2-disclaimer-container-->
						<?php echo optinforms_confirm_checkbox('form2'); ?>
						<div class="clear"></div>
					</div><!--optinforms-form2-->
					<div class="clear"></div>
					<?php echo optinforms_status_messages(); ?>
					<?php echo optinforms_powered_by(); ?>
				</form>
			</div><!--optinforms-form2-container-->
			<div class="clear"></div>
			<?php echo optinforms_code_comment_end(); ?>
			<?php echo optinforms_form2_add_custom_css(); ?>

		<?php return ob_get_clean();
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option3') {
		ob_start(); ?>

			<?php echo optinforms_code_comment(); ?>
			<div id="optinforms-form3-container" class="optinforms-form-container" <?php echo optinforms_form3_get_width(); ?>>
				<?php echo optinforms_before_form(); ?>
				<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr(optinforms_get_form_action()); ?>" <?php echo optinforms_form_action_appendix(); ?>>
					<?php echo optinforms_get_form_identifiers(); ?>
					<div id="optinforms-form3">
						<div id="optinforms-form3-inside" style="background:<?php echo esc_attr( optinforms_form3_default_background() ); ?>">
							<div id="optinforms-form3-container-left">
								<div id="optinforms-form3-title" style="font-family:<?php echo esc_attr( optinforms_form3_default_title_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form3_default_title_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form3_default_title_size() ); ?>; color:<?php echo esc_attr( optinforms_form3_default_title_color() ); ?>"><?php echo esc_html( optinforms_form3_default_title() ); ?></div><!--optinforms-form3-title-->
								<div id="optinforms-form3-subtitle" style="font-family:<?php echo esc_attr( optinforms_form3_default_subtitle_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form3_default_subtitle_size() ); ?>; color:<?php echo esc_attr( optinforms_form3_default_subtitle_color() ); ?>"><?php echo esc_html( optinforms_form3_default_subtitle() ); ?></div><!--optinforms-form3-subtitle-->
							</div><!--optinforms-form3-container-left-->
							<div id="optinforms-form3-container-right">
								<input required type="text" id="optinforms-form3-name-field" name="<?php echo esc_attr( optinforms_get_name_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form3_default_name_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form3_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form3_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form3_default_fields_color() ); ?>" />
								<input required type="text" id="optinforms-form3-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form3_default_email_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form3_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form3_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form3_default_fields_color() ); ?>" />
								<?php echo optinforms_mailchimp_full_name_fix(); ?>
								<input type="submit" name="submit" id="optinforms-form3-button" value="<?php echo esc_attr( optinforms_form3_default_button_text() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form3_default_button_text_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form3_default_button_text_size() ); ?>; color:<?php echo esc_attr( optinforms_form3_default_button_text_color() ); ?>; background-color:<?php echo esc_attr( optinforms_form3_default_button_background() ); ?>" />
								<?php echo optinforms_status_messages(); ?>
								<?php echo optinforms_confirm_checkbox('form3'); ?>
							</div><!--optinforms-form3-container-right-->
							<div class="clear"></div>
						</div><!--optinforms-form3-inside-->
					</div><!--optinforms-form3-->
					<div class="clear"></div>
					<?php echo optinforms_powered_by(); ?>
				</form>
			</div><!--optinforms-form3-container-->
			<div class="clear"></div>
			<?php echo optinforms_code_comment_end(); ?>
			<?php echo optinforms_form3_add_custom_css(); ?>


		<?php return ob_get_clean();
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option4') {
		ob_start(); ?>

			<?php echo optinforms_code_comment(); ?>
			<div id="optinforms-form4-container" class="optinforms-form-container" <?php echo optinforms_form4_get_width(); ?>>
				<?php echo optinforms_before_form(); ?>
				<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr(optinforms_get_form_action()); ?>" <?php echo optinforms_form_action_appendix(); ?>>
					<?php echo optinforms_get_form_identifiers(); ?>
					<div id="optinforms-form4" style="background:<?php echo esc_attr( optinforms_form4_default_background() ); ?>; border-color:<?php echo esc_attr( optinforms_form4_default_border() ); ?>">
						<div id="optinforms-form4-title" style="font-family:<?php echo esc_attr( optinforms_form4_default_title_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form4_default_title_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form4_default_title_size() ); ?>; color:<?php echo esc_attr( optinforms_form4_default_title_color() ); ?>"><?php echo esc_html( optinforms_form4_default_title() ); ?></div><!--optinforms-form4-title-->
						<div id="optinforms-form4-subtitle" style="font-family:<?php echo esc_attr( optinforms_form4_default_subtitle_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form4_default_subtitle_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form4_default_subtitle_size() ); ?>; color:<?php echo esc_attr( optinforms_form4_default_subtitle_color() ); ?>"><?php echo esc_html( optinforms_form4_default_subtitle() ); ?></div><!--optinforms-form4-subtitle-->
						<input required type="text" id="optinforms-form4-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form4_default_email_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form4_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form4_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form4_default_fields_color() ); ?>" />
						<input type="submit" name="submit" id="optinforms-form4-button" value="<?php echo esc_attr( optinforms_form4_default_button_text() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form4_default_button_text_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form4_default_button_text_size() ); ?>; color:<?php echo esc_attr( optinforms_form4_default_button_text_color() ); ?>; background-color:<?php echo esc_attr( optinforms_form4_default_button_background() ); ?>" />
						<?php echo optinforms_status_messages(); ?>
						<?php echo optinforms_confirm_checkbox('form4'); ?>
						<div id="optinforms-form4-disclaimer" style="font-family:<?php echo esc_attr( optinforms_form4_default_disclaimer_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form4_default_disclaimer_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form4_default_disclaimer_size() ); ?>; color:<?php echo esc_attr( optinforms_form4_default_disclaimer_color() ); ?>"><?php echo wp_kses_post( optinforms_form4_default_disclaimer() ); ?></div><!--optinforms-form4-disclaimer-->
						<div class="clear"></div>
					</div><!--optinforms-form4-->
					<div class="clear"></div>
					<?php echo optinforms_powered_by(); ?>
				</form>
			</div><!--optinforms-form4-container-->
			<div class="clear"></div>
			<?php echo optinforms_code_comment_end(); ?>
			<?php echo optinforms_form4_add_custom_css(); ?>

		<?php return ob_get_clean();
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option5') {
		ob_start(); ?>

			<?php echo optinforms_code_comment(); ?>
			<div id="optinforms-form5-container" class="optinforms-form-container" <?php echo optinforms_form5_get_width(); ?>>
				<?php echo optinforms_before_form(); ?>
				<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr(optinforms_get_form_action()); ?>" <?php echo optinforms_form_action_appendix(); ?>>
					<?php echo optinforms_get_form_identifiers(); ?>
					<div id="optinforms-form5" style="background:<?php echo optinforms_form5_default_background(); ?>;">
						<div id="optinforms-form5-container-left">
							<div id="optinforms-form5-title" style="font-family:<?php echo esc_attr( optinforms_form5_default_title_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_title_size() ); ?>; line-height:<?php echo esc_attr( optinforms_form5_default_title_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_title_color() ); ?>"><?php echo esc_html( optinforms_form5_default_title() ); ?></div><!--optinforms-form5-title-->
							<input required type="text" id="optinforms-form5-name-field" name="<?php echo esc_attr( optinforms_get_name_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form5_default_name_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form5_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_fields_color() ); ?>" />
							<input required type="text" id="optinforms-form5-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form5_default_email_field() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form5_default_fields_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_fields_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_fields_color() ); ?>" />
							<?php echo optinforms_mailchimp_full_name_fix(); ?>
							<input type="submit" name="submit" id="optinforms-form5-button" value="<?php echo esc_attr( optinforms_form5_default_button_text() ); ?>" style="font-family:<?php echo esc_attr( optinforms_form5_default_button_text_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_button_text_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_button_text_color() ); ?>; background-color:<?php echo esc_attr( optinforms_form5_default_button_background() ); ?>" />
							<?php echo optinforms_status_messages(); ?>
							<?php echo optinforms_confirm_checkbox('form5'); ?>
						</div><!--optinforms-form5-container-left-->
						<div id="optinforms-form5-container-right">
							<div id="optinforms-form5-subtitle" style="font-family:<?php echo esc_attr( optinforms_form5_default_subtitle_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_subtitle_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_subtitle_color() ); ?>"><?php echo esc_html( optinforms_form5_default_subtitle() ); ?></div><!--optinforms-form5-subtitle-->
							<div id="optinforms-form5-disclaimer" style="font-family:<?php echo esc_attr( optinforms_form5_default_disclaimer_font() ); ?>; font-size:<?php echo esc_attr( optinforms_form5_default_disclaimer_size() ); ?>; color:<?php echo esc_attr( optinforms_form5_default_disclaimer_color() ); ?>"><?php echo wp_kses_post( optinforms_form5_default_disclaimer() ); ?></div><!--optinforms-form5-disclaimer-->
						</div><!--optinforms-form5-container-right-->
						<div class="clear"></div>
					</div><!--optinforms-form5-->
					<div class="clear"></div>
					<?php echo optinforms_powered_by(); ?>
				</form>
			</div><!--optinforms-form5-container-->
			<div class="clear"></div>
			<?php echo optinforms_code_comment_end(); ?>
			<?php echo optinforms_form5_add_custom_css(); ?>

		<?php return ob_get_clean();
	}
	elseif($optinforms_form_design == 'optinforms_form_design_option6') {
		ob_start();
		?>
			
			<?php echo optinforms_code_comment() ?>
				<div id="optinforms-form6-container" class="optinforms-form-container">
					<?php echo optinforms_before_form(); ?>
					<form method="post" <?php echo optinforms_form_target_blank(); ?> class="<?php echo esc_attr( optinforms_form_class() ); ?>" action="<?php echo esc_attr( optinforms_get_form_action() ); ?>" <?php echo optinforms_form_action_appendix(); ?>>
						<?php echo optinforms_get_form_identifiers(); ?>
						<div id="optinforms-form6">
							<input required type="text" id="optinforms-form6-email-field" name="<?php echo esc_attr( optinforms_get_email_field() ); ?>" placeholder="<?php echo esc_attr( optinforms_form6_default_email_field() ); ?>" />
							<input type="submit" id="optinforms-form6-button" value="<?php echo esc_attr( optinforms_form6_default_button_text() ); ?>" />
							<?php echo optinforms_status_messages(); ?>
							<?php echo optinforms_confirm_checkbox('form6'); ?>
						</div><!--optinforms-form6-->
					</form>
				</div><!-- .optinforms-form6-container -->
			<?php echo optinforms_code_comment_end(); ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	else {
		global $optinforms_forms;

		// Have any custom form designs been registered?
		if ( is_array( $optinforms_forms ) ) {

			// Loops through registered form designs
			foreach ( $optinforms_forms as $id => $design ) {

				// Does the current form ID match the saved form ID?
				if ( $optinforms_form_design == $design->optinform['id'] ) {

					// Does the method exist to output the form?
					if ( method_exists( $design, 'get_optin_form' ) ) {
						return optinforms_code_comment() . optinforms_before_form() . '<form method="post" ' . optinforms_form_target_blank() . ' action="' . esc_attr( optinforms_get_form_action() ) . '" ' . optinforms_form_action_appendix() . '>' . optinforms_get_form_identifiers() . $design->get_optin_form() . '</form><div class="clear">';
					}
				}
			}
		}
	}
}

/**
 * Removes filters from excerpts.
 *
 * This was intended to prevent the optin form from being disaplyed during or
 * after excerpts. However, users were reporting that it was having a broader
 * impact than intended, so I (@alexmansfield) disabled it. Examples of user
 * struggles are listed below:
 *
 * @see https://wordpress.org/support/topic/forms-not-showing-upvia-form-placement-option?replies=1
 * @see https://wordpress.org/support/topic/cant-get-the-form-back-after-the-plugin-was-desabled?replies=1
 *
 * @param string $excerpt The post excerpt
 * @return string $excerpt The post excerpt
 */
function optinforms_remove_from_excerpt( $excerpt ) {
	remove_filter( "the_content", "optinform_insert_form_first_paragraph_post" );
	remove_filter( "the_content", "optinform_insert_form_first_paragraph_page" );
	remove_filter( "the_content", "optinform_insert_form_second_paragraph_post" );
	remove_filter( "the_content", "optinform_insert_form_second_paragraph_page" );
	remove_filter( "the_content", "optinforms_insert_form_after_post" );
	remove_filter( "the_content", "optinforms_insert_form_after_page" );

	return $excerpt;
}
// add_filter( 'get_the_excerpt', 'optinforms_remove_from_excerpt', 1 );
