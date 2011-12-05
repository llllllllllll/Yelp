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
	
	//$smarty->display('index.tpl');
	
  
	/*
	| Test API
	*/
	
	// Enter the path that the oauth library is in relation to the php file
require_once ('libs/OAuth.php');

// For example, request business with id 'the-waterboy-sacramento'
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento";
$unsigned_url = "http://api.yelp.com/v2/search?category_filter=active&location=San+Francisco";

// For examaple, search for 'tacos' in 'sf'
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";


// Set your keys here
$consumer_key = "uQbfJjWPd4VX1J1ayguJ_w";
$consumer_secret = "uIqxXXiotaKJsw2BLmt7oZIYJNQ";
$token = "-QxdkEGi9p38ENzsnwAUarLB-XeNzUa9";
$token_secret = "y9EZvZAo366T82Rf5HD1_y2Kkuo";

// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);

// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);

// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);

// Get the signed URL
$signed_url = $oauthrequest->to_url();

// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

// Handle Yelp response data
$response = json_decode($data);

// Custom functions
function img($url)
{
    $img = "<img src='".$url."' />";
    return $img;
}
function hyperlink($url,$text,$target="")
{
    $link = "<a href='".$url."' target='".$target."'>".$text."</a>";
    return $link;
}


// Print it for debugging
// Business total results
$bus_total = count($response->businesses);

for($x=0;$x<$bus_total;$x++)
{
    echo img($response->businesses[$x]->rating_img_url)." "; // Image
    echo $response->businesses[$x]->rating;
    echo "<br />";
    echo img($response->businesses[$x]->snippet_image_url)." "; // Image
    echo "<br />";
    echo "Review Count: ".$response->businesses[$x]->review_count;
    echo "<br />";
    echo "Name: ".$response->businesses[$x]->name;
    echo "<br />";
    echo "Url: ".hyperlink($response->businesses[$x]->url,"url","_blank");
    echo "<br />";
    if(isset($response->businesses[$x]->phone))
    {
        echo "Phone: ".$response->businesses[$x]->phone;
        echo "<br />";    
    }
    echo "Comment: ".$response->businesses[$x]->snippet_text;
    echo "<br />";
    echo "<br />";
}

echo "<pre>";
print_r($response);
echo "</pre>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	