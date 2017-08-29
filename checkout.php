
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
<div class="ecommerce" ng-app="shopApp" ng-controller="checkoutController" ng-cloak>
    <?php
        include $dir."template/header.html";
    
        $url = "ptthanhtoan?id_app=".$id_app;
		$ptthanhtoan = $core->getJson($url,true);
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

    <div class="main">
      <div class="">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
			<form name="form" novalidate >
            <h1>Xác nhận</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

              <!-- BEGIN SHIPPING ADDRESS -->
              <div id="shipping-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content" class="accordion-toggle">
                      Bước 1: Thông tin giao hàng
                    </a>
                  </h2>
                </div>
                <div id="shipping-address-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="firstname-dd">Tên người nhận hàng <span class="require">*</span></label>
                        <input type="text" id="firstname-dd" ng-model='dia_chi_giao_hang.ten_nguoi_nhan' class="form-control" ng-required='true'>
                      </div>
                      
                      <div class="form-group">
                        <label for="email-dd">E-Mail</label>
                        <input type="text" id="email-dd" class="form-control" ng-model='dia_chi_giao_hang.email'>
                      </div>
                      <div class="form-group">
                        <label for="telephone-dd">Điện thoại <span class="require">*</span></label>
                        <input type="text" id="telephone-dd" class="form-control" ng-model='dia_chi_giao_hang.dien_thoai'>
                      </div>
                      
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="address1-dd">Địa chỉ  <span class="require">*</span></label>
                        <input type="text" id="address1-dd" class="form-control" ng-model='dia_chi_giao_hang.dia_chi' ng-required="true">
                      </div>
                      <div class="form-group">
                        <label for="address2-dd">Xã/phường  <span class="require">*</span></label>
                        <input type="text" id="address2-dd" class="form-control" ng-model='dia_chi_giao_hang.xa_phuong' ng-required="true">
                      </div>
					  <div class="form-group">
                        <label for="address2-dd">Quận/huyện  <span class="require">*</span></label>
                        <input type="text" id="address2-dd" class="form-control" ng-model='dia_chi_giao_hang.quan_huyen' ng-required="true">
                      </div>
                      <div class="form-group">
                        <label for="city-dd">Tỉnh thành <span class="require">*</span></label>
						<select class="form-control" id="city-dd" ng-model='dia_chi_giao_hang.tinh_thanh' ng-required="true">
							<option ng-value='tt' ng-repeat='tt in province'>{{tt}}</option>
						</select>
                      </div>
                      
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-primary  pull-right" type="submit" id="button-shipping-address" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-method-content">Tiếp theo</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END SHIPPING ADDRESS -->

      
              <!-- BEGIN PAYMENT METHOD -->
              <div id="payment-method" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-method-content" class="accordion-toggle">
                      Bước 2: Phương thức thanh toán
                    </a>
                  </h2>
                </div>
                <div id="payment-method-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12">
                      <p>Chọn một phương thức thanh toán.</p>
                      <div class="radio-list" style="padding-left:30px">
						<?php
							foreach($ptthanhtoan as $pt){
								?>
								<div>
									<label class="radio"><input type='radio' name ='pt_thanh_toan' ng-model ='so1.pt_thanh_toan' value='<?php echo $pt['_id'] ?>'> <?php echo $pt['ten'] ?></label>
									<?php 
										if(isset($pt['tai_khoan_nh']) && $pt['tai_khoan_nh']!=""){
											?>
												<div style='padding-left:20px'>
													<div>Số tài khoản: <b><?php echo $pt['tai_khoan_nh'] ?></b></div>
													<div>Chủ tài khoản: <b><?php echo $pt['chu_tai_khoan'] ?></b></div>
													<div>Tại ngân hàng: <b><?php echo $pt['ngan_hang'] ?></b></div>
												</div>
											<?php
										}
									?>
									
								</div>
								<?php
							}
						?>
                        
						
                      </div>
                      <div class="form-group">
                        <label for="delivery-payment-method">Ghi chú</label>
                        <textarea id="delivery-payment-method" rows="8" class="form-control" ng-model ="so1.note_payment"></textarea>
                      </div>
                      <button class="btn btn-primary  pull-right" type="submit" id="button-payment-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#confirm-content">Tiếp theo</button>
                       
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT METHOD -->

              <!-- BEGIN CONFIRM -->
              <div id="confirm" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                      Bước 3: Xác nhận đơn hàng
                    </a>
                  </h2>
                </div>
                <div id="confirm-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12 clearfix">
                      <div class="table-wrapper-responsive">
                      <table>
                        <tr>
                          <th class="checkout-image">Hình</th>
                          <th class="checkout-description">Miêu tả</th>
                          <th class="checkout-quantity">Số lượng</th>
                          <th class="checkout-price">Đơn giá</th>
                          <th class="checkout-total">Thành tiền</th>
                        </tr>
                        <tr ng-repeat="item in cart.shops[id_app].listproducts">
                          <td class="checkout-image">
                            <a href="sp-{{item._id}}-{{item.ten_vt}}"><img ng-src="{{server_url}}{{item.picture_thumb}}" alt="{{item.ten_vt}}"></a>
                          </td>
                          <td class="checkout-description">
                            <h3><a href="sp-{{item._id}}-{{item.ten_vt}}">{{item.ten_vt}}</a></h3>
                          </td>
                          <td class="checkout-quantity">{{item.sl_xuat}}</td>
                          <td class="checkout-price"><strong>{{item.gia_ban_thuc|number:0}}<span>đ</span></strong></td>
                          <td class="checkout-total"><strong>{{item.tien|number:0}}<span>đ</span></strong></td>
                        </tr>
                        
                      </table>
                      </div>
                      <div class="checkout-total-block">
                        <ul>
                          <li>
                            <em>Tiền hàng</em>
                            <strong class="price">{{cart.t_tien|number:0}}<span>đ</span></strong>
                          </li>
                          <!--<li>
                            <em>Phí vận chuyển</em>
                            <strong class="price">0<span>đ</span></strong>
                          </li>
                          
                          <li class="checkout-total-price">
                            <em>Tổng tiền</em>
                            <strong class="price">{{cart.t_tien|number:0}}<span>đ</span></strong>
                          </li>
						  -->
                        </ul>
                      </div>
                      <div class="clearfix"></div>
                      <button class="btn btn-primary pull-right" ng-disabled='form.$invalid || !so1.pt_thanh_toan' ng-click='xacnhan()' id="button-confirm">Xác nhận</button>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CONFIRM -->
            </div>
            <!-- END CHECKOUT PAGE -->
			</form>
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
