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
<div id="app">
  <div id="test">
    <ul>
      <li v-for="(item, index) in lists" :key="index">
        <router-link :to="item.id">{{ item.name }}</router-link>
      </li>
      <router-view></router-view> 
    </ul>
  </div>상금
</div>
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

  createApp({
    data() {
    return {
        lists: [
            { id: 1, name: 'Item 1' },
            { id: 2, name: 'Item 2' },
            { id: 3, name: 'Item 3' }
        ]
        }
    }
    }).mount('#test')

  var routes = [
        {path: '/', redirect: 'item1'}, 
        {
            path:'/1',
            component: Vue.defineAsyncComponent(() => loadModule('./myComponent.vue', options)),
        },
        {
            path:'/2',
            component:Vue.defineAsyncComponent(() => loadModule('./test.vue', options)),
        },
        {
            path:'/3',
            component:Vue.defineAsyncComponent(() => loadModule('./test2.vue', options)),
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

    lists.mount('#test')
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