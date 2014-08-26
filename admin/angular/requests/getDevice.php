<?php

$json_data = json_decode(file_get_contents("php://input"), true);
$imei = $json_data['imei'];
$options = $json_data['options'];
$evaluations = array();
$response = array();
$queries = array();

include '../../../db_info.php';

$query = "SELECT "
        . "d.id_device, d.imei, d.name, m.name as model, b.name as brand, d.id_brand, d.id_model, d.last_use "
        . "FROM "
        . "devices d LEFT OUTER JOIN models m ON m.id_model = d.id_model LEFT OUTER JOIN brands b ON b.id_brand = d.id_brand "
        . "WHERE d.imei = " . $imei . ";"
        or die("Error " . mysqli_error($link));
$queries[] = $query;

$device_result = $link->query($query);
$device = mysqli_fetch_assoc($device_result);
if (isset($options['detailed']) && $options['detailed'] === true) {

    $query_evaluations = "SELECT "
            . "r.id_result, r.test_date AS date, e.name AS name, s.name as status "
            . "FROM "
            . "results r, status s, evaluations e, devices d "
            . "WHERE "
            . "r.id_evaluation = e.id_evaluation AND "
            . "r.id_status_evaluation = s.id_status AND "
            . "r.id_device = d.id_device AND "
            . "d.imei = " . $device['imei'] . " "
            . "GROUP BY test_date";
    $queries[] = $query_evaluations;
    $evaluations_result = $link->query($query_evaluations);

    while ($evaluation = mysqli_fetch_assoc($evaluations_result)) {
        $tests = array();
        $query_tests = "SELECT "
                . "t.id_test, s.name as status, t.name "
                . "FROM "
                . "tests t LEFT OUTER JOIN results r ON r.id_test = t.id_test AND "
                . "r.id_device = " . $device['id_device'] . " AND "
                . "r.test_date = '" . $evaluation['date'] . "' LEFT OUTER JOIN status s on r.id_status_test = s.id_status "
                . " ORDER BY t.tag";
        $queries[] = $query_tests;
        $tests_result = $link->query($query_tests);
        while ($test = mysqli_fetch_assoc($tests_result)) {
            $tests[] = $test;
        }
        $evaluation['tests'] = $tests;
        $evaluations[] = $evaluation;
    }

    $device['evaluations'] = $evaluations;
}
if (isset($device)) {
    $response['result'] = "ok";
    $response['device'] = $device;
} else {
    $response['result'] = "fail";
    $response['error_msg'] = mysqli_error($link);
    $response['queries'] = $queries;
}

echo json_encode($response);
