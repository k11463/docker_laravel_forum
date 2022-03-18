<template>
  <div class="container">
    <div class="row">
      <div class="col-10 left" style="padding: 1.2vw">
        <!-- tabs -->
        <div class="row tabs">
          <div class="col-lg-10 left">
            <button class="btn" v-for="tab in tabs" :key="tab.id">
              {{ tab.name }}
            </button>
          </div>
          <div class="col-lg-2 right">
            <button class="btn create_post_btn" @click="href('/create-post')">
              發表文章
            </button>
          </div>
        </div>
        <!-- tabs -->
        <!-- tables -->
        <div class="row posts">
          <div class="col-lg-12">
            <table>
              <thead>
                <tr>
                  <th class="star">收藏數</th>
                  <th class="title">文章標題</th>
                  <th class="user">作者</th>
                  <th class="update">更新時間</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="star">收藏數</td>
                  <td class="title">文章標題</td>
                  <td class="user">作者</td>
                  <td class="update">更新時間</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="row articles">
          <div class="row box">
            <div class="col-lg-12">
              <div class="element star ct">收藏數</div>
              <div class="element title">文章標題</div>
              <div class="element user ct">文章作者</div>
              <div class="element update ct">最後更新時間</div>
            </div>
          </div>
          <div class="row box article">
            <div class="col-lg-12">
              <div class="element star ct">1</div>
              <div class="element title">title</div>
              <div class="element user ct">user</div>
              <div class="element update ct">update</div>
            </div>
          </div>
        </div> -->
        <div class="row page">
          <div class="col">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- tables -->
      </div>
      <div class="col-2 right padd" style="border: 1px solid">開發中</div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {},
  data() {
    return {
      tabs: [
        {
          name: "電玩相關",
        },
        {
          name: "心情抒發",
        },
        {
          name: "發問專區",
        },
      ],
      posts: [],
    };
  },
  methods: {
    href(url) {
      console.log(url);
      window.location.href = url;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/home.scss";
</style>
