<?php

$name = filter_input(INPUT_GET, "name");
$action= filter_input(INPUT_GET, "action");
$description = filter_input(INPUT_GET, "description");
$tag = filter_input(INPUT_GET, "tag");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "INSERT INTO tests(name, action, description, tag) VALUES (".$name.", ".$action.", ".$description.", ".$tag.");" or die("Error " . mysqli_error($link));

$result = $link->query($query);

echo $result;