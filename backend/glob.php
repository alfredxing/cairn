<ul>
	<?php
	function fname($name) {
		$n = ucfirst(str_replace(".html","",substr($name,3)));
		return (string)$n;
	};
	$pages = glob('../*.htm*');
	foreach ($pages as $i) {
		$name = fname($i);
		if ($gedit==true) {
			echo '<a href="./edit.php?page='.strtolower($name).'" class="page" target="_blank"><li class="button">' . $name . '</li></a>';
		}
		else {
			echo '<li><a href="../'.strtolower($name).'" class="page" target="_blank">' . $name . '</a></li>';
		}
	}
	?>
</ul>