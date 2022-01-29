<?php
require_once 'helpers/Helper.php';
?>
<div class="controller">
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $product['id']?></td>
    </tr>
    <tr>
        <th>Tên danh mục</th>
        <td><?php echo $product['category_name']?></td>
    </tr>
    <tr>
        <th>Tên sản phẩm</th>
        <td><?php echo $product['title']?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($product['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>" style="border-radius: 0% !important;  width: 180px; height: 140px;"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Số lượng</th>
        <td><?php echo number_format($product['amount']) ?></td>
    </tr>
    <tr>
        <th>Đơn giá</th>
        <td><?php echo number_format($product['price']) ?></td>
    </tr>
    <tr>
        <th>Mô tả ngắn</th>
        <td><?php echo $product['summary'] ?></td>
    </tr>
    <tr>
        <th>Mô tả chi tiết</th>
        <td><?php echo $product['content'] ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=product&action=showAll" class="btn btn-default">Back</a>
</div>