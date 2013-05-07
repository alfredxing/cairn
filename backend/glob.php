<?php
error_reporting(2);
function fname($name) {
	$n = ucfirst(str_replace(".html","",substr(urldecode($name),3)));
	return (string)$n;
};
$nav = '';
function g($refresh,$delete) {
	$pages = glob('../*.htm*');
	if (!$pages && !$refresh && !$delete) {
		echo 'You don\'t have any pages. Why not get started below?';
	} else {
		foreach ($pages as $i) {
			$name = fname($i);
			if ($GLOBALS['gedit'] == true) {
				echo '<form action="./edit.php" method="POST"><button type="submit" name="page" value="' . $name. '" class="page button">' . $name . '</button></form>';
			}
			elseif ($GLOBALS['refresh'] == true) {
				if (strtolower(fname($i)) == "index") {
					$entry = '<li><a href="./" class="page">' . ucfirst($name) . '</a></li>';
				} else {
					$entry = '<li><a href="./'.strtolower(fname($i)).'" class="page">' . ucfirst($name) . '</a></li>';
				}
				$GLOBALS['nav'] = $GLOBALS['nav'] . $entry;
			}
			else {
				echo '<li><a href="../'.$i.'" class="page">' . $name . '</a></li>';
			}
		}
	}
}
?>