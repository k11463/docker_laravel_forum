<template>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <div class="col-2">
        <a class="navbar-brand title" href="/">
          <img
            src="favicon.ico"
            alt=""
            width="30"
            height="30"
            style="margin-bottom: 4px"
          />
          紙扇論壇
        </a>
      </div>

      <div class="col-6">
        <div class="input-group">
          <button
            class="btn btn-outline-secondary dropdown-toggle drop_btn"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            文章分類
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">分類1</a></li>
          </ul>
          <input
            type="text"
            class="form-control"
            aria-label="Text input with dropdown button"
            placeholder="請輸入欲搜尋的關鍵字"
          />
          <button class="btn btn-outline-secondary drop_btn">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </div>

      <div class="col-2">
        <div class="dropdown" style="float: right">
          <button class="btn user_icon" data-bs-toggle="dropdown">
            <img src="favicon.ico" width="26" height="28" />
          </button>
          <ul class="dropdown-menu">
            <li>
              <a
                class="dropdown-item"
                :href="nav.url"
                v-for="nav in navbars"
                :key="nav.id"
                >{{ nav.name }}</a
              >
              <button class="dropdown-item" v-if="login_status" @click="logout">
                登出
              </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
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
        .then((res) => {
          this.login_status = true;
        });
    }
  },
  data() {
    return {
      navs: [
        {
          name: "登入",
          url: "./login",
        },
        {
          name: "註冊",
          url: "./signup",
        },
      ],
      login_navs: [
        {
          name: "會員資料管理",
          url: "/",
        },
      ],
      login_status: false,
    };
  },
  computed: {
    navbars() {
      if (this.login_status) {
        return this.login_navs;
      } else {
        return this.navs;
      }
    },
  },
  methods: {
    logout() {
      axios
        .get("/logout", {
          headers: {
            Authorization: `Bearer ${window.localStorage.getItem("token")}`,
          },
        })
        .then((res) => {
          window.location.reload();
          this.$store.dispatch("SetToast", {
            status: true,
            title: "系統提示",
            content: "登出成功",
          });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.center {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid white;
}

.nav {
  color: white;
}

.drop_btn {
  background-color: white;
}
.drop_btn:hover {
  background-color: rgb(108, 117, 125);
}

.user_icon {
  border-radius: 50%;
  background-color: rgb(255, 255, 255);
  width: 40px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.user_icon:hover {
  border: 1px solid rgb(255, 115, 0);
}
</style>
