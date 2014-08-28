<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
        <?php
            include 'db_info.php';
            $id_device = filter_input(INPUT_POST, "id_device");
            $evaluation = filter_input(INPUT_POST, "evaluation");
            $fecha = filter_input(INPUT_POST, "fecha");
        ?>
        <script>
            var device = <?php echo $id_device ?>;
            var evaluation = <?php echo $evaluation ?>;
            var fecha = <?php echo $fecha ?>;
        </script>
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/hammer.min.js"></script>
        <script type="text/javascript" src="/js/screenTest.js"></script>
        <link rel="stylesheet" href="/css/main.css" type="text/css" >
        <link rel="stylesheet" href="/css/alter.css" type="text/css" >
    </head>
    <body>
        <div id="can"></div>
    </body>
</html>