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
              <?php echo get_option('content-page.php')?get_option('content-page.php'):'Copyright @ Websolns'?>
          </div>  
        </div>
        <div class="col-md-6">
          <div class="footbar pull-right">
             <a href="<?php echo get_option('websolsn_legal_page')?get_option('websolsn_legal_page'):'#'?>" title="Legal Info" target="_blank">Legal info</a>
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o)
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56286358-1', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>