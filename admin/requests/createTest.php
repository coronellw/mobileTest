<?php

$name = filter_input(INPUT_GET, "name");
$action = filter_input(INPUT_GET, "action");
$description = filter_input(INPUT_GET, "description");
$tag = filter_input(INPUT_GET, "tag");
$evaluation = filter_input(INPUT_GET, "evaluation");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "INSERT INTO tests(name, action, description, tag) VALUES ('" . $name . "', " . $action . ", '" . $description . "', '" . $tag . "');" or die("Error " . mysqli_error($link));

$result = $link->query($query);

if ($evaluation !== null) {
    $id_test = mysqli_insert_id($link);
    $realtionship_query = "INSERT INTO evaluation_test(id_evaluation, id_test) VALUES (" . $evaluation . ", " . $id_test . ");" or die("Error " . mysqli_error($link));
    $relationship = $link->query($realtionship_query);
}
