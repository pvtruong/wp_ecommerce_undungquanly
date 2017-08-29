var mainModule = angular.module("shopApp",['ipCookie',"ngDialog","ngRateIt"]);
mainModule.controller("homeController",function($scope){
	$scope.server_url = server_url;
})
mainModule.controller("productController",function($scope,$http){
	$scope.server_url = server_url;
	$scope.sl =1;
	$scope.comments =[];
	$scope.rate =0;
	var calcRateAvg = function(){
		if($scope.comments.length>0){
			var rate =0;
			$scope.comments.forEach(function(r){
				rate = rate + r.rate;
			})
			$scope.rate = rate/$scope.comments.length;
		}else{
			$scope.rate =0;
		}
	}
	$scope.comment={rate:4,id_product:id_product};
	var comment_url =server_url + "/public/comment";
	$http.get(comment_url + "?q={id_product:'" + id_product + "'}").success(function(rs){
		$scope.comments = rs;
		calcRateAvg();
		
	}).error(function(e){
		//console.log(comment_url + "&q={id_product:'" + id_product + "'}")
	})
	$scope.sendComment = function(){
		$http.post(comment_url,$scope.comment).success(function(rs){
			//console.log(rs);
			$scope.comment={rate:4,id_product:id_product};
			$scope.comments.push(rs);
			calcRateAvg();
		})
	}
})
mainModule.controller("productListController",function($scope,$window){
	$scope.server_url = server_url;
	$scope.products_count = products_count;
	$scope.sortBy = sortBy;
	if(!$scope.sortBy) $scope.sortBy ="name";
	$scope.sorts =[{id:'name',title:'Tên sản phẩm (từ A-Z)'},{id:'price',title:'Giá bán (tăng dần)'},{id:'date',title:'Ngày bán (từ mới đến cũ)'}]
	$scope.limits = [6,12,24,30,36,60,120];
	$scope.limit = limit;
	$scope.page = page;
	$scope.pages =[];
	var fist_page =1;
	var end_page = Math.round(products_count/limit,0);
	if(end_page*limit<products_count){
		end_page = end_page + 1;
	}
	if(page-3>0){
		fist_page =page-3; 
	}
	for(var i=fist_page;i<=end_page;i++){
		$scope.pages.push(i);
	}
	if(! _.contains($scope.limits,limit)){
		$scope.limits.push($scope.limit);
	}
	if(!$scope.limit) $scope.limit =30;
	$scope.goto = function(id,name,limit,sortBy){
		if(!sortBy) sortBy = "name";
		if(!limit) limit =30;
		$window.location.href= "nh-" + id + "-" + limit.toString() + "-1-" + sortBy  + "-" + name;
	}
})
mainModule.controller("searchController",function($scope,$window){
	$scope.server_url = server_url;
	$scope.products_count = products_count;
	$scope.sortBy = sortBy;
	if(!$scope.sortBy) $scope.sortBy ="name";
	$scope.sorts =[{id:'name',title:'Tên sản phẩm (từ A-Z)'},{id:'price',title:'Giá bán (tăng dần)'},{id:'date',title:'Ngày bán (từ mới đến cũ)'}]
	$scope.limits = [6,12,24,30,36,60,120];
	$scope.limit = limit;
	$scope.page = page;
	$scope.pages =[];
	var fist_page =1;
    
	var end_page = Math.round(products_count/limit,0);
	if(end_page*limit<products_count){
		end_page = end_page + 1;
	}
    
	if(page-3>0){
		fist_page =page-3; 
	}
	for(var i=fist_page;i<=end_page;i++){
		$scope.pages.push(i);
	}
	if(! _.contains($scope.limits,limit)){
		$scope.limits.push($scope.limit);
	}
	if(!$scope.limit) $scope.limit =30;
	$scope.goto = function(id,name,limit,sortBy){
		if(!sortBy) sortBy = "name";
		if(!limit) limit =30;
		$window.location.href= "tim-kiem-"+ limit.toString() + "-1-" + sortBy  + "-" + name;
	}
})
mainModule.controller("cartController",function($scope){
	$scope.server_url = server_url;
})
mainModule.controller('checkoutController',function($scope,$rootScope,$http,$location,ipCookie,$window,ngDialog){
	$scope.so1 ={}
	$scope.id_app = id_app
	$scope.cart = $rootScope.cart;
	if(!$scope.cart.shops[id_app] || $scope.cart.shops[id_app].listproducts.length==0 ){
		$window.location.href ="shopping-cart.php";
		return;
	}
	$scope.dia_chi_giao_hang = ipCookie('dia_chi_giao_hang');
	if(!$scope.dia_chi_giao_hang){
		$scope.dia_chi_giao_hang ={};
	}
	$http.get(server_url + "/public/province").success(function(province){
		$scope.province = province;
	});
	
	
	$scope.xacnhan = function(){
		$scope.so1.id_app = id_app;
		_.extend($scope.so1,$scope.dia_chi_giao_hang)
		ipCookie('dia_chi_giao_hang',$scope.dia_chi_giao_hang,{ expires: 365});
		var shop = $scope.cart.shops[id_app]
		if(shop){
			$scope.so1.details = shop.listproducts;
		}else{
			return alert("Không có sản phẩm nào từ của hàng này");
		}
		$http.post(server_url + "/public/so1?id_app=" + id_app,$scope.so1).success(function(so1){
			delete $scope.cart.shops[id_app];
			$rootScope.apply_cart();
			var dialog = ngDialog.open({
				template: template_url + '/thankyou.html',
				scope: $scope,
				controller:function($scope){
					$scope.close = function(){
						dialog.close();
					}
				}
			});
			dialog.closePromise.then(function (data) {
				$window.location.href="shop";
			});
			
		}).error(function(error){
			alert(error);
		});
	}
});
mainModule.constant('_', window._);
mainModule.config(['ngDialogProvider', function (ngDialogProvider) {
    ngDialogProvider.setDefaults({
        className: 'ngdialog-theme-default',
        plain: false,
        showClose: true,
        closeByDocument: true,
        closeByEscape: true
    });
}]);
mainModule.run(function($rootScope,ipCookie,ngDialog,$window,$http){
	$rootScope.server =""
	$rootScope.server_url = server_url;
	$rootScope.id_app = id_app;
	$rootScope.cart ={t_sl:0,t_tien:0,shops:{},listshops:[]};
	var app;
	//subscribe
	$rootScope.email_subscribe=""
	$rootScope.subscribe = function(email_subscribe){
		var url = server_url +"/public/subscribe";
		var data = {email:email_subscribe,id_app:$rootScope.id_app};
		$http.post(url,data).success(function(r){
			$rootScope.email_subscribe="";
			alert("Cám ơn bạn đã đang ký nhận email thông tin khuyến mãi của chúng tôi.")
		}).error(function(e){
			if(e){
				alert(e)
				console.log(data);
			}else{
				alert("Xin lỗi, Không thể đang ký nhận email thông tin đăng ký. Bạn hãy thử lại sau")
			}
			
		})
		
	}
	//view product
	$rootScope.viewProduct = function(id,name){
		$window.location.url ="sp-" + id + "-" + name;
	}
	//fast view
	$rootScope.fastView = function(id_product){
       
		var url = server_url +"/public/dmvt?id_app=" + id_app + "&q={_id:'" + id_product + "'}"
		$http.get(url).success(function(rs){
			if(rs.length==1){
				var product = rs[0];
				var dialog = ngDialog.open({
					template: template_url + '/fast-view2.html',
					scope: $rootScope,
					className: 'ngdialog-theme-default dialogwidth800',
					controller:function($scope){
						$scope.product = product;
						$scope.so_luong =1;
						$scope.close = function(){
							dialog.close();
						}
					}
				});
			}
		}).error(function(e){
            
			console.log(e);
		})
	}
    $rootScope.zoom = function(url_image){
		var dialog = ngDialog.open({
            template: template_url + '/zoom.html',
            scope: $rootScope,
            className: 'ngdialog-theme-default dialogwidth800',
            controller:function($scope){
                $scope.src = url_image;
                $scope.close = function(){
                    dialog.close();
                }
            }
        });
	}
	//add new shop
	$rootScope.cart.newShop = function(){
		var shop ={_id:id_app}
		shop.vts={};
		shop.listproducts=[];
		$rootScope.cart.shops[id_app] = shop;
		return shop;
	}
	//add 2 cart
	$rootScope.cart.add2cartnoalert = function(product,sl){
		if(!sl) sl = 1;
		sl = Number(sl);
		var shop = $rootScope.cart.shops[id_app];
		if(!shop){
			shop = $rootScope.cart.newShop();
		}
		var vt = shop.vts[product._id];
		if(!vt){
			vt = {_id:product._id,ma_vt:product.ma_vt,ten_vt:product.ten_vt,picture_thumb:product.picture_thumb,ma_dvt:product.ma_dvt
				,sl_xuat:sl,gia_ban_le:product.gia_ban_le,ty_le_ck:product.ty_le_ck
				,gia_ban:product.gia_ban_le,gia_ban_nt:product.gia_ban_le,gia_ban_thuc:product.gia_ban_thuc};
			if(product.tien_ck_1_sp){
				vt.tien_ck_1_sp = product.tien_ck_1_sp;
			}else{
				vt.tien_ck_1_sp = product.tien_ck;
			}
			vt.tien_hang_nt = Number(vt.sl_xuat) * Number(vt.gia_ban)
			vt.tien_hang = vt.tien_hang_nt
			
			vt.tien_ck_nt = Number(vt.sl_xuat) * Number(vt.tien_ck_1_sp)
			vt.tien_ck = vt.tien_ck_nt
			
			vt.tien_nt = vt.tien_hang_nt - vt.tien_ck_nt;
			vt.tien = vt.tien_nt
			
			shop.vts[product._id] = vt;
		}else{
			vt.sl_xuat = Number(vt.sl_xuat) + sl;
			vt.tien_hang_nt = Number(vt.sl_xuat) * Number(vt.gia_ban)
			vt.tien_hang = vt.tien_hang_nt
			
			vt.tien_ck_nt = Number(vt.sl_xuat) * Number(vt.tien_ck_1_sp)
			vt.tien_ck =vt.tien_ck_nt
			
			vt.tien_nt = vt.tien_hang_nt - vt.tien_ck_nt;
			vt.tien = vt.tien_nt
		}
		return vt;
	}
	//add 2 cart
	$rootScope.cart.add2cart = function(id_product,sl){
		var url = server_url +"/public/dmvt?id_app=" + id_app + "&q={_id:'" + id_product + "'}"
		$http.get(url).success(function(rs){
			if(rs.length==1){
				var product = rs[0];
				var vt = $rootScope.cart.add2cartnoalert(product,sl);
				//apply to cart
				$rootScope.apply_cart();
				var dialog = ngDialog.open({
					template: template_url + '/add2cart2.html',
					scope: $rootScope,
					controller:function($scope){
						$scope.vt = vt
						$scope.shop = $rootScope.cart.shops[id_app];
						$scope.delete2cart = function(id_app,id_vt,sl,change){
							if($rootScope.cart.delete2cart(id_app,id_vt,sl,change)==0){
								$scope.close();
							}
						}
						$scope.close = function(){
							dialog.close();
						}
					}
				});
			}
		}).error(function(e){
			console.log(e);
		})
		
	}
	// add 2 like
	$rootScope.cart.add2like = function(vt){
	}
	//delete cart
	$rootScope.cart.delete2cart = function(id_app,id_vt,sl,change){
		var shop = $rootScope.cart.shops[id_app];
		if(!shop) return 0;
		if(sl==0) {
			delete shop.vts[id_vt]//delete all
			$rootScope.apply_cart();
			return 0;
		}else{
			var vt = shop.vts[id_vt];
			if(!vt){
				$rootScope.apply_cart();
				return 0;
			}
			if(change){
				vt.sl_xuat = sl;
			}else{
				vt.sl_xuat = vt.sl_xuat + sl;
			}
			
			if(vt.sl_xuat<=0){
				delete shop.vts[id_vt]//delete all
				$rootScope.apply_cart();
				return 0;
			}else{
				vt.tien_hang_nt = vt.sl_xuat * vt.gia_ban
				vt.tien_hang = vt.tien_hang_nt
				
				vt.tien_ck_nt = vt.sl_xuat * vt.tien_ck_1_sp
				vt.tien_ck =vt.tien_ck_nt
				
				vt.tien_nt = vt.tien_hang_nt - vt.tien_ck_nt;
				vt.tien = vt.tien_nt
			}
		}
		if(_.keys(shop.vts).length==0){
			delete $rootScope.cart.shops[id_app];
			$rootScope.apply_cart();
			return 0;
		}
		$rootScope.apply_cart();
		return vt.sl_xuat;
		
	}
	//apply to cart
	$rootScope.apply_cart = function(){
		var count =0;
		var money =0;
		var listshops = [];
		var save_listproducts = {};
		var save_listshops = {};
		for(var s in $rootScope.cart.shops){
			var shop = $rootScope.cart.shops[s];
			save_listshops[shop._id] = {_id:shop._id,name:shop.name};
			listshops.push(shop);
			var listproducts=[];
			var t_tien=0
			var t_sl =0;
			for(var vt in shop.vts){
				count = count + shop.vts[vt].sl_xuat;
				money = money + shop.vts[vt].tien;
				t_tien = t_tien + shop.vts[vt].tien;
				t_sl = t_sl + shop.vts[vt].sl_xuat;
				listproducts.push(shop.vts[vt]);
			}
			shop.t_sl = t_sl
			shop.t_tien = t_tien;
			shop.listproducts = listproducts;
			save_listproducts[s] = listproducts;
		}
		$rootScope.cart.listshops = listshops;
		
		$rootScope.cart.t_sl=count;
		$rootScope.cart.t_tien=money;
		ipCookie('products',save_listproducts,{expires: 2});
		ipCookie('apps',save_listshops,{expires: 2});
	}
	//restore cart
	$rootScope.restore_cart= function(){
		$rootScope.cart.shops={}
		var products = ipCookie('products');
		var apps = ipCookie('apps');
		if(apps && products){
			for(var a in products){
				var app = apps[a]
				if(app){
					products[a].forEach(function(product){
						$rootScope.cart.add2cartnoalert(product,product.sl_xuat);
					});
				}
			}
			$rootScope.apply_cart();
		}
       
        var cartpopup = angular.element($("#cartpopup"));

        cartpopup.css("display","block")
        
		
		
	}
	$rootScope.restore_cart();
	$http.get(server_url + "/public/apps/" + id_app).success(function(a){
		app =a;
		$rootScope.app = app;
	}).error(function(e){
		console.log(e);
	})
});
mainModule.directive("support",function(){
	return {
		templateUrl:template_url + "/support.html",
		controller:function($scope,$rootScope){
			$scope.app = $rootScope.app;
		}
	}
})
mainModule.directive('parseHtml',function(){
	return{
		restrict:'A',
		scope:{
			parseHtml:'='

		},
		link:function(scope,elem,attrs,controller){
			scope.$watch('parseHtml',function(newValue,oldValue){

				 if(newValue){
					var res = /<[a-z][\s\S]*>/i.test(newValue);
					if(res){
						elem.html(newValue);
					}else{
						elem.html(newValue.replace(/\n/g,'<br/>'));
					}
                     

				 }
			});
		}
	}
});