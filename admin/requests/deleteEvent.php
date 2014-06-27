<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_event = filter_input(INPUT_POST, "id_event");

$query = "DELETE FROM supported_events WHERE id_event = " . $id_event;

$result = $link->query($query) or die("Error ".  mysqli_error($link));