<?php

$refresh = true;
include("glob.php");
$meta = json_decode(file_get_contents("../meta/meta.txt"), true);

function update($title,$content,$md) {

	/* $content = str_replace(array("\r\n","\r"), "\n", $content) . "\n";
	$content = preg_replace('/(\n){2,}/',"</p><p>",$content);
	$content = preg_replace('#\n(\w)#', '<br>\1', $content); */

	if ( file_exists("../theme/" . strtolower($title) . "/before.html") ) {
		$before = file_get_contents("../theme/" . strtolower($title) . "/before.html") . "\n<p>";
	} else {
		$before = file_get_contents("../theme/before.html") . "\n<p>";
	}
	if ( file_exists("../theme/" . strtolower($title) . "/after.html") ) {
		$after = file_get_contents("../theme/" . strtolower($title) . "/after.html") . "\n";
	} else {
		$after = file_get_contents("../theme/after.html") . "\n";
	}
	$render = $before . $content . $after;

	$render = str_replace("[site]",$GLOBALS['meta']['name'],$render);
	$render = str_replace("[title]",$title,$render);
	$render = str_replace("[keywords]",$GLOBALS['meta']["keywords"],$render);
	$render = str_replace("[description]",$GLOBALS['meta']["description"],$render);
	$render = str_replace("[nav]",$GLOBALS["nav"],$render);

	if ($title && $content) {
		$naext = "../meta/pages/".strtolower($title).".";
		file_put_contents(("../" . swd(strtolower($title)) . ".html"), $render);
		/*file_put_contents($naext."md", $md);
		file_put_contents($naext."txt", $content);*/
		$data = json_encode(array("t" => $title, "md" => $md, "c" => $content));
		file_put_contents($naext."json", $data);
		return $content;
	}
	else {
		die("Request not complete.");
	}
}

function fnamen($name) {
	$n = str_replace(".txt","",substr($name,14));
	return (string)$n;
};

function rall($delete) {
	$pages = glob('../meta/pages/*.json');
	g(true,$delete);
	foreach ($pages as $i) {
		$data = json_decode(file_get_contents($i), true);
		$name = $data["t"];
		$content = $data["c"];
		$md = $data["md"];
		update($name,$content,$md);
	};
}

?>
