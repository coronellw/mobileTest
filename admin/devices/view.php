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
            $device = mysqli_fetch_array($device_result);

            $tests_query = "SELECT t.* FROM tests t ORDER BY t.tag;";
            $tests = $link->query($tests_query);

            $resultados_result = "SELECT r.test_date, d.imei, e.name, e.description, s.name as status FROM "
                    . "results r, devices d, evaluations e, status s WHERE "
                    . "r.id_device = d.id_device AND "
                    . "r.id_evaluation = e.id_evaluation AND "
                    . "r.id_status_evaluation = s.id_status AND "
                    . "r.id_device = " . $device["id_device"] . " GROUP BY r.test_date ORDER BY r.test_date DESC;";
            $resultados = $link->query($resultados_result);

            function getInitials($string) {
                $words = explode(" ", $string);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= $w[0];
                }
                return $acronym;
            }
            ?>
            <center>
                <h1>Viewing device with imei : <?php echo $imei; ?></h1>
                <h2>Test performed</h2>
                <a href="/mobile/admin/" >Back to index</a>
                <br>
                <table class="stylish">
                    <?php if ($device['id_brand'] !== null) { ?>
                        <tr>
                            <td>
                                <label>Brand:</label>
                            </td>
                            <td>
                                <?php echo $device['brand_name'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($device['id_model'] !== null) { ?>
                        <tr>
                            <td>
                                <label>Model:</label>
                            </td>
                            <td>
                                <?php echo $device['model_name'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th><span class="minify">Date</span></th>
                            <th><span class="minify">Evaluation</span></th>
                            <th><span class="minify">Overall status</span></th>
                            <?php while ($test = mysqli_fetch_array($tests)) { ?>
                            <th><span class="minify vertical"><?php echo $test['tag'] ?></span></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($resultado = mysqli_fetch_array($resultados)) {
                            ?>
                            <tr>
                                <td><span class="minify"><?php echo $resultado["test_date"] ?></span></td>
                                <td><span class="evaluation minify"><?php echo $resultado["name"] ?> </span></td>
                                <td class="<?php echo $resultado["status"] ?> minify">
                                    <span>
                                        <?php echo $resultado["status"] ?>
                                    </span>
                                </td>
                                <?php getTestResult($resultado["test_date"], $device["id_device"]); ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </center>
        </div>
    </body>
</html>