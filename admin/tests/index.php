<html>
    <head>
        <title>Tests index</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $tests_query = "SELECT t.name, t.description FROM tests t";
        
        $tests = $link->query($tests_query);
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
                        <th>Description</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($test = mysqli_fetch_array($tests)){
                    ?>
                    <tr>
                        <td><?php echo $test["name"] ?></td>
                        <td><?php echo $test["description"] ?></td>
                        <td>
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
