<?php
include '../../db_info.php';

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$imei = filter_input(INPUT_GET, "imei");

$query_device = "SELECT d.*, b.id_brand, b.name as brand_name, m.id_model, m.name as model_name FROM devices d, brands b, models m WHERE b.id_brand = d.id_brand AND m.id_model = d.id_model AND d.imei = " . $imei;
$device_result = $link->query($query_device);
$device = mysqli_fetch_array($device_result);
echo $device['id_device'] . "-" . $device['name'] . "-" . $device['imei'] . "-" . $device['brand_name'] . "-" . $device['model_name'] . "-" . $device['last_use'] . "-";

$brands_query = "SELECT b.* FROM  brands b" or die("Error " . mysqli_error($link));
$brands = $link->query($brands_query);
?>
<html>
    <head>
        <title>Edit device</title>
        <?php include '../../template/_head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <script type="text/javascript" src="/mobile/js/testing.js"></script>
    </head>
    <body>
    <center>
        <h1>Edit device</h1>
        <h2>Make the changes you need.</h2>
        <a href="/mobile/admin/" >Back to index</a>
        <table class="stylish" >
            <tbody>
                <tr>
                    <td>IMEI:</td>
                    <td><input type="numeber" value = "<?php echo $device["imei"] ?>"</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value = "<?php echo $device["name"] ?>"></td>
                </tr>
                <tr>
                    <td>Branch:</td>
                    <td>
                        <select id="brand" onchange="updateModels(<?php $device['id_model']; ?>);">
                            <option value="null">---</option>
                            <?php while ($brand = mysqli_fetch_array($brands)) { ?>
                                <option value ="<?php echo $brand["id_brand"] ?>"
                                <?php
                                if ($brand['id_brand'] === $device['id_brand']) {
                                    echo "selected='true'";
                                }
                                ?>>
                                <?php echo $brand["name"] ?>
                                </option>
<?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Model:</td>
                    <td>
                        <select id="model">
                            <option value="null">---</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Last updated:</td>
                    <td style="padding-left: 5px;"><?php echo $device["last_use"] ?></td>
                </tr>
            </tbody>
        </table>
        <span class="row">
            <button type="button" onclick="if (confirm('Are you sure you want to continue')) {
                        console.log('preparing to save changes');
                    } else {
                        console.log('edit process cancelled by user');
                    }
                    ;" class="btn btn-primary" >Save changes</button>
        </span>
    </center>
</body>
</html>
