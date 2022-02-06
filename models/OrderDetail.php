<?php
//models/OrderDetail.php
require_once 'models/Model.php';
class OrderDetail extends Model {
  public $order_id;
  public $product_id;
  public $quantity;

  public function insert() {
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO order_details(order_id, product_id, quantity) 
                   VALUES (:order_id, :product_id, :quantity)";
    // + Tạo đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng
    $arr_insert = [
        ':order_id' => $this->order_id,
        ':product_id' => $this->product_id,
        ':quantity' => $this->quantity,
    ];
    // + Thực thi đối tượng truy vấn
    return $obj_insert->execute($arr_insert);
  }

  public function getByOrderId($id){
    $obj_select = $this->connection
            ->prepare("SELECT order_details.*, products.title as product, products.price as price FROM order_details
                      INNER JOIN products ON products.id = order_details.product_id
                      where order_details.order_id = $id
                      ");
    $obj_select->execute();
    $orderDetail = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $orderDetail;
  }
}