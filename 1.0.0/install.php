<?php
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DocROOT . '/lib/conf.sys.php');
	
  class install
  {
		protected $tbl_option = "PG_Yelp_option";
		
		public function __construct()
		{
			$this->utilDb =  new utilDb();
			
			$this->PG_Paypaldonate_option_install();
		}
    
	/*
	| -----------------------------------------------------------------
	| Install PG_Yelp_option
	| -----------------------------------------------------------------
	*/
    function PG_Paypaldonate_option_install()
    {
      $sql = "CREATE TABLE IF NOT EXISTS ".$this->tbl_option." (
			yid int(10) unsigned NOT NULL auto_increment PRIMARY KEY,
			pdm_idx int(11) NOT NULL,
			category varchar(50) NOT NULL,
			show_rows int(10) unsigned NOT NULL,
			template varchar(50) default NULL
		  ) ENGINE=InnoDB DEFAULT CHARSET=utf8
      ";
      $this->utilDb->query($sql);
    }
  }
  $install = new install();

