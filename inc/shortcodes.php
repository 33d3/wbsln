<?php
if (!function_exists('register_button')){
function register_button( $buttons ){
   array_push( $buttons, "|", "qode_shortcodes" );
   return $buttons;
}
}

if (!function_exists('add_plugin')){
function add_plugin( $plugin_array ) {
   $plugin_array['qode_shortcodes'] = get_template_directory_uri() . '/inc/qode_shortcodes.js';
   return $plugin_array;
}
}

if (!function_exists('qode_shortcodes_button')){
function qode_shortcodes_button(){
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }
}
}
add_action('init', 'qode_shortcodes_button');


if (!function_exists('no_wpautop')) {
function no_wpautop($content){ 
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}
}
if (!function_exists('num_shortcodes')){
function num_shortcodes($content){ 
    $columns = substr_count( $content, '[pricing_cell' );
	return $columns;
}
}

/* Accordion shortcode */

if (!function_exists('accordion')) {
function accordion($atts, $content = null) {
	extract(shortcode_atts(array("accordion_type"=>""), $atts));
	return "<div class='accordion_holder $accordion_type clearfix'>" . no_wpautop($content) . "</div>";
}
}
add_shortcode('accordion', 'accordion');

/* Accordion item shortcode */

if (!function_exists('accordion_item')) {
function accordion_item($atts, $content = null) {

	extract(shortcode_atts(array("caption"=>"","title_color"=>""), $atts));
	return "<h3 style='color: ".$title_color.";'><span><span class='control-pm'></span></span>".$caption."</h3><div class='accordion_content'><div class='accordion_content_inner'>" . no_wpautop($content) . "</div></div>";
}
}
add_shortcode('accordion_item', 'accordion_item');

/* Action shortcode */

if (!function_exists('action')) {
function action($atts, $content = null) {
	extract(shortcode_atts(array("type"=>"","background_color"=>"","border_color"=>"","link"=>"", "target" => ""), $atts));
	$html =  "<div class='call_to_action";
	if($type == "without_border"){
		$html .= " without_border";
	}
	if($type == "elegant"){
		$html .= " elegant";
	}
	$html .= "'";
	if($background_color != "" || $border_color != ""){
		$html .= " style='";
		if($background_color != ""){
			$html .= "background-color: ".$background_color.";";
		}
		if($border_color != ""){
			$html .= "border-color: ".$border_color.";";
		}
		$html .= "'";
	}
	$html .= ">" . no_wpautop($content);
	if($type == "elegant"){
		$html .= "<a class='cta_button' href='".$link."' target='".$target."'><i class='icon-angle-right icon-align-center'></i></a>";
	}
	$html .= "</div>";
  return $html;
}
}
add_shortcode('action', 'action');

/* Blockquote shortcode */

if (!function_exists('blockquote')) {
function blockquote($atts, $content = null) {
	$html = ""; 
  extract(shortcode_atts(array("width"=>"", "text"=>"", "border_color"=>""), $atts));
	$html .= "<blockquote"; 
	if($width != "" || $border_color != ""){
		$html .= " style='";
		if($width != ""){
			$html .= "width: ".$width."%;";
		}
		if($border_color != ""){
			$html .= "border-color: ".$border_color.";";
		}
		$html .= "'";
	}
	$html .= "><i class='icon-quote-right pull-left'></i><h5>".$text."</h5></blockquote>";
  return $html;
}
}
add_shortcode('blockquote', 'blockquote');

/* Buttons shortcode */

if (!function_exists('button')) {
function button($atts, $content = null) {
	global $qode_options_subway;
	$html = "";
	extract(shortcode_atts(array("size"=>"", "type"=>"", "border_color"=>"","color"=>"","background_color"=>"","font_style"=>"","text"=>"","link"=>"","target"=>""), $atts));
	if($target == ""){
		$target = "_self";
	}
    $html .=  '<a href="'.$link.'" target="'.$target.'" class="qbutton '.$size.' '.$type.'" style="';
		if($color != ""){
			$html .= 'color: '.$color.'; ';
		}
		if($background_color != ""){
			$html .= 'background-color: '.$background_color.'; ';
		}
		if($font_style != ""){
			$html .= 'font-style: '.$font_style.'; ';
		}
		if($border_color != ""){
			$html .= 'border-color: '.$border_color.'; ';
		}
		$html .= '">'.$text.'</a>';

    return $html;
}
}
add_shortcode('button', 'button');

/* Counter shortcode */

if (!function_exists('counter')) {
function counter($atts, $content = null) {
		extract(shortcode_atts(array("type"=>"","position"=>"","digit"=>"","font_size"=>"","font_color"=>""), $atts));
    $html = "";  
		$html .=  '<div class="counter_holder '.$position.'"><span class="counter '.$type.'"';
		if($font_color != "" || $font_size != ""){
			$html .= ' style="color:'.$font_color.'; font-size:'.$font_size.'px; height:'.$font_size.'px; line-height:'.$font_size.'px;"';
		} 
		$html .= '>'.$digit.'</span>'.no_wpautop($content).'</div>';
    return $html;
}
}
add_shortcode('counter', 'counter');

/* Custom font shortcode */

if (!function_exists('custom_font')) {
function custom_font($atts, $content = null) {
	extract(shortcode_atts(array("font_family"=>"","font_size"=>"","line_height"=>"","font_style"=>"","font_weight"=>"","color"=>"","text_decoration"=>"","background_color"=>"","padding"=>"","margin"=>"","text_align"=>"left"), $atts));
    $html = '';  
	$html .= '<span class="custom_font_holder" style="';
	if($font_family != ""){
		$html .= 'font-family: '.$font_family.';';
	}
	if($font_size != ""){
		$html .= ' font-size: '.$font_size.'px;';
	}
	if($line_height != ""){
		$html .= ' line-height: '.$line_height.'px;';
	}
	if($font_style != ""){
		$html .= ' font-style: '.$font_style.';';
	}
	if($font_weight != ""){
		$html .= ' font-weight: '.$font_weight.';';
	}
	if($color != ""){
		$html .= ' color: '.$color.';';
	}
	if($text_decoration != ""){
		$html .= ' text-decoration: '.$text_decoration.';';
	}
	if($background_color != ""){
		$html .= ' background-color: '.$background_color.';';
	}
	if($padding != ""){
		$html .= ' padding: '.$padding.';';
	}
	if($margin != ""){
		$html .= ' margin: '.$margin.';';
	}
	$html .= ' text-align: ' . $text_align . ';';
	$html .= '">'.no_wpautop($content).'</span>';
    return $html;
}
}
add_shortcode('custom_font', 'custom_font');

/* Dropcaps shortcode */

if (!function_exists('dropcaps')) {
function dropcaps($atts, $content = null) {
	extract(shortcode_atts(array("color"=>"","background_color"=>"","border_color"=>""), $atts));
	$html = "<span class='dropcap' style='";
	if($background_color != ""){
		$html .= "background-color: $background_color;";
	}
	if($color != ""){
		$html .= " color: $color;";
	}
	if($border_color != ""){
		$html .= " border-color: $border_color;";
	}
	$html .= "'>" . no_wpautop($content)  . "</span>";
	
	return $html;
}
}
add_shortcode('dropcaps', 'dropcaps');

/* Highlights shortcode */

if (!function_exists('highlight')) {
function highlight($atts, $content = null) {
	extract(shortcode_atts(array("color"=>"","background_color"=>""), $atts));
	$html =  "<span class='highlight'";
	if($color != "" || $background_color != ""){
		$html .= " style='color: ".$color."; background-color:".$background_color.";'";
	}
	$html .= ">" . $content . "</span>";  
    return $html;
}
}
add_shortcode('highlight', 'highlight');

/* Image with text shortcode */

if (!function_exists('image_with_text')) {
function image_with_text($atts, $content = null) {
	extract(shortcode_atts(array("image" =>"", "title"=>"", "title_color"=>""), $atts));
	$html = '';
	$html .= '<div class="image_with_text">';
	if(is_numeric($image)) {
		$image_src = wp_get_attachment_url( $image ); 
	}else {
		$image_src = $image; 
	}
	$html .= '<img src="'.$image_src.'" alt="'.$title.'" />';
	$html .= '<h3 ';
	if($title_color != ""){
		$html .= 'style="color:'.$title_color.';"';
	}
	$html .= '>'.$title.'</h3>';
	$html .= '<span style="margin: 6px 0px;" class="separator transparent"></span>';
	$html .= do_shortcode($content);
	$html .= '</div>';
	
	return $html;
}
}
add_shortcode('image_with_text', 'image_with_text');

/* Image with text over shortcode */

if (!function_exists('image_with_text_over')) {
function image_with_text_over($atts, $content = null) {
	extract(shortcode_atts(array("image" =>"","title"=>"","title_color"=>"","subtitle"=>"","subtitle_color"=>"","line_color"=>""), $atts));
	$html = '';
	$html .= '<div class="image_with_text_over"><div class="shader"></div>';
	if(is_numeric($image)) {
		$image_src = wp_get_attachment_url( $image ); 
	}else {
		$image_src = $image; 
	}
	$html .= '<img src="'.$image_src.'" alt="'.$title.'" />';
	$html .= '<div class="text"><table><tr><td><div class="caption"';
	if($title_color != ""){
		$html .= ' style="color:'.$title_color.';"';
	}
	$html .= '>'.$title.'</div><span class="over_line"';
	if($line_color != ""){
		$html .= ' style="background-color:'.$line_color.';"';
	}
	$html .= '></span><div class="subtitle"';
	if($subtitle_color != ""){
		$html .= ' style="color:'.$subtitle_color.';"';
	}
	$html .= '>'.$subtitle.'</div></td></tr></table><table><tr><td><div class="desc">'.do_shortcode($content).'</div></td></tr></table></div></div>';
	
	return $html;
}
}
add_shortcode('image_with_text_over', 'image_with_text_over');

/* Image with text and icon shortcode */

