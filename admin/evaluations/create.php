<html>
    <head>
        <title>Create evaluation</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

        $tests_query = "SELECT t.* FROM tests t ORDER BY t.id_test;" or die("Error " . mysqli_error($link));
        $tests = $link->query($tests_query);

        $tests_array = array();
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
        <script>
            function getTestsAndSendRequest(tests) {
                var choosen = [];
                // console.dir(tests);
                for (var test in tests) {
                    if (document.getElementById(tests[test].tag).checked === true) {
                        choosen.push(tests[test].id_test);
                    }
                }

                createNewEvaluation(
                        document.getElementById('name').value,
                        document.getElementById('description').value,
                        document.getElementById('time').value,
                        choosen
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
                                <input id="name" type="text" required="true" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Time:</label>
                            </td>
                            <td>
                                <input id="time" type="number" required="false">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" cols="23" placeholder="Please enter a small description of what this evaluation will do"></textarea>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <p>You can optionally add some tests that must be passed to complete this evaluation successfully</p>
                        <div class="col-xs-12">
                            <?php while ($test = mysqli_fetch_array($tests)) {
                                $tests_array[] = $test;
                                ?>
                                <div class="col-xs-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" id="<?php echo $test['tag'] ?>"
                                                   value="<?php echo $test['id_test'] ?>" >
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
                            Create new test
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
