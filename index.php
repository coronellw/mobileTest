<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <title>Mobile testing app</title>
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <script type="text/javascript" src="js/checkDevise.js" ></script>
        <script type="text/javascript" src="js/customMouseEvents.js" ></script>
        <script type="text/javascript" src="js/testing.js"></script>
        <?php include 'template/_head.php'; ?>
    </head>
    <body>
        <?php
        include 'db_info.php';
        
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $query = "SELECT * FROM evaluations WHERE enable=1" or die("Error " . mysqli_error($link));
        $result = $link->query($query);
        
        $brands_query = "SELECT b.id_brand, b.name FROM brands b ORDER BY b.name;" or die("Error " . mysqli_error($link));
        $brands = $link->query($brands_query);
        ?>
        <center>
            <form action="test.php" method="get">
                Please enter the IMEI or ESN number.
                <table>
                    <tr>
                        <td>
                            <label>IMEI / ESN : </label>
                        </td>
                        <td>
                            <input id="imei" type="number" name="imei" value="<?php echo $imei ?>" onblur="searchDevice();" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Evaluation type:</label>
                        </td>
                        <td>
                            <select id="eval_type" name="eval_type">
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <option value="<?php echo $row['id_evaluation'] ?>"><?php echo $row["name"] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand:</label>
                        </td>
                        <td>
                            <select id="brand" onchange="updateModels();">
                                <option value="null">---</option>
                                <?php while($brand = mysqli_fetch_array($brands)){?>
                                <option value ="<?php echo $brand["id_brand"] ?>"><?php echo $brand["name"] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Model:</label>
                        </td>
                        <td>
                            <select id="model">
                                <option value="null">---</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="button" onclick="checkIMEI();">Start testing</button>
            </form>
        </center>
    </body>
</html>