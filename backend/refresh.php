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
		<section id="edit">
			<?php include("f5.php"); rall(); ?>
			<h1>We've refreshed all your pages</h1>
			<p>Now they have the latest and greatest template.</p>
			<p>
				<a href="./" class="button">Back to the dash</a>
			</p>
		</section>
	</div>
</body>
</html>