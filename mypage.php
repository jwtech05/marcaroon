<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/vue-router@4"></script>

</head>
<?php require('view/header.php'); ?>
<body>
<div id="app"><?= $_COOKIE['가입자']?> 마이페이지</div>
<nav class="mypage-nav">
    <div id="lists">
        <router-link id="list" to="/orderlist">주문내역</router-link>  
        <router-link id="list" to="/memberInfo">회원정보</router-link> 
        <router-view></router-view> 
    </div>
</nav>

<?php require('view/footer.php'); ?>
</body>
<!-- 필요한 Vue CDN 코드(router로 연결된 vue 페이지에도 적용된다.)-->
<script src="https://cdn.jsdelivr.net/npm/vue3-sfc-loader/dist/vue3-sfc-loader.js"></script>
<script src="https://unpkg.com/vue-cookies@1.8.2/vue-cookies.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jw-vue-pagination@1.0.3/lib/JwPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-paginate/3.6.0/vue-paginate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginate/2.1.0/index.js"></script>
<script>

// html에서 vue 페이지로 router를 가능하게 해주는 라이브러리
const options = {
      moduleCache: {
        vue: Vue
      },
      async getFile(url) {
        
        const res = await fetch(url);
        if ( !res.ok )
          throw Object.assign(new Error(res.statusText + ' ' + url), { res });
        return {
          getContentData: asBinary => asBinary ? res.arrayBuffer() : res.text(),
        }
      },
      addStyle(textContent) {

        const style = Object.assign(document.createElement('style'), { textContent });
        const ref = document.head.getElementsByTagName('style')[0] || null;
        document.head.insertBefore(style, ref);
      },
}

const { loadModule } = window['vue3-sfc-loader'];
const { createApp } = Vue

const cookie = JSON.parse(this.$cookies.get('가입자'))


//마이페이지 리스트 route 연결
var routes = [
      {path: '/', redirect: '/orderlist'}, 
      {
          path:'/orderlist',
          component: Vue.defineAsyncComponent(() => loadModule('./mypageLists/orderlist.vue', options)),
      },
      {
          path:'/memberInfo',
          component:Vue.defineAsyncComponent(() => loadModule('./mypageLists/memberInfo.vue', options)),
      },
      {
          path:'/review',
          component:Vue.defineAsyncComponent(() => loadModule('./mypageLists/review.vue', options)),
      }
];

const router = VueRouter.createRouter({
// 4. Provide the history implementation to use. We are using the hash history for simplicity here.
history: VueRouter.createWebHashHistory(),
routes, // short for `routes: routes`
})

const lists = Vue.createApp({})
// Make sure to _use_ the router instance to make the
// whole app router-aware.
lists.use(router)

lists.mount('#lists')
</script>
  <style scoped>
  #app {
    background: #f77b81;
    text-align: center;
    color: #fff;
    padding-top: 50px;
    padding-bottom: 40px;
    font-size: 42px;
    font-weight: 800;
  }

  .button-close {
  background-color: red;
  }

  .mypage-nav {
  padding: 40px;
  text-align: center;
  font-size: 27px;
  }

  #list{
    padding-left:150px;
  }

  nav a {
  font-weight: bold;
  color: #2c3e50;
  }

  nav a.router-link-exact-active {
  color: #f77b81;

  }
  </style>
</html>