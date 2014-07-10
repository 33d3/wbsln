<?php 
defined('ABSPATH') or die("No script kiddies please!");

get_header();
?>
<?php get_websolns_slider();?>
<section id="page">
  <div class="row">
    <header class="col-md-12">
		<h1><?php echo get_the_title()?></h1>
    </header>  
  </div>  
  <div id="page-inner" class="container">
    <div class="row">
      
      <div class="col-md-3">
        	<?php get_sidebar('left')?>        
      </div>

      <div class="col-md-9">
         <div id="content" class="inset-10-shadow">
           <div class="row">
             <div class="col-md-12">
               <div id="content_meta" >
                 date like vs info might go here
               </div>  
             </div>  
           </div> 
          <div class="row">
             <div class="col-md-12">
               <div id="content_body">
                 text might go here
               </div>  
             </div>  
           </div> 
          <div class="row">
             <div class="col-md-12">
               <div id="content_footer" >
                 comment and social next previous might go here
               </div>  
             </div>  
           </div> 
        </div>   
      </div>  
    </div>    
  </div>  
</section>

<?php get_footer()?>