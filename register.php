<!DOCTYPE html>
<html>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- start header section -->
   <?php
      require("View/header.php");
   ?>
   <!-- end header section -->
   <div class="container">

    <div class="input-form-backgroud row">
      <div class="input-form col-md-12 mx-auto">
        <h4 class="mb-3">회원가입</h4>
        <form method="post" action="server/register-check.php" class="validation-form" novalidate>
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="aid">아이디</label>
                  <input type="text" class="form-control" name="aid" value="" required>
                     <div class="invalid-feedback">
                        아이디를 입력해주세요.
                     </div>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="anickname">이름</label>
                  <input type="text" class="form-control" name="anickname" placeholder="" value="" required>
                  <div class="invalid-feedback">
                     이름을 입력해주세요.
                  </div>
               </div>
            </div>

            <div class="p1">
               <label for="apassword">비밀번호</label>
               <input type="password" class="form-control" id = "password1" name="apassword" placeholder="" required>
               <div class="invalid-feedback">
                비밀번호를 입력해주세요.
               </div>
            </div>

            <div class="p2">
               <label for="apasswordConfirm">비밀번호 확인</label>
               <input type="password" class="form-control" id = "password2" placeholder="" required>
               <div class="invalid-feedback">
                  비밀번호를 다시 입력해주세요.
               </div>
            </div>

            <div class="mb-3">
               <label for="aphone">전화번호</label>
               <input type="text" class="form-control" name="aphone" placeholder="-를 제외하고 번호만 입력해주세요.(예:010xxxxxxxx)" required>
               <div class="invalid-feedback">
                  전화번호를 입력해주세요.
               </div>
            </div>

            <div class="mb-3">
               <label for="aemail">이메일</label>
               <input type="email" class="form-control" name="aemail" placeholder="macaron@example.com" required>
               <div class="invalid-feedback">
                  이메일을 입력해주세요.
               </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3">
                     <label for="abirth">생년월일</label>
                     <input type="month" class="form-control" name="abirth" value="" required>
                  <div class="invalid-feedback">
                     생년월일을 입력해주세요.
                  </div>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="agender">성별</label>
                  <div class="row">
                     <div class="col-sm-3"> <input type="radio"  name="agender" value="남" required> </div>
                     <div class="col-sm-3"> <label for="man">남</label></div>
                     <div class="col-sm-3"> <input type="radio"  name="agender"  value="여" required> </div>
                     <div class="col-sm-3"> <label for="woman">여</label></div>
                  </div>
                  <div class="invalid-feedback">
                     성별을 선택해주세요.
                  </div>
               </div>
            </div>


            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="address">주소</label>
                  <input type="hidden" id="sample4_postcode" placeholder="우편번호">
                  <input type="text" class="form-control" name="address" id= "sample4_roadAddress" placeholder="도로명주소" required>
                  <input type="button" style="background-color:Lightpink; color:white; border: solid 1px var( --border-gray-color);" onclick="sample4_execDaumPostcode()" value="우편번호 찾기">
                  <span id="guide" style="color:#999;display:none"></span>
                     <div class="invalid-feedback">
                     주소를 입력해주세요.
                     </div>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="address2">상세주소</label>
                  <input type="text" class="form-control" name="address2" placeholder="상세주소를 입력해주세요." required>
                  <div class="invalid-feedback">
                     상세주소를 입력해주세요.
                  </div>
               </div>
            </div>

            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
               <input type="checkbox" class="custom-control-input" id="aggrement" required>
               <label class="custom-control-label" for="aggrement">개인정보 수집 및 이용에 동의합니다.</label>
            </div>
            <div class="mb-4"></div>
            <button class="btn btn-primary btn-lg btn-block" style="background-color:pink; border: solid 1px var( --border-gray-color);" type="submit" onclick="Server/register-check.php">가입 완료</button>
        </form>
      </div>
    </div>
   </div>
      <!-- footer start -->
      <?php
            require("View/footer.php");
      ?>
      <!-- footer finish -->

      <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
      <script>
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

               if(isNaN(form[4].value)){
                  event.preventDefault();
                  event.stopPropagation();
                  alert("전화번호에는 숫자만 입력해주세요.(예:010xxxxxxxx)");
               }

               form.classList.add('was-validated');
            }, false);
            });

         }, false);

         
      </script>
   </body>
</html>