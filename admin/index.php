<html>
    <head>
        <?php
        include '../template/_head.php';
        include '../db_info.php';
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css" >
        <script src="/mobile/admin/js/helper.js"></script>
    </head>

    <body>
    <center>
        <table>
            <thead>
                <tr>
                    <th>IMEI</th>
                    <th>Last test</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
            <h1>General list of current devices</h1>
            <h2>Choose an option to get more details about the devices</h2>
            <?php
            $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
            $query = "SELECT d.id_device ,d.imei as imei, d.last_use as last_use FROM devices d ORDER BY d.last_use DESC";
            $result = $link->query($query);
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td>
                        <?php echo $row["imei"] ?>
                    </td>
                    <td>
                        <?php echo $row["last_use"] ?>
                    </td>
                    <td>
                        <a href="/mobile/admin/devices/view.php?imei=<?php echo $row["imei"]; ?>">View</a>
                        <a href="/mobile/admin/devices/edit.php?imei=<?php echo $row["imei"]; ?>">Edit</a>
                        <a href="#" onclick="if (confirm('Are you sure you want to delete this device?')) {
                                        deleteDevice(<?php echo $row["id_device"]; ?>);
                                    }" >Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <span class='row'>
            <span class='col-xs-4'>
                <a href="evaluations/" class="btn btn-primary">Evaluations</a>
            </span>
            <span class='col-xs-4'>
                <a href="tests/" class="btn btn-primary">Tests</a>
            </span>
            <span class="col-xs-4">
                <a href="events/" class="btn btn-primary">Supported events</a>
            </span>
        </span>
    </center>
</body>
</html>