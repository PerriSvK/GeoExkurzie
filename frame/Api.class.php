<?php

require_once "DBUtil.class.php";

class Api
{
    /** @var DBUtil */
    var $db;
    var $config;
    var $posts;
    
    function __construct($config)
    {
        $this->config = $config;
        $this->db = new DBUtil();

        if(gethostname() != "PerriNB")
        {
            $this->db->connect($this->config['db_host'], $this->config['db_user_s'],
                $this->config['db_pass_s'], $this->config['db_name_s']);
        }
        else
        {
            $this->db->connect($this->config['db_host'], $this->config['db_user'],
                $this->config['db_pass'], $this->config['db_name']);
        }

        $this->posts = $this->db->getPosts();
    }

    function getPostCount()
    {
        return sizeof($this->posts);
    }

    function drawPostByHash($hash)
    {
        $v = 0;

        for($i = 0; $i < $this->posts; $i++)
        {
            if($this->posts[$i]['hash'] == $hash)
            {
                $v = $i;
                break;
            }
        }

        return $this->drawPost($v);
    }

    function drawPost($pid)
    {
        $row =  $this->posts[$pid];
        $s = "<div class='row'>
                <div class='column about'>
                    <h3>".$row['meno']."</h3>
                    <p><b>Lokacia:</b> ".$row['lokacia']."<b> Cena: </b>".$row['cena']."</p>
                    <p><b>Zaciatok: </b>".$row['od']. "<b> Koniec:</b> ".$row['do']."</p>
                    <p><b>Popis:</b> ".$row['popis']."</p>
                    <p><b>Ubytovanie:</b> ".$row['ubytovanie']."</p>
                </div><br>
                <div class='column'>
                ";

        $s .= $this->drawImage($pid);
        $s .= "</div></div>";

        return $s;
    }

    function drawImage($pid)
    {
        if($this->posts[$pid]['image'] != "" || $this->posts[$pid]['image'] != "none")
        {
            return "<img src='images/".$this->posts[$pid]['image']."' class='iimg'>";
        }
    }

    function isLastPost($pi)
    {
        return $pi == sizeof($this->posts)-1;
    }

    function getTitle()
    {
        return $this->config['title'];
    }

    function getBEVer()
    {
        return $this->config['backend_version'];
    }

    function loginUser($name, $pass)
    {
        return $this->db->getLoginData($name, $pass);
    }

    function generateLoginToken($name)
    {
        $hash = hash("sha256", $name.time());
        $this->db->setLoginToken($name, $hash);
        return $hash;
    }

    function isValidToken($token)
    {
        return $this->db->isValidToken($token);
    }

    function getUserByToken($token)
    {
        return $this->db->getUserByToken($token);
    }

    function addExk($arr)
    {
        $a = array();

        $a[]=(isset($_POST['hash']) && $_POST['hash'] != "") ? $_POST['hash'] : $this->generateNewHash();
        $a[]=$arr['meno'];
        $a[]=$arr['cena'];
        $a[]=$arr['od'];
        $a[]=$arr['do'];
        $a[]=$arr['doprava'];
        $a[]=$arr['popis'];
        $a[]=$arr['kapacita'];
        $a[]=$arr['ubytovanie'];
        $a[]=$arr['trvanie'];
        $a[]=$arr['lokacia'];

        $this->db->addPost($a);
    }

    function generateNewHash()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function deleteExk($hash)
    {
        $this->db->deletePost($hash);
    }

    function editExk($post)
    {
        $this->deleteExk($post['hash']);
        $this->addExk($post);
    }

    function getPost($hash)
    {
        echo "a";
        for($i = 0; $i < sizeof($this->posts); $i++)
        {
            echo "b";
            if($this->posts[$i]['hash'] == $hash)
                return $this->posts[$i];
        }

        echo "g";
        return $this->posts;
    }
}