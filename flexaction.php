<?php
	//get the path that this file is in because everything else will deal off of this path.
	$flexaction['flx_root_path'] = dirname(__FILE__);
	if(file_exists('flx_config.php')) {
		//include variables that are needed for flexaction
		include 'flx_config.php';
	}
	else {
		throw new Exception("Error Processing Request, flx_config.php not found.");
	}

	//check to see if the action exists and that it contains a period
	if(isset($_GET['action']) && strpos($_GET['action'],".") !== false)
	{
		//grab the function and action
		$flexaction['function'] = preg_replace("/^(.*?)\.(.*?)$/","$1",$_GET['action']);
		$flexaction['action'] = preg_replace("/^(.*?)\.(.*?)$/","$2",$_GET['action']);
	}
	else {
		//get link to redirect to with the url parameter of 'action' and redirect back to self with
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";
		header("Location: " . $actual_link . "?action=" . $flexaction['flx_action_empty']);
		die();
	}

	//include root functions throw error when it does not exist
	if(file_exists('flx_functions.php')) {
		include 'flx_functions.php';
	}
	else {
		throw new Exception("Error Processing Request, flx_functions.php not found.");
	}

	//include the root settings if it exists
	if(file_exists('flx_settings.php')) {
		include 'flx_settings.php';
	}

	//throw exception if the function being requested does not exist
	if	(
			(!isset($flexaction['functions'][$flexaction['function']])) ||
			(
				$flexaction['functions'][$flexaction['function']] !== '/' &&
				(!file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]))
			)
		) {
		throw new Exception("Error Processing Request, Function not found.");
	}

	//get the actions variable
	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]."flx_actions.php")) {
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]."flx_actions.php";
	}
	else {
		throw new Exception("Error Processing Request, flx_actions.php not found.");
	}

	//throw exception if the function being requested does not exist
	if	(
			(!isset($flexaction['actions'][$flexaction['action']])) ||
			(!file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']]))
		) {
		throw new Exception("Error Processing Request, Action not found.");
	}

	//include root functions throw error when it does not exist
	if(file_exists('flx_menu.php')) {
		ob_start();
		include 'flx_menu.php';
		$flexaction['menu'] = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, flx_menu.php not found.");
	}

	//include the function settings if it exists
	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].'flx_settings.php')) {
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].'flx_settings.php';
	}

	//go out and get content and save it to a variable
	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']])) {
		ob_start();
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']];
		$flexaction['layout'] = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, Action file not found.");
	}

	//go out and get content and save it to a variable
	if(file_exists('flx_layout.php')) {
		ob_start();
		include 'flx_layout.php';
		$totalpage = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, flx_layout.php not found.");
	}

	//display already built page
	echo $totalpage;
?>