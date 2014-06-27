<?php

include './parseParams.php';
include '../../db_info.php';

$name = filter_input(INPUT_GET, "name");
$description = validateNullString(filter_input(INPUT_GET, "description"));

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "INSERT INTO supported_events(name, description) VALUES ('" . $name . "', " . $description . ");" or die("Error " . mysqli_error($link));

$result = $link->query($query);
