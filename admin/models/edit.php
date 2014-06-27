<html>
    <head>
        <title>Update model</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

        $id_model = filter_input(INPUT_GET, "model");

        $model_query = "SELECT m.* FROM models m WHERE m.id_model = " . $id_model . ";" or die("Error " . mysqli_error($link));
        $result_model = $link->query($model_query);
        $model = mysqli_fetch_array($result_model);

        $brand_query = "SELECT b.* FROM brands b ORDER BY b.name;" or die("Error " . mysqli_error($link));
        $brands = $link->query($brand_query);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
        <script>
            function sendRequest() {
                var id = <?php echo $model['id_model']; ?>;
                var name = document.getElementById('name').value;
                var model = document.getElementById('model').value;
                var brand = document.getElementById('brand').value;
                var send = true, msg = "";
                
                if(name.length < 4){
                    msg += " - The model name is too short\n";
                }
                
                if (send) {
                    updateModel(id, name, model, brand);
                }else{
                    alert("Unable to edit model, please check the following errors\n"+msg);
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Edit brand</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="true" value="<?php echo $model['name']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Model:</label>
                            </td>
                            <td>
                                <input id="model" type="text" required="true" value="<?php echo $model['model']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Brand:</label>
                            </td>
                            <td>
                                <select id='brand'>
                                    <option value="null" >---</option>
                                    <?php while ($brand = mysqli_fetch_array($brands)) { ?>
                                        <option value="<?php echo $brand['id_brand'] ?>"
                                        <?php
                                        if ($model['id_brand'] === $brand['id_brand']) {
                                            echo "selected='true'";
                                        }
                                        ?>>
                                                    <?php echo $brand['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="sendRequest();" type="button" class="btn btn-primary" >
                            Save changes
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
