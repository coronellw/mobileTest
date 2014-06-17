<html>
    <head>
        <meta charset="UTF-8">
        <?php
//            include '../template/_head.php'; 
            include '../db_info.php';
        ?>
        <style>
            table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            td, th {
                border: 1px solid black;
                padding: 0 10px;
            }
        </style>
    </head>

    <body>
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
                <?php
                  $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
                  $query = "SELECT d.imei as imei, d.last_use as last_use FROM devices d ORDER BY d.last_use DESC";
                  $result = $link->query($query);
                  while($row = mysqli_fetch_array($result)){
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
                        <a href="#delete=<?php echo $row["imei"]; ?>">Delete</a>
                    </td>
                </tr>
            <?php
              }
            ?>
            </tbody>
        </table>
    </body>
</html>