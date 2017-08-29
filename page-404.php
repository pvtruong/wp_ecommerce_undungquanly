<!DOCTYPE html>
<html lang="en">

<head>
 
</head>

<!-- Body BEGIN -->
<body class="ecommerce" ng-app="shopApp" ng-controller="homeController" ng-cloak>
    <?php
		 get_header();
        include $dir."template/header.html";
    ?>
   <script type="text/javascript">
		//products ={};
		var server_url ='<?php echo $server_url_host; ?>';
		var id_app = '<?php echo $shop['_id']; ?>';
        var plugin_url = '<?php echo $plugin_url;?>'
       
        var template_url = '<?php echo $template_url;?>'
		
		var products_count = <?php echo count($products); ?>;
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();
        })
	</script>

    <div class="main">
      <div class="">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <div class="content-page page-404">
               <div class="number">
                  404
               </div>
               <div class="details">
                  <h3>Oops!</h3>
                  <p>
                     Chúng tôi không thể tìm thấy sản phẩm này.<br>
                     <a href="shop" class="link">Quay trở lại cửa hàng</a> hoặc thử chức năng tìm kiếm để tìm trang của bạn.
                  </p>
               </div>
            </div>
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
    </div>
    <?php
      //call the wp foooter
      get_footer();
    ?>
    

    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>