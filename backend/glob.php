<ul>
	<?php
	function fname($name) {
		$n = ucfirst(str_replace(".html","",substr($name,3)));
		return (string)$n;
	};
	$pages = glob('../*.htm*');
	$nav = '';
	if (!$pages) {
		echo 'You don\'t have any pages. Why not get started below?';
	} else {
		foreach ($pages as $i) {
			$name = fname($i);
			if ($gedit==true) {
				echo '<form action="./edit.php" method="POST"><button type="submit" name="page" value="' . rawurlencode($name). '" class="page button">' . $name . '</button></form>';
			}
			elseif ($refresh==true) {
				$nav = $nav . '<li><a href="./'.rawurlencode($name).'" class="page">' . $name . '</a></li>';
			}
			else {
				echo '<li><a href="../'.rawurlencode($name).'" class="page">' . $name . '</a></li>';
			}
		}
	}
	?>
</ul>