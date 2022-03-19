<template>
  <div class="box">
    <div class="card">
      <div class="title center">新增文章</div>
      <div
        class="card-body"
        style="padding: 80px; padding-top: 0; padding-bottom: 0"
      >
        <div class="top">
          <div class="input">
            <div class="input-group">
              <button
                class="btn btn-outline-secondary dropdown-toggle drop_btn"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                {{ category_selected }}
              </button>
              <ul class="dropdown-menu">
                <li v-for="category in categorys" :key="category.id">
                  <a
                    class="dropdown-item"
                    @click="categorySelected(category)"
                    >{{ category }}</a
                  >
                </li>
              </ul>
              <input
                type="text"
                class="form-control"
                aria-label="Text input with dropdown button"
                placeholder="文章標題"
                v-model="title"
              />
            </div>
          </div>
        </div>
        <div class="medium">
          <textarea
            class="form-control"
            cols="40"
            rows="28"
            v-model="content"
          ></textarea>
        </div>
        <div class="bottom">
          <div class="col-lg-6 left">
            <span class="error_msg">{{ error_msg }}</span>
          </div>
          <div class="col-lg-6 right">
            <button class="btn" @click="this.create_post">建立文章</button>
            <button class="btn" @click="this.cancel">取消建立</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (window.localStorage.getItem("token") != null) {
      axios
        .get("/check-token", {
          headers: {
            Authorization: `Bearer ${window.localStorage.getItem("token")}`,
          },
        })
        .catch((err) => {
          window.location.href = "/post";
          this.$store.dispatch("SetToast", {
            status: true,
            title: "系統提示",
            content: "你沒有權限新增文章，請登入後再試",
          });
        });
    } else {
      window.location.href = "/post";
      this.$store.dispatch("SetToast", {
        status: true,
        title: "系統提示",
        content: "你沒有權限新增文章，請登入後再試",
      });
    }
  },
  data() {
    return {
      image: null,
      image_file: null,
      categorys: ["電玩相關", "心情抒發", "發問專區"],
      title: "",
      content: "",
      category_selected: "文章類別",
      error_msg: "",
    };
  },
  methods: {
    fileSelected(event) {
      this.image_file = event.target.files[0];
      const reader = new FileReader(); //建立FileReader 監聽 Load 事件
      reader.addEventListener("load", this.imageLoader);
      reader.readAsDataURL(this.image_file);
    },
    imageLoader(event) {
      this.image = event.target.result;
    },
    categorySelected(category) {
      this.category_selected = category;
    },
    create_post() {
      let formData = new FormData(); // 上傳圖片一定要包成formdata
      formData.append("image", this.image_file == null ? "" : this.image_file);
      formData.append("title", this.title);
      formData.append(
        "category",
        this.category_selected == "文章類別" ? "" : this.category_selected
      );
      formData.append("content", this.content);
      formData.append("user_id", 1);
      let config = {
        headers: {
          Authorization: `Bearer ${window.localStorage.getItem("token")}`,
          "Content-Type": "multipart/form-data",
        },
      };
      axios
        .post("/post", formData, config)
        .then((res) => {
          window.location.href = "/post";
          this.$store.dispatch("SetToast", {
            status: true,
            title: "系統提示",
            content: "文章建立完成",
          });
        })
        .catch((err) => {
          console.log(err.response);
          if (err.response.status == 422) {
            this.error_msg = Object.values(err.response.data.errors)[0][0];
          }
        });
    },
    cancel() {
      window.location.href = "/post";
    },
  },
  computed: {
    upload_image() {
      if (this.image != null) {
        return this.image;
      } else {
        return "post.png";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/createpost.scss";
</style>
