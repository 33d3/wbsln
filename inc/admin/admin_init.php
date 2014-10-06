<?php
if(is_admin())
	wp_enqueue_style('websolns_admin_css',WBS_THEME_URI.'/inc/admin/css/wbsadmin.css');
require 'cb-admin-functions.php';
require 'social-options.php';