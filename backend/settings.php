<?php
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Backend - <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body class="settings">
	<header>
		<a href="./" title="Dashboard" id="logo"><i class="icon logo"></i></a>
		<nav>
			<ul>
				<li><a href="#" id="save" disabled>Save</a></li>
				<li><a href="./">Cancel</a></li>
				<li><a href="#" id="refresh" title="Refresh all pages">Refresh</a></li>
			</ul>
			<ul class="sec">
				<li><a href="./new.php" title="New page">New</a></li>
				<li><a href="./settings.php" title="Site settings">Settings</a></li>
				<li><a href="../" title="Visit site" target="_blank">Site</a></li>
			</ul>
		</nav>
	</header>
	<section class="title">
		<label for="site-name">Site Name</label>
		<input type="text" id="site-name" name="site-name" placeholder="Site name" value="<?php echo $json['name']; ?>">
	</section>
	<section class="content">
		<label for="site-keywords">Keywords</label>
		<input type="text" id="site-keywords" name="site-keywords" placeholder="Keywords separated by commas" value="<?php echo $json['keywords'];?>">
		<label for="site-description" class="description">Description</label>
		<textarea name="site-description" id="site-description" placeholder="Describe your site in a short blurb"><?php echo $json['description'];?></textarea>
	</section>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
		var textarea = $(".content textarea");
		textarea.css("min-height", ( $(window).height() - 205 ) + "px");
		textarea.on("keyup", function() {
			$(this).css("height", ( this.value.split("\n").length * 20 + 100 ) + "px");
		});
		$("input, textarea").on("input", function() {
			$("#save").removeAttr("disabled");
		});
		$("#save").click(function() {
			var name = $("#site-name").val(),
				keywords = $("#site-keywords").val(),
				description = $("#site-description").val();
			$.post("./meta.php", {
				name: name,
				keywords: keywords,
				description: description
			}, function(data) {
				console.log(data);
				$.get("./refresh.php", function(data) {
					console.log(data);
					location.reload();
				});
			});
		});
		$("#save[disabled]").click(function(){ return false; })
		$("#save").attr("disabled", "disabled");
		$("#refresh").click(function() {
			$.get("./refresh.php", function(data) {
				console.log(data);
				location.reload();
			});
		})
	</script>
</body>
</html>