<?php

include '../../../db_info.php';

$query = "SELECT name, description, time, enable FROM evaluations;" or die("Error " . mysqli_error($link));

$result = $link->query($query);
$evaluations = array();

while ($evaluation = mysqli_fetch_assoc($result)) {
    $evaluations[] = $evaluation;
}

echo json_encode($evaluations);