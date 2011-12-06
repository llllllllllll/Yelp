<?php
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DocROOT . '/lib/conf.sys.php');
	
  class Fetch
  {
		protected $tbl_option = "PG_Yelp_option";
		protected $tbl_api_key = "PG_Yelp_api_key";
		
		public function __construct()
		{
			$this->utilDb =  new utilDb();
			
			$this->PG_Yelp_option_uninstall();
			$this->PG_Yelp_option_install();
			$this->PG_Yelp_option_install();
			$this->PG_Yelp_api_key_install();
		}
		
		/*
		| -----------------------------------------------------------------
		| Uninstall PG_Yelp_option and PG_Yelp_api_key
		| -----------------------------------------------------------------
		*/
		function PG_Yelp_option_uninstall()
		{
		  $sql = "DROP TABLE ".$this->tbl_option;
				$this->utilDb->query($sql);
		}
	
		function PG_Yelp_api_key_uninstall()
		{
		  $sql = "DROP TABLE ".$this->tbl_api_key;
		  $this->utilDb->query($sql);
		}
		//------- end
		
		
		
		/*
		| -----------------------------------------------------------------
		| Install PG_Yelp_option
		| -----------------------------------------------------------------
		*/
		function PG_Yelp_option_install()
		{
		  $sql = "CREATE TABLE IF NOT EXISTS ".$this->tbl_option." (
				yid 			int(10) unsigned NOT NULL auto_increment PRIMARY KEY,
				pdm_idx 		int(11) NOT NULL,
				default_category varchar(50) default NULL,
				category 		varchar(50) default NULL,
				show_rows 		int(10) unsigned NOT NULL,
				template 		varchar(50) default NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
		  ";
		  $this->utilDb->query($sql);
		}
		
		/*
		| -----------------------------------------------------------------
		| Install PG_Yelp_api_key
		| -----------------------------------------------------------------
		*/
		function PG_Yelp_api_key_install()
		{
		  $sql = "CREATE TABLE IF NOT EXISTS ".$this->tbl_api_key." (
					ykid 			int(10) unsigned NOT NULL auto_increment PRIMARY KEY,
					pdm_idx 		int(11) NOT NULL,
					consumer_key 	varchar(50) NOT NULL,
					consumer_secret varchar(50) NOT NULL,
					token 			varchar(50) NOT NULL,
					token_secret 	varchar(50) NOT NULL
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
		  ";
		  $this->utilDb->query($sql);
		}
		
	}
	$fetch = new Fetch();
	
	
	
	
	
	