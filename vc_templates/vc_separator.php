<?php
$output = '';
extract(shortcode_atts(array(
    'el_class' => '',
	'type' => '',
	'color' => '',
	'up' => '',
	'down' => '',	
	'thickness' => '',	
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'separator ', $this->settings['base']);
$output .= '<div class="'.$css_class . $type . '"';
$output .=  ' style="';
		if($up != ""){
		$output .= "margin-top:". $up ."px;";
		}
		if($down != ""){
		$output .= "margin-bottom:". $down ."px;"; 
		}
		if($color != ""){
		$output .= "background-color: ". $color .";";
		}
		if($thickness != ""){
		$output .= "height:". $thickness ."px;";
		}
$output .= '">';
$output .= '</div>'.$this->endBlockComment('separator')."\n";

echo $output;