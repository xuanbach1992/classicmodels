<?php
include_once "class/DBconnect.php";
include_once "class/Order.php";
include_once "class/OrderManager.php";
$id = $_GET["id"];
$managerOrder = new OrderManager();
$ordersById = $managerOrder->getOrderDetailById($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table,tr,td{
            border: solid 1px black;
        }
    </style>
    <title>Document</title>
</head>
<body>
<h1>Thông tin khách hàng</h1>
<table>
    <tr>
        <td>Custome Name</td>
        <td>Frist Name</td>
        <td>Last Name</td>
        <td>Phone</td>
    </tr>
    <tr>
        <td><?php echo $ordersById[0]["Customer_name"] ?></td>
        <td><?php echo $ordersById[0]["LastName"] ?></td>
        <td><?php echo $ordersById[0]["FirstName"] ?></td>
        <td><?php echo $ordersById[0]["Phone"] ?></td>
    </tr>
</table>
<h1>Trạng thái :  <?php echo $ordersById[0]["Status"] ?></h1>
<h2>Thông tin hóa đơn</h2>
<table>
    <tr>
        <td>STT</td>
        <td>Sản phẩm</td>
        <td>Danh mục</td>
        <td>Số lượng</td>
        <td>Giá tiền</td>
    </tr>
    <?php foreach ($ordersById as $key => $order):
        ?>
        <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $order["Name_Product"] ?></td>
            <td><?php echo $order["Name_cateroty"] ?></td>
            <td><?php echo $order["amount"] ?></td>
            <td><?php echo $order["price"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
