<?php

$id_evaluation = filter_input(INPUT_GET, "id_evaluation");
$name = filter_input(INPUT_GET, "name");
$description = filter_input(INPUT_GET, "description");
$time = filter_input(INPUT_GET, "time");
$tests = filter_input(INPUT_GET, "tests", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE evaluations SET "
        . "name = '" . $name . "', "
        . "description = " . ($description !== null ? "'" . $description . "'" : null) . ", "
        . "time = " . $time . " "
        . "WHERE id_evaluation = " . $id_evaluation . ";" or die("Error " . mysqli_error($link));

$result = $link->query($query);

$to_delete = array();
$to_insert = array();

if ($tests !== null) {

    for ($i = 0; $i < count($tests); $i++) {
        $test = $tests[$i];
        if (($test['save'] === 'false') && ($test['id_evaluation'] === $id_evaluation)) {
            $to_delete[] = $test['id_test'];
        }
        if (($test['save'] === 'true') && ($test['id_evaluation'] != $id_evaluation)) {
            $to_insert[] = $test['id_test'];
        }
    }
    
    if (count($to_delete) > 0) {
        deleteValues($to_delete);
    }
    if (count($to_insert) > 0) {
        insertValues($to_insert);
    }
}

function deleteValues($delete) {
    global $link, $id_evaluation;
    $query = "DELETE FROM evaluation_test WHERE id_evaluation = " . $id_evaluation . " AND id_test in (" . implode(",", $delete) . ");" or die('Error ' . mysqli_error($link));
    $link->query($query);
}

function insertValues($insert) {
    global $link, $id_evaluation;
    $query = "INSERT INTO evaluation_test(id_evaluation, id_test) VALUES ";
    for ($i = 0; $i < count($insert); $i++) {
        $query = $query . "(" . $id_evaluation . " , " . $insert[$i] . "),";
    }
    $final_query = rtrim($query, ',') . ";" or die('Error ' . mysqli_error($link));
    $link->query($final_query);
}
