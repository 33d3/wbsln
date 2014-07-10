<?php 
defined('ABSPATH') or die("No script kiddies please!");
?>

<section id="footer">
  <div id="foot_widget_cont">
    <div class="container">
      <div class="row">
        <?php get_sidebar('footer')?>
      </div> 
    </div>  
  </div>  
  <footer id="copyright">
     <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="footbar">
              Copyright Emrah
          </div>  
        </div>
        <div class="col-md-6">
          <div class="footbar pull-right">
              Legal info
          </div>
        </div>
      </div>  
    </div>  
  </footer>  
</section>

<?php wp_footer(); ?>
</body>

</html>