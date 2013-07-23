<?php

$json = json_decode(file_get_contents("../meta/meta.txt"), true);
error_reporting(2);

include("f5.php");

$meta = json_decode(file_get_contents("../meta/meta.txt"), true);

$titlebefore = $_POST["titlebefore"];

$title = $_POST["title"];
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
	unlink("../" . swd(strtolower($title)) . ".html");
	unlink("../meta/pages/" . strtolower($title) . ".json");
} else if ($title && $content) {
	if ($titlebefore && $title !== $titlebefore) {
		unlink("../" . swd(strtolower($titlebefore)) . ".html");
		unlink("../meta/pages/" . strtolower($titlebefore) . ".json");
	}
	echo "<h1>All done! Here's a preview:</h1><br><blockquote><h1>" . $title . "</h1><p>" . update($title,$content,$md) . "</p></blockquote>";
} else {
	echo "Request not complete.";
}

rall($delete);
if (!$delete) {
	echo "<a href=\"../" . strtolower($title) . "\" class='button'>Visit the page</a>&nbsp;&nbsp;";
}
if ($confirmed || !$delete) {
	echo "<a href=\"./\" class=\"button\">Back to the dash</a>";
}

?>