<?php 
defined('ABSPATH') or die("No script kiddies please!");

get_header();
?>
<?php get_websolns_slider();?>
<section id="page">
  <?php wbs_page_title(__('Archive',LANGUAGE_ZONE));?> 
  <div id="page-inner"><!-- class="container"  -->
    <div class="row">
      
      	<?php webs_check_left_sidebar();?>
      	
         <div id="content">
         	<?php 
      			while ( have_posts() ) : the_post();
					
					echo "<b>".the_title()."</b>";
					echo "<br/>";
					the_excerpt();
					echo "<hr/>";
					
				endwhile;
			?>
        </div>   
   		
   		<?php webs_check_right_sidebar();?>
   		
    </div>    
  </div>  
</section>

<?php get_footer()?>