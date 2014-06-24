<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_evaluation = filter_input(INPUT_POST, "id_evaluation");

$query = "DELETE FROM evaluations WHERE id_evaluation = " . $id_evaluation;

$result = $link->query($query) or die("Error ".  mysqli_error($link));