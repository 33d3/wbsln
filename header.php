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
         			<img src="<?php header_image()?>"/>
         		</a>
         	<?php else:?>
         		<h3 class="site-title">
         			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
         		</h3>		
         	<?php endif;?>		 
        </div>  
        <div class="col-md-10">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="#">Home</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">

                </ul>
              </li>
            </ul>
         </div>
      </div>
    </div>  
  </div>  
</section>