if (!function_exists('image_with_text_and_icon')) {
function image_with_text_and_icon($atts, $content = null) {
	extract(shortcode_atts(array("image" =>"","icon_size"=>"","icon_background_color"=>"","icon"=>"", "link"=>"" ,"target"=>"", "title"=>"", "title_color"=>""), $atts));
	$html = '';
	$html .= '<div class="box_image_with_border"><div class="box_image_holder">';
	if($link != ""){
			$html .= '<a href="'.$link.'" target="'.$target.'">';
	}
	$html .= '<span class="box_image_shadow"></span><span class="image_holder_inner">';
	if(is_numeric($image)) {
		$image_src = wp_get_attachment_url( $image ); 
	}else {
		$image_src = $image; 
	}
	$html .= '<img src="'.$image_src.'" alt="'.$title.'" />';
	$html .= '</span>';
	if($icon_background_color == ""){ $icon_background_color = '#1E9944';}
	$html .= '<span class="box_icon"><span class="icon-stack"';
	if($icon_size != ""){
		$html .= ' style="font-size:'.$icon_size.'em;"';
	}
	$html .= '><i class="icon-circle icon-stack-base" style="color: '.$icon_background_color.';"></i><i class="'.$icon.' icon-light"></i></span></span>';
	if($link != ""){
		$html .= '</a>';
	}
	$html .= '</div>';
	$html .= '<h3 ';
	if($title_color != ""){
		$html .= 'style="color:'.$title_color.';"';
	}
	$html .= '>'.$title.'</h3>';
	$html .= do_shortcode($content);
	$html .= '<span class="separator transparent" style="margin: 12px 0;"></span></div>';
	return $html;
}
}
add_shortcode('image_with_text_and_icon', 'image_with_text_and_icon');

/* Latest post shortcode */

if (!function_exists('latest_post')) {
function latest_post($atts, $content = null) {
  	$html = ""; 
	extract(shortcode_atts(array("post_number_per_row"=>"","rows"=>"","order_by"=>"","order"=>"","category"=>"","text_length"=>""), $atts));
	
	$q = new WP_Query( 
	   array('orderby'=>$order_by,'order'=>$order,'posts_per_page'=>$post_number_per_row*$rows,'category_name'=>$category) 
	);		

	$html .= "<div class='latest_post_holder'><ul>";

		while($q->have_posts()) : $q->the_post();
			$cat = get_the_category();
			$html .= '<li class="';
			if($post_number_per_row == 2){
				$html .= 'two';
			} else if($post_number_per_row == 3){
				$html .= 'three';
			} else if($post_number_per_row == 4){
				$html .= 'four';
			} 

			if($text_length > 0){
				$html .= '"><div class="latest_post"><a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_id(),'full').'</a><div class="latest_post_text"><div class="latest_post_inner"><span class="latest_date"><span class="date">'.get_post_time('d').'</span><span class="month">'.get_post_time('M', true, get_the_ID(), true).'</span></span><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4><span class="latest_category">'. __('In','qode');
				foreach($cat as $categ) {
					$html .=' <a href="'.get_category_link($categ->term_id).'">'.$categ->cat_name.'</a> ';
				}
				$html .='</span></div><p>'.substr(get_the_excerpt(), 0, intval($text_length)).'...</p></div></div></li>';
			} else {
				$html .= '"><div class="latest_post"><a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_id(),'full').'</a><div class="latest_post_text"><div class="latest_post_inner"><span class="latest_date"><span class="date">'.get_post_time('d').'</span><span class="month">'.get_post_time('M', true, get_the_ID(), true).'</span></span><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4><span class="latest_category">'. __('In','qode');
				foreach($cat as $categ) {
					$html .=' <a href="'.get_category_link($categ->term_id).'">'.$categ->cat_name.'</a> ';
				}
				$html .='</span></div></div></div></li>';
			}    		
		
		endwhile;
		wp_reset_query();

	$html .= "</ul></div>";
	return $html;	
}
}
add_shortcode('latest_post', 'latest_post');

/* Line graph shortcode */

if (!function_exists('line_graph')) {
function line_graph($atts, $content = null) {
	global $qode_options_infographer;
	extract(shortcode_atts(array("type" => "rounded", "custom_color" => "", "labels" => "", "width" => "750", "height" => "350", "scale_steps" => "6", "scale_step_width" => "20"), $atts));
	$id = mt_rand(1000, 9999);
	if($type == "rounded"){
		$bezierCurve = "true";
	}else{
		$bezierCurve = "false";
	}
	
	$id = mt_rand(1000, 9999);
	$html = "<div class='line_graf_holder'><div class='line_graf'><canvas id='lineGraph".$id."' height='".$height."' width='".$width."'></canvas></div><div class='line_graf_legend'><ul>";
	$line_graph_array = explode(";", $content);
	for ($i = 0 ; $i < count($line_graph_array) ; $i = $i + 1){
		$line_graph_el = explode(",", $line_graph_array[$i]);
		$html .=  "<li><div class='color_holder' style='background-color: ".trim($line_graph_el[0]).";'></div><p style='color: ".$custom_color.";'>".trim($line_graph_el[1])."</p></li>";   
	}
	$html .=  "</ul></div></div><script>var lineGraph".$id." = {labels : [";
	$line_graph_labels_array = explode(",", $labels);
	for ($i = 0 ; $i < count($line_graph_labels_array) ; $i = $i + 1){
		if ($i > 0) $html .= ",";
		$html .=  '"'.$line_graph_labels_array[$i].'"';
	}
	$html .= "],";
	$html .= "datasets : [";
	$line_graph_array = explode(";", $content);
	for ($i = 0 ; $i < count($line_graph_array) ; $i = $i + 1){
		$line_graph_el = explode(",", $line_graph_array[$i]);
		if ($i > 0) $html .= ",";
		$values = "";
		for ($j = 2 ; $j < count($line_graph_el) ; $j = $j + 1){
			if ($j > 2) $values .= ",";
			$values .= $line_graph_el[$j];
		}
		$color = hex2rgb(trim($line_graph_el[0]));
		$html .=  "{fillColor: 'rgba(".$color[0].",".$color[1].",".$color[2].",0.7)',data:[".$values."]}";   
	}
	if(!empty($qode_options_infographer['text_fontsize'])){
		$text_fontsize = $qode_options_infographer['text_fontsize'];
	}else{
		$text_fontsize = 15;
	}
	if(!empty($qode_options_infographer['text_color']) && $custom_color == ""){
		$text_color = $qode_options_infographer['text_color'];
	} else if(empty($qode_options_infographer['text_color']) && $custom_color != ""){
		$text_color = $custom_color;
	} else if(!empty($qode_options_infographer['text_color']) && $custom_color != ""){
		$text_color = $custom_color;
	}else{
		$text_color = '#626262';
	}
	$html .= "]};
			var \$j = jQuery.noConflict();
			\$j(document).ready(function() {
				if(\$j('.touch .no_delay').length){
					new Chart(document.getElementById('lineGraph".$id."').getContext('2d')).Line(lineGraph".$id.",{scaleOverride : true,
					scaleStepWidth : ".$scale_step_width.",
					scaleSteps : ".$scale_steps.",
					bezierCurve : ".$bezierCurve.",
					pointDot : false,
					scaleLineColor: '#000000',
					scaleFontColor : '".$text_color."',
					scaleFontSize : ".$text_fontsize.",
					scaleGridLineColor : '#e1e1e1',
					datasetStroke : false,
					datasetStrokeWidth : 0,
					animationSteps : 120,});
				}else{
					\$j('#lineGraph".$id."').appear(function() {
						new Chart(document.getElementById('lineGraph".$id."').getContext('2d')).Line(lineGraph".$id.",{scaleOverride : true,
						scaleStepWidth : ".$scale_step_width.",
						scaleSteps : ".$scale_steps.",
						bezierCurve : ".$bezierCurve.",
						pointDot : false,
						scaleLineColor: '#000000',
						scaleFontColor : '".$text_color."',
						scaleFontSize : ".$text_fontsize.",
						scaleGridLineColor : '#e1e1e1',
						datasetStroke : false,
						datasetStrokeWidth : 0,
						animationSteps : 120,});
					},{accX: 0, accY: -200});
				}						
			});
		</script>";
	return $html;
}
}
add_shortcode('line_graph', 'line_graph');

/* Message shortcode */

if (!function_exists('message')) {
function message($atts, $content = null) {
	global $qode_options_subway;
  extract(shortcode_atts(array("type"=>"", "background_color"=>"","border_color"=>"", "icon"=>"", "custom_icon"=>""), $atts));
	
	$html = ""; 
	$html .= "<div class='message";
	if($type == "with_icon"){
		$html .= " with_icon";
	}
	$html .= "'";
	if($background_color != "" || $border_color != ""){
		$html .= "style='";
			if($background_color != ""){
				$html .= "background-color: ".$background_color.";";
			}
			if($border_color != ""){
				$html .= "border-color: ".$border_color.";";
			}
		$html .= "'";
	}
	$html .= ">";
	if($type == "with_icon"){
		if($custom_icon != "") {
			if(is_numeric($custom_icon)) {
				$custom_icon_src = wp_get_attachment_url( $custom_icon ); 
			}else {
				$custom_icon_src = $custom_icon; 
			}
			$html .= '<img src="' . $custom_icon_src . '" alt="">';
		}else {
			$html .= "<i class='".$icon." pull-left'></i>";
		}
	}
	$html .= "<a href='#' class='close'><i class='icon-remove'></i></a><div class='message_text'>".do_shortcode($content)."</div></div>";
	return $html;
}
}
add_shortcode('message', 'message');

/* More/Less Facts shortcode */

if (!function_exists('more_less_facts')) {
function more_less_facts($atts, $content = null) {
	extract(shortcode_atts(array("more_button_label" =>"","less_button_label"=>"","button_position"=>"","background_color"=>"","color"=>"","border_color"=>""), $atts));
	$html =  "<div class='more_facts_holder'><div class='more_facts_outer'><div class='more_facts_inner'>".no_wpautop($content)."</div></div><div class='more_facts_button_holder ".$button_position."'><span class='qbutton more_facts_button' data-morefacts='".$more_button_label."' data-lessfacts='".$less_button_label."'";
	if($background_color != "" || $color != "" || $border_color != ""){
		$html .= " style='";
		if($background_color != ""){
			$html .= "background-color: ".$background_color.";";
		}
		if($color != ""){
			$html .= " color: ".$color.";";
		}
		if($border_color != ""){
			$html .= " border-color: ".$border_color.";";
		}
		$html .= "'";
	}
	$html .=">".$more_button_label."</span></div></div>";	
	return $html;
}
}
add_shortcode('more_less_facts', 'more_less_facts');

