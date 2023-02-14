<template>
  <div class="memberInfo">
  <h2>회원정보</h2>
    <hr style="height:2px; border-width: 2px;">
    <!--회원정보 테이블-->
    <table style="width:100%">
      <tr>
        <th style="width: 15%;">이름</th>
        <td> <input type="text" v-model="message"/></td>
      </tr>
      <tr>
        <th>아이디</th>
        <td> {{ message }} </td>
      </tr>
      <tr>
        <th>이메일</th>
        <td><input type="text" v-model="reverseMessage"/></td>
      </tr>
      <tr>
        <th>연락처</th>  
        <td><input type="text" v-model="phone"/></td>
      </tr>
      <tr>
        <th>기본주소</th>  
        <td><input type="text" v-model="address"/>  <input type="text" v-model="address2"/></td>
      </tr>
    </table>
    <!--회원수정 post 버튼-->
    <div class="pButton">
      <button type="button" @click="newInfo">회원정보 수정하기</button>
    </div>
  </div>
</template>

<script>



export default {
data() {
    return {
        username : null,
        Id : null,
        email : null,
        phone : null,
        address : null,
        address2 : null,
        message : "Hello Vue.js!"
        
    };
},

watch: {
  message : {
    handler(val) {
      this.phone = val;
    },
    immediate : true,
  }
},
computed: {
  reverseMessage: function() {
    return this.message.split('').reverse().join('')
  }
},

methods: {
  //회원정보 수정 post 하는 axios
  async newInfo() {
      axios
          .post('./server/member-edit.php', {

              username : this.username,
              email : this.email,
              phone : this.phone,
              address : this.address,
              address2 : this.address2

          })
  }
},
//회원정보 가져오는 axios
async mounted() {
      axios
          .get('./server/member-check.php')
          .then(response => (this.username = response.data.username, 
                              this.Id= response.data.Id,
                              this.email= response.data.email,
                              this.phone= response.data.phone,
                              this.address= response.data.address,
                              this.address2= response.data.address2
                              ));
  }
};

</script>

<style scoped>
.memberInfo {
width: 80%;
margin: 20px auto;
padding: 20px;
text-align: center;
}

h2 {
  text-align: left;
}

table {
  width: 100%;
}

td {
text-align: left;
padding: 20px;

}

th {
  color: #fff;
  background-color: #faa6f3;
}

</style>