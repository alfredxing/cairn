<<<<<<< HEAD
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
				echo '<form action="./edit.php" method="POST"><button type="submit" name="page" value="' . rawurlencode($name). '" class="page button">' . $name . '</button></form>';
			}
			else {
				echo '<li><a href="../'.rawurlencode($name).'" class="page">' . $name . '</a></li>';
			}
=======
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
			echo '<a href="./edit.php?page='.strtolower($name).'" class="page"><li class="button page">' . $name . '</li></a>';
		}
		else {
			$nav = $nav . '<li><a href="./'.strtolower($name).'" class="page">' . $name . '</a></li>';
>>>>>>> a6f40bb3e2e7724978dce812feb0ed0c4b716cb8
		}
	}
}
?>
