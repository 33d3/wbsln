<?php
defined('ABSPATH') or die("No script kiddies please!");

/* Sets the path to the parent theme directory URI. */
if ( !defined( 'WBS_THEME_URI' ) ) {
	define( 'WBS_THEME_URI', get_stylesheet_directory_uri() );
}

if(!defined('LANGUAGE_ZONE'))
	define('LANGUAGE_ZONE', 'websolns');

include 'setup_theme.php';
include 'require_plugins.php';
include 'shortcodes.php';