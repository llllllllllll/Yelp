<?php
  require_once("configs/core_conf.php");
  require_once("model/base_model.php");
  
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
	$result = $db_admin->curl_download("http://www.yelp.com/c/sf/restaurants");
	
    if(preg_match_all("/<ol\sclass=\"hottest\snumeric([^\"]*)\">(.*)<\/ol>/siU", $result, $links))
    {
        foreach($links[0] as $link)
        {
            echo $link."<br />";    
        }
    }
	
	// First Item(picture)
	if(preg_match_all("/<div\sclass=\"bizPhotoBox\sms([^\"]*)\">(.*)<\/div>/siU", $result, $links))
    {
      echo $links[0][0];
    }
	
	$smarty->assign("PLUGIN_NAME", PLUGIN_NAME);
	$smarty->assign("PG_BASE_PATH", $sPgDir);
	$smarty->assign("server_base_url",SERVER_BASE_URL);
	$smarty->assign( 'sScriptCrossDomain' , CAFE24_CROSS_DOMAIN );
	$smarty->assign("getterPhp",$sPgDir."/model/getter.php");
	
	$smarty->display('index.tpl');
	
  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	