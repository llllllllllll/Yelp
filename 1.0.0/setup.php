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
	if($yelp_api->run($record_count) != false)
	{
		$option_values = $db_admin->PG_Yelp_option_values("PG_Yelp_option");
		foreach($option_values as $key=>$value)
		{
			// assign field values to its key
			$smarty->assign($key, $value);
		}
		
		$smarty->assign("records_exist", "true");
		//$response 	= $yelp_api->run($record_count);
		//$bus_total 	= count($response["businesses"]);
	}
	else
	{
		// If PG_Yelp_option has no value,
		// set every field name values to NULL.
		$default_category = "general";
		
		$smarty->assign("default_category", $default_category);
		$smarty->assign("records_exist", "false");
	}
	
	$smarty->assign("PLUGIN_NAME", PLUGIN_NAME);
	$smarty->assign("PG_BASE_PATH", $sPgDir);
	$smarty->assign("server_base_url",SERVER_BASE_URL);
	$smarty->assign( 'sScriptCrossDomain' , CAFE24_CROSS_DOMAIN );
	$smarty->assign("getterPhp",$sPgDir."/model/getter.php");
	$smarty->display('setup.tpl');

	
	
	
	