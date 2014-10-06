<?php

function cb_social_create_menu() {
	//create new top-level menu
	add_submenu_page('cb-settings-page', __('Social Options',LANGUAGE_ZONE), __('Social Options',LANGUAGE_ZONE), 'administrator', 'cb-social-options','create_social_setting_page');
	
	//call register settings function
	add_action( 'admin_init', 'register_cb_social_settings' );
}

// create custom plugin settings menu
add_action('admin_menu', 'cb_social_create_menu');

function register_cb_social_settings() {
	//register our settings

	//general options
	register_setting( 'cb_settings-socials', 'social_page_link_facebook' );
	register_setting( 'cb_settings-socials', 'social_page_link_twitter' );
	register_setting( 'cb_settings-socials', 'social_page_link_instagram' );
	register_setting( 'cb_settings-socials', 'social_page_link_youtube' );

}

function create_social_setting_page() {
	?>
<div class="wrap" id="cb_admin_options">
<h2><?php _e('Cheeseboutique Social Options',LANGUAGE_ZONE) ?></h2>
<hr/>

<h2 class="nav-tab-wrapper">
		<a data-id="options-group-0" class="nav-tab buttons-tab nav-tab-active" title="Front Options" href="#">Social Options</a>
</h2>

<form method="post" action="options.php">
	<?php settings_fields( 'cb_settings-socials' ); ?>
	<div id="options-group-0" class="group active">
		
		  <table class="form-table">
		  	 <tr valign="top">
			        <th scope="row"><label><?php _e('Twitter Page Link',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			           	  <input type="text" name="social_page_link_twitter" value="<?php echo get_option('social_page_link_twitter')?get_option('social_page_link_twitter'):''?>" >
			        </td>
		     </tr> 
		      <tr valign="top">
			        <th scope="row"><label><?php _e('Facebook Page Link',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			           	  <input type="text" name="social_page_link_facebook" value="<?php echo get_option('social_page_link_facebook')?get_option('social_page_link_facebook'):''?>" >
			        </td>
		     </tr> 
		      <tr valign="top">
			        <th scope="row"><label><?php _e('Instagram Page Link',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			           	  <input type="text" name="social_page_link_instagram" value="<?php echo get_option('social_page_link_instagram')?get_option('social_page_link_instagram'):''?>" >
			        </td>
		     </tr> 
		      <tr valign="top">
			        <th scope="row"><label><?php _e('Youtube Channel Link',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			           	  <input type="text" name="social_page_link_youtube" value="<?php echo get_option('social_page_link_youtube')?get_option('social_page_link_youtube'):''?>" >
			        </td>
		     </tr> 
		  </table>
		 <p class="submit">
		    <input type="submit" class="button-primary" value="<?php _e('Save Changes',LANGUAGE_ZONE) ?>" />
		    </p>
	</div>	

</form>
</div>
<?php } ?>