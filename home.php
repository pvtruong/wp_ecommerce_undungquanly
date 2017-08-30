<script>
    var plugin_url = '<?php echo $plugin_url;?>'
    var server_url = '<?php echo $server_url_host; ?>'
    var id_app = '<?php echo $id_app; ?>'
    var template_url = '<?php echo $template_url;?>'
</script>
<?php
    get_header();
?>
<div class="ecommerce main" ng-app="shopApp" ng-controller="homeController" ng-cloak>
      <?php
        include $dir."template/header.html";
      ?>
      <!--header page shop content-->
      <div class="header-page-shop-post-content" style="margin-bottom:10px">
        <?php echo $header_page_shop_post_content ?>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();
            
        });
      </script>
      <div class="">
		 <!-- BEGIN SLIDER -->
		<div class="page-slider">
		  <!-- LayerSlider start -->
		  <?php include $dir."template/two-product-promo.html" ?>
		  <!-- LayerSlider end -->
		</div>
		<!-- END SLIDER -->
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
		<?php
			include $dir.'template/sale-product.html';
		?>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row">
          <!-- BEGIN SIDEBAR -->
		  <div class="col-md-3 col-sm-4">
			<?php
				include $dir.'template/slide-bar.html';
			?>
			<div class="sidebar-products clearfix">
              <?php include $dir."template/bestseller.html" ?>
            </div>
		  </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
		  <div class="col-md-9 col-sm-8">
              <div>
                <?php
                    include $dir."template/km-product.html"
                ?>
              </div>
              <div>
                <?php
                    include $dir."template/new-product.html"
                ?>
              </div>
          </div>
		  
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
      <div class="footer-page-shop-post-content" style="margin-top:10px">
         <?php echo $footer_page_shop_post_content ?>
      </div>
</div>
<?php
  //call the wp foooter
  get_footer();
?>
