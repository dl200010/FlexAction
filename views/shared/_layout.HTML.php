<!DOCTYPE html>
<!--
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
-->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>FlexAction with Sidebar Menu Light</title>

	<link rel="stylesheet" href="/assets/vendor/bootstrap/4.2.1/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/vendor/fontawesome/5.6.3/css/all.min.css">
</head>

<body>

	<div class="wrapper">

		<?php include '_menu_side.HTML.php'; ?>

		<!-- Page Content  -->
		<div id="content">
			<?php
				include '_menu_top.HTML.php';
				echo $flexaction['page_display'];
			?>
		</div>
	</div>

	<script src="/assets/vendor/jquery/3.3.1/js/jquery.min.js" ></script>
	<script src="/assets/vendor/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
				$(this).toggleClass('active');
			});
		});
	</script>
</body>

</html>