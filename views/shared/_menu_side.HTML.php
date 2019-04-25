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
?>

<!-- Sidebar  -->
<nav id="sidebar">
	<div class="sidebar-header">
		<h3>Menu</h3>
	</div>

	<ul class="list-unstyled components">
		<li>
			<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
			<ul class="collapse list-unstyled" id="homeSubmenu">
				<li>
					<a href="?action=home.home">Home</a>
				</li>
				<li>
					<a href="?action=elements.elements">Elements</a>
				</li>
				<li>
					<a href="?action=generic.home">Generic</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">About</a>
			<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
			<ul class="collapse list-unstyled" id="pageSubmenu">
				<li>
					<a href="#">Page 1</a>
				</li>
				<li>
					<a href="#">Page 2</a>
				</li>
				<li>
					<a href="#">Page 3</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Portfolio</a>
		</li>
		<li>
			<a href="#">Contact</a>
		</li>
	</ul>
</nav>