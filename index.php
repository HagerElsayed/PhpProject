<?php

require_once 'DatabaseClasses/product.php';
require 'DatabaseClasses/subcategory.php';
$products=product::select();
 ?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->


		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
								<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>

                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                <li><a href="login.html" class="active"><i class="fa fa-lock"></i> Login</a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav navbar-collapse collapse" style="height: 0.909091px;">
								<li><a href="index.html">Home</a></li>
                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                        <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html" class="active">Login</a></li>
                                    </ul>
                                </li>


								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search">
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1" class=""></li>
							<li data-target="#slider-carousel" data-slide-to="2" class=""></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl1.jpg" class="girl img-responsive" alt="">
									<img src="images/home/pricing.png" class="pricing" alt="">
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="">
									<img src="images/home/pricing.png" class="pricing" alt="">
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="">
									<img src="images/home/pricing.png" class="pricing" alt="">
								</div>
							</div>

						</div>

						<a href="slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">

        </div>

        <div class="col-sm-9 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Features Items</h2>
           <?php
            foreach ($products as $value) {?>
              <div class="col-sm-4" >
                <div class="product-image-wrapper">
  								<div class="single-products">
  									<div class="productinfo text-center">
                      <img src="<?php echo $value->photo?>" alt="">
                      <h2><?php echo $value->price?></h2>
                      <p><?php echo $value->name?></p>
  										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
  									</div>
  									<div class="product-overlay">
  										<div class="overlay-content">
                        <h2><?php echo $value->price?></h2>
                        <p><?php echo $value->name?></p>
  											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
          </div><!--features_items-->
          <!-- </div> -->
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">

							<ul class="nav nav-tabs" id="list">
                <?php
                $subcategoryName=subcategory::selectAllSubCategories();
                // var_dump($subcategoryName);
                foreach ($subcategoryName as $value) {?>
								<li id="selected" class="active"><a href="#Labtops" data-toggle="tab" ><?php echo $value['name']?></a></li>
                <?php }?>

							</ul>
						</div>
          </div>
						<div class="tab-content">
                <?php
                $subcategoryId=subcategory::selectsubCategorieName("labtops");
                 $subProducts=product::selectBySubId($subcategoryId);
                 foreach ($subProducts as $value) {?>
                   <div class="tab-pane fade active in" id="Labtops">
                   <div class="col-sm-3" >
                     <div class="product-image-wrapper">
       								<div class="single-products">
       									<div class="productinfo text-center">
                           <!-- <img src="<?php echo $value->photo?>" alt=""> -->
                           <h2><?php echo $value->price?></h2>
                           <p><?php echo $value->name?></p>
       										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
       									</div>
       									<div class="product-overlay">
       										<div class="overlay-content">
                             <h2><?php echo $value->price?></h2>
                             <p><?php echo $value->name?></p>
       											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                       </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
              <?php }?>

							</div>

					</div><!--/category-tab-->

				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>


				</div>
			</div>
		</div>



		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com/">Themeum</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



  <script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript">
  $(function(){
    $("#list").on("click",function(){
      $.ajax({
        url: 'indexproccess.php /?name=' + $("#selected").html(),
        type: 'GET',

      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


    });
  });//end function

  </script>

<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: block;"><i class="fa fa-angle-up"></i></a></body></html>
</body>
</html>
