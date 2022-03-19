<template>
  <div class="container">
    <div class="row">
      <div class="col-10 left" style="padding: 1.2vw">
        <!-- searchbar -->
        <div class="row searchbar">
          <div class="col-lg-8">
            <div class="input-group">
              <div class="input-group-prepend">
                <select class="form-select" @change="categorySelected">
                  <option
                    v-for="category in categorys"
                    :key="category.id"
                    :value="category.name"
                  >
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <input
                type="text"
                class="form-control"
                aria-label="Text input with dropdown button"
                v-model="search.title"
                @keypress.enter="searchTitle"
              />
              <div class="input-group-append">
                <button class="btn search-btn" @click="searchTitle">
                  搜尋
                </button>
              </div>
            </div>
          </div>
          <div class="col-lg-4 change-sort">
            <select
              class="form-select"
              aria-label="Default select example"
              @change="changeSort"
            >
              <option
                v-for="sort_option in sort_options"
                :key="sort_option.id"
                :value="sort_option.value"
              >
                {{ sort_option.name }}
              </option>
            </select>
          </div>
        </div>
        <!-- searchbar -->
        <!-- tabs -->
        <div class="row tabs">
          <div class="col-lg-7 left">
            <button
              class="btn"
              v-for="category in categorys"
              :key="category.id"
              @click="changeCategory(category.name)"
            >
              {{ category.name }}
            </button>
          </div>
          <div class="col-lg-5 right">
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
                <tr v-for="post in posts" :key="post.id">
                  <td class="star">
                    {{ post.star }}
                  </td>
                  <td class="title">
                    {{ post.title }}
                  </td>
                  <td class="user">
                    {{ post.username }}
                  </td>
                  <td class="update">
                    {{ post.updated_at }}
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="no-find ct" v-if="posts.length == 0">
              沒有找到任何文章
            </div>
          </div>
        </div>
        <div class="row page">
          <div class="col">
            <nav aria-label="Page navigation example">
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
        </div>
        <!-- tables -->
      </div>
      <div class="col-2 right padd" style="border: 1px solid">開發中</div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios
      .get("/posts")
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
      categorys: [
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
      console.log(url);
      window.location.href = url;
    },
    changeSort(val) {
      if (/create/.test(val.target.value)) this.search.sortWith = "created_at";
      if (/update/.test(val.target.value)) this.search.sortWith = "updated_at";
      if (/star/.test(val.target.value)) this.search.sortWith = "star";
      if (/desc/.test(val.target.value)) this.search.sortType = "desc";
      if (/asc/.test(val.target.value)) this.search.sortType = "asc";
      this.updatePosts();
    },
    changeCategory(name) {
      this.search.category = name;
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
      let url = "/posts?";
      if (this.search.category != "")
        url += "category=" + this.search.category + "&";
      if (this.search.title != "") url += "title=" + this.search.title + "&";
      if (this.search.sortWith != "")
        url += "sortWith=" + this.search.sortWith + "&";
      if (this.search.sortType != "")
        url += "sortType=" + this.search.sortType + "&";
      if (this.currentPage > 1) url += "page=" + this.currentPage + "&";

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
