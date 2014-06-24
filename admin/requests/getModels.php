<?php
$id_brand = filter_input(INPUT_GET, "id_brand");
$id_model = filter_input(INPUT_GET, "id_model");

include '../../db_info.php';
$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

$query = "SELECT m.id_model, m.name, m.model FROM models m WHERE id_brand = " . $id_brand . " ORDER BY m.model;" or die("Error " . mysqli_error($link));
$result = $link->query($query);

echo "<option value='null'>---</option>";
while ($model = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $model['id_model']; ?>"
    <?php if ($id_model !== null) {
        if($id_model === $model['id_model']){
            echo "selected='true'";
        }
    }
    ?>
            ><?php echo $model["model"] ?></option>
    <?php
}