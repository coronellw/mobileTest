<html>
    <head>
        <title>Evaluations index</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        
        $evaluations_query = "SELECT e.name, e.description, e.time FROM evaluations e;";
        $evaluations = $link->query($evaluations_query);
        ?>
        <link href="../css/admin.css" type="text/css" rel="stylesheet">
        <script src="../js/helper.js" ></script>
    </head>
    <body>
        <center>
            <h1>Evaluations</h1>
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
                    while($eval = mysqli_fetch_array($evaluations)) {
                    ?>
                    <tr>
                        <td><?php echo $eval["name"] ?></td>
                        <td><?php echo $eval["description"] ?></td>
                        <td><?php echo $eval["time"] ?></td>
                        <td>
                            <a href="#">View</a>
                            <a href="#">Edit</a>
                            <a href="#">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </center>
    </body>
</html>
