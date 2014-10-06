<?php
add_action('admin_enqueue_scripts', function($hook){
	wp_enqueue_media();
	if(!strstr($hook,'websolns-settings-page'))
		return;
	//wp_enqueue_script('websolns_admin_jquery',websolns_THEME_URI.'/inc/admin/libs/jqcustom/js/jquery-1.10.2.js');
	wp_enqueue_script('websolns_admin_jquery_ui',WBS_THEME_URI.'/inc/admin/libs/jqcustom/js/jquery-ui-1.10.4.custom.min.js',array('jquery'));
	wp_enqueue_script('websolns_admin_date_picker',WBS_THEME_URI.'/inc/admin/js/datetime_picker.js',array('websolns_admin_jquery_ui'));
	wp_enqueue_script('websolns_admin_jquery_mask',WBS_THEME_URI.'/inc/admin/js/jquery.mask.min.js',array('jquery'));
	wp_enqueue_script('websolns_admin_options',WBS_THEME_URI.'/inc/admin/js/options_page.js',array('websolns_admin_date_picker'));
	wp_enqueue_style('websolns_admin_date_picker_css',WBS_THEME_URI.'/inc/admin/libs/jqcustom/css/sunny/jquery-ui-1.10.4.custom.min.css');
	wp_enqueue_style('websolns_admin_options_css',WBS_THEME_URI.'/inc/admin/css/admin.css');
	
});

function websolns_create_menu() {

	//create new top-level menu
	add_menu_page(__('WEB Solutions',LANGUAGE_ZONE), __('WEB Solutions',LANGUAGE_ZONE), 'administrator', 'websolns-settings-page', 'websolns_settings_page',get_stylesheet_directory_uri().'/img/wbsadminlogo.png');
	
	//call register settings function
	add_action( 'admin_init', 'register_websolns_settings' );
}

// create custom plugin settings menu
add_action('admin_menu', 'websolns_create_menu');

function register_websolns_settings() {	

	//business_options
	register_setting( 'websolns_settings-group', 'websolns_phone' );
	register_setting( 'websolns_settings-group', 'websolns_address' );
	register_setting( 'websolns_settings-group', 'websolns_notice_enable' );
	register_setting( 'websolns_settings-group', 'websolns_notice' );
	register_setting( 'websolns_settings-group', 'websolns_hours' );
}

function websolns_settings_page() {
?>
<div class="wrap" id="websolns_admin_options">
<h2><?php _e('Cheeseboutique Options','cheeseboutique') ?></h2>
<hr/>

<h2 class="nav-tab-wrapper">
		<a data-id="options-group-0" class="nav-tab buttons-tab nav-tab-active" title="Front Options" href="#">General Options</a>
		<a data-id="options-group-1" class="nav-tab buttons-tab" title="Business Info" href="#">Business Info</a>
</h2>

<form method="post" action="options.php">
	<?php settings_fields( 'websolns_settings-group' ); ?>
	<div id="options-group-0" class="group active">
		<?php include 'inc/general_options.php';?>
	</div>	
	<div id="options-group-1" class="group">
		<?php include 'inc/business_info.php'?>
	</div>
</form>
</div>
<?php } ?>