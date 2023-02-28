<!DOCTYPE html>
<html>
<?php
  require('view/header.php');
  //mysql 접속
  require('./server/mysql-connect.php'); 

  if(isset($_COOKIE['가입자'])){
      $id=$_SESSION['memberId'];
  }

  $basketInfo = "
      SELECT basketId, member.memberId,picture, pName, productNum, price, product.productId 
      FROM member
      JOIN basket
      ON member.memberId = basket.memberId
      JOIN product 
      ON product.productId = basket.productId
      WHERE member.memberId = '$id';
      ;
  ";

  $memberInfo = "
      SELECT * 
      FROM member
      WHERE memberId = '{$id}';
  ";

  $bResult = mysqli_query($mysqli, $basketInfo);
  $mResult = mysqli_query($mysqli, $memberInfo);

  $totalprice = 0;
  $member = mysqli_fetch_array($mResult);
  $array = [];
  $priceArray = [];
?>
<style>
  .orderform {
  width: 80%;
  margin: 20px auto;
  padding: 20px;

}
th, td {
    border-bottom: 0.5px solid #444444;
    padding: 10px;
    border-color:pink;
}

.info{
  padding-bottom:80px;
}
.shopping-basket {
  width: 100%;
}
table{
    width: 100%;
}
</style>
<body>

<div class="orderform">
<!-- 주문자 정보 시작 -->  
  <div class ="ordererinfo">
    <h2>주문자정보</h2>
    <hr style="height:2px; border-width: 2px;">
      <div class="info">
      <table style="width:100%">
        <tr>
          <th style="width: 15%;">이름</th>
          <td><?=$member['username']?></td>
        </tr>
        <tr>
          <th>이메일</th>
          <td><?=$member['email']?></td>
        </tr>
        <tr>
          <th>연락처</th>  
          <td><?=$member['phone']?></td>
        </tr>
      </table>
      </div>
  </div>
<!-- 주문자 정보 끝 -->

<!-- 배송 정보 시작 -->  
  <div class ="shipinfo">
    <h2>배송 정보</h2>
    <hr style="height:2px; border-width: 2px;">
    <div class="info">
      <table style="width:100%">
        <tr>
          <th  style="width: 15%;">이름</th>
          <td><input style="width:300px;" type="text" id="receiver" class="form-control" name="aname" value="<?=$member['username']?>" required></td>
        </tr>
        <tr>
          <th style="width: 15%;">연락처</th>
          <td><input style="width:300px;" type="text" class="form-control" id="phoneNum" name="aname" value="<?=$member['phone']?>" required></td>
        </tr>
        <tr>
          <th style="width: 15%;">주소</th>
          <td>
            <input type="radio" id="origin" name="fav_language" value="a" checked onclick="changeValue(this)">
            <label for="html">기본배송지</label>
            <input type="radio" id="new" name="fav_language" value="b"  onclick="changeValue(this)">
          <label for="css">새로운배송지</label>
          </td>
        </tr>
        <tr>
          <th style="width: 15%;">배송지</th>
          <td> <input type="hidden" id="sample4_postcode" placeholder="우편번호">
              <div class="addresses">
                <input type="text"style="width:500px;display:inline-block;" class="form-control" name="address" id="sample4_roadAddress" value="<?=$member['address']?>" placeholder="도로명주소" required>
                <input type="text" style="width:500px;display:inline-block;"class="form-control" name="address2" id="address2" value="<?=$member['address2']?>" placeholder="상세주소를 입력해주세요.">
              </div>
              <input type="button" style="background-color:Lightpink; color:white; border: solid 1px var( --border-gray-color);" onclick="sample4_execDaumPostcode()" value="우편번호 찾기">
              <span id="guide" style="color:#999;display:none"></span>
          </td>
        </tr>
        <tr>
          <th style="width: 15%;">주문메세지</th>
          <td><input type="text" style="width:1200px; height:150px;" class="form-control" id="comment" value="" class="form-control"></td>
        </tr>
      </table>
      </div>
  </div>
<!-- 배송 정보 끝 -->

<!-- 상품 정보 시작 -->  
  <div class ="productinfo">
    <h2>상품 정보</h2>
   <div class=info> 
    <div class="shopping-basket">
      <table>
        <tr>
          <hr style="height:2px; border-width: 2px;">
          <th>사진</th>
          <th>상품명</th>
          <th style="width:20%">수량</th>
          <th>총금액(금액)</th>
        </tr>
        <?php while($row = mysqli_fetch_array($bResult)){
      
          $basketId = $row['basketId'];
          $picture = $row['picture'];
          $pName = $row['pName'];
          $productNum= $row['productNum'];
          $price= $row['price'];
          $productId = $row['productId'];

          $lastprice = $price * $productNum;

          $totalprice += $lastprice;
          echo $basketId;
          array_push($array, $row['basketId']);
          array_push($priceArray, $lastprice);
          ?>
          <tr>
            <td><img src="product/macaroon/<?=$picture?>" alt="" style="width:70px; height:70px;"></td>
            <td><?=$pName?></td>
            <td>
              <span id="cnt_<?=$productId?>" value="<?=$productNum?>"><?=$productNum?></span>
            </td>
            <td id="a_<?=$productId?>">
                <span id="every_<?=$productId?>"><?=$lastprice?></span><span>/</span>
                <span id="single_<?=$productId?>"><?=$price?></span>
            </td>
          </tr>
        <?php } 
          $jsonarray = json_encode($array);
          $jsonPriceArray = json_encode($priceArray);
        ?>
        <input type="hidden" id="basketIds" value=<?=$jsonarray?>>
        <input type="hidden" id="prices" value=<?=$jsonPriceArray?>>
        <tr>
          <td colspan="3">Total:</td>
          <td id="totalprice" colspan="2"><?=$totalprice?></td>
        </tr>
      </table>
    </div>
    </div>
  </div>
