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
			<ul><?php $gedit=true; include('glob.php'); g(); ?></ul>
		</section>
		<section id="new">
			<h1>Want to create a new one?</h1>
			<form id="compose" action="page.php" method="POST">
				<input type="text" placeholder="Name your page. This also determines the URL (/[name])" name="title" id="title">
				<textarea name="markdown" id="content" rows="10" placeholder="Whatever you want to say. Markdown and HTML are both okay."></textarea>
				<textarea name="content" id="html" style="display:none;"></textarea>
				<p><strong>Preview:</strong></p>
				<blockquote name="markdown" id="preview" style="width:80%;padding:12px;overflow:hidden"></blockquote>
				<br>
				<button type="submit" id="publish" class="button">Publish</button>
			</form>
		</section>
		<section id="meta">
			<h1>Just some meta.</h1>
			<form action="meta.php" method="POST">
				<input type="text" name="name" placeholder="Name of site" value="<?php echo $json['name']; ?>">
				<input type="text" name="keywords" placeholder="Keywords, separated, by, commas" value="<?php echo $json['keywords'];?>">
				<button type="submit" class="button">Save your stuff.</button>
			</form>
			<br>
			<h1>Refresh your pages.</h1>
			<p>Refresh your pages to make sure they all have the latest template and navigation.</p>
			<a href="refresh.php" class="button">Refresh now</a>
		</section>
		<div id="clear"></div>
	</div>
	<script src="js/vendor/md.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	window.onload = function() {
		document.getElementById('content').oninput = function() {
			document.getElementById('preview').innerHTML = marked(this.value);
		};
		document.getElementById('compose').onsubmit = function() {
			var content = document.getElementById('content');
			document.getElementById("html").value = marked(content.value);
		};
		document.getElementById('content').oninput();
	};
	</script>
</body>
</html>