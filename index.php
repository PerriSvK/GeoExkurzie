<?php

require "frame/Api.class.php";
$api = new Api();

?>

<html>
    <head>
        <title><?php echo $api->getTitle() ?></title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:400');
            p, h1, h2, h3, footer
            {
                font-family: 'Barlow Semi Condensed', sans-serif;
                font-weight: 400;
            }

            b
            {
                font-weight: 600;
            }

            iframe
            {
                width: 100%;
                height: 300px;
                overflow: hidden;
                border: none;
            }
        </style>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1 style='text-align: center;'><?php echo $api->getTitle() ?></h1><br>
        <br>
        <?php
            for($i = 0; $i < $api->getPostCount(); $i++)
            {
                echo "<iframe src='a.php?p=$i'></iframe>";
            }
        ?>
        <footer style='text-align: center;'>BackEnd version: <?php echo $api->getBEVer(); ?><br>
            <a href="login.php">[Administracia]</a></footer>
    </body>
</html>
