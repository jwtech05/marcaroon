<?php
//mysql 접속
require('view/header.php');

//배경화면 쿠키 배경색깔 전환`
function bColor() {
   $red = rand(0, 255);
   $green = rand(0, 255);
   $blue = rand(0, 255);
   return "background-color: rgb($red, $green, $blue)";
 }

$productInfo = "
   SELECT * FROM product;
";

$Result = mysqli_query($mysqli, $productInfo);

$member = mysqli_fetch_array($Result);

?>


<!DOCTYPE html>
<html>
         <!--start header section -->
      <?php


      ?>
         <!-- end header section -->
         <!-- slider section -->
         <section class="slider_section ">
            <div class="slider_bg_box">
               <img src="images/middle.jpg" alt="">
            </div>
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    오늘의 마카롱 세상
                                    </span>
                                    <br>
                                    ALL FLAVOR
                                 </h1>
                                 <p>
                                
                                 </p>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item ">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    20%세일 이벤트
                                    </span>
                                    <br>
                                    모든 품목
                                 </h1>
                                 <p>
                                    새해기념 주문하시는 모든 분들에게 20%으로 할인을 진행드리고 있습니다.  많은 참여 부탁드립니다.
                                 </p>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container">
                  <ol class="carousel-indicators">
                     <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                     <li data-target="#customCarousel1" data-slide-to="1"></li>
                  </ol>
               </div>
            </div>
         </section>
         <!-- end slider section -->
      </div>
      <!-- why section -->
      <section class="why_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Best Sellers
               </h2>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="box ">
                     <div class="img-box">
                        <img src="product/macaroon/초코마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           초코 마카롱
                        </h5>
                        <p>
                           so choco choco~
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box ">
                     <div class="img-box">
                        <img src="product/macaroon/딸기마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           딸기 마카롱
                        </h5>
                        <p>
                           so straw berry berry~
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="box ">
                     <div class="img-box">
                        <img src="product/macaroon/바닐라마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           바닐라 마카롱
                        </h5>
                        <p>
                           so nilla nilla Vanilla~
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end why section -->
      
      
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>Macarons</span>
               </h2>
            </div>
            <div class="row">
               <?php
                  for($i=3; $i<12; $i++){
                     $row = mysqli_fetch_array($Result);
                     $id = $row['productId'];
                     $name = $row['pName'];
                     $picture = $row['picture'];
                     $price = $row['price'];
               ?>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style="<?php echo bColor() ?>">
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaroon.php">
                              <button type="submit" class="option1" name="id" value="<?= $id ?>">Buy Now</button>           
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/<?=$picture?>" alt="">
                     </div>
                     <div class="detail-box" >
                        <h5>
                           <?= $name ?>
                        </h5>
                        <h6>
                           <?php echo $price ?>원
                        </h6>
                     </div>
                  </div>
               </div>
               <?php
                  }
               ?>

         </div>
         <div class="btn-box" style="display: flex; justify-content: center; align-items: center;">
               <a href="./product.php">
               View All products
               </a>
            </div>
      </section>
      <!-- end product section -->
      <!-- start footer section -->
      <?php
         require('view/footer.php')
      ?>
      <!-- end footer section -->
   </body>
                  
</html>