<?php
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DocROOT . '/lib/conf.sys.php');
  
	class uninstall
	{
		protected $tbl_option = "PG_Yelp_option";
    
		public function __construct()
		{
			$this->utilDb =  new utilDb();
	
			$this->PG_Paypaldonate_option_uninstall();
		}
		
		/*
		| -----------------------------------------------------------------
		| Uninstall PG_Paypaldonate_option
		| -----------------------------------------------------------------
		*/
		function PG_Paypaldonate_option_uninstall()
		{
			$sql = "DROP TABLE ".$this->tbl_option;
			$this->utilDb->query($sql);
		}
	}
	$uninstall = new uninstall();
