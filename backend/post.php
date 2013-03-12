<?php
$title = strtolower($_POST["title"]);
$content = $_POST["content"];
date_default_timezone_set("America/Vancouver");
$time = getdate();
$ftime = date('H:i',strtotime("$time[hours]:$time[minutes]"));
$timestamp = "<p>$time[mday] $time[month] $time[year], $ftime</p>";
if ($title && $content) {
	echo "<h1>" . $title . "</h1><p>" . $content . "</p>";
	file_put_contents(("../posts/" . $title . ".html"), $content . $timestamp);
}
else {
	echo "Request not complete.";
}
?>