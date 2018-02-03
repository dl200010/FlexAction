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

	if(isset($_GET['action']) && strpos($_GET['action'],".") !== false)
	{
		//grab the function and action
		$flexaction['function'] = preg_replace("/^(.*?)\.(.*?)$/","$1",$_GET['action']);
		$flexaction['action'] = preg_replace("/^(.*?)\.(.*?)$/","$2",$_GET['action']);
	}
	else {
		//get link to redirect to with the url parameter of 'action'
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";
		//redirect back to self with
		header("Location: " . $actual_link . "?action=" . $flexaction['flx_action_empty']);
		die();
	}

	if(file_exists('flx_functions.php')) {
		//include root functions throw error when it does not exist
		include 'flx_functions.php';
	}
	else {
		throw new Exception("Error Processing Request, flx_functions.php not found.");
	}

	if(file_exists('flx_settings.php')) {
		//include the root settings if it exists
		include 'flx_settings.php';
	}

	if	(
			(!isset($flexaction['functions'][$flexaction['function']])) ||
			(
				$flexaction['functions'][$flexaction['function']] !== '/' &&
				(!file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]))
			)
		) {
		//throw exception if the function being requested does not exist
		throw new Exception("Error Processing Request, Function not found.");
	}

	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]."flx_actions.php")) {
		//get the actions variable
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]."flx_actions.php";
	}
	else {
		throw new Exception("Error Processing Request, flx_actions.php not found.");
	}

	if	(
			(!isset($flexaction['actions'][$flexaction['action']])) ||
			(!file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']]))
		) {
		//throw exception if the function being requested does not exist
		throw new Exception("Error Processing Request, Action not found.");
	}

	if(file_exists('flx_menu.php')) {
		//include root functions throw error when it does not exist
		ob_start();
		include 'flx_menu.php';
		$flexaction['menu'] = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, flx_menu.php not found.");
	}

	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].'flx_settings.php')) {
		//include the function settings if it exists
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].'flx_settings.php';
	}

	if(file_exists($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']])) {
		//go out and get content and save it to a variable
		ob_start();
		include $flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']].$flexaction['actions'][$flexaction['action']];
		$flexaction['layout'] = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, Action file not found.");
	}

	if(file_exists('flx_layout.php')) {
		//go out and get content and save it to a variable
		ob_start();
		include 'flx_layout.php';
		$totalpage = ob_get_clean();
	}
	else {
		throw new Exception("Error Processing Request, flx_layout.php not found.");
	}

	echo $totalpage;
?>