<?php
	//$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	//require_once($DocROOT . '/lib/conf.sys.php');
  /**
	 * Initialize database helper:
	 *  - Extends Simplex custom database helper (utilDb)
	 */
	
  class PG_Paypaldonate_db  extends utilDb
  {
		protected $tbl_option = "PG_Paypaldonate_option";
		protected $tbl_currency = "PG_Paypaldonate_currency";
		protected $tbl_main = "PG_Paypaldonate_main";
		
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
    public function PG_Paypaldonate_option_values()
    {
      $sSql = "SELECT * FROM ".$this->tbl_option." WHERE pdm_idx = ".$this->getUserId();
      $values = $this->query($sSql, 'row');
      return $values;
    }
		
		// Get PG_Paypaldonate_currency count values
    public function count_currency()
    {
			$sSql = "SELECT COUNT(*) as currency_count FROM ".$this->tbl_currency;
      $values = $this->query($sSql);
      return $values;
    }
		
		// Get PG_Paypaldonate_currency values
    public function PG_Paypaldonate_currency_values()
    {
      $sSql = "SELECT * FROM ".$this->tbl_currency;
      $values = $this->query($sSql);
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
							(pdm_idx,paypal_acct,page_style,return_page,amount,currency,purpose,reference,button_image,title,text)
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
		
		/*
		| --------------------
		| Helpers
		| --------------------
		*/
		
		
  }
	
	
	
	
	