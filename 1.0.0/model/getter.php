<?php
  require_once("../configs/core_conf.php");
  require_once("base_model.php");
  require_once("../libs/simple_html_dom.php");
  
  /*
  | ----------------------------------
  | Initialize main Yelp class
  | ----------------------------------
  */
  $db_admin = new PG_Yelp_db();
  
  // Save Yelp settings
  if(isset($_POST['consumer_key']))
  {
	$api_key['consumer_key']	=	$_POST['consumer_key'];
	$api_key['consumer_secret']	=	$_POST['consumer_secret'];
	$api_key['token']			=	$_POST['token'];
	$api_key['token_secret']	=	$_POST['token_secret'];
	
	$db_admin->insert_api_keys($api_key);
	
  }