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
<div id="app">{{ name }} 마이페이지</div>
<nav class="mypage-nav">
    <div id="lists">
        <router-link id="list" to="/orderlist">주문내역</router-link>  
        <router-link id="list" to="/memberInfo">회원정보</router-link> 
        <router-link id="list" to="/review">상품리뷰</router-link>
        <router-view></router-view> 
    </div>
</nav>

<?php require('view/footer.php'); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue3-sfc-loader/dist/vue3-sfc-loader.js"></script>
<script>

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

createApp({
  data() {
    return {
      name: '회원님!!!!'
    }
  }
}).mount('#app')

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