<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/lib/Common.php');
	$DocROOT = $_SERVER['DOCUMENT_ROOT'];
	//require_once($DocROOT . '/lib/conf.sys.php');
	
	/**
	 * Initialize Smarty
	 *  - Initialize Smarty library
	 *  	from simplex repository
	 */
	$smarty = new Smarty();
	
	/**
	 * My plugin root directory
	 */
	$sPgDir = SERVER_PLUGIN_URL . PLUGIN_NAME . DS. PLUGIN_VERSION;
  $smarty->assign('sPgDir',$sPgDir);
	
