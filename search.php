
<script type="text/javascript">
    var server_url ='<?php echo $server_url_host; ?>';
    var id_app = '<?php echo $id_app; ?>';
    var plugin_url = '<?php echo $plugin_url;?>'
    var template_url = '<?php echo $template_url;?>' 
</script>
<?php
        if(isset($limit)==false){
            $limit =30;
        }
        if(isset($page)==false){
            $page =1;
        }
        if(isset($sort)==false){
            $sort ='name';
        }

        //get total products
        $url = "dmvt?k=".urlencode($name)."&fields=ma_vt&id_app=".$id_app;
        $products_total = $core->getJson($url,true);

        $url = "dmvt?limit=".$limit."&k=".urlencode($name)."&page=".$page."&sort=".$sort."&id_app=".$id_app;

        //echo $url;
        $products = $core->getJson($url,true);
 ?>
<script>
    var products_count = <?php echo count($products_total); ?>;
    
</script>
<?php
    get_header(); 
?>
<!-- Body BEGIN -->
<div class="ecommerce"  ng-app="shopApp" ng-controller="searchController" ng-cloak>
    <!-- BEGIN TOP BAR -->
    <?php
		
        include $dir."template/header.html";
    ?>
    <script type="text/javascript">
		//products ={};
		var limit = <?php echo $limit; ?>;
		var page = <?php echo $page; ?>;
		var sortBy = '<?php echo $sort; ?>';
        
        
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
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-7">
			<div class="content-search margin-bottom-20">
              <div class="row">
                <div class="col-md-6">
                  <h1>Kết quả tìm kiếm cho <em><?php echo $name?></em></h1>
                </div>
                <div class="col-md-6">
                  <form action="#">
                    <div class="input-group">
                      <input type="text" placeholder="Tìm lại" ng-model="wordSearch" class="form-control">
                      <span class="input-group-btn">
                        <a class="btn btn-primary" ng-href="tim-kiem-{{limit}}-1-{{sortBy}}-{{wordSearch}}">Tìm</a>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="#"><i class="fa fa-th-large"></i></a>
                <a href="#"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="pull-right">
                  <label class="control-label">Hiện:</label>
                  <select class="form-control input-sm" ng-options ="limit as limit for limit in limits" ng-model="limit" ng-change ='goto("","<?php echo $name ?>",limit,sortBy)'>
                  
                  </select>
                </div>
                <div class="pull-right">
                  <label class="control-label">Sắp xếp theo:</label>
                  <select class="form-control input-sm" ng-options ="sort.id as sort.title for sort in sorts" ng-model="sortBy" ng-change ='goto("","<?php echo $name ?>",limit,sortBy)'>
                    
                  </select>
                </div>
				
              </div>
            </div>
            <!-- BEGIN PRODUCT LIST -->
            <?php
				include $dir."template/product-list.html"
			?>
            <!-- END PRODUCT LIST -->
            <!-- BEGIN PAGINATOR -->
            <div class="row">
              
              <div class="col-md-12 col-sm-12">
                <ul class="pagination pull-right" ng-if ="pages.length>1">
                  <li><a ng-href="tim-kiem-<?php echo $limit ?>-{{page-1}}-{{sortBy}}-<?php echo $name?>" ng-if="page>1">&laquo;</a></li>
                  <li ng-repeat="p in pages">
					<a ng-href="tim-kiem-<?php echo $limit ?>-{{p}}-{{sortBy}}-<?php echo $name?>" ng-if="page!=p">{{p}}</a>
					
					<span ng-if="page==p">{{p}}</span>
				  </li>
                  <li><a ng-href="tim-kiem-<?php echo $limit ?>-{{page+1}}-{{sortBy}}-<?php echo $name?>" ng-if="page < pages.length">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
</div>
<?php
  //call the wp foooter
  get_footer();
?>
