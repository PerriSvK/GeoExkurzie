<?php
    session_start();

    require "frame/Api.class.php"
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
    <?php
        $default_name = "";
        $default_pass = "";
        $status = 0;

        if(isset($_POST['a']) && $_POST['a'] == "login")
        {
            $api = new Api(require_once "./Config.php");

            if(isset($_POST['name']) && $_POST['name'] != "")
            {
                $default_name = $_POST['name'];
                $status++;
            }

            if(isset($_POST['pass']) && $_POST['pass'] != "")
            {
                $default_pass = $_POST['pass'];
                $status += 2;
            }

            if($status == 3)
            {
                if($api->loginUser($_POST['name'], hash("sha256", $_POST['pass'])))
                {
                    echo "Super! Budete prihlaseny!";
                    $_SESSION['token'] = $api->generateLoginToken($_POST['name']);
                    header("refresh:3;url=admin/");
                    die();
                }
                else
                {
                    $status = -1;
                }
            }

            switch($status)
            {
                case 1: echo "Heslo nemoze byt prazdne"; break;
                case 2: echo "Meno nemoze byt prazdne"; break;
                case -1: echo "Zle meno alebo heslo!"; break;
            }
        }
    ?>
    <form method="post">
        Meno: <input type="text" value="<?php echo $default_name; ?>" name="name"><br>
        Heslo: <input type="password" value="<?php echo $default_pass; ?>" name="pass"><br>
        <input type="hidden" name="a" value="login">
        <input type="submit" value="Prihlasit sa">
    </form>
    </body>
</html>