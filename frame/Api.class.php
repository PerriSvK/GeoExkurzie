<?php

require "frame/DBUtil.class.php";

class Api
{
    var $db;
    var $config;
    var $posts;
    
    function __construct()
    {
        $this->config = require "Config.php";
        $this->db = new DBUtil($this->config['db_host'], $this->config['db_user'],
            $this->config['db_pass'], $this->config['db_name']);

        $this->posts = $this->db->getPosts();
    }

    function getPostCount()
    {
        return sizeof($this->posts);
    }

    function drawPost($pid)
    {
        $row =  $this->posts[$pid];
        $s = "
                <div style='text-align: center;'>
                    <h3>".$row['meno']."</h3>
                    <p><b>Lokacia:</b> ".$row['lokacia']."<b> Cena: </b>".$row['cena']."</p>
                    <p><b>Zaciatok: </b>".$row['od']. "<b> Koniec:</b> ".$row['do']."</p>
                    <p><b>Popis:</b> ".$row['popis']."</p>
                    <p><b>Ubytovanie:</b> ".$row['ubytovanie']."</p>
                </div><br>
                ";

        return $s;
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
}