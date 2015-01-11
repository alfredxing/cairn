<!DOCTYPE html>
<?php
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<html>
<head>
	<title>Backend &bull; <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Source+Code+Pro' rel='stylesheet' type='text/css'>
</head>
<body class="dash">
	<header>
		<a href="./" title="Dashboard" id="logo"><i class="icon logo"></i></a>
		<nav>
			<ul>
				<li><a href="./new.php" title="New page">New</a></li>
				<li><a href="./settings.php" title="Site settings">Settings</a></li>
				<li><a href="../" title="Visit site" target="_blank">Site</a></li>
			</ul>
		</nav>
	</header>
	<section class="title">
		<h1>Cairn currently has <?php echo count(glob("../meta/pages/*.json")); ?> <?php echo (count(glob("../meta/pages/*.md")) === 1) ? "page" : "pages" ?></h1>
	</section>
	<section class="content">
		<div id="pages">
			<?php $gedit=true; include('glob.php'); g(false,false); ?>
		</div>
	</section>
</body>
</html>
