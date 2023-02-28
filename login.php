<!DOCTYPE html>
<html>
<!-- header 시작 -->
<?php

  require('View/header.php');
?>
<style>
  :root{
    --body-background-color: #f5f6f7;
    --font-color: #4e4e4e;
    --border-gray-color : #dadada;
    --naver-green-color: #04c75a;
    --naver-green-border-color: #06b350;
  }
  body{
	  background:var(--body-background-color);
  }

  .main-container{
    width:100%;
    display:flex;
    flex-direction:column;
    align-items:center;
    margin-top: 21px;
  }

  .login-input-section{
    padding-top: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .login-input-wrap{
    width: 465px;
    height: 48px;
    border: solid 1px var( --border-gray-color);
    background: white;
  }

  .password-wrap{
	  margin-top: 13px;
  }

  .login-input-wrap input{
	border: none;
	width:430px;
	margin-top: 10px;
	font-size: 14px;
	margin-left: 10px;
	height:30px;
}

.login-button-wrap {
	padding-top: 13px;
}
.login-button-wrap button{
	width: 465px;
	height :48px;
	font-size: 18px;
	background-color: pink;
	color: white;
	border: solid 1px var( --border-gray-color);
}

.password button{


}

</style>
<!-- header 끝 -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<body>

    <!-- 로그인 로그아웃 section start -->
    <div class="main-container">
      <section class="login-input-section">
        <form action="server/login-check.php" method="POST">
            <div class="login-input-wrap" >
                <input type="text" id="id" name="userId" placeholder="Userid">
            </div>
            <div class="login-input-wrap password-wrap">
                <input type="password" id="password" name="userPassword" placeholder="Password">
            </div>
            <div class="login-button-wrap">
              <button type="submit" class="submit-btn">로그인</button>
            </div>
          </form>
          <form action="register.php" method="GET">
            <div class="login-button-wrap password">
              <button type="submit" class="regist-btn">회원가입</button>
            </div>
          </form>
      </section>
      <!-- 로그인 로그아웃 section end -->
    </div>
  <!-- footer 시작 -->
    <?php
      require('View/footer.php');
    ?>
<div>

</body>
<!-- footer 끝 -->
</html>

<script>
  document.querySelector(".submit-btn").addEventListener('click', () => {
    //로그인 비밀번호 미입력 방지
    const idValue = $('#id').val();
    const passwordValue = $('#password').val();
    if (!idValue || !passwordValue) {
      alert('아이디와 비밀번호를 입력해주세요.');
      event.preventDefault();
    
      return;
    }
    //로그인 폼 보내기
    $.ajax({
      type : 'POST',
      url : 'index.php',
      async : true,
      data: JSON.stringify({
        "id" : $('#id').val(),
        "password" : $('#password').val()
      }),
      success : function(result) { // 결과 성공 콜백함수
          console.log(result);
          //location.href='./index.php';
      },
      error : function(request, status, error) { // 결과 에러 콜백함수
          console.log(error)
          alert("실패");
      }
    })
  });
</script>