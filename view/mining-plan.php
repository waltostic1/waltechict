<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

<?php require('head.php') ?>
</head>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- preloader >
  <div id="preloader">
    <div id="spinner">
      <div class="preloader-dot-loading">
        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
      </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
  </div---> 
  
 
   <!-- header here -->
   <?php require('header.php') ?>
  <!--end of header  -->

  
  

<!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="https://i.ibb.co/hH04jr0/9-1.jpg" style="background-image: url(_netema/images/bg/slide1.html); background-position: 50% 100px;">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">

  <h2 class="title text-white">Mining Plans</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="index.php">Home</a></li>
                <li class="active text-gray-silver">Mining Plans</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About -->
    
<style>
  .pricingTable{
    text-align: center;
    box-shadow: 0 0 1px 4px rgba(0, 0, 0, 0.1);
}
.pricingTable > .pricingTable-header{
    color:#fff;
    padding: 3px 0;
    background: #ffae11;
}
.pricingTable .price-value{
    background: #28395e;
    display: block;
    padding: 24px 12px;
    font-size: 32px;
    position: relative;
}
.pricingTable .price-value:after,
.pricingTable .price-value:before{
    content: "";
    width: 24px;
    height: 24px;
    background: #fff;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    top:40%;
    right:-15px;
}
.pricingTable .price-value:before{
    left:-15px;
}
.pricingTable .price-value > span{
    font-size: 24px;
}
.pricingTable .price-value > .month{
    display: block;
    text-transform: uppercase;
    font-size: 12px;
}
.pricingTable .price-value > .month:before{
    content: "";
    border: 1px solid #fff;
    width: 28px;
    display: block;
    margin: 0 auto;
    margin-bottom: 5px;
}
.pricingTable .icon{
    display: block;
    padding: 15px 0; 
    font-size: 54px;
}
.pricingTable .icon > i{
    transform: rotateY(0deg);
    transition: all 1s ease-out 0s;
}
.pricingTable .icon:hover > i{
    transform: rotateY(360deg);
    color:#333333;
    transition: all 1s ease-out 0s;
}
.pricingTable .heading{
    padding: 12px 0;
    background: #28395e;
    display: block;
}
.pricingTable .heading > h3{
    margin: 0;
    text-transform: capitalize;
    color: #fff;
}
.pricingTable > .pricingContent{
    text-align: left;
}
.pricingTable > .pricingContent > ul{
    list-style: none;
    padding: 0;
    margin-bottom: 0;
}
.pricingTable > .pricingContent > ul > li{
    padding: 12px;
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
    transition: all 0.3s ease-out 0s;
}

.pricingTable > .pricingContent > ul > li:hover {
    background: #ffae11 !important;
    color: #fff;
}
.pricingTable > .pricingContent > ul > li:hover:before{
    margin-right: 15px;
}
.pricingTable .pricingTable-sign-up{
    padding: 15px 0;
    background: #fff;
}
.pricingTable-sign-up > .btn-block{
    width: 50%;
    margin: 0 auto;
    background: #28395e;
    color:#fff;
    text-transform: uppercase;
    padding: 10px 0;
    border-radius: 0px;
    position: relative;
    transition: all 0.5s ease-out 0s;
}
.pricingTable-sign-up > .btn-block:after,
.pricingTable-sign-up > .btn-block:before{
    content: "";
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #fff;
    display: inline-block;
    position: absolute;
    top:30%;
    right: -10px;
    transition:all 0.8s ease 0s;
}
.pricingTable-sign-up > .btn-block:before{
    left:-10px;
}
.pricingTable .btn-block:hover:after,
.pricingTable .btn-block:hover:before{
    width: 0;
    height: 0;
}
.pricingTable.pink .pricingTable-header,
.pricingTable.pink .btn-block{
    /* background: #ed687c; */
}
.pricingTable.pink .pricingContent > ul > li:hover{
    /* color: #ed687c;*/
}
.pricingTable.orange .pricingTable-header,
.pricingTable.orange .btn-block{
    /* background: #ffae11; */
}
.pricingTable.orange .price-value > .month:after{
    content: "best";
    width: 42px;
    height:42px;
    border-radius: 50%;
    background: #fff;
    display: inline-block;
    position: absolute;
    top:3px;
    right: 3px;
    color:#000;
    font-size: 12px;
    line-height: 42px;
    font-weight: bold;
}
.pricingContent i {
    margin-right: 10px;
}
.pricingTable.orange .pricingContent > ul > li:hover{
    /* color: #e67e22;*/
}
.pricingTable.dark-green .pricingTable-header,
.pricingTable.dark-green .btn-block{
    /* background: #008b8b; */
}
.pricingTable.dark-green .pricingContent > ul > li:hover{
   /*  color: #008b8b;*/
}
@media screen and (max-width: 990px){
    .pricingTable{
        margin-bottom: 20px;
    }
}
</style>

  <!-- Section: Pricing -->
    <section id="pricing">
      <div class="container pb-70 pb-sm-30" style="padding-bottom: 20px !important;">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <h2 class="text-uppercase line-bottom-double-line-centered mt-0">Package <span class="text-theme-colored2">Pricing</span></h2>
              <p>Bittrustsecure.com has multiple mining plans to choose from. Both plans are structured with <br>simplicity in mind so that even the newest of investors can interpret<br> and leverage either plan to cultivate respectable profits.</p>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
              <div class="pricing-table text-center pb-0 mt-sm-0 maxwidth400 bg-lighter">
                <h4 class="mt-0 mb-0 pt-20 pb-20 text-uppercase bg-theme-colored text-white">Starter</h4>
                <h3 class="price-num bg-theme-colored-transparent-1 pt-30 pb-30 mt-0 mb-0">20% After 24 hours<br>
