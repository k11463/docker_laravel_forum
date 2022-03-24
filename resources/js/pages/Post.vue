<template>
  <div class="container">
    <div class="row">
      <div class="col-9 post-area">
        <!-- top side -->
        <div class="top-side d-flex justify-content-between align-items-center">
          <div class="search-area">
            <div class="input-group">
              <select class="form-select" @change="categorySelected">
                <option
                  :value="category"
                  v-for="category in categorys"
                  :key="category.id"
                >
                  {{ category }}
                </option>
              </select>
              <input
                type="text"
                class="form-control"
                placeholder="請輸入要查詢的文章標題"
                @keypress.enter="searchTitle"
                v-model="search.title"
              />
              <button class="btn" @click="searchTitle">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </div>
          <div class="btn-area">
            <button class="btn" @click="href('/post-create')">建立文章</button>
          </div>
        </div>
        <!-- top side -->
        <!-- navs area  -->
        <div class="navs-area">
          <button
            class="me-1 navs"
            v-for="category in categorys"
            :key="category.id"
            @click="changeCategory(category)"
          >
            {{ category }}
          </button>
        </div>
        <!-- navs area  -->
        <!-- post table -->
        <div class="post-table">
          <!-- table title -->
          <div class="table-title d-flex align-items-center">
            <div class="sort me-auto">
              <span>文章排序</span>
              <select @change="changeSort">
                <option
                  :value="option.value"
                  v-for="option in sort_options"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
            </div>
            <div class="poster">發文者</div>
            <div class="updated">最新回復</div>
          </div>
          <!-- table title -->
          <!-- table body -->
          <div
            class="table-body d-flex"
            v-for="post in posts"
            :key="post.id"
            @click="singlePost(post.post_id)"
          >
            <div
              class="
                popular-category
                d-flex
                justify-content-center
                flex-column
                align-items-center
                pt-1
                pb-1
              "
            >
              <div class="badge">
                {{ post.category }}
              </div>
              <div class="popular">
                <i class="fa-solid fa-heart">
                  {{ post.popular }}
                </i>
              </div>
            </div>
            <div class="title d-flex align-items-center ps-4">
              {{ post.title }}
            </div>
            <div
              class="
                poster
                d-flex
                justify-content-center
                flex-column
                align-items-center
                p-1
              "
            >
              <div class="poster-name">
                {{ post.username }}
              </div>
              <div class="poster-updated">
                {{ post.updated_at }}
              </div>
            </div>
            <div
              class="
                updated
                d-flex
                justify-content-center
                flex-column
                align-items-center
                p-1
              "
            >
              <div class="poster-name">bochen</div>
              <div class="poster-updated">2021/03/22 下午 3:16</div>
            </div>
          </div>
          <div
            class="table-body d-flex align-items-center justify-content-center"
            style="height: 48px"
            v-if="posts.length == 0"
          >
            沒有搜尋到文章喔
          </div>
          <!-- table body -->
        </div>
        <!-- post table -->
        <!-- navigations -->
        <div
          class="paginations d-flex align-items-center justify-content-center"
        >
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="page.min != 1">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item" v-for="page in page.pages" :key="page.id">
                <a
                  class="page-link"
                  :class="{ 'page-selected': page == currentPage }"
                  @click="changePage(page)"
                >
                  {{ page }}
                </a>
              </li>
              <li
                class="page-item"
                v-if="page.max > 7 && currentPage + 3 >= page.max"
              >
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- navigations -->
      </div>
      <div class="col-3 other-area">
        <div class="card"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios
      .get("/posts/index")
      .then((res) => {
        // console.log(res.data);
        res.data.posts.forEach((element) => {
          this.posts.push(element);
        });
        this.page.total = res.data.pages;
        if (this.page.total < this.page.max) this.page.max = this.page.total;
        this.updatePages();
      })
      .catch((err) => {
        console.log(err);
      });
  },
  data() {
    return {
      categorys: ["全部主題", "電玩相關", "心情抒發", "發問專區"],
      posts: [],
      sort_options: [
        {
          name: "創建時間 新~舊",
          value: "create_desc",
        },
        {
          name: "創建時間 舊~新",
          value: "create_asc",
        },
        {
          name: "更新時間 新~舊",
          value: "update_desc",
        },
        {
          name: "更新時間 舊~新",
          value: "update_asc",
        },
        {
          name: "收藏數 多~少",
          value: "star_desc",
        },
        {
          name: "收藏數 少~多",
          value: "star_asc",
        },
      ],
      search: {
        category: "",
        title: "",
        sortWith: "",
        sortType: "",
      },
      currentPage: 1,
      page: {
        min: 1,
        max: 7,
        total: 1,
        pages: [1],
      },
    };
  },
  methods: {
    href(url) {
      window.location.href = url;
    },
    changeSort(val) {
      if (/create/.test(val.target.value)) this.search.sortWith = "created_at";
      if (/update/.test(val.target.value)) this.search.sortWith = "updated_at";
      if (/star/.test(val.target.value)) this.search.sortWith = "popular";
      if (/desc/.test(val.target.value)) this.search.sortType = "desc";
      if (/asc/.test(val.target.value)) this.search.sortType = "asc";
      this.updatePosts();
    },
    changeCategory(name) {
      if (name == "全部主題") {
        this.search.category = "";
      } else {
        this.search.category = name;
      }
      this.updatePosts();
    },
    categorySelected(val) {
      this.search.category = val.target.value;
    },
    searchTitle() {
      this.updatePosts();
      this.search.title = "";
    },
    updatePosts() {
      let url = "/posts/index?";
      if (this.search.category != "" || this.search.category != "全部主題")
        url += "category=" + this.search.category + "&";
      if (this.search.title != "") url += "title=" + this.search.title + "&";
      if (this.search.sortWith != "")
        url += "sortWith=" + this.search.sortWith + "&";
      if (this.search.sortType != "")
        url += "sortType=" + this.search.sortType + "&";
      if (this.currentPage > 1) url += "page=" + this.currentPage + "&";
      console.log(url);
      axios.get(url).then((res) => {
        // console.log(res.data);
        this.posts = [];
        res.data.posts.forEach((element) => {
          this.posts.push(element);
        });
      });
    },
    updatePages() {
      this.page.pages = [];
      for (let i = this.page.min; i <= this.page.max; i++) {
        this.page.pages.push(i);
      }
    },
    changePage(page) {
      this.currentPage = page;
      this.updatePosts();
    },
    singlePost(id) {
      window.localStorage.setItem("post_id", id);
      window.location.href = "/post-single";
    },
  },
  watch: {
    currentPage() {
      if (this.currentPage - 3 <= 0) {
        this.page.min = 1;
      } else {
        this.page.min = this.currentPage - 3;
      }
      if (this.currentPage + 3 <= this.page.total) {
        this.page.max = this.currentPage + 3;
      } else {
        this.page.max = this.page.total;
      }

      this.updatePages();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/post.scss";
</style>
