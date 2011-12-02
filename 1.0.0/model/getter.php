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
  
  // Create a DOM object
  $html = new simple_html_dom();

  // Front
  //if(isset($_POST['url']))
  //{
	// Load HTML from a URL 
	$html->load_file("http://www.yelp.com/c/sf/food");
	
	// Row count
	$row_count = 5;
	
	for($x=1;$x<=$row_count;$x++)
	{
	  // Title
	  foreach($html->find("a[id=top_biz_name_".$x."]") as $element) 
		$title[] = $element->innertext;
	}
	// Reviews
	foreach($html->find("div[id=best-of-yelp] div[class=rating-wrap] em") as $element) 
	  $review[] = $element->innertext;
	  
	// Businness description
	foreach($html->find("div[id=best-of-yelp] ol[id=business-description]") as $element) 
	  $bus_desc[] = $element->innertext;
	  
    // Picture of first item
	//foreach($html->find("div[id=best-of-yelp] div[class=bizPhotoBox] img") as $element) 
	//  $picture[] = $element->src;
	  
	// Combine all data in one array for JSON
	$data_arr = array("titles"=>$title, "reviews"=>$review, "bus_desc"=>$bus_desc, "pictures"=>$picture);

	// Return data as json
	echo json_encode($data_arr);
	
  //}