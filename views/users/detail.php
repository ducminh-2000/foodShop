<?php
require_once 'helpers/Helper.php';
?>
<h2>Chi tiết user</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $user['id'] ?></td>
    </tr>
    <tr>
        <th>username</th>
        <td><?php echo $user['username'] ?></td>
    </tr>
    <tr>
        <th>name</th>
        <td><?php if(isset($user['first_name']) && isset($user['last_name'])) echo " " .$user['first_name'] .$user['last_name']; ?></td>
    </tr>
    <tr>
        <th>role</th>
        <td><?php echo $user['role_name'] ?></td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($user['created_at'])) ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($user['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=user&action=index" class="btn btn-default">Back</a>