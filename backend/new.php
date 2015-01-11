<!DOCTYPE html>
<?php
$json = json_decode(file_get_contents("../meta/meta.txt"), true);
?>
<html>
<head>
	<title>Backend &bull; <?php echo $json['name']; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Source+Code+Pro' rel='stylesheet' type='text/css'>
</head>
<body class="new">
	<header>
		<a href="./" title="Dashboard" id="logo"><i class="icon logo"></i></a>
		<nav>
			<ul>
				<li><a href="#" id="publish" disabled>Publish</a></li>
				<li><a href="./">Cancel</a></li>
			</ul>
			<ul class="sec">
				<li><a href="./new.php" title="New page">New</a></li>
				<li><a href="./settings.php" title="Site settings">Settings</a></li>
				<li><a href="../" title="Visit site" target="_blank">Site</a></li>
			</ul>
		</nav>
	</header>
	<section class="title">
		<input type="text" id="page-title" autofocus placeholder="Title">
	</section>
	<section class="content">
		<div id="preview">Preview</div>
		<textarea name="page-content" id="page-content" placeholder="Body text, styled with Markdown or HTML"></textarea>
		<div id="output"></div>
	</section>
	<script src="js/marked.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<!-- <script src="js/err.min.js" type="text/javascript"></script> -->
	<script>
		var textarea = $('#page-content'), output = $('#output'), preview = $('#preview'), toggle = false;
		textarea.css("min-height", ( $(window).height() - 155 ) + "px");
		textarea.on("keyup", function() {
			$(this).css("height", ( this.scrollHeight ));
		});
		textarea.on("input", function() {
			output.html(marked($(this).val()));
			$("#publish").removeAttr("disabled");
		});
		preview.on("click", function() {
			if (toggle) {
				toggle = false;
				output.removeClass("visible");
				textarea.removeClass("invisible");
				preview.removeClass("active");
			} else {
				toggle = true;
				output.addClass("visible");
				textarea.addClass("invisible");
				preview.addClass("active");
			}
		});
		marked.setOptions({breaks:true});
		$("#publish").click(function() {
			var title = $("#page-title").val(),
				markdown = textarea.val(),
				html = marked(textarea.val());
			$.post("./page.php", {
				title: title,
				markdown: markdown,
				content: html
			}, function(data) {
				console.log(data);
				window.location = ( "./edit.php?page=" + $("#page-title").val() );
			});
		});
		$("#publish[disabled]").click(function() { return false; });
	</script>
</body>
</html>
