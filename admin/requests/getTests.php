<?php
include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$date = filter_input(INPUT_GET, "fecha");
$id_device = filter_input(INPUT_GET, "id_device");

function getTestResult($fecha, $device) {
    global $link;

    $query = "SELECT t.id_test, s.name as status, t.name "
            . "FROM tests t LEFT OUTER JOIN results r ON r.id_test = t.id_test AND r.id_device = " . $device . " AND r.test_date = '" . $fecha . "' LEFT OUTER JOIN status s on r.id_status_test = s.id_status "
            . " ORDER BY t.tag";

    if (!mysqli_query($link, $query)) {
        die("Error: " . mysqli_error($link));
    }

    $result = $link->query($query);

    while ($row = mysqli_fetch_array($result)) {
        ?>
        <td class="singleResult <?php echo $row["status"] ?>" >
            <?php if ($row["status"] === "passed") {
                echo "OK";
            } else {
                if ($row['status'] === "failed") {
                    echo "Fail";
                } else {
                    echo "N/A";
                }
            } ?>
        </td>
        <?php
    }
}
