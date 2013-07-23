<?php
error_reporting(2);

function fname($name) {
	$data = json_decode(file_get_contents($name), true);
	$n = $data["t"];
	return (string)$n;
}

function swd($name) {
	return str_replace(" ", "-", $name);
}

$nav = '';
function g($refresh,$delete) {
	$pages = glob('../meta/pages/*.json');
	if (!$pages && !$refresh && !$delete) {
		echo '<span id="none">You don\'t have any pages yet. Why not <a href="./new.php">create a new one?</a></span>';
	} else {
		foreach ($pages as $i) {
			$name = fname($i);
			if ($GLOBALS['gedit'] == true) {
				echo '<form action="./edit" method="POST"><button type="submit" name="page" value="' . $name. '" class="page button">' . $name . '</button></form>';
			}
			elseif ($GLOBALS['refresh'] == true) {
				if (strtolower(fname($i)) == "index") {
					$entry = '<li class="index"><a href="./" class="page">' . ucfirst($name) . '</a></li>';
				} else {
					$entry = '<li class="' . swd(strtolower(fname($i))) . '"><a href="./' . swd(strtolower(fname($i))) . '" class="page">' . fname($i) . '</a></li>';
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