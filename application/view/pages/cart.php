<?php
require 'application/view/patterns/templator.php';

if(isset($_COOKIE['cart']))
{
    $assoc_prods = json_decode($_COOKIE['cart'], true);
    $products = [];
    $sum = 0;
    foreach ($assoc_prods as $key => $value){
        $product = new \application\model\Product();
        $product->find('id', $key);
        $sum += $product->price * $value;
        array_push($products, $product);
    }
}
?>


<!-- innerpages_banner -->
<div class="innerpages_banner">
    <h2>Your cart</h2>
</div>
<!-- //innerpages_banner -->


<!-- Portfolio section -->
<section class="portfolio-agileinfo gallery" id="portfolio">
    <?php if(empty($assoc_prods)): ?>
    <h3 class="heading alert-info">Your cart is empty now</h3>
    <?php else: ?>
    <form action="/bakeryin/cart/payment" method="post">
        <input type="text" name='order_arr' style="display: none"
               value="<?= http_build_query($assoc_prods, '', '&amp;')?>" readonly>
        <input type="text" name='user_id' style="display: none"
               value="<?=$_COOKIE['id']?>" readonly>
        <h3 class="heading"><button type="submit" name="make_order" class="btn btn-info">
                <h2>Send your order <i class="fa fa-send" aria-hidden="true"></i></h2>
            </button>
        </h3>
    </form>
    <div class="container">
        <h3 style="margin-left: 20px">Total price: <?=$sum?>$</h3>
        <span id="cartCntItems"></span>
        <div class="cart"></div>
        <div class="box">
            <?php
            if(isset($products) && !empty($products)){
                echo output('show_cart', $products, $assoc_prods);
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php endif; ?>
</section>

    <!-- Supportive js -->
<script type="text/javascript" src="public/js/jquery-2.1.4.min.js"></script>
<!-- //Supportive js -->

<script type="text/javascript" src="public/js/jquery.cartOnPage.js"></script>
<!-- smooth scrolling js -->
<script src="public/js/SmoothScroll.min.js"></script>
<!-- smooth scrolling js -->

<!-- start-smooth-scrolling -->
<script type="text/javascript" src="public/js/move-top.js"></script>
<script type="text/javascript" src="public/js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>

<!-- here starts scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->

<!-- move to top-js-files -->
<script type="text/javascript" src="public/js/move-top.js"></script>
<script type="text/javascript" src="public/js/easing.js"></script>
<!-- //move to top-js-files -->

<script type="text/javascript" src="public/js/bootstrap.js"></script><!-- bootstrap js file -->
