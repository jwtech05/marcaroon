<!DOCTYPE html>
<html>
<!-- header 시작 -->
<?php
  require('View/header.php');
  $servername = "localhost";
  $username = "root";
  $password = "pchris3528p!!";
  $dbname = "opentutorials";
  
  $mysqli = new mysqli($servername, $username, $password, $dbname);
  
  if(isset($_COOKIE['가입자'])){
      $id = $_SESSION["memberId"];
  }else{
    if(isset($_COOKIE['비가입자'])){
      $id = $_COOKIE['비가입자'];
    }
  }

  $sql = "
      SELECT basketId, member.memberId,picture, pName, productNum, price, product.productId 
      FROM member
      JOIN basket
      ON member.memberId = basket.memberId
      JOIN product 
      ON product.productId = basket.productId
      WHERE member.memberId = '{$id}';
  ";

  $result = mysqli_query($mysqli, $sql);
  $totalprice = 0;
?>
<style>
.shopping-basket {
  width: 80%;
  margin: 20px auto;
  padding: 20px;
  text-align: center;
}

table{
    width: 100%;
}

h2 {
    text-align: left;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>
<!-- header 끝 -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<body>
<div class="shopping-basket">
  <h2>장바구니</h2>
  <table>
    <tr>
      <hr style="height:2px; border-width: 2px;">
      <th>사진</th>
      <th>상품명</th>
      <th>수량</th>
      <th>총금액(금액)</th>
      <th>취소</th>
    </tr>
    <?php while($row = mysqli_fetch_array($result)){
   
      $basketId = $row['basketId'];
      $picture = $row['picture'];
      $pName = $row['pName'];
      $productNum= $row['productNum'];
      $price= $row['price'];
      $productId = $row['productId'];

      $lastprice = $price * $productNum;

      $totalprice += $lastprice;
      ?>
      <tr>
        <td><img src="product/macaroon/<?=$picture?>" alt="" style="width:70px; height:70px;"></td>
        <td><?=$pName?></td>
        <td>
          <input type="text" id="cnt_<?=$productId?>" value="<?=$productNum?>"></input>
          <button id="up_<?=$productId?>">+</button>
          <button id="down_<?=$productId?>">-</button>
          <button id="edit_<?=$productId?>">edit</button>
        </td>
        <td id="a_<?=$productId?>">
            <span id="every_<?=$productId?>"><?=$lastprice?></span><span>/</span>
            <span id="single_<?=$productId?>"><?=$price?></span>
        </td>
        <td>
          <button type="button" id="delete_<?=$basketId?>"name="deletebutton">DELETE</button>
        </td>
      </tr>
    <?php  }?>
    <tr>
      <td colspan="3">Total:</td>
      <td id="totalprice" colspan="2"><?=$totalprice?></td>
    </tr>
  </table>
  <div class="pButton">
    <button type="button" name="orderbutton" onclick="window.location.href='order.php'">주문하기</button>
  </div>
</div>
   
  <!-- footer 시작 -->
    <?php
      require('View/footer.php');
    ?>
<div>
<script>
      const upbuttons = document.querySelectorAll('[id^="up_"]');
      const downbuttons = document.querySelectorAll('[id^="down_"]');
      const editbuttons = document.querySelectorAll('[id^="edit_"]');
      const deletebuttons = document.querySelectorAll('[id^="delete_"]');
      //수량 올리는 버튼
      upbuttons.forEach(function(upbutton){
        upbutton.addEventListener('click', function() {
            const productId = upbutton.id.split('_')[1];
            const cnt = document.querySelector('#cnt_'+productId);
            let count = parseInt(cnt.value);
            count++;
            cnt.value = count;         
        });
      });
      //수량 내리는 버튼
      downbuttons.forEach(function(downbutton){
        downbutton.addEventListener('click', function() {
            const productId = downbutton.id.split('_')[1];
            const cnt = document.querySelector('#cnt_'+productId);
            let count = parseInt(cnt.value);
            if(count > 0){
              count--;
              cnt.value = count;
            }
        });
      });
      //바뀐 수량 적용 버튼
      editbuttons.forEach(function(editbutton){
        editbutton.addEventListener('click', function() {
          const productId = editbutton.id.split('_')[1];
          const cnt = document.querySelector('#cnt_'+productId);
          const single = document.querySelector('#single_'+productId);
          const every = document.querySelector('#every_'+productId);
          const total = document.querySelector('#totalprice');
          let count = parseInt(cnt.value);
          let newSingle = parseInt(single.innerHTML);
          let originevery = parseInt(every.innerHTML);
          let origintotal = parseInt(total.innerHTML);
          console.log(count);
          console.log(newSingle);
          $.ajax({
            type : 'POST',
            url : 'Server/basket-edit.php',
            async : true,
            data: JSON.stringify({
              "productNum" : count,
              "productId" : productId
            }),
            success : function(result) { // 결과 성공 콜백함수
                console.log(result);
                alert("성공");
                every.innerHTML = count * newSingle; 
                total.innerHTML = origintotal - originevery + (count * newSingle);
            },
            error : function(request, status, error) { // 결과 에러 콜백함수
                console.log(error)
                alert("실패");
            }
          })     
        });
      });

      deletebuttons.forEach(function(deletebutton){
        deletebutton.addEventListener('click', function() {
            const basketId = deletebutton.id.split('_')[1];

            $.ajax({
            type : 'POST',
            url : 'Server/basket-delete.php',
            async : true,
            data: JSON.stringify({
              "basketId" : basketId
            }),
            success : function(result) { // 결과 성공 콜백함수
                console.log(result);
                location.href='./Server/basket-delete.php';
            },
            error : function(request, status, error) { // 결과 에러 콜백함수
                console.log(error)
                alert("실패");
            }
          })   
        });
      });
</script>
</body>
<!-- footer 끝 -->
</html>
