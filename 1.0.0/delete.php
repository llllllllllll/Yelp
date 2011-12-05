<?php
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DocROOT . '/lib/conf.sys.php');
  
	class uninstall
	{
		protected $tbl_option = "PG_Yelp_option";
		protected $tbl_api_key = "PG_Yelp_api_key";
    
		public function __construct()
		{
			$this->utilDb =  new utilDb();
	
			$this->PG_Yelp_option_uninstall();
			$this->PG_Yelp_api_key_uninstall();
		}
		
		/*
		| -----------------------------------------------------------------
		| Uninstall PG_Yelp_option
		| -----------------------------------------------------------------
		*/
		function PG_Yelp_option_uninstall()
		{
			$sql = "DROP TABLE ".$this->tbl_option;
			$this->utilDb->query($sql);
		}
		
		/*
		| -----------------------------------------------------------------
		| Uninstall PG_Yelp_api_key
		| -----------------------------------------------------------------
		*/
		function PG_Yelp_api_key_uninstall()
		{
			$sql = "DROP TABLE ".$this->tbl_api_key;
			$this->utilDb->query($sql);
		}
	}
	$uninstall = new uninstall();
