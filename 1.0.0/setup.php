<?php
	require_once("configs/core_conf.php");
  require_once("model/base_model.php");
  
	/*
	| ----------------------------------
	| Initialize main Paypaldonate class
	| ----------------------------------
	*/
	$db_admin = new PG_Paypaldonate_db();
	
	/*
	| -----------------------------------------------
	| Initialize PG_Paypaldonate_option value checker
	| -----------------------------------------------
	*/
	$tbl_option_empty = $db_admin->count_settings();
	$record_count = $tbl_option_empty[0]['settings_count'];
	$smarty->assign("RECORD_COUNT", $record_count);
	
	/*
	| -----------------------------------------------
	| Validate PG_Paypaldonate_option
	| - If PG_Paypaldonate_option has no value,
	|   set every field name values to NULL.
	| - Otherwise, assign field values to its key
	| -----------------------------------------------
	*/
	if($record_count > 0)
	{
		$option_values = $db_admin->PG_Paypaldonate_option_values();
		foreach($option_values as $key=>$value)
		{
			// assign field values to its key
			$smarty->assign($key, $value);
		}
	}
	else
	{
		// If PG_Paypaldonate_option has no value,
	  // set every field name values to NULL.
		$smarty->assign("paypal_acct", NULL);
		$smarty->assign("page_style", NULL);
		$smarty->assign("return_page", NULL);
		$smarty->assign("amount", NULL);
		$smarty->assign("purpose", NULL);
		$smarty->assign("reference", NULL);
		$smarty->assign("button_image", NULL);
		$smarty->assign("title", NULL);
		$smarty->assign("text", NULL);
	}
	
	/*
	| -----------------------------------------------
	| Initialize PG_Paypaldonate_currency 
	| -----------------------------------------------
	*/
	// Count PG_Paypaldonate_currency values
	$count_currency_values = $db_admin->count_currency();
	$currency_count = $count_currency_values[0]['currency_count'];
	$smarty->assign("TOTAL_CURRENCY", $currency_count);
	
	$currency_counter = 1;
	$currency_values = $db_admin->PG_Paypaldonate_currency_values();
	for($x=0;$x<$currency_count;$x++)
	{
		// assign field values to its key
		$smarty->assign("CURRENCY_NAME_".$currency_counter, $currency_values[$x]['currency']);
		$smarty->assign("CURRENCY_SHORT_".$currency_counter, $currency_values[$x]['short']);
		$currency_counter++;
	}
	
	
	$smarty->assign("PLUGIN_NAME", PLUGIN_NAME);
	$smarty->assign("PG_BASE_PATH", $sPgDir);
	$smarty->assign("server_base_url",SERVER_BASE_URL);
	$smarty->assign( 'sScriptCrossDomain' , CAFE24_CROSS_DOMAIN );
	$smarty->assign("getterPhp",$sPgDir."/model/getter.php");
	
  $smarty->display('setup.tpl');

	
	
	
	