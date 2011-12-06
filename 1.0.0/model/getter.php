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
  if(isset($_POST['save_type']))
  {
	$save_type = $_POST['save_type'];
	// API Key values
	$api_key['consumer_key']	=	$_POST['consumer_key'];
	$api_key['consumer_secret']	=	$_POST['consumer_secret'];
	$api_key['token']			=	$_POST['token'];
	$api_key['token_secret']	=	$_POST['token_secret'];
	
	// Other options values
	$option_values["default_category"]	= $_POST['default_category'];
	$option_values["category"]			= $_POST['catgry_1'].",".$_POST['catgry_2'].",".$_POST['catgry_3'];
	$option_values["show_rows"]			= $_POST['show_rows'];
	$option_values["template"]			= $_POST['template'];
	
	if($save_type == "insert")
	{
	  $db_admin->insert_api_keys($api_key);
	}
	else
	{
	  // Update API and other option setting values
	  $db_admin->update_api_keys($api_key);
	  $db_admin->update_options($option_values);
	}
  }