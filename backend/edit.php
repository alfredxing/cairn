<!DOCTYPE html>
<?php
$page = $_POST["page"];
function gc($name) {
	return file_get_contents("../meta/pages/".strtolower(urldecode($name)).".txt");
}
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<html>
<head>
	<title>Backend - <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/core.min.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<header>
		<a href="./" title="Dashboard"><span id="logo"><?php echo $json['name']; ?></span></a>
		<nav>
			<ul>
				<li><a href="./#pages">Pages</a></li>
				<li><a href="./#new">New</a></li>
				<li><a href="./#meta">Settings</a></li>
			</ul>
		</nav>
	</header>
	<div id="frame">
		<section id="edit">
			<h1>Editing: <?php echo urldecode($page); ?></h1>
			<form id="compose" action="page.php" method="POST">
				<input type="hidden" name="titlebefore" value='<?php echo $page; ?>'/>
				<input type="text" placeholder="Name your page." name="title" id="title" value="<?php echo ucfirst(htmlentities(urldecode($page))); ?>">
				<textarea name="content" id="content" rows="10" placeholder="Whatever you want to say. HTML accepted."><?php echo gc($page); ?></textarea>
				<button type="submit" id="publish" class="button">Publish</button>
				<button name="delete" value="Delete" class="button delete" type="submit">Delete</button>
			</form>
		</section>
	</div>
</body>
</html>