<a href="#" class="scrollup"></a>
<div class="header-top nopc">
    <div class="container">
        <div class="row">
            <div class=" col-md-4 col-sm-4 col-xs-12">
                <a class="info-contact" href="tel:0999999999">
                    <i class="fas fa-phone-alt"></i> 0999999999
                </a>
                <a class="info-contact" href="mailto:abc@gmail.com">
                    <i class="far fa-envelope"></i> abc@gmail.com
                </a>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <ul class="header-navigation" data-show-menu-on-mobile="">
                    <li>
                        <a href="#" class="link-icon-laguage material-button submenu-toggle">
                            <img src="assets/frontend/images/icon-flag-vn.png" class="icon-language">
                        </a>
                    </li>
                    <li>
                        <a href="index.php?controller=cart&action=index" class="cart-link">
                            <i class="fa fa-cart-plus"></i>
                          <?php
                          $cart_total = 0;
                          if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] AS $cart) {
                              $cart_total += $cart['quantity'];
                            }
                          }
                          ?>
                            <span class="cart-amount">
                                <?php echo $cart_total; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<span class="ajax-message"></span>
<!-- header start -->
<header class="header">

    <div class="header-wrapper container">
        <!--sidebar menu toggler start -->
        <div class="toggle-sidebar material-button">
            <i class="material-icons">&#xE5D2;</i>
        </div>
        <!--sidebar menu toggler end -->

        <!--logo start -->
        <div class="logo-box">
            <h1>
                <a href="/" class="logo"></a>
            </h1>
        </div>
        <!--logo end -->

        <div class="header-menu">

            <!-- header left menu start -->
            <ul class="header-navigation" data-show-menu-on-mobile>
                <li>
                    <a href="index.php?controller=home" class="home-link material-button submenu-toggle">
                        LOGO
                    </a>

                </li>
                <li>
                    <a href="index.php?controller=home" class="material-button submenu-toggle">Trang chủ</a>
                </li>
                <li>
                    <a href="index.php?controller=product&action=index" class="material-button submenu-toggle">Sản phẩm</a>
                </li>
                <li>
                    <a href="index.php?controller=cart&action=index" class="material-button submenu-toggle">Giỏ hàng</a>
                </li>
                <?php if(!isset($_SESSION['user'])):?>
                <li >
                    <a href="index.php?controller=login&action=login" class="material-button submenu-toggle">Đăng nhập</a>
                </li>
                <?php else:?>
                <li >
                    <a href="index.php?controller=user&action=detail&id=<?php echo $_SESSION['user']['id'];?>" class="material-button submenu-toggle">Tài khoản</a>
                </li>
                <?php endif;?>
            </ul>
            <!-- header left menu end -->
        </div>
        <div class="header-right with-seperator">
            <!-- header right menu start -->
            <ul class="header-navigation">
                <li>
                    <a href="/gio-hang-cua-ban.html" class="">
                        <i class="fa fa-cart-plus"></i>
                        <span class="cart-amount-mobile">
                                <?php echo $cart_total; ?>
                        </span>
                    </a>
                </li>
            </ul>
            <!-- header right menu end -->

        </div>
    </div>
</header>
<!-- header end -->

<!-- Left sidebar menu start -->
