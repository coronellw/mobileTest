<?php

include './parseParams.php';

$id_model = filter_input(INPUT_GET, "id_model");
$name = filter_input(INPUT_GET, "name");
$model = filter_input(INPUT_GET, "model");
$brand = filter_input(INPUT_GET, "brand");


include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "UPDATE models SET name = ".validateNullString($name).", "
        . "model = ".validateNullString($model).", "
        . "id_brand = ".$brand." WHERE id_model = ".$id_model.";" or die (mysqli_error($link));
echo $query."\n";

$result = $link->query($query);

echo $result;