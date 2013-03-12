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
			$delete = $_POST["delete"];
			$confirmed = $_POST["confirmed"];

			/*$content = str_replace(array("\r\n","\r"), "\n", $content) . "\n";
			$content = preg_replace('/(\n){2,}/',"</p><p>",$content);
			$content = preg_replace('#\n(\w)#', '<br>\1', $content);

			$before = file_get_contents("../theme/before.html") . "\n<p>";
			$after = "</p>\n" . file_get_contents("../theme/after.html");
			$render = $before . $content . $after;

			$render = str_replace("[site]",$meta['name'],$render);
			$render = str_replace("[title]",$title,$render);
			$render = str_replace("[keywords]",$meta["keywords"],$render); */

			if ($delete && !$confirmed) {
				echo "<form action='page.php' method='POST'>
				<input type='hidden' name='title' value='" . $titlebefore . "' />
				<input type='hidden' name='content' value='" . urlencode($content) . "' />
				<input type='hidden' name='delete' value='" . $delete . "' />
				<input type='hidden' name='confirmed' value='TRUE' />
				<h1>Are you sure you want to delete&nbsp;'" . urldecode($title) . "'?</h1>
				<button type='submit' class='button delete'>Yes, I won't regret it</button>
				&nbsp;&nbsp;
				<a href='./' class='button'>Nevermind</a></form>";
			} else if ($delete && $confirmed) {
				echo "<h1>You told us to delete this page:</h1><br><blockquote><h2>" . urldecode(urldecode($title)) . ".</h2>
				<p>" . urldecode($content) . "</p></blockquote>
				<h2>And we did.</h2><br>";
				unlink("../" . urldecode(urldecode(strtolower($title))) . ".html");
				unlink("../meta/pages/" . urldecode(urldecode(strtolower($title))) . ".txt");
			} else if ($title && $content) {
				if ($titlebefore && $title !== $titlebefore) {
					unlink("../" . urldecode(strtolower($titlebefore)) . ".html");
					unlink("../meta/pages/" . urldecode(strtolower($titlebefore)) . ".txt");
				}
				update($title,$content,("../meta/pages/" . strtolower($title) . ".txt"));
				echo "<h1>All done! Here's a preview:</h1><br><blockquote><h1>" . $title . "</h1><p>" . $content . "</p></blockquote>";
				/* file_put_contents(("../" . strtolower($title) . ".html"), $render);
				file_put_contents(("../meta/pages/" . strtolower($title) . ".txt"), $_POST["content"]); */
			} else {
				echo "Request not complete.";
			}

			rall();

			?>
			<p>
				<?php 
				if (!$delete) {
					echo "<a href='../" . urlencode(strtolower($title)) . "' class='button'>Visit the page</a>&nbsp;&nbsp;";
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