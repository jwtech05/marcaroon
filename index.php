<!DOCTYPE html>
<html>
         <!--start header section -->
      <?php
         require('view/header.php');

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
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #c8ff00'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="메론맛.png">Buy Now</button>           
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/메론마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Melon Flavor
                        </h5>
                        <h6>
                           2000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #f700ff'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="계란빵맛.png">Buy Now</button>           
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/계란빵마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           EggBread Flavor
                        </h5>
                        <h6>
                           2000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #00e1ff'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="레몬맛.png">Buy Now</button>           
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/레몬마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Lemon Flavor
                        </h5>
                        <h6>
                           2000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #ff0000'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="브라우니맛.png">Buy Now</button>           
                           </form>
                        </div>   
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/브라우니마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Brownie Flavor
                        </h5>
                        <h6>
                           3000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #00ff00'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="블루베리치약맛.png">Buy Now</button>           
                           </form>
                        </div> 
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/블루베리치약마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           BlueBerry Flavor
                        </h5>
                        <h6>
                           3000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #6f00ff'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="사랑에빠진딸기맛.png">Buy Now</button>           
                           </form>
                        </div> 
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/사랑에빠진딸기마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           FallInLove Flavor
                        </h5>
                        <h6>
                           3000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #ffa600'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="체리초코맛.png">Buy Now</button>           
                           </form>
                        </div> 
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/체리초코마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           WaterMelon Flavor
                        </h5>
                        <h6>
                           4000원
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #0099ff'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="빼빼로맛.png">Buy Now</button>           
                           </form>
                        </div> 
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/빼빼로마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Pepero Flavor
                        </h5>
                        <h6>
                           4000won
                        </h6>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box" style='background-color: #ffee00'>
                     <div class="option_container">
                        <div class="options">
                           <form method="GET" action="macaron.php">
                              <button type="submit" class="option1" name="num" value="피스타치오맛.png">Buy Now</button>           
                           </form>
                        </div> 
                     </div>
                     <div class="img-box">
                        <img src="product/macaroon/피스타치오마카롱.png" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           Pistachio Flavor
                        </h5>
                        <h6>
                           4000won
                        </h6>
                     </div>
                  </div>
               </div>
            </div>
            <div class="btn-box">
               <a href="">
               View All products
               </a>
            </div>
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