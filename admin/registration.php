<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include '../template/_head.php'; ?>
        <title>Mobile app - Sign in</title>
        <link href="../css/signin.css" type="text/css" rel="stylesheet">

    </head>

    <body>
        <div class="container">
            <?php
            include './partials/messages.php';
            if (!isset($_SESSION['user'])) {
                ?>
                <form action="requests/createUser.php" method="POST">
                    <table>
                        <tr>
                            <td>
                                <label>First name:</label>
                            </td>
                            <td>
                                <input name="first" id="first" type="text" 
                                       placeholder="name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Last name:</label>
                            </td>
                            <td>
                                <input name="last" id="last" type="text" 
                                       placeholder="last name" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username:</label>
                            </td>
                            <td>
                                <input name="username" id="username" type="text" 
                                       placeholder="username" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password:</label>
                            </td>
                            <td>
                                <input name="password" id="password" 
                                       type="password" placeholder="password"
                                       required autocomplete="false">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Confirm password:</label>
                            </td>
                            <td>
                                <input name="password_verification" 
                                       id="password_verification" 
                                       type="password" 
                                       placeholder="password verification"
                                       required autocomplete="false">
                            </td>
                        </tr>
                    </table>
                    <button type="submit">Finish registration</button>
                </form>
                <?php
            } else {
                ?>
                <div>This option is only available for admins, please <a href="login.php">login</a> in order to register a new user </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>
