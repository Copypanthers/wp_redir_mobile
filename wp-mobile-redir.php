<?php


//ini_set("display_errors",true);
/*
Plugin Name: CP Mobile Redirect
Description: Select a URL to point mobile users to
Author: Mehmet YILDIZ
Version: 1.0
Author URI: http://copypanthers.com
*/


require_once __DIR__.'/../../../vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';




add_action("init","is_mobile");

function is_mobile(){
	
        $detect = new Mobile_Detect();
        if ($detect->isMobile()){
                if (substr(icl_get_home_url(), -1) !="/"){
                    $current_url = icl_get_home_url()."/";
                }
                
                $mobile_pages = [
                    "en" => "mobile-index",
                    "de" => "mobile-de",
                    "fr" => "mobile-fr",
                    "fi" => "mobile-fi",
                    "tr" => "mobile-tr",
                    "da" => "mobile-da",
                    "nb" => "mobile-no",
                    "sv" => "mobile-se"
                ];
                if (!preg_match("/mobile/",$_SERVER['REQUEST_URI'])){
			
			//If we are in a homepage redirect.
			$request_uri = str_replace("?".$_SERVER["QUERY_STRING"],"",$_SERVER["REQUEST_URI"]);
			if ($request_uri == "/"){ 
                		$tobe_redirected = $current_url.$mobile_pages[ICL_LANGUAGE_CODE]."?r=1&".$_SERVER["QUERY_STRING"];
                		header("Location: $tobe_redirected");
                		exit;
			}
		}
        }
}

