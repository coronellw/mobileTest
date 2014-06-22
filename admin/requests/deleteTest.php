<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_test = filter_input(INPUT_POST, "id_test");

$query = "DELETE FROM tests WHERE id_test = " . $id_test;

$result = $link->query($query) or die("Error ".  mysqli_error($link));