<html>
    <head>
        <title>Supported events</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';

        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $events_query = "SELECT se.id_event, se.name, se.description FROM supported_events se;";
        $events = $link->query($events_query);
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css">
        <script src='/mobile/admin/js/helper.js'type="text/javascript"></script>
    </head>
    <body>
    <center>
        <h1>Supported events</h1>
        <h2>Are used by the tests to complete an evaluation</h2>
        <p>The supported events are the pieces of codes that are supported by javascript in order to be evaluated when using the devices</p>
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
                while ($event = mysqli_fetch_array($events)) {
                    ?>
                    <tr>
                        <td><?php echo $event["name"] ?></td>
                        <td><?php echo $event["description"] ?></td>
                        <td>
                            <a href="edit.php?event=<?php echo $event['id_event'] ?>" >Edit</a>
                            <a href="#"
                               onclick="if (confirm('this will also delete tests that conatins this event.\nARE YOU SURE TO DELETE THIS EVENT?')) {
                                               console.log('EVENT WILL BE DELETED');
                                               deleteEvent(<?php echo $event['id_event'] ?>);
                                           }"
                               >Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <span class="row"><a href="create.php" class="btn btn-primary" >Create new supported event</a></span>.
    </center>
</body>
</html>