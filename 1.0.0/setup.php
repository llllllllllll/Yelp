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
	
	/*
	| -----------------------------------------------
	| Initialize PG_Yelp_option value checker
	| -----------------------------------------------
	*/
	$tbl_option_empty = $db_admin->count_settings("PG_Yelp_api_key");
	$record_count = $tbl_option_empty[0]['settings_count'];
	$smarty->assign("RECORD_COUNT", $record_count);

	/*
	| -----------------------------------------------
	| Validate PG_Yelp_option
	| - If PG_Yelp_option has no value,
	|   set every field name values to NULL.
	| - Otherwise, assign field values to its key
	| -----------------------------------------------
	*/
	if($yelp_api->run($record_count,$yelp_api->def_generalUrl()) != false)
	{
		$def_location = "San Francisco";
		
		// API Key table
		$api_key_values = $db_admin->PG_Yelp_values("PG_Yelp_api_key");
		foreach($api_key_values as $key=>$value)
		{
			// assign field values to its key
			$smarty->assign($key, $value);
		}
		
		// Yelp option table
		$option_values = $db_admin->PG_Yelp_values("PG_Yelp_option");
		foreach($option_values as $key=>$value)
		{
			// assign field values to its key
			$smarty->assign($key, $value);
		}
		
		// Get each categories
		$total_category = $option_values["total_category"];
		$category 		= $option_values["category"];
		$slice_ctgry = explode(",", $category);
		for($x=0;$x<$total_category;$x++)
		{
			$smarty->assign("ctrgy_".$x, $slice_ctgry[$x]);
		}
		$smarty->assign("total_category", $total_category);
		$smarty->assign("records_exist", "true");

		// Checks if API Keys are valid
		$response 	= json_decode($yelp_api->run($record_count,$yelp_api->def_generalUrl()), true);
		//echo "<pre>";
		//print_r($response);
		//echo "</pre>";
		if(isset($response["error"]))
		{
			if($response["error"]["id"] == "INVALID_OAUTH_CREDENTIALS")
				$api_error	= "Consumer Key is invalid.";
			elseif($response["error"]["id"] == "INVALID_SIGNATURE")
				$api_error	= "Consumer Secret or Token is invalid.";
			elseif($response["error"]["id"] == "INVALID_PARAMETER")
				$api_error	= "Token is invalid.";
			elseif($response["error"]["id"] == "EXCEEDED_REQS")
				$api_error	= "You have reached the maximum number of daily request.";
			else
				$api_error	= "Unknown error.";
			$smarty->assign("api_validity", $api_error);
		}
		else
		{
			$smarty->assign("api_validity", "true");
		}
		
		// Default Categories
		$default_categories	= $db_admin->default_categories($def_location);
		$smarty->assign("default_categories", $default_categories);
		
		// Default location
		$smarty->assign("default_location", $def_location);
	}
	else
	{
		// If PG_Yelp_option has no value,
		// set every field name values to NULL.
		$default_category 	= "general";
		$template			= "blue";
		
		$smarty->assign("default_category", $default_category);
		$smarty->assign("template", $template);
		$smarty->assign("records_exist", "false");
		$smarty->assign("api_validity", "API Keys are not set.");
	}
	
	$smarty->assign("PLUGIN_NAME", PLUGIN_NAME);
	$smarty->assign("PG_BASE_PATH", $sPgDir);
	$smarty->assign("server_base_url",SERVER_BASE_URL);
	$smarty->assign( 'sScriptCrossDomain' , CAFE24_CROSS_DOMAIN );
	$smarty->assign("getterPhp",$sPgDir."/getter.php");
	$smarty->assign('sJSEmulation', SERVER_COMMONJS_URL);
	
	$smarty->display('setup.tpl');

	
	
	
	