<?php

$refresh = true;
include("glob.php");
$meta = json_decode(file_get_contents("../meta/meta.txt"), true);

function update($title,$co,$file) {
	$content = $co;

	$content = str_replace(array("\r\n","\r"), "\n", $content) . "\n";
	$content = preg_replace('/(\n){2,}/',"</p><p>",$content);
	$content = preg_replace('#\n(\w)#', '<br>\1', $content);

	$before = file_get_contents("../theme/before.html") . "\n<p>";
	$after = "</p>\n" . file_get_contents("../theme/after.html");
	$render = $before . $content . $after;

	$render = str_replace("[site]",$GLOBALS['meta']['name'],$render);
	$render = str_replace("[title]",$title,$render);
	$render = str_replace("[keywords]",$meta["keywords"],$render);
	$render = str_replace("[nav]",$GLOBALS["nav"],$render);

	if ($title && $content) {
		file_put_contents(("../" . strtolower($title) . ".html"), $render);
		file_put_contents($file, $co);
	}
	else {
		die("Request not complete.");
	}
}

function fnamen($name) {
	$n = ucfirst(str_replace(".txt","",substr($name,14)));
	return (string)$n;
};

function rall() {
	$pages = glob('../meta/pages/*.txt');
	foreach ($pages as $i) {
		$file = $i;
		$name = fnamen($i);
		$content = file_get_contents($file);
		update($name,$content,$file,$nav);
	};
}

?>