/* Ordered List shortcode */

if (!function_exists('ordered_list')) {
function ordered_list($atts, $content = null) {
    $html =  "<div class=ordered>" . $content . "</div>";  
    return $html;
}
}
add_shortcode('ordered_list', 'ordered_list');

/* Pie Chart shortcode */

if (!function_exists('pie_chart')) {
function pie_chart($atts, $content = null) {
	extract(shortcode_atts(array("title"=>"","title_color"=>"","percent"=>"","percentage_color"=>"","active_color"=>"","noactive_color"=>"","line_width"=>"", "text"=>""), $atts));
    $html =  "<div class='pie_chart_holder'><div class='percentage' data-percent='".$percent."' data-linewidth='".$line_width."' data-active='".$active_color."' data-noactive='".$noactive_color."' style='color: ".$percentage_color.";'><span class='tocounter'>".$percent."</span>%</div>";

    if(empty($title) && (empty($content) || $content == null || $content == "")){
    	$html .= "</div>"; 
    } else {
    	$html .= "<div class='pie_chart_text'><h3 style='color: ".$title_color.";' >".$title."</h3>" . no_wpautop($content) . "</div></div>";
    }
		
		$html = '';
		$html .= '<div class="pie_chart_holder"><div class="percentage" data-percent="'.$percent.'" data-linewidth="'.$line_width.'" data-active="'.$active_color.'" data-noactive="'.$noactive_color.'"';
		if($percentage_color != ""){
			$html .= ' style="color: '.$percentage_color.';"';
		}
		$html .= '><span class="tocounter">'.$percent.'</span>';
		$html .= '</div><div class="pie_chart_text">';
		if($title != ""){
			$html .= '<h3';
			if($title_color != ""){
				$html .= ' style="color: '.$title_color.';"';
			}
			$html .= '>'.$title.'</h3>';
		}
		if($text != ""){
			$html .= '<p>'.$text.'</p>';
		}
		$html .= "</div></div>";
    return $html;
}
}
add_shortcode('pie_chart', 'pie_chart');

/* Pie chart 2 shortcode */

if (!function_exists('pie_chart2')) {
function pie_chart2($atts, $content = null) {
	extract(shortcode_atts(array("width" => "180", "height" => "180", "color" => ""), $atts));
    $id = mt_rand(1000, 9999);
    $html = "<div class='pie_graf_holder'><div class='pie_graf'><canvas id='pie".$id."' height='".$height."' width='".$width."'></canvas></div><div class='pie_graf_legend'><ul>";
    $pie_chart_array = explode(";", $content);
    for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
    	$pie_chart_el = explode(",", $pie_chart_array[$i]);
		$html .= "<li><div class='color_holder' style='background-color: ".trim($pie_chart_el[1]).";'></div><p style='color: ".$color.";'>".trim($pie_chart_el[2])."</p></li>";   
    }
    $html .= "</ul></div></div><script>var pie".$id." = [";
    $pie_chart_array = explode(";", $content);
    for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
    	$pie_chart_el = explode(",", $pie_chart_array[$i]);
    	if ($i > 0) $html .= ",";
		$html .= "{value: ".trim($pie_chart_el[0]).",color:'".trim($pie_chart_el[1])."'}";   
    }
    $html .= "];
		var \$j = jQuery.noConflict();
		\$j(document).ready(function() {
			if(\$j('.touch .no_delay').length){
				new Chart(document.getElementById('pie".$id."').getContext('2d')).Pie(pie".$id.",{segmentStrokeColor : 'transparent',});
			}else{
				\$j('#pie".$id."').appear(function() {
					new Chart(document.getElementById('pie".$id."').getContext('2d')).Pie(pie".$id.",{segmentStrokeColor : 'transparent',});
				},{accX: 0, accY: -200});
			}
		});
	</script>";
    return $html;
}
}
add_shortcode('pie_chart2', 'pie_chart2');


/* Pie chart 3 shortcode */

if (!function_exists('pie_chart3')) {
function pie_chart3($atts, $content = null) {
    extract(shortcode_atts(array("width" => "180", "height" => "180", "color" => ""), $atts));
    $id = mt_rand(1000, 9999);
    $html = "<div class='pie_graf_holder'><div class='pie_graf'><canvas id='pie".$id."' height='".$height."' width='".$width."'></canvas></div><div class='pie_graf_legend'><ul>";
    $pie_chart_array = explode(";", $content);
    for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
    	$pie_chart_el = explode(",", $pie_chart_array[$i]);
		$html .= "<li><div class='color_holder' style='background-color: ".trim($pie_chart_el[1]).";'></div><p style='color: ".$color.";'>".trim($pie_chart_el[2])."</p></li>";   
    }
    $html .= "</ul></div></div><script>var pie".$id." = [";
    $pie_chart_array = explode(";", $content);
    for ($i = 0 ; $i < count($pie_chart_array) ; $i = $i + 1){
    	$pie_chart_el = explode(",", $pie_chart_array[$i]);
    	if ($i > 0) $html .= ",";
			$html .= "{value: ".trim($pie_chart_el[0]).",color:'".trim($pie_chart_el[1])."'}";   
    }
    $html .= "];
		var \$j = jQuery.noConflict();
		\$j(document).ready(function() {
			if(\$j('.touch .no_delay').length){
				new Chart(document.getElementById('pie".$id."').getContext('2d')).Doughnut(pie".$id.",{segmentStrokeColor : 'transparent',});
			}else{
				\$j('#pie".$id."').appear(function() {
					new Chart(document.getElementById('pie".$id."').getContext('2d')).Doughnut(pie".$id.",{segmentStrokeColor : 'transparent',});
				},{accX: 0, accY: -200});
			}							
		});
	</script>";
    return $html;
}
}
add_shortcode('pie_chart3', 'pie_chart3');

/* Portfolio shortcode */

if (!function_exists('portfolio_list')) {
function portfolio_list($atts, $content = null) {
	
	global $wp_query;
	global $portfolio_project_id;
	global $qode_options_subway;
	$portfolio_qode_like = "on";
	if (isset($qode_options_subway['portfolio_qode_like'])) {
		$portfolio_qode_like = $qode_options_subway['portfolio_qode_like'];
	}
	$html = "";
	extract(shortcode_atts(array("type" => "standard", "columns" => "3", "order_by" => "menu_order" , "order" => "ASC" , "number"=>"-1", "filter"=>'no', "lightbox"=>'yes', "category"=>"", "selected_projects"=>"", "show_load_more" => "yes"), $atts));
	
	$html .= "<div class='projects_holder_outer v$columns'>";
	if($filter == "yes"){
		$html .= "<div class='filter_outer'><div class='filter_holder'>
						<ul>
						<li class='label'><span data-label='". __('Filter','qode') ."'>". __('Filter','qode') ."</span><i class='icon-angle-down'></i>
						<div class='arrow'></div>
						</li>
						<li class='filter' data-filter='all'><span>". __('All','qode') ."</span></li>";
				if ($category == "") {
					$args = array(
						'parent'  => 0
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				} else {
					$top_category = get_term_by('slug',$category,'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id)) $term_id = $top_category->term_id;
					$args = array(
						'parent'  => $term_id
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				}
				foreach($portfolio_categories as $portfolio_category) {
					$html .=	"<li class='filter' data-filter='$portfolio_category->slug'><span>$portfolio_category->name</span>";
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$html .= '</li>';
				}
		$html .= "</ul></div></div>";
	}
	$_type_class = '';
	if($type == "hover_text"){
		$_type_class = " hover_text";
	} elseif ($type == "bottom_text"){
		$_type_class = " hover_text with_mask";
	}
	$html .= "<div class='projects_holder clearfix v$columns$_type_class'>\n";
	if (get_query_var('page'))
		$paged = get_query_var('page');
	else {
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	}
	if ($category == "") {
		$args = array(
			'post_type'=> 'portfolio_page',
			'orderby' => $order_by,
			'order' => $order,
			'posts_per_page' => $number,
			'paged' => $paged
		);
	} else {
		$args = array(
			'post_type'=> 'portfolio_page',
			'portfolio_category' => $category,
			'orderby' => $order_by,
			'order' => $order,
			'posts_per_page' => $number,
			'paged' => $paged
		);
	}
	$project_ids = null;
	if ($selected_projects != "") {
		$project_ids = explode(",",$selected_projects);
		$args['post__in'] = $project_ids;
	}
	query_posts( $args );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
	$html .= "<article class='mix ";
	foreach($terms as $term) {
		$html .= "$term->slug ";
	}

    $title = get_the_title();
    $featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); //original size  
    $large_image = $featured_image_array[0];
    $slug_list_ = "pretty_photo_gallery";

	$html .="'>";
	
	$html .= "<div class='image_holder'>";
	$html .= "<span class='image'>";
	$html .= get_the_post_thumbnail(get_the_ID(),'full');
	if($type == "bottom_text"){
		$html .= "<span class='image_hover'>";
			$html .= '<h4><a href="'. get_permalink() . '">'.get_the_title().'</a></h4>';
		$html .= "</span>";
	}
	$html .= "</span>";
	$html .= "<span class='text_holder'>";
		$html .= "<span class='text_outer'>";
			$html .= "<span class='text_inner'><span class='feature_holder'>";
				if($type != "standard") {
					$html .= '<h4><a href="'. get_permalink() . '">'.get_the_title().'</a></h4>';
					$html .= '<span class="project_category">';
					$k=1;
					foreach($terms as $term) {
						$html .= "$term->name";
						if(count($terms) != $k){
							$html .= ', ';
						}
					$k++;
					}
					$html .= '</span>';
				}
				if($lightbox == "yes"){
					$html .= "<a class='lightbox' title='" . $title . "' href='" . $large_image . "' data-rel='prettyPhoto[".$slug_list_."]'><i class='icon-search icon-2x'></i>".__('Zoom','qode')."</a>";
				}
			$html .= "<a class='preview' href='". get_permalink() ."'><i class='icon-link icon-2x'></i>".__('View','qode')."</a>";
				if($type != "standard") {
				if($portfolio_qode_like == "on") {
				$html .= "<span class='portfolio_like'>";
					$portfolio_project_id = get_the_ID();
				
					if(function_exists('qode_like_portfolio_list')){
						$html .= qode_like_portfolio_list();
					}
					$html .= "</span>";
				}  }
			$html .= "</span></span>";
		$html .= "</span>";
	$html .= "</span>";
	$html .= "</div>";
	if($type == "standard") {
	$html .= "<div class='portfolio_description'>";
	$html .= '<h4><a href="'. get_permalink() . '">'.get_the_title().'</a></h4>';
	$html .= '<span class="project_category">';
	$k=1;
	foreach($terms as $term) {
		$html .= "$term->name";
		if(count($terms) != $k){
			$html .= ', ';
		}
	$k++;
	}
	$html .= '</span>';
	if($portfolio_qode_like == "on") {
		$html .= "<div class='portfolio_like'>";
		$portfolio_project_id = get_the_ID();
		if(function_exists('qode_like_portfolio_list')){
			$html .= qode_like_portfolio_list();
		}
		$html .= "</div>";
	}
	$html .= "</div>";
	}
	$html .= "</article>\n";
						
	endwhile; 
	
	$i = 1;
	while ($i <= $columns) {
		$i++;
		if($columns != 1){	
			$html .= "<div class='filler'></div>\n";
		}
	}
	
	else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.','qode'); ?></p>
	<?php endif; 	
	
	
	$html .= "</div>";
	if(get_next_posts_link()) {
		if($show_load_more == "yes" || $show_load_more == ""){
			$html .= '<div class="portfolio_paging"><span rel="'. $wp_query->max_num_pages .'" class="load_more">'. get_next_posts_link(__('SHOW MORE','qode')) . '</span></div>';
		}
	}
	$html .= "</div>";
	wp_reset_query();	
    return $html;
}
}
add_shortcode('portfolio_list', 'portfolio_list');


/* Pricing table column shortcode */

if (!function_exists('pricing_column')) {
function pricing_column($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("title"=>'',"class"=>"","price" => "0","currency"=>"$","price_period"=>"/mo","link"=>"","target"=>"","button_text"=>"Buy Now","active"=>""), $atts));
	if($target == ""){
		$target = "_self";
	}
	$html .=  "<div class='price_table'><div class='price_table_inner ".$class."'>";
	if($active == "yes"){
		$html .= "<div class='active_best_price'><p>". __('Best','qode') ."</p></div>";
	} 
	
	$html .= "<ul><li class='prices'><div class='price_in_table'><sup class='value'>".$currency."</sup><span class='price'>".$price."</span><sub class='mark'>".$price_period."</sub></div></li><li class='cell table_title'>$title</li>" . no_wpautop($content) . "<li class='price_button'><a class='button' href='$link' target='$target'>".$button_text."</a></li></ul></div></div>";
    return $html;
}
}
add_shortcode('pricing_column', 'pricing_column');

