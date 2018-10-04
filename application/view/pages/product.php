
<?php
require 'application/view/patterns/templator.php';
$id = substr(basename($_SERVER['REQUEST_URI']), 11);
$product = new \application\model\Product();
$product->find('id', $id);
?>

<!-- innerpages_banner -->
	<div class="innerpages_banner">
		<h2><?=$product->name?></h2>
	</div>
<!-- //innerpages_banner -->

<!-- single -->
	<div class="services">
		<div class="container">
			<div class="col-md-8 single-left">
                <div class="row">
                    <div class="single-left1">
                        <img src="../public/images/<?=$product->image?>" alt=" " class="img-responsive" />
                    <div class="col-md-10 single-left1">
                            <h2><?=$product->name?></h2>
                            <h3>Price: <?=$product->price?>$</h3>
                    </div>
                    </div>
                    <div class="col-md-2 single-price">
                        <form action="/bakeryin/account/addToCart" method="post">
                            <input name="prod_id" style="display: none" value="<?=$product->id?>" readonly>
                            <button name="buy" type="submit" class="btn btn-success"><h3>Buy<i class="fa fa-cart-arrow-down" aria-hidden="true"></i></h3></button>
                        </form>
                    </div>
                </div>
                <div class="single-left1" style="margin-top: -25px">
                    <p><?=$product->description?></p>
                </div>

				<div class="single-left2">
					<div class="col-md-6 single-left2-left">
						<ul>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">At vero eos et accusamus iusto</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Sed ut perspiciatis unde omnis iste</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Accusantium doloremque laudantium</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Vel illum qui dolorem eum fugiat quo</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Quis autem vel eum iure reprehenderit</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Neque porro quisquam est, qui dolorem</a></li>
						</ul>
					</div>
					<div class="col-md-6 single-left2-left">
						<ul>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">At vero eos et accusamus et iusto</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Sed ut perspiciatis unde omnis iste</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Accusantium doloremque laudantium</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Vel illum qui dolorem eum fugiat quo</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Quis autem vel eum iure reprehenderit</a></li>
							<li><i class="fa fa-check" aria-hidden="true"></i><a href="#">Neque porro quisquam est, qui dolorem</a></li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="admin">
					<p>But I must explain to you how all this mistaken idea of denouncing 
						pleasure and praising pain was born and I will give you a complete 
						account of the system, and expound the actual teachings of the great 
						explorer of the truth, the master-builder of human happiness. 
						No one rejects, dislikes, or avoids pleasure itself.</p>
					<a href="#"><i>John Frank</i></a>
				</div>
			</div>
			<div class="col-md-4 event-right wthree-event-right">
				<div class="event-right1 agileinfo-event-right1">
					<div class="posts w3l-posts">
						<h3>Our Cakes</h3>
						<div class="posts-grids w3-posts-grids">
                            <?php
                            $products = $product->get();
                            echo output('possible_products', $products);
                            ?>
						</div>
					</div>
                    <div class="categories w3ls-categories">
                        <h3>Categories</h3>
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">At vero eos et accusamus iusto</a></li>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">Sed ut perspiciatis unde omnis</a></li>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">Accusantium doloremque lauda</a></li>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">Vel illum qui dolorem fugiat quo</a></li>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">Quis autem vel eum reprehenderit</a></li>
                            <li><i class="fa fa-check" aria-hidden="true"></i><a href="product.php">Neque porro quisquam est qui</a></li>
                        </ul>
                    </div>
					<!--<div class="tags tags1 w3layouts-tags">
						<h3>Recent Tags</h3>
						<ul>
							<li><a href="#">Backed Cakes</a></li>
							<li><a href="#">Delicious Cakes</a></li>
							<li><a href="#">Honey Cakes</a></li>
							<li><a href="#">Slices</a></li>
							<li><a href="#">Tasty</a></li>
							<li><a href="#">Bakery In</a></li>
							<li><a href="#">Reserved</a></li>
							<li><a href="#">Creamy</a></li>
							<li><a href="#">Online Service</a></li>
							<li><a href="#">Cookies</a></li>
							<li><a href="#">Creamy</a></li>
							<li><a href="#">Delicious</a></li>
							<li><a href="#">Fruit Cake</a></li>
							<li><a href="#">Butter Cakes</a></li>
							<li><a href="#">Pan Cakes</a></li>
							<li><a href="#">Fresh Cakes</a></li>
							<li><a href="#">Cheese Cakes</a></li>
						</ul>
					</div>-->
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //single -->



<!-- Supportive js -->
<script type="text/javascript" src="../public/js/jquery-2.1.4.min.js"></script>
<!-- //Supportive js -->

<!-- smooth scrolling js -->
<script src="../public/js/SmoothScroll.min.js"></script>
<!-- smooth scrolling js -->

<!-- start-smooth-scrolling -->
<script type="text/javascript" src="../public/js/move-top.js"></script>
<script type="text/javascript" src="../public/js/easing.js"></script>
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
	<script type="text/javascript" src="../public/js/move-top.js"></script>
	<script type="text/javascript" src="../public/js/easing.js"></script>
<!-- //move to top-js-files -->

<script type="text/javascript" src="../public/js/bootstrap.js"></script><!-- bootstrap js file -->
