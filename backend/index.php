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
		<section id="pages">
			<h1>Your pages:</h1>
			<?php $gedit=true; include('glob.php'); ?>
		</section>
		<section id="new">
			<h1>Want to create a new one?</h1>
			<form id="compose" action="page.php" method="POST">
				<input type="text" placeholder="Name your page. This also determines the URL (/[name])" name="title" id="title">
				<textarea name="content" id="content" rows="10" placeholder="Whatever you want to say. HTML accepted."></textarea>
				<button type="submit" id="publish" class="button">Publish!</button>
			</form>
		</section>
		<section id="meta">
			<h1>Just some meta.</h1>
			<form action="meta.php" method="POST">
				<input type="text" name="name" placeholder="Name of site" value="<?php echo $json['name']; ?>">
				<input type="text" name="keywords" placeholder="Keywords, separated, by, commas" value="<?php echo $json['keywords'];?>">
				<textarea name="description" placeholder="Description"><?php echo $json['description']; ?></textarea>
				<button type="submit" class="button">Save your stuff.</button>
			</form>
		</section>
		<div id="clear"></div>
	</div>
</body>
</html>