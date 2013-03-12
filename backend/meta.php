<!DOCTYPE html>
<?php
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
$name = $_POST["name"];
echo $name;
?>
<html>
<head>
	<title>Backend - <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/core.min.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<header>
		<a href="./" title="Dashboard"><span id="logo"><?php echo $name ?></span></a>
		<nav>
			<ul>
				<li><a href="./#pages">Pages</a></li>
				<li><a href="./#new">New</a></li>
				<li><a href="./#meta">Settings</a></li>
			</ul>
		</nav>
	</header>
	<div id="frame">
		<section id="edit">
			<?php
			$name = $_POST["name"];
			$keywords = $_POST["keywords"];
			$description = $_POST["description"];
			if ($name) {
				$json = '{"name":"'.$name.'","keywords":"'.$keywords.'","description":"'.$description.'"}';
				file_put_contents(("../meta/meta.txt"), $json);
			}
			if ($name) {
				echo "<h1>Okay, we've changed some details.</h1>
				<blockquote><h2>The name of your site is now \"" . $name . "\".</h2><br>
				";
				if ($keywords) {
					$tags = explode(',', $keywords);
					foreach ($tags as &$tag) {
						$tag = '<span class="button tag">' . $tag . '</span>';
					}
					echo "<span style='display:block;margin-top:-30px;'></span><p>You've said that the words \"&nbsp;" . implode(' , ', $tags) . "&nbsp;\" describe your site.</p>";
				}
				if ($keywords) {
					echo "<p>And you've told us that your site is about \"" . $description . "\"</p>";
				}
				echo "</blockquote><br>";
			} else {
				echo "<h1>You didn't type a name for your site.</h1>
				</p>Don't worry, we didn't change anything.<br>Go back and fill the field with something other than a blank line.</p>";
			}
			?>
			<p>
				<?php 
				echo "<a href=\"./\" class=\"button\">Back to the dash</a>";
				?>
			</p>
		</section>
	</div>
</body>
</html>