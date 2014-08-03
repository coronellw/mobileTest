<?php

session_start();

include '../../db_info.php';
include '../../validations.php';

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$query = "SELECT u.name, u.last_name, u.username "
        . "FROM users u, login_info l"
        . "WHERE username = " . parseString($username)
        . " AND psswrd = MD5(" . parseString($password) . ");"
        or die("Error " . mysqli_error($link));
$result = $link->query($query);

$user = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);

$response = "";
$header = "Location: ";
$message_content = "";
$message_type= "";
$message_title = "Mobile testing app";

if ($count > 0) {
    $_SESSION['user'] = $user;
    $message_content = "Bienevenido usuario " . $user['name'];
    $message_type = "success";
    
    $header+="Location: /mobile/admin/index.php";
    $response = json_encode($user);
} else {
    $message_content = "Sus credenciales no son validas, intente nuevamente.";
    $message_type = "danger";
    
    $header+="Location: /mobile/admin/login.php";
    $response = "fail";
}

$_SESSION['messages'][] = createMsg($message_content, $message_type, $message_title);
header($header);
echo $response;