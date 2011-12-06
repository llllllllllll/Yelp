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
	  
	  public function default_categories()
	  {
			$init_categories 	= $this->categories();
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
	  public function insert_newoptions()
	  {
			$init_categories 	= $this->categories();
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
	  public function categories()
	  {
			$cat_array = array(
				"Restaurants"					=> "http://www.yelp.com/c/sf/restaurants",
				"Food"							=> "http://www.yelp.com/c/sf/food",
				"Nightlife"						=> "http://www.yelp.com/c/sf/nightlife",
				"Shopping"						=> "http://www.yelp.com/c/sf/shopping",
				"Beauty and Spas"				=> "http://www.yelp.com/c/sf/beautysvc",
				"Arts & Entertainment"			=> "http://www.yelp.com/c/sf/arts",
				"Event Planning & Services"		=> "http://www.yelp.com/c/sf/eventservices",
				"Active Life"					=> "http://www.yelp.com/c/sf/active",
				"Health and Medical"			=> "http://www.yelp.com/c/sf/health",
				"Hotels & Travel"				=> "http://www.yelp.com/c/sf/hotelstravel",
				"Local Services"				=> "http://www.yelp.com/c/sf/localservices",
				"Home Services"					=> "http://www.yelp.com/c/sf/homeservices",
				"Automotive"					=> "http://www.yelp.com/c/sf/auto",
				"Local Flavor"					=> "http://www.yelp.com/c/sf/localflavor",
				"Pets"							=> "http://www.yelp.com/c/sf/pets",
				"Public Services & Education"	=> "http://www.yelp.com/c/sf/publicservicesgovt",
				"Professional Services"			=> "http://www.yelp.com/c/sf/professional",
				"Real Estate"					=> "http://www.yelp.com/c/sf/realestate",
				"Mass Media"					=> "http://www.yelp.com/c/sf/massmedia",
				"Financial Services"			=> "http://www.yelp.com/c/sf/financialservices",
				"Religious Organizations"		=> "http://www.yelp.com/c/sf/religiousorgs"
			);
			return $cat_array;
	  }
	  
  }
	