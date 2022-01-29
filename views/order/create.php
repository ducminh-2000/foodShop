<h2>Thêm mới sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php foreach ($categories as $category):
                $selected = '';
                if (isset($_POST['category_id']) && $category['id'] == $_POST['category_id']) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Nhập tên sản phẩm</label>
        <input type="text" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>"
               class="form-control" id="title"/>
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar"/>
        <img src="#" id="img-preview" style="display: none" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="amount">Số lượng</label>
        <input type="number" name="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>"
               class="form-control" id="amount"/>
    </div>
    <div class="form-group">
        <label for="price">Đơn giá</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn</label>
        <input type="text" name="summary" value="<?php echo isset($_POST['summary']) ? $_POST['summary'] : '' ?>"
               class="form-control" id="summary"/>
    </div>
    <div class="form-group">
        <label for="content">Mô tả chi tiết</label>
        <textarea name="content" id="content" data-sample-short
                  class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
    </div>
    <script>
      // Thay thế <textarea id="post_content"> với CKEditor
      CKEDITOR.replace( 'content');
    </script>

    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary me-2"/>
        <a href="index.php?controller=sach&action=index" class="btn btn-light">Back</a>
    </div>
</form>
