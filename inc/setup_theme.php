<?php
defined('ABSPATH') or die("No script kiddies please!");

if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}


function cb_after_theme(){
	/**
	 * Editor style.
	 */
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', LANGUAGE_ZONE ),
			'top'		=> __( 'Top Menu', LANGUAGE_ZONE ),
			'bottom'	=> __( 'Bottom Menu', LANGUAGE_ZONE ),
	) );
	
	register_sidebar( array(
						'name' => 'Default sidebar',
						'id' => 'sidebar-1',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h4>',
						'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
						'name' => 'Right sidebar',
						'id' => 'right_side_default',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h4>',
						'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
						'name' => 'Left sidebar',
						'id' => 'left_side_default',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h4>',
						'after_title' => '</h4>',
	) );
	
	
	register_sidebar( array(
						'name' => 'Footer Widget Container',
						'id' => 'sidebar-footer',
						'before_widget' => '<div class="col-md-3"><div class="footer-widget">',
						'after_widget' => '</div></div>',
						'before_title' => '<h4>',
						'after_title' => '</h4>',
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
				'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// This theme allows users to set a custom background.
	add_theme_support('custom-background', array(
		'default-color'          => 'e5e5e5',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	));

	add_theme_support( 'custom-header', array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 0,
			'height'                 => 0,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => 'fff',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => 'websolns_header_style',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
	));

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'chat', 'status' ) );

	/**
	 * Allow shortcodes in widgets.
	 *
	*/
	add_filter( 'widget_text', 'do_shortcode' );

	// create upload dir
	wp_upload_dir();
}

add_action( 'after_setup_theme', 'cb_after_theme', 15 );



function cb_theme_scripts(){

	wp_enqueue_style('normalize',WBS_THEME_URI.'/css/lib/normalize.css');
	wp_enqueue_style('wbs_bootstrap',WBS_THEME_URI.'/lib/bt/css/bootstrap.min.css');
	wp_enqueue_style('wbs_fa','//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',array('wbs_bootstrap'));
	wp_enqueue_style('wbs_def_wp_style',WBS_THEME_URI.'/css/wp-defaults.css');
	wp_enqueue_style('wbs_style',WBS_THEME_URI.'/css/main.css',array('normalize','wbs_bootstrap','wbs_def_wp_style'));
	wp_enqueue_script('wbs_bootstrap_js',WBS_THEME_URI.'/lib/bt/js/bootstrap.min.js',array('jquery'));
	wp_enqueue_script('wbs_main_js',WBS_THEME_URI.'/js/main.js',array('jquery'));
	wp_localize_script( 'wbs_main_js', 'cb_aj',array( 'url' => admin_url( 'admin-ajax.php' )) );
}

add_action( 'wp_enqueue_scripts', 'cb_theme_scripts' );


function websolns_header_style(){
	$text_color = get_header_textcolor();
	
	// If no custom color for text is set, let's bail.
	if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	
	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="twentyfourteen-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}


function websolns_customize_register( $wp_customize )
{
	$wp_customize->add_section( 'websolns_colors_section' , array(
			'title'      => __('Websolns Text Colors',LANGUAGE_ZONE),
			'priority'   => 30,
	));
 
    //  =============================
    //  = Link Colours              =
    //  =============================
    $wp_customize->add_setting('link_textcolor', array(
        'default'           => '5f7279',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
		'transport'   => 'postMessage',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_textcolor', array(
        'label'    => __('Link Color', LANGUAGE_ZONE),
        'section'  => 'websolns_colors_section',
        'settings' => 'link_textcolor',
    )));

	//  =============================
	//  = Link Hover Colours        =
	//  =============================
	$wp_customize->add_setting('link_hover_textcolor', array(
			'default'           => '000',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'           => 'option',
			'transport'   => 'postMessage',
	
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_textcolor', array(
			'label'    => __('Link Hover Color', LANGUAGE_ZONE),
			'section'  => 'websolns_colors_section',
			'settings' => 'link_hover_textcolor',
	)));

	//  =============================
	//  = Text Colours              =
	//  =============================
	$wp_customize->add_setting('body_textcolor', array(
			'default'           => '5f7279',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'           => 'option',
			'transport'   => 'postMessage',
	
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_textcolor', array(
			'label'    => __('Text Color', LANGUAGE_ZONE),
			'section'  => 'websolns_colors_section',
			'settings' => 'body_textcolor',
	)));


	$wp_customize->add_section( 'websolns_header_color_section' , array(
			'title'      => __('Websolns Header Colors',LANGUAGE_ZONE),
			'priority'   => 30,
	));

	$wp_customize->add_setting('websoln_top_bgcolor', array(
			'default'           => '68ace5',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'           => 'option',
			'transport'   => 'postMessage',
	
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'websoln_top_bgcolor', array(
			'label'    => __('Top Bar Color', LANGUAGE_ZONE),
			'section'  => 'websolns_header_color_section',
			'settings' => 'websoln_top_bgcolor',
	)));

	$wp_customize->add_setting('websoln_header_bgcolor', array(
			'default'           => '3c709e',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'           => 'option',
			'transport'   => 'postMessage',
	
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'websoln_header_bgcolor', array(
			'label'    => __('Header Color', LANGUAGE_ZONE),
			'section'  => 'websolns_header_color_section',
			'settings' => 'websoln_header_bgcolor',
	)));

	$wp_customize->add_setting('websoln_footer_bgcolor', array(
			'default'           => '68ace5',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
			'type'           => 'option',
			'transport'   => 'postMessage',
	
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'websoln_footer_bgcolor', array(
			'label'    => __('Footer Color', LANGUAGE_ZONE),
			'section'  => 'websolns_header_color_section',
			'settings' => 'websoln_footer_bgcolor',
	)));
 
}
add_action( 'customize_register', 'websolns_customize_register' );

function websolns_customize_css()
{
    ?>
         <style type="text/css">
             a { color:<?php echo get_option('link_textcolor','#5f7279'); ?>; }
             a:hover { color:<?php echo get_option('link_hover_textcolor','#000'); ?>; }
             body { color:<?php echo get_option('body_textcolor','#5f7279'); ?>; }
             #topbar{background:<?php echo get_option('websoln_top_bgcolor','#68ace5')?>;}
             #menu_holder{background:<?php echo get_option('websoln_header_bgcolor','#3c709e')?>;}
             #footer #foot_widget_cont{background:<?php echo get_option('websoln_footer_bgcolor','#68ace5')?>;}
         </style>
    <?php
}
add_action( 'wp_head', 'websolns_customize_css');

function websolns_customizer_live_preview()
{
	wp_enqueue_script('websolns-themecustomizer',WBS_THEME_URI.'/js/theme-customizer.js',array( 'jquery','customize-preview' ),'',true	);
}
add_action( 'customize_controls_enqueue_scripts', 'websolns_customizer_live_preview' );