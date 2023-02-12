<template>
  <table>
    <tr>
      <hr style="height:2px; border-width: 2px;">
      <th>사진</th>
      <th>상품명</th>
      <th>수량</th>
      <th>총금액(금액)</th>
      <th>취소</th>
    </tr>
      <tr>
        <td><img src="product/macaroon/<?=$picture?>" alt="" style="width:70px; height:70px;"></td>
        <td>이름</td>
        <td>
          <input type="text" id="cnt_<?=$productId?>" value="<?=$productNum?>"></input>
          <button id="up_<?=$productId?>">+</button>
          <button id="down_<?=$productId?>">-</button>
          <button id="edit_<?=$productId?>">edit</button>
        </td>
        <td id="a_<?=$productId?>">
            <span id="every_<?=$productId?>">가격</span><span>/</span>
            <span id="single_<?=$productId?>">가격</span>
        </td>
        <td>
          <button type="button" id="delete_<?=$basketId?>">DELETE</button>
        </td>
      </tr>
    <tr>
      <td colspan="3">Total:</td>
      <td id="totalprice" colspan="2">가격</td>
    </tr>
  </table>
</template>
  
  <script>
  export default {
    data() {
      return {
        headers: ['Column 1', 'Column 2', 'Column 3'],
        rows: [
          {
            id: 1,
            values: ['Row 1, Column 1', 'Row 1, Column 2', 'Row 1, Column 3']
          },
          {
            id: 2,
            values: ['Row 2, Column 1', 'Row 2, Column 2', 'Row 2, Column 3']
          },
          {
            id: 3,
            values: ['Row 3, Column 1', 'Row 3, Column 2', 'Row 3, Column 3']
          },
        ],
      };
    },
  };
  </script>