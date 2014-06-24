<?php

$name = filter_input(INPUT_GET, "name");
$description = filter_input(INPUT_GET, "description");
$time = filter_input(INPUT_GET, "time");
$tests = filter_input(INPUT_GET, "tests", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));



$query = "INSERT INTO evaluations(name, description, time) VALUES ('" . $name . "', " . ($description !== null ? "'" . $description . "'" : null) . ", " . $time . ");" or die("Error " . mysqli_error($link));

$result = $link->query($query);

if ($tests !== null) {
    $id_evaluation = mysqli_insert_id($link);

    for ($i = 0; $i < count($tests); $i++) {
        $realtionship_query = "INSERT INTO evaluation_test(id_evaluation, id_test) VALUES (" . $id_evaluation . ", " . $tests[$i] . ");" or die("Error " . mysqli_error($link));
        $relationship = $link->query($realtionship_query);
    }
}
