<template>
  <div class="container">
    <div class="row">
      <div class="col-10 left padd">
        <!-- tabs -->
        <div class="row box">
          <div class="col-lg-10">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li
                class="nav-item"
                v-for="tab in tabs"
                :key="tab.id"
                style="
                  border: 1px solid rgba(224, 135, 18, 0.2);
                  border-radius: 6px;
                "
              >
                <a
                  class="nav-link active"
                  data-toggle="tab"
                  href=""
                  style="color: rgb(224, 135, 18)"
                  >{{ tab.name }}</a
                >
              </li>
            </ul>
          </div>
          <div class="col-lg-2">
            <button class="btn post_btn">發表文章</button>
          </div>
        </div>
        <!-- tabs -->
        <!-- tables -->
        <div class="articles">
          <!-- 一次顯示最多6篇 -->
          <div class="row">
            <div
              class="col-lg-3 center article_box"
              v-for="article in articles"
              :key="article.id"
            >
              <div class="card article">
                <div class="row">
                  <div class="col-lg-12">
                    <img
                      src="https://www.greenqueen.com.hk/wp-content/uploads/2021/06/WEF-Investments-In-Nature-Based-Solutions-Have-To-Triple-By-2030-To-Address-Climate-Change-Biodiversity-Loss.jpg"
                      width="212"
                      height="120"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5">
                    <div class="card_body card_key">標題</div>
                    <div class="card_body card_key">發文者</div>
                    <div class="card_body card_key">最近更新</div>
                    <div class="card_body card_key">收藏數</div>
                  </div>
                  <div class="col-lg-7">
                    <div class="card_body ct">{{ article.title }}</div>
                    <div class="card_body ct">{{ article.user }}</div>
                    <div class="card_body ct">{{ article.updated }}</div>
                    <div class="card_body ct">{{ article.star }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page">
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
        <!-- tables -->
      </div>
      <div class="col-2 right padd" style="border: 1px solid">開發中</div>
    </div>
  </div>
</template>

<script>
export default {
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
      articles: [
        {
          user: "作者1",
          star: 1,
          title: "123",
          updated: "2021/3/21",
        },
        {
          user: "作者2",
          star: 12,
          title: "456",
          updated: "2021/1/23",
        },
        {
          user: "作者3",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
        {
          user: "作者4",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
        {
          user: "作者5",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
        {
          user: "作者6",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
        {
          user: "作者7",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
        {
          user: "作者8",
          star: 55,
          title: "789",
          updated: "2020/10/10",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/home.scss";
</style>
