<?php

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
$date = filter_input(INPUT_POST, "fecha");
$id_device = filter_input(INPUT_POST, "id_device");

$query = "SELECT r.test_date, d.imei, s.name as status, t.name, t.description, e.name as evaluation "
        . "FROM results r, devices d, evaluations e, tests t, status s "
        . "WHERE r.id_evaluation = e.id_evaluation AND "
        . "r.id_device = d.id_device AND "
        . "r.id_test = t.id_test AND "
        . "r.id_status_test = s.id_status AND "
        . "r.test_date = '" . $date . "' AND "
        . "r.id_device = " . $id_device;

if (!mysqli_query($link, $query)) {
    die("Error: " . mysqli_error($link));
}

$result = $link->query($query);

while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["description"] ?></td>
        <td class="<?php echo $row["status"] ?>"><?php echo $row["status"] ?></td>
    </tr>
    <?php

}