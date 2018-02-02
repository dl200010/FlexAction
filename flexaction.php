<?php
	//include the functions right away to get the default value, in the chance that there is no action listed
	include 'flx_functions.php';
	if(isset($_GET['action']))
	{
		$flexaction['action'] = $_GET['action'];
	}
	else {
		//get link to redirect to with the url parameter of 'action'
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";
		//redirect back to self with
		header("Location: " . $actual_link . "?action=" . $flexaction['flx_action_empty']);
		die();
	}
	echo "<pre>";
	$flexaction['layout'] = "";
	var_dump($flexaction);
	echo "</pre>";
	echo "<br><br><br>";
	echo "<pre>";
	var_dump($_SERVER);
	echo "</pre>";
?>