<html>
    <head>
        <title>Evaluations index</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

        $evaluations_query = "SELECT e.id_evaluation, e.name, e.description, e.time, e.enable FROM evaluations e ORDER BY e.enable DESC;";
        $evaluations = $link->query($evaluations_query);
        ?>
        <link href="../css/admin.css" type="text/css" rel="stylesheet">
        <script src="../js/helper.js" ></script>
    </head>
    <body>
    <center>
        <h1>Evaluations</h1>
        <h2>Evaluations performs test</h2>
        <p>An evaluation performs multiple tests, you can see which tests are related to an evaluation by clicking on view</p>
        <a href="/mobile/admin/" >Back to index</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($eval = mysqli_fetch_array($evaluations)) {
                    ?>
                    <tr>
                        <td><?php echo $eval["name"] ?></td>
                        <td><?php echo $eval["description"] ?></td>
                        <td><?php echo $eval["time"] ?></td>
                        <td>
                            <a href="view.php?evaluation=<?php echo $eval['id_evaluation'] ?>">View</a>
                            <a href="edit.php?evaluation=<?php echo $eval['id_evaluation'] ?>">Edit</a>
                            <a href="#" onclick="toggleEvaluation(<?php echo $eval["id_evaluation"] ?>);" class="<?php if ($eval['enable'] === '1') {
                            echo "label label-danger";
                        } else {
                            echo "label label-success";
                        } ?>"><?php if ($eval['enable'] === '1') {
                            echo "Disable";
                        } else {
                            echo "Enable";
                        } ?></a>
                        </td>
                    </tr>
    <?php
}
?>
            </tbody>
        </table>
        <span class="row">
            <a href="create.php" class="btn btn-primary" >Create new evaluation</a>
        </span>
    </center>
</body>
</html>
