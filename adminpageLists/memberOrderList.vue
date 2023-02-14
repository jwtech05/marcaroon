<template>
    <div class="orderlist">
      <div class="front"> 
        <h2>주문관리</h2> 
        <select @change="changeSearch" v-model="selectedSearch">
          <option value="">==검색==</option>
          <option :value="search.code" :key="search.code" v-for="search in searchList">{{ search.title }}</option>
        </select>
        <input type="search" v-model="searchword"> <button @click="search(selectedSearch)" id="searchbutton" >검색</button>
      </div>     
        <hr style="height:2px; border-width: 2px;">

      <table>
        <tr>
          <th>회원명</th>
          <th>회원아이디</th>
          <th>상품명</th>
          <th>결제금액</th>
          <th>배송현황</th>
          <th>주문일</th>
          <th>취소</th>
        </tr>
        <tr>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
        </tr>
        <tr v-for="(item, index) in filternumber" :key="index">
          <td>{{ item.username }}</td>
          <td>{{ item.memberId }}</td>
          <td>{{ item.pName }}</td>
          <td>{{item.saleprice}}({{ item.productNum }}EA)</td>
          <td style="color :crimson" >{{ item.delivery }}
            <button type="button" @click="dstat(index+startnum, item.delivery, item.orderId)">변경</button>
          </td>
          <td>{{item.date}}</td>
          <td><button type="button" @click="deleteItem(index+startnum, item.orderId)"> 주문취소 </button></td>
        </tr>
      </table>
          <!--페이지네이션 기능-->
      <div class="pagination">
        <p @click="backwardpage(nowpage)">&laquo;</p>
          <p v-for="(item , index) in totalPages" :key="index" @click="pagechange(index+1)" :style="[ index+1 === nowpage ? { 'background-color': '#fad3a6'} : {'background-color': 'white'}]">
            {{ index + 1 }}
          </p>
        <p @click="forwardpage(nowpage)">&raquo;</p>
      </div>
    </div>
  </template>
  <script>
  
  export default {
    data() {
      return {
        info : [],
        searchList: [
          {code: '01', title: '회원명'},
          {code: '02', title: '아이디'},
          {code: '03', title: '배송'}
        ],
        selectedSearch : '',
        searchword: '',
        //페이지네이션에 필요한 변수들
        itemsPerPage : 10,
        startnum : 1,
        endnum : 11,
        nowpage : 1,
      };
    },
    computed: {
      totalPrice() {
        return this.items.reduce((acc, item) => acc + item.price * item.count, 0);
      },
      //전체 필요한 페이지 수 계산
      totalPages() {
      var list= [];
        var a = parseInt(this.info.length / this.itemsPerPage);
        for (var i=0; i<a; i++) list.push(i);
        console.log(list);
        return list
    },
        //한 페이지에 나올 아이템 수 제한
    filternumber() {
      return this.info.filter((item, index) => index < this.endnum && index >= this.startnum);
    },
    },
    methods: {
    //주문취소버튼
        async deleteItem(index, orderId) {
            console.log(orderId);
            this.info.splice(index, 1);
            axios
            .post('./server/admin-delivery-cancel.php', {

                orderNum : orderId

            })
        },
    //배송현황 변경 버튼
        async dstat(index, delivery ,orderId) {

            var dstate = 0;

            if(delivery == '주문완료'){
                this.info[index].delivery = '배송중';
                dstate = 1
            }else if(delivery == "배송중"){
                this.info[index].delivery = '배송완료';
                dstate = 2
            }else if(delivery == "배송완료"){
                this.info[index].delivery = '주문완료';
                dstate = 0
            }
            axios
            .post('./server/admin-delivery-status.php', {

                orderNum : orderId,
                dstatus : dstate

            })
        },
    
       async search(index) {
        //검색시 페이지 번호 초기화
        this.pagechange(0);
        this.nowpage = 1;

        if(this.searchword != ''){
          if(index == '01'){
            axios
              .post('./server/admin-member-search.php',{
                  index : 1,
                  word : this.searchword
              })
              .then(response => (this.info = response.data))
              console.log(this.info);
          }else if(index == '02'){ 
            axios
            .post('./server/admin-member-search.php',{
                  index : 2,
                  word : this.searchword
              })
              .then(response => (this.info = response.data))
              console.log(this.info);
          }else if(index == '03'){
            axios
            .post('./server/admin-member-search.php',{
                  index : 3,
                  word : this.searchword
              })
              .then(response => (this.info = response.data))
              console.log(this.info);
          }else{
            alert('검색종류를 정해주세요');
          }
        }else{
          alert('검색어를 입력해주세요');
        }

        },
        //페이지 변화
        pagechange(num) {
          this.nowpage = num;
          this.startnum = 10 * num + 1;
          this.endnum = 10 * num + 11;
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
          .get('./server/admin-mypage-order.php')
          .then(response => (this.info = response.data))
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
  