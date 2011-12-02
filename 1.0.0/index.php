<?php
  require_once("configs/core_conf.php");
  require_once("model/base_model.php");
  require_once("libs/simple_html_dom.php");
  
  /*
	| ----------------------------------
	| Initialize main Yelp class
	| ----------------------------------
	*/
	$db_admin = new PG_Yelp_db();
	
	/*
	| -----------------------------------------------
	| Initialize PG_Yelp_option value checker
	| -----------------------------------------------
	*/
	$tbl_option_empty = $db_admin->count_settings();
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
	if($record_count > 0)
	{
		$option_values = $db_admin->PG_Yelp_option_values();
		foreach($option_values as $key=>$value)
		{
			// assign field values to its key
			$smarty->assign($key, $value);
		}
	}
	else
	{
		//If PG_Yelp_option has no value,
		//set every field name values to NULL.
	}
	
	// Get the contents of Yelp through Curl
	// Create a DOM object
	$html = new simple_html_dom();
	
	// Load HTML from a URL 
	$html->load_file('http://www.yelp.com/c/sf/restaurants');
	
	// Row count
	$row_count = 5;
	$smarty_row_count = $row_count + 1;
	$smarty->assign("row_count", $smarty_row_count);
	
	// Title
	for($x=1;$x<=$row_count;$x++)
	{
	  foreach($html->find("a[id=top_biz_name_".$x."]") as $element) 
		$title["title_".$x] = $element->innertext;
	}
	foreach($title as $key=>$value)
	{
	  $smarty->assign($key, $value);
	}
	
	// Categories
	$categories		= $db_admin->categories();
	$cat_count	= count($categories);
	$cat_counter	= 1;
	foreach($categories as $key=>$value)
	{
	  $smarty->assign("catrg_".$cat_counter, $key);
	  $smarty->assign($key, $value);
	  $cat_counter++;
	}
	$smarty->assign("catrg_count", $cat_count);
	
	
	$smarty->assign("PLUGIN_NAME", PLUGIN_NAME);
	$smarty->assign("PG_BASE_PATH", $sPgDir);
	$smarty->assign("server_base_url",SERVER_BASE_URL);
	$smarty->assign( 'sScriptCrossDomain' , CAFE24_CROSS_DOMAIN );
	$smarty->assign("getterPhp",$sPgDir."/model/getter.php");
	
	$smarty->display('index.tpl');
	
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	