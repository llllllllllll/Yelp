<?php
  require_once("configs/core_conf.php");
  require_once("model/base_model.php");
  require_once("model/yelp_api.php");  
  
  /*
  | ----------------------------------
  | Initialize main Yelp class and API
  | ----------------------------------
  */
  $db_admin = new PG_Yelp_db();
  $yelp_api = new Yelp_api();
  
  $tbl_option_empty = $db_admin->count_settings("PG_Yelp_api_key");
  $record_count = $tbl_option_empty[0]['settings_count'];
  
  // Save Yelp settings
  if(isset($_POST['save_type']))
  {
	$save_type = $_POST['save_type'];
	// API Key values
	$api_key['consumer_key']			=	$_POST['consumer_key'];
	$api_key['consumer_secret']			=	$_POST['consumer_secret'];
	$api_key['token']					=	$_POST['token'];
	$api_key['token_secret']			=	$_POST['token_secret'];
	
	if($save_type == "insert")
	{
	  $db_admin->insert_api_keys($api_key);
	}
	else
	{
	  // Other options values
	  $total_category 					= $_POST['total_catgry'];
	  $option_values["default_category"]	= $_POST['default_category'];
	  $option_ctgry = "";
	  for($x=1;$x<=$total_category;$x++)
	  {
		// Concatenate all the categories in one string
		if($x < $total_category)
		  $option_ctgry					.= $_POST['catgry_'.$x].",";
		else
		  $option_ctgry					.= $_POST['catgry_'.$x];
	  }
	  $option_values["category"]			= $option_ctgry;
	  $option_values["total_category"]	= $total_category;
	  $option_values["show_rows"]			= $_POST['show_rows'];
	  $option_values["template"]			= $_POST['template'];
	
	  // Update API and other option setting values
	  $db_admin->update_api_keys($api_key);
	  $db_admin->update_options($option_values);
	}
  }
  
  // Initial fron display
  if(isset($_POST['trigger']))
  {
	echo $yelp_api->run($record_count,$_POST['link']);
	//echo "<pre>";
	//print_r($response);
	//echo "</pre>";
	//echo json_encode($response);
	//echo $response;
  }
  
  
  
  
  
  
  
  
  
  
  
  