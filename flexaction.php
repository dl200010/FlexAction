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


	echo "<pre>";
	var_dump($flexaction);
	var_dump($flexaction['flx_root_path'].$flexaction['functions'][$flexaction['function']]);
	echo "</pre>";

/* buffering into variable
<?php ob_start(); ?>

<html>
   <head>...</head>
   <body>...<?php echo $another_variable ?></body>
</html>

<?php $variable = ob_get_clean(); ?>
*/
?>