<?php
include '../../db_info.php';

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$imei = filter_input(INPUT_GET, "imei");

$query_device = "SELECT * FROM devices d WHERE d.imei = " . $imei;

$device_result = $link->query($query_device);

$row_dev = mysqli_fetch_array($device_result);
?>
<html>
    <head>
        <title>Edit device</title>
        <?php include '../../template/_head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
    </head>
    <body>
    <center>
        <h1>Edit device</h1>
        <h2>Make the changes you need.</h2>
        <a href="/mobile/admin/" >Back to index</a>
        <table class="stylish" >
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>IMEI:</td>
                    <td><input type="numeber" value = "<?php echo $row_dev["imei"] ?>"</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value = "<?php echo $row_dev["name"] ?>"></td>
                </tr>
                <tr>
                    <td>Branch:</td>
                    <td><input type="text" value = "<?php echo $row_dev["marca"] ?>"></td>
                </tr>
                <tr>
                    <td>Model:</td>
                    <td><input type="text" value = "<?php echo $row_dev["modelo"] ?>"></td>
                </tr>
                <tr>
                    <td>Last updated:</td>
                    <td style="padding-left: 5px;"><?php echo $row_dev["last_use"] ?></td>
                </tr>
            </tbody>
        </table>
        <button type="button" onclick="if(confirm('Are you sure you want to continue')){
            console.log('preparing to save changes');
        }else{
            console.log('edit process cancelled by user');
        };" >Save changes</button>
    </center>
</body>
</html>
