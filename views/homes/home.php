<?php
//views/homes/index.php
require_once 'helpers/Helper.php';
?>
<!--    PRODUCT-->
<div class="product-wrap">
    <div class="product container">
      <?php if (!empty($products)): ?>
          <h1 class="post-list-title">
              <a href="index.php?controller=product&action=index" class="link-category-item">Danh sách sản phẩm</a>
          </h1>
          <div class="link-secondary-wrap row">
            <?php foreach ($products AS $product):
              $product_link = "index.php?controller=product&action=detail&id=" . $product['id'];
              $product_cart_add = "index.php?controller=product&id=" . $product['id'];
              ?>
                <div class="service-link col-md-3 col-sm-6 col-xs-12">
                    <a href="<?php echo $product_link; ?>">
                        <img class="secondary-img img-responsive" title="<?php echo $product['title'] ?>"
                             src="assets/uploads/<?php echo $product['avatar'] ?>"
                             alt="<?php echo $product['title'] ?>"/>
                        <span class="shop-title">
                        <?php echo $product['title'] ?>
                    </span>
                    </a>
                    <span class="shop-price">
                            <?php echo number_format($product['price']) ?>
                </span>

                    <span class="add-to-cart"
                          data-id="<?php echo $product['id']; ?>">
                        <a href="index.php?controller=home" style="color: inherit">Thêm vào giỏ</a>
                    </span>
                </div>
            <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
</div>
<!--    END PRODUCT-->