/* Progress bar horizontal shortcode */

if (!function_exists('progress_bar')) {
function progress_bar($atts, $content = null) {
	extract(shortcode_atts(array("title"=>"", "title_color"=>"", "percent"=>"" ,"percent_color"=>"","active_background_color"=>"","noactive_background_color"=>"","height"=>""), $atts));
	$html = "";
	
	$html =  "<div class='progress_bar'><span class='progress_title'><h4";
	if($title_color != ""){
		$html .= " style='color: ".$title_color.";'";
	}
	$html .= ">".$title."</h4></span>";
	$html .= "<span class='progress_number'";
	if($percent_color != ""){
		$html .= " style='color: ".$percent_color.";'";
	}
	$html .= "><span>".$percent."</span>%</span>";
	$html .= "<div class='progress_content_outer'";
	if($height != "" || $noactive_background_color != ""){
		$html .= " style='";
		if($height != ""){
			$html .= "height: ".$height."px;";
		}
		if($noactive_background_color != ""){
			$html .= "background-color: ".$noactive_background_color.";";
		}
		$html .= "'";
	}
	$html .= "><div data-percentage='".$percent."' class='progress_content'";
	if($height != "" || $active_background_color != ""){
		$html .= " style='";
		if($height != ""){
			$html .= "height: ".$height."px;";
		}
		if($active_background_color != ""){
			$html .= "background-color: ".$active_background_color.";";
		}
		$html .= "'";
	}
	$html .="></div></div></div>";
  return $html;
}
}
add_shortcode('progress_bar', 'progress_bar');

/* Progress bars icon shortcode */

if (!function_exists('progress_bar_icon')) {
function progress_bar_icon($atts, $content = null) {
	extract(shortcode_atts(array("icons_number" => "","active_number" => "","type"=>"","icon" => "","size" => "","custom_size" => "","icon_color"=>"","icon_active_color"=>"","background_color"=>"","background_active_color"=>"","border_color"=>"","border_active_color"=>""), $atts));
    $html =  "<div class='progress_bars_icons_holder'><div class='progress_bars_icons'><div class='progress_bars_icons_inner $type ";
    if($custom_size != ""){
    	$html .= "custom_size";
    } else {
    	$html .= "$size";
    }
    $html .= " clearfix' data-number='".$active_number."'";
    if($custom_size != ""){
    	$html .= " data-size='".$custom_size."'";
    }
    $html .= ">";
	$i = 0;
	while ($i < $icons_number) {
		$html .= "<div class='bar'><span class='bar_noactive icon-stack ";
		if($size != ""){
			if($size == "tiny"){
				$html .= "icon-large";
			} else if($size == "small"){
				$html .= "icon-2x";
			} else if($size == "medium"){
				$html .= "icon-3x";
			} else if($size == "large"){
				$html .= "icon-4x";
			}
		}
		$html .= "'";
		if($type == "normal" || $type == "square"){
			if($background_active_color != "" || $border_active_color != ""){
				$html .= " style='";
				if($background_active_color != ""){
					$html .= "background-color: ".$background_active_color.";";
				}
				if($border_active_color != ""){
					$html .= " border-color: ".$border_active_color.";";	
				}
				$html .= "'";
			}
		}
		$html .= ">";
		if($type == "circle"){
			$html .= "<i class='icon-circle icon-stack-base'";
			if($background_active_color != ""){
				$html .= " style='color: ".$background_active_color.";'";
			}
			$html .= "></i>";
		}
		$html .= "<i class='".$icon."'";
		if($icon_active_color != ""){
			$html .= " style='color: ".$icon_active_color.";'";
		}
		$html .= "></i></span><span class='bar_active icon-stack ";
		if($size != ""){
			if($size == "tiny"){
				$html .= "icon-large";
			} else if($size == "small"){
				$html .= "icon-2x";
			} else if($size == "medium"){
				$html .= "icon-3x";
			} else if($size == "large"){
				$html .= "icon-4x";
			}
		}
		$html .= "'";
		if($type == "normal" || $type == "square"){
			if($background_color != "" || $border_color != ""){
				$html .= " style='";
				if($background_color != ""){
					$html .= "background-color: ".$background_color.";";
				}
				if($border_color != ""){
					$html .= " border-color: ".$border_color.";";	
				}
				$html .= "'";
			}
		}
		$html .= ">";
		if($type == "circle"){
			$html .= "<i class='icon-circle icon-stack-base'";
			if($background_color != ""){
				$html .= " style='color: ".$background_color.";'";
			}
			$html .= "></i>";
		}
		$html .= "<i class='".$icon."'";
		if($icon_color != ""){
			$html .= " style='color: ".$icon_color.";'";
		}
		$html .= "></i></span></div>";
		$i++;
	}
    $html .= "</div></div></div>";
    return $html;
}
}
add_shortcode('progress_bar_icon', 'progress_bar_icon');

/* Social Icons shortcode */

if (!function_exists('social_icons')) {
function social_icons($atts, $content = null) {
    extract(shortcode_atts(array("icon"=>"","link"=>"","target"=>"","size"=>"","icon_color"=>"","background_color"=>""), $atts));
    $html = ""; 
    $html .= "<span class='social_icon_holder'>";
    if($link != ""){
    	$html .= "<a href='".$link."' target='".$target."'>";
    }
    $html .= "<span class='icon-stack ".$size."'><i class='icon-circle icon-stack-base'";
    if($background_color != ""){
    	$html .= " style='color: ".$background_color.";'";
    }
    $html .= "></i><i class='".$icon."'";
    if($icon_color != ""){
    	$html .= " style='color: ".$icon_color.";'";
    }
    $html .= "></i></span>";
    if($link != ""){
    	$html .= "</a>";
    }
    $html .= "</span>";
    return $html;
}
}
add_shortcode('social_icons', 'social_icons');

/* Social Share shortcode */

