<?php
$id_brand = filter_input(INPUT_GET, "id_brand");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "SELECT m.id_model, m.name, m.model FROM models m WHERE id_brand = " . $id_brand . " ORDER BY m.model;" or die("Error " . mysqli_error($link));
$result = $link->query($query);
while ($brand = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $brand['id_model']; ?>"><?php echo $brand["model"] ?></option>
<?php
}