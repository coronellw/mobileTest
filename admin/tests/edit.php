<html>
    <head>
        <title>Update test</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        
        $id_test = filter_input(INPUT_GET, "test");
        
        $test_query = "SELECT t.* FROM tests t WHERE t.id_test = ".$id_test.";" or die("Error ".  mysqli_error($link));
        $result_test = $link->query($test_query);
        $test = mysqli_fetch_array($result_test);

        $events_query = "SELECT se.id_event, se.name FROM supported_events se ORDER BY se.name;" or die("Error " . mysqli_error($link));
        $events = $link->query($events_query);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Create new test</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="true" value="<?php echo $test['name']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Action:</label>
                            </td>
                            <td>
                                <select required="true" id="action" >
                                    <?php while ($event = mysqli_fetch_array($events)) { ?>
                                        <option value="<?php echo $event["id_event"]; ?>" 
                                            <?php if($event['id_event'] === $test['action']){
                                                echo "selected = 'true'";
                                            } ?> >
                                            <?php echo $event["name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tag name:</label>
                            </td>
                            <td>
                                <input type="text" required="true" id="tag" value="<?php echo $test['tag'] ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" placeholder="Please enter a small description of what this test do"><?php echo $test['description']; ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="updateTest(
                                    <?php echo $test['id_test']; ?>,
                                    document.getElementById('name').value, 
                                    document.getElementById('action').value, 
                                    document.getElementById('description').value, 
                                    document.getElementById('tag').value
                                    );" type="button" class="btn btn-primary" >
                            Edit test
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
