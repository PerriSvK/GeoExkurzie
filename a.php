<html>
<head>
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
    </style>
    <meta charset="UTF-8">
</head>
<body>
    <?php

    require "frame/Api.class.php";

    $api = new Api();

    if(isset($_GET['p']))
    {
        echo $api->drawPost($_GET['p']);
    }

    if($_GET['p'] != 0)
        echo "<p style='text-align: center;'><a href='a.php?p=".($_GET['p']-1)."'> < Predchadzajuce</a></p>";

    if(!$api->isLastPost($_GET['p']))
        echo "<p style='text-align: center;'><a href='a.php?p=".($_GET['p']+1)."'>Dalej > </a></p>";

    ?>
</body>
</html>
