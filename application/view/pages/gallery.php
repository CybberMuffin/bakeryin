<?php
require 'application/view/patterns/templator.php';
$page = substr(basename($_SERVER['REQUEST_URI']), 13);
$product = new \application\model\Product();
$products = $product->get();
?>


<!-- innerpages_banner -->
	<div class="innerpages_banner">
		<h2>Our Gallery</h2>
	</div>
<!-- //innerpages_banner -->

<!-- Portfolio section -->
    <div class="mini-cart"></div>
<section class="portfolio-agileinfo gallery" id="portfolio">
			<h3 class="heading">Gallery</h3>
    <div class="container">
        <nav class="product-filter">
            <form action="/bakeryin/gallery/filter" method="post" class="form-inline">
                <div class="box" style="margin-left: 5px;">
                    <div style="padding: 20px">
                        <label for="">Filter by:</label>
                        <select class="form-control" name="filter_by" style="width: 150px; display: inline-block">
                            <option value="">
                                <?php if(isset($_SESSION['filter'])):
                                    echo $_SESSION['filter'] == 1 ? 'Cakes' : ($_SESSION['filter'] == 2 ? 'Muffins' : 'Specials');
                                else: ?> All cakes <?php endif; ?>
                            </option>
                            <option value="cakes">Cakes</option>
                            <option value="muffins">Muffins</option>
                            <option value="special">Specials</option>
                        </select>
                    </div>
                    <div style="padding: 20px">
                        <label for="sort_by">Sort by:</label>
                        <select class="form-control" name="sort_by" style="width: 150px; display: inline-block">
                            <option value="">
                                <?php if(isset($_SESSION['sort'])): echo $_SESSION['sort'] == 'id' ? 'Latest' :  'Price' ;
                                else: ?> Latest <?php endif; ?>
                            </option>
                            <option value="latest">Latest</option>
                            <option value="price">Price</option>
                        </select>
                    </div>
                        <div style="padding: 20px"><button type="submit" class="btn btn-info" name="do_sort">Sort</button></div>
                </div>
            </form>
        </nav>

        <div class="box">
            <?php echo output('show_products', $list)?>
        </div>
        <div><?php echo $pagination?></div>
    </div>
</section>
<!-- /Portfolio section -->	

<!-- subscribe -->
<!--<div class="subscribe">
	<div class="container">
		<h3 class="heading">Subscribe To Get Notifications</h3>
		<div class="subscribe-grid">
			<form action="#" method="post">
				<input type="email" placeholder="Enter Your Email" name="email" required="">
				<button class="btn1"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
			</form>
		</div>
	</div>
</div>-->
<!-- //subscribe -->

<!-- Supportive js -->
<script type="text/javascript" src="public/js/jquery-2.1.4.min.js"></script>
<!-- //Supportive js -->
<script type="text/javascript" src="public/js/bootstrap.js"></script><!-- bootstrap js file -->

<!-- js for portfolio lightbox -->
<script src="public/js/jQuery.lightninBox.js"></script>
<script type="text/javascript">
	$(".lightninBox").lightninBox();
</script>
<!-- /js for portfolio lightbox -->

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

<!--    <script type="text/javascript" src="public/js/jquery.cart.js"></script>-->

<!-- move to top-js-files -->
	<script type="text/javascript" src="public/js/move-top.js"></script>
	<script type="text/javascript" src="public/js/easing.js"></script>
<!-- //move to top-js-files -->
