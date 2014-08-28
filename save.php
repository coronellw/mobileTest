<?php

include 'db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$id_device = filter_input(INPUT_POST, "device");
$eval_type = filter_input(INPUT_POST, "eval_type");
$eval_status = filter_input(INPUT_POST, "eval_status");
$pruebas = filter_input(INPUT_POST, "pruebas", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);

$query = "INSERT INTO results(test_date, id_device, id_status_test, id_test, id_status_evaluation, id_evaluation) VALUES ";

for ($i = 0; $i < count($pruebas); $i++) {
    $prueba = $pruebas[$i];
    $result = ($prueba['passed'] === 'true') ? 1 : 2;
    $query .= prepareQuery($prueba['id_test'], $result);
}

$finalQuery = rtrim($query,',');
$finalQuery .=";";

$resultado = $link->query($finalQuery);
if ($resultado && mysqli_affected_rows($link)>0) {
    $last_id = mysqli_insert_id($link);
}else{
    die("Error" . mysqli_error($link));
}

function prepareQuery($test, $test_result) {
    global $id_device, $eval_status, $eval_type;
    return "(NOW()," . $id_device . "," . $test_result . "," . $test . "," . $eval_status . "," . $eval_type . "),";
}

$q_date = "SELECT test_date, id_status_evaluation FROM results WHERE id_result = $last_id";
$r_date = $link->query($q_date);

if ($r_date && mysqli_num_rows($r_date) > 0) {
	$dato = mysqli_fetch_assoc($r_date);
	$dato['eval_type'] =  $eval_type;
	echo json_encode($dato);
}
