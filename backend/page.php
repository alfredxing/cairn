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
			<?php

			include("f5.php");

			$titlebefore = $_POST["titlebefore"];
			$title = $_POST["title"];
			$meta = json_decode(file_get_contents("../meta/meta.txt"), true);
			$content = $_POST["content"];
			$md = $_POST["markdown"];
			$delete = $_POST["delete"];
			$confirmed = $_POST["confirmed"];

			if ($delete && !$confirmed) {
				echo "<form action='page.php' method='POST'>
				<input type='hidden' name='title' value=\"" . $titlebefore . "\" />
				<input type='hidden' name='content' value=\"" . $content . "\" />
				<input type='hidden' name='delete' value=\"" . $delete . "\" />
				<input type='hidden' name='confirmed' value='TRUE' />
				<h1>Are you sure you want to delete&nbsp;'" . $title . "'?</h1>
				<button type='submit' class='button delete'>Yes, I won't regret it</button>
				&nbsp;&nbsp;
				<a href='./' class='button'>Nevermind</a></form>";
			} else if ($delete && $confirmed) {
				echo "<h1>You told us to delete this page:</h1><br><blockquote><h1>" . $title . ".</h1>
				<p>" . $content . "</p></blockquote>
				<h2>And we did.</h2><br>";
				unlink("../" . $title . ".html");
				unlink("../meta/pages/" . $title . ".txt");
				unlink("../meta/pages/" . $title . ".md");
			} else if ($title && $content) {
				if ($titlebefore && $title !== $titlebefore) {
					unlink("../" . $titlebefore . ".html");
					unlink("../meta/pages/" . $titlebefore . ".txt");
					unlink("../meta/pages/" . $titlebefore . ".md");
				}
				echo "<h1>All done! Here's a preview:</h1><br><blockquote><h1>" . $title . "</h1><p>" . update($title,$content,$md) . "</p></blockquote>";
			} else {
				echo "Request not complete.";
			}
			rall($delete);
			?>
			<p>
				<?php
				if (!$delete) {
					echo "<a href=\"../" . $title . "\" class='button'>Visit the page</a>&nbsp;&nbsp;";
				}
				if ($confirmed || !$delete) {
					echo "<a href=\"./\" class=\"button\">Back to the dash</a>";
				}
				?>
			</p>
		</section>
	</div>
</body>
</html>