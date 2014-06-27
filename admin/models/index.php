<html>
    <head>
        <title>Models index</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $models_query = "SELECT m.id_model, m.name as model_name, m.model, b.name as brand_name FROM models m, brands b WHERE m.id_brand = b.id_brand ORDER BY b.name;" or die("Error ".$mysqli_error($link));

        $models = $link->query($models_query);
        ?>
        <link href="../css/admin.css" type="text/css" rel="stylesheet">
        <script src="../js/helper.js" ></script>
    </head>
    <body>
    <center>
        <h1>Tests</h1>
        <a href="/mobile/admin/" >Back to index</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($model = mysqli_fetch_array($models)) {
                    ?>
                    <tr>
                        <td><?php echo $model["model_name"] ?></td>
                        <td><?php echo $model["model"] ?></td>
                        <td><?php echo $model["brand_name"] ?></td>
                        <td>
                            <a href="edit.php?model=<?php echo $model['id_model']; ?>">Edit</a>
                            <a href="#" onclick="if (confirm('Are you sure to delete this model?'))
                                            deleteModel(<?php echo $model['id_model']; ?>);">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <span class="row"><a href="create.php" class="btn btn-primary">Create new test</a></span>
    </center>
</body>
</html>
