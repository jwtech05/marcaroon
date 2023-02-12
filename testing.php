<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="../css/index.css" rel="stylesheet" />
    <link href="../css/working.css" rel="stylesheet" />
  </head>
  <body>
    <div id="app">
      <div>
        <router-link to="/video">video</router-link>
        <router-link to="/login">Login</router-link>
        <router-link to="/home">home</router-link>
        <router-link to="/home1">home1</router-link>
      </div>
      <router-view></router-view>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-router@3.3.4/dist/vue-router.js"></script>
    <script src="https://unpkg.com/vue-router@3.5.1/dist/vue-router.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.22.0/dist/axios.min.js"></script>
    <script>
      const video = {
        template: `
          <div id="video">
            <!-- 영상 콘텐츠들 -->
            <ytn-page-manager id="page-manager" class=" ytd-app">
                <div id="contents" class=" ytd-rich-grid-renderer">
                    <div id="content-box" v-for="(item, i) in videos">
                        <div id="content">
                            <div id="content-video-item" style="width: 250px; height: 140px;">
                                <a id="thumbnail-link" :href="item.videoUrl">
                                    <img class="thumbnail-img" :src="item.thubnailImgUrl">
                                </a>
                            </div>

                            <div id="datails">
                                <div>
                                    <img id="avatar-link" :src="item.profileImgUrl" height="50">
                                </div>

                                <div id="meta">
                                    <h2 class="title">{{item.videoTitle}}</h2>
                                    <div id="metadata">
                                        <div id="byline-container">
                                            <span>{{item.chanelName}}</span>
                                        </div>
                                        <div id="metadata-line">
                                            <span>{{item.view}} </span>
                                            <span>{{item.uploadDate}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ytn-page-manager>
        </div>`,

        // 비디오 Vue
        el: "#video",

        // [데이터] ----------------------------------------------------------------
        data() {
          return {
            videos: [
              {
                videoId: 1,
                videoUrl: "../html/video_watch.php?v=1",
                thubnailImgUrl: "../res/images/0a4f342e5088d3ebf3acb2.jpg",
                profileImgUrl: "../res/images/0a4f342e5088d3ebf3acb2.jpg",
                videoTitle: "제목입니다",
                chanelName: "채널이름입니다",
                view: "조회수12회",
                uploadDate: "업로드날짜 12일전",
              },
            ],
            page: 1,
            perPage: 3,
          };
        },

        // [라이프사이클] -----------------------------------------------------------
        // 라이프사이클 (생성) : computed, methods, watch 접근 가능 but Dom 추가는 안됨
        created() {
          // 스크롤 이벤트 리스너 등록
          window.addEventListener("scroll", this.infiniteHandler);
          this.loadInitData();
        },

        // 라이프사이클 (종료전) : 인스턴스가 해체되기 직전에 호출
        beforeDestroy() {
          // 스크롤 이벤트 리스너 삭제
          window.removeEventListener("scroll", this.infiniteHandler);
        },

        // [메소드] ----------------------------------------------------------------
        methods: {
          // 스크롤 이벤트 핸들러
          infiniteHandler() {
            let scrollY = window.scrollY || window.pageYOffset;
            let totalHeight = document.body.offsetHeight;
            let currentPos = window.innerHeight + scrollY;
            if (currentPos + 5 >= totalHeight) {
              this.page += 1;
              this.loadMoreData();
            }
          },

          // 최초 데이터 불러오기
          async loadInitData() {
            try {
              // 백앤드에 data 요청
              const response = await axios.get(
                "../server/process_video_data.php"
              );
              // vue에 data 추가
              this.videos = this.videos.concat(response.data);
            } catch (error) {
              console.error(error);
            }
          },

          // 추가 데이터 불러오기
          async loadMoreData() {
            try {
              // 백앤드에 data 요청
              const response = await axios.get(
                "../server/process_video_data.php"
              );
              // vue에 data 추가
              this.videos = this.videos.concat(response.data);
            } catch (error) {
              console.error(error);
            }
          },
        },
      };

      const Home = {
        template: "<div>home</div>",
        mounted() {
          console.log("test");
          axios.get("./view/VideoView.html").then((response) => {
            console.log(this.template);
            this.template = response.data;
            console.log(this.template);
          });
        },
      };

      const Home1 = {
        data() {
          return {
            content: "<div></div>",
          };
        },
        mounted() {
          console.log("test");
          axios.get("./view/VideoView.html").then((response) => {
            this.content = response.data;
          });
        },
        render(h) {
          return h("div", { domProps: { innerHTML: this.content } });
        },
      };

      // 라우터 인스턴스 생성
      const myrouter = new VueRouter({
        // 페이지의 라우팅 정보
        routes: [
          // 메인 페이지 정보
          {
            path: "/video",
            component: video,
          },
          {
            path: "/home",
            component: Home,
          },
          {
            path: "/home1",
            component: Home1,
          },
        ],
      });

      //인스턴스에 라우터 인스턴스를 등록
      const app = new Vue({
        el: "#app",
        router: myrouter,
      });
    </script>
  </body>
</html>