<template>
  <div class="container">
    <div class="row">
      <div class="col-10 left" style="padding: 1.2vw">
        <!-- searchbar -->
        <div class="row searchbar">
          <div class="col-lg-8">
            <div class="input-group">
              <div class="input-group-prepend">
                <select class="form-select" @change="changeOption">
                  <option v-for="tab in tabs" :key="tab.id" :value="tab.name">
                    {{ tab.name }}
                  </option>
                </select>
              </div>
              <input
                type="text"
                class="form-control"
                aria-label="Text input with dropdown button"
              />
              <div class="input-group-append">
                <button class="btn search-btn">搜尋</button>
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
            <button class="btn" v-for="tab in tabs" :key="tab.id">
              {{ tab.name }}
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
    };
  },
  methods: {
    href(url) {
      console.log(url);
      window.location.href = url;
    },
    changeSort(val) {
      let findWith, sortWith;
      if (/create/.test(val.target.value)) findWith = "created_at";
      if (/update/.test(val.target.value)) findWith = "updated_at";
      if (/star/.test(val.target.value)) findWith = "star";
      if (/desc/.test(val.target.value)) sortWith = "desc";
      if (/asc/.test(val.target.value)) sortWith = "asc";
      //   console.log(findWith + " + " + sortWith);
      //   if (val.tar)
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/post.scss";
</style>
