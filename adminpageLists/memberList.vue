<template>
  
    <div class="memberlist">
      <h2>회원관리</h2>
        <hr style="height:2px; border-width: 2px;">
      <table>
        <tr nowrap>
          <th>회원번호</th>
          <th>회원명</th>
          <th>회원아이디</th>
          <th>연락처</th>
          <th>생일</th>
          <th>이메일</th>
          <th>성별</th>
          <th>가입일</th>
          <th>마지막활동</th>
          <th>계정상태</th>
        </tr>
        <tr>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
          <td><hr style="height:2px; border-width: 2px;"></td>
        </tr>
        <tr v-for="(item, index) in info" :key="index">
          <td>{{ item.memberId }}</td>
          <td>{{ item.username }}</td>
          <td>{{ item.Id }}</td>
          <td>{{ item.phone }}</td>
          <td>{{item.birth}}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.gender }}</td>
          <td>{{item.enrollDate}}</td>
          <td>{{item.lastUpdate}}</td>
          <td :v-model="statusColor(index,item.signstatus)" :style="styleobject">{{item.signstatus}}</td>
        </tr>
      </table>
      <div class="card-footer pb-0 pt-3">
              <jw-pagination :items="exampleItems" @changePage="onChangePage"></jw-pagination>
          </div>
    </div>
  </template>
  <script>
  
  export default {
    data() {
      return {
        info : null,
        styleobject:{
          color: 'blue'
        }
      };
    },
    computed: {
      totalPrice() {
        return this.items.reduce((acc, item) => acc + item.price * item.count, 0);
      }
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
        async dstat(index, delivery ,orderId) {
            axios
            .post('./server/admin-delivery-status.php', {

                orderNum : orderId,
                dstatus : dstate

            })
        },

        statusColor(index, astatus){
          
          if(astatus == "활동중"){
            this.info[index].styleobject.color = green;
          }

        }
    },
  
    async mounted() {
  
      axios
          .get('./server/admin-member-list.php')
          .then(response => (this.info = response.data))
    
    }
  };
  
  </script>
  
  <style scoped>
  .memberlist {
    width: 80%;
    overflow:auto;
    text-align: center;
    margin: 20px auto;
    table-layout: fixed;
  }
  
  h2 {
      text-align: left;
  }
  
  table{
      width: 100%;
  }
  </style>
  