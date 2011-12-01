<?php
  require_once("../configs/core_conf.php");
  require_once("base_model.php");
  $db_admin = new PG_Paypaldonate_db();
  
	// User ID
	$userID = $db_admin->getUserId();
	
  if(isset($_POST['paypal_acct']))
	{
		$paypal_acct 	= $_POST['paypal_acct'];
		$page_style		= $_POST['page_style'];
		$currency			= $_POST['currency'];
		$return_page	= $_POST['return_page'];
		$amount				= $_POST['amount'];
		$purpose			= $_POST['purpose'];
		$reference		= $_POST['reference'];
		$button_image	= $_POST['button_image'];
		$title				= $_POST['title'];
		$text					= $_POST['text'];
		
		// Check if there's already an existing record
		$tbl_option_empty = $db_admin->count_settings();
		$record_count = $tbl_option_empty[0]['settings_count'];
		if($record_count > 0)
		{
			// If there's already record, choose the update function
			$tbl_option_values = "paypal_acct = '".$paypal_acct."',
														page_style	= '".$page_style."',
														return_page	= '".$return_page."',
														amount			= '".$amount."',
														currency		= '".$currency."',
														purpose			= '".$purpose."',
														reference		= '".$reference."',
														button_image= '".$button_image."',
														title				= '".$title."',
														text				= '".$text."'";
			$db_admin->update_newoptions($tbl_option_values);
		}
		else
		{
			// If there's no record yet, choose the insert function
			$tbl_option_values = "(
														".$userID.",
														'".$paypal_acct."',
														'".$page_style."',
														'".$return_page."',
														".$amount.",
														'".$currency."',
														'".$purpose."',
														'".$reference."',
														'".$button_image."',
														'".$title."',
														'".$text."'
													)";
			$db_admin->insert_newoptions($tbl_option_values);
		}
	}
	
	
	