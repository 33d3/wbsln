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
<script type="text/javascript" src="//assets.zendesk.com/external/zenbox/v2.6/zenbox.js"></script>
<style type="text/css" media="screen, projection">
  @import url(//assets.zendesk.com/external/zenbox/v2.6/zenbox.css);
</style>
<script type="text/javascript">
  if (typeof(Zenbox) !== "undefined") {
    Zenbox.init({
      dropboxID:   "20135145",
      url:         "https://websolns.zendesk.com",
      tabTooltip:  "Support",
      tabImageURL: "https://assets.zendesk.com/external/zenbox/images/tab_support_right.png",
      tabColor:    "#3c709e",
      tabPosition: "Right"
    });
  }
</script>
<?php wp_footer(); ?>
</body>

</html>