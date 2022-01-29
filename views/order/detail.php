<?php
require_once 'helpers/Helper.php';
?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $order['id']?></td>
    </tr>
    <tr>
        <th>Tên khách hàng</th>
        <td><?php echo $order['fullname']?></td>
    </tr>
    <tr>
        <th>Địa chỉ</th>
        <td><?php echo $order['address']?></td>
    </tr>
    <tr>
        <th>SĐT</th>
        <td><?php echo $order['mobile']?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo ($order['email']) ?></td>
    </tr>
    <tr>
        <th>Chi tiết các sản phẩm</th>
        <td>
            <ul>
                <?php if(isset($orderDetails)):?>
                    <?php foreach($orderDetails as $od):?>
                        <li><?php echo '<p>Tên sản phẩm: '.$od['product'].'</p>
                                        <p>Số lượng: '.$od['quantity'].'</p>
                                        <p>Đơn giá: '.$od['price'].'</p>'?></li>
                    <?php endforeach;?>
                <?php endif;?>
            </ul>
        </td>
    </tr>
    <tr>
        <th>Giá tổng</th>
        <td><?php echo number_format($order['price_total']) ?></td>
    </tr>
    <tr>
        <th>Phương thức thanh toán</th>
        <td><?php if($order['payment_status'] == 0) echo "Thanh toán tiền mặt" ?></td>
    </tr>
    <tr>
        <th>Ghi chú</th>
        <td><?php echo $order['note'] ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($order['updated_at']) ? date('d-m-Y H:i:s', strtotime($order['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=order&action=index" class="btn btn-default">Back</a>
