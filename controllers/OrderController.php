<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/Pagination.php';
require_once 'models/User.php';
require_once 'models/OrderDetail.php';
class OrderController extends Controller {

    function __construct(){
        $user_model = new User();
        $users = $user_model->getAll();
    }

    public function index() {
        
        $order_model = new Order();
        $orderdetail = new OrderDetail();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total = $order_model->getTotal();
        $query_additional = '';
        if (isset($_GET['fullname'])) {
            $query_additional .= "&fullname=" . $_GET['fullname'];
        }
        $params = [
            'total' => $total,
            'full_mode' => false,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'user',
            'action' => 'index',
            'page' => $page,
            'query_additional' => $query_additional
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
       
        $orders = $order_model->getAllPagination($params);

        $this->content = $this->render('views/order/index.php', [
            'orders' => $orders,
            'pages' => $pages,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function create() {
        $user_model = new User();
        $users = $user_model->getAll();
        $order_model = new Order();
        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $price_total = $_POST['price_total'];
            $payment_status = $_POST['payment_status'];
            //xử lý validate
            if (empty($fullname)) {
                $this->error = 'Tên không được để trống';
            } else if (empty($address)) {
                $this->error = 'Địa chỉ không được để trống';
            } else if (empty($mobile)) {
                $this->error = 'Số điện thoại không được để trống';
            } else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->total_price = $price_total;
                $order_model->note = $note;
                $order_model->payment_status = $payment_status;
                $is_insert = $order_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=order');
                exit();
            }
        }

        $this->content = $this->render('views/users/create.php', ['roles' => $roles]);

        require_once 'views/layouts/main.php';
    }

    public function update() {
        $user_model = new User();
        $roles = $user_model->getAll();
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }

        $id = $_GET['id'];
        $order_model = new Order();
        $order = $order_model->getById($id);
        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $price_total = $_POST['price_total'];
            $payment_status = $_POST['payment_status'];

            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                //xử lý upload ảnh nếu có
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $order_model->fullname = $fullname;
                $order_model->address = $address;
                $order_model->mobile = $mobile;
                $order_model->email = $email;
                $order_model->total_price = $price_total;
                $order_model->note = $note;
                $order_model->payment_status = $payment_status;
                $is_update = $order_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                if($_SESSION['user']['roleId'] == 1){
                    header('Location: index.php?controller=order');
                    exit();
                }
            }
        }
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/users/update.php', [
                'user' => $user,
                'roles' => $roles
            ]);

            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/users/update_home.php', [
                'user' => $user,
                'roles' => $roles
            ]);

            require_once 'views/layouts/main_home.php';
        }
    }

    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
            exit();
        }

        $id = $_GET['id'];
        $order_model = new Order();
        $is_delete = $order_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=order');
        exit();
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_GET['id'];
        $order_model = new Order();
        $orderDetail_model = new OrderDetail();
        $order = $order_model->getById($id);
        $orderDetails = $orderDetail_model->getByOrderId($id);
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/order/detail.php', [
                'order' => $order,
                'orderDetails' => $orderDetails
            ]);
            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/order/detail_home.php', [
                'order' => $order,
                'users' => $users,
            ]);
            require_once 'views/layouts/main_home.php';
        }

        
    }
}