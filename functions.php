<?php 
defined('ABSPATH') or die("No script kiddies please!");

include 'inc/init.php';

function get_websolns_slider(){
	$id = get_the_ID();
	
	if(get_post_field('check_to_add_slider', $id)){
		
		$slider = get_post_field('select_which_slider_to_use', $id);
		
		switch($slider){
			case 'revolution':
				$slide = get_post_field('revolution_slider', $id);
				echo do_shortcode("[rev_slider $slide]");
				break;
			case 'layer':
				$slide = get_post_field('layer_slider', $id);
				echo do_shortcode("[layerslider id='$slide']");
				break;
			default:
				break;	
		}
		
	}
}


function wbs_page_title($text = null){
	if(get_post_field('wbs_enable_title', get_the_ID()) || $text):
	?>
	<div class="row">
		<header class="col-md-12 point1-shadow">
			<h1 class="article_title">
				<?php 
					if($text):
						echo $text;
					else:
						the_title();
					endif;
				?>
			</h1>
	    </header>  
	  </div> 
	<?php
	endif; 
}

function wbs_get_pages_dropdown(){
	$args = array(
		'sort_order' => 'ASC',
		'sort_column' => 'post_title',
		'hierarchical' => 1,
		'exclude' => '',
		'include' => '',
		'meta_key' => '',
		'meta_value' => '',
		'authors' => '',
		'child_of' => 0,
		'parent' => -1,
		'exclude_tree' => '',
		'number' => '',
		'offset' => 0,
		'post_type' => 'page',
		'post_status' => 'publish'
	);
	
	$result = array('---Select a Page---'=>null);	

	foreach (get_pages($args) as $p)
		$result[$p->post_title] = $p->ID;
	
	return $result;
}


function webs_check_left_sidebar(){
	global $post;
	
	$sidebar = get_post_field('wbs_sidebars', $post->ID);
	
	switch ($sidebar){
		case 1:
			return false;
			break;
		case 2:
			?>
			<div class="col-md-3">
				<?php get_sidebar('left')?>
			</div>
			<div class="col-md-9">
			<?php 
			break;
		case 3:
			?>
			<div class="col-md-9">
			<?php 
			break;
		case 4:
			?>
			<div class="col-md-3">
				<?php get_sidebar('left')?>
			</div>
			<div class="col-md-6">
			<?php 
			break;
		default:
			break;
	}
	
}

function webs_check_right_sidebar(){
	global $post;
	
	$sidebar = get_post_field('wbs_sidebars', $post->ID);
	switch ($sidebar){
		case 1:
			return false;
			break;
		case 2:
			?>
			</div>
			<?php 
			break;
		case 3:
			?>
			</div>
			<div class="col-md-3">
				<?php get_sidebar('right')?>
			</div>
			<?php 
			break;
		case 4:
			?>
			</div>
			<div class="col-md-3">
				<?php get_sidebar('right')?>
			</div>
			<?php 
			break;
		default:
			break;
	}
}



/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);

// Initialising Shortcodes
if (class_exists('WPBakeryVisualComposerAbstract')) {
	function requireVcExtend(){
		require_once locate_template('/extendvc/extend-vc.php');
	}
	add_action('init', 'requireVcExtend',2);
}


add_filter('the_content', 'shortcode_empty_paragraph_fix');

/* Empty paragraph fix in shortcode */

if (!function_exists('shortcode_empty_paragraph_fix')) {
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
}





