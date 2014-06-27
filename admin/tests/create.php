<html>
    <head>
        <title>Create test</title>
        <?php
        include "../../template/_head.php";
        include '../../db_info.php';
        $link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));

        $events_query = "SELECT se.id_event, se.name FROM supported_events se ORDER BY se.name;" or die("Error " . mysqli_error($link));
        $events = $link->query($events_query);

        $evaluations_query = "SELECT e.id_evaluation, e.name FROM evaluations e ORDER BY e.id_evaluation;" or die("Error " . mysqli_error($link));
        $evaluations = $link->query($evaluations_query);
        ?>
        <link rel="stylesheet" type="text/css" href="/mobile/admin/css/admin.css">
        <script src="/mobile/admin/js/helper.js" type="text/javascript" ></script>
        <script src="/mobile/js/jquery.maskedinput.js" type="text/javascript" ></script>
        <script>
            jQuery(function() {
                jQuery('#tag').mask("aaa?aaaaa", {placeholder: " "});
            });
            
            function sendRequest() {
                var name = document.getElementById('name').value;
                var action = document.getElementById('action').value;
                var description = document.getElementById('description').value;
                var txt = document.getElementById('tag').value;
                var evaluation = document.getElementById('evaluation').value;
                var tag = /[a-z]{3,8}/g.exec(txt), send = true, msg = "";
                
                if (name.length < 4) {
                    msg += " - Name is too short\n";
                }
                
                if (tag === null) {
                    send = false;
                    msg += " - Tag didn't meet the required criteria\n";
                }
                
                alert(tag);
                if (send) {
                    createNewTest(name, action, description, txt, evaluation);
                } else {
                    alert("The following errors were enocuntered...\n"+msg);
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
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
                                <input id="name" type="text" required="true" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Action:</label>
                            </td>
                            <td>
                                <select required="true" id="action" >
                                    <?php while ($event = mysqli_fetch_array($events)) { ?>
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
                                <select required="false" id="evaluation">
                                    <option value="null">---</option>
                                    <?php while ($evaluation = mysqli_fetch_array($evaluations)) { ?>
                                        <option value="<?php echo $evaluation['id_evaluation']; ?>" >
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
                                <input type="text" required="true" id="tag" 
                                       onfocus="document.getElementById('tip').style.display = 'block';"
                                       onblur="document.getElementById('tip').style.display = 'none';">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Description:</label>
                            </td>
                            <td>
                                <textarea id="description" rows="5" placeholder="Please enter a small description of what this test do"></textarea>
                            </td>
                        </tr>
                    </table>
                    <div id="tip" style="display: none;" ><b>Tag: </b>Must have from 3 to 8 letters all lowercase, no space or numbers allowed</div>
                    <span class="row" >
                        <button onclick="sendRequest();" type="button" class="btn btn-primary" >
                            Create new test
                        </button>
                    </span>
                </form>
            </center>
        </div>
    </body>
</html>
