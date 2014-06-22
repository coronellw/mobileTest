<html>
    <head>
        <title>Tests index</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $tests_query = "SELECT t.id_test, t.name, t.description, se.name as event FROM tests t, supported_events se WHERE t.action = se.id_event";
        
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
                        <th>Action</th>
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
                        <td><?php echo $test["event"] ?></td>
                        <td>
                            <a href="edit.php?test=<?php echo $test['id_test']; ?>">Edit</a>
                            <a href="#" onclick="if(confirm('Are you sure to edit this test?'))
                                deleteTest(<?php echo $test['id_test']; ?>);">Delete</a>
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
