<html>
    <head>
        <title>Create test</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
        
        $events_query = "SELECT se.id_event, se.name FROM supported_events se ORDER BY se.name;" or die ("Error ".  mysqli_error($link));
        $events = $link->query($events_query);
        
        $evaluations_query = "SELECT e.id_evaluation, e.name FROM evaluations e ORDER BY e.id_evaluation;" or die("Error ".  mysqli_error($link));
        $evaluations = $link->query($evaluations_query);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
    </head>
    <body>
        <center>
            <h1>Create new test</h1>
            <a href="/mobile/admin/" >Back to index</a>
            <form>
                <table class="stylish">
                    <tr>
                        <td>
                            <label>Name:</label>
                        </td>
                        <td>
                            <input type="text" required="true" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Action:</label>
                        </td>
                        <td>
                            <select required="true">
                                <?php while($event = mysqli_fetch_array($events)){ ?>
                                <option value="<?php echo $event["id_event"]; ?>" >
                                    <?php echo $event["name"]; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Evaluation:</label>
                        </td>
                        <td>
                            <select required="false">
                                <?php while($evaluation = mysqli_fetch_array($evaluations)){ ?>
                                <option value="<?php echo $evaluation["id_event"]; ?>" >
                                    <?php echo $evaluation["name"]; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tag name:</label>
                        </td>
                        <td>
                            <input type="text" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Description:</label>
                        </td>
                        <td>
                            <textarea placeholder="Please enter a small description of what this test do">
                                
                            </textarea>
                        </td>
                    </tr>
                </table>
                <span class="row" ><button type="submit" class="btn btn-primary" >Create new test</button></span>
            </form>
        </center>
    </body>
</html>