if (!function_exists('social_share')) {
function social_share($atts, $content = null) {
	global $qode_options_subway;
	if(isset($qode_options_subway['twitter_via']) && !empty($qode_options_subway['twitter_via'])) {
		$twitter_via = " via " . $qode_options_subway['twitter_via'];
	} else {
		$twitter_via = 	"";
	}
    $html = "";  
	if(isset($qode_options_subway['enable_social_share']) && $qode_options_subway['enable_social_share'] == "yes") { 
		$post_type = get_post_type();
		if(isset($qode_options_subway["post_types_names_$post_type"])) {
			if($qode_options_subway["post_types_names_$post_type"] == $post_type) {
			if($post_type == "portfolio_page") {
				$html .= '<div class="portfolio_share">';
			} elseif($post_type == "post") {
				$html .= '<div class="blog_share">';
			} elseif($post_type == "page") {
				$html .= '<div class="page_share">';
			}
				$html .= '<span class="social_share_holder">';
				$html .= '<span class="social_share_icon"></span>';//'.  __('Share','qode') .'
					$html .= '<div class="social_share_dropdown"><ul>';
					if(isset($qode_options_subway['enable_facebook_share']) &&  $qode_options_subway['enable_facebook_share'] == "yes") { 
						$html .= '<li class="facebook_share">';
						$html .= '<a href="#" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . get_the_title() . '&amp;p[summary]=' . get_the_excerpt() . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;&p[images][0]=';
						if(function_exists('the_post_thumbnail')) {
							$html .=  wp_get_attachment_url(get_post_thumbnail_id());
						}
						$html .='\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');" href="javascript: void(0)">';
						if(!empty($qode_options_subway['facebook_icon'])) {
							$html .= '<img src="' . $qode_options_subway["facebook_icon"] . '" />';
						} else { 
							$html .= '<i class="icon-facebook"></i>';
						} 
						$html .= "<span class='share_text'>" . __('Post On Facebook','qode') . "</span>";
						$html .= "</a>";
						$html .= "</li>";
						} 
						if($qode_options_subway['enable_google_plus'] == "yes") { 
							$html .= '<li  class="google_share">';
							$html .= '<a href="#" onclick="popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
									if(!empty($qode_options_subway['google_plus_icon'])) { 
										$html .= '<img src="' . $qode_options_subway['google_plus_icon'] . '" />';
									} else { 
										$html .= '<i class="icon-google-plus"></i>';
									 } 
									$html .= "<span class='share_text'>" . __('Share On Google Plus','qode') . "</span>";
								$html .= "</a>";
							$html .= "</li>";
						 }
						if($qode_options_subway['enable_twitter_share'] == "yes") { 
							$html .= '<li class="twitter_share">';
							$html .= '<a href="#" onclick="popUp=window.open(\'http://twitter.com/share?url=' . urlencode(get_permalink()) . '&text=' . urlencode(the_excerpt_max_charlength(mb_strlen(get_permalink())) . $twitter_via) . '&count=horiztonal\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;" target="_blank" rel="nofollow">';
									if(!empty($qode_options_subway['twitter_icon'])) { 
										$html .= '<img src="' . $qode_options_subway["twitter_icon"] . '" />';
									 } else { 
										$html .= '<i class="icon-twitter"></i>';
									 }
									$html .= "<span class='share_text'>" . __('Share On Twitter','qode') . "</span>";
								$html .= "</a>";
							$html .= "</li>";
						 } 
						$html .= "</ul></div>";
				$html .= "</span>";
				if($post_type == "portfolio_page" || $post_type == "post" || $post_type == "page") {
					$html .= '</div>';
				}
			} 
		}  
	}
    return $html;
}
}
add_shortcode('social_share', 'social_share');

/* Testimonials shortcode */

if (!function_exists('testimonials')) {
function testimonials( $atts, $content = null ) {
	extract(shortcode_atts(array("type" => "normal", "number"=>"-1", "category"=>"", "background_color"=>"", "border_color"=>""), $atts));
	$html = ""; 
	if ($category == "") {
		$args = array(
			'post_type'=> 'testimonials',
			'orderby' => "date",
			'order' => "DESC",
			'posts_per_page' => $number
		);
	} else {
		$args = array(
			'post_type'=> 'testimonials',
			'testimonials_category' => $category,
			'orderby' => "date",
			'order' => "DESC",
			'posts_per_page' => $number
		);
	}
  	
	if($type == "transparent") {
		$type_class = " transparent";
	} else {
		$type_class = "";
	}
	$html .= '<div class="testimonials_holder clearfix">';
		$html .= '<div class="testimonials'. $type_class .'">';
			$html .= '<div class="testimonial_container">';
			query_posts( $args );
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				$author = get_post_meta(get_the_ID(), "qode_testimonial-author", true);
				$text = get_post_meta(get_the_ID(), "qode_testimonial-text", true);
				$html .= '<div id="testimonials'. get_the_ID() .'" class="testimonial_content">';
					$html .= '<div class="testimonial_text_holder">';
						$html .= '<div class="testimonial_text_inner"';
						if($background_color != '' || $border_color != ''){
							$html .= ' style="background-color: '.$background_color.'; border-color: '.$border_color.';"';
						}
						$html .= '>';
							$html .= '<i class="icon-quote-right pull-left"></i>';
							$html .= '<p>' . $text . '</p>';
							$html .= '<span class="testimonial_name">- ' . $author . '</span>';
						$html .= '</div>';
						$html .= '<span class="testimonial_arrow"';
						if($background_color != '' || $border_color != ''){
							$html .= ' style="background-color: '.$background_color.'; border-color: '.$border_color.';"';
						}
						$html .= '></span>';
						$html .= '<span class="transparent_arrow"></span>';
					$html .= '</div>';
				$html .= '</div>';
				endwhile;
			else:
				$html .= __('Sorry, no posts matched your criteria.','qode');
			endif;
			
			wp_reset_query();
			$html .= '</div>';
			$html .= '<ul class="testimonial_nav">';
			query_posts( $args );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				
		        $html .='<li><a href="#testimonials'. get_the_ID() .'">';
						 $html .='<span class="testimonial_image_holder">';
							$html .= get_the_post_thumbnail(get_the_ID(),'testimonial-image');
						$html .='</span>';
					$html .='</a>';
				$html .='</li>';
				endwhile;
			else:
				$html .= __('Sorry, no posts matched your criteria.','qode');
			endif;
			
			wp_reset_query();
			$html .= '</ul>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
}
add_shortcode('testimonials', 'testimonials');

/* Unordered List shortcode */

if (!function_exists('unordered_list')) {
function unordered_list($atts, $content = null) {
    extract(shortcode_atts(array("style"=>"","animate"=>""), $atts));
    $html =  "<div class='list $style";
    if($animate == "yes"){
    	$html .= " animate_list'>" . $content . "</div>";	
    } else {
    	$html .= "'>" . $content . "</div>";
   	}
    return $html;
}
}
add_shortcode('unordered_list', 'unordered_list');


/* Cover Boxes shortcode */

if (!function_exists('cover_boxes')) {
function cover_boxes($atts, $content = null) {
	extract(shortcode_atts(array("title1" => "", "title_color1"=>"", "text1"=>"", "image1" => "", "link1" => "", "link_label1" => "", "link_target1" => "", "title2" => "", "title_color2"=>"", "text2"=>"", "image2" => "", "link2" => "", "link_label2" => "", "link_target2" => "", "title3" => "", "title_color3"=>"", "text3"=>"", "image3" => "", "link3" => "", "link_label3" => "", "link_target3" => ""), $atts));

	$html = "";
	$html .= "<div class='cover_boxes'><ul class='clearfix'>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if($link_target1 != ""){
		$target1 = $link_target1;
	}else{
		$target1 = "_self";
	}
	if(is_numeric($image1)) {
		$image_src1 = wp_get_attachment_url( $image1 ); 
	}else {
		$image_src1 = $image1; 
	}
	if(is_numeric($image2)) {
		$image_src2 = wp_get_attachment_url( $image2 ); 
	}else {
		$image_src2 = $image2; 
	}
	if(is_numeric($image3)) {
		$image_src3 = wp_get_attachment_url( $image3 ); 
	}else {
		$image_src3 = $image3; 
	}
	$html .= "<a class='thumb' href='".$link1."' target='".$target1."'><img alt='".$title1."' src='".$image_src1."' /></a>";
	if($title_color1 != ""){
		$color1 = " style='color:".$title_color1."''";
	}else{
		$color1 = "";
	}
	$html .= "<div class='box_content'><h3 ".$color1.">".$title1."</h3>";
	$html .= "<p>".$text1."</p>";
	$html .= "<a class='hamrah_btn qbutton normal' href='".$link1."' target='".$target1."'>".$link_label1."</a>";
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if($link_target2 != ""){
		$target2 = $link_target2;
	}else{
		$target2 = "_self";
	}
	$html .= "<a class='thumb' href='".$link2."' target='".$target2."'><img alt='".$title2."' src='".$image_src2."' /></a>";
	if($title_color2 != ""){
		$color2 = " style='color:".$title_color2."''";
	}else{
		$color2 = "";
	}
	$html .= "<div class='box_content'><h3 ".$color2.">".$title2."</h3>";
	$html .= "<p>".$text2."</p>";
	$html .= "<a class='hamrah_btn qbutton normal' href='".$link2."' target='".$target2."'>".$link_label2."</a>";
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "<li>";
	$html .= "<div class='box'>";
	if($link_target3 != ""){
		$target3 = $link_target3;
	}else{
		$target3 = "_self";
	}
	$html .= "<a class='thumb' href='".$link3."' target='".$target3."'><img alt='".$title3."' src='".$image_src3."' /></a>";
	if($title_color3 != ""){
		$color3 = " style='color:".$title_color3."''";
	}else{
		$color3 = "";
	}
	$html .= "<div class='box_content'><h3 ".$color3.">".$title3."</h3>";
	$html .= "<p>".$text3."</p>";
	$html .= "<a class='hamrah_btn qbutton normal' href='".$link3."' target='".$target3."'>".$link_label3."</a>";
	$html .= "</div></div>";
	$html .= "</li>";
	
	$html .= "</ul></div>";
	return $html;
}
}
add_shortcode('cover_boxes', 'cover_boxes');

/* Bordered box shortcode */

if (!function_exists('bordered_box')) {
function bordered_box($atts, $content = null) {
	extract(shortcode_atts(array("background_color"=>"","border_color"=>""), $atts));
	$html = '';
	$html .= '<div class="box_holder" ';
	if($background_color != "" || $border_color != ""){
		$html .= 'style="';
		if($background_color != ""){
			$html .= 'background-color:'.$background_color.';';
		}
		if($border_color != ""){
			$html .= 'border-color:'.$border_color.';';
		}
		$html .= '"';
	}
	$html .= '><div class="box_holder_inner center">';
	$html .= $content;
	$html .= '</div></div>';
	return $html;
}
}
add_shortcode('bordered_box', 'bordered_box');

/* Icon List Item shortcode */

