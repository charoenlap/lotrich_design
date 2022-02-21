<?php 
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Asia/Bangkok');
	ob_start();
	session_start();
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if($_SERVER['SERVER_NAME'] == 'localhost'){
		require_once($_SERVER['DOCUMENT_ROOT'].'/lotrich/config/domains/lotrich/config.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/lotrich/lib/function/main_function.php');
		require_once('catalog/setup.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/lotrich/lib/system/loader/autoload.php'); 
	}else{
		require_once('/home/admin/domains/lotrich168.com/config/domains/lotrich/config.php'); 
		require_once('/home/admin/domains/lotrich168.com/lib/function/main_function.php');
		require_once('/home/admin/domains/lotrich168.com/public_html/admin_back_office/catalog/setup.php'); 
		require_once('/home/admin/domains/lotrich168.com/lib/system/loader/autoload.php'); 
	}
?>