<b style="
    color: #fead10;
">After 24 hours</b></h3>
                <ul class="table-list theme-colored mt-10">
                  <li>Min: $50 max: $500</li>
                  <li>Principle: Include</li>
                 <li>Profit: 20%</li>
                  <li>Payment type: Instant</li>
            
                </ul>
                <a class="btn btn-lg text-white text-uppercase btn-theme-colored2 btn-block pt-20 pb-20 btn-flat" href="../app/login">Deposit Now</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
              <div class="pricing-table text-center pb-0 mt-sm-0 maxwidth400 bg-lighter">
                <h4 class="mt-0 mb-0 pt-20 pb-20 text-uppercase bg-theme-colored2 text-white">Advanced </h4>
               <h3 class="price-num bg-theme-colored-transparent-1 pt-30 pb-30 mt-0 mb-0">40% After 48 hours<br>
<b style="
    color: #fead10;
">After 48 hours</b> </h3>
                <ul class="table-list theme-colored mt-10">
                 <li>Min: $500 max: $3000</li>
                  <li>Principle: Include</li>
                   <li>Profit: 40%</li>
                  <li>Payment type: Instant</li>
                </ul>
                <a class="btn btn-lg text-white text-uppercase btn-theme-colored btn-block pt-20 pb-20 btn-flat" href="../app/login">Deposit Now</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
              <div class="pricing-table text-center pb-0 mt-sm-0 maxwidth400 bg-lighter">
                <h4 class="mt-0 mb-0 pt-20 pb-20 text-uppercase bg-theme-colored text-white">Bussiness</h4>
                <h3 class="price-num bg-theme-colored-transparent-1 pt-30 pb-30 mt-0 mb-0">70% After 72 hours<br>
<b style="
    color: #fead10;
">After 72 hours</b></h3>
                <ul class="table-list theme-colored mt-10">
                  <li>Min: $1,000 max: $5,000</li>
                  <li>Principle: Include</li>
                  <li>Profit: 70%</li>
                  <li>Payment type: Instant</li>
                </ul>
                <a class="btn btn-lg text-white text-uppercase btn-theme-colored2 btn-block pt-20 pb-20 btn-flat" href="../app/login">Deposit Now</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
              <div class="pricing-table text-center pb-0 mt-sm-0 maxwidth400 bg-lighter">
                <h4 class="mt-0 mb-0 pt-20 pb-20 text-uppercase bg-theme-colored2 text-white">Bussiness Pro</h4>
                <h3 class="price-num bg-theme-colored-transparent-1 pt-30 pb-30 mt-0 mb-0">100% After 1 Week<br>
<b style="
    color: #fead10;
">1 Week</b> </h3>
                <ul class="table-list list-icon theme-colored mt-10">
                  <li>Min: $5000 max: $Unlimited</li>
                  <li>Principle: Include</li>
                  <li>Profit: 100%</li>
                  <li>Payment type: Instant</li>
                </ul>
                <a class="btn btn-lg text-white text-uppercase btn-theme-colored btn-block pt-20 pb-20 btn-flat" href="../app/login">Deposit Now</a>
              </div>
    </section>


<style type="text/css">


</style>

<script src="styles/setting2.js"></script>

	</div>
</section>



    
  <!-- end main-content -->
  </div>
 

<!-- footer -->
<?php require('footer.php') ?>

<!-- end of footer -->


</body>


</html> 

