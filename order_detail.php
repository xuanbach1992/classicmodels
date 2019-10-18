<?php
include_once "class/DBconnect.php";
include_once "class/Order.php";
include_once "class/OrderManager.php";

$id = $_GET["id"];
$managerOrder = new OrderManager();
$ordersById = $managerOrder->getOrderDetailById($id);
if (isset($_POST["status"])){
    $new_status=$_POST["status"];
    $managerOrder->updateStatus($id,$new_status);
    header("Location:order_detail.php?id=$id");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        table, td {
            border: 1px solid black;
        }

        td {
            width: 150px;
            text-align: center;
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
<h1>Trạng thái : </h1>
<form action="" method="post">
    <select name="status">
        <option <?php if ($ordersById[0]['Status'] == StatusConstant::SHIPPED): ?> selected<?php endif; ?>>
            Shipped
        </option>

        <option <?php if ($ordersById[0]['Status'] == StatusConstant::CANCELLED) : ?> selected <?php endif; ?>>
            Cancelled
        </option>

        <option <?php if ($ordersById[0]['Status'] == StatusConstant::IN_PROCESS): ?> selected <?php endif; ?>>
            In Process
        </option>

        <option <?php if ($ordersById[0]['Status'] == StatusConstant::ON_HOLD): ?> selected<?php endif; ?>>
            On Hold
        </option>

        <option <?php if ($ordersById[0]['Status'] == StatusConstant::RESOLVED): ?> selected<?php endif; ?>>
            Resolved
        </option>

        <option <?php if ($ordersById[0]['Status'] == StatusConstant::DISPUTED): ?> selected<?php endif; ?>>
            Disputed
        </option>
    </select>
    <input type="submit" value="Update" onclick="return confirm('bạn muốn sửa không ?')">
</form>
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
    <ur><li><a href="index.php">Back To List</a></li></ur>
</table>
</body>
</html>
