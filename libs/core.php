<?php
    class clientCore{
        //config
        public $id_app="";// ="58ea066a95ba3b00229fef83";
        public $server_url_host="";// ="http://salefly.vn";
        public $server_url="";
        public $shopName="SHOP";
        public $shopDescription ="";
        public $shopKeywords ="";
        public $shopLogo ="";
        public $siteName="";
        public $shop=null;
        public $shopUrl="";
        
        function __construct($server_url,$id_app){
            parse_str($_SERVER["QUERY_STRING"]);
            $this->server_url_host = $server_url;
            $this->id_app = $id_app;
            $this->server_url = $this->server_url_host."/public/";
            $this->shopUrl ="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->connectServer();
        }
        public function connectServer(){
            $this->shop = $this->getJson("apps/".$this->id_app);
        
            if(isset($this->shop['name'])){
                $this->shopName =$this->shop['name'];
            }else{
                $this->shopName ="shop offline";
            }

            if(isset($this->shop['nganh_nghe'])){
                $this->shopDescription =$this->shop['nganh_nghe'];
            }

            if(isset($this->shop['keywords'])){
                $this->shopKeywords =$this->shop['keywords'];
            }

            if(isset($this->shop['logo'])){
                $this->shopLogo =$this->server_url_host.$this->shop['logo'];
            }

            if(isset($this->shop['site_name'])){
                $this->siteName =$this->shop['site_name'];
            }
            
        }
        public function getJson($url,$array = true){
            //global $server_url;
            $url =$this->server_url.$url;
            
            //  Initiate curl
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $json=curl_exec($ch);
            // Closing
            curl_close($ch);

            return json_decode($json,$array);
        }
        public function getOne($url){
            $items =  $this->getJson($url);
            if(count($items)>0){
                return $items[0];
            }else{
                return null;
            }
        }
        public function redirect($url){
             header('Location: ' . $url);
             die();
        }
        public function notfound(){
            redirect("page-404.php");
        }
        public function truncted($_str,$length=16){
            $str = mb_strimwidth($_str,0,$length,"...");
                
            if(strlen($str)<$length){
                $str = $str."<span style='color:transparent'>".str_repeat('...', $length-strlen($str))."</span>";
            }
            return $str;
        }
       

    }
    

?>