if (!function_exists('icon_list_item')) {
function icon_list_item($atts, $content = null) {
	extract(shortcode_atts(array("icon"=>"", "icon_color"=>"", "icon_background_color"=>"", "icon_border_color"=>"", "title"=>"","title_color"=>""), $atts));
	$html = '';
	$html .= '<div class="icon_list">';
	$html .= '<i class="'.$icon.' pull-left icon-border" ';
	if($icon_color != "" || $icon_background_color != "" || $icon_border_color != ""){
		$html .= 'style="';
		if($icon_color != ""){
			$html .= 'color:'.$icon_color.';';
		}
		if($icon_background_color != ""){
			$html .= 'background-color:'.$icon_background_color.';';
		}
		if($icon_border_color != ""){
			$html .= 'border-color:'.$icon_border_color.';';
		}
		$html .= '"';
	}
	$html .= '></i>';
	$html .= '<p';
	if($title_color != ""){
		$html .= ' style="color:'.$title_color.';"';
	}
	$html .= '>'.$title.'</p>';
	$html .= '</div>';
	return $html;
}
}
add_shortcode('icon_list_item', 'icon_list_item');

if(!function_exists('icons')) {
    function icons($atts, $content = null) {
        $default_atts = array(
            "size"=>"", 
            "custom_size"=>"", 
            "icon"=>"", 
            "type"=>"", 
            "position"=>"",
            "border"=>"", 
            "border_color" => "", 
            "border_color" => "", 
            "icon_color" => "", 
            "background_color" => "",
            "margin"           => ""
        );
        
        extract(shortcode_atts($default_atts, $atts));
        
        $html = "";
        if($icon != "") {
        
            //generate inline icon styles
            $style = '';
            $icon_stack_classes = '';

            if($custom_size != "") {
                $style .= 'font-size: '.$custom_size;
                if(!strstr($custom_size, 'px')) {
                    $style .= 'px;';
                }
            } 

            if($icon_color != "") {
                $style .= 'color: '.$icon_color.';';
            }

            if($position != "") {
                $icon_stack_classes .= 'pull-'.$position;
            }    

            //generate icon stack styles
            $icon_stack_style = '';
            $icon_stack_base_style = '';
            $icon_stack_circle_styles = '';
            $icon_stack_normal_style  = '';

            if($background_color != "") {
                $icon_stack_base_style .= 'color: '.$background_color.';';
                $icon_stack_style .= 'background-color: '.$background_color.';';
            } 

            if($border == 'yes' && $border_color != "") {
                $icon_stack_style .= 'border: 1px solid '.$border_color.';';
            }
            
//            var_dump($margin); exit;
            
            if($margin != "") {
                $icon_stack_style .= 'margin: '.$margin.';';
                $icon_stack_circle_styles .= 'margin: '.$margin.';';
                $icon_stack_normal_style .= 'margin: '.$margin.';';
            }

            switch ($type) {
                case 'circle':
                    $html = '<span class="icon-stack '.$size.' '.$icon_stack_classes.'" style="'.$icon_stack_circle_styles.'">';
                    $html .= '<i class="icon-circle icon-stack-base" style="'.$icon_stack_base_style.'"></i>';
                    $html .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    break;
                case 'square':
                    $html = '<span class="icon-stack '.$size.' '.$icon_stack_classes.'" style="'.$icon_stack_style.'">';
                    $html .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    break;
                default:
                    $html = '<span class="font_awsome_icon '.$size.' '.$icon_stack_classes.'" style="'.$icon_stack_normal_style.'">';
                    $html .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    break;
            }        

            $html.= '</span>';
        
        } 
        
        return $html;
        
    }
}
add_shortcode('icons', 'icons');

if(!function_exists('icon_text')) {
    function icon_text($atts, $content = null) {
        $default_atts = array(
            "icon_size"             => "", 
            "custom_icon_size"      => "", 
            "icon"                  => "", 
            "image"                 => "",
            "icon_type"             => "", 
            "icon_position"         => "",
            "icon_border"           => "", 
            "icon_border_color"     => "", 
            "border_color"          => "", 
            "icon_color"            => "", 
            "icon_background_color" => "",
            "box_type"              => "",
            "box_border"            => "",
            "box_border_color"      => "",
            "box_background_color"  => "",
            "title"                 => "",
            "text"                  => "",
            "title_color"           => "",
            "text_color"            => ""
        );
        
        extract(shortcode_atts($default_atts, $atts));
                                
        //init icon styles
        $style = '';
        $icon_stack_classes = '';
        
        
        //init icon stack styles
        $icon_stack_style = '';
        $icon_stack_base_style = '';

        //generate inline icon styles
        if($custom_icon_size != "") {
            $style .= 'font-size: '.$custom_icon_size;
            if(!strstr($custom_icon_size, 'px')) {
                $style .= 'px;';
            }
        } 

        if($icon_color != "") {
            $style .= 'color: '.$icon_color.';';
        }

        //generate icon stack styles
        if($icon_background_color != "") {
            $icon_stack_base_style .= 'color: '.$icon_background_color.';';
            $icon_stack_style .= 'background-color: '.$icon_background_color.';';
        } 

        if($icon_border == 'yes' && $icon_border_color != "") {
            $icon_stack_style .= 'border: 1px solid '.$icon_border_color.';';
        }
                
        $box_size = '';
        //generate icon text holder styles and classes
        
        //map value of the field to the actual class value
        switch ($icon_size) {
            case 'large': //smallest icon size
                $box_size = 'tiny';
                break;
            case 'icon-2x':
                $box_size = 'small';
                break;
            case 'icon-3x':
                $box_size = 'medium';
                break;
            case 'icon-4x':
                $box_size = 'large';
                break;
            default:
                $box_size = 'tiny';
        }
        
        if($image != "") {
            $icon_type = 'image';
        }
        
        $box_icon_type = '';
        switch ($icon_type) {
            case 'square':
                $box_icon_type = ' boxed';
                break;
            case 'circle':
                $box_icon_type = ' circle';
                break;
            case 'image':
                if($box_type == 'normal') {
                    $box_icon_type = ' icon_image';
                } else {
                    $box_icon_type = ' image';
                }
                break;
        }
        
        $html = "";
        $html_icon = "";
        
        if($image == "") {
            //genererate icon html
            switch ($icon_type) {
                case 'circle':
                    $html_icon .= '<span class="icon-stack '.$icon_size.' '.$icon_stack_classes.'">';
                    $html_icon .= '<i class="icon-circle icon-stack-base" style="'.$icon_stack_base_style.'"></i>';
                    $html_icon .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
                case 'square':
                    $html_icon .= '<span class="icon-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style.'">';
                    $html_icon .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
                default:
                    $html_icon .= '<span class="font_awsome_icon '.$icon_size.' '.$icon_stack_classes.'">';
                    $html_icon .= '<i class="'.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
            }    
        } else {
			if(is_numeric($image)) {
				$image_src = wp_get_attachment_url( $image ); 
			}else {
				$image_src = $image; 
			}
            $html_icon = '<img src="'.$image_src.'" alt="">';
        }
        
        $title_style = "";
        if($title_color != "") {
            $title_style .= "color: ".$title_color;
        }
        
        $text_style = "";
        if($text_color != "") {
            $text_style .= "color: ".$text_color;
        }
        
        //generate normal type of a box html
        if($box_type == "normal") {   
            
            //init icon text wrapper styles
            $icon_with_text_clasess = '';
            $icon_with_text_style   = '';
            $icon_text_inner_style = '';
            
            $icon_with_text_clasess .= $box_size;
            $icon_with_text_clasess .= ' '.$box_icon_type;
            
            if($box_border == "yes") {
                $icon_with_text_clasess .= ' with_border_line';
            }
            
            if($box_border == "yes" && $box_border_color != "") {
                $icon_text_inner_style .= 'border-color: '.$box_border_color;
            }         

            if($icon_position == "" || $icon_position == "top") {
                $icon_with_text_clasess .= " center";
            }
            
            $html .= "<div class='icon_with_title ".$icon_with_text_clasess."'>";
            
            //generate icon holder html part with icon
            $html .= '<div class="icon_holder">';
            $html .= $html_icon;
            $html .= '</div>'; //close icon_holder

            //generate text html
            $html .= '<div class="icon_text_holder">';
            $html .= '<div class="icon_text_inner" style="'.$icon_text_inner_style.'">';
            $html .= '<h4 style="'.$title_style.'">'.$title.'</h4>';
            $html .= '<p style="'.$text_style.'">'.$text.'</p>';
            $html .= '</div>';  //close icon_text_inner
            $html .= '</div>'; //close icon_text_holder

            $html.= '</div>'; //close icon_with_title     
        } else {
            //init icon text wrapper styles
            $icon_with_text_clasess = '';
            $box_holder_styles = '';
            
            if($box_border_color != "") {
                $box_holder_styles .= 'border-color: '.$box_border_color.';';
            } 
            
            if($box_background_color != "") {
                $box_holder_styles .= 'background-color: '.$box_background_color.';';
            }
            
            $icon_with_text_clasess .= $box_size;
            $icon_with_text_clasess .= ' '.$box_icon_type;
            
            $html .= '<div class="box_holder with_icon" style="'.$box_holder_styles.'">';
            
            $html .= '<div class="box_holder_icon">';
            $html .= '<div class="box_holder_icon_inner '.$icon_with_text_clasess.'">';
            $html .= $html_icon;
            $html .= '</div>'; //close box_holder_icon_inner
            $html .= '</div>'; //close box_holder_icon
            
            //generate text html
            $html .= '<div class="box_holder_inner center">';
            $html .= '<h4 style="'.$title_style.'">'.$title.'</h4>';
            $html .= '<span class="separator transparent" style="margin: 8px 0;"></span>';
            $html .= '<p style="'.$text_style.'">'.$text.'</p>';
            $html .= '</div>'; //close box_holder_inner
                        
            $html .= '</div>'; //close box_holder
        }
        
        return $html;
        
    }
}
add_shortcode('icon_text', 'icon_text');

/* Steps shortcode */