if (!function_exists('getFontAwesomeIconArray')){
function getFontAwesomeIconArray(){
/*	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	$subject = file_get_contents('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css');

	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

	$icons = array();

	foreach($matches as $match){
    $icons[$match[1]] = '\\'.$match[2];
	}
	foreach($icons as $i=>$icon)
		echo sprintf("'fa %s' => '%s',\n", $i,$icon);
	die; */
	$icons = array (
'fa fa-glass' => '\\f000',
'fa fa-music' => '\\f001',
'fa fa-search' => '\\f002',
'fa fa-envelope-o' => '\\f003',
'fa fa-heart' => '\\f004',
'fa fa-star' => '\\f005',
'fa fa-star-o' => '\\f006',
'fa fa-user' => '\\f007',
'fa fa-film' => '\\f008',
'fa fa-th-large' => '\\f009',
'fa fa-th' => '\\f00a',
'fa fa-th-list' => '\\f00b',
'fa fa-check' => '\\f00c',
'fa fa-times' => '\\f00d',
'fa fa-search-plus' => '\\f00e',
'fa fa-search-minus' => '\\f010',
'fa fa-power-off' => '\\f011',
'fa fa-signal' => '\\f012',
'fa fa-cog' => '\\f013',
'fa fa-trash-o' => '\\f014',
'fa fa-home' => '\\f015',
'fa fa-file-o' => '\\f016',
'fa fa-clock-o' => '\\f017',
'fa fa-road' => '\\f018',
'fa fa-download' => '\\f019',
'fa fa-arrow-circle-o-down' => '\\f01a',
'fa fa-arrow-circle-o-up' => '\\f01b',
'fa fa-inbox' => '\\f01c',
'fa fa-play-circle-o' => '\\f01d',
'fa fa-repeat' => '\\f01e',
'fa fa-refresh' => '\\f021',
'fa fa-list-alt' => '\\f022',
'fa fa-lock' => '\\f023',
'fa fa-flag' => '\\f024',
'fa fa-headphones' => '\\f025',
'fa fa-volume-off' => '\\f026',
'fa fa-volume-down' => '\\f027',
'fa fa-volume-up' => '\\f028',
'fa fa-qrcode' => '\\f029',
'fa fa-barcode' => '\\f02a',
'fa fa-tag' => '\\f02b',
'fa fa-tags' => '\\f02c',
'fa fa-book' => '\\f02d',
'fa fa-bookmark' => '\\f02e',
'fa fa-print' => '\\f02f',
'fa fa-camera' => '\\f030',
'fa fa-font' => '\\f031',
'fa fa-bold' => '\\f032',
'fa fa-italic' => '\\f033',
'fa fa-text-height' => '\\f034',
'fa fa-text-width' => '\\f035',
'fa fa-align-left' => '\\f036',
'fa fa-align-center' => '\\f037',
'fa fa-align-right' => '\\f038',
'fa fa-align-justify' => '\\f039',
'fa fa-list' => '\\f03a',
'fa fa-outdent' => '\\f03b',
'fa fa-indent' => '\\f03c',
'fa fa-video-camera' => '\\f03d',
'fa fa-picture-o' => '\\f03e',
'fa fa-pencil' => '\\f040',
'fa fa-map-marker' => '\\f041',
'fa fa-adjust' => '\\f042',
'fa fa-tint' => '\\f043',
'fa fa-pencil-square-o' => '\\f044',
'fa fa-share-square-o' => '\\f045',
'fa fa-check-square-o' => '\\f046',
'fa fa-arrows' => '\\f047',
'fa fa-step-backward' => '\\f048',
'fa fa-fast-backward' => '\\f049',
'fa fa-backward' => '\\f04a',
'fa fa-play' => '\\f04b',
'fa fa-pause' => '\\f04c',
'fa fa-stop' => '\\f04d',
'fa fa-forward' => '\\f04e',
'fa fa-fast-forward' => '\\f050',
'fa fa-step-forward' => '\\f051',
'fa fa-eject' => '\\f052',
'fa fa-chevron-left' => '\\f053',
'fa fa-chevron-right' => '\\f054',
'fa fa-plus-circle' => '\\f055',
'fa fa-minus-circle' => '\\f056',
'fa fa-times-circle' => '\\f057',
'fa fa-check-circle' => '\\f058',
'fa fa-question-circle' => '\\f059',
'fa fa-info-circle' => '\\f05a',
'fa fa-crosshairs' => '\\f05b',
'fa fa-times-circle-o' => '\\f05c',
'fa fa-check-circle-o' => '\\f05d',
'fa fa-ban' => '\\f05e',
'fa fa-arrow-left' => '\\f060',
'fa fa-arrow-right' => '\\f061',
'fa fa-arrow-up' => '\\f062',
'fa fa-arrow-down' => '\\f063',
'fa fa-share' => '\\f064',
'fa fa-expand' => '\\f065',
'fa fa-compress' => '\\f066',
'fa fa-plus' => '\\f067',
'fa fa-minus' => '\\f068',
'fa fa-asterisk' => '\\f069',
'fa fa-exclamation-circle' => '\\f06a',
'fa fa-gift' => '\\f06b',
'fa fa-leaf' => '\\f06c',
'fa fa-fire' => '\\f06d',
'fa fa-eye' => '\\f06e',
'fa fa-eye-slash' => '\\f070',
'fa fa-exclamation-triangle' => '\\f071',
'fa fa-plane' => '\\f072',
'fa fa-calendar' => '\\f073',
'fa fa-random' => '\\f074',
'fa fa-comment' => '\\f075',
'fa fa-magnet' => '\\f076',
'fa fa-chevron-up' => '\\f077',
'fa fa-chevron-down' => '\\f078',
'fa fa-retweet' => '\\f079',
'fa fa-shopping-cart' => '\\f07a',
'fa fa-folder' => '\\f07b',
'fa fa-folder-open' => '\\f07c',
'fa fa-arrows-v' => '\\f07d',
'fa fa-arrows-h' => '\\f07e',
'fa fa-bar-chart-o' => '\\f080',
'fa fa-twitter-square' => '\\f081',
'fa fa-facebook-square' => '\\f082',
'fa fa-camera-retro' => '\\f083',
'fa fa-key' => '\\f084',
'fa fa-cogs' => '\\f085',
'fa fa-comments' => '\\f086',
'fa fa-thumbs-o-up' => '\\f087',
'fa fa-thumbs-o-down' => '\\f088',
'fa fa-star-half' => '\\f089',
'fa fa-heart-o' => '\\f08a',
'fa fa-sign-out' => '\\f08b',
'fa fa-linkedin-square' => '\\f08c',
'fa fa-thumb-tack' => '\\f08d',
'fa fa-external-link' => '\\f08e',
'fa fa-sign-in' => '\\f090',
'fa fa-trophy' => '\\f091',
'fa fa-github-square' => '\\f092',
'fa fa-upload' => '\\f093',
'fa fa-lemon-o' => '\\f094',
'fa fa-phone' => '\\f095',
'fa fa-square-o' => '\\f096',
'fa fa-bookmark-o' => '\\f097',
'fa fa-phone-square' => '\\f098',
'fa fa-twitter' => '\\f099',
'fa fa-facebook' => '\\f09a',
'fa fa-github' => '\\f09b',
'fa fa-unlock' => '\\f09c',
'fa fa-credit-card' => '\\f09d',
'fa fa-rss' => '\\f09e',
'fa fa-hdd-o' => '\\f0a0',
'fa fa-bullhorn' => '\\f0a1',
'fa fa-bell' => '\\f0f3',
'fa fa-certificate' => '\\f0a3',
'fa fa-hand-o-right' => '\\f0a4',
'fa fa-hand-o-left' => '\\f0a5',
'fa fa-hand-o-up' => '\\f0a6',
'fa fa-hand-o-down' => '\\f0a7',
'fa fa-arrow-circle-left' => '\\f0a8',
'fa fa-arrow-circle-right' => '\\f0a9',
'fa fa-arrow-circle-up' => '\\f0aa',
'fa fa-arrow-circle-down' => '\\f0ab',
'fa fa-globe' => '\\f0ac',
'fa fa-wrench' => '\\f0ad',
'fa fa-tasks' => '\\f0ae',
'fa fa-filter' => '\\f0b0',
'fa fa-briefcase' => '\\f0b1',
'fa fa-arrows-alt' => '\\f0b2',
'fa fa-users' => '\\f0c0',
'fa fa-link' => '\\f0c1',
'fa fa-cloud' => '\\f0c2',
'fa fa-flask' => '\\f0c3',
'fa fa-scissors' => '\\f0c4',
'fa fa-files-o' => '\\f0c5',
'fa fa-paperclip' => '\\f0c6',
'fa fa-floppy-o' => '\\f0c7',
'fa fa-square' => '\\f0c8',
'fa fa-bars' => '\\f0c9',
'fa fa-list-ul' => '\\f0ca',
'fa fa-list-ol' => '\\f0cb',
'fa fa-strikethrough' => '\\f0cc',
'fa fa-underline' => '\\f0cd',
'fa fa-table' => '\\f0ce',
'fa fa-magic' => '\\f0d0',
'fa fa-truck' => '\\f0d1',
'fa fa-pinterest' => '\\f0d2',
'fa fa-pinterest-square' => '\\f0d3',
'fa fa-google-plus-square' => '\\f0d4',
'fa fa-google-plus' => '\\f0d5',
'fa fa-money' => '\\f0d6',
'fa fa-caret-down' => '\\f0d7',
'fa fa-caret-up' => '\\f0d8',
'fa fa-caret-left' => '\\f0d9',
'fa fa-caret-right' => '\\f0da',
'fa fa-columns' => '\\f0db',
'fa fa-sort' => '\\f0dc',
'fa fa-sort-desc' => '\\f0dd',
'fa fa-sort-asc' => '\\f0de',
'fa fa-envelope' => '\\f0e0',
'fa fa-linkedin' => '\\f0e1',
'fa fa-undo' => '\\f0e2',
'fa fa-gavel' => '\\f0e3',
'fa fa-tachometer' => '\\f0e4',
'fa fa-comment-o' => '\\f0e5',
'fa fa-comments-o' => '\\f0e6',
'fa fa-bolt' => '\\f0e7',
'fa fa-sitemap' => '\\f0e8',
'fa fa-umbrella' => '\\f0e9',
'fa fa-clipboard' => '\\f0ea',
'fa fa-lightbulb-o' => '\\f0eb',
'fa fa-exchange' => '\\f0ec',
'fa fa-cloud-download' => '\\f0ed',
'fa fa-cloud-upload' => '\\f0ee',
'fa fa-user-md' => '\\f0f0',
'fa fa-stethoscope' => '\\f0f1',
'fa fa-suitcase' => '\\f0f2',
'fa fa-bell-o' => '\\f0a2',
'fa fa-coffee' => '\\f0f4',
'fa fa-cutlery' => '\\f0f5',
'fa fa-file-text-o' => '\\f0f6',
'fa fa-building-o' => '\\f0f7',
'fa fa-hospital-o' => '\\f0f8',
'fa fa-ambulance' => '\\f0f9',
'fa fa-medkit' => '\\f0fa',
'fa fa-fighter-jet' => '\\f0fb',
'fa fa-beer' => '\\f0fc',
'fa fa-h-square' => '\\f0fd',
'fa fa-plus-square' => '\\f0fe',
'fa fa-angle-double-left' => '\\f100',
'fa fa-angle-double-right' => '\\f101',
'fa fa-angle-double-up' => '\\f102',
'fa fa-angle-double-down' => '\\f103',
'fa fa-angle-left' => '\\f104',
'fa fa-angle-right' => '\\f105',
'fa fa-angle-up' => '\\f106',
'fa fa-angle-down' => '\\f107',
'fa fa-desktop' => '\\f108',
'fa fa-laptop' => '\\f109',
'fa fa-tablet' => '\\f10a',
'fa fa-mobile' => '\\f10b',
'fa fa-circle-o' => '\\f10c',
'fa fa-quote-left' => '\\f10d',
'fa fa-quote-right' => '\\f10e',
'fa fa-spinner' => '\\f110',
'fa fa-circle' => '\\f111',
'fa fa-reply' => '\\f112',
'fa fa-github-alt' => '\\f113',
'fa fa-folder-o' => '\\f114',
'fa fa-folder-open-o' => '\\f115',
'fa fa-smile-o' => '\\f118',
'fa fa-frown-o' => '\\f119',
'fa fa-meh-o' => '\\f11a',
'fa fa-gamepad' => '\\f11b',
'fa fa-keyboard-o' => '\\f11c',
'fa fa-flag-o' => '\\f11d',
'fa fa-flag-checkered' => '\\f11e',
'fa fa-terminal' => '\\f120',
'fa fa-code' => '\\f121',
'fa fa-reply-all' => '\\f122',
'fa fa-star-half-o' => '\\f123',

'fa fa-location-arrow' => '\\f124',
'fa fa-crop' => '\\f125',
'fa fa-code-fork' => '\\f126',
'fa fa-chain-broken' => '\\f127',
'fa fa-question' => '\\f128',
'fa fa-info' => '\\f129',
'fa fa-exclamation' => '\\f12a',
'fa fa-superscript' => '\\f12b',
'fa fa-subscript' => '\\f12c',
'fa fa-eraser' => '\\f12d',
'fa fa-puzzle-piece' => '\\f12e',
'fa fa-microphone' => '\\f130',
'fa fa-microphone-slash' => '\\f131',
'fa fa-shield' => '\\f132',
'fa fa-calendar-o' => '\\f133',
'fa fa-fire-extinguisher' => '\\f134',
'fa fa-rocket' => '\\f135',
'fa fa-maxcdn' => '\\f136',
'fa fa-chevron-circle-left' => '\\f137',
'fa fa-chevron-circle-right' => '\\f138',
'fa fa-chevron-circle-up' => '\\f139',
'fa fa-chevron-circle-down' => '\\f13a',
'fa fa-html5' => '\\f13b',
'fa fa-css3' => '\\f13c',
'fa fa-anchor' => '\\f13d',
'fa fa-unlock-alt' => '\\f13e',
'fa fa-bullseye' => '\\f140',
'fa fa-ellipsis-h' => '\\f141',
'fa fa-ellipsis-v' => '\\f142',
'fa fa-rss-square' => '\\f143',
'fa fa-play-circle' => '\\f144',
'fa fa-ticket' => '\\f145',
'fa fa-minus-square' => '\\f146',
'fa fa-minus-square-o' => '\\f147',
'fa fa-level-up' => '\\f148',
'fa fa-level-down' => '\\f149',
'fa fa-check-square' => '\\f14a',
'fa fa-pencil-square' => '\\f14b',
'fa fa-external-link-square' => '\\f14c',
'fa fa-share-square' => '\\f14d',
'fa fa-compass' => '\\f14e',
'fa fa-caret-square-o-down' => '\\f150',
'fa fa-caret-square-o-up' => '\\f151',
'fa fa-caret-square-o-right' => '\\f152',
'fa fa-eur' => '\\f153',
'fa fa-gbp' => '\\f154',
'fa fa-usd' => '\\f155',
'fa fa-inr' => '\\f156',
'fa fa-jpy' => '\\f157',
'fa fa-rub' => '\\f158',
'fa fa-krw' => '\\f159',
'fa fa-btc' => '\\f15a',
'fa fa-file' => '\\f15b',
'fa fa-file-text' => '\\f15c',
'fa fa-sort-alpha-asc' => '\\f15d',
'fa fa-sort-alpha-desc' => '\\f15e',
'fa fa-sort-amount-asc' => '\\f160',
'fa fa-sort-amount-desc' => '\\f161',
'fa fa-sort-numeric-asc' => '\\f162',
'fa fa-sort-numeric-desc' => '\\f163',
'fa fa-thumbs-up' => '\\f164',
'fa fa-thumbs-down' => '\\f165',
'fa fa-youtube-square' => '\\f166',
'fa fa-youtube' => '\\f167',
'fa fa-xing' => '\\f168',
'fa fa-xing-square' => '\\f169',
'fa fa-youtube-play' => '\\f16a',
'fa fa-dropbox' => '\\f16b',
'fa fa-stack-overflow' => '\\f16c',
'fa fa-instagram' => '\\f16d',
'fa fa-flickr' => '\\f16e',
'fa fa-adn' => '\\f170',
'fa fa-bitbucket' => '\\f171',
'fa fa-bitbucket-square' => '\\f172',
'fa fa-tumblr' => '\\f173',
'fa fa-tumblr-square' => '\\f174',
'fa fa-long-arrow-down' => '\\f175',
'fa fa-long-arrow-up' => '\\f176',
'fa fa-long-arrow-left' => '\\f177',
'fa fa-long-arrow-right' => '\\f178',
'fa fa-apple' => '\\f179',
'fa fa-windows' => '\\f17a',
'fa fa-android' => '\\f17b',
'fa fa-linux' => '\\f17c',
'fa fa-dribbble' => '\\f17d',
'fa fa-skype' => '\\f17e',
'fa fa-foursquare' => '\\f180',
'fa fa-trello' => '\\f181',
'fa fa-female' => '\\f182',
'fa fa-male' => '\\f183',
'fa fa-gittip' => '\\f184',
'fa fa-sun-o' => '\\f185',
'fa fa-moon-o' => '\\f186',
'fa fa-archive' => '\\f187',
'fa fa-bug' => '\\f188',
'fa fa-vk' => '\\f189',
'fa fa-weibo' => '\\f18a',
'fa fa-renren' => '\\f18b',
'fa fa-pagelines' => '\\f18c',
'fa fa-stack-exchange' => '\\f18d',
'fa fa-arrow-circle-o-right' => '\\f18e',
'fa fa-arrow-circle-o-left' => '\\f190',
'fa fa-caret-square-o-left' => '\\f191',
'fa fa-dot-circle-o' => '\\f192',
'fa fa-wheelchair' => '\\f193',
'fa fa-vimeo-square' => '\\f194',
'fa fa-try' => '\\f195',
'fa fa-plus-square-o' => '\\f196',
'fa fa-space-shuttle' => '\\f197',
'fa fa-slack' => '\\f198',
'fa fa-envelope-square' => '\\f199',
'fa fa-wordpress' => '\\f19a',
'fa fa-openid' => '\\f19b',
'fa fa-university' => '\\f19c',
'fa fa-graduation-cap' => '\\f19d',
'fa fa-yahoo' => '\\f19e',
'fa fa-google' => '\\f1a0',
'fa fa-reddit' => '\\f1a1',
'fa fa-reddit-square' => '\\f1a2',
'fa fa-stumbleupon-circle' => '\\f1a3',
'fa fa-stumbleupon' => '\\f1a4',
'fa fa-delicious' => '\\f1a5',
'fa fa-digg' => '\\f1a6',
'fa fa-pied-piper' => '\\f1a7',
'fa fa-pied-piper-alt' => '\\f1a8',
'fa fa-drupal' => '\\f1a9',
'fa fa-joomla' => '\\f1aa',
'fa fa-language' => '\\f1ab',
'fa fa-fax' => '\\f1ac',
'fa fa-building' => '\\f1ad',
'fa fa-child' => '\\f1ae',
'fa fa-paw' => '\\f1b0',
'fa fa-spoon' => '\\f1b1',
'fa fa-cube' => '\\f1b2',
'fa fa-cubes' => '\\f1b3',
'fa fa-behance' => '\\f1b4',
'fa fa-behance-square' => '\\f1b5',
'fa fa-steam' => '\\f1b6',
'fa fa-steam-square' => '\\f1b7',
'fa fa-recycle' => '\\f1b8',
'fa fa-car' => '\\f1b9',
'fa fa-taxi' => '\\f1ba',
'fa fa-tree' => '\\f1bb',
'fa fa-spotify' => '\\f1bc',
'fa fa-deviantart' => '\\f1bd',
'fa fa-soundcloud' => '\\f1be',
'fa fa-database' => '\\f1c0',
'fa fa-file-pdf-o' => '\\f1c1',
'fa fa-file-word-o' => '\\f1c2',
'fa fa-file-excel-o' => '\\f1c3',
'fa fa-file-powerpoint-o' => '\\f1c4',
'fa fa-file-image-o' => '\\f1c5',
'fa fa-file-archive-o' => '\\f1c6',
'fa fa-file-audio-o' => '\\f1c7',
'fa fa-file-video-o' => '\\f1c8',
'fa fa-file-code-o' => '\\f1c9',
'fa fa-vine' => '\\f1ca',
'fa fa-codepen' => '\\f1cb',
'fa fa-jsfiddle' => '\\f1cc',
'fa fa-life-ring' => '\\f1cd',
'fa fa-circle-o-notch' => '\\f1ce',
'fa fa-rebel' => '\\f1d0',
'fa fa-empire' => '\\f1d1',
'fa fa-git-square' => '\\f1d2',
'fa fa-git' => '\\f1d3',
'fa fa-hacker-news' => '\\f1d4',
'fa fa-tencent-weibo' => '\\f1d5',
'fa fa-qq' => '\\f1d6',
'fa fa-weixin' => '\\f1d7',
'fa fa-paper-plane' => '\\f1d8',
'fa fa-paper-plane-o' => '\\f1d9',
'fa fa-history' => '\\f1da',
'fa fa-circle-thin' => '\\f1db',
'fa fa-header' => '\\f1dc',
'fa fa-paragraph' => '\\f1dd',
'fa fa-sliders' => '\\f1de',
'fa fa-share-alt' => '\\f1e0',
'fa fa-share-alt-square' => '\\f1e1',
'fa fa-bomb' => '\\f1e2',
);
	ksort($icons);
  return $icons;
}
}



