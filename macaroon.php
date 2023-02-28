<!DOCTYPE html>
<html>
<?php require('view/header.php') ?> 
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: absolute;
  left: 50%;
  top: 50%;
  padding: 30px;
  transform: translate(-50%, -50%);
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<?php

$id = $_GET["id"];

$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    echo "세션연결 끊김";
}else if($status == PHP_SESSION_DISABLED){
    //Sessions are not available
}else if($status == PHP_SESSION_ACTIVE){
    //Destroy current and start new on
}

if(isset($_SESSION['memberId'])){
    $signer = $_SESSION['memberId'];
}else{
    $signer = $_COOKIE['비가입자'];
}

$sql = "
    SELECT * FROM product WHERE productId='{$id}'
";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$productId = $row['productId'];
$name = $row['pName'];
$price = $row['price'];
$picture = $row['picture'];
$description = $row['description'];

     
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
                        <div class="title">
                            <h1><?=$name?></h1>
                        </div><hr>
                        <div class="price">
                            <h2>가격: <?=$price?>원</h2>
                        </div><hr>
                        <div class="fee">
                            <p>배송비: 총 결제금액이 10,000원 미만시 배송비 2,700원이 청구됩니다.</p>
                        </div><hr>
                        <div class="quantity">
                            <div class="subquantity">
                                <p><?=$description?></p>		
                                <input type="text" id=cnt value="0"></input>
                                <button id="up">+</button>
                                <button id="down">-</button>
                            </div><hr>
                        <div class="final"> 
                            <p id="wholePrice">총 상품금액 : 0 원</p>
                        </div><hr>
                        <div class="pButton">
                            <button type="button" id="basket" style="background-color:pink;"  value="<?=$signer?>">장바구니</button>
                            <button type="button" id="rightaway" value="<?=$signer?>">즉시구매</button>
                        </div>
                    </div>
                </div>
            </section>
        <!-- end productInfo section -->

        <!-- modal section start-->
        <div id="myModal" class="modal">
            <div class="modal-content" style="width:500px;">
                <h3>장바구니로 이동하겠습니까?</h3>
                <div class="modal-footer">
                    <button type="button" id="return" class="btn btn-secondary" data-dismiss="modal">돌아가기</button>
                    <button type="button" id="gobasket" class="btn btn-primary" style="background-color:pink;" onclick="window.location.href='basket.php'">장바구니</button>
                </div>
            </div>
        </div>
        <!-- modal section end-->

        <!-- footer start -->
        <?php
            require('view/footer.php')
        ?>
        <!-- footer end -->

      <script src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script>
            const cnt = document.querySelector('#cnt');
            const upbutton = document.querySelector('#up');
            const downbutton = document.querySelector('#down');
            const wholePrice = document.querySelector('#wholePrice');
            let count = 0;

            upbutton.addEventListener('click', function() {
                count++;
                cnt.value = count;
                wholePrice.innerHTML = "총 상품 금액 : " + count *  <?=$price?>+"원";
            });

            downbutton.addEventListener('click', function() {
                if(count > 0){
                    count--;
                    cnt.value = count;
                    wholePrice.innerHTML = "총 상품금액 : " + count *  <?=$price?>+"원";
                }
            });
            //장바구니용
            document.querySelector("#basket").addEventListener('click', () => {

                const sign = document.querySelector('#basket').value;

                if(cnt.value == 0){
                    alert('상품을 1개 이상 선택해주세요.');
                    basket.preventDefault();
                    basket.stopPropagation();
                }
                if(sign != "회원님"){
                    $.ajax({
                    type : 'POST',
                    url : 'Server/basket-add.php',
                    async : true,
                    data: JSON.stringify({
                        "memberId" : <?= $signer ?>,
                        "productId" : '<?=$productId?>',
                        "productName" : '<?=$name?>',
                        "productNum" : $('#cnt').val()
                    }),
                    success : function(result) { // 결과 성공 콜백함수
                        console.log(result);
                        var modal = document.getElementById("myModal");
                        myModal.style.display = "block";
                        var span = document.getElementById("return");
                        span.onclick = function() {
                        modal.style.display = "none";
                    }
                    },
                    error : function(request, status, error) { // 결과 에러 콜백함수
                        console.log(error)
                        alert("실패");
                    }
                    })
                }else{
                    $.ajax({
                    type : 'POST',
                    url : 'Server/non-basket-add.php',
                    async : true,
                    data: JSON.stringify({
                        "productId" : '<?=$productId?>',
                        "productName" : '<?=$name?>',
                        "productNum" : $('#cnt').val()
                    }),
                    success : function(result) { // 결과 성공 콜백함수
                        console.log(result);
                        var modal = document.getElementById("myModal");
                        myModal.style.display = "block";
                        var span = document.getElementById("return");
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                    },
                    error : function(request, status, error) { // 결과 에러 콜백함수
                        console.log(error)
                        alert("실패");
                    }
                    })
                }

            });

            //즉시구매용
            document.querySelector("#rightaway").addEventListener('click', () => {
                console.log("여긴 들어와?");
                const sign = document.querySelector('#basket').value;
                console.log("여긴 들어와?");
                if(cnt.value == 0){
                    alert('상품을 1개 이상 선택해주세요.');
                    basket.preventDefault();
                    basket.stopPropagation();
                }
                if(sign != "회원님"){
                    $.ajax({
                    type : 'POST',
                    url : 'Server/basket-add.php',
                    async : true,
                    data: JSON.stringify({
                        "memberId" : <?= $signer ?>,
                        "productId" : '<?=$productId?>',
                        "productName" : '<?=$name?>',
                        "productNum" : $('#cnt').val()
                    }),
                    success : function(result) { // 결과 성공 콜백함수
                        console.log(result);
                        window.location.href = "./order.php";
                    },
                    error : function(request, status, error) { // 결과 에러 콜백함수
                        console.log(error)
                        alert("실패");
                    }
                    })
                }else{
                    $.ajax({
                    type : 'POST',
                    url : 'Server/non-basket-add.php',
                    async : true,
                    data: JSON.stringify({
                        "productId" : '<?=$productId?>',
                        "productName" : '<?=$name?>',
                        "productNum" : $('#cnt').val()
                    }),
                    success : function(result) { // 결과 성공 콜백함수
                        console.log(result);
                        window.location.href = "./order.php";
                    },
                    error : function(request, status, error) { // 결과 에러 콜백함수
                        console.log(error)
                        alert("실패");
                    }
                    })
                }

            });
            
        </script>
   </body>
</html>