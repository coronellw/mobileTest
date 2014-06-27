<html>
    <head>
        <title>Update test</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        
        $id_event = filter_input(INPUT_GET, "event");
        
        $event_query = "SELECT se.* FROM supported_events se WHERE se.id_event = ".$id_event.";" or die("Error ".  mysqli_error($link));
        $result_event = $link->query($event_query);
        $event = mysqli_fetch_array($result_event);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Edit event</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="true" value="<?php echo $event['name']; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" placeholder="Please enter a small description of what this test do"><?php echo $event['description']; ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="updateEvent(
                                    <?php echo $event['id_event']; ?>,
                                    document.getElementById('name').value, 
                                    document.getElementById('description').value
                                    );" type="button" class="btn btn-primary" >
                            Save changes
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
