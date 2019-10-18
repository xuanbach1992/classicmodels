<?php

include_once "../class/DBconnect.php";
include_once "../class/Order.php";
include_once "../class/OrderManager.php";
$managerOrder=new OrderManager();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $managerOrder->delOrder($id);
        header("Location:../index.php");
    }
}