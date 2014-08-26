<?php

include '../../../db_info.php';

$query = "SELECT name, description, tag, action FROM tests ORDER BY tag;" or die("Error " . mysqli_error($link));

$result = $link->query($query);
$tests = array();

while ($test = mysqli_fetch_assoc($result)) {
    $tests[] = $test;
}

echo json_encode($tests);