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
	  protected $tbl_main 	= "PG_Yelp_main";
		
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
	  public function count_settings()
	  {
			$sSql = "SELECT COUNT(*) as settings_count FROM ".$this->tbl_option." WHERE pdm_idx = ".$this->getUserId();
			$values = $this->query($sSql);
			return $values;
	  }
		
	  // Get PG_Paypaldonate_option values
	  public function PG_Yelp_option_values()
	  {
			$sSql = "SELECT * FROM ".$this->tbl_option." WHERE pdm_idx = ".$this->getUserId();
			$values = $this->query($sSql, 'row');
			return $values;
	  }
	  //------- end
	
	  /*
	  | --------------------
	  | Edit/Insert values
	  | --------------------
	  */
	  // Insert option values
	  public function insert_newoptions($tbl_option_values)
	  {
			$sSql = "INSERT INTO ".$this->tbl_option."
				  (pdm_idx,category,show_rows,template)
				  VALUES
				  ".$tbl_option_values;
			$values = $this->query($sSql);
	  }
		
	  // Update option values
	  public function update_newoptions($tbl_option_values)
	  {
			$sSql = "UPDATE ".$this->tbl_option." SET ".$tbl_option_values." WHERE pdm_idx = ".$this->getUserId();
			$values = $this->query($sSql);
	  }
	  
	  // Curl
	  public function curl_download($Url){
			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_URL, $Url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			$result = curl_exec ($curl);
			curl_close ($curl);
			
			return $result;
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
	