<!-- 상품 정보 끝 -->

<!-- 가격 정보 시작 -->  
  <div class ="priceinfo">
    <h2>최종 가격</h2>
    <hr style="height:2px; border-width: 2px;">
    <div class="info">
      <table style="width:100%">
        <tr>
          <th style="background-color:pink;">상품금액</th>
          <th style="background-color:pink;"></th>
          <th style="background-color:pink;">배송비</th>
          <th style="background-color:pink;"></th>
          <th style="background-color:pink;">결제 예정금액</th>
        </tr>
        <?php 
          if($totalprice > 10000){
            $shippay = 0;
          }else{
            $shippay = 2700;
          }
          $lastprice = $totalprice + $shippay;
        ?>
        <tr>
          <th style="width:20%; height:100px;"><?=$totalprice?>원</th>
          <th style="width:20%;">+</th>
          <th style="width:20%; height:100px;"><?=$shippay?></th>
          <th style="width:20%;">=</th>
          <th style="width:20%; height:100px;"><?=$lastprice?></th>
        </tr>
      </table>
      </div>
  </div>
<!-- 가격 정보 끝 -->



<!-- 결제 버튼 시작--> 
<div class="pButton">
    <button type="button" id="paybutton" name="paybutton">결제하기</button>
  </div>
</div>
<!-- 결제 버튼 끝--> 
<!-- footer section -->
<?php
    require('View/footer.php');
?>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>

const address = document.querySelector('#sample4_roadAddress').value;
const address2 = document.querySelector('#address2').value;
//결제하기 버튼
const paybutton = document.querySelector('#paybutton');


function changeValue(input) {
  if (input.id === "origin") {
      const readdress = document.querySelector('#sample4_roadAddress').value = address;
      const readdress2 = document.querySelector('#address2').value = address2;
    } else if (input.id === "new") {
      const readdress = document.querySelector('#sample4_roadAddress').value ="";
      const readdress2 = document.querySelector('#address2').value = "";
    }

}
//결제하기 버튼
paybutton.addEventListener('click', () => {
  //배송정보
    const receiver = document.querySelector('#receiver').value;
    const phoneNum = document.querySelector('#phoneNum').value;
    const comment = document.querySelector('#comment').value;
    const readdress = document.querySelector('#sample4_roadAddress').value;
    const readdress2 = document.querySelector('#address2').value;
    const basketIds = document.querySelector('#basketIds').value;
    const prices = document.querySelector('#prices').value;
    $.ajax({
      type : 'POST',
      url : 'Server/order-add.php',
      async : true,
      data: JSON.stringify({
        "receiver" : receiver,
        "phoneNum" : phoneNum,
        "address" : readdress,
        "address2" : readdress2,
        "comment" : comment,
        "items" : basketIds,
        "prices" : prices
      }),
      success : function(result) { // 결과 성공 콜백함수
          console.log(result);
          location.replace('./mypage.php')
      },
      error : function(request, status, error) { // 결과 에러 콜백함수
          console.log(error)
          alert("실패");
      }
    })
  });




//본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
function sample4_execDaumPostcode() {
  new daum.Postcode({
      oncomplete: function(data) {
          // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

          // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
          // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
          var roadAddr = data.roadAddress; // 도로명 주소 변수
          var extraRoadAddr = ''; // 참고 항목 변수

          // 법정동명이 있을 경우 추가한다. (법정리는 제외)
          // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
          if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
              extraRoadAddr += data.bname;
          }
          // 건물명이 있고, 공동주택일 경우 추가한다.
          if(data.buildingName !== '' && data.apartment === 'Y'){
              extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
          }
          // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
          if(extraRoadAddr !== ''){
              extraRoadAddr = ' (' + extraRoadAddr + ')';
          }

          // 우편번호와 주소 정보를 해당 필드에 넣는다.
          document.getElementById('sample4_postcode').value = data.zonecode;
          document.getElementById("sample4_roadAddress").value = roadAddr;
          
          // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
          var guideTextBox = document.getElementById("guide");
          // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
          if(data.autoRoadAddress) {
              var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
              guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
              guideTextBox.style.display = 'block';

          } else if(data.autoJibunAddress) {
              var expJibunAddr = data.autoJibunAddress;
              guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
              guideTextBox.style.display = 'block';
          } else {
              guideTextBox.innerHTML = '';
              guideTextBox.style.display = 'none';
          }
      }
  }).open();
}
    window.addEventListener('load', () => {
      const forms = document.getElementsByClassName('validation-form');
      Array.prototype.filter.call(forms, (form) => {
      form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }

          if(form[2].value != form[3].value) {
            event.preventDefault();
            event.stopPropagation();
            alert("비밀번호가 일치하지 않습니다.");
          }
          form.classList.add('was-validated');
      }, false);
      });

    }, false);


    
    
</script>
</body>
</html>