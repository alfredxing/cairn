<?php
if (!isset($name)) {
	$name = $json['name'];
}
?>
<header>
	<a href="./" title="Dashboard"><span id="logo"><?php echo $name ?></span></a>
	<nav>
		<ul>
			<li><a href="./#pages">Pages</a></li>
			<li><a href="./#new">New</a></li>
			<li><a href="./#meta">Settings</a></li>
		</ul>
	</nav>
</header>