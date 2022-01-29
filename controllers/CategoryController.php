<?php
require_once 'controllers/Controller.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';

class CategoryController extends Controller
{

    public function index()
    {
        $category_model = new Category();
        $params = [
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'category',
            'action' => 'index',
            'full_mode' => FALSE,
        ];
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (isset($_GET['name'])) {
            $params['query_additional'] = '&name=' . $_GET['name'];
        }
        $count_total = $category_model->countTotal();
        $params['total'] = $count_total;
        $params['page'] = $page;
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $categories = $category_model->getAllPagination($params);

        $this->content = $this->render('views/categories/index.php', [
            //truyền biến $categories ra vew
            'categories' => $categories,
            //truyền biến phân trang ra view
            'pages' => $pages,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];

            //check validate
            if (empty($name)) {
                $this->error = 'Cần nhập tên';
            }
            if (empty($this->error)) {
                //xử lý upload ảnh nếu có
                $category_model = new Category();
                $category_model->name = $name;
                $category_model->description = $description;
                $is_insert = $category_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Thêm mới thành công';
                } else {
                    $_SESSION['error'] = 'Thêm mới thất bại';
                }
                header('Location: index.php?controller=category&action=index');
                exit();
            }

        }
        $this->content = $this->render('views/categories/create.php');
        require_once 'views/layouts/main.php';
    }

    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID category không hợp lệ';
            header('Location: index.php?controller=category&action=index');
            exit();
        }

        $id = $_GET['id'];
        $category_model = new Category();
        $category = $category_model->getCategoryById($id);
        //submit form
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            if (empty($name)) {
                $this->error = 'Cần nhập tên';
            }
            if (empty($this->error)) {
                $category_model = new Category();
                $category_model->name = $name;
                $category_model->description = $description;
                $category_model->updated_at = date('Y-m-d H:i:s');
                $is_update = $category_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update thành công';
                } else {
                    $_SESSION['error'] = 'Update thất bại';
                }
                header('Location: index.php?controller=category&action=index');
                exit();
            }

        }
        $this->content = $this->render('views/categories/update.php', ['category' => $category]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=category&action=index');
            exit();
        }
        $id = $_GET['id'];
        $category_model = new Category();
        $is_delete = $category_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa thành công';
        } else {
            $_SESSION['error'] = 'Xóa thất bại';
        }
        header('Location: index.php?controller=category&action=index');
        exit();
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=category&action=index');
            exit();
        }
        $id = $_GET['id'];
        $category_model = new Category();
        $category = $category_model->getCategoryById($id);
        //lấy nội dung view create.php
        $this->content = $this->render('views/categories/detail.php', [
            'category' => $category
        ]);
        //gọi layout để nhúng nội dung view detail vừa lấy đc
        require_once 'views/layouts/main.php';

    }
}