<script>
    var plugin_url = '<?php echo $plugin_url;?>'
    var server_url = '<?php echo $server_url_host; ?>'
    var id_app = '<?php echo $id_app; ?>'
    var template_url = '<?php echo $template_url;?>'

</script>
 <?php
    get_header();
?>
<!-- Body BEGIN -->
<div class="ecommerce" ng-app="shopApp" ng-controller="productController" ng-cloak>
    <?php
        include_once $dir."template/header.html";
    ?>
    <div id="fb-root"></div>
	<script>
	  var id_product = '<?php echo $product_main['_id']; ?>';
	  
	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '113402492340944',
		  xfbml      : true,
		  version    : 'v2.4'
		});
	  };

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
        
       jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();

        });
	</script>
    <div class="main">
      <div class="">
        <!-- BEGIN SIDEBAR -->
        <div>
            <?php include $dir."template/h-bar.html" ?>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <?php
				include $dir."template/product.html";
			?>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <?php
				include $dir."template/similar.html";
			?>
          </div>
        </div>
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>
</div>
</div><!--important-cái này tránh cho div ecommerce bao gồm cả footer. Nó bị lỗi ở một số theme-->
<?php
  //call the wp foooter
  get_footer();
?>
