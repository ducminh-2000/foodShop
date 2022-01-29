<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';

class ProductController extends Controller
{
    public function index()
    {
        $product_model = new Product();

        //lấy tổng số bản ghi đang có trong bảng products
        $count_total = $product_model->countTotal();
        //        xử lý phân trang
        $query_additional = '';
        if (isset($_GET['title'])) {
            $query_additional .= '&title=' . $_GET['title'];
        }
        if (isset($_GET['category_id'])) {
            $query_additional .= '&category_id=' . $_GET['category_id'];
        }
        $arr_params = [
            'total' => $count_total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'product',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $products = $product_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);

        $pages = $pagination->getPagination();

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search
        $category_model = new Category();
        $categories = $category_model->getAll();
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/products/index.php', [
                'products' => $products,
                'categories' => $categories,
                'pages' => $pages,
            ]);
            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/products/index_home.php', [
                'products' => $products,
                'categories' => $categories,
                'pages' => $pages,
            ]);
            require_once 'views/layouts/main_home.php';
        }
    }

    public function create()
    {
        //xử lý submit form
        if (isset($_POST['submit'])) {
            $category_id = $_POST['category_id'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            //xử lý validate
            if (empty($title)) {
                $this->error = 'Không được để trống title';
            } else if ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được quá 2MB';
                }
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                $filename = '';
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-product-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng products
                $product_model = new Product();
                $product_model->category_id = $category_id;
                $product_model->title = $title;
                $product_model->avatar = $filename;
                $product_model->price = $price;
                $product_model->amount = $amount;
                $product_model->summary = $summary;
                $product_model->content = $content;
                $is_insert = $product_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=product');
                exit();
            }
        }

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search
        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/products/create.php', [
            'categories' => $categories
        ]);
        require_once 'views/layouts/main.php';
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=product');
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        if($_SESSION['user']['roleId'] == 1){
            $this->content = $this->render('views/products/detail.php', [
                'product' => $product
            ]);
            require_once 'views/layouts/main.php';
        }
        else{
            $this->content = $this->render('views/products/detail_home.php', [
                'product' => $product
            ]);
            require_once 'views/layouts/main_home.php';
        }
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=product');
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);
        //xử lý submit form
        if (isset($_POST['submit'])) {
            $category_id = $_POST['category_id'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            //xử lý validate
            if (empty($title)) {
                $this->error = 'Không được để trống title';
            } else if ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được quá 2MB';
                }
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                $filename = $product['avatar'];
                //xử lý upload file nếu có

                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    //xóa file cũ, thêm @ vào trước hàm unlink để tránh báo lỗi khi xóa file ko tồn tại
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-product-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng products
                $product_model->category_id = $category_id;
                $product_model->title = $title;
                $product_model->avatar = $filename;
                $product_model->price = $price;
                $product_model->amount = $amount;
                $product_model->summary = $summary;
                $product_model->content = $content;
                $product_model->updated_at = date('Y-m-d H:i:s');

                $is_update = $product_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=product');
                exit();
            }
        }

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search
        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/products/update.php', [
            'categories' => $categories,
            'product' => $product,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=product');
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $is_delete = $product_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=product');
        exit();
    }   

    public function showAll() {
        //    echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
        //    print_r($_REQUEST);
        //    echo "</pre>";
        //    die;
            $params = [];
            //nếu user có hành động filter
            if (isset($_POST['filter'])) {
              if (isset($_POST['category'])) {
                $category = implode(',', $_POST['category']);
                //chuyển thành chuỗi sau để sử dụng câu lệnh in_array
                $str_category_id = "($category)";
                $params['category'] = $str_category_id;
              }
              if (isset($_POST['price'])) {
                $str_price = '';
                foreach ($_POST['price'] AS $price) {
                  if ($price == 1) {
                    $str_price .= " OR products.price < 1000000";
                  }
                  if ($price == 2) {
                    $str_price .= " OR (products.price >= 1000000 AND products.price < 20000000)";
                  }
                  if ($price == 3) {
                    $str_price .= " OR (products.price >= 2000000 AND products.price < 30000000)";
                  }
                  if ($price == 4) {
                    $str_price .= " OR products.price >= 3000000";
                  }
                }
                //cắt bỏ từ khóa OR ở vị trí ban đầu
                $str_price = substr($str_price, 3);
                $str_price = "($str_price)";
                $params['price'] = $str_price;
              }
            }
        
            $params_pagination = [
                'total' => $count_total,
                'limit' => 5,
                'query_string' => 'page',
                'controller' => 'product',
                'action' => 'showAll',
                'full_mode' => false,
                'query_additional' => $query_additional,
                'page' => isset($_GET['page']) ? $_GET['page'] : 1
            ];
            //xử lý phân trang
            $pagination_model = new Pagination($params_pagination);
            $pagination = $pagination_model->getPagination();
            //get products
            $product_model = new Product();
            $products = $product_model->getProductInHomePage($params);
        
            //get categories để filter
            $category_model = new Category();
            $categories = $category_model->getAll();
        
            $this->content = $this->render('views/products/index_home.php', [
              'products' => $products,
              'categories' => $categories,
              'pagination' => $pagination,
            ]);
        
            require_once 'views/layouts/main_home.php';
          }
}