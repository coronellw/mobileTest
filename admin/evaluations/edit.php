<html>
    <head>
        <?php
        include '../../db_info.php';
        include '../../template/_head.php';

        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $id_evaluation = filter_input(INPUT_GET, "evaluation");

        $evaluation_query = "SELECT e.* FROM evaluations e WHERE e.id_evaluation = " . $id_evaluation . ";" or die("Error " . $mysqli_error($link));
        $evaluation_result = $link->query($evaluation_query);
        $evaluation = mysqli_fetch_array($evaluation_result);

        $tests_query = "SELECT t.*, et.id_evaluation FROM tests t LEFT OUTER JOIN evaluation_test et ON t.id_test = et.id_test AND et.id_evaluation =" . $id_evaluation . "  ORDER BY t.id_test;" or die("Error " . mysqli_error($link));
        $tests = $link->query($tests_query);

        $test_array = array();
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
        <script>
            function getTestsAndSendRequest(tests) {
                var filter_tests = [];
                for (var test in tests) {
                    tests[test].save = document.getElementById(tests[test].tag).checked === true ? true : false;
                    filter_tests.push({"id_test": tests[test].id_test, "save": tests[test].save, "id_evaluation": tests[test].id_evaluation});
                }

                updateEvaluation(
<?php echo $evaluation['id_evaluation'] ?>,
                        document.getElementById('name').value,
                        document.getElementById('description').value,
                        document.getElementById('time').value,
                        filter_tests
                        );
            }
        </script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Create new evaluation type</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="true" value="<?php echo $evaluation['name']; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Time:</label>
                            </td>
                            <td>
                                <input id="time" type="number" required="false" value="<?php echo $evaluation['time']; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" cols="23" placeholder="Please enter a small description of what this evaluation will do"><?php echo $evaluation['description']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Status:</label>
                            </td>
                            <td>
                                <a href="#" onclick="toggleEvaluation(<?php echo $evaluation["id_evaluation"] ?>, {redirect: false});" class="<?php
                                if ($evaluation['enable'] === '1') {
                                    echo "label label-danger";
                                } else {
                                    echo "label label-success";
                                }
                                ?>"><?php
                                       if ($evaluation['enable'] === '1') {
                                           echo "Disable";
                                       } else {
                                           echo "Enable";
                                       }
                                       ?></a>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <p>You can optionally add some tests that must be passed to complete this evaluation successfully</p>
                        <div class="col-xs-12">
                            <?php
                            while ($test = mysqli_fetch_array($tests)) {
                                $tests_array[] = $test;
                                ?>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" id="<?php echo $test['tag'] ?>"
                                                   value="<?php echo $test['id_test'] ?>" 
                                                   <?php
                                                   if ($test['id_evaluation'] === $evaluation['id_evaluation']) {
                                                       echo 'checked';
                                                   }
                                                   ?>>
                                        </span>
                                        <label class="form-control"><?php echo $test['name'] ?></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </span>
                    <br>
                    <br>
                    <span class="row" >
                        <button onclick='getTestsAndSendRequest(<?php echo json_encode($tests_array) ?>)' type="button" class="btn btn-primary" >
                            Save changes
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
