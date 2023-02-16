<!DOCTYPE html>
<html>
<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM product";

$result = mysqli_query($mysqli, $sql);
   require('View/header.php');
?>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>MENU</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  <span>Macaroons</span>
               </h2>
            </div>
            <div class="row">
            <?php
               
               while($row =  mysqli_fetch_array($result)){
                  $id = $row['productId'];
                  $name = $row['pName'];
                  $picture = $row['picture'];
                  $price = $row['price'];
                  
            ?>
               <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <?php echo '<a href="macaroon.php?id='.$id.'"  class="option1">
                              Buy Now
                           </a>'?>
                           <!-- 관리자가 사용할 수 있는 수정/삭제 기능-->
                           <?php
                              if(isset($_SESSION['authorId'])){
                                 echo '<a href="admin-product.php?id='.$id.'" class="option2"> 수정 </a>';
                                 echo '<a href="server/product-delete.php?id='.$id.'" class="option2"> 삭제 </a>';
                              }
                           ?>
                        </div>
                     </div>
                     <div class="img-box">
                        <?php
                           echo '<img src=product/macaroon/'.$picture.' alt="">'
                        ?>
                     </div>
                     <div class="detail-box">
                        <?php
                           echo '<h5>'.$name.'</h5>';
                           echo '<h6>'.$price.'</h6>';
                        ?>
                     </div>
                  </div>
               </div>
               <?php
               }

            ?>
            <!-- 추가하기 기능 -->
            </div>
            <div class="btn-box">
               <?php
                if(isset($_SESSION['authorId'])){
                 echo '<a href="./productadd.php">추가하기 </a>';
                }
               ?>
            </div>
         </div>
      </section>
      <!-- end product section -->
      <!-- footer section -->
      <?php
         require('View/footer.php');
      ?>
   </body>
</html>