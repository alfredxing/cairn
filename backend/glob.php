<ul>
	<?php
	function fname($name) {
		$n = ucfirst(str_replace(".html","",substr($name,3)));
		return (string)$n;
	};
	$pages = glob('../*.htm*');
	if (!$pages) {
		echo 'You don\'t have any pages. Why not get started below?';
	} else {
		foreach ($pages as $i) {
			$name = fname($i);
			if ($gedit==true) {
				echo '<a href="./edit.php?page='.strtolower($name).'" class="page"><li class="button page">' . $name . '</li></a>';
			}
			else {
				echo '<li><a href="../'.strtolower($name).'" class="page">' . $name . '</a></li>';
			}
		}
	}
	?>
</ul>