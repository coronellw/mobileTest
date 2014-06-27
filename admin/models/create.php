<html>
    <head>
        <title>Create model</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $brands_query = "SELECT b.* FROM brands b ORDER BY b.name;";
        $brands = $link->query($brands_query);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
        <script>
            function sendRequest() {
                var name = document.getElementById('name').value;
                var model = document.getElementById('model').value;
                var brand = document.getElementById('brand').value;
                var send = true, msg = "";

                if (model.length < 4) {
                    msg += " - The model name is too short\n";
                }

                if (send) {
                    createNewModel(name, model, brand);
                }else{
                    alert("Unable to create this model, please check the following errors\n"+msg);
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Create new model</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="false" >
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Model:</label>
                            </td>
                            <td>
                                <input id="model" type="text" required="true" >
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Brand:</label>
                            </td>
                            <td>
                                <select id='brand'>
                                    <option value="null">---</option>
                                    <?php while ($brand = mysqli_fetch_array($brands)) { ?>
                                        <option value="<?php echo $brand['id_brand'] ?>">
                                            <?php echo $brand['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="sendRequest();" type="button" class="btn btn-primary" >
                            Create brand
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
