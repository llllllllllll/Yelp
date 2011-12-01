<?php
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	require_once($DocROOT . '/lib/conf.sys.php');
	
  class Fetch
  {
    protected $tbl_option = "PG_Paypaldonate_option";
		protected $tbl_currency = "PG_Paypaldonate_currency";
		
		public function __construct()
		{
			$this->utilDb =  new utilDb();
			
			$this->PG_Googlemapdirections_admin_uninstall();
			$this->PG_Googlemapdirections_option_uninstall();
			$this->PG_Googlemapdirections_admin_install();
			$this->PG_Googlemapdirections_option_install();
		}
		
		/*
		| -----------------------------------------------------------------
		| Uninstall PG_Paypaldonate_option and PG_Paypaldonate_currency
		| -----------------------------------------------------------------
		*/
    function PG_Paypaldonate_option_uninstall()
    {
      $sql = "DROP TABLE ".$this->tbl_option;
			$this->utilDb->query($sql);
    }

		function PG_Paypaldonate_currency_uninstall()
    {
      $sql = "DROP TABLE ".$this->tbl_currency;
      $this->utilDb->query($sql);
    }
		//------- end
		
		
    /*
		| -----------------------------------------------------------------
		| Install PG_Paypaldonate_option and PG_Paypaldonate_currency
		| -----------------------------------------------------------------
		*/
    function PG_Paypaldonate_option_install()
    {
      $sql = "CREATE TABLE IF NOT EXISTS ".$this->tbl_option." (
              poid int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
							pdm_idx int NOT NULL,
							paypal_acct varchar(50) NOT NULL,
							page_style varchar(50),
							return_page varchar(70),
							amount varchar(10),
							currency varchar(50) NOT NULL,
							purpose varchar(50),
							reference varchar(50),
							button_image varchar(100),
							title varchar(50),
							text varchar(100)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
      ";
      $this->utilDb->query($sql);
    }
		
    function PG_Paypaldonate_currency_install()
    {
      $sql = "CREATE TABLE ".$this->tbl_currency." (
							cid int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
							currency varchar(50) NOT NULL,
							short varchar(50) NOT NULL
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8";
      $exec = $this->utilDb->query($sql);
			$this->PG_Paypaldonate_currency_dump();
    }
		
		/*
		| -----------------------------------------------------------------
		| Dump PG_Paypaldonate_currency
		| -----------------------------------------------------------------
		*/
    function PG_Paypaldonate_currency_dump()
    {
      $sql = "INSERT INTO ".$this->tbl_currency."(currency, short)
							VALUES
							('Australian Dollars (A $)','AUD'),
							('Canadian Dollars (C $)','CAD'),
							('Euros (€)', 'EUR'),
							('Pounds Sterling (£)', 'GBP'),
							('Yen (¥)', 'JPY'),
							('U.S. Dollars ($)', 'USD'),
							('New Zealand Dollar ($)', 'NZD'),	
							('Swiss Franc', 'CHF'),		
							('Hong Kong Dollar ($)', 'HKD'),			
							('Singapore Dollar ($)', 'SGD'),			
							('Swedish Krona', 'SEK'),				
							('Danish Krone', 'DKK'),				
							('Polish Zloty', 'PLN'),					
							('Norwegian Krone', 'NOK'),					
							('Hungarian Forint', 'HUF'),					
							('Czech Koruna', 'CZK'),		
							('Israeli Shekel', 'ILS'),	
							('Mexican Peso', 'MXN'),		
							('Brazilian Real', 'BRL'),		
							('Taiwan New Dollar', 'TWD'),		
							('Philippine Peso', 'PHP'),		
							('Turkish Lira', 'TRY'),		
							('Thai Baht', 'THB')";
      $exec = $this->utilDb->query($sql);
    }
		//------- end
		
	}
	$fetch = new Fetch();
	
	
	
	
	
	