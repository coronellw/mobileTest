<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_evaluation = filter_input(INPUT_POST, "id_evaluation");

$query = "SELECT * FROM evaluations WHERE id_evaluation = " . $id_evaluation or die("Error " . mysqli_error($link));

$evaluation_result = $link->query($query);
$evaluation = mysqli_fetch_array($evaluation_result);

if ($evaluation['enable'] === '1') {
    $enable = 0;
} else {
    $enable = 1;
}

echo $enable;

$query = "UPDATE evaluations SET enable = " . $enable . " WHERE id_evaluation = " . $evaluation['id_evaluation'] . ";" or die("Error " . mysqli_error($link));

$update = $link->query($query);
