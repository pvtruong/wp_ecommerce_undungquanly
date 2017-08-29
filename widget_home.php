<!-- BEGIN TOP BAR -->
<script type="text/javascript">
    var server_url ='<?php echo $server_url_host; ?>';
    var id_app = '<?php echo $id_app; ?>';
    var plugin_url = '<?php echo $plugin_url;?>'
    var template_url = '<?php echo $template_url;?>' 
</script>
<?php

    if(isset($limit)==false){
        $limit =12;
    }
    if(isset($page)==false){
        $page =1;
    }
    if(isset($sort)==false){
        $sort ='price';
    }
    $nested = true;

    $url ='dmnvt?k='.$id.'&id_app='.$id_app;

    $groups = $core->getJson($url,true);
    $group_json=null;
    foreach($groups as $group){
        if($group_json==null){
            $group_json = '"'.$group['_id'].'"';
        }else{
            $group_json = $group_json.',"'.$group['_id'].'"';
        }
    }
    if($group_json==null){
        $group_json = "'".$id."'";
    }else{
        $group_json = '{$in:['.$group_json.']}';
    }
    //get total products
    $url = "dmvt?q={status:true,ma_nvt:$group_json}&fields=ma_vt&id_app=".$id_app;
    $products_total = $core->getJson($url,true);
    //get detail product
    $url = "dmvt?limit=".$limit."&q={status:true,ma_nvt:$group_json}&page=".$page."&sort=".$sort."&id_app=".$id_app;
    $products = $core->getJson($url,true);
?>
<script>
    var products_count = <?php echo count($products_total); ?>;
</script>
<?php ?>
<div class="ecommerce"  ng-app="shopApp" ng-controller="productListController" ng-cloak>
   
    <?php include $dir."template/header.html";?>
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
        <!-- BEGIN SIDEBAR -->
        <div style="margin-bottom:10px">
            <?php include $dir."template/h-bar.html" ?>
        </div>
        <!-- END SIDEBAR -->
        <!-- CONTENT -->
        <div class="row">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="#"><i class="fa fa-th-large"></i></a>
                <a href="#"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
                <div class="pull-right" ng-if="products_count>0">
                  <label class="control-label">Hiện:</label>
                  <select class="form-control input-sm" ng-options ="limit as limit for limit in limits" ng-model="limit" ng-change ='goto("<?php echo $id ?>","<?php echo $name ?>",limit,sortBy)'>
                  
                  </select>
                </div>
                <div class="pull-right" ng-if="products_count>0">
                  <label class="control-label">Sắp xếp theo:</label>
                  <select class="form-control input-sm" ng-options ="sort.id as sort.title for sort in sorts" ng-model="sortBy" ng-change ='goto("<?php echo $id ?>","<?php echo $name ?>",limit,sortBy)'>
                    
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
              <div class="col-md-4 col-sm-4 items-info">
				<!--Items 1 to 9 of 10 total-->
			  </div>
              <div class="col-md-8 col-sm-8">
                <ul class="pagination pull-right" ng-if ="pages.length>1">
                  <li><a ng-href="nh-<?php echo $id."-".$limit ?>-{{page-1}}-{{sortBy}}-<?php echo $name?>" ng-if="page>1">&laquo;</a></li>
                  <li ng-repeat="p in pages">
					<a ng-href="nh-<?php echo $id."-".$limit ?>-{{p}}-{{sortBy}}-<?php echo $name?>" ng-if="page!=p">{{p}}</a>
					
					<span ng-if="page==p">{{p}}</span>
				  </li>
                  <li><a ng-href="nh-<?php echo $id."-".$limit ?>-{{page+1}}-{{sortBy}}-<?php echo $name?>" ng-if="page < pages.length">&raquo;</a></li>
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