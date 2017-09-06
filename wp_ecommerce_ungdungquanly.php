<?php
/*
Plugin Name: WP eCommerce
Author: Pham Van Truong (invncur@gmail.com)
Version: 1.0.0
*/
/* Start Adding Functions Below this Line */
//css and js
require_once dirname( __FILE__ )."/".'libs/core.php';
function stripUnicode($str){
  if(!$str) return false;
  $str = strtolower($str);
    
  $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
      'd'=>'đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
   );
    foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
    return $str;
}

function urlSEO($url){
    $url = str_replace(" ","-",$url);
    $url = stripUnicode($url);
    return $url;
}
function eshop_libs() {
    $server_url_libs = plugins_url( '', __FILE__ );//get_option( 'server_url')."/ecommerce";
    
    wp_register_style('font-awesome', $server_url_libs."/assets/global/plugins/font-awesome/css/font-awesome.min.css");
    wp_register_style('bootstrap', $server_url_libs."/assets/global/plugins/bootstrap/css/bootstrap.min.css");



    wp_register_style('jquery.fancybox', $server_url_libs."/assets/global/plugins/fancybox/source/jquery.fancybox.css");
    wp_register_style('owl.carousel', $server_url_libs."/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css");
    wp_register_style('layerslider', $server_url_libs."/assets/global/plugins/slider-layer-slider/css/layerslider.css");



    wp_register_style('components', $server_url_libs."/assets/global/css/components.css");
    wp_register_style('style', $server_url_libs."/assets/frontend/layout/css/style.css");
    wp_register_style('style-shop', $server_url_libs."/assets/frontend/pages/css/style-shop.css" );
    wp_register_style('style-layer-slider', $server_url_libs."/assets/frontend/pages/css/style-layer-slider.css");
    wp_register_style('style-responsive', $server_url_libs."/assets/frontend/layout/css/style-responsive.css");
    
    $color_shop = get_option('color_shop');
    if(!$color_shop){
        $color_shop = 'blue';
    }
    wp_register_style('green', $server_url_libs."/assets/frontend/layout/css/themes/".$color_shop.".css" );
    
    wp_register_style('custom2', $server_url_libs."/assets/frontend/layout/css/custom.css");
    wp_register_style('ngDialog', $server_url_libs."/libs/ngDialog/css/ngDialog.min.css");
    wp_register_style('ngDialog-theme-default', $server_url_libs."/libs/ngDialog/css/ngDialog-theme-default.min.css" );
    
    wp_register_style( 'ng-rateit', $server_url_libs."/libs/angular-rateit/dist/ng-rateit.css" );
    wp_register_style( 'semantic-ui-card', $server_url_libs."/libs/semantic-ui-card/card.min.css" );
    
    

    wp_enqueue_style('font-awesome');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('jquery.fancybox');
    wp_enqueue_style('owl.carousel');
    wp_enqueue_style('components');
    wp_enqueue_style('style');
    wp_enqueue_style('style-shop');
    wp_enqueue_style('style-layer-slider');
    wp_enqueue_style('style-responsive');
    wp_enqueue_style('green');
    wp_enqueue_style('custom2');
    wp_enqueue_style('ngDialog');
    wp_enqueue_style('ngDialog-theme-default');
    wp_enqueue_style('ng-rateit');
    wp_enqueue_style('semantic-ui-card');
   
    
    
    wp_register_script( 'jquery2', $server_url_libs."/assets/global/plugins/jquery-1.11.0.min.js" );
    wp_register_script( 'jquery-migrate', $server_url_libs."/assets/global/plugins/jquery-migrate-1.2.1.min.js" );
    wp_register_script( 'bootstrap', $server_url_libs."/assets/global/plugins/bootstrap/js/bootstrap.min.js" );      
    wp_register_script( 'jquery.slimscroll', $server_url_libs."/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" );

                                                                   
    wp_register_script( 'angular', $server_url_libs."/libs/angular/angular.min.js" );
    wp_register_script( 'angular-cookie', $server_url_libs."/libs/angular-cookie/angular-cookie.min.js" );
    wp_register_script( 'underscore-min', $server_url_libs."/libs/underscore/underscore-min.js" );
    wp_register_script( 'ngDialog', $server_url_libs."/libs/ngDialog/js/ngDialog.min.js" );
    wp_register_script( 'ng-rateit', $server_url_libs."/libs/angular-rateit/dist/ng-rateit.min.js" );
    wp_register_script( 'client', $server_url_libs."/libs/client.js" );

    
    wp_register_script( 'jquery.fancybox', $server_url_libs."/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" );
    wp_register_script( 'owl.carousel', $server_url_libs."/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" );
    wp_register_script( 'jquery.zoom', $server_url_libs."/assets/global/plugins/zoom/jquery.zoom.min.js" );
    wp_register_script( 'bootstrap.touchspin', $server_url_libs."/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" );


    wp_register_script( 'greensock', $server_url_libs."/assets/global/plugins/slider-layer-slider/js/greensock.js" );
    wp_register_script( 'layerslider.transitions', $server_url_libs."/assets/global/plugins/slider-layer-slider/js/layerslider.transitions.js" );
    wp_register_script( 'layerslider.kreaturamedia', $server_url_libs."/assets/global/plugins/slider-layer-slider/js/layerslider.kreaturamedia.jquery.js" );
    wp_register_script( 'elayerslider-initshop', $server_url_libs."/assets/frontend/pages/scripts/layerslider-init.js" );


    //wp_register_script( 'back-to-top', $server_url_libs."/assets/frontend/layout/scripts/back-to-top.js" );
    wp_register_script( 'layout', $server_url_libs."/assets/frontend/layout/scripts/layout.js" );
    
    wp_enqueue_script('jquery2');
    wp_enqueue_script('jquery-migrate');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery.slimscroll');
    
    wp_enqueue_script('angular');
    wp_enqueue_script('angular-cookie');
    wp_enqueue_script('underscore-min');
    wp_enqueue_script('ngDialog');
    wp_enqueue_script('ng-rateit');
    wp_enqueue_script('client');
    
    wp_enqueue_script('jquery.fancybox');
    wp_enqueue_script('owl.carousel');
    wp_enqueue_script('jquery.zoom');
    wp_enqueue_script('bootstrap.touchspin');
    wp_enqueue_script('greensock');
    wp_enqueue_script('layerslider.transitions');
    wp_enqueue_script('layerslider.kreaturamedia');
    wp_enqueue_script('elayerslider-initshop');
    //wp_enqueue_script('back-to-top');
    wp_enqueue_script('layout');
}
function eshop_custome_style(){
    wp_register_style('custom-style', plugins_url("/custom-style.css",__FILE__ ));
    wp_enqueue_style('custom-style');
}
//setting page
function create_plugin_settings_page() {
   
    // Add the menu item and page
    $page_title = 'Settings';
    $menu_title = 'WP eCommerce';
    $capability = 'manage_options';
    $slug = 'eshop_fields_setting';
    $callback = 'plugin_settings_page_content';
    $icon = 'dashicons-admin-plugins';
    $position = 100;

    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    //add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
    
}
add_action( 'admin_menu', 'create_plugin_settings_page'  );
//create session
function setup_sections() {
	add_settings_section( 'connection_info_session', 'Thông tin kết nối với máy chủ', false, 'eshop_fields_setting' );
}
add_action( 'admin_init', 'setup_sections'  );
//create fields
function setup_fields() {
    //server url
    register_setting( 'eshop_fields_setting', 'server_url' );
    add_settings_field( 'server_url', 'Địa chỉ máy chủ',  function($arguments){
        $server_url = get_option( 'server_url');
        if(!$server_url) $server_url = "https://ungdungquanly.vn";
        
        echo '<input style="width:300px"  name="server_url" id="server_url" type="text" value="' . $server_url . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //id app
    register_setting( 'eshop_fields_setting', 'id_app' );
    add_settings_field( 'id_app', 'Id cửa hàng/công ty',function($arguments){
        echo '<input style="width:300px"  name="id_app" id="id_app" type="text" value="' . get_option( 'id_app' ) . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //use shop page make home page
    register_setting( 'eshop_fields_setting', 'shop_is_home' );
    add_settings_field( 'shop_is_home', 'Sử dụng trang bán hàng làm trang chủ',function($arguments){
        echo '<input name="shop_is_home" id="shop_is_home" type="checkbox" value="1" ' . checked( 1, get_option('shop_is_home'), false ). '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //so san pham /dong
    register_setting( 'eshop_fields_setting', 'number_products_row' );
    add_settings_field( 'number_products_row', 'Số sản phẩm/dòng',function($arguments){
        $options = "<option value='six'".selected( 'sex', get_option('number_products_row'), false ).">6 sản phẩm</option>";
        $options = $options."<option value='five'".selected( 'five', get_option('number_products_row'), false ).">5 sản phẩm</option>";
        $options = $options."<option value='four'".selected( 'four', get_option('number_products_row'), false ).">4 sản phẩm</option>";
        $options = $options."<option value='three'".selected( 'three', get_option('number_products_row'), false ).">3 sản phẩm</option>";
        $options = $options."<option value='two'".selected( 'two', get_option('number_products_row'), false ).">2 sản phẩm</option>";
        echo '<select name="number_products_row" id="number_products_row">'.$options.'</select>';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //kieu hien thi
    register_setting( 'eshop_fields_setting', 'theme_shop' );
    add_settings_field( 'theme_shop', 'Kiểu hiện thị',function($arguments){
        
        $options = "<option value='product-list2.php'".selected( 'product-list2.php', get_option('theme_shop'), false ).">Kiểu 1</option>";
        $options = $options."<option value='home.php'".selected( 'home.php', get_option('theme_shop'), false ).">Kiểu 2</option>";
        
        echo '<select name="theme_shop" id="theme_shop">'.$options.'</select>';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //mau sac
    register_setting( 'eshop_fields_setting', 'color_shop' );
    add_settings_field( 'color_shop', 'Màu sắc',function($arguments){
        
        $options = "<option value='blue'".selected( 'blue', get_option('color_shop'), false ).">Blue</option>";
        $options = $options."<option value='gray'".selected( 'gray', get_option('color_shop'), false ).">Gray</option>";
        
        $options = $options."<option value='green'".selected( 'green', get_option('color_shop'), false ).">Green</option>";
        $options = $options."<option value='orange'".selected( 'orange', get_option('color_shop'), false ).">Orange</option>";
        $options = $options."<option value='red'".selected( 'red', get_option('color_shop'), false ).">Red</option>";
        $options = $options."<option value='turquoise'".selected( 'turquoise', get_option('color_shop'), false ).">Turquoise</option>";
        
        
        echo '<select name="color_shop" id="color_shop">'.$options.'</select>';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    //header page shop
    register_setting( 'eshop_fields_setting', 'header_page_shop' );
    add_settings_field( 'header_page_shop', 'Hiện nội dung trang sau dưới header của shop',function($arguments){
        echo '<input style="width:300px"  name="header_page_shop" id="header_page_shop" type="text" value="' . get_option( 'header_page_shop' ) . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    //footer page shop
    register_setting( 'eshop_fields_setting', 'footer_page_shop' );
    add_settings_field( 'footer_page_shop', 'Hiện nội dung trang sau trên footer của shop',function($arguments){
        echo '<input style="width:300px" name="footer_page_shop" id="footer_page_shop" type="text" value="' . get_option( 'footer_page_shop' ) . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
     //header page group product
    register_setting( 'eshop_fields_setting', 'header_page_group' );
    add_settings_field( 'header_page_group', 'Hiện nội dung trang sau dưới header của nhóm sản phẩm',function($arguments){
        echo '<input style="width:300px"  name="header_page_group" id="header_page_group" type="text" value="' . get_option( 'header_page_group' ) . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    //footer page group product
    register_setting( 'eshop_fields_setting', 'footer_page_group' );
    add_settings_field( 'footer_page_group', 'Hiện nội dung trang sau trên footer của nhóm sản phẩm',function($arguments){
        echo '<input style="width:300px" name="footer_page_group" id="footer_page_group" type="text" value="' . get_option( 'footer_page_group' ) . '" />';
    } , 'eshop_fields_setting', 'connection_info_session' );
    
    
}
add_action( 'admin_init', 'setup_fields');
//summary
function plugin_settings_page_content() {?>
    <div class="wrap">
		<form method="post" action="options.php">
            <?php
                settings_fields( 'eshop_fields_setting' );
                do_settings_sections( 'eshop_fields_setting' );
                submit_button();
            ?>
		</form>
	</div> <?php
}
//register page
function shop_page()
{
    $shop_is_home = get_option("shop_is_home");
    if(!$shop_is_home){
        return;
    }
    $home_page = get_option("theme_shop");
    if(!$home_page){
        $home_page = "product-list2.php";
    }
    if(is_page('home') || is_home()){	
        //show header page shop
        $header_page_shop_title = get_option("header_page_shop");
        if($header_page_shop_title){
            $header_page_shop = get_page_by_title( $header_page_shop_title );
            if ($header_page_shop){
                $header_page_shop_post = get_post($header_page_shop->ID); 
                $header_page_shop_post_content = apply_filters('the_content', $header_page_shop_post->post_content); 
            }
        }
        //show footer page shop
        $footer_page_shop_title = get_option("footer_page_shop");
        if($footer_page_shop_title){
            $footer_page_shop = get_page_by_title( $footer_page_shop_title );
            if ($footer_page_shop){
                $footer_page_shop_post = get_post($footer_page_shop->ID); 
                $footer_page_shop_post_content = apply_filters('the_content', $footer_page_shop_post->post_content); 
            }
        }
        
        //
        eshop_libs();
        eshop_custome_style();
        //load core
        $server_url =  get_option('server_url') ;
        $id_app = get_option('id_app');
        $number_products_row = get_option('number_products_row');
        if(!$number_products_row){
            $number_products_row ='six';
        }
        $dir = dirname( __FILE__ )."/" ;
        $core = null;
        $server_url_host = null;
        
    
        $template_url = plugins_url( 'template', __FILE__ );
        $plugin_url = plugins_url( '', __FILE__ );
        
        if(isset($server_url) && isset($id_app)){
            $core = new clientCore($server_url,$id_app);

            $server_url_host =$server_url;
            $server_url = $core->server_url; 
            if($home_page=="product-list2.php"){
                $url ='dmnvt?q={bac:1,status:true}&limit=1&id_app='.$id_app;
                $groups = $core->getJson($url,true);
                if(count($groups)>0){
                    $id = $groups[0]["_id"];
                    $name = $groups[0]["ten_nvt"];
                }
            }
            
            
            include_once $dir.$home_page;
        }
        die();
    }
}
add_action( 'wp', 'shop_page' );
//create route for shop
add_filter('query_vars', 'custom_query_vars');
add_action('init', 'theme_functionality_urls');

function custom_query_vars($vars){
    $vars[] = 'product_id';
    $vars[] = 'ma_nvt';
    $vars[] = 'name';
    $vars[] = 'limit';
    $vars[] = 'page';
    $vars[] = 'sort';
    
    $vars[] = 'search';
    $vars[] = 'cart';
    $vars[] = 'checkout';
    $vars[] = 'shop';
  return $vars;
}

function theme_functionality_urls() {
  add_rewrite_rule(
    '^/?shop$',
    'index.php?shop=1',
    'top'
  );
  //product
  add_rewrite_rule(
    '^/?sp-([0-9a-zA-Z_]+)-(.*)$',
    'index.php?product_id=$matches[1]&name=$matches[2]',
    'top'
  );
  //group
  
  add_rewrite_rule(
    '^/?nh-([0-9a-zA-Z_]+)-([0-9]+)-([0-9]+)-([0-9a-zA-Z_]+)-(.*)$',
    'index.php?ma_nvt=$matches[1]&limit=$matches[2]&page=$matches[3]&sort=$matches[4]&name=$matches[5]',
    'top'
  ); 
    
  add_rewrite_rule(
    '^/?nh-([0-9a-zA-Z_]+)-([0-9]+)-([0-9]+)-(.*)$',
    'index.php?ma_nvt=$matches[1]&limit=$matches[2]&page=$matches[3]&name=$matches[4]',
    'top'
  ); 
  
  add_rewrite_rule(
    '^/?nh-([0-9a-zA-Z_]+)-([0-9]+)-(.*)$',
    'index.php?ma_nvt=$matches[1]&limit=$matches[2]&name=$matches[3]',
    'top'
  ); 
  add_rewrite_rule(
    '^/?nh-([0-9a-zA-Z_]+)-(.*)$',
    'index.php?ma_nvt=$matches[1]&name=$matches[2]',
    'top'
  ); 
    
  //search
  add_rewrite_rule(
    '^/?tim-kiem-([0-9]+)-([0-9]+)-([0-9a-zA-Z_]+)-(.*)$',
    'index.php?limit=$matches[1]&page=$matches[2]&sort=$matches[3]&search=$matches[4]',
    'top'
  );
  add_rewrite_rule(
    '^/?tim-kiem-([0-9]+)-([0-9]+)-(.*)$',
    'index.php?limit=$matches[1]&page=$matches[2]&search=$matches[3]',
    'top'
  );
  add_rewrite_rule(
    '^/?tim-kiem-([0-9]+)-(.*)$',
    'index.php?limit=$matches[1]&search=$matches[2]',
    'top'
  );
  add_rewrite_rule(
    '^/?tim-kiem-(.*)$',
    'index.php?search=$matches[1]',
    'top'
  );
  //cart
  add_rewrite_rule(
    '^/?shopping-cart.php',
    'index.php?cart=1',
    'top'
  );
 //check out
 add_rewrite_rule(
    '^/?checkout.php',
    'index.php?checkout=1',
    'top'
 );
    
 flush_rewrite_rules();

 
}
add_action('parse_request', 'custom_requests');
function custom_requests ( $wp ) { 
    $server_url =  get_option('server_url') ;
    $number_products_row = get_option('number_products_row');
    if(!$number_products_row){
        $number_products_row ='six';
    }
    $id_app = get_option('id_app');
    $template_url = plugins_url( 'template', __FILE__ );
    $plugin_url = plugins_url( '', __FILE__ );
    
    $home_page = get_option("theme_shop");
    if(!$home_page){
        $home_page = "product-list2.php";
    }
    $product_list_page = "product-list2.php";
    if($home_page!="product-list2.php"){
        $product_list_page ="product-list.php";
    }
    $dir = dirname( __FILE__ )."/" ;
    $core = null;
    $server_url_host = null;
    
    if(isset($server_url) && isset($id_app)){
       
       if($wp->query_vars['shop']=='1'){
            eshop_libs();
           eshop_custome_style();
            //load core
            $core = new clientCore($server_url,$id_app);

            $server_url_host =$server_url;
            $server_url = $core->server_url; 
           
            if($home_page=="product-list2.php"){
                $url ='dmnvt?q={bac:1,status:true}&limit=1&id_app='.$id_app;
                $groups = $core->getJson($url,true);
                if(count($groups)>0){
                    $id = $groups[0]["_id"];
                    $name = $groups[0]["ten_nvt"];
                }
            }
           
            include_once $dir.$home_page;
            die();
            return;
        }
    
        if($wp->query_vars['cart']=='1'){
            eshop_libs();
            eshop_custome_style();
            //load core
            $core = new clientCore($server_url,$id_app);

            $server_url_host =$server_url;
            $server_url = $core->server_url; 
            
            include_once $dir.'shopping-cart.php';
             die();
        }else{
            if($wp->query_vars['checkout']=='1'){
                eshop_libs();
                eshop_custome_style();
                //load core
                $core = new clientCore($server_url,$id_app);

                $server_url_host =$server_url;
                $server_url = $core->server_url; 
                
                include_once $dir.'checkout.php';
                 die();
            }else{
                
                if(isset($wp->query_vars['search'])){
                    eshop_libs();
                    eshop_custome_style();
                    //load core
                    $core = new clientCore($server_url,$id_app);

                    $server_url_host =$server_url;
                    $server_url = $core->server_url; 
                    
                    $name = urldecode($wp->query_vars['search']);
                    
                    $page =  $wp->query_vars['page'];
                    $sort =  $wp->query_vars['sort'];
                    $limit =  $wp->query_vars['limit'];
                    
                    include_once $dir.'search.php';
                    die();
                }else{
                    if(isset($wp->query_vars['ma_nvt'])){
                        eshop_libs();
                        eshop_custome_style();
                        //header and footer
                        $header_page_group_title = get_option("header_page_group");
                        if($header_page_group_title){
                            $header_page_group = get_page_by_title( $header_page_group_title );
                            if ($header_page_group){
                                $header_page_group_post = get_post($header_page_group->ID); 
                                $header_page_group_post_content = apply_filters('the_content', $header_page_group_post->post_content); 
                            }
                        }
                        $footer_page_group_title = get_option("footer_page_group");
                        if($footer_page_group_title){
                            $footer_page_group = get_page_by_title( $footer_page_group_title );
                            if ($footer_page_group){
                                $footer_page_group_post = get_post($footer_page_group->ID); 
                                $footer_page_group_post_content = apply_filters('the_content', $footer_page_group_post->post_content); 
                            }
                        }
                        //load core
                        $core = new clientCore($server_url,$id_app);

                        $server_url_host =$server_url;
                        $server_url = $core->server_url; 
                        
                        $name = urldecode($wp->query_vars['name']);
                        $id =  $wp->query_vars['ma_nvt'];
                        $page =  $wp->query_vars['page'];
                        $sort =  $wp->query_vars['sort'];
                        $limit =  $wp->query_vars['limit'];
                        
                        include_once $dir.$product_list_page;
                        die();
                    }else{
                        $id =  $wp->query_vars['product_id'];
                        if(isset($id)){
                            eshop_libs();
                            eshop_custome_style();
                            //load core
                            $core = new clientCore($server_url,$id_app);

                            $server_url_host =$server_url;
                            $server_url = $core->server_url; 
                            
                            $product_main = $core->getOne("dmvt?q={_id:'$id'}&id_app=$id_app");
                            if($product_main!=null){
                                $nested = true;
                                $group_id = $product_main['ma_nvt'];
                                include_once $dir.'product.php';
                                die();
                            }else{
                                include_once $dir.'page-404.php';
                                die();
                            }
                        }else{
                            if(!get_option("shop_is_home")){
                               eshop_libs();
                            }
                        }
                    }
                    
                    
                    
                }
                
            }
            
        }
        
    }
}
// Register and load the widget
function wpb_load_widget_shop() {
    register_widget( 'wpb_widget_shop' );
}
add_action( 'widgets_init', 'wpb_load_widget_shop' );
// Creating the widget 
class wpb_widget_shop extends WP_Widget {

    function __construct() {
        parent::__construct(

        // Base ID of your widget
        'wpb_widget_shop', 

        // Widget name will appear in UI
        __('WP eCommerce - Danh sách sản phẩm', 'wpb_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Widget danh sách sản phẩm. widget này chỉ xuất hiện trên trang chủ (home)', 'wpb_widget_domain' ), ) 
        );
        
    }
    // Creating widget front-end

    public function widget( $args, $instance ) {
        if(is_home() && !get_option("shop_is_home")){
            eshop_custome_style();
            $title = apply_filters( 'widget_title', $instance['title'] );
            $server_url =  get_option('server_url') ;
            $id_app = get_option('id_app');
            $template_url = plugins_url( 'template', __FILE__ );
            $plugin_url = plugins_url( '', __FILE__ );
            $dir = dirname( __FILE__ )."/" ;
            $core = null;
            $server_url_host = null;
            $number_products_row = get_option('number_products_row');
            if(!$number_products_row){
                $number_products_row ='six';
            }
            if(isset($server_url) && isset($id_app)){
                //load core
                $core = new clientCore($server_url,$id_app);
                $server_url_host =$server_url;
                $server_url = $core->server_url; 
                //get group default
                $url ='dmnvt?q={bac:1,status:true}&limit=1&id_app='.$id_app;
                $groups = $core->getJson($url,true);
                if(count($groups)>0){
                    $id = $groups[0]["_id"];
                    $name = $groups[0]["ten_nvt"];
                }
                //
                include_once $dir.'widget_home.php';

            }
        }
       
    }
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Cửa hàng', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Tiêu đề:' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
/* Stop Adding Functions Below this Line */
?>
