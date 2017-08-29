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
<div class="ecommerce" ng-app="shopApp" ng-controller="cartController" ng-cloak>
    <?php
        include $dir."template/header.html";
    ?>
    <script type="text/javascript">


        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();

    });
    </script>
    <!-- Header END -->
    <div class="main">
      <div class="">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Giỏ hàng</h1>
			<div class="shopping-cart-page" ng-if="cart.t_sl==0">
              <div class="shopping-cart-data clearfix">
                <p>Giỏ của bạn chưa có sản phẩm nào.</p>
              </div>
            </div>
            <div class="goods-page" ng-if="cart.t_sl!=0">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Hình</th>
                    <th class="goods-page-description">Miêu tả</th>
                    <th class="goods-page-ref-no">Mã hàng</th>
                    <th class="goods-page-quantity">Số lượng</th>
                    <th class="goods-page-price">Đơn giá</th>
                    <th class="goods-page-total" colspan="2">Thành tiền</th>
                  </tr>
                  <tr ng-repeat="item in cart.shops[id_app].listproducts">
                    <td class="goods-page-image">
                      <a ng-href="sp-{{item._id}}-{{item.ten_vt}}.html"><img ng-src="{{server_url}}{{item.picture_thumb}}" alt="{{item.ten_vt}}"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a ng-href="sp-{{item._id}}-{{item.ten_vt}}.html">{{item.ten_vt}}</a></h3>
                      <p><strong>Số lượng: {{item.sl_xuat|number:0}}</strong></p>
                      <!--<em>More info is here</em>-->
                    </td>
                    <td class="goods-page-ref-no">
					{{item.ma_vt}}
                    </td>
                    <td class="goods-page-quantity">
                      <div >
                          <!--<input id="product-quantity" type="text" ng-model="item.sl_xuat" readonly class="form-control input-sm">-->
						  <input min="0" style="width:80px;font-size:18px" type='number' ng-change='cart.delete2cart(id_app,item._id,item.sl_xuat,true)' ng-model='item.sl_xuat'/>
                      </div>
                    </td>
                    <td class="goods-page-price">
                      <strong>{{item.gia_ban_thuc|number:0}}<span>đ</span></strong>
                    </td>
                    <td class="goods-page-total">
                      <strong>{{item.tien|number:0}}<span>đ</span></strong>
                    </td>
                    <td class="del-goods-col">
                      <a class="del-goods" ng-click="cart.delete2cart(id_app,item._id,0)">&nbsp;</a>
                    </td>
                  </tr>
                  
                </table>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li>
                      <em>Tổng tiền hàng</em>
                      <strong class="price">{{cart.t_tien|number:0}}<span>đ</span></strong>
                    </li>
                   <!-- <li>
                      <em>Chi phí vận chuyển</em>
                      <strong class="price">0<span>đ</span></strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>Tổng thanh toán</em>
                      <strong class="price">{{cart.t_tien|number:0}}<span>đ</span></strong>
                    </li>
					-->
                  </ul>
                </div>
              </div>
              <a class="btn btn-default" href="shop">Tiếp tục mua hàng <i class="fa fa-shopping-cart"></i></a>
              <a class="btn btn-primary" href="checkout.php">Thanh toán <i class="fa fa-check"></i></a>
            </div>
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

 <?php
  //call the wp foooter
  get_footer();
?>

