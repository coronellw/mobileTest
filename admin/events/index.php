<html>
    <head>
        <title>Supported events</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error ".  mysqli_error($link));
        $events_query = "SELECT se.name, se.description FROM supported_events se;" ;
        $events = $link->query($events_query);
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css">
        <script src='/mobile/admin/js/helper.js'type="text/javascript"></script>
    </head>
    <body>
        <center>
            <h1>Supported events</h1>
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
                    while($event = mysqli_fetch_array($events)){
                    ?>
                    <tr>
                        <td><?php echo $event["name"] ?></td>
                        <td><?php echo $event["description"] ?></td>
                        <td>
                            <a href="#" >Edit</a>
                            <a href="#" >Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <span class="row"><span class="col-xs-3"><a href="#" >Create new supported event</a></span></span>.
        </center>
    </body>
</html>