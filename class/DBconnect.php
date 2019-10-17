<?php


class DBconnect
{
    protected $dns;
    protected $username;
    protected $pass;

    public function __construct($dns, $username, $pass)
    {
        $this->dns = $dns;
        $this->username = $username;
        $this->pass = $pass;
    }

    function connect()
    {
        $conn = null;
        try {
            $conn = new PDO($this->dns, $this->username, $this->pass);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $conn;
    }
}