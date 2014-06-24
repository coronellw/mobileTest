<html>
    <head>
        <title>Mobile test app</title>
        <?php
        include_once '../../db_info.php';
        include_once '../../template/_head.php';
        include_once "../requests/getTests.php";
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css" >
        <script src="/mobile/admin/js/helper.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

            $imei = filter_input(INPUT_GET, "imei");

            $device = "SELECT d.*, b.id_brand, b.name as brand_name, m.id_model, m.name as model_name FROM devices d left outer join brands b on d.id_brand = b.id_brand left outer join models m on d.id_model = m.id_model WHERE d.imei = " . $imei . " ORDER BY d.last_use DESC LIMIT 20;" or die("Error " . mysqli_error($link));
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
                <br>
                <table class="stylish">
                    <?php if ($row_dev['id_brand'] !== null) { ?>
                        <tr>
                            <td>
                                <label>Brand:</label>
                            </td>
                            <td>
                                <?php echo $row_dev['brand_name'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($row_dev['id_model'] !== null) { ?>
                        <tr>
                            <td>
                                <label>Model:</label>
                            </td>
                            <td>
                                <?php echo $row_dev['model_name'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Evaluation</th>
                            <th>Overall status</th>
                            <th colspan="100">Tests</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_resultados = mysqli_fetch_array($resultados_result)) {
                            ?>
                            <tr>
                                <td><?php echo $row_resultados["test_date"] ?></td>
                                <td><span class="evaluation"><?php echo $row_resultados["name"] ?> </span></td>
                                <td class="<?php echo $row_resultados["status"] ?>">
                                    <span>
                                        <?php echo $row_resultados["status"] ?>
                                    </span>
                                </td>

                                <?php getTestResult($row_resultados["test_date"], $row_dev["id_device"]); ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div class = "testResult" style="display: none;">
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
        </div>
    </body>
</html>