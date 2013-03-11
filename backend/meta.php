<?php
$name = $_GET["name"];
$keywords = $_GET["keywords"];
$description = $_GET["description"];
$json = '{"name":"'.$name.'","keywords":"'.$keywords.'","description":"'.$description.'"}';
file_put_contents(("../meta/meta.txt"), $json);
?>