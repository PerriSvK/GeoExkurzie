<?php

class DBUtil
{
    /** @var  mysqli */
    private $db;

    public function connect($h, $u, $p, $n)
    {
        $this->db = new mysqli($h, $u, $p, $n);

        if($this->db->errno)
            return false;

        mysqli_set_charset($this->db, "utf8");
        return true;
    }

    public function getPosts()
    {
        $res = $this->db->query("SELECT * FROM zajazdy ORDER BY od DESC");

        if($this->db->errno)
            die($this->db->error);

        $val = [];

        while($row = $res->fetch_assoc())
            $val[] = $row;

        return $val;
    }

    public function getLoginData($u, $p)
    {
        $res = $this->db->query("SELECT COUNT(*) AS total FROM g_users WHERE name='$u' AND pass='$p'");

        return $res->fetch_assoc()['total'] == 1;
    }

    public function setLoginToken($name, $token)
    {
        $this->db->query("DELETE FROM tokens WHERE name='$name'");
        $this->db->query("INSERT INTO tokens(token, name) VALUES ('$token', '$name');");
    }

    public function isValidToken($token)
    {
        $res = $this->db->query("SELECT COUNT(*) as total FROM tokens WHERE token = '$token'");
        $poc = $res->fetch_assoc();
        return $poc['total'] > 0;
    }

    public function getUserByToken($token)
    {
        $res = $this->db->query("SELECT name FROM tokens WHERE token = '$token' LIMIT 1");
        $poc = $res->fetch_assoc();
        return $poc['name'];
    }

    public function addPost($aa)
    {
        $sql = "INSERT INTO zajazdy VALUES(";

        for($i = 0; $i < sizeof($aa); $i++)
        {
            $sql .= "'".$aa[$i]."'";

            if($i < sizeof($aa)-1)
                $sql .= ", ";
        }

        $sql .= ");";

        $this->db->query($sql);

        if($this->db->errno)
            echo $this->db->error;
    }

    public function deletePost($hash)
    {
        $this->db->query("DELETE FROM `zajazdy` WHERE hash='$hash'");

        if($this->db->errno)
            echo $this->db->error;
    }
}