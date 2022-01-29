<?php
require_once 'Model.php';
class Role extends Model{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public $str_search;

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND role.name LIKE '%{$_GET['title']}%'";
        }
    }

    public function getAll() {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM role ORDER BY updated_at DESC, created_at DESC");
        $obj_select->execute();
        $accounts = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $accounts;
    }

    public function getAllPagination($params = []) {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM role WHERE TRUE $this->str_search
              ORDER BY created_at DESC
              LIMIT $start, $limit");

        $obj_select->execute();
        $accounts = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $accounts;
    }

    public function getTotal() {
        $obj_select = $this->connection
            ->prepare("SELECT COUNT(id) FROM role WHERE TRUE $this->str_search");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getById($id) {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM role WHERE id = $id");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    public function insert() {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO role(name) VALUES(:name)");
        $arr_insert = [
            ':name' => $this->name,
        ];
        return $obj_insert->execute($arr_insert);
    }

    public function update($id) {
        $obj_update = $this->connection
            ->prepare("UPDATE role SET name=:name, updated_at=:updated_at WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':updated_at' => $this->updated_at,
        ];
        $obj_update->execute($arr_update);

        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM role WHERE id = $id");
        return $obj_delete->execute();
    }
}
?>