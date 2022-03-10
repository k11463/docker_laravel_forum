<template>
  <div class="container">
    <div class="row">
      <div class="col-10 left padd">
        <!-- tabs -->
        <div class="row">
          <div class="col-lg-10">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li
                class="nav-item"
                v-for="tab in tabs"
                :key="tab"
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
          <div class="head">
            <div class="row">
              <div class="col-lg-1 col-md-2">作者</div>
              <div class="col-lg-1 col-md-2">收藏數</div>
              <div class="col-lg-8 col-md-4">部分內容</div>
              <div class="col-lg-2 col-md-4">更新時間</div>
            </div>
          </div>
          <div class="body">
            <!-- 一次顯示最多十篇 -->
            <div class="row" v-for="article in articles" :key="article">
              <div class="col-lg-1 col-md-2 ele">{{ article.maker }}</div>
              <div class="col-lg-1 col-md-2 ele">{{ article.star }}</div>
              <div class="col-lg-8 col-md-4 ele">{{ article.context }}</div>
              <div class="col-lg-2 col-md-4 ele">{{ article.updated }}</div>
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
          maker: "作者1",
          star: 1,
          context: "123",
          updated: "2021/3/21",
        },
        {
          maker: "作者2",
          star: 12,
          context: "456",
          updated: "2021/1/23",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
        {
          maker: "作者3",
          star: 55,
          context: "789",
          updated: "2020/10/10",
        },
      ],
    };
  },
};
</script>

