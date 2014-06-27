<?php

include '../../db_info.php';
include './parseParams.php';

$id_event = filter_input(INPUT_GET, "id_event");
$name = filter_input(INPUT_GET, "name");
$description = filter_input(INPUT_GET, "description");

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE supported_events SET name = '" . $name . "', "
        . "description = " . validateNullString($description) . "  WHERE id_event = " . $id_event . ";" or die(mysqli_error($link));

$result = $link->query($query);
