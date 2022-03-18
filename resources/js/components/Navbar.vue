<template>
  <nav
    class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0"
  >
    <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
      <h2 class="m-0 text-primary">紙扇論壇</h2>
    </a>
    <button
      type="button"
      class="navbar-toggler me-4"
      data-bs-toggle="collapse"
      data-bs-target="#navbarCollapse"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <a href="/" class="nav-item nav-link active nav-a">首頁</a>
        <a href="/post" class="nav-item nav-link nav-a">論壇</a>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            ><img src="favicon.ico"
          /></a>
          <div
            class="dropdown-menu fade-down dropdown-menu-end dropdown-menu-side"
          >
            <a
              :href="navbar.url"
              class="dropdown-item"
              v-for="navbar in navbars"
              :key="navbar.id"
            >
              {{ navbar.name }}
            </a>
          </div>
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

<style lang="css" scoped>
@import "../../css/navbar.css";
</style>
