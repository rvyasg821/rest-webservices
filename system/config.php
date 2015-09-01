<?php
////////////////////////////////////////////////////////////
//***** GENERAL SETTINGS *********************************//
////////////////////////////////////////////////////////////
error_reporting(E_ALL ^ E_NOTICE);  									// display all errors except notices
@ini_set('display_errors', '1'); 										// display all errors
@ini_set('register_globals', 'Off');									// make globals off runtime
@ini_set('magic_quotes_runtime', 'Off');								// Magic quotes for 																		

/////////////////////////////////////////////////////////////
//***** SITE CONFIGURATION ********************************//
/////////////////////////////////////////////////////////////
$path_http = pathinfo('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
$arrDirPath = explode("/", $path_http["dirname"]); 						//server path is deined here
if($arrDirPath[count($arrDirPath)-1] == "admin"){
	// server root path is created from here
	define("SERVER_ROOT_DIR_PATH", substr(getcwd(), 0, (strlen(getcwd())-strlen($arrDirPath[count($arrDirPath)-1])))); 
	$serverPath = $arrDirPath;
	array_pop($serverPath);
	$serverUrl = implode("/",$serverPath);
	define("SERVER_URL_PATH", $serverUrl."/"); 								// server path is deined here
}else{
	define("SERVER_ROOT_DIR_PATH", getcwd()."/"); 		  					// server root path is deined here
	$serverUrl = implode("/",$arrDirPath);
	define("SERVER_URL_PATH", $serverUrl."/"); 								// server path is deined here
	$path_https = pathinfo('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
}
$path_https = pathinfo('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);	
define("SERVER_SSL_PATH", $path_https["dirname"]."/");					// server https path is deined here

?>
