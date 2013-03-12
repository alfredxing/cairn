<!DOCTYPE html>
<?php
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<html>
<head>
	<title>Backend - <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/core.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php include "./sidebar.php" ?>
	<div id="frame">
		<section id="new">
			<form id="compose" action="page.php" method="POST">
				<input type="text" placeholder="title" name="title" id="title" />
				<textarea name="content" id="content" cols="30" rows="10" placeholder="Whatever you want to say."></textarea>
				<button type="submit" value="Publish!" />
			</form>
		</section>
	</div>
</body>