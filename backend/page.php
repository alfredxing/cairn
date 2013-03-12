<!DOCTYPE html>
<?php
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
			<?php
			$title = $_GET["title"];
			$titlebefore = $_GET["titlebefore"];
			$meta = json_decode(file_get_contents("../meta/meta.txt"), true);
			$content = $_GET["content"];
			$delete = $_GET["delete"];
			$confirmed = $_GET["confirmed"];

			$content = str_replace(array("\r\n","\r"), "\n", $content) . "\n";
			$content = preg_replace('/(\n){2,}/',"</p><p>",$content);
			$content = preg_replace('#\n(\w)#', '<br>\1', $content);

			$before = file_get_contents("../theme/before.html") . "\n<p>";
			$after = "</p>\n" . file_get_contents("../theme/after.html");
			$render = $before . $content . $after;

<<<<<<< HEAD
			$render = str_replace("[site]",$meta['name'],$render);
			$render = str_replace("[title]",$title,$render);
			$render = str_replace("[keywords]",$meta["keywords"],$render);
=======
		$nav = include('glob.php');

		$render = str_replace("[site]",$meta['name'],$render);
		$render = str_replace("[title]",$title,$render);
		$render = str_replace("[keywords]",$meta["keywords"],$render);
		$render = str_replace("[nav]",$nav,$render);
>>>>>>> Adding more functions

			if ($delete && !$confirmed) {
				echo "<form action='page.php' method='get'>
				<input type='hidden' name='title' value='" . $title . "' />
				<input type='hidden' name='content' value='" . $content . "' />
				<input type='hidden' name='delete' value='" . $delete . "' />
				<input type='hidden' name='confirmed' value='TRUE' />
				<h1>Are you sure you want to delete&nbsp;'" . $title . "'?</h1>
				<button type='submit' class='button delete'>Yes, I won't regret it</button>
				&nbsp;&nbsp;
				<a href='./' class='button'>Nevermind</a></form>";
			} else if ($delete && $confirmed) {
				echo "<h1>You told us to delete this page:</h1><br><blockquote><h2>" . $title . ".</h2>
				<p>" . $content . "</p></blockquote>
				<h2>And we did.</h2><br>";
				unlink("../" . strtolower($title) . ".html");
				unlink("../meta/pages/" . strtolower($title) . ".txt");
			} else if ($title && $content) {
				if ($titlebefore && $title !== $titlebefore) {
					unlink("../" . strtolower($titlebefore) . ".html");
					unlink("../meta/pages/" . strtolower($titlebefore) . ".txt");
				}
				echo "<h1>All done! Here's a preview:</h1><br><blockquote><h1>" . $title . "</h1><p>" . $content . "</p></blockquote>";
				file_put_contents(("../" . strtolower($title) . ".html"), $render);
				file_put_contents(("../meta/pages/" . strtolower($title) . ".txt"), $_GET["content"]);
			} else {
				echo "Request not complete.";
			}
			?>
			<p>
				<?php 
				if (!$delete) {
					echo "<a href='../" . strtolower($title) . "' class='button'>Visit the page</a>&nbsp;&nbsp;";
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