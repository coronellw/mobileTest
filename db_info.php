<?php

$hst = "localhost:3306";
$usrnm = "mobile";
$psswrd = "M0b1l3";
$schm = "mobile";

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$acentos = $link->query("SET NAMES 'utf8'");
session_start();