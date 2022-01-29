<h2>Cập nhật sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
          <?php
          foreach ($categories as $category):
            $selected = '';
            if ($category['id'] == $product['category_id']) {
              $selected = 'selected';
            }
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
        <input type="text" name="title"
               value="<?php echo isset($_POST['title']) ? $_POST['title'] : $product['title'] ?>"
               class="form-control" id="title"/>
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar"/>
        <img src="#" id="img-preview" style="display: none" width="100" height="100"/>
      <?php if (!empty($product['avatar'])): ?>
          <img height="80" src="assets/uploads/<?php echo $product['avatar'] ?>"/>
      <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="amount">Số lượng</label>
        <input type="number" name=""
               value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : $product['amount'] ?>"
               class="form-control" id="amount"/>
    </div>
    <div class="form-group">
        <label for="price">Đơn giá</label>
        <input type="number" name="price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : $product['price'] ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn</label>
        <input type="text" name="summary"
               value="<?php echo isset($_POST['summary']) ? $_POST['summary'] : $product['summary'] ?>"
               class="form-control" id="summary"/>
    </div>
    <div class="form-group">
        <label for="content">Mô tả chi tiết</label>
        <textarea name="content" id="content"
                  class="form-control"><?php echo isset($_POST['content']) ? $_POST['content'] : $product['content'] ?></textarea>
    <script>
      CKEDITOR.replace('content');
    </script>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-default">Back</a>
    </div>
</form>