<?php
	//$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	//require_once($DocROOT . '/lib/conf.sys.php');
	  /**
	  * Initialize database helper:
	  *  - Extends Simplex custom database helper (utilDb)
	  */
	
  class PG_Yelp_db  extends utilDb
  {
	  protected $tbl_option 	= "PG_Yelp_option";
	  protected $tbl_main 		= "PG_Yelp_main";
	  protected $tbl_api_key 	= "PG_Yelp_api_key";
		
	  /*
	  | --------------------
	  | Plugin user ID
	  | --------------------
	  */
	  public function getUserId()
	  {
			$sSql = "SELECT pm_idx FROM ".$this->tbl_main." WHERE pm_userid = '".PLUGIN_USER_ID."'";      
			$values = $this->query($sSql, 'row');
			return $values['pm_idx'];
	  }
		
	  /*
	  | --------------------
	  | Fetch default values
	  | --------------------
	  */
	  // PG_Paypaldonate_option count values
	  public function count_settings($table)
	  {
			$sSql = "SELECT COUNT(*) as settings_count FROM ".$table." WHERE pdm_idx = ".$this->getUserId();
			$values = $this->query($sSql);
			return $values;
	  }
		
	  // Get PG_Paypaldonate_option values
	  public function PG_Yelp_values($table)
	  {
			$sSql = "SELECT * FROM ".$table." WHERE pdm_idx = ".$this->getUserId();
			$values = $this->query($sSql, 'row');
			return $values;
	  }
	  //------- end
	  
	  public function default_categories($loc)
	  {
			$init_categories 	= $this->categories($loc);
			$default_row_count	= count($init_categories);
			$counter 			= 1;
			$categories			= "";
			foreach($init_categories as $key=>$values)
			{
				  if($counter < $default_row_count)
						$categories .= $key.",";
				  else
						$categories .= $key;
				  $counter++;
			}
			return $categories;
	  }
	
	  /*
	  | --------------------
	  | Edit/Insert values
	  | --------------------
	  */
	  // Insert API Keys
	  public function insert_api_keys($api_key)
	  {
			$sSql = "INSERT INTO ".$this->tbl_api_key."
				  (pdm_idx,consumer_key,consumer_secret,token,token_secret)
				  VALUES
				  (
				  ".$this->getUserId().",
				  '".$api_key["consumer_key"]."',
				  '".$api_key["consumer_secret"]."',
				  '".$api_key["token"]."',
				  '".$api_key["token_secret"]."'
				  )";
			$values = $this->query($sSql);
			
			// Automatically insert default values for options
			$this->insert_newoptions();
	  }
	  
	  // Insert option values
	  public function insert_newoptions($loc)
	  {
			$init_categories 	= $this->categories($loc);
			$default_row_count	= count($init_categories);
			$default_categories	= $this->default_categories();
			
			$sSql = "INSERT INTO ".$this->tbl_option."
				  (pdm_idx,default_category,category,total_category,show_rows,template)
				  VALUES
				  (".$this->getUserId().",'general','".$default_categories."',".$default_row_count.",5,'blue')";
				  
			$values = $this->query($sSql);
	  }
	  
	  // Update API Keys
	  public function update_api_keys($api_key)
	  {
			$sSql = "UPDATE ".$this->tbl_api_key." SET
				  consumer_key 		= '".$api_key["consumer_key"]."',
				  consumer_secret	= '".$api_key["consumer_secret"]."',
				  token				= '".$api_key["token"]."',
				  token_secret		= '".$api_key["token_secret"]."'
				  WHERE pdm_idx 	= ".$this->getUserId();
			$values = $this->query($sSql);
	  }
	  
	  // Update other setting values
	  public function update_options($values)
	  {
			$sSql = "UPDATE ".$this->tbl_option." SET
				  default_category 		= '".$values["default_category"]."',
				  category				= '".$values["category"]."',
				  show_rows				= '".$values["show_rows"]."',
				  template				= '".$values["template"]."'
				  WHERE pdm_idx 		= ".$this->getUserId();
			$values = $this->query($sSql);
	  }
	  
	  // Categories
	  public function categories($loc)
	  {
			$location 	= $loc;
			$cat_array 	= array(
				"Restaurants"					=> "http://api.yelp.com/v2/search?category_filter=restaurants&location=".$location,
				"Food"							=> "http://api.yelp.com/v2/search?category_filter=food&location=".$location,
				"Nightlife"						=> "http://api.yelp.com/v2/search?category_filter=nightlife&location=".$location,
				"Shopping"						=> "http://api.yelp.com/v2/search?category_filter=shopping&location=".$location,
				"Beauty and Spas"				=> "http://api.yelp.com/v2/search?category_filter=beautysvc&location=".$location,
				"Arts and Entertainment"		=> "http://api.yelp.com/v2/search?category_filter=arts&location=".$location,
				"Event Planning and Services"	=> "http://api.yelp.com/v2/search?category_filter=eventservices&location=".$location,
				"Active Life"					=> "http://api.yelp.com/v2/search?category_filter=active&location=".$location,
				"Health and Medical"			=> "http://api.yelp.com/v2/search?category_filter=health&location=".$location,
				"Hotels and Travel"				=> "http://api.yelp.com/v2/search?category_filter=hotelstravel&location=".$location,
				"Local Services"				=> "http://api.yelp.com/v2/search?category_filter=localservices&location=".$location,
				"Home Services"					=> "http://api.yelp.com/v2/search?category_filter=homeservices&location=".$location,
				"Automotive"					=> "http://api.yelp.com/v2/search?category_filter=auto&location=".$location,
				"Local Flavor"					=> "http://api.yelp.com/v2/search?category_filter=localflavor&location=".$location,
				"Pets"							=> "http://api.yelp.com/v2/search?category_filter=pets&location=".$location,
				"Public Services and Education"	=> "http://api.yelp.com/v2/search?category_filter=publicservicesgovt&location=".$location,
				"Professional Services"			=> "http://api.yelp.com/v2/search?category_filter=professional&location=".$location,
				"Real Estate"					=> "http://api.yelp.com/v2/search?category_filter=realestate&location=".$location,
				"Mass Media"					=> "http://api.yelp.com/v2/search?category_filter=massmedia&location=".$location,
				"Financial Services"			=> "http://api.yelp.com/v2/search?category_filter=financialservices&location=".$location,
				"Religious Organizations"		=> "http://api.yelp.com/v2/search?category_filter=religiousorgs&location=".$location
			);
			return $cat_array;
	  }
	  
  }
	