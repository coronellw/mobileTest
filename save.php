<?php

include 'db_info.php';
$link = mysqli_connect($hst, "$usrnm", $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_device = filter_input(INPUT_POST, "device");
$timestamp = filter_input(INPUT_POST, "timestamp");
$eval_type = filter_input(INPUT_POST, "eval_type");
$eval_status = filter_input(INPUT_POST, "eval_status");
$pruebasResult = filter_input(INPUT_POST, "pruebas");

$pruebas = json_decode($pruebasResult, true);

$query = "";

for ($i = 0; $i < count($pruebas); $i++) {
    $resultadoTest = $pruebas["passed"] == true ? 1 : 2;
    $query = prepareQuery($pruebas["id_test"], $resultadoTest);
    if (!mysqli_query($link, $query)) {
        die("Error: " . mysqli_error($link));
    }
}

function prepareQuery($id_test, $test_result) {
    global $id_device, $eval_type, $eval_status;
    return "INSERT INTO results(test_date, id_device, id_status_test, id_test, id_evaluation, id_status_evaluation) VALUES (NOW()," . $id_device . "," . $test_result . "," . $id_test . "," . $eval_type . "," . $eval_status . ")";
}
