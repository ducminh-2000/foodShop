<?php
//models/Order.php
require_once 'models/Model.php';
class Order extends Model {
  //Khai báo các thuộc tính cho model chính là các trường tương
  //ứng trong bảng orders
  public $id;
  public $fullname;
  public $address;
  public $mobile;
  public $email;
  public $note;
  public $price_total;
  public $payment_status;
  public $created_at;
  public $updated_at;

  public $str_search;

  public function __construct() {
      parent::__construct();
      if (isset($_GET['fullname']) && !empty($_GET['fullname'])) {
        $fullname = addslashes($_GET['fullname']);
        $this->str_search .= " AND orders.fullname LIKE '%$fullname%'";
    }
  }


  public function insert() {
    // Lưu ý: phương thức này sẽ trả về id của chính order vừa
    //insert, thay vì trả về true/false như thông thường
    // Vì liên quan đến việc lưu vào bảng order_details nữa
    // + Tạo câu truy vấn dạng tham số
    $sql_insert = "INSERT INTO orders(fullname, user_id, address, mobile, email, note, price_total, payment_status) 
                   VALUES(:fullname, :user_id, :address, :mobile, :email, :note, :price_total, :payment_status)";
    // + Tạo đối tượng truy vấn
    $obj_insert = $this->connection->prepare($sql_insert);
    // + Tạo mảng để truyền giá trị thật cho tham số câu truy vấn
    $arr_insert = [
        ':user_id' => $this->user_id,
        ':fullname' => $this->fullname,
        ':address' => $this->address,
        ':mobile' => $this->mobile,
        ':email' => $this->email,
        ':note' => $this->note,
        ':price_total' => $this->price_total,
        ':payment_status' => $this->payment_status,
    ];
    // + Thưc thi đối tượng truy vấn trên, ko cần tạo biến để
    //gán kết quả trả về như thông thường
    $obj_insert->execute($arr_insert);
    // + Lấy id vừa insert, luôn gọi sau execute:
    $order_id = $this->connection->lastInsertId();
    return $order_id;
  }

  public function update($id) {
    // Lưu ý: phương thức này sẽ trả về id của chính order vừa
    //insert, thay vì trả về true/false như thông thường
    // Vì liên quan đến việc lưu vào bảng order_details nữa
    // + Tạo câu truy vấn dạng tham số
    $sql_update = "UPDATE orders SET fullname=:fullname, user_id=:user_id, address=:address, mobile=:mobile, email=:email, note=:note, price_total=:price_total, payment_status=:payment_status)";
    // + Tạo đối tượng truy vấn
    $obj_update = $this->connection->prepare($sql_insert);
    // + Tạo mảng để truyền giá trị thật cho tham số câu truy vấn
    $arr_insert = [
        ':fullname' => $this->fullname,
        ':user_id' => $this->user_id,
        ':address' => $this->address,
        ':mobile' => $this->mobile,
        ':email' => $this->email,
        ':note' => $this->note,
        ':price_total' => $this->price_total,
        ':payment_status' => $this->payment_status,
    ];
    // + Thưc thi đối tượng truy vấn trên, ko cần tạo biến để
    //gán kết quả trả về như thông thường
    return $obj_insert->execute($arr_insert);
    
  }

  public function getAll() {
    $obj_select = $this->connection
        ->prepare("SELECT * FROM orders 
                  ORDER BY updated_at DESC, created_at DESC");
    $obj_select->execute();
    $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
  }

  public function getAllPagination($params = []) {
    $limit = $params['limit'];
    $page = $params['page'];
    $start = ($page - 1) * $limit;
    $obj_select = $this->connection
        ->prepare("SELECT * FROM orders 
                  WHERE TRUE $this->str_search
                  ORDER BY created_at DESC
                  LIMIT $start, $limit");

    $obj_select->execute();
    $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
  }

  public function getTotal() {
    $obj_select = $this->connection
        ->prepare("SELECT COUNT(id) FROM orders WHERE TRUE $this->str_search");
    $obj_select->execute();
    return $obj_select->fetchColumn();
  }

  public function getById($id) {
    $obj_select = $this->connection
        ->prepare("SELECT *
                  FROM orders  
                  WHERE orders.id = $id");
    $obj_select->execute();
    return $obj_select->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id){
    $obj_delete = $this->connection
        ->prepare("DELETE FROM orders WHERE id = $id");
    return $obj_delete->execute();
  }
}