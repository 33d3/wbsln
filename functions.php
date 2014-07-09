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