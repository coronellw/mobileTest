<html>
    <head>
        <title>Mobile test app</title>
        <?php 
        include_once '../../db_info.php'; 
        include_once '../../template/_head.php'; 
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css" >
        <script src="/mobile/admin/js/helper.js"></script>
    </head>
    <body>
        <?php
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

        $imei = filter_input(INPUT_GET, "imei");

        $device = "SELECT d.id_device, d.imei, d.last_use FROM devices d WHERE d.imei = " . $imei . " ORDER BY d.last_use DESC LIMIT 20";
        $device_result = $link->query($device);
        $row_dev = mysqli_fetch_array($device_result);

        $evaluations = "SELECT e.* FROM device d, device_evaluation de, evaluation e WHERE d.imei = " . $imei . " AND d.id_device = de.id_device AND de.id_evaluation = e.id_evaluation";
        $eval_result = $link->query($evaluations);

        $resultados = "SELECT r.test_date, d.imei, e.name, e.description, s.name as status FROM "
                . "results r, devices d, evaluations e, status s WHERE "
                . "r.id_device = d.id_device AND "
                . "r.id_evaluation = e.id_evaluation AND "
                . "r.id_status_evaluation = s.id_status AND "
                . "r.id_device = " . $row_dev["id_device"] . " GROUP BY r.test_date ORDER BY r.test_date DESC;";
        $resultados_result = $link->query($resultados);
        ?>
    <center>
        <h1>Viewing device with imei : <?php echo $imei; ?></h1>
        <h2>Test performed</h2>
        <a href="/mobile/admin/" >Back to index</a>
        <ol>
            <?php
            while ($row_resultados = mysqli_fetch_array($resultados_result)) {
                ?>
            <li><?php echo $row_resultados["test_date"] ?>
                <br><span class="evaluation"><?php echo $row_resultados["name"] ?> </span>-
                <a onclick="getEvaluationDetail('<?php echo $row_resultados["test_date"] ?>', <?php echo $row_dev["id_device"] ?>);" 
                   class="<?php echo $row_resultados["status"] ?>" href="#">
                    <?php echo $row_resultados["status"] ?>
                </a>
            </li>
                <?php
            }
            ?>
        </ol>
        
        <div class = "testResult">
            <table>
                <thead>
                    <tr>
                        <th>Test name</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                </tbody>
            </table>
        </div>
    </center>
</body>
</html>