<?php
include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$date = filter_input(INPUT_GET, "fecha");
$id_device = filter_input(INPUT_GET, "id_device");

function getTestResult($fecha, $device) {
    global $link;

    $query = "SELECT t.id_test, r.test_date, d.imei, s.name as status, t.name, t.description, e.name as evaluation "
            . "FROM results r, devices d, evaluations e, tests t, status s "
            . "WHERE r.id_evaluation = e.id_evaluation AND "
            . "r.id_device = d.id_device AND "
            . "r.id_test = t.id_test AND "
            . "r.id_status_test = s.id_status AND "
            . "r.test_date = '" . $fecha . "' AND "
            . "r.id_device = " . $device ." ORDER BY t.id_test ASC";

    if (!mysqli_query($link, $query)) {
        die("Error: " . mysqli_error($link));
    }

    $result = $link->query($query);

    while ($row = mysqli_fetch_array($result)) {
        ?>
        <td class="singleResult <?php echo $row["status"] ?>" >
            <?php echo $row["name"] ?>
        </td>
        <?php
    }
}
