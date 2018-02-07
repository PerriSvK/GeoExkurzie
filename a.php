<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/post.css">
    <meta charset="UTF-8">
</head>
<body>
    <?php

    require "frame/Api.class.php";

    $api = new Api(require_once "Config.php");

    if(isset($_GET['p']))
    {
        echo $api->drawPost($_GET['p']);
    }

    if(isset($_GET['h']))
    {
        echo $api->drawPostByHash($_GET['h']);
    }

//    if($_GET['p'] != 0)
//        echo "<p style='text-align: center;'><a href='a.php?p=".($_GET['p']-1)."'> < Predchadzajuce</a></p>";
//
//    if(!$api->isLastPost($_GET['p']))
//        echo "<p style='text-align: center;'><a href='a.php?p=".($_GET['p']+1)."'>Dalej > </a></p>";

    ?>
</body>
</html>
