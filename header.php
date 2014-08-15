<?php 
defined('ABSPATH') or die("No script kiddies please!");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('title'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="shortcut icon" href="<?php echo WBS_THEME_URI ?>/favicon.ico" />
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
  
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<section id="header">
  <div id="topbar">
    <div class="container">
      <div class="row-fluid">
       
      </div>
    </div>  
  </div>
  <div id="menu_holder">
    <div class="container">
      <div class="row-fluid">
        <div class="col-md-2">
        	<?php if ( get_header_image() ) : ?>
        		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
         			<img id="wbs_header_logo" src="<?php header_image()?>"/>
         		</a>
         	<?php else:?>
         		<h3 class="site-title">
         			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
         		</h3>		
         	<?php endif;?>		 
        </div>  
        <div class="col-md-9 col-md-offset-1">
        		<div class="primary-menu-holder">
            		<?php wp_nav_menu(array('theme_location'=>'primary'))?>	
            	</div>
         </div>
      </div>
    </div>  
  </div>  
</section>