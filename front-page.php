<?php 
defined('ABSPATH') or die("No script kiddies please!");

get_header();
?>
<?php get_websolns_slider();?>
<section id="page">
  <?php wbs_page_title();?>
  <div id="page-inner" class="container">
    <div class="row">
      
      	<?php webs_check_left_sidebar();?>
      	
         <div id="content">
         	<?php 
      			while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'front' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
        </div>   
   		
   		<?php webs_check_right_sidebar();?>
   		
    </div>    
  </div>  
</section>

<?php get_footer()?>