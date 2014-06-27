<html>
    <head>
        <title>Create test</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
    </head>
    <body>
        <div class="container">
            <center>
                <h1>Create new event</h1>
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
                        <button onclick="createNewEvent(
                                    document.getElementById('name').value, 
                                    document.getElementById('description').value
                                    );" type="button" class="btn btn-primary" >
                            Create event
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
