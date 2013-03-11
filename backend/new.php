<!DOCTYPE html>
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
				<li><a href="#pages">Pages</a></li>
				<li><a href="#new">New</a></li>
				<li><a href="#meta">Settings</a></li>
			</ul>
		</nav>
	</header>
	<section id="new">
		<form id="compose" action="page.php" method="GET">
			<input type="text" placeholder="title" name="title" id="title">
			<textarea name="content" id="content" cols="30" rows="10" placeholder="Whatever you want to say."></textarea>
			<button type="submit" value="Publish!">
		</form>
	</section>
</body>