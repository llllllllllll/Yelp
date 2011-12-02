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
  if(isset($_POST['url']))
  {
	// Load HTML from a URL 
	$html->load_file($_POST['url']);
	
	// Row count
	$row_count = 5;
	
	// Title
	for($x=1;$x<=$row_count;$x++)
	{
	  foreach($html->find("a[id=top_biz_name_".$x."]") as $element) 
		$title[] = $element->innertext;
	}
	
	// Return data as json
	echo json_encode($title);
  }