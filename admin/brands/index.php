<html>
    <head>
        <title>Supported events</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';

        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        $brands_query = "SELECT b.id_brand, b.name, b.description FROM brands b ORDER BY b.name;" or die("Error " . mysqli_error($link));
        $brands = $link->query($brands_query);
        ?>
        <link href="/mobile/admin/css/admin.css" rel="stylesheet" type="text/css">
        <script src='/mobile/admin/js/helper.js'type="text/javascript"></script>
    </head>
    <body>
    <center>
        <h1>Brands</h1>
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
                while ($brand = mysqli_fetch_array($brands)) {
                    ?>
                    <tr>
                        <td><?php echo $brand["name"] ?></td>
                        <td><?php echo $brand["description"] ?></td>
                        <td>
                            <a href="edit.php?brand=<?php echo $brand['id_brand'] ?>" >Edit</a>
                            <a href="#"
                               onclick="if (confirm('this will also delete models that belongs to this brand.\nARE YOU SURE TO DELETE THIS BRAND?')) {
                                               console.log('BRAND WILL BE DELETED');
                                               deleteBrand(<?php echo $brand['id_brand'] ?>);
                                           }"
                               >Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <span class="row"><a href="create.php" class="btn btn-primary" >Create new brand</a></span>.
    </center>
</body>
</html>