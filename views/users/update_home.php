<div class='container' style="padding-top:110px">
<h2>Cập nhật user</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username <span class="red">*</span></label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : $user['username'] ?>" disabled
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $user['first_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name"
               value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $user['last_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="text" name="password" id="password"
               value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=user&action=detail&id=<?php echo $_SESSION['user']['id']?>" class="btn btn-default">Back</a>
    </div>
</form>
</div>