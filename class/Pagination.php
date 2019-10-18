<?php


class Pagination
{
    protected $connect;
    public $limit=20;

    public function __construct()
    {
        $db = new DBconnect("mysql:host=localhost;dbname=classicmodels", "root", "123456");
        $this->connect = $db->connect();
    }

    function getTotalPages()
    {
        $sql="SELECT COUNT(orderNumber) FROM orders";
        $stmt = $this->connect->query($sql);
        $countNumber = $stmt->fetch();
        $totalPage=ceil($countNumber[0]/$this->limit);
        return $totalPage;
    }
}