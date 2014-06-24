<html>
    <head>
        <title>View evaluation</title>
        <?php
        include '../../db_info.php';
        include '../../template/_head.php';
        include "../requests/getTests.php";
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css" >
        <script src="/mobile/admin/js/helper.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

            $id_evaluation = filter_input(INPUT_GET, "evaluation");

            $evaluation_query = "SELECT e.* FROM evaluations e WHERE e.id_evaluation = " . $id_evaluation . ";" or die("Error " . mysqli_error($link));
            $evalulation_result = $link->query($evaluation_query);
            $evaluation = mysqli_fetch_array($evalulation_result);

            $tests_query = "SELECT t.* FROM tests t, evaluation_test et WHERE t.id_test = et.id_test AND et.id_evaluation = " . $id_evaluation;
            $tests = $link->query($tests_query);
            $tests_array = array();
            ?>
            <center>
                <h1>Viewing evaluation</h1>
                <h2>Tests performed</h2>
                <a href="/mobile/admin/" >Back to index</a>
                <br>
                <table class="stylish">
                    <tr>
                        <td>
                            <label>name:</label>
                        </td>
                        <td>
                            <?php echo $evaluation['name'] ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Status:</label>
                        </td>
                        <td>
                            <?php
                            if ($evaluation['enable'] === '1') {
                                echo "enabled";
                            } else {
                                echo "disabled";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Time:</label>
                        </td>
                        <td>
                            <?php echo $evaluation['time'] ?>
                        </td>
                    </tr>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th>Test name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($test = mysqli_fetch_array($tests)) { ?>
                            <tr>
                                <td><?php echo $test["name"] ?></td>
                                <td><?php echo $test["description"] ?></td>
                            </tr>
                        <?php 
                        $test_array[] = $test;
                        } ?>
                    </tbody>
                </table>
                <span class="row">
                    <a class="btn btn-primary" href="edit.php?evaluation=<?php echo $evaluation['id_evaluation'] ?>" >Edit this evaluation</a>
                </span>
            </center>
        </div>
    </body>
</html>