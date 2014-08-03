<?php

include '../../../db_info.php';

$query = "SELECT "
        . "d.imei as imei, d.last_use as last_test "
        . "FROM "
        . "devices d "
        . "ORDER BY "
        . "d.last_use DESC;" or die("Error " . mysqli_error($link));

$result = $link->query($query);
$devices = array();

while ($device = mysqli_fetch_array($result)) {
    $devices[] = $device;
}

echo json_encode($devices);