if (!function_exists('steps')) {
function steps($atts, $content = null) {
	extract(shortcode_atts(array("image1" =>"","image2" =>"","image3" =>"","image4" =>"","icon_background_color"=>"","icon1"=>"","icon2"=>"","icon3"=>"","icon4"=>"","link1"=>"","link2"=>"","link3"=>"","link4"=>"","target1"=>"","target2"=>"","target3"=>"","target4"=>""), $atts));
	
	$html = '';
	$html .= '<div class="steps_holder"><div class="steps_holder_inner">';
	
	$html .= '<div class="circle_small step1"><span class="icon-stack icon-3x"><i class="icon-circle icon-stack-base"';
	if($icon_background_color != ""){
		$html .= ' style="color:'.$icon_background_color.';"';
	}
	$html .= '></i><i class="'.$icon1.'"></i></span>';
	if($link1 != ""){
		$html .= '<a href="'.$link1.'" target="'.$target1.'">';
	}
	$html .= '<div class="image_holder">';
	if(is_numeric($image1)) {
		$image_src1 = wp_get_attachment_url( $image1 ); 
	}else {
		$image_src1 = $image1; 
	}
	$html .= '<img src="'.$image_src1.'" alt="" />';
	$html .= '</div>';
	if($link1 != ""){
		$html .= '</a>';
	}
	$html .= '</div>';
	
	$html .= '<div class="circle_small step2"><span class="icon-stack icon-3x"><i class="icon-circle icon-stack-base"';
	if($icon_background_color != ""){
		$html .= ' style="color:'.$icon_background_color.';"';
	}
	$html .= '></i><i class="'.$icon2.'"></i></span>';
	if($link2 != ""){
		$html .= '<a href="'.$link2.'" target="'.$target2.'">';
	}
	$html .= '<div class="image_holder">';
	if(is_numeric($image2)) {
		$image_src2 = wp_get_attachment_url( $image2 ); 
	}else {
		$image_src2 = $image2; 
	}
	$html .= '<img src="'.$image_src2.'" alt="" />';
	$html .= '</div>';
	if($link2 != ""){
		$html .= '</a>';
	}
	$html .= '</div>';
	
	$html .= '<div class="circle_small step3"><span class="icon-stack icon-3x"><i class="icon-circle icon-stack-base"';
	if($icon_background_color != ""){
		$html .= ' style="color:'.$icon_background_color.';"';
	}
	$html .= '></i><i class="'.$icon3.'"></i></span>';
	if($link3 != ""){
		$html .= '<a href="'.$link3.'" target="'.$target3.'">';
	}
	$html .= '<div class="image_holder">';
	if(is_numeric($image3)) {
		$image_src3 = wp_get_attachment_url( $image3 ); 
	}else {
		$image_src3 = $image3; 
	}
	$html .= '<img src="'.$image_src3.'" alt="" />';
	$html .= '</div>';
	if($link3 != ""){
		$html .= '</a>';
	}
	$html .= '</div>';
	
	$html .= '<div class="circle_big step4"><span class="icon-stack icon-3x"><i class="icon-circle icon-stack-base"';
	if($icon_background_color != ""){
		$html .= ' style="color:'.$icon_background_color.';"';
	}
	$html .= '></i><i class="'.$icon4.'"></i></span>';
	if($link4 != ""){
		$html .= '<a href="'.$link4.'" target="'.$target4.'">';
	}
	$html .= '<div class="image_holder">';
	if(is_numeric($image4)) {
		$image_src4 = wp_get_attachment_url( $image4 ); 
	}else {
		$image_src4 = $image4; 
	}
	$html .= '<img src="'.$image_src4.'" alt="" />';
	$html .= '</div>';
	if($link4 != ""){
		$html .= '</a>';
	}
	$html .= '</div>';
	
	$html .= '</div></div>';
	
	return $html;
	
}
}
add_shortcode('steps', 'steps');


//****************** ADDED BY WEBRUN ************************//

/* Image with text and icon shortcode */

if (!function_exists('image_with_text_and_no_icon')) {
	function image_with_text_and_no_icon($atts, $content = null) {
		extract(shortcode_atts(array("image" =>"","gallery"=>0,"g_link"=>"","a_link"=>"" ,"b_link"=>"" ,"target"=>"", "title"=>"", "title_color"=>""), $atts));
		$html = '';
		$html .= '<div class="box_image_with_border no_icon_box_cont '.(isset($gallery) && $gallery == 1?'gallery':'').'"><div class="box_image_holder '.(isset($gallery) && $gallery == 1?'gallery':'').' no_icon_box">';
		if($a_link != "" || $g_link != ""){
			$html .= '<a href="'.($g_link!=""?$g_link:$a_link).'" target="'.$target.'">';
		}
		$html .= '<span class="box_image_shadow"></span><span class="image_holder_inner">';
		if(is_numeric($image)) {
			//$image_src = wp_get_attachment_url( $image );
			$imag = wp_get_attachment_image_src($image,($gallery?'full':'medium'));
			$image_src = $imag[0];
		}else {
			$image_src = $image;
		}
		$html .= '<img src="'.$image_src.'" alt="'.$title.'" />';
		$html .= '</span>';
		if($a_link != ""){
			$html .= '</a>';
		}
		$html .= '</div>';
		$html .= '<h3 ';
		if($title_color != ""){
			$html .= 'style="color:'.$title_color.';"';
		}
		$html .= '>'.$title.'</h3>';
		if(isset($gallery) && $gallery == 1){}
		else
			$html .= '<div class="has_min_height">'.$content.'</div>';
		$links = '';
		if($g_link !="")
			$links .= "[button size='medium' type='normal' border_color='#9786bc' color='' background_color='#6c6087' font_style='' text='".__('View Gallery','qode')."' link='$g_link' target='_self']";
		if($a_link !="")
			$links .= "[button size='medium' type='normal' border_color='#9786bc' color='' background_color='#6c6087' font_style='' text='".__('Read Article','qode')."' link='$a_link' target='_self']";
		if($b_link !="")
			$links .= "[button size='medium' type='normal' border_color='#9786bc' color='' background_color='#6c6087' font_style='' text='".__('View Ebook','qode')."' link='$b_link' target='_self']";
		$html .= do_shortcode($links);
		if(isset($gallery) && $gallery == 1){}
		else
			$html .= '<span class="separator transparent" style="margin: 12px 0;"></span>';
		$html .=	'</div>';
		return $html;
	}
}
add_shortcode('image_with_text_and_no_icon', 'image_with_text_and_no_icon');


if (!function_exists('hamrah_farsi_meetings_tabs')) {
	function hamrah_farsi_meetings_tabs($atts, $content = null) {
		extract(shortcode_atts(array("interval" =>0), $atts));

		// 		$custom_terms = get_terms('fellowships');
		// 		$tax_q = array();
		// 		foreach ($custom_terms as $ct){
		// 			$tax_q[] = $ct->slug;
		// 		}

		$args = array(
				'posts_per_page'=>-1,
				'orderby'=>'date',
				'order'	=> 'ASC',
				'post_type' => 'hamrah_gallery'
		);
		$the_query = new WP_Query( $args );

		$html = '';
		// The Loop
		if ( $the_query->have_posts() ) {


			$html = '[vc_tabs interval="'.$interval.'" style="vertical"]';
			$position = true;
			if(ICL_LANGUAGE_CODE=='fa'){
				$position = false;
			}
			while( $the_query->have_posts() ) { $the_query->the_post();
			$g_id = icl_object_id(get_option('gallery_page_hamrah'), 'page', false,ICL_LANGUAGE_CODE);
			$html .= '[vc_tab title="'.get_the_title().'" tab_id="id_'.get_the_ID().'"]';
			$p_link = get_permalink(get_the_ID());
			$html .=	'[image_with_text_and_no_icon target="_self" gallery="1" image="'.get_post_thumbnail_id(get_the_ID(),'full').'" g_link="'.get_permalink($g_id).'#post-'.get_the_ID().'" title="'.get_the_title().'"]'.
					get_the_excerpt().'<p><a href="'.$p_link.'" title="'.__('View Gallery','qode').'">'.__('View Gallery','qode').'</a></p>'.
					'[/image_with_text_and_no_icon]';
			$html .= '[/vc_tab]';		}
			$html .='[/vc_tabs]';
		}

		$html = do_shortcode($html);
		$html .= '<span class="separator transparent" style="margin: 12px 0;"></span>';

		return $html;

	}
}
add_shortcode('hamrah_farsi_meetings_tabs', 'hamrah_farsi_meetings_tabs');


