<?php
include '../../db_info.php';

$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$imei = filter_input(INPUT_GET, "imei");

$query_device = "SELECT d.*, b.id_brand, b.name as brand_name, m.id_model, m.name as model_name FROM devices d left outer join brands b on d.id_brand = b.id_brand left outer join models m on d.id_model = m.id_model WHERE d.imei = " . $imei . ";" or die("Error " . mysqli_error($link));
$device_result = $link->query($query_device);
$device = mysqli_fetch_array($device_result);

$brands_query = "SELECT b.* FROM  brands b" or die("Error " . mysqli_error($link));
$brands = $link->query($brands_query);

$model_query = "SELECT m.* FROM models m WHERE m.id_brand = ".$device['id_brand'].";" or die("Error " . mysqli_error($link));
$models = $link->query($model_query);
?>
<html>
    <head>
        <title>Edit device</title>
        <?php include '../../template/_head.php' ?>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
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
                    <td><input type="numeber" id="imei" value = "<?php echo $device["imei"] ?>"</td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" value = "<?php echo $device["name"] ?>"></td>
                </tr>
                <tr>
                    <td>Branch:</td>
                    <td>
                        <select id="brand" onchange="updateModels(<?php $device['id_model']; ?>);">
                            <option value="null">---</option>
                            <?php while ($brand = mysqli_fetch_array($brands)) { ?>
                                <option value ="<?php echo $brand["id_brand"]; ?>"
                                <?php
                                if ($brand['id_brand'] === $device['id_brand']) {
                                    echo "selected='true'";
                                }
                                ?>>
                                            <?php echo $brand["name"]; ?>
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
                            <?php while ($model = mysqli_fetch_array($models)) { ?>
                                <option value="<?php echo $model['id_model']; ?>"
                                <?php
                                if ($model['id_model'] === $device['id_model']) {
                                    echo "selected='true'";
                                }
                                ?>>
                                            <?php echo $model['name']; ?>
                                </option>
                            <?php } ?>
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
            <button onclick="console.log('before error');
                updateDevice(
            <?php echo $device['id_device']; ?>, //id_device
                            document.getElementById('name').value, //name
                            document.getElementById('imei').value, //imei
                            document.getElementById('model').value, //id_model
                            document.getElementById('brand').value //id_brand
                            );" type="button" class="btn btn-primary" >
                Save changes
            </button>
        </span>
    </center>
</body>
</html>
