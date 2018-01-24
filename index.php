<?php

session_start();

require_once "frame/Api.class.php";
require_once "frame/DBUtil.class.php";
$api = new Api(require_once "Config.php");

$logged = false;
$user = "";

if(isset($_SESSION['token']))
{
    if($api->isValidToken($_SESSION['token']))
    {
        $user = $api->getUserByToken($_SESSION['token']);
        $logged = true;
    }
}

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
            <?php if($logged) echo "[Logged: $user]"; else echo '<a href="login.php">[Administracia]</a></footer>'; ?>
    </body>
</html>