if (!function_exists('hamrah_farsi_meetings_side_slides')) {
	function hamrah_farsi_meetings_side_slides($atts) {
		extract(shortcode_atts(array("flex_slide_title"=>"","flex_slide_content"=>""), $atts));
		wp_register_style( 'flex_css', get_stylesheet_directory_uri() . '/js/lib/woothemes-FlexSlider-'.(ICL_LANGUAGE_CODE=='fa'?'4c7e00b':'ca347d4').'/flexslider.css'  );
		wp_enqueue_style( 'flex_css' );
		wp_register_script('flex_js',get_stylesheet_directory_uri() . '/js/lib/woothemes-FlexSlider-'.(ICL_LANGUAGE_CODE=='fa'?'4c7e00b':'ca347d4').'/jquery.flexslider.js',array('jquery'),'2.0.3',true);
		wp_enqueue_script('flex_js'); // Enqueue it!
		wp_register_script('flex_control_js',get_stylesheet_directory_uri() . '/js/lib/flex_'.(ICL_LANGUAGE_CODE=='fa'?'rtl':'ltr').'.js',array('jquery','flex_js'),'2.0.3',true);
		wp_enqueue_script('flex_control_js');

		$html ='[vc_row]'.
				'[vc_column width="1/4"]'.
				'[custom_font font_family="'.(ICL_LANGUAGE_CODE == 'fa'?'Arial':'Oswald').'" font_size="20" line_height="26" font_style="normal" text_align="center" font_weight="300" text_decoration="none" padding="0px" margin="20px"]'.$flex_slide_title.'[/custom_font]'.
				'<p>'.$flex_slide_content.'</p>'.
				'<div class="portfolio_navigation farsi_fellow_nav">'.
				'<div id="flexslider_farsi_meetings_prev" class="portfolio_prev"><a><i class="icon-angle-left"></i>'.__('Previous','qode').'</a></div>'.
				'<div id="flexslider_farsi_meetings_next" class="portfolio_next"><a>'.__('Next','qode').'<i class="icon-angle-right"></i></a></div>'.
				'</div>'.

				'[/vc_column]'.
				'[vc_column width="3/4"]';


		//removed at 3 of january
		// 		$custom_terms = get_terms('fellowships');
		// 		$tax_q = array();
		// 		foreach ($custom_terms as $ct){
		// 			$tax_q[] = $ct->slug;
		// 		}

		// 		$args = array(
		// 				'posts_per_page'=>-1,
		// 				'orderby'=>'date',
		// 				'order'	=> 'ASC',
		// 				'post_type' => 'meetings',
		// 				'tax_query' => array(
		// 						array(
		// 								'taxonomy'  => 'fellowships',
		// 								'field'		=> 'slug',
		// 								'terms'		=> $tax_q
		// 						)
		// 				)
		// 		);

			$args = array(
					'posts_per_page' => -1,
					'orderby'=>'date',
					'order'=>'ASC',
					'post_type'=>'meetings'
			);
			$the_query = new WP_Query( $args );

			$html .= '<div class="flexslider widget_recent_works-container clearfix" id="flexslider_farsi_fellowship" style="opacity: 1;">'.
						
					'<ul class="flex_slides" style="width: 2000%; -webkit-transition: 0s; transition: 0s; -webkit-transform: translate3d(0px, 0, 0);">';

			// The Loop
			if ( $the_query->have_posts() ) {
				while( $the_query->have_posts() ) { $the_query->the_post();
				//added to remove farsi meeting from list
				if(!get_post_ancestors(get_the_ID()))
					continue;
				$p_link = get_permalink(get_the_ID());
				$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' ); //original size
				$large_image = $featured_image_array[0];
				$title = get_the_title(get_the_ID());
				$html .= '<li style="width: 276px; float: left; display: block;">';
				$html .= "<div class='projects_holder clearfix v3 hover_text with_mask farsi_fellow_ship'><article class='flex_slider_image_artic'><div class='image_holder'>";
				$html .= "<span class='image'>";
				$html .= get_the_post_thumbnail(get_the_ID(),'small');
				$html .= "</span>";
				$html .= "<span class='text_holder'>";
				$html .= "<span class='text_outer'>";
				$html .= "<span class='text_inner'><span class='feature_holder'>";
				$html .= '<h4><a href="'. $p_link . '">'.$title.'</a></h4>';
				$html .= "<a class='lightbox' title='" . $title . "' href='" .$large_image . "' data-rel='prettyPhoto[]'><i class='icon-search icon-2x'></i>".__('Zoom','qode')."</a>";
				$html .= "<a class='preview' href='". $p_link ."'><i class='icon-link icon-2x'></i>".__('View','qode')."</a>";
				$html .= "</span></span>";
				$html .= "</span>";
				$html .= "</span>";
				$html .= "</div></article></div>";


				$html .= '</li>';
				}

			}
			$html .=	'</ul></div>[/vc_column]';


			$html .= '[/vc_row]';

			$html = do_shortcode($html);
			return $html;
		}
	}
	add_shortcode('hamrah_farsi_meetings_side_slide', 'hamrah_farsi_meetings_side_slides');


	if (!function_exists('hamrah_gallery_section')) {
		function hamrah_gallery_section($atts, $content = null) {
			extract(shortcode_atts(array("interval" =>0), $atts));

			$args = array(
					'posts_per_page'=>3,
					'orderby'=>'date',
					'order'	=> 'DESC',
					'post_type' => 'hamrah_gallery',
					'suppress_filters' => false
			);
			$the_query = new WP_Query( $args );

			$html = '';
			// The Loop
			if ( $the_query->have_posts() ) {

				$html = '[vc_row]';
				$position = true;
				while( $the_query->have_posts() ) { $the_query->the_post();

				$html .= '[vc_column width="1/3"]'.
						'[custom_font font_family="Oswald" font_size="20" line_height="26" font_style="normal" text_align="center" font_weight="300" text_decoration="none" padding="0px" margin="20px"]'.get_the_title(get_the_ID()).'[/custom_font]'.
						'<div class="circle_big"><a href="'.get_permalink(get_the_ID()).'" alt="'.get_the_title(get_the_ID()).'"><div class="image_holder">'.get_the_post_thumbnail(get_the_ID(),'full').'</div></a></div>'.
						'[/vc_column]';
				}

			}
			$html .='[/vc_row]';

			$html = do_shortcode($html);
			$html .= '<span class="separator transparent" style="margin: 12px 0;"></span>';

			return $html;

		}
	}
	add_shortcode('hamrah_gallery_section', 'hamrah_gallery_section');

	if (!function_exists('left_right_content_with_image')) {
		function left_right_content_with_image($atts, $content = null) {
			extract(shortcode_atts(array("interval" =>0,'image_url'=>'','short_form'=>'','title'=>'','direction'=>'0','text'=>''), $atts));

			$html = '<div class="wpb_row vc_row-fluid category_design">
						<section class="section  grid_section section_category">
							<div class="vc_span12 clearfix">';
			if($image_url)
				$link = wp_get_attachment_image_src($image_url,'medium');
			$img = '<div class="vc_span3 wpb_column column_container">
						<div class="wpb_wrapper">
							<div class="wpb_single_image wpb_content_element wpb_animate_when_almost_visible wpb_left-to-right wpb_start_animation">
								<div class="wpb_wrapper cat_count_cont">
									<img src="'.( $link?$link[0]:get_stylesheet_directory_uri().'/img/default_cat_logo_'.ICL_LANGUAGE_CODE.'.png').'">
									<span class="cat_item_counter">'. $short_form .'</span>
								</div>
							</div>
						</div>
					</div>';
			$desc = '<div class="vc_span9 wpb_column column_container">
					<div class="wpb_wrapper">
						<div class="wpb_text_column wpb_content_element hamrah_right_left_shortcode">
							<div class="wpb_wrapper">
								<h3>'.$title.'</h3>
								<p>&nbsp;</p>';
				
			$close_content =	  '</div>
							</div>
						</div>
					</div>';

			if($direction == '1'){
				$html .= $desc;
				$html .= $content?$content:$text;
				$html .= $close_content;
				$html .= $img;
			}else{
				$html .= $img;
				$html .= $desc;
				$html .= $content?$content:$text;
				$html .= $close_content;
			}


			$html .='		</div>
					</section>
				</div>';
			return $html;

		}
	}
	add_shortcode('left_right_content_with_image', 'left_right_content_with_image');

	if (!function_exists('bordered_box_hamrah')) {
		function bordered_box_hamrah($atts, $content = null) {
			extract(shortcode_atts(array("background_color"=>"#fff","border_color"=>""), $atts));

			$flyers = new WP_Query( array('post_type'=>'flyers','numberposts'=>4,'suppress_filters' => false) );


			$html = '[vc_row_inner]';

			if($flyers->have_posts()):
			while ($flyers->have_posts()): $flyers->the_post();
			$html .= '[vc_column_inner width="1/4"]';

			$html .= '<div class="box_holder custom_hamrah" ';
			if($background_color != "" || $border_color != ""){
				$html .= 'style="';
				if($background_color != ""){
					$html .= 'background-color:'.$background_color.';';
				}
				if($border_color != ""){
					$html .= 'border-color:'.$border_color.';';
				}
				$html .= '"';
			}
			$html .= '><div class="box_holder_inner center">';
			$html .= '<h3>'.get_the_title(get_the_ID()).'</h3>';
			$html .= '<a href="'.post_permalink(icl_object_id(get_option('flyer_page_hamrah'),'page',true,ICL_LANGUAGE_CODE)).'">'.get_the_post_thumbnail(get_the_ID(),'medium',array('class'=>'br_fl_images')).'</a>';
			$html .= "</div>[button size='medium' type='normal' border_color='#9786bc' color='' background_color='#6c6087' font_style='' text='".__('Download','qode')."' link='".wp_get_attachment_url(get_post_field('flyer', get_the_ID()))."' target='_blank']<span class='separator transparent' style='margin: 12px 0;'></div>";
			$html .= '[/vc_column_inner]';
			endwhile;
			endif;
			wp_reset_query();

			// 		$brochure = new WP_Query( array('post_type'=>'brochure','numberposts'=>1,'suppress_filters' => false) );

			// 		if($brochure->have_posts()): $brochure->the_post();
			// 			$html .= '<div class="box_holder custom_hamrah" ';
			// 			if($background_color != "" || $border_color != ""){
			// 				$html .= 'style="';
			// 				if($background_color != ""){
			// 					$html .= 'background-color:'.$background_color.';';
			// 				}
			// 				if($border_color != ""){
			// 					$html .= 'border-color:'.$border_color.';';
			// 				}
			// 				$html .= '"';
			// 			}
			// 			$html .= '><div class="box_holder_inner center">';
			// 			$html .= '<h3>'.get_the_title(get_the_ID()).'</h3>';
			// 			$html .= '<a href="'.get_post_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(),'small',array('class'=>'br_fl_images')).'</a>';
			// 			$html .= "</div>[button size='medium' type='normal' border_color='#9786bc' color='' background_color='#6c6087' font_style='' text='".__('Download','qode')."' link='".wp_get_attachment_url(get_post_field('brochure', get_the_ID()))."' target='_blank']<span class='separator transparent' style='margin: 12px 0;'></div>";
			// 		endif;
			$html .= '[/vc_row_inner]';
			$html = do_shortcode($html);
			wp_reset_query();
			return $html;

}
}
add_shortcode('bordered_box_hamrah', 'bordered_box_hamrah');



if (!function_exists('show_code_shortcode')) {
function show_code_shortcode($atts, $content = null) {
extract(shortcode_atts(array("title"=>'',"background_color"=>"#f8f8f8"), $atts));
$html='';
$html .= '<div class="box_holder custom_hamrah" ';
$html .= 'style="'.$background_color.'"';
$html .= '><div class="box_holder_inner center">';
$html .= '<h3>'.$title.'</h3>';
$html .= $content;
$html .= "</div></div>";

return $html;

}
}
add_shortcode('show_code_shortcode', 'show_code_shortcode');


//****************** ADDED BY WEBRUN END ************************//