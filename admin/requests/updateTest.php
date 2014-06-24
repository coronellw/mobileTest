<?php

$id_test = filter_input(INPUT_GET, "id_test");
$name = filter_input(INPUT_GET, "name");
$action = filter_input(INPUT_GET, "action");
$description = filter_input(INPUT_GET, "description");
$tag = filter_input(INPUT_GET, "tag");


include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE tests SET name = '".$name."', "
        . "action = ".$action.", "
        . "description = '".$description."', "
        . "tag = '".$tag."' WHERE id_test = ".$id_test.";" or die (mysqli_error($link));

$result = $link->query($query);