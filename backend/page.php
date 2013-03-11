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
				<li><a href="./#pages">Pages</a></li>
				<li><a href="./#new">New</a></li>
				<li><a href="./#meta">Settings</a></li>
			</ul>
		</nav>
	</header>
	<section id="edit">
		<?php
		$title = $_GET["title"];
		$meta = json_decode(file_get_contents("../meta/meta.txt"), true);
		$content = $_GET["content"];

		$content = str_replace(array("\r\n","\r"), "\n", $content) . "\n";
		$content = preg_replace('/(\n){2,}/',"</p><p>",$content);
		$content = preg_replace('#\n(\w)#', '<br>\1', $content);

		$before = file_get_contents("../theme/before.html") . "\n<p>";
		$after = "</p>\n" . file_get_contents("../theme/after.html");
		$render = $before . $content . $after;

		$render = str_replace("[site]",$meta['name'],$render);
		$render = str_replace("[title]",$title,$render);
		$render = str_replace("[keywords]",$meta["keywords"],$render);

		if ($title && $content) {
			echo "<h1>All done! Here's a preview:</h1><br><blockquote><h1>" . $title . "</h1><p>" . $content . "</p></blockquote>";
			file_put_contents(("../" . strtolower($title) . ".html"), $render);
			file_put_contents(("../meta/pages/" . strtolower($title) . ".txt"), $_GET["content"]);
		}
		else {
			echo "Request not complete.";
		}
		?>
		<p>
			<a href="./" class="button">Back to the dash.</a>
			<a href='../<?php echo strtolower($title); ?>' class="button">To the page.</a>
		</p>
	</section>
</body>
</html>