<!DOCTYPE html>
<html>
    <?php
         require('view/header.php')
      ?>
         <!-- end header section -->

        <!-- productInfo section -->
             <section class="productInfo section">
                <div class="productLayout">
                    <div class="myDiv">
                    <label for="file">이미지 선택:</label>
                    <form enctype="multipart/form-data">
                        <input type="file" name="fileToUpload"style="width: 400px">
                        <br><br>
                        <img id="preview" style="max-width:500px;">
                        <br><br>
                        <input type="button" id="uploadButton" name="submit" value="사진업로드" style="width : 200px">
                    </form>
                    <br><br>
                    <div id="status"></div>
                    </div>
                    <div class="heyDiv">
                        <form action="./server/product-add.php" method="POST">
                            <div class="title">
                                <input type="hidden" name="Id"  value="">
                            </div><hr>
                            <div class="title">
                                <h2><input type="text" name="addName" placeholder="상품이름" value=""></h2>
                            </div><hr>
                            <div class="price">
                                <h2><input type="text" name="addPrice" placeholder="상품가격" value="">원</h2>
                            </div><hr>
                            <div class="fee">
                                <p><input type="text" name="addNotice" placeholder="배송비공지" value="배송비: 총 결제금액이 10,000원 미만시 배송비 2,700원이 청구됩니다."></p>
                            </div><hr>
                            <div class="quantity">
                                <p><h2><input type="text" name="addDescript" placeholder="상품설명" value=""></h2></p>		
                            </div><hr>
                            <div class="pButton">
                                <button type="submit" id="addproduct" name="realButton">추가하기</button> 
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
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
		function previewFile() {
			var preview = document.getElementById('preview');
			var file = document.querySelector('input[type=file]').files[0];
			var reader = new FileReader();

			reader.onloadend = function () {
				preview.src = reader.result;
			}

			if (file) {
				reader.readAsDataURL(file);
			} else {
				preview.src = "";
			}
		}

		document.querySelector('input[type=file]').addEventListener("change", previewFile);

        $(document).ready(function() {
        $("#uploadButton").click(function() {
          var formData = new FormData();
          formData.append("fileToUpload", $("input[name=fileToUpload]")[0].files[0]);
          $.ajax({
            url: "./server/image-upload.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
              $("#status").text("Upload successful");
            },
            error: function(xhr, status, error) {
              $("#status").text("Upload failed: " + xhr.responseText);
            }
          });
        });
      });
	</script>
</html>