<html>
    <head>
        <title>Create brand</title>
        <?php
        include "../../template/_head.php";
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Create new brand</h1>
                <a href="/mobile/admin/" >Back to index</a>
                <form>
                    <table class="stylish">
                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input id="name" type="text" required="true" >
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" placeholder="Please enter a small description of what this new supported event do"></textarea>
                            </td>
                        </tr>
                    </table>
                    <span class="row" >
                        <button onclick="createNewBrand(
                                    document.getElementById('name').value, 
                                    document.getElementById('description').value
                                    );" type="button" class="btn btn-primary" >
                            Create brand
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
