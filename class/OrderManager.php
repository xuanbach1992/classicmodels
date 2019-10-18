<?php
include_once "class/StatusConstant.php";

class OrderManager implements StatusConstant
{
    protected $connect;

    public function __construct()
    {
        $db = new DBconnect("mysql:host=localhost;dbname=classicmodels", "root", "123456");
        $this->connect = $db->connect();
    }


    public function getOrderLimitPage($start, $limit)
    {
        $sql = "SELECT o.orderNumber AS 'Order_Code',o.orderDate AS 'Date_Order',o.shippedDate AS 'Date_Shiper',o.status AS'Status' FROM orders o  LIMIT $start, $limit";
        $stmt = $this->connect->query($sql);
        $list = $stmt->fetchAll();
        $listOrder = [];
        foreach ($list as $item) {
            $order = new Order($item["Order_Code"], $item["Date_Order"], $item["Status"], $item["Date_Shiper"]);
            array_push($listOrder, $order);
        }
        return $listOrder;
    }

    public function getOrderDetailById($id)
    {
        $sql = "SELECT o.orderNumber AS 'Order_Code',
            o.orderDate AS 'Date_Order',
            o.shippedDate AS 'Date_Shiper',
            o.status AS'Status',
            c.customerName AS 'Customer_name',
            c.contactLastName AS 'LastName', 
            c.contactFirstName AS 'FirstName',
            c.phone AS 'Phone',
            p.productName AS 'Name_Product',
            p.productLine AS 'Name_cateroty',
            od.quantityOrdered as'amount',
            od.priceEach as 'price'
            FROM orders o 
            INNER JOIN customers c ON c.customerNumber=o.customerNumber
            INNER JOIN orderdetails od ON od.orderNumber=o.orderNumber 
          	INNER JOIN products p ON p.productCode=od.productCode
            WHERE o.orderNumber=:id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $list = $stmt->fetchAll();
//        $detailOrder = [];
//        $name=$list[0]['Customer_name'];
//        $LastName=$list[0]['LastName'];
//        $FirstName=$list[0]['FirstName'];
//        foreach ($list as $item) {
//            $order = new Order($item["Order_Code"], $item["Date_Order"], $item["Status"], $item["Date_Shiper"]);
//            array_push($detailOrder, $order);
//        }
        return $list;
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status =:status WHERE orderNumber=:id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}