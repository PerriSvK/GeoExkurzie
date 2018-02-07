<?php
session_start();

require_once "../frame/DBUtil.class.php";
require "../frame/Api.class.php";
$api = new Api(require_once "../Config.php");

$logged = false;
$user = "";

if (isset($_SESSION['token'])) {
    if ($api->isValidToken($_SESSION['token'])) {
        $user = $api->getUserByToken($_SESSION['token']);
        $logged = true;
    }
}

if (!$logged)
    header("refresh:0;url=/GeoExkurzie/");

$exk = isset($_GET['hash']) ? $api->getPost($_GET['hash']) : null;

if(isset($_POST['pridaj']))
    $api->addExk($_POST);

if(isset($_POST['upravit']))
    $api->editExk($_POST);

if(isset($_POST['vymazat']))
    $api->deleteExk($_POST['hash'])
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-16">
    <title>GE - Admin</title>
    <style>
        table {
            border-collapse: collapse;
            text-align: center;
            font-family: 'Amatic SC', cursive;
            float:right;
            margin:0%;
            position: relative;
            right:5%;
            background-color: white;
        }
        table, th, td {
            border: 1px solid black;
            width:30%;
        }
        th {
            height: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        td{
            width:20%;
        }

        input[type=text], select {
            padding: 8px 10px;
            margin: 4px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            color:white;
            font-size:400%;
            font-family: 'Amatic SC', cursive;
            margin:0%;
            width:100%;
            background-color:rgb(6,94,102);
        }
        h2 {
            text-align: right;
            font-size:200%;
            font-family: 'Amatic SC', cursive;
            margin:0.5%;
            position: relative;
            right:10%;
        }
        a{
            text-decoration:none;
        }
        .text{
            width:100%;
        }
        div{
            position: relative;
            left:5%;
            margin-right:60%;
            margin-bottom:5%;
            padding:5%;
            background-color:rgb(28,163,163);
        }
        div.a{
            margin-right:20%;
            background-color:white;
        }
        div.b{
            margin-right:20%;
            background-color:white;
        }
        body{
            background-color: rgb(255,208,161);
        }
        .button{
            background-color: rgb(6,94,102);
            border:2px solid white;
            color: white;
            padding: 10px 15px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            position:relative;
            left:10%;
        }

        .iinfo
        {
            width: 100%;
            height: 300px;
            border: 0;
        }
    </style>
</head>
<body>
<h1> Admin </h1>
<h2>Vyber zajazd:</h2>
    <table>
        <tr>
            <th>hash</th>
            <th>meno</th>
        </tr>
        <?php
            foreach ($api->db->getPosts() as $post)
            {
                echo "<tr><td>" .$post['hash'] . "</td><td><a href='index.php?hash=" . $post['hash'] . "'>" . $post['meno'] . "</a></tr></td>";
            }
        ?>
   </table>
    <?php
    if(isset($_GET['hash']))
        echo "<iframe src='../a.php?h=".$_GET['hash']."' class='iinfo'></iframe>";
    ?>
<form method="post" action="index.php">
<div>
    <div class="a">Meno:<br>
        <input type="hidden" name="hash" value="<?php echo $exk['hash']; ?>">
        <input type="text" name="meno" value="<?php echo $exk['meno']; ?>"><br>
        Cena:<br><input type="text" name="cena" value="<?php echo $exk['cena']; ?>">
        <i class="fa fa-euro"></i>
        <br>
        Od:<br>
        <input type="text" name="od" value="<?php echo $exk['od']; ?>">
        <br>
        Do:<br>
        <input type="text" name="do" value="<?php echo $exk['do']; ?>">
        <br></div>
    <div class="b"> Doprava:<br>
        <input type="text" name="doprava" value="<?php echo $exk['doprava']; ?>">
        <i class="fa fa-car"></i>
        <br>
        Kapacita:<br>
        <input type="text" name="kapacita" value="<?php echo $exk['kapacita']; ?>">
        <br>
        Ubytovanie:<br>
        <input type="text" name="ubytovanie" value="<?php echo $exk['ubytovanie']; ?>">
        <br>
        Trvanie:<br>
        <input type="text" name="trvanie" value="<?php echo $exk['trvanie']; ?>">
        <i class="fa fa-clock-o"></i>
        <br>
        Lokacia:<br>
        <input type="text" name="lokacia" value="<?php echo $exk['lokacia']; ?>">
        <br></div>
    Popis:<br>
    <textarea name="popis" rows="10" cols="60" class="text"> <?php echo $exk['popis']; ?> </textarea></div>
<br>
<input type="submit" class="button" value="pridaj" name='pridaj'>
<input type="submit" class="button" value="upravit" name='upravit'>
<input type="submit" class="button" value="vymazat" name='vymazat'>
</form>
</body>
</html>
