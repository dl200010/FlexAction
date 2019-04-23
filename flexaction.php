<?php
	/*
	 *  Copyright 2019 Christopher Dangerfield <DL200010@gmail.com>
	 *
	 *  Licensed under the Apache License, Version 2.0 (the "License");
	 *  you may not use this file except in compliance with the License.
	 *  You may obtain a copy of the License at
	 *
	 *      http://www.apache.org/licenses/LICENSE-2.0
	 *
	 *  Unless required by applicable law or agreed to in writing, software
	 *  distributed under the License is distributed on an "AS IS" BASIS,
	 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	 *  See the License for the specific language governing permissions and
	 *  limitations under the License.
	 */

	// get the path that this file is in because everything else will deal off of this path.
	$flexaction['root_path'] = dirname(__FILE__).'/';

	// setting the layout to the default. change this inside flx_global_vars or the controller
	$flexaction['layout_file'] = '/views/shared/layout.php';

	// setting for empty action default
	$flexaction['empty_action'] = "home.home";

	// now this is not required, but can be changed by adding this file to change the empty action
	if(file_exists($flexaction['root_path'].'/flx_config.php')) {
		// include variables that are needed for flexaction
		include $flexaction['root_path'].'/flx_config.php';
	}

	$flexaction['gotoEmptyAction'] = function () {
		// get link to redirect to with the url parameter of 'action' and redirect back to self with
		global $flexaction;
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		header("Location: " . $actual_link . "?action=" . $flexaction['empty_action']);
		die();
	};

	// check to see if the action exists and that it contains a period
	if(isset($_GET['action']) && strpos($_GET['action'],".") !== false)
	{
		// grab the controller and action
		$flexaction['controller'] = preg_replace("/^(.*?)\.(.*?)$/","$1",$_GET['action']);
		$flexaction['action'] = preg_replace("/^(.*?)\.(.*?)$/","$2",$_GET['action']);
	}
	else {
		$flexaction['gotoEmptyAction']();
	}

	// file used to setup session if it exists
	if(file_exists($flexaction['root_path']."/flx_session_start.php")) {
		include $flexaction['root_path']."/flx_session_start.php";
	}

	// include the flx_middleware, if it exists
	if(file_exists($flexaction['root_path'].'/flx_middleware.php')) {
		include $flexaction['root_path'].'/flx_middleware.php';
	}

	// grab the controller and error out if it does not exist
	if(file_exists($flexaction['root_path'].'/controllers/'.$flexaction['controller'].'.php')) {
		include $flexaction['root_path'].'/controllers/'.$flexaction['controller'].'.php';
	}
	else {
		echo "Error Processing Request, controller not found.";
		die();
	}

	$flexaction['page_display'] = "";
	// just don't include if view does not exist
	if	(file_exists($flexaction['root_path'].'/views/'.$flexaction['controller'].'/'.$flexaction['action_view'].'.php')) {
		// go out and get content and save it to a variable
		ob_start();
		include $flexaction['root_path'].'/views/'.$flexaction['controller'].'/'.$flexaction['action_view'].'.php';
		$flexaction['page_display'] = ob_get_clean();
	}

	// last file to run before displaying and finishing used to save variables before finishing
	if(file_exists($flexaction['root_path']."/flx_session_end.php")) {
		include $flexaction['root_path']."/flx_session_end.php";
	}

	// go out and get content and save it to a variable
	if(file_exists($flexaction['root_path'].$flexaction['layout_file'])) {
		ob_start();
		include $flexaction['root_path'].$flexaction['layout_file'];
		echo ob_get_clean();
	}
	else {
		echo "Error Processing Request, layout file not found.";
		die();
	}
?>