<template>
  
  <div class="orderlist">
    <h2>주문내역</h2>
      <hr style="height:2px; border-width: 2px;">
    <div style="width:100%; height:600px; overflow:auto">
    <table>
      <tr>
        <th>번호</th>
        <th>주문일</th>
        <th>상품명</th>
        <th>결제금액</th>
        <th>배송현황</th>
      </tr>
      <tr>
        <td><hr style="height:2px; border-width: 2px;"></td>
        <td><hr style="height:2px; border-width: 2px;"></td>
        <td><hr style="height:2px; border-width: 2px;"></td>
        <td><hr style="height:2px; border-width: 2px;"></td>
        <td><hr style="height:2px; border-width: 2px;"></td>
      </tr>
      <tr v-for="(item, index) in filternumber" :key="index" >
        <td>{{ index+ startnum }}</td>
        <td>{{ item.date }}</td>
        <td>
          <img :src="`product/macaroon/${item.picture}`" alt="" style="width:70px; height:70px;"/> 
          {{ item.pName }}
        </td>
        <td>
          <span>{{item.saleprice}} </span>
        </td>
        <td>
          <button type="button">{{ item.dstatus }}</button>
        </td>
      </tr>
    </table>
    <!--페이지네이션 기능-->
      <div class="pagination">
        <p @click="backwardpage(nowpage)">&laquo;</p>
          <p v-for="(item , index) in totalPages" :key="index" @click="pagechange(index+1)" :style="[ index+1 === nowpage ? { 'background-color': '#f77b81'} : {'background-color': 'white'}]">
            {{ index + 1 }}
          </p>
        <p @click="forwardpage(nowpage)">&raquo;</p>
      </div>
  </div>
  </div>
</template>
<script>

export default {
  data() {
    return {
      cookie : [],
      //페이지네이션에 필요한 변수들
      itemsPerPage : 5,
      startnum : 1,
      endnum : 6,
      nowpage : 1,
      forward : null,
    };
  },
  computed: {
    totalPrice() {
      return this.items.reduce((acc, item) => acc + item.price * item.count, 0);
    },
    //전체 필요한 페이지 수 계산
    totalPages() {
      var list= [];
        var a = this.cookie.length / this.itemsPerPage;
        for (var i=0; i<a; i++) list.push(i);
        console.log(list);
        return list
    },
    //한 페이지에 나올 아이템 수 제한
    filternumber() {
      return this.cookie.filter((item, index) => index < this.endnum && index >= this.startnum);
    },

  },

  methods: {
    //페이지 변화
    pagechange(num) {
       this.nowpage = num;
       this.startnum = 5 * num - 4;
       this.endnum = 5 * num + 1;
    },
    //페이지 큰 숫자로
    forwardpage() {
      if(this.nowpage < this.totalPages.length){
        this.pagechange(this.nowpage + 1);
      }

    },
    //페이지 작은 숫자로
    backwardpage() {
        if(this.nowpage > 1){
          this.pagechange(this.nowpage - 1);
        }
    },



  },

  async mounted() {
    
    axios
        .get('./server/mypage-order.php')
        .then(response => {
          this.cookie = response.data;
          this.page = this.cookie.length;
        })

  }
};

</script>

<style scoped>
.orderlist {
  width: 80%;
  margin: 20px auto;
  padding: 20px;
  text-align: center;
}

h2 {
    text-align: left;
}

table{
    width: 100%;
}

.pagination {
  display: inline-block;
}

.pagination p {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
.pagination p.active {
  background-color: #4CAF50;
  color: white;
}

.pagination p:hover:not(.active) {background-color: #ddd;}
</style>
