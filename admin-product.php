<!DOCTYPE html>
<html>
    <?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$id = $_GET["id"];
$sql = "
    SELECT * FROM product WHERE productId='{$id}'
";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$name = $row['pName'];
$price = $row['price'];
$picture = $row['picture'];
$description = $row['description'];
         require('view/header.php')
      ?>
         <!-- end header section -->

        <!-- productInfo section -->
             <section class="productInfo section">
                <div class="productLayout">
                    <div class="myDiv">
                        <?php
                         echo "<img src='product/macaroon/{$picture}' width='500' height='600'>"
                        ?>
                    </div>
                    <div class="heyDiv">
                        <form action="server/product-edit.php" method="POST">
                            <div class="title">
                                <input type="hidden" name="Id"  value="<?=$id?>">
                            </div><hr>
                            <div class="title">
                                <h2><input type="text" name="editName" placeholder="상품이름" value="<?=$name?>"></h2>
                            </div><hr>
                            <div class="price">
                                <h2><input type="text" name="editPrice" placeholder="상품가격" value="<?=$price?>">원</h2>
                            </div><hr>
                            <div class="fee">
                                <p>배송비: 총 결제금액이 10,000원 미만시 배송비 2,700원이 청구됩니다.</p>
                            </div><hr>
                            <div class="quantity">
                                <p><h2><input type="text" name="editDescript" placeholder="상품설명" value="<?=$description?>"></h2></p>		
                            </div><hr>
                            <div class="final"> 
                                <p>총 상품 금액: 2000원</p>
                            </div><hr>
                            <div class="pButton">
                                <button type="submit" name="realButton">수정하기</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        <!-- end productInfo section -->
      <!-- footer start -->
      <?php
         require('view/footer.php')
      ?>
      <!-- footer end -->
   </body>
</html>