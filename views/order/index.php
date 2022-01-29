<?php
require_once 'helpers/Helper.php';
?>
<!--form search-->
<form action="" method="GET">
    <div class="form-group">
        <label for="fullname">Nhập tên khách hàng</label>
        <input type="text" name="fullname" value="<?php echo isset($_GET['fullname']) ? $_GET['fullname'] : '' ?>" id="fullname"
               class="form-control"/>
    </div>
    <input type="hidden" name="controller" value="order"/>
    <input type="hidden" name="action" value="index"/>
    <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary"/>
    <a href="index.php?controller=order" class="btn btn-default">Xóa filter</a>
</form>


<h2>Danh sách đơn hàng</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Người đặt</th>
        <th>Địa chỉ</th>
        <th>SĐT</th>
        <th>Email</th>
        <th>Ghi chú</th>
        <th>Giá</th>
        <th>Trạng thái</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th></th>
    </tr>
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id'] ?></td>
                <td><?php echo $order['fullname'] ?></td>
                <td><?php echo $order['address'] ?></td>
                <td> <?php echo $order['mobile'] ?>     </td>
                <td><?php echo ($order['email']) ?></td>
                <td> <?php echo $order['note'] ?>     </td>
                <td><?php echo $order['price_total'] ?></td>
                <td><?php if($order['payment_status'] == 0) echo "Thanh toán tiền mặt" ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></td>
                <td><?php echo !empty($order['updated_at']) ? date('d-m-Y H:i:s', strtotime($order['updated_at'])) : '--' ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=order&action=detail&id=" . $order['id'];
                    $url_update = "index.php?controller=order&action=update&id=" . $order['id'];
                    $url_delete = "index.php?controller=order&action=delete&id=" . $order['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>
<?php echo $pages; ?>