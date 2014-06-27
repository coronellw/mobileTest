<html>
    <head>
        <title>Update brand</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        
        $id_brand = filter_input(INPUT_GET, "brand");
        
        $brand_query = "SELECT b.* FROM brands b WHERE b.id_brand = ".$id_brand.";" or die("Error ".  mysqli_error($link));
        $result_brand = $link->query($brand_query);
        $brand = mysqli_fetch_array($result_brand);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
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
                                <input id="name" type="text" required="true" value="<?php echo $brand['name']; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" placeholder="Please enter a small description of what this test do"><?php echo $brand['description']; ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="updateBrand(
                                    <?php echo $brand['id_brand']; ?>,
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
