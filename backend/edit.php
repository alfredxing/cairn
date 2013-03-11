<!DOCTYPE html>
<?php
$page = $_GET["page"];
function gc($name) {
	return file_get_contents("../meta/pages/".strtolower($name).".txt");
}
?>
<html>
<head>
	<title>Dashboard: The Backend - Cairn</title>
	<link rel="stylesheet" href="css/core.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<header>
		<a href="./" title="Dashboard"><span id="logo">CAIRN</span></a>
		<nav>
			<ul>
				<li><a href="./#pages">Pages</a></li>
				<li><a href="./#new">New</a></li>
				<li><a href="./#meta">Settings</a></li>
			</ul>
		</nav>
	</header>
	<section id="edit">
		<h1>Editing: <?php echo $page; ?></h1>
		<form id="compose" action="page.php" method="GET">
			<input type="text" placeholder="Name your page." name="title" id="title" value='<?php echo ucfirst($page); ?>'>
			<textarea name="content" id="content" rows="10" placeholder="Whatever you want to say. HTML accepted."><?php echo gc($page); ?></textarea>
			<button type="submit" id="publish" class="button">Publish!</button>
		</form>
	</section>
</body>
</html>