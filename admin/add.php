<?php
/**
 * Created by PhpStorm.
 * User: Perri
 * Date: 31. 1. 2018
 * Time: 14:02
 */

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
?>

<form method="post" action="index.php">
    <input type="hidden" name="hash" value="<?php echo $exk['hash']; ?>">
    Meno:<br>
    <input type="text" name="meno" value="<?php echo $exk['meno']; ?>">
    <br>
    Cena:<br>
    <input type="text" name="cena" value="<?php echo $exk['cena']; ?>">
    <br>
    Od:<br>
    <input type="text" name="od" value="<?php echo $exk['od']; ?>">
    <br>
    Do:<br>
    <input type="text" name="do" value="<?php echo $exk['do']; ?>">
    <br>
    Doprava:<br>
    <input type="text" name="doprava" value="<?php echo $exk['doprava']; ?>">
    <br>
    Popis:<br>
    <textarea name="popis" rows="5" cols="100"> <?php echo $exk['popis']; ?> </textarea>
    <br>
    Kapacita:<br>
    <input type="text" name="kapacita" value="<?php echo $exk['kapacita']; ?>">
    <br>
    Ubytovanie:<br>
    <input type="text" name="ubytovanie" value="<?php echo $exk['ubytovanie']; ?>">
    <br>
    Trvanie:<br>
    <input type="text" name="trvanie" value="<?php echo $exk['trvanie']; ?>">
    <br>
    Lokacia:<br>
    <input type="text" name="lokacia" value="<?php echo $exk['lokacia']; ?>">
    <br>
    <a href="index.php?novy=true">novy</a><br>
    <input type="submit" value="pridaj" name='pridaj'>
    </form>