function websolns_business_info($atts) {

	$args = shortcode_atts( array(), $atts );	

	$phone = get_option ( 'websolns_phone' );
	$address = get_option ( 'websolns_address' );
	$notice_enabled = get_option ( 'websolns_notice_enable' );
	$notice = get_option ( 'websolns_notice' );
	$hours = json_decode ( get_option ( 'websolns_hours' ) );
	
	
	$html =	'<div class="mini-contacts">
				<ul>';
			
	if($notice_enabled && $notice != ''):
		$html .= '<li class="websolns_attention"><div class="truncate">'.get_option('websolns_notice').'</div></li>';
	else:
		
		if ($hours) :
			$today = $hours [intval ( date ( 'N' ) ) - 1];
			
			if ($today->closed) :
				$html .= '<li>
							<a href="'.get_home_url().'/contact'.'">
								<b>'._e('Closed','cheeseboutique').'</b>
					 			'.date(', l, F j').
							'</a>
						</li>';	
			else:
				$start = strtotime ( date ( 'Y-m-d ' ) . $today->start );
				$end = strtotime ( date ( 'Y-m-d ' ) . $today->end );
				$now = time ();

				$html .= '<li>
							<a href="'.get_home_url().'/contact">
								<b>'.($start < $now && $end > $now?__('Open','cheeseboutique'):__('Closed',LANGUAGE_ZONE)).'</b> 
								'.(date(', l, F j, ') . $today->start . ' - ' . $today->end).'
							</a>
						</li>';
			endif;
		endif;
	endif;
	
	if($phone):
		$html .= '<li>
					<a href="tel:'.$phone.'" title="'._e('Call Us','cheeboutique').'"> 
						<b>'.$phone.'</b>
					</a>
				 </li>';
	endif;
	if($address):
		$html .= '<li>
					<a href="https://www.google.com/maps/place/'.urlencode($address).'" target="_blank" title="See on Map">
						<b>'.$address.'</b> 
						<img src="'.WBS_THEME_URI.'/css/img/mapicon.gif" />'._e('',LANGUAGE_ZONE).'
					</a>
				</li>';
	endif;

	$html .= '</ul>
			</div>';
	
	return $html;
}

add_shortcode('business_info', 'websolns